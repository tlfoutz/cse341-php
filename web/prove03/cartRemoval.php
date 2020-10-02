<?php
    if(isset($_POST['button1'])) {
        unset($_SESSION["cartItem1"]);
    }
    if(isset($_POST['button2'])) { 
        unset($_SESSION["cartItem2"]);
    }
    if(isset($_POST['button3'])) { 
        unset($_SESSION["cartItem3"]);
    } 
    if(isset($_POST['button4'])) { 
        unset($_SESSION["cartItem4"]);
    } 
    if(isset($_POST['button5'])) { 
        unset($_SESSION["cartItem5"]);
    } 
    if(isset($_POST['button6'])) { 
        unset($_SESSION["cartItem6"]);
    } 
?>