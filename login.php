<?php
    session_start();

    if( !isset($_POST['email']) || !isset($_POST['password']) ) {
        header('Location: index.php');
        exit();
    }

    require_once 'connect-database.php';

    $password = $_POST['password'];
    $email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");

    $query = $db->prepare('SELECT * FROM users WHERE email=:email');
    $query->bindValue(':email', $email, PDO::PARAM_STR);

    if($query->execute()) {
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['logged'] = true;
            $_SESSION['logged_user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            unset ($_SESSION['e_email']);
            header('Location: menu.php');
        }
        else
        {
            $_SESSION['e_email'] = 'Nieprawidłowy email lub hasło!';
            header('Location: login-view.php');
        }
    }
?>