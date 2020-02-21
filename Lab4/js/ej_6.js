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
  forEach((range(k), i) => {
    if (!range_lower_case[i].includes(ascii_letters)){
      ascii_letters + String.fromCharCode(range_lower_case[i]);
    }
  });
  return ascii_letters;
}

function generateN(n, ascii){

}

function generateNewPassword() {
  let askK = prompt("# de letras distintas en tu contraseña?");
  let Kinput = generateK(askK);
  document.getElementById("respuesta1_6").innerHTML = Kinput;

}
