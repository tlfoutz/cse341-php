<?php
    session_start();
    require "dbConnect.php";

	$username = $_POST['rname'];
	$password = $_POST['rpsw'];

    $statement = $db->prepare('SELECT id, user_name, user_password FROM users WHERE user_name = :username AND user_password = :password');
    $result = $statement->execute(array(':username' => htmlspecialchars($_POST['rname']), ':password' => htmlspecialchars($_POST['rpsw'])));

	if ($result)
	{
		$row = $statement->fetch();
		$hashedPasswordFromDB = $row['password'];

		if (password_verify($password, $hashedPasswordFromDB))
		{
            $_SESSION['userId'] = $row['id'];
            $_SESSION['userName'] = $row['user_name'];
            header("Location: index.php");
			die();
		} else {
            $_SESSION['errMsg'] = '<p style="color:red">Incorrect password.</p>';
            header("Location: signIn.php");
            die();
        }
	} else {
        $_SESSION['errMsg'] = '<p style="color:red">Incorrect username.</p>';
        header("Location: signIn.php");
        die();
    }

    $statement = $db->prepare('SELECT id, user_name, user_password FROM users WHERE user_name = :username AND user_password = :password');
    try {$statement->execute(array(':username' => htmlspecialchars($_POST['rname']), ':password' => htmlspecialchars($_POST['rpsw'])));}
    catch (PDOException $ex) {

    }
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['userId'] = $row['id'];
        $_SESSION['userName'] = $row['user_name'];
    }
    $_SESSION['errMsg'] = '';
    header("Location: index.php");
    die();

?>