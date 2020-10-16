<?php
    session_start();
    $_SESSION["user"] = $_POST['users'];
    $_SESSION["location"] = $_POST['locations'];
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
        <meta name="description" content="PHP Data Acccess Assignment 05 - CSE 341">
        <title>Food Inventory Data Access</title>
    </head>
    <body>
        <h1>Food Inventory Data Access</h1>
        <br>
        <?php
            echo '<form method="post" action="';
            echo htmlspecialchars($_SERVER["PHP_SELF"]);
            echo '">';
            echo '<select name="users" id="users"><option disabled selected value> -- Select user -- </option>';
            foreach ($db->query('SELECT user_name FROM users') as $row) {
                echo '<option value="' . $row['id'] . 'user">' . $row['user_name'] . '</option>';
            }
            echo '</select><input type="submit" name="submit" value="Next"></form><br>';

            if ($_SESSION["user"]) {
                echo '<form method="post" action="';
                echo htmlspecialchars($_SERVER["PHP_SELF"]);
                echo '">';
                echo '<select name="locations" id="locations"><option disabled selected value> -- Select location -- </option>';
                $statement = $db->prepare('SELECT location_name FROM locations WHERE added_by = :id');
                $statement->execute(array(':id' => $_SESSION["userID"]));
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['id'] . 'location">' . $row['location_name'] . '</option>';
                }
                echo '</select><input type="submit" name="submit" value="Next"></form><br>';
            }

            if ($_SESSION["location"]) {
                echo '<table><tr><th>Food</th><th>Quantity</th></tr>';
                $statement = $db->prepare('SELECT food_name, quantity, units FROM foods WHERE locations_id = :id');
                $statement->execute(array(':id' => $_SESSION["locationID"]));
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr><td>' . $row['food_name'] . '</td><td>' . $row['quantity'] . ' ' . $row['units'] . '</td></tr>';
                }
                echo '</table>';
            }
        ?>
    </body>
</html>