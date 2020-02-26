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


function createTable(art, talla, cantidad, precio) {
  // CREATE DYNAMIC TABLE.
  var table = document.createElement('table');

  var arrHead = new Array();
  arrHead = ['Articulo', 'Talla', 'Cantidad', 'Precio'];

  var arrValue = new Array();
  arrValue.push([art, talla, cantidad, precio]);

  var tr = table.insertRow(-1);

  for (var h = 0; h < arrHead.length; h++) {
      var th = document.createElement('th');              // TABLE HEADER.
      th.innerHTML = arrHead[h];
      tr.appendChild(th);
  }

  for (var c = 0; c <= arrValue.length - 1; c++) {
      tr = table.insertRow(-1);

      for (var j = 0; j < arrHead.length; j++) {
          var td = document.createElement('td');          // TABLE DEFINITION.
          td = tr.insertCell(-1);
          td.innerHTML = arrValue[c][j];                  // ADD VALUES TO EACH CELL.
      }
  }
  document.getElementById('cart_section').appendChild(table);
}

function sum_cart() {
  // document.getElementById().
}

function update_cart(art_name, talla, qty, precio) {
  createTable(document.getElementById(art_name).textContent, document.getElementById(talla).value, document.getElementById(qty).value, document.getElementById(precio).textContent);
}

function cart_aguila() {
  update_cart('art_name_aguila', "dios_talla", 'qtyaguila', 'aguila')
}

function cart_balam() {
  update_cart('art_name_balam', "balam_talla", 'qtybalam', 'balam')
}

function cart_dios() {
  update_cart('art_name_dios', "aguila_talla", 'qtydios', 'dios')
}
