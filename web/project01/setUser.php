<?php
    if ($_POST['rname']) {
        $statement = $db->prepare('SELECT id, user_name, user_password FROM users WHERE user_name = :username AND user_password = :password');
        try {$statement->execute(array(':username' => htmlspecialchars($_POST['rname']), ':password' => htmlspecialchars($_POST['rpsw'])));}
        catch (PDOException $ex) {
            $_SESSION['errMsg'] = '<p style="color:red;">Incorrect username and/or password.</p>';
            header("Location: signIn.php");
            die();
        }
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['userId'] = $row['id'];
            $_SESSION['userName'] = $row['user_name'];
        }
        $_SESSION['errMsg'] = '';
        header("Location: index.php");
        die();
    }

?>