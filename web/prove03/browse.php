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
        <title>Shopping Cart Simulation</title>
    </head>
    <body>
        <h1>Shopping Cart Simulation</h1>
        <?php include 'itemSessionStore.php';?>
        <form method="post">
            <table>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>Item #1</td>
                    <td>The first item</td>
                    <td><input type="number" name="num1" min="0" value="0">
                </tr>
                <tr>
                    <td>Item #2</td>
                    <td>The second item</td>
                    <td><input type="number" name="num2" min="0" value="0">
                </tr>
                <tr>
                    <td>Item #3</td>
                    <td>The third item</td>
                    <td><input type="number" name="num3" min="0" value="0">
                </tr>
                <tr>
                    <td>Item #4</td>
                    <td>The fourth item</td>
                    <td><input type="number" name="num4" min="0" value="0">
                </tr>
                <tr>
                    <td>Item #5</td>
                    <td>The fifth item</td>
                    <td><input type="number" name="num5" min="0" value="0">
                </tr>
                <tr>
                    <td>Item #6</td>
                    <td>The sixth item</td>
                    <td><input type="number" name="num6" min="0" value="0">
                </tr>
            </table>
            <br>
            <input type="submit" name="addToCart" value="Add to cart"/>
            <br><br>
        </form>
        <form action="cart.php">
            <input type="submit" value="Go to cart"/>
        </form>    
    </body>
</html>