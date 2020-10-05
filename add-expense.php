<?php
    session_start();

if(!isset($_SESSION['logged']) && !$_SESSION['logged'] == true ) {
        header('Location: home.php');
        exit();
    }


    if(isset($_POST['amount']) && $_SESSION['logged_user_id']){

        $all_right = true;
        $loggedID = $_SESSION['logged_user_id'];

        $amount = filter_input(INPUT_POST, 'amount');
        $date = filter_input(INPUT_POST, 'date');
        $paymentMethod = filter_input(INPUT_POST, 'payment-method');
        $category = filter_input(INPUT_POST, 'category');
        $comment = filter_input(INPUT_POST, 'comment');

        // Remember inserted data
        $_SESSION['fr_amount'] = $amount;
        $_SESSION['fr_date'] = $date;

        if(!preg_match("/^\d{1,8}(\.\d{0,2})?$/" , $amount)) {
            $all_right = false;
            $_SESSION['e_amount'] = "Podaj poprawną wartość - maksymalnie 10 cyfr w tym 2 po przecinku.";
            header('Location: add-expense-view.php');
        }





    }





