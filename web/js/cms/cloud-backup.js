var storageslider = document.getElementById('storageAmount');
var storageoutput = document.getElementById('theStorage');
var serverslider = document.getElementById('serverRange');
var serveroutput = document.getElementById('theServer');
var priceoutput = document.getElementById('thePrice');
serveroutput.innerHTML = serverslider.value;
var storagesliderdata = storageslider.value;
storageoutput.innerHTML = storagesliderdata;
priceoutput.innerHTML =  serverslider.value + storageslider.value;
var serversliderprice = 3.50;
var storagesliderpriceunder5 = 3.80;
var storagesliderpriceover5 = 2.60;
var storagesliderpriceover15 = 1.80;


storageslider.oninput = function() {
    storageoutput.innerHTML = this.value;
    pricecalculator();
}



/*
serverslider.oninput = function() {
    serveroutput.innerHTML = this.value;


    var serversliderergebnis= Number(serverslider.value) * Number(3.5);

    var ergebnis = (Number(serversliderergebnis) + Number(storageslider.value));

    priceoutput.innerHTML =  ergebnis;



}*/

serverslider.oninput = function() {
    serveroutput.innerHTML = this.value;
    pricecalculator();
}
storageslider.oninput = function() {
    storageoutput.innerHTML = this.value;
    pricecalculator();
}
function pricecalculator() {

    let n = 0;
    var storagesliderpriceunder=0;
    var storagesliderprice=0;
    //var serversliderergebnis= Number(serverslider.value) * Number(serversliderprice);


    while (n < Number(storageslider.value) *100 ) {

        if(storageslider.value <= 5){
            storagesliderpriceunder =Number(storageslider.value) *10 * Number(storagesliderpriceunder5);
        } else if (storageslider.value > 5) {
            if(storageslider.value <= 15){
                storagesliderprice = 60+ Number(storageslider.value) *10 * Number(storagesliderpriceover5);

            }else if (storageslider.value > 15) {

                storagesliderprice = 180+ Number(storageslider.value) *10 * Number(storagesliderpriceover15);

            }

        }
        n++;
    }

    var storagesliderergebnis= Number(storageslider.value) * Number(serversliderprice);


   // priceoutput.innerHTML =  (Number(serversliderergebnis ) + Number(storagesliderprice));
    priceoutput.innerHTML =  Number(storagesliderpriceunder+storagesliderprice + serversliderprice *Number(serverslider.value)).toFixed(2);



}