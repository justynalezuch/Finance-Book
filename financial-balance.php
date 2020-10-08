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

if(isset($_POST['start-date'])) {
    $_SESSION['period'] = 'unstandardized';

//    echo $_POST['start-date'];
    echo $_POST['end-date'] > $_POST['start-date'];

}

header('Location: financial-balance-view.php');

