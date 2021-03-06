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
        <link rel="icon" type="image/png" href="../images/moon.gif">
        <link rel="stylesheet" type="text/css" href="../css/project01.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Travis Foutz">
        <meta name="description" content="Project 01 - CSE 341">
        <title>Sign In - Food Inventory Application</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-md">
            <a class="navbar-brand" href="../homepage.php"><img src="../images/moon.gif" alt="Logo" style="width:33%;height:33%;"></a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../assignments.php">Assignments</a>
                </li>
                </ul>
            </div>
        </nav>
        <form id="signInForm" method="post" action="setUser.php">
            <header class="page-header header container-fluid">
                <div class="overlay"></div>
                <div class="description">
                    <h1>Food Inventory Application</h1>
                    <h2>User Sign In</h2>
                    <label for="rname"><b>Username: </b></label>
                    <input type="text" placeholder="Enter Username" name="rname" minlength="8" maxlength="16"><br><br>
                    <label for="rpsw"><b>Password: </b></label>
                    <input type="password" placeholder="Enter Password" name="rpsw" minlength="8" maxlength="16"><br><br>
                    <input type="submit" name="signIn" value="Sign In">
                    <?php if (!isset($_GET['from'])) {echo $_SESSION['errMsg'];} ?>
                    <p><a href="signUp.php?from=in">Click here</a> if new user</p>
                </div>
            </header>
        </form>
        <footer class="page-footer">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <h6 class="text-uppercase font-weight-bold">Contact</h6>
                <p>Email:
                <br/>tfoutz@byui.edu
            </div>
            <div class="footer-copyright text-center">© 2020 Copyright <?php echo "" . date("m/d/Y") . "";?></div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="../js/prove02.js"></script>
    </body>
</html>