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

    // --------- FINANCIAL BALANCE ---------

    if(document.getElementById('startDate') != null) {
        console.log(document.getElementById('startDate').value);
        if (document.getElementById('startDate').value != '') {
            $('input#date').val(document.getElementById('startDate').value);
        }
    }
    if(document.getElementById('endDate') != null) {
        console.log(document.getElementById('endDate').value);
        if (document.getElementById('endDate').value != '') {
            $('input#date').val(document.getElementById('endDate').value);
        }
    }

    if(document.getElementById('periodError') != null){
        $('#unstandardizedPeriod').modal('show');
    }
});


