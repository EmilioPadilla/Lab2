function increase (element) {
  let actual_value = document.getElementById("qty").value;
  parseInt(actual_value);
  actual_value++;
  document.getElementById("qty").value = actual_value;
  let total = 710 * actual_value;
  let iva = total * .16
  document.getElementById("aguila").innerHTML = "$" + total + ".00 mxn"
  document.getElementById("aguilaIVA").innerHTML = "IVA incluido($" + Math.trunc(iva)  + ".00)";
}

function decrease (element) {
  let actual_value = document.getElementById("qty").value;
  parseInt(actual_value);
  if (actual_value > 0){
    actual_value--;
    document.getElementById("qty").value = actual_value;
  } else {
    actual_value = 0;
    document.getElementById("qty").value = actual_value;
  }
    document.getElementById("aguila").innerHTML = "$" + (710 * actual_value) + ".00 mxn"
}
