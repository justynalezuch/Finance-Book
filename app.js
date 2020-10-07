$(document).ready(function () {

    //Add expense/income - remember data in select
    if(document.getElementById('fr_paymentMethod') != null ) {
        if(document.getElementById('fr_paymentMethod').value)
        document.getElementById('paymentMethod').value = document.getElementById('fr_paymentMethod').value;
    }

    if(document.getElementById('fr_category') != null) {
        if(document.getElementById('fr_category').value)
        document.getElementById('category').value = document.getElementById('fr_category').value;
    }

    // Incomes categories - radio input remember data
    if($("input:radio[name=category]") != null) {
        if($("#fr_income_category").val()) {
            let fr_income_category = $("#fr_income_category").val();
            $(`input:radio[name=category][value=${fr_income_category}]`).attr('checked', true);
        } else {
            $("input:radio[name=category]:first").attr('checked', true);
        }
    }

    // Add expense, add income - if isset date - remember it
    if(document.getElementById('date') != null) {
        console.log(document.getElementById('date').value);
        if (document.getElementById('date').value != '') {
            $('input#date').val(document.getElementById('date').value);
        } else {

            let currentDate = new Date();
            let currentDay = currentDate.getDate();
            let currentMonth = currentDate.getMonth() + 1;
            let currentYear = currentDate.getFullYear();

            if (currentDay < 10)
                currentDay = '0' + currentDay;

            if (currentMonth < 10)
                currentMonth = '0' + currentMonth;

            $('input#date').val(`${currentYear}-${currentMonth}-${currentDay}`);
        }
    }

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

