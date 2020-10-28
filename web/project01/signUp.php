<?php
    session_start();
    if (isset($_SESSION['userId'])) {
        unset($_SESSION['userId']);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Travis Foutz">
        <meta name="description" content="Project 01 - CSE 341">
        <title>Sign Up - Food Inventory Application</title>
    </head>
    <body>
        <h1>User Sign Up</h1>
        <form id="signUpForm" method="post" action="createUser.php">
            <label for="nname"><b>Username: </b></label>
            <input type="text" placeholder="8 to 16 characters" name="nname" minlength="8" maxlength="16"><br><br>
            <label for="npsw"><b>Password: </b></label>
            <input type="password" placeholder="8 to 16 characters" name="npsw" minlength="8" maxlength="16"><br><br>
            <label for="cpsw"><b>Confirm Password: </b></label>
            <input type="password" placeholder="8 to 16 characters" name="cpsw" minlength="8" maxlength="16"><br><br>
            <input type="submit" name="signUp" value="Sign Up">
        </form><br>
        <?php if (!isset($_GET['from'])) {echo $_SESSION['errMsg'];} ?>
        <p><a href="signIn.php?from=up">Click here</a> if returning user</p>
    </body>
</html>