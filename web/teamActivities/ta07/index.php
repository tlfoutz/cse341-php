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
    <title>Undiscovered Beauty</title>
    <meta charset="utf-8">
    <meta name="application-name" content="TeamActivity07">
    <meta name="description" content="Create a signin web application.">
    <meta name="img" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--bootstrap stylesheet-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--google fonts: nanum gothic-->
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
    <!--header and navbar-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
                <div class="row w-100">
                    <a class="navbar-brand " href="#">Undiscovered Beauty</a>

                    <!--hamburger menu-->
                    <button class="navbar-toggler " type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-sm-auto float-right text-right">

                    <?php
                    if (!isset($username) || $username == "")
                    { echo '
                        <span class="navbar-text">Login to view cart: </span>
                            <li class="nav-item active">
                                <a class="nav-link" href="signIn.php">Login</a>
                            </li>
                            <span class="navbar-text">|</span>
                            <li class="nav-item">
                                <a class="nav-link" href="signUp.php">Join</a>
                            </li>';
                    }
                    else
                    {
                        echo "
                            <span class='navbar-text'>Welcome $username 
                            <a href='signOut.php'>Sign Out</a></span> 
                            <!--shopping cart-->
                            <li class='nav-item dropdown mx-2'>
                                <button class='btn btn-outline-success dropdown-toggle my-2 my-sm-0' type='button'
                                    href='#' id='navbarDropdown' data-toggle='dropdown' aria-haspopup='true'
                                    aria-expanded='false'>
                                    View Cart<span class='caret'></span>
                                </button>
                                <ul class='dropdown-menu dropdown-cart' role='menu'>
                                    <li class='text-center'>Your Shopping Cart</li>
                                    <hr />";
                        echo "<hr />
                                    <li class='text-center'><a href='#'>Checkout</a></li>
                                </ul>
                            </li>";
                    }
                    ?>
                        </ul>
                    </div>

                    <!--this is to put the dropdowns on another line-->
                    <div class="w-100"></div>

                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Bath & Shower
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#soapbars">Soap Bars</a>
                                <a class="dropdown-item" href="#bathbombs">Bath Bombs</a>
                                <a class="dropdown-item" href="#showerfizz">Shower Fizz</a>
                                <a class="dropdown-item" href="#bathsalt">Bath Salt</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Body
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#lotion">Lotion</a>
                                <a class="dropdown-item" href="#bodywhip">Body Whip</a>
                                <a class="dropdown-item" href="#massagebar">Massage Bar</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Face
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#lipscrup">Lip Scrub</a>
                                <a class="dropdown-item" href="#lipbalm">Lip Balm</a>
                                <a class="dropdown-item" href="#faceoil">Face Oil</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Gifts
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#candles">Candles</a>
                                <a class="dropdown-item" href="#bundles">Bundles</a>
                                <a class="dropdown-item" href="#accessories">Accessories</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    



    <footer class="">
        <div class="container">
            <p>Joshua Mathews | cse341</p>
        </div>
    </footer>

    <!--Bootstrap dependancies-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>