<?php
    session_start();
    require "dbConnect.php";
    $_SESSION['foodSearch'] = htmlspecialchars(strtolower($_POST['fname']));
    $_SESSION['selectedLocation'] = $_POST['locations'];
    $locationChanged = false;

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
        if (preg_match('/descriptFieldLocation\d/m', $key)) {
            $locationId = trim($key,"descriptFieldLocation");
            $statement = $db->prepare('UPDATE locations SET details = :detailChange WHERE id = :id');
            $statement->execute(array(':detailChange' => $val, ':id' => intval($locationId)));
            $locationChanged = true;
        }
        if (preg_match('/descriptFieldFood\d/m', $key)) {
            $foodId = trim($key,"descriptFieldFood");
            $statement = $db->prepare('UPDATE foods SET details = :detailChange WHERE id = :id');
            $statement->execute(array(':detailChange' => $val, ':id' => intval($foodId)));
        }
        if (preg_match('/foodDelete\d/m', $key) && $val == 1) {
            $foodId = trim($key,"foodDelete");
            $statement = $db->prepare('DELETE FROM foods WHERE id = :id');
            $statement->execute(array(':id' => intval($foodId)));
        }
    }
    header("Location: index.php");
    die();
?>