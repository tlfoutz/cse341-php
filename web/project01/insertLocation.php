<?php
    session_start();
    require "dbConnect.php";

    // INSERT new location
    if ($_POST['lAddName']) {
        // with details
        if ($_POST['lAddDetails']) {
            $statement = $db->prepare('INSERT INTO locations(location_name, details, added_by) VALUES (:name, :details, :id)');
            $statement->execute(array(':name' => htmlspecialchars($_POST['lAddName']), ':details' => htmlspecialchars($_POST['lAddDetails']), ':id' => $_SESSION['userId']));
        } else {
            $statement = $db->prepare('INSERT INTO locations(location_name, added_by) VALUES (:name, :id)');
            $statement->execute(array(':name' => htmlspecialchars($_POST['lAddName']), ':id' => $_SESSION['userId']));
        }
    }
    header("Location: index.php");
    die();
?>