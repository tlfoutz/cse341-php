<?php
session_start();
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
            <h1>New User Login</h1>
            <form id="mainForm" action="createUser.php" method="POST">
                <div class="input">
                    <div class="inputBox">
                        <label>Username</label>
                        <input type="text" id="txtUser" name="txtUser">
                    </div>
                    <div class="inputBox">
                        <label>Password</label>
                        <input type="password" id="txtPassword" name="txtPassword"></input>
                    </div>
                    <div class="inputBox">
                        <label>Retype Password</label>
                        <input type="password" id="txtPassword2" name="txtPassword2" onblur="passwordCheck()"></input>
                    </div>
                    <div>
                        <span style="color:red" id="txterror"></span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="" value="Sign In">
                    </div>
                </div>
            </form>
            <p class="create"><a href="signUp.php">Click</a> to Create New Account</p>
            <a href="index.php">Cancel</a>
        </div>
    </header>
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
    <script>
    function passwordsCheck() {
        const pass1 = document.getElementById("txtPassword").value;
        const pass2 = document.getElementById("txtPassword2").value;
        let error = document.getElementById("txterror");
        var pattern = /\d/g;

        if (pass1 != pass2) {
            error.innerHTML = "Passwords did not match";
            return;
        }
    }
    </script>
</body>
</html>