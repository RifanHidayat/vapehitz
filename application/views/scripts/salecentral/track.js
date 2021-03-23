var total_biaya = document.getElementById("total_biaya").value;
var total_biaya2 = total_biaya.replaceAll(".", "");
var sub_total = document.getElementById("sub_total" + x).value;
var sub_total2 = sub_total.replaceAll(".", "");
var sub_total3 = sub_total2.toString().replaceAll(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
document.getElementById("sub_total" + x).value = sub_total3;

var hitung_total = parseInt(total_biaya2) - parseInt(sub_total2);
// hitung_total = 67.500 - 67.500 = 0

//----
document.getElementById("total_biaya").value = kurangin2;
if (document.getElementById("jenis_diskon").value == 'persen') {
    diskon2 = (parseInt(diskon2) / 100) * parseInt(total_biaya2);
}
//----

var qty = document.getElementById("qty" + x).value;

var hj_retail = document.getElementById("hj_retail" + x).value;
var hj_retail2 = hj_retail.replaceAll(".", "");
var hj_retail3 = hj_retail2.toString().replaceAll(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
document.getElementById("hj_retail" + x).value = hj_retail3;

var kali = qty * hj_retail2;
// kali = 1 * 225.000
var kali2 = kali.toString().replaceAll(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");

var kurangin = parseInt(hitung_total) + parseInt(kali);
// jurangin = 0 + 225.000
var kurangin2 = kurangin.toString().replaceAll(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
document.getElementById("total_biaya").value = kurangin2;