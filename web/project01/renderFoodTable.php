<?php
    require "dbConnect.php";

    $counter = 0;
                    
    if ($_SESSION['selectedLocation'] == 0 || empty($_SESSION['selectedLocation'])) {
        if ($_SESSION['foodSearch']) {
            $statement = $db->prepare("SELECT f.id, f.food_name, f.location_id, f.details, f.quantity, l.location_name FROM foods f INNER JOIN locations l ON f.location_id = l.id WHERE lower(f.food_name) LIKE :pattern AND f.added_by = :id ORDER BY f.food_name");
            $statement->execute(array(':id' => $_SESSION['userId'], ':pattern' => '%' . $_SESSION['foodSearch'] . '%'));
        } else {
            $statement = $db->prepare('SELECT f.id, f.food_name, f.location_id, f.details, f.quantity, l.location_name FROM foods f INNER JOIN locations l ON f.location_id = l.id WHERE f.added_by = :id ORDER BY f.food_name');
            $statement->execute(array(':id' => $_SESSION['userId']));
        }
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td>' . $row['food_name'] . '</td><td>';
            echo '<select name="locations' . $row['id'] . '" id="locations' . $row['id'] . '"><option value="0" disabled> -- Select location -- </option>';
            $sttmnt = $db->prepare('SELECT id, location_name FROM locations WHERE added_by = :id ORDER BY location_name');
            $sttmnt->execute(array(':id' => $_SESSION['userId']));
            while ($innerRow = $sttmnt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $innerRow['id'] . '"';
                if ($row['location_id'] == $innerRow['id']) { echo ' selected'; }
                echo '>' . $innerRow['location_name'] . '</option>';
            }
            echo '</select></td><td><input type="number" value="' . $row['quantity'] . '" name="newAmount' .$row['id'] . '" min="0"></td></td>';
            echo '<td><input type="textarea" value="' . $row['details'] . '" name="descriptField' .$row['id'] . '></td></tr>';
            $counter++;
        }
    } else {
        if ($_SESSION['foodSearch']) {
            $statement = $db->prepare("SELECT f.id, f.food_name, f.location_id, f.details, f.quantity, l.location_name FROM foods f INNER JOIN locations l ON f.location_id = l.id WHERE lower(f.food_name) LIKE :pattern AND f.added_by = :id AND f.location_id = :locationId ORDER BY f.food_name");
            $statement->execute(array(':id' => $_SESSION['userId'], ':locationId' => $_SESSION['selectedLocation'], ':pattern' => '%' . $_SESSION['foodSearch'] . '%'));
        } else {
            $statement = $db->prepare('SELECT f.id, f.food_name, f.location_id, f.details, f.quantity, l.location_name FROM foods f INNER JOIN locations l ON f.location_id = l.id WHERE f.added_by = :id AND f.location_id = :locationId ORDER BY f.food_name');
            $statement->execute(array(':id' => $_SESSION['userId'], ':locationId' => $_SESSION['selectedLocation']));
        }
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td>' . $row['food_name'] . '</td><td>';
            echo '<select name="locations' . $row['id'] . '" id="locations' . $row['id'] . '"><option value="0" disabled> -- Select location -- </option>';
            $sttmnt = $db->prepare('SELECT id, location_name FROM locations WHERE added_by = :id ORDER BY location_name');
            $sttmnt->execute(array(':id' => $_SESSION['userId']));
            while ($innerRow = $sttmnt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $innerRow['id'] . '"';
                if ($row['location_id'] == $innerRow['id']) { echo ' selected'; }
                echo '>' . $innerRow['location_name'] . '</option>';
            }
            echo '</select></td><td><input type="number" value="' . $row['quantity'] . '" name="newAmount' .$row['id'] . '" min="0"></td>';
            echo '<td><input type="textarea" value="' . $row['details'] . '" name="descriptField' .$row['id'] . '></td></tr>';
            $counter++;
        }
    }
    if ($counter == 0) { echo '<tr><td>No food found.</td></tr>'; }

?>