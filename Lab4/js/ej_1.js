function createTable() {
  var num_limit = prompt("1er Ejercicio: Escribe un numero")
  // CREATE DYNAMIC TABLE.
  var table = document.createElement('table');

  var arrHead = new Array();
  arrHead = ['x', 'x^2', 'x^3'];

  var arrValue = new Array();
  var count = 1;
  while (count <= num_limit) {
    arrValue.push([count, Math.pow(count, 2), Math.pow(count, 3)]);
    count++;
  }

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
  document.getElementById('ejercicio1').appendChild(table);
}
