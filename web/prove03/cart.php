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
        <title>Cart</title>
    </head>
    <body>
        <h1>Cart</h1>
        <form method="post">
            <table>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
                <?php include 'cartRemoval.php';?>
                <?php include 'fillCart.php';?>
            </table>
        </form>
        <form action="browse.php">
            <input type="submit" value="Go back to browse page to continue shopping"/>
        </form> 
        <form action="checkout.php">
            <input type="submit" value="Go to checkout"/>
        </form> 
        <script src="cartRemoval.js"></script>
    </body>
</html>