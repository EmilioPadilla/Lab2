function averageMatrix(matrix) {
  var resultMatrix = [];
  matrix.forEach(function(valueI, i) {
      var indexJAvg = [];
      var indexJSum = 0, lastValueJ = 0, average = 0;

      valueI.forEach(function(valueJ, j) {
        indexJSum += valueJ;
        lastValueJ = j;
      });

      average = indexJSum/(lastValueJ+1);
      resultMatrix.push(average)
  });
  return resultMatrix;
}

function problemAverageMatrix () {
  let matrix = [[1,2,4,5,7], [1,2,4,3,5], [8,9,7,6,5], [2,5,6,8,0]]
  let matrix2 = [[10,9,8,7,6], [6,5,4,3,2], [1,3,5,7,9], [2,4,6,8,10]]
  let stringMatrix = matrix.toString();
  document.getElementById("ejercicio1_4").innerHTML = "Matriz a sumar: " + stringMatrix;
  var result = averageMatrix(matrix).toString()
  document.getElementById("respuesta1_4").innerHTML = "R: " + result;

  stringMatrix = matrix2.toString();
  document.getElementById("ejercicio2_4").innerHTML = "Matriz a sumar: " + stringMatrix;
  result = averageMatrix(matrix2)
  document.getElementById("respuesta2_4").innerHTML = "R: " + result;;
}

module.exports = averageMatrix;
