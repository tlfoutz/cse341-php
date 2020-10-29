<?php
    session_start();
    if (!isset($_SESSION['userId'])) {
        header("Location: signIn.php");
        die();
    }
    require 'dbConnect.php';

?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Travis Foutz">
        <meta name="description" content="Project 01 - CSE 341">
        <title>Add new food to inventory</title>
    </head>
    <body>
        <h1>Food Inventory Application</h1>
        <h2>Add new food item:</h2><br>
        <?php if(isset($_GET['error'])){ echo $_SESSION['errMsg'] . "<br>"; }?>
        <form id="addFoodForm" method="post" action="insertFood.php">
            <label for="fAddName">Name:</label><br>
            <input type="text" id="fAddName" name="fAddName" maxlength="64" required><br>
            <label for="fAddLocation">Location:</label><br>
            <select name="fAddLocation" id="fAddLocation">
                <option value="0" disabled selected> -- Select location -- </option>
                <?php
                    $statement = $db->prepare('SELECT id, location_name FROM locations WHERE added_by = :id ORDER BY location_name');
                    $statement->execute(array(':id' => $_SESSION['userId']));
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['location_name'] . '</option>';
                    }
                    echo '</select><br>';
                ?>
            <label for="fAddQuantity">Quantity:</label><br><input type="number" id="fAddQuantity" name="fAddQuantity" min="0" required><br>
            <label for="fAddDetails">Details:</label><br><input type="text" id="fAddDetails" name="fAddDetails" maxlength="255"><br><br>
            <input type="submit" name="addFood" value="Add Food">
        </form><br><br>
        <a href="index.php">Back</a>
    </body>
</htmll>