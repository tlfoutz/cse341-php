<?php
    session_start();
    if (isset($_SESSION['userId'])) {
        unset($_SESSION['userId']);
        unset($_SESSION['username']);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Travis Foutz">
        <meta name="description" content="Project 01 - CSE 341">
        <title>Sign In - Food Inventory Application</title>
    </head>
    <body>
        <h1>Food Inventory Application</h1>
        <h2>User Sign In</h2>
        <form id="signInForm" method="post" action="setUser.php">
            <label for="rname"><b>Username: </b></label>
            <input type="text" placeholder="Enter Username" name="rname" minlength="8" maxlength="16"><br><br>
            <label for="rpsw"><b>Password: </b></label>
            <input type="password" placeholder="Enter Password" name="rpsw" minlength="8" maxlength="16"><br><br>
            <input type="submit" name="signIn" value="Sign In">
        </form><br>
        <?php if (!isset($_GET['from'])) {echo $_SESSION['errMsg'];} ?>
        <p><a href="signUp.php?from=in">Click here</a> if new user</p>
    </body>
</html>