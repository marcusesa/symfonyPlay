/**
 * Put the Current Date.
 */

$datenow = $("#date-now");

setInterval(function(){
    dateCurrent()
}, '1000');

var dateCurrent = function(){
    date = new Date();
    $datenow.html(
        $.datepicker.formatDate('dd/M/yy', date).toUpperCase() + ' ' + date.toLocaleTimeString()
    );
}