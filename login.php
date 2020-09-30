<?php
    session_start();
    if( !isset($_POST['email']) || !isset($_POST['password']) ) {
        header('Location: home.html');
        exit();
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $connect = new mysqli($host, $db_user, $db_password, $db_name);
        if($connect->connect_errno!=0) {
            throw new Exception(mysqli_connect_errno());
        }
        else {
            $email = $_POST['email'];
            $password = $_POST['password'];

        }
    } catch (Exception $e) {
        echo '<div style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o logowanie w innym terminie!</div>';
        echo 'Informacja developerska: '.$e;
    }



?>