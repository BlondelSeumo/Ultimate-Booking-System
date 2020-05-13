$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.bravo_format_money =  function($money) {

    if (!$money) {
        //return bookingCore.free_text;
    }
    //if (typeof bookingCore.booking_currency_precision && bookingCore.booking_currency_precision) {
    //    $money = Math.round($money).toFixed(bookingCore.booking_currency_precision);
    //}

    $money            = bravo_number_format($money, bookingCore.booking_decimals, bookingCore.decimal_separator, bookingCore.thousand_separator);
    var $symbol       = bookingCore.currency_symbol;
    var $money_string = '';

    switch (bookingCore.currency_position) {
        case "right":
            $money_string = $money + $symbol;
            break;
        case "left_space":
            $money_string = $symbol + " " + $money;
            break;

        case "right_space":
            $money_string = $money + " " + $symbol;
            break;
        case "left":
        default:
            $money_string = $symbol + $money;
            break;
    }

    return $money_string;
}

window.bravo_number_format = function (number, decimals, dec_point, thousands_sep) {


    number         = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
    var n          = !isFinite(+number) ? 0 : +number,
        prec       = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep        = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec        = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s          = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s              = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
        .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}

window.bravo_handle_error_response = function(e){
    switch (e.status) {
        case 401:
            // not logged in
            $('#login').modal('show');
            $('.bravo_tour_book_wrap').modal('hide');
            break;
    }
};
// Form validation
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
});
