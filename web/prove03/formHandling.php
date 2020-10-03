<?php
$nameErr = $emailErr = $addressErr = $cityErr = $stateErr = $zipErr = "";
$fullname = $email = $address = $city = $state = $zip = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $valid = true;

  if (empty($_POST["fullname"])) {
    $valid = false;
    $nameErr = "Name is required";
  } else {
    $fullname = test_input($_POST["fullname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $fullname)) {
      $valid = false;
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $valid = false;
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $valid = false;
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["address"])) {
    $valid = false;
    $addressErr = "Address is required";
  } else {
    $address = test_input($_POST["address"]);
    if (!preg_match("/^[0-9a-zA-Z-' ]*$/", $address)) {
      $valid = false;
      $addressErr = "Only numbers, letters, and white space allowed";
    }
  }

  if (empty($_POST["city"])) {
    $valid = false;
    $cityErr = "City is required";
  } else {
    $city = test_input($_POST["city"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
      $valid = false;
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["state"])) {
    $valid = false;
    $stateErr = "State is required";
  } else {
    $state = test_input($_POST["state"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $state)) {
      $valid = false;
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["zip"])) {
    $valid = false;
    $zipErr = "Zipcode is required";
  } else {
    $zip = test_input($_POST["zip"]);
    if (!preg_match("/^[0-9]{5}?$/", $zip)) {
      $valid = false;
      $zipErr = "Exactly 5 digits allowed";
    }
  }
}

if($valid) {
  header('location:confirmation.php');
  exit();
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>