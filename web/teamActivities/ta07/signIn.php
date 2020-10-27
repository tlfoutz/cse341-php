<?php
session_start();

// TODO: Error check in javascript
if (isset($_POST['txtUser']) && isset($_POST['txtPassword']))
{
	$username = $_POST['txtUser'];
	$password = $_POST['txtPassword'];

    // Connect to the DB
	require "dbConnect.php";
	$db = get_db();
	$query = 'SELECT password FROM account WHERE username=:username';

	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$result = $statement->execute();

	if ($result)
	{
		$row = $statement->fetch();
		$hashedPasswordFromDB = $row['password'];

		// do the hashed passwords match
		if (password_verify($password, $hashedPasswordFromDB))
		{
			$_SESSION['username'] = $username;
			header("Location: index.php");
			die();
		}
	}
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="form">
        <h2>Login</h2>
        <form id="mainForm" action="signIn.php" method="POST">
            <div class="input">
                <div class="inputBox">
                    <label>Username</label>
                    <input type="text" id="txtUser" name="txtUser" placeholder="johndoe@qwe.com">
                </div>
                <div class="inputBox">
                    <label>Password</label>
                    <input type="password" id="txtPassword" name="txtPassword" name="" placeholder="********"></input>
                </div>
                <div class="inputBox">
                    <input type="submit" name="" value="Sign In">
                </div>
            </div>
        </form>
        <p class="create"><a href="signUp.php">Click</a> to Create New Account</p>
        <p class="forgot"> Don't Forgot Your Password.</p>
        <a href="index.php">Cancel</a>
    </div>
</body>
</html>