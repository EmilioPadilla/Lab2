function increase (price, getid, priceid, ivaid) {
  let actual_value = document.getElementById(getid).value;
  parseInt(actual_value);
  actual_value++;
  document.getElementById(getid).value = actual_value;
  let total = price * actual_value;
  let iva = total * .16
  document.getElementById(priceid).innerHTML = "$" + total + ".00 mxn"
  document.getElementById(ivaid).innerHTML = "IVA incluido($" + Math.trunc(iva)  + ".00)";
}

function decrease (price, getid, priceid, ivaid) {
  let actual_value = document.getElementById(getid).value;
  parseInt(actual_value);
  if (actual_value > 0){
    actual_value--;
    document.getElementById(getid).value = actual_value;
  } else {
    actual_value = 0;
    document.getElementById(getid).value = actual_value;
  }
  let total = price * actual_value;
  let iva = total * .16
    document.getElementById(priceid).innerHTML = "$" + (price * actual_value) + ".00 mxn"
    document.getElementById(ivaid).innerHTML = "IVA incluido($" + Math.trunc(iva)  + ".00)";
}

function dios_add () {
  increase(700, 'qtydios', 'dios', 'diosIVA')
}

function dios_rmv() {
  decrease(700, 'qtydios', 'dios', 'diosIVA');
}

function balam_add () {
  increase(690, 'qtybalam', 'balam', 'balamIVA')
}

function balam_rmv() {
  decrease(690, 'qtybalam', 'balam', 'balamIVA')
}

function aguila_add() {
  increase(710, 'qtyaguila', 'aguila', 'aguilaIVA')
}

function aguila_rmv() {
  decrease(710, 'qtyaguila', 'aguila', 'aguilaIVA')
}
