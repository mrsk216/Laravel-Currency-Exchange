$(document).ready(function(){    
    //swap currency
    $("#reverse").click(function(){
        let fromCurrency = $("#from").val();
        let toCurrency = $("#to").val();
        $("#from").val(toCurrency);
        $("#to").val(fromCurrency);
        exchange($("#from").val(), $("#to").val());
    });

    //Exchange Currency
    $("#amount").on('input', function () {
        exchange($("#from").val(), $("#to").val());
    });
    $("#from,#to").change(function () {
        exchange($("#from").val(), $("#to").val());
    });

    function exchange(fromCurrency, toCurrency) {
        let amount = $("#amount").val();
        $.ajax({
            url: "/exchange",
            method: "post",
            data: {
                amount: amount,
                fromCurrency: fromCurrency,
                toCurrency: toCurrency,
            },
            success: function (response) {
                $("#rate").val(response);
            },
            error: function (err) {
                $("#error").text(err);
            },
        });
    }
});