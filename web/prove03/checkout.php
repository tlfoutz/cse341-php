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
        <style>
            .error {color: #FF0000;}
        </style>
        <title>Checkout</title>
    </head>
    <body>
        <h1>Checkout</h1>
        <h2>USA shipping address</h2>
        <form action="confirmation.php" method="post">
            <label for="fname">Full Name</label>
            <input type="text" id="fname" name="fullname" value="<?php echo $name;?>">
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $email;?>">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
            <label for="adr">Address</label>
            <input type="text" id="adr" name="address">
            <span class="error">* <?php echo $addressErr;?></span>
            <br><br>
            <label for="city">City</label>
            <input type="text" id="city" name="city">
            <span class="error">* <?php echo $cityErr;?></span>
            <br><br>
            <label for="state">State</label>
            <input type="text" id="state" name="state">
            <span class="error">* <?php echo $stateErr;?></span>
            <br><br>
            <label for="zip">Zipcode</label>
            <input type="text" id="zip" name="zip" value="<?php echo $zip;?>">
            <span class="error">* <?php echo $zipErr;?></span>
            <br><br>
            <form action="cart.php">
                <input type="submit" value="Go back to cart"/>
            </form> 
            <input type="submit" value="Confirm"/>
        </form> 
    </body>
</html>