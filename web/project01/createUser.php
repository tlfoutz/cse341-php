<?php
    session_start();
    require "dbConnect.php";

    if ($_POST['nname']) {
        if($_POST['npsw'] != $_POST['cpsw']) {
            $_SESSION['errMsg'] = '<p style="color:red;">The new and confirmation passwords did not match.</p>';
            header("Location: signUp.php");
            die();
        } else {
            $statement = $db->prepare('INSERT INTO users(user_name, user_password) VALUES (:name, :password)');
            try {
                $statement->execute(array(':name' => htmlspecialchars($_POST['nname']), ':password' => htmlspecialchars($_POST['npsw'])));
                // SELECT as the current user as well
                $statement = $db->prepare('SELECT id, user_name FROM users WHERE user_name = :username');
                $statement->execute(array(':username' => htmlspecialchars($_POST['nname'])));
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['userName'] = $row['user_name'];
                }
            }
            catch (PDOException $ex) {
                $_SESSION['errMsg'] = '<p style="color:red;">Username already exists.</p>';
                header("Location: signUp.php");
                die();
            }
        }
    }
    $_SESSION['errMsg'] = '';
    header("Location: index.php");
    die();
?>