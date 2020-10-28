<?php
    session_start();
    if (!isset($_SESSION['userId'])) {
        header("Location: signIn.php");
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
        <title>Add a new location</title>
    </head>
    <body>
        <h1>Add new food location:</h1><br>
        <form method="post" action="insertLocation.php">
            <label for="lAddName">Name:</label><br>
            <input type="text" id="lAddName" name="lAddName" maxlength="64"><br>
            <label for="lAddDetails">Details:</label><br>
            <input type="text" id="lAddDetails" name="lAddDetails" maxlength="255"><br><br>
            <input type="submit" name="addLocation" value="Add Location">
        </form><br><br>
        <a href="index.php">Back</a>
    </body>
</htmll>