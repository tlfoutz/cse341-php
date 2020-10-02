<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Travis Foutz">
        <meta name="description" content="Shopping Cart Assignment 03 - CSE 341">
        <link rel="icon" type="image/png" href="images/moon.gif">
        <title>Checkout</title>
    </head>
    <body>
    <form action="cart.php">
            <input type="submit" value="Go back to cart"/>
        </form> 
        <form action="confirmation.php">
            <input type="submit" value="Confirm"/>
        </form> 
    </body>
</html>