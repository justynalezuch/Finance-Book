<?php
session_start();

if(!isset($_SESSION['logged']) && !$_SESSION['logged'] == true ) {
    header('Location: home.php');
    exit();
}

echo $_POST['category'];
if(isset($_POST['amount']) && $_SESSION['logged_user_id']){

    $all_right = true;
    $loggedID = $_SESSION['logged_user_id'];

    $amount = filter_input(INPUT_POST, 'amount');
    $dateOfIncome = filter_input(INPUT_POST, 'date');
    $category = filter_input(INPUT_POST, 'category');
    $comment = filter_input(INPUT_POST, 'comment');

    // Remember inserted data
    $_SESSION['fr_amount'] = $amount;
    $_SESSION['fr_date'] = $dateOfIncome;
    $_SESSION['fr_income_category'] = $category;
    $_SESSION['fr_comment'] = $comment;

    if(!preg_match("/^\d{1,8}(\.\d{0,2})?$/" , $amount)) {
        $all_right = false;
        $_SESSION['e_amount'] = "Podaj poprawną wartość - maksymalnie 10 cyfr w tym 2 po przecinku.";
        header('Location: add-income-view.php');
    }

    if(!preg_match("/^\d{4}-\d{2}-\d{2}$/" , $dateOfIncome)) {
        $all_right = false;
        $_SESSION['e_date'] = "Podaj poprawną datę.";
        header('Location: add-income-view.php');
    }

    if(empty($category)) {
        $all_right = false;
        $_SESSION['e_category'] = "Podaj kategorię przychodu.";
        header('Location: add-income-view.php');
    }
    if(empty($comment)) {
        $comment = NULL;
    }

//    if($all_right == true) {
//        require_once 'connect-database.php';
//
//        $query = $db->prepare(
//            'INSERT INTO incomes VALUES (
//                            NULL,
//                            :user_id,
//                            :income_category_assigned_to_user_id,
//                            :amount,
//                            :date_of_income,
//                            :income_comment)'
//        );
//        $query->bindValue(':user_id', $loggedID, PDO::PARAM_INT);
//        $query->bindValue(':income_category_assigned_to_user_id', $category, PDO::PARAM_INT);
//        $query->bindValue(':amount', $amount, PDO::PARAM_STR);
//        $query->bindValue(':date_of_income', $dateOfIncome, PDO::PARAM_STR);
//        $query->bindValue(':income_comment', $comment, PDO::PARAM_STR);
//
//        if($query->execute()) {
//            $_SESSION['successfully_adding_income'] = 'Gratulacje! Pomyślnie dodałeś przychód!';
//            header('Location: add-income-view.php');
//        } else {
//            $_SESSION['error_of_adding_income'] = 'Coś poszło nie tak.. Spróbuj ponownie.';
//            header('Location: add-income-view.php');
//        }
//
//    }

}





