function invertNumber(number){
  number = number + ""; //Convert to string
	return number.split("").reverse().join("");
}

function problemInvertNumber() {
  let usrNumber = prompt("What number do yo want to invert?")
  let reverseNumber = invertNumber(usrNumber);
  // usrNumber = Number(usrNumber);
  document.getElementById("respuesta1_5").innerHTML = reverseNumber;
}

module.exports = invertNumber;
