// Checks
// function check_password(password) {
  let contrasena = document.getElementById("psw");
  let valpsw = document.getElementById("valpassword");
  let lengthpass = document.getElementById("lengthpassid");
  let mayus = document.getElementById("mayusid");
  let minus = document.getElementById("minusid");
  let number = document.getElementById("numberid");
  let special = document.getElementById("specialid");


  let num_check = /[0-9]/;
  let low_check = /[a-z]/;
  let mayus_check = /[A-Z]/;
  let special_check = /[!@#$%^&*]/;
  let val1 = val2 = val3 = val4 = val5 = false;
  let compare = false;

  contrasena.onkeyup = function() {
    if (contrasena.value.match(num_check)) {
      number.classList.remove("red-text")
      number.classList.add("green-text")
      val1 = true;
    } else {
      number.classList.remove("green-text")
      number.classList.add("red-text")
      val1 = false;
    }

    if (contrasena.value.match(low_check)) {
      minus.classList.remove("red-text")
      minus.classList.add("green-text")
      val2 = true;
    } else {
      minus.classList.remove("green-text")
      minus.classList.add("red-text")
      val2 = false;
    }

    if (contrasena.value.match(mayus_check)) {
      mayus.classList.remove("red-text")
      mayus.classList.add("green-text")
      val3 = true;
    } else {
      mayus.classList.remove("green-text")
      mayus.classList.add("red-text")
      val3 = false;
    }

    if (contrasena.value.match(special_check)) {
      special.classList.remove("red-text")
      special.classList.add("green-text")
      val4 = true;
    } else {
      special.classList.remove("green-text")
      special.classList.add("red-text")
      val4 = false;
    }

    if (contrasena.value.length >= 8) {
      lengthpass.classList.remove("red-text")
      lengthpass.classList.add("green-text")
      val5 = true
    } else {
      lengthpass.classList.remove("green-text")
      lengthpass.classList.add("red-text")
      val5 = false;
    }

    if (val1 && val2 && val3 && val4 && val5) {
      document.getElementById("psw_valid").style.display = 'block';
    } else {
      document.getElementById("psw_valid").style.display = "none";
    }

  }


valpsw.onkeyup = function() {
  if (document.getElementById('valpassword').value === document.getElementById('psw').value) {
    document.getElementById("psw_match").style.display = 'block';
  } else {
    document.getElementById("psw_match").style.display = 'none';
  }
}


// }

if (!val1 && !val2 && !val3 && !val4 && !val5) {
  document.getElementById("psw_valid").style.display = "none";
  document.getElementById("psw_match").style.display = "none";
}
if (!compare) {
  document.getElementById("psw_match").style.display = "none";
}
