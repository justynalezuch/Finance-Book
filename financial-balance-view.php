<?php
    session_start();
    if(!isset($_SESSION['logged'])) {
        header('Location: home.php');
        exit();
    }

    $currentURL = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    ?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moje finanse | Finansowy bilans</title>
    <meta name="description" content="Aplikacja Moje Finanse - codzienny przegląd Twoich wydatków">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body class="bg">
    <div class="container mb-5">
         <header>
             <div class="row p-3">
                 <div class="col-6">
                     <div class="logo">
                         moje <span>finanse</span>
                         <svg version="1.1" height="20px" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 179.006 179.006" style="enable-background:new 0 0 179.006 179.006;" xml:space="preserve"><g><g><path style="fill:#010002;" d="M124.759,52.664c0-1.462-0.543-2.572-1.617-3.33c-0.621-0.448-1.665-0.865-3.121-1.265v9.219c1.999-0.09,3.377-0.823,4.135-2.19C124.562,54.406,124.759,53.582,124.759,52.664z"/><path style="fill:#010002;" d="M118.362,36.213c-1.551,0.06-2.637,0.525-3.3,1.402c-0.662,0.877-0.985,1.796-0.985,2.751c0,1.158,0.382,2.059,1.152,2.721c0.782,0.65,1.82,1.11,3.121,1.366L118.362,36.213L118.362,36.213z"/><path style="fill:#010002;" d="M119.174,67.42c11.128,0,20.162-9.022,20.162-20.15s-9.034-20.156-20.162-20.156s-20.15,9.028-20.15,20.156C99.023,58.404,108.039,67.42,119.174,67.42z M112.753,45.247c-1.211-1.122-1.826-2.679-1.826-4.666c0-1.778,0.644-3.377,1.951-4.803c1.307-1.426,3.121-2.154,5.484-2.172v-2.333h1.659v2.297c2.333,0.161,4.111,0.847,5.358,2.053c1.235,1.211,1.886,2.798,1.945,4.785h-3.067c-0.084-0.889-0.328-1.653-0.722-2.297c-0.734-1.181-1.909-1.802-3.532-1.856v8.539c2.715,0.758,4.559,1.474,5.537,2.136c1.575,1.098,2.363,2.727,2.363,4.875c0,3.109-1.014,5.316-3.037,6.629c-1.122,0.728-2.739,1.205-4.851,1.438v3.401h-1.659v-3.401c-3.395-0.221-5.71-1.426-6.928-3.61c-0.662-1.175-0.996-2.775-0.996-4.785h3.109c0.101,1.599,0.352,2.769,0.758,3.509c0.722,1.319,2.088,2.059,4.069,2.226v-9.553C115.82,47.174,113.953,46.369,112.753,45.247z"/><path style="fill:#010002;" d="M84.655,19.16c0-1.092-0.406-1.927-1.211-2.5c-0.465-0.334-1.247-0.644-2.345-0.949v6.916c1.492-0.066,2.542-0.615,3.109-1.641C84.5,20.466,84.655,19.858,84.655,19.16z"/><path style="fill:#010002;" d="M79.852,6.832c-1.164,0.048-1.981,0.394-2.476,1.056c-0.489,0.656-0.74,1.349-0.74,2.065c0,0.871,0.292,1.545,0.871,2.041c0.579,0.489,1.36,0.835,2.345,1.026L79.852,6.832L79.852,6.832z"/><path style="fill:#010002;" d="M80.455,30.234c8.342,0,15.114-6.772,15.114-15.12S88.796,0,80.455,0S65.34,6.766,65.34,15.114C65.34,23.468,72.113,30.234,80.455,30.234z M75.639,13.598c-0.913-0.841-1.366-2.005-1.366-3.497c0-1.331,0.489-2.536,1.468-3.604c0.979-1.068,2.351-1.617,4.105-1.629V3.121h1.247v1.724c1.742,0.125,3.085,0.632,4.028,1.539c0.925,0.907,1.414,2.1,1.456,3.586h-2.303c-0.066-0.662-0.239-1.241-0.537-1.724c-0.567-0.883-1.438-1.349-2.643-1.39v6.402c2.035,0.567,3.407,1.104,4.141,1.605c1.175,0.823,1.772,2.041,1.772,3.658c0,2.333-0.758,3.986-2.273,4.97c-0.841,0.543-2.053,0.901-3.64,1.08v2.554h-1.247v-2.554c-2.554-0.167-4.29-1.068-5.191-2.709c-0.501-0.883-0.758-2.082-0.758-3.592h2.345c0.066,1.199,0.257,2.076,0.561,2.631c0.549,0.991,1.569,1.545,3.055,1.671v-7.166C77.948,15.042,76.54,14.44,75.639,13.598z"/><path style="fill:#010002;" d="M70.114,86.412c-3.341-0.579-5.734-2.005-7.071-4.392c-0.871-1.522-1.295-3.586-1.295-6.188h4.01c0.125,2.071,0.465,3.58,0.991,4.535c0.937,1.712,2.685,2.667,5.245,2.882V70.892c-3.276-0.621-5.698-1.653-7.262-3.103c-1.569-1.456-2.351-3.467-2.351-6.033c0-2.297,0.847-4.362,2.524-6.212c1.689-1.838,4.046-2.775,7.089-2.81v-3.013h2.154v2.971c3.007,0.215,5.316,1.098,6.916,2.655c1.617,1.563,2.458,3.622,2.536,6.182h-3.962c-0.113-1.146-0.418-2.136-0.931-2.971c-0.955-1.522-2.47-2.327-4.559-2.399v11.039c3.509,0.985,5.877,1.909,7.136,2.763c2.047,1.42,3.061,3.52,3.061,6.301c0,4.022-1.307,6.874-3.914,8.568c-1.08,0.692-2.619,1.152-4.415,1.498c5.221,0.179,10.418,1.02,15.43,2.53c4.732-4.726,7.667-11.248,7.667-18.461c0-14.392-11.677-26.057-26.057-26.057c-14.386,0-26.057,11.665-26.057,26.057c0,7.435,3.121,14.124,8.121,18.867C59.976,87.683,65.024,86.734,70.114,86.412z"/><path style="fill:#010002;" d="M67.978,65.009c0.991,0.847,2.345,1.438,4.034,1.772V56.124c-1.993,0.078-3.419,0.68-4.266,1.814c-0.853,1.134-1.271,2.321-1.271,3.562C66.474,62.992,66.975,64.156,67.978,65.009z"/><path style="fill:#010002;" d="M78.193,73.076c-0.806-0.573-2.142-1.116-4.04-1.629v11.922c2.584-0.125,4.362-1.068,5.346-2.834c0.519-0.907,0.776-1.963,0.776-3.151C80.276,75.487,79.583,74.061,78.193,73.076z"/><path style="fill:#010002;" d="M162.398,138.849c3.18-3.324,3.473-9.475,2.954-17.704c-3.741-0.257-9.261,0.37-11.212,0c-4.738-9.428-11.546-16.779-21.242-21.248c0.328-6.152,1.152-11.808,4.708-14.75c-8.646-0.597-15.979,5.257-20.639,10.621c-4.195-4.35-10.394-7.817-17.704-10.257l-4.541,8.079c-13.515-4.66-28.343-4.606-41.774,0.137l-5.925-7.96c-0.012-0.024-0.036-0.048-0.054-0.066c-9.267,3.067-17.781,7.87-24.416,14.786c-4.314-0.328-3.825-9.076,1.772-7.667c-9.105-6.206-14.13,10.806-5.316,12.978c-7.345,10.496-8.049,33.027,1.772,41.297c1.432,12.423,3.628,24.088,9.672,31.911h19.822c-0.519-4.034-1.044-8.33-0.591-13.032c12.047,2.733,26.35,3.532,40.7,2.363c2.214,3.67,4.356,7.411,7.005,10.663h19.637c-0.71-5.197-1.504-10.639-0.084-15.979C121.668,162.132,145.971,155.956,162.398,138.849z M135.308,112.505c2.697,0,4.875,2.184,4.875,4.869c0,2.703-2.178,4.881-4.875,4.881c-2.685,0-4.875-2.19-4.875-4.881C130.427,114.695,132.623,112.505,135.308,112.505z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                     </div>
                 </div>
                 <div class="col-6 p-2 text-right">
                     Zalogowano jako: <strong><?php echo $_SESSION['username']?></strong>
                 </div>
             </div>
             <div class="row">
                 <div class="col-12 text-center menu-bg">
                     <nav class="navbar navbar-expand-lg navbar-light">
                         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                             <span class="navbar-toggler-icon"></span>
                         </button>
                         <div class="collapse navbar-collapse" id="navbarToggler">
                             <ul class="navbar-nav justify-content-center w-100">
                                 <li class="nav-item">
                                     <a class="nav-link" href="home.php">
                                         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                             <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                                             <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                                         </svg>
                                         Strona główna
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="add-income-view.php">
                                         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-graph-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M0 0h1v16H0V0zm1 15h15v1H1v-1z"/>
                                             <path fill-rule="evenodd" d="M14.39 4.312L10.041 9.75 7 6.707l-3.646 3.647-.708-.708L7 5.293 9.959 8.25l3.65-4.563.781.624z"/>
                                             <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4h-3.5a.5.5 0 0 1-.5-.5z"/>
                                         </svg>
                                         Dodaj przychód
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="add-expense-view.php">
                                         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-graph-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M0 0h1v16H0V0zm1 15h15v1H1v-1z"/>
                                             <path fill-rule="evenodd" d="M14.39 9.041l-4.349-5.436L7 6.646 3.354 3l-.708.707L7 8.061l2.959-2.959 3.65 4.564.781-.625z"/>
                                             <path fill-rule="evenodd" d="M10 9.854a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-1 0v3.5h-3.5a.5.5 0 0 0-.5.5z"/>
                                         </svg>
                                         Dodaj wydatek
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link active" href="financial-balance-view.php">
                                         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                             <path fill-rule="evenodd" d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5h-2v12h2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                                             <path fill-rule="evenodd" d="M0 14.5a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                                         </svg>
                                         Przeglądaj bilans
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="#">
                                         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wrench" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                             <path fill-rule="evenodd" d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364L.102 2.223zm13.37 9.019L13 11l-.471.242-.529.026-.287.445-.445.287-.026.529L11 13l.242.471.026.529.445.287.287.445.529.026L13 15l.471-.242.529-.026.287-.445.445-.287.026-.529L15 13l-.242-.471-.026-.529-.445-.287-.287-.445-.529-.026z"/>
                                         </svg>
                                         Ustawienia
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="logout.php">
                                         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                             <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                             <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                                             <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                                         </svg>
                                         Wyloguj się
                                     </a>
                                 </li>
                             </ul>

                             <!--                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">-->
                             <!--                        <li class="nav-item active">-->
                             <!--                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
                             <!--                        </li>-->
                             <!--                        <li class="nav-item">-->
                             <!--                            <a class="nav-link" href="#">Link</a>-->
                             <!--                        </li>-->
                             <!--                  -->
                             <!--                    </ul>-->
                         </div>
                     </nav>
                 </div>
             </div>
         </header>
        <main class="balance">
            <div class="row p-3 border-bottom">
                <div class="col-md-6">
                    <h1>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5h-2v12h2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"></path>
                            <path fill-rule="evenodd" d="M0 14.5a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"></path>
                        </svg>
                        Finansowy bilans</h1>
                    <p class="text-secondary">Okres: <strong>bieżący miesiąc</strong></p>
                </div>
                <div class="col-md-6 text-right pt-2">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="financial-balance.php?period=current-month" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Bieżący miesiąc
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item active" href="financial-balance.php?period=current-month">Bieżący miesiąc</a>
                            <a class="dropdown-item" href="financial-balance.php?period=last-month">Poprzedni miesiąc</a>
                            <a class="dropdown-item" href="financial-balance.php?period=current-year">Bieżący rok</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#nonStandardPeriod">Niestandardowy</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center py-4">
                <div class="col-lg-5 col-md-6">
                    <h2>Przychody</h2>

                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Kwota (PLN)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Wynagrodzenie</td>
                            <td>2424.45</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Odsetki bankowe</td>
                            <td>522.43</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Sprzedaż na allegro</td>
                            <td>123.01</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Inne</td>
                            <td>123.00</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center py-4">
                <div class="col-lg-5 col-md-6">
                    <h2>Wydatki</h2>
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Kwota (PLN)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Jedzenie</td>
                            <td>1540.12</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Mieszkanie</td>
                            <td>1125.12</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Transport</td>
                            <td>65.12</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Telekomunikacja</td>
                            <td>63.12</td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Opieka zdrowotna</td>
                            <td>55.12</td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>Ubranie</td>
                            <td>52.12</td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>Higiena</td>
                            <td>45.12</td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td>Dzieci</td>
                            <td>54.12</td>
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td>Rozrywka</td>
                            <td>54.12</td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td>Wycieczka</td>
                            <td>54.12</td>
                        </tr>
                        <tr>
                            <td>11.</td>
                            <td>Szkolenia</td>
                            <td>54.12</td>
                        </tr>
                        <tr>
                            <td>12.</td>
                            <td>Książki</td>
                            <td>54.12</td>
                        </tr>
                        <tr>
                            <td>13.</td>
                            <td>Oszczędności</td>
                            <td>54.12</td>
                        </tr>
                        <tr>
                            <td>14.</td>
                            <td>Naotą jesień, czyli emeryturę</td>
                            <td>54.12</td>
                        </tr>
                        <tr>
                            <td>15.</td>
                            <td>Spłata długów</td>
                            <td>54.12</td>
                        </tr>
                        <tr>
                            <td>16.</td>
                            <td>Darowizna</td>
                            <td>54.12</td>
                        </tr>
                        <tr>
                            <td>17.</td>
                            <td>Inne wydatki</td>
                            <td>54.12</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center border-bottom">
                <div id="piechart"></div>
            </div>
            <div class="row justify-content-center py-4">
                <div class="col-md-6 text-center">
                    <h2>Twój finasowy bilans:</h2>
                    <p class="text-success summary">245&nbsp;PLN</p>
                    <p class="text-success">
                        Gratulacje! Świetnie zarządzasz finansami!
                    </p>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="nonStandardPeriod" tabindex="-1" aria-labelledby="nonStandardPeriodLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nonStandardPeriodLabel">Wybierz zakres dat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="financial-balance.php">
                    <div class="modal-body">
                        <form method="post" action="financial-balance.php">
                            <div class="form-group">
                                <label for="start-date">Data początkowa</label>
                                <input class="form-control" type="date" name="start-date" id="start-date">
                            </div>
                            <div class="form-group">
                                <label for="end-date">Data końcowa</label>
                                <input class="form-control" type="date" name="end-date" id="end-date">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <a data-dismiss="modal">Zamknij</a>
                        <button type="submit" class="btn btn-primary ml-2">Zatwierdź</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="app.js"></script>
    <script>
    </script>
</body>
</html>