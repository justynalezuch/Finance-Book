<?php
session_start();
// todo: access denied !!

if(isset($_GET['period'])) {
    $_SESSION['period'] = $_GET['period'];

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
elseif ($_POST['start-date'] != '' && $_POST['end-date'] != '') {

    $_SESSION['period'] = 'unstandardized';
    $_SESSION['start_date'] = $_POST['start-date'];
    $_SESSION['end_date'] = $_POST['end-date'];

    if($_POST['end-date'] < $_POST['start-date']) {
        $_SESSION['e_period'] = 'Pierwsza data musi być wcześniejsza lub równa drugiej.';
        header('Location: financial-balance-view.php');
    }

} else {
    $_POST['start-date'] != '' ? $_SESSION['start_date'] = $_POST['start-date'] : '';
    $_POST['end-date'] != '' ?  $_SESSION['end_date'] = $_POST['end-date'] : '';

    $_SESSION['e_period'] = 'Podaj datę początkową oraz końcową.';
    header('Location: financial-balance-view.php');
}

header('Location: financial-balance-view.php');


