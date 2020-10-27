<?php
session_start();

if (isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
}
else
{
    header("Location: signIn.php");
	die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project 01 - CSE 341</title>
    <meta charset="utf-8">
    <meta name="description" content="Create a signin web application.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Travis Foutz">
    <meta name="description" content="Project 01 Assignment - CSE 341">
    <link rel="icon" type="image/png" href="../images/moon.gif">
    <link rel="stylesheet" type="text/css" href="../css/prove02.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="homepage.php"><img src="../images/moon.gif" alt="Logo" style="width:33%;height:33%;"></a>
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="homepage.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="assignments.php">Assignments</a>
            </li>
            </ul>
        </div>
    </nav>
    <header class="page-header header container-fluid">
        <div class="overlay"></div>
        <div class="description">
            <h1>Assignments</h1>
            <p>See below for each assignment!</p>
        </div>
    </header>
    <div class="container features">
        <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <h3 class="feature-title">Shopping Cart Simulation</h3>
            <a href="/prove03/browse.php"><img src="images/shopping_cart.png" class="img-fluid"></a>
            <p>Create a simple PHP application to simulate a shopping cart.</p>
        </div>
        </div> 
    </div>
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
    <script src="js/prove02.js"></script>
</body>
</html>