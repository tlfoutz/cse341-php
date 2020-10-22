<?php
    session_start();
    try {
        $dbUrl = getenv('DATABASE_URL');

        $dbOpts = parse_url($dbUrl);

        $dbHost = $dbOpts["host"];
        $dbPort = $dbOpts["port"];
        $dbUser = $dbOpts["user"];
        $dbPassword = $dbOpts["pass"];
        $dbName = ltrim($dbOpts["path"],'/');

        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Travis Foutz">
        <meta name="description" content="PHP Data Modification Assignment 06 - CSE 341">
        <title>Food Inventory Data Access</title>
    </head>
    <body>
        <h1>Food Inventory Data Modification</h1>
        <br>
        <?php
            echo '<form method="post" action="';
            echo htmlspecialchars($_SERVER["PHP_SELF"]);
            echo '">';
            echo '<select name="users" id="users"><option value="0" disabled selected> -- Select user -- </option>';
            foreach ($db->query('SELECT id, user_name FROM users') as $row) {
                echo '<option value="' . $row['id'] . '"';
                if ($_POST['users'] == $row['id']) { echo ' selected'; }
                echo '>' . $row['user_name'] . '</option>';
            }
            echo '</select><br>';
            $_SESSION['userId'] = $_POST['users'];
            if ($_SESSION['userId']) {
                echo '<select name="locations" id="locations"><option value="0" selected>All locations</option>';
                $statement = $db->prepare('SELECT id, location_name FROM locations WHERE added_by = :id');
                $statement->execute(array(':id' => $_SESSION['userId']));
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['id'] . '"';
                    if ($_POST['locations'] == $row['id']) { echo ' selected'; }
                    echo '>' . $row['location_name'] . '</option>';
                }
                echo '</select><br>';
                $statement = $db->prepare('SELECT id, food_name, location_id, quantity, unit FROM foods WHERE added_by = :id');
                $statement->execute(array(':id' => $_SESSION['userId']));
                $counter = 0;
                echo '<table><tr><th>Food</th><th>Location</th><th>Quantity</th></tr>';
                if($)
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr id="' . $row['id'] . 'food"><td>' . $row['food_name'] . '</td><td>' . $row['location_id'] . '</td><<td>' . $row['quantity'] . ' ' . $row['unit'];
                    if ($row['quantity'] != 1 && $row['unit']) { echo 's';}
                    echo '</td></tr>';
                    $counter++;
                }
                echo '</table>';
                if ($counter == 0) { echo 'No food found for this user.'; }

            }
            echo '<input type="submit" name="submit" value="Next"></form><br>';

            // if ($_POST['locations']) {
            //     if($_SESSION['recentUser'] != $_POST['users'] && isset($_SESSION['recentUser']) &&
            //       (isset($_SESSION['recentLocationUser']) && $_SESSION['recentLocationUser'] != $_POST['users'])) {
            //         echo '';
            //         unset($_SESSION['recentUser']);
            //         unset($_SESSION['recentLocationUser']);
            //     } else {
            //         $id = $_POST['locations'];
            //         $statement = $db->prepare('SELECT food_name, quantity, unit, added_by FROM foods WHERE location_id = :id');
            //         $statement->execute(array(':id' => $id));
            //         $counter = 0;
            //         echo '<table><tr><th>Food</th><th>Quantity</th></tr>';
            //         while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //             echo '<tr><td>' . $row['food_name'] . '</td><td>' . $row['quantity'] . ' ' . $row['unit'];
            //             if ($row['quantity'] != 1 && $row['unit']) { echo 's';}
            //             echo '</td></tr>';
            //             $counter++;
            //             $_SESSION['recentLocationUser'] = $row['added_by'];
            //         }
            //         echo '</table>';
            //         if ($counter == 0) { echo 'No food found at this location.'; }
            //         $_SESSION['recentUser'] = $_POST['users'];
            //     }
            }
        ?>
    </body>
</html>