<?php
    if(isset($_POST['delete1'])) {
        unset($_SESSION["cartItem1"]);
        unset($_SESSION["itemAmount1"]);
    }
    if(isset($_POST['delete2'])) { 
        unset($_SESSION["cartItem2"]);
        unset($_SESSION["itemAmount2"]);
    }
    if(isset($_POST['delete3'])) { 
        unset($_SESSION["cartItem3"]);
        unset($_SESSION["itemAmount3"]);
    } 
    if(isset($_POST['delete4'])) { 
        unset($_SESSION["cartItem4"]);
        unset($_SESSION["itemAmount4"]);
    } 
    if(isset($_POST['delete5'])) { 
        unset($_SESSION["cartItem5"]);
        unset($_SESSION["itemAmount5"]);
    } 
    if(isset($_POST['delete6'])) { 
        unset($_SESSION["cartItem6"]);
        unset($_SESSION["itemAmount6"]);
    }
?>