<?php

if(isset($_GET['period'])) {
    $period = $_GET['period'];
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
//    echo $_POST['start-date'];
    echo $_POST['end-date'] > $_POST['start-date'];

}

