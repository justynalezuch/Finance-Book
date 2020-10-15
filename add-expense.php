<?php
    session_start();

    if(!isset($_SESSION['logged']) && !$_SESSION['logged'] == true ) {
        header('Location: index.php');
        exit();
    }

    if(isset($_POST['amount']) && $_SESSION['logged_user_id']){

        $successful_validation = true;
        $loggedID = $_SESSION['logged_user_id'];

        $amount = filter_input(INPUT_POST, 'amount');
        $dateOfExpense = filter_input(INPUT_POST, 'date');
        $paymentMethod = filter_input(INPUT_POST, 'payment-method');
        $category = filter_input(INPUT_POST, 'category');
        $comment = filter_input(INPUT_POST, 'comment');

        // Remember inserted data
        $_SESSION['fr_amount'] = $amount;
        $_SESSION['fr_date'] = $dateOfExpense;
        $_SESSION['fr_paymentMethod'] = $paymentMethod;
        $_SESSION['fr_category'] = $category;
        $_SESSION['fr_comment'] = $comment;

        if(!preg_match("/^\d{1,8}(\.\d{0,2})?$/" , $amount)) {
            $successful_validation = false;
            $_SESSION['e_amount'] = "Podaj poprawną wartość - maksymalnie 10 cyfr w tym 2 po przecinku.";
            header('Location: add-expense-view.php');
        }

        if(!preg_match("/^\d{4}-\d{2}-\d{2}$/" , $dateOfExpense)) {
            $successful_validation = false;
            $_SESSION['e_date'] = "Podaj poprawną datę.";
            header('Location: add-expense-view.php');
        }

        if(empty($paymentMethod)) {
            $successful_validation = false;
            $_SESSION['e_paymentMethod'] = "Podaj metodę płatności.";
            header('Location: add-expense-view.php');
        }

        if(empty($category)) {
            $successful_validation = false;
            $_SESSION['e_category'] = "Podaj kategorię wydatku.";
            header('Location: add-expense-view.php');
        }
        if(empty($comment)) {
            $comment = NULL;
        }

        if($successful_validation == true) {
            require_once 'connect-database.php';

            $query = $db->prepare(
                'INSERT INTO expenses VALUES (
                            NULL,
                            :user_id,
                            :expense_category_assigned_to_user_id, 
                            :payment_method_assigned_to_user_id, 
                            :amount, 
                            :date_of_expense, 
                            :expense_comment)'
            );
            $query->bindValue(':user_id', $loggedID, PDO::PARAM_INT);
            $query->bindValue(':expense_category_assigned_to_user_id', $category, PDO::PARAM_INT);
            $query->bindValue(':payment_method_assigned_to_user_id', $paymentMethod, PDO::PARAM_INT);
            $query->bindValue(':amount', $amount, PDO::PARAM_STR);
            $query->bindValue(':date_of_expense', $dateOfExpense, PDO::PARAM_STR);
            $query->bindValue(':expense_comment', $comment, PDO::PARAM_STR);

            if($query->execute()) {
                $_SESSION['successfully_adding_expense'] = 'Gratulacje! Pomyślnie dodałeś wydatek!';
                header('Location: add-expense-view.php');
            } else {
                $_SESSION['error_of_adding_expense'] = 'Coś poszło nie tak.. Spróbuj ponownie.';
                header('Location: add-expense-view.php');
            }

        }

    }





