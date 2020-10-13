<?php
$firstDate = date('Y-m-01');
$secondDate = date('Y-m-d');

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
//        if(!empty($expenses)) {
            $_SESSION['expenses'] = $expenses;
//        }
    } else {
        $_SESSION['error_financial_balance'] = 'Coś poszło nie tak.. Spróbuj ponownie.';
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
} else {
    $_SESSION['error_financial_balance'] = 'Coś poszło nie tak.. Spróbuj ponownie.';
}
// Financial balance - summary
$sql = 'SELECT sum(amount)
            FROM expenses
            WHERE (user_id = :user_id AND date_of_expense >= :first_date AND date_of_expense <= :second_date)';

$query = $db->prepare($sql);
$query->bindValue(':user_id', $_SESSION['logged_user_id'], PDO::PARAM_INT);
$query->bindValue(':first_date', $firstDate, PDO::PARAM_STR);
$query->bindValue(':second_date', $secondDate, PDO::PARAM_STR);
if($query->execute()) {
    $sumOfExpenses = (int)$query->fetch(PDO::FETCH_ASSOC)['sum(amount)'];

}

$sql = 'SELECT sum(amount)
            FROM incomes
            WHERE (user_id = :user_id AND date_of_income >= :first_date AND date_of_income <= :second_date)';

$query = $db->prepare($sql);
$query->bindValue(':user_id', $_SESSION['logged_user_id'], PDO::PARAM_INT);
$query->bindValue(':first_date', $firstDate, PDO::PARAM_STR);
$query->bindValue(':second_date', $secondDate, PDO::PARAM_STR);
if($query->execute()) {
    $sumOfIncomes = (int)$query->fetch(PDO::FETCH_ASSOC)['sum(amount)'];
}

$_SESSION['financial_balance_summary'] =  $sumOfIncomes - $sumOfExpenses;