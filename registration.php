<?php
session_start();

if(isset($_POST['email']))  {
    $all_right = true;

    $username = filter_input(INPUT_POST, 'username');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $confirm_password = filter_input(INPUT_POST, 'confirm_password');

    if(strlen($username)<3 || strlen($username)>50) {
        $all_right = false;
        $_SESSION['e_username'] = "Nazwa użytkownika powinna być nie krótsza niż 3 znaki i nie dłuższa niż 50 znaków.";
        header('Location: registration-view.php');
    }

    if(ctype_alnum($username)==false) {
        $all_right = false;
        $_SESSION['e_username'] = "Nazwa użytkownika może składać się tylko z liter i cyfr (bez polskich znaków)";
        header('Location: registration-view.php');

    }

    if (empty(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))) {
        $all_right = false;
        $_SESSION['e_email'] = "Podaj poprawny adres email.";
        header('Location: registration-view.php');

    }

    if(strlen($email) >50) {
        $all_right = false;
        $_SESSION['e_email'] = "Adres email nie może być dłuższy niż 50 znaków.";
        header('Location: registration-view.php');
    }

    if(strlen($password)<8 || strlen($password)>20) {
        $all_right = false;
        $_SESSION['e_password'] = "Hasło musi posiadać od 8 do 20 znaków.";
        header('Location: registration-view.php');

    }

    if($password != $confirm_password) {
        $all_right = false;
        $_SESSION['e_password'] = "Podane hasła różnią się od siebie.";
        header('Location: registration-view.php');

    }
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $secret = "6LdHU88ZAAAAAJNWOZylkJv29cy1MCJD83Enrtdb";
    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);

    $response = json_decode($check);

    if ($response->success==false)
    {
        $all_right=false;
        $_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
        header('Location: registration-view.php');

    }

    // Remember inserted data
    $_SESSION['fr_username'] = $username;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_password'] = $password;
    $_SESSION['fr_confirm_password'] = $confirm_password;

    require_once 'connect-database.php';

    $query = $db->prepare('SELECT id FROM users WHERE email=:email');
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();

    if($query->fetch()) {
        $all_right = false;
        $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail.";
        header('Location: registration-view.php');
    }

    $query = $db->prepare('SELECT id FROM users WHERE username=:username');
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->execute();

    if($query->fetch()) {
        $all_right = false;
        $_SESSION['e_username']="Istnieje już użytkownik z taką nazwą.";
        header('Location: registration-view.php');
    }

    if($all_right == true) {

        $query = $db->prepare('INSERT INTO users VALUES (NULL, :username, :password_hash, :email)');
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

        if($query->execute()) {
            $_SESSION['successful_registration'] = true;

            $lastID = $db->lastInsertId();

            $sql = "INSERT INTO payment_methods_assigned_to_users (user_id, name) SELECT :user_id, name FROM payment_methods_default;
                    INSERT INTO expenses_category_assigned_to_users (user_id, name) SELECT :user_id, name FROM expenses_category_default;
                    INSERT INTO incomes_category_assigned_to_users (user_id, name) SELECT :user_id, name FROM incomes_category_default;";

            $query = $db->prepare($sql);
            $query->bindValue(':user_id', $lastID, PDO::PARAM_INT);
            $query->execute();

            header('Location: welcome.php');
        }

    }
}
?>