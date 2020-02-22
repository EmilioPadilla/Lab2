//Define las diferentes posibles letras minusculuas de la contraseña
function range(start, stop, step) {
    if (typeof stop == 'undefined') {
        // one param defined
        stop = start;
        start = 0;
    }
    if (typeof step == 'undefined') {
      // two param defined
        step = 1;
    }
    if ((step > 0 && start >= stop) || (step < 0 && start <= stop)) {
      // param don't make sense
        return [];
    }

    var result = [];
    for (var i = start; step > 0 ? i < stop : i > stop; i += step) {
        result.push(i);
    }
    return result;
};

function generateK(k){
  ascii_letters = []
  range_lower_case = range(97, 123);
  range(k).forEach(function(i) {
    if (!(ascii_letters.includes(range_lower_case[i]))){
      ascii_letters += String.fromCharCode(range_lower_case[i]);
    }
  });
  return ascii_letters;
}

function generateN(n, ascii){
  let n_password = ""
  range(n).forEach(function(i) {
    let k = i%ascii.length;
    n_password += ascii[k];
  });
  return n_password;
}

function generateNewPassword() {
  let ask_k = prompt("# de letras distintas en tu contraseña?");
  let ask_n = prompt("# de letras de longitud de tu contraseña?");
  let password = "";
  if (ask_n >= ask_k){
    let k_result = generateK(ask_k);
    password = generateN(ask_n, k_result);
  }

  document.getElementById("respuesta1_6").innerHTML = password;

}
