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
            echo '<input type="submit" name="submit" value="Submit"></form><br>';
        ?>
    </body>
</html>