<?php
session_start();

if(!isset($_SESSION['logged']) && !$_SESSION['logged'] == true ) {
    header('Location: home.php');
    exit();
}

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

    $_SESSION['e_unstandardized_period'] = false;

    if(!preg_match("/^\d{4}-\d{2}-\d{2}$/" , $_POST['start-date']) || !preg_match("/^\d{4}-\d{2}-\d{2}$/" , $_POST['end-date'])) {

        $_SESSION['e_period'] = 'Wprowadź daty w poprawnym formacie.';
        $_SESSION['e_unstandardized_period'] = true;
        header('Location: financial-balance-view.php');
    }

    if($_POST['end-date'] < $_POST['start-date']) {

        $_SESSION['e_period'] = 'Pierwsza data musi być wcześniejsza lub równa drugiej.';
        $_SESSION['e_unstandardized_period'] = true;
        header('Location: financial-balance-view.php');
    }

    if($_SESSION['e_unstandardized_period'] == false) {
        $_SESSION['period'] = 'unstandardized';
        $_SESSION['start_date'] = $_POST['start-date'];
        $_SESSION['end_date'] = $_POST['end-date'];
    }

} else {
    $_POST['start-date'] != '' ? $_SESSION['start_date'] = $_POST['start-date'] : '';
    $_POST['end-date'] != '' ?  $_SESSION['end_date'] = $_POST['end-date'] : '';

    $_SESSION['e_period'] = 'Podaj datę początkową oraz końcową.';
    header('Location: financial-balance-view.php');
}

header('Location: financial-balance-view.php');


