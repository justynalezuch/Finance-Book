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

            $email = htmlentities($email, ENT_QUOTES, "UTF-8");

            if($result = $connect->query(
                sprintf("SELECT * FROM users WHERE email='%s'",
                mysqli_real_escape_string($connect, $email)))) {

                $how_many_users = $result->num_rows;
                if($how_many_users>0) {

                    $row = $result->fetch_assoc();

                    if (password_verify($password, $row['password']))
                    {
                       $_SESSION['logged'] = true;
                       $_SESSION['id'] = $row['id'];
                       $_SESSION['username'] = $row['username'];
                       $_SESSION['email'] = $row['email'];

                       unset ($_SESSION['e_login']);
                       $result->free_result();
                       header('Location: menu.php');

                    }
                    else
                    {
                        $_SESSION['e_login'] = 'Nieprawidłowy login lub hasło!';
                        header('Location: login-view.php');
                    }

                }
            }
        }
    } catch (Exception $e) {
        echo '<div style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o logowanie w innym terminie!</div>';
        echo 'Informacja developerska: '.$e;
    }



?>