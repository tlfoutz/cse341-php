<?php
    session_start();
    require "dbConnect.php";

    $statement = $db->prepare('SELECT id, user_name, user_password FROM users WHERE user_name = :username AND user_password = :password');
    $result = $statement->execute(array(':username' => htmlspecialchars($_POST['rname']), ':password' => htmlspecialchars($_POST['rpsw'])));
    if ($result) {
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userId'] = $row['id'];
        $_SESSION['userName'] = $row['user_name'];
        $_SESSION['errMsg'] = 'test';
        header("Location: index.php");
        die();
    } else {
        $_SESSION['errMsg'] = '<p style="color:red">Incorrect username/password.</p>';
        header("Location: signIn.php");
        die();
    }
?>