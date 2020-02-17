function numberGuess() {
  var startTime, endTime, timeElapsed;
  startTime = new Date();
  var num1 = Math.floor(Math.random() * 11);
  var num2 = Math.floor(Math.random() * 11);
  var result = num1 + num2;
  var guess = prompt("2do Ejercicio: Cual es tu suposición?");


  if (parseInt(guess) === result){
    document.getElementById('ejercicio2').innerHTML = "Brujo! Lo adivinaste";
  } else {
    document.getElementById('ejercicio2').innerHTML = "No lo has adivinado :(";

  }

  document.getElementById("respuesta2").innerHTML = "El numero generado fue " + result;
  endTime = new Date()
  timeElapsed = endTime - startTime;
  timeElapsed /= 1000
  document.getElementById("tiempo2").innerHTML = "Tiempo transcurrido: " + timeElapsed + "s";
}
