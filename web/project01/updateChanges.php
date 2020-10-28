<?php
    session_start();
    require "dbConnect.php";
    $_SESSION['foodSearch'] = htmlspecialchars(strtolower($_POST['fname']));
    $_SESSION['selectedLocation'] = $_POST['locations'];

    foreach($_POST as $key => $val) {
        if (preg_match('/newAmount\d/m', $key)) {
            $foodId = trim($key,"newAmount");
            $statement = $db->prepare('UPDATE foods SET quantity = :quantity WHERE id = :id');
            $statement->execute(array(':quantity' => intval($val), ':id' => intval($foodId)));
        }
        if (preg_match('/locations\d/m', $key)) {
            $foodId = trim($key,"locations");
            $statement = $db->prepare('UPDATE foods SET location_id = :locationId WHERE id = :id');
            $statement->execute(array(':locationId' => intval($val), ':id' => intval($foodId)));
        }
        if (preg_match('/descriptField\d/m', $key)) {
            $foodId = trim($key,"descriptField");
            $statement = $db->prepare('UPDATE foods SET details = :detailChange WHERE id = :id');
            $statement->execute(array(':detailChange' => $val, ':id' => intval($foodId)));
        }
    }
    header("Location: index.php");
    die();
?>