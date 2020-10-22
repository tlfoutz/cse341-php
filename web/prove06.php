<?php
    session_start();
    $_SESSION['userId'] = $_POST['users'];
    $_SESSION['selectedLocation'] = $_POST['locations'];
    $_SESSION['foodSearch'] = $_POST['fname'];

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
            echo '</select><br><br>';

            if ($_SESSION['userId']) {
                // User's locations 
                echo '<select name="locations" id="locations"><option value="0" selected>All locations</option>';
                $statement = $db->prepare('SELECT id, location_name FROM locations WHERE added_by = :id');
                $statement->execute(array(':id' => $_SESSION['userId']));
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['id'] . '"';
                    if ($_SESSION['selectedLocation'] == $row['id']) { echo ' selected'; }
                    echo '>' . $row['location_name'] . '</option>';
                }
                echo '</select><br>';
                
                // Food name search
                echo '<label for="fname">Find food by name:</label><br><input type="search" id="fname" name="fname"';
                if($_SESSION['foodSearch']) { echo ' value="' . $_SESSION['foodSearch'] . '"';}
                echo '><br><br>';
                
                // Food table
                echo '<table><tr><th>Food</th><th>Location</th><th>Quantity</th></tr>';
                $counter = 0;
                
                if ($_SESSION['selectedLocation'] == 0 || empty($_SESSION['selectedLocation'])) {
                    if ($_SESSION['foodSearch']) {

                    } else {
                        $statement = $db->prepare('SELECT food_name, location_id, quantity, unit FROM foods WHERE added_by = :id');
                        $statement->execute(array(':id' => $_SESSION['userId']));
                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr><td>' . $row['food_name'] . '</td><td>' . $row['location_id'] . '</td><td>' . $row['quantity'] . ' ' . $row['unit'];
                            if ($row['quantity'] != 1 && $row['unit']) { echo 's';}
                            echo '</td></tr>';
                            $counter++;
                        }
                    }
                } else {
                    if ($_SESSION['foodSearch']) {

                    } else {
                        $statement = $db->prepare('SELECT food_name, location_id, quantity, unit FROM foods WHERE added_by = :id AND location_id = :locationId');
                        $statement->execute(array(':id' => $_SESSION['userId'], ':locationId' => $_SESSION['selectedLocation']));
                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr><td>' . $row['food_name'] . '</td><td>' . $row['location_id'] . '</td><td>' . $row['quantity'] . ' ' . $row['unit'];
                            if ($row['quantity'] != 1 && $row['unit']) { echo 's';}
                            echo '</td></tr>';
                            $counter++;
                        }
                    }
                }
                echo '</table><br>';
                if ($counter == 0) { echo 'No food found.<br>'; }

                // New food item input
                echo '<br><h3>Add new food item:</h3><label for="fAddName">Name:</label><br><input type="text" id="fAddName" name="fAddName"><br>';
                echo '<label for="fAddLocation">Location:</label><br><input type="text" id="fAddLocation" name="fAddLocation"><br>';
                echo '<label for="fAddQuantity">Quantity:</label><br><input type="text" id="fAddQuantity" name="fAddQuantity"><br><br>';
                echo '<select name="fAddUnits" id="fAddUnits"><option value="0" selected> -- Select units (optional)-- </option>';
                foreach ($db->query('SELECT id, unit_name FROM units') as $row) {
                    echo '<option value="' . $row['id'] . '">' . $row['unit_name'] . '</option>';
                }
                echo '</select><br><br>';
                echo '<select name="fAddType" id="fAddType"><option value="0" disabled selected> -- Select food type-- </option>';
                foreach ($db->query('SELECT id, type_name FROM foodtypes') as $row) {
                    echo '<option value="' . $row['id'] . '">' . $row['type_name'] . '</option>';
                }
                echo '</select><br>';
                echo '<label for="fAddDetails">Details:</label><br><input type="textarea" id="fAddDetails" name="fAddDetails"><br><br>';
                
                // New location input
                echo '<h3>Add new food location:</h3><label for="lAddName">Name:</label><br><input type="text" id="lAddName" name="lAddName"><br>';
                echo '<label for="lAddDetails">Details:</label><br><input type="textarea" id="lAddDetails" name="lAddDetails"><br><br>';
                
                if ($_POST['lAddName']) {
                    $date = date('Y-m-d');
                    $statement = $db->prepare('INSERT INTO locations(location_name, data_added, added_by, date_modified) VALUES (:name, :date, :id, :date)');
                    $statement->execute(array(':name' => $_POST['lAddName'], ':date' => $date, ':id' => $_SESSION['userId']));
                }
            }

            echo '<input type="submit" name="submit" value="Submit"></form><br>';
        ?>
    </body>
</html>