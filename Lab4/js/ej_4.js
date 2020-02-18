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
  var matrix = [[1,2,4,5,7], [1,2,4,3,5], [8,9,7,6,5], [2,5,6,8,0]]
  var stringMatrix = matrix.toString();
  document.getElementById("ejercicio1_4").innerHTML = stringMatrix;
  var result = averageMatrix(matrix).toString()
  document.getElementById("respuesta1_4").innerHTML = result;



}
