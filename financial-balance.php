<?php
session_start();

if(!isset($_SESSION['logged']) && !$_SESSION['logged'] == true ) {
    header('Location: home.php');
    exit();
}

$successful_validation = true;

// Standard periods
if(isset($_GET['period'])) {

    $period = $_GET['period'];
    $_SESSION['period'] = $period;

    switch ($period) {
        case 'current-month':
            $firstDate = date('Y-m-01');
            $secondDate = date('Y-m-d');
            break;
        case 'last-month':
            $firstDate = date('Y-m-d', strtotime('first day of last month'));
            $secondDate = date('Y-m-d', strtotime('last day of last month'));
            break;
        case 'current-year':
            $firstDate = date('Y-01-01');
            $secondDate = date('Y-m-d');
            break;
    }
}
// Non-standard periods
elseif ($_POST['start-date'] != '' && $_POST['end-date'] != '') {

    $_SESSION['start_date'] = $_POST['start-date'];
    $_SESSION['end_date'] = $_POST['end-date'];

    if(!preg_match("/^\d{4}-\d{2}-\d{2}$/" , $_POST['start-date']) || !preg_match("/^\d{4}-\d{2}-\d{2}$/" , $_POST['end-date'])) {
        $_SESSION['error_period'] = 'Wprowadź daty w poprawnym formacie.';
        $successful_validation = false;
        header('Location: financial-balance-view.php');
    }

    if($_POST['end-date'] < $_POST['start-date']) {
        $_SESSION['error_period'] = 'Pierwsza data musi być wcześniejsza lub równa drugiej.';
        $successful_validation = false;
        header('Location: financial-balance-view.php');
    }

    if($successful_validation == true) {
        $_SESSION['period'] = 'unstandardized';
        $firstDate = $_POST['start-date'];
        $secondDate = $_POST['end-date'];
    }

}
// Wrong data
else {
    $_POST['start-date'] != '' ? $_SESSION['start_date'] = $_POST['start-date'] : '';
    $_POST['end-date'] != '' ?  $_SESSION['end_date'] = $_POST['end-date'] : '';

    $_SESSION['error_period'] = 'Podaj datę początkową oraz końcową.';
    header('Location: financial-balance-view.php');
}

if($successful_validation == true && isset($firstDate) && isset($secondDate)) {

    require_once 'connect-database.php';

    // Expenses
    $sql = 'SELECT sum(amount), expenses_category_assigned_to_users.name AS category_name 
            FROM expenses 
            INNER JOIN expenses_category_assigned_to_users on expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id 
            WHERE (expenses.user_id = :user_id AND date_of_expense >= :first_date AND date_of_expense <= :second_date)
            GROUP BY expenses.expense_category_assigned_to_user_id 
            ORDER BY sum(amount) DESC;
            ';

    $query = $db->prepare($sql);
    $query->bindValue(':user_id', $_SESSION['logged_user_id'], PDO::PARAM_INT);
    $query->bindValue(':first_date', $firstDate, PDO::PARAM_STR);
    $query->bindValue(':second_date', $secondDate, PDO::PARAM_STR);

    if($query->execute()) {
        $expenses = $query->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($expenses)) {
            $_SESSION['expenses'] = $expenses;
        }
        header('Location: financial-balance-view.php');
    } else {
        $_SESSION['error_financial_balance'] = 'Coś poszło nie tak.. Spróbuj ponownie.';
        header('Location: financial-balance-view.php');
    }

    // Incomes
    $sql = 'SELECT sum(amount), incomes_category_assigned_to_users.name AS category_name 
            FROM incomes 
            INNER JOIN incomes_category_assigned_to_users on incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id 
            WHERE (incomes.user_id = :user_id AND date_of_income >= :first_date AND date_of_income <= :second_date)
            GROUP BY incomes.income_category_assigned_to_user_id 
            ORDER BY sum(amount) DESC;';

    $query = $db->prepare($sql);
    $query->bindValue(':user_id', $_SESSION['logged_user_id'], PDO::PARAM_INT);
    $query->bindValue(':first_date', $firstDate, PDO::PARAM_STR);
    $query->bindValue(':second_date', $secondDate, PDO::PARAM_STR);

    if($query->execute()) {
        $incomes = $query->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($incomes)) {
            $_SESSION['incomes'] = $incomes;
        }
        header('Location: financial-balance-view.php');
    } else {
        $_SESSION['error_financial_balance'] = 'Coś poszło nie tak.. Spróbuj ponownie.';
        header('Location: financial-balance-view.php');
    }



//    $sql = 'SELECT sum(amount)
//            FROM expenses
//            WHERE (user_id = 2 AND date_of_expense >= :first_date AND date_of_expense <= :second_date)';
//
//    $query = $db->prepare($sql);
////    $query->bindValue(':user_id', $_SESSION['logged_user_id'], PDO::PARAM_INT);
//    $query->bindValue(':first_date', $firstDate, PDO::PARAM_STR);
//    $query->bindValue(':second_date', $secondDate, PDO::PARAM_STR);
//    $query->execute();
//    var_dump($query->fetch(PDO::FETCH_ASSOC));
//    exit();

    // todo: select incomes,
    // display in table view,
    // select sum from two tables -
    // calculate balance,
    // google pie chart

}




