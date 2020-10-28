<?php
    unset($_SESSION['errMsg']);
    if($_GET['sign'] == "in") {
        header("Location: signIn.php");
        die();
    } else if ($_GET['sign'] == "up") {
        header("Location: signUp.php");
        die();
    }
?>