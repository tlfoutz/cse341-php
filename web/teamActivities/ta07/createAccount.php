<?php
$username = $_POST['txtUser'];
$password = $_POST['txtPassword'];
$password2 = $_POST['txtPassword2'];

// Check for a username and password
if (!isset($username) || $username == "" 
|| !isset($password) || $password == "" 
|| !isset($password2) || $password2 == "")
{
   // If there isn't a username or password, then go back
	header("Location: signUp.php");
	die();
}

if ($password != $password2)
{
   // check if passwords match
   header("Location: signUp.php?error=missmatch");
   die();
}

if ($password.length < 7 && !preg_match( '~\d~', $password))
{
   // check if passwords match
   header("Location: signUp.php?error=passwordcheck");
   die();
}

// disallow code injection
$username = htmlspecialchars($username);

// hash the password.
   // PASSWORD_DEFAULT is the default php hashing algorithm. You can change to a different one if desired.
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// connect to the db
require("dbConnect.php");
$db = get_db();

// insert new user and their credientials into the database under the account table
$query = 'INSERT INTO account(username, password) VALUES(:username, :password)';
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);
$statement->bindValue(':password', $hashedPassword);
$statement->execute();

// redirect 
header("Location: signIn.php");
die();

?>