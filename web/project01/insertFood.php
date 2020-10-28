<?php
    require "dbConnect.php";

    // INSERT new food
    if ($_POST['fAddName']) {
        // check for missing/incorrect information
        if ((empty($_POST['fAddQuantity']) || $_POST['fAddQuantity'] <= 0) || $_POST['fAddLocation'] == 0) {
            $_SESSION['errMsg'] = '<p style="color:red;">Not all fields for new food item where filled out correctly. New food not added.</p>';
            header("Location: addFood.php");
            die();
        } else {
            // with details
            if ($_POST['fAddDetails']) {
                $statement = $db->prepare('INSERT INTO foods(food_name, details, location_id, quantity, added_by) VALUES (:name, :details, :locationId, :amount, :id)');
                $statement->execute(array(':name' => htmlspecialchars($_POST['fAddName']), ':details' => htmlspecialchars($_POST['fAddDetails']), ':locationId' => $_POST['fAddLocation'], ':amount' => $_POST['fAddQuantity'], ':id' => $_SESSION['userId'])); 
            } else {
                $statement = $db->prepare('INSERT INTO foods(food_name, location_id, quantity, added_by) VALUES (:name, :locationId, :amount, :id)');
                $statement->execute(array(':name' => htmlspecialchars($_POST['fAddName']), ':locationId' => $_POST['fAddLocation'], ':amount' => $_POST['fAddQuantity'], ':id' => $_SESSION['userId']));              
            }
        }
        $_SESSION['errMsg'] = '';
        header("Location: index.php");
        die();
    }
?>