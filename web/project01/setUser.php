<?php
    session_start();
    require "dbConnect.php";

    $statement = $db->prepare('SELECT id, user_name, user_password FROM users WHERE user_name = :username AND user_password = :password');
    $statement->execute(array(':username' => htmlspecialchars($_POST['rname']), ':password' => htmlspecialchars($_POST['rpsw'])));
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        if ($row['user_name'] == $_POST['rname'] && $row['user_password'] == $_POST['rpsw']) {
            $_SESSION['userId'] = $row['id'];
            $_SESSION['userName'] = $row['user_name'];
            $_SESSION['errMsg'] = '';
            header("Location: index.php");
            die();
        } else if ($row['user_name'] != $_POST['rname'] && $row['user_password'] != $_POST['rpsw']) {
            $_SESSION['errMsg'] = '<p style="color:red">Incorrect username and password.</p>';
            header("Location: signIn.php");
            die();
        } else if ($row['user_name'] != $_POST['rname']) {
            $_SESSION['errMsg'] = '<p style="color:red">Incorrect username.</p>';
            header("Location: signIn.php");
            die();
        } else if ($row['user_password'] == $_POST['rpsw']) {
            $_SESSION['errMsg'] = '<p style="color:red">Incorrect username.</p>';
            header("Location: signIn.php");
            die();
        }
    }


?>