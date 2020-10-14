<?php
session_start();
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
        <select name="users" id="users">
            <option disabled selected value> -- Select user -- </option>
            <?php include 'accessUsers.php';?>
        </select>
        <br>
        <select name="locations" id="locations">
            <option disabled selected value> -- Select location -- </option>
            <?php include 'accessLocations.php';?>
        </select>
        <br>
        <?php include 'accessFoods.php';?>
    </body>
</html>