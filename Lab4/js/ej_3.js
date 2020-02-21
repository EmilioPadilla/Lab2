function counter(numArray) {
  var positive = 0, negative = 0, neutral = 0;
  var arrayLength = numArray.length;
  numArray.forEach(function(a){
    if (a < 0) {
      negative++;
    } else if (a === 0){
      neutral++;
    } else {
      positive++;
    }
  });
  return positive + ", " + negative + ", " + neutral;
}


function problemCounter() {
  alert("Se generarán datos de prueba dentro del sistema para comprobar esta funcion!")
  var arr1 = [-1, 1, 2, 3, 4, 5, 0, 0, -2];
  var arr2 = [0, 0, 0, 0, 0, 0, 0, 12, 13, 2, 13, 3, 4, 5, -2, -3, -4, -1];
  var arr1String = arr1.toString();
  var arr2String = arr2.toString();

  document.getElementById("ejercicio1_3").innerHTML = "El primer arreglo es: " + arr1String;
  var result = counter(arr1);
  document.getElementById("respuesta1_3").innerHTML = "Positivos, negativos, neutros: " + result;

  document.getElementById("ejercicio2_3").innerHTML = "El segundo arreglo es: " + arr2String;
  result = counter(arr2);
  document.getElementById("respuesta2_3").innerHTML = "Positivos, negativos, neutros: " + result;
}

//BABEL WAY OF WRITING FUNCTIONS
// var positive = 0, negative = 0, neutral = 0;
// var arrayLength = numArray.length;
// const functions = {
//   counter: {
//     numArray.forEach(function(a){
//       if (a < 0) {
//         negative++;
//       } else if (a === 0){
//         neutral++;
//       } else {
//         positive++;
//       }
//     });
//     return positive + "," + negative + "," + neutral;
//   }
//
// }

module.exports = counter;
