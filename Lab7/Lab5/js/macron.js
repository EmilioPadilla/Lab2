function computeBMI() {
    // user inputs
    let height = Number(document.getElementById("altura").value);
    let weight = Number(document.getElementById("peso").value);
    let name = document.getElementById("name").value

    var BMI = weight / Math.pow((height/100), 2);

    //Display result of calculation
    document.getElementById("bmi").innerText = name + ": tu Indice de Masa Corporal es " + Math.round(BMI)

    if (BMI < 18.5) document.getElementById("suggest").innerText = "Te recomendamos bajar de peso";
    else if (BMI >= 18.5 && BMI <= 25)
        document.getElementById("suggest").innerText = "Estas en tu peso";
    else if (BMI >= 25 && BMI <= 30)
        document.getElementById("suggest").innerText = "Poquito pasado (Obesidad)";
    else if (BMI > 30)
        document.getElementById("suggest").innerText = "Ta cañon... Sobrepeso";
    // document.getElementById("answer").value = output;

}
