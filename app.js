$(document).ready(function () {

    let currentDate = new Date();

    let currentDay = currentDate.getDate();
    let currentMonth = currentDate.getMonth()+1;
    let currentYear = currentDate.getFullYear();

    if(currentDay<10)
        currentDay='0'+currentDay;

    if(currentMonth<10)
        currentMonth='0'+currentMonth;

    $('input#date').val(`${currentYear}-${currentMonth}-${currentDay}`);

    if (typeof google !== 'undefined') {
        // --- Load google charts ---
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Kategoria', 'Wydatek'],
                ['Jedzenie', 540.12],
                ['Mieszkanie', 125.12],
                ['Transport', 65.12],
                ['Telekomunikacja', 63.12],
                ['Opieka zdrowotna', 55.12],
                ['Ubranie', 52.12],
                ['Higiena', 45.12],
                ['Dzieci', 54.12],
                ['Rozrywka', 54.12],
                ['Wycieczka', 54.12],
                ['Szkolenia', 54.12],
                ['Książki', 54.12],
                ['Oszczędności', 54.12],
                ['Na złotą jesień, czyli emeryturę', 54.12],
                ['Spłata długów', 54.12],
                ['Darowizna', 54.12],
                ['Inne wydatki', 54.12]
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {'title': '', 'width': 520, 'height': 400};

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    }
});

