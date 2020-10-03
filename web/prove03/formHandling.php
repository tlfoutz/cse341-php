<?php
$nameErr = $emailErr = $addressErr = $cityErr = $stateErr = $zipErr = "";
$fullname = $email = $address = $city = $state = $zip = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $fullname = test_input($_POST["fullname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$fullname)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["address"])) {
    $addressErr = "Address is required";
  } else {
    $address = test_input($_POST["address"]);
  }

  if (empty($_POST["city"])) {
    $cityErr = "City is required";
  } else {
    $city = test_input($_POST["city"]);
  }

  if (empty($_POST["state"])) {
    $cityErr = "State is required";
  } else {
    $city = test_input($_POST["state"]);
  }

  if (empty($_POST["zip"])) {
    $nameErr = "Zipcode is required";
  } else {
    $name = test_input($_POST["zip"]);
    if (!preg_match("/^[0-9]{5}?$/", $zip)) {
      $zipErr = "Exactly 5 digits allowed";
    }
  }
}

if($valid){
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