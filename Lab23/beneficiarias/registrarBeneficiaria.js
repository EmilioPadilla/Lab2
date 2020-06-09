
function hasNumber(myString) {
  return /\d/.test(myString);
}

function isNullOrWhitespace( input ) {
  return !input || !input.trim();
}

function validarNombres($nombre)
{
  if($nombre.prop("validity").valid && !hasNumber($nombre.val()) && !isNullOrWhitespace($nombre.val()))
  if($nombre.prop("validity").valid & !hasNumber($nombre.val()) & !isNullOrWhitespace($nombre.val()))
  {
    $nombre.addClass("is-valid");
    $nombre.removeClass("is-invalid");
    return true;
  }
  else
  {
    $nombre.addClass("is-invalid");
    return false;
  }
}

function validarSelect($id)
{
  if($id.val() != null && $id.prop("validity").valid)
  if($id.val() != null & $id.prop("validity").valid)
  {
    $id.addClass("is-valid");
    $id.removeClass("is-invalid");
    return true;
  }
  else
  {
    $id.addClass("is-invalid");
    return false;
  }
}

$nombreCompleto = $("#nombreCompleto");
$nombreCompleto.keyup(function (){
  validarNombres($nombreCompleto);
});

$edad = $("#nombreCanalizador");
$nombreCanalizador.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($nombreCanalizador.val() === null | $nombreCanalizador.val() === "")
  { 
    $nombreCanalizador.prop("required", false);
    $nombreCanalizador.removeClass("is-invalid");
    $nombreCanalizador.removeClass("is-valid");
    
  }
  else
  {
    console.log($nombreCanalizador.val());
    $nombreCanalizador.prop("required", true);
    validarNombres($nombreCanalizador);
  }
});

$idMotivoIngreso = $("#motivosIngreso");
$idMotivoIngreso.change(function (){
  validarSelect($idMotivoIngreso);
});

$otroMotivoIngreso = $("#otroMotivoIngreso");
$otroMotivoIngreso.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($otroMotivoIngreso.val() === null | $otroMotivoIngreso.val() === "")
  { 
    $otroMotivoIngreso.prop("required", false);
    $otroMotivoIngreso.removeClass("is-invalid");
    $otroMotivoIngreso.removeClass("is-valid");
    
  }
  else
  {
    console.log($otroMotivoIngreso.val());
    $otroMotivoIngreso.prop("required", true);
    validarNombres($otroMotivoIngreso);
  }
});

$nombreCanalizador = $("#nombreCanalizador");
$nombreCanalizador.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($nombreCanalizador.val() === null | $nombreCanalizador.val() === "")
  { 
    $nombreCanalizador.prop("required", false);
    $nombreCanalizador.removeClass("is-invalid");
    $nombreCanalizador.removeClass("is-valid");
    
  }
  else
  {
    console.log($nombreCanalizador.val());
    $nombreCanalizador.prop("required", true);
    validarNombres($nombreCanalizador);
  }
});

$consideracionesIngreso = $("#consideracionesIngreso");
$consideracionesIngreso.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($consideracionesIngreso.val() === null | $consideracionesIngreso.val() === "")
  { 
    $consideracionesIngreso.prop("required", false);
    $consideracionesIngreso.removeClass("is-invalid");
    $consideracionesIngreso.removeClass("is-valid");
    
  }
  else
  {
    console.log($consideracionesIngreso.val());
    $consideracionesIngreso.prop("required", true);
    validarNombres($consideracionesIngreso);
  }
});

$diagnosticoInt = $("#diagnosticoInt");
$diagnosticoInt.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($diagnosticoInt.val() === null | $diagnosticoInt.val() === "")
  { 
    $diagnosticoInt.prop("required", false);
    $diagnosticoInt.removeClass("is-invalid");
    $diagnosticoInt.removeClass("is-valid");
    
  }
  else
  {
    console.log($diagnosticoInt.val());
    $diagnosticoInt.prop("required", true);
    validarNombres($diagnosticoInt);
  }
});

$diagnosticoMotriz = $("#nombreCanalizador");
$diagnosticoMotriz.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($diagnosticoMotriz.val() === null | $nombreCanalizador.val() === "")
  { 
    $diagnosticoMotriz.prop("required", false);
    $diagnosticoMotriz.removeClass("is-invalid");
    $diagnosticoMotriz.removeClass("is-valid");
    
  }
  else
  {
    console.log($diagnosticoMotriz.val());
    $diagnosticoMotriz.prop("required", true);
    validarNombres($diagnosticoMotriz);
  }
});

$antecedentes = $("#nombreCanalizador");
$nombreCanalizador.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($nombreCanalizador.val() === null | $nombreCanalizador.val() === "")
  { 
    $nombreCanalizador.prop("required", false);
    $nombreCanalizador.removeClass("is-invalid");
    $nombreCanalizador.removeClass("is-valid");
    
  }
  else
  {
    console.log($nombreCanalizador.val());
    $nombreCanalizador.prop("required", true);
    validarNombres($nombreCanalizador);
  }
});

$vinculosFam = $("#nombreCanalizador");
$nombreCanalizador.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($nombreCanalizador.val() === null | $nombreCanalizador.val() === "")
  { 
    $nombreCanalizador.prop("required", false);
    $nombreCanalizador.removeClass("is-invalid");
    $nombreCanalizador.removeClass("is-valid");
    
  }
  else
  {
    console.log($nombreCanalizador.val());
    $nombreCanalizador.prop("required", true);
    validarNombres($nombreCanalizador);
  }
});

$convivencias = $("#nombreCanalizador");
$nombreCanalizador.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($nombreCanalizador.val() === null | $nombreCanalizador.val() === "")
  { 
    $nombreCanalizador.prop("required", false);
    $nombreCanalizador.removeClass("is-invalid");
    $nombreCanalizador.removeClass("is-valid");
    
  }
  else
  {
    console.log($nombreCanalizador.val());
    $nombreCanalizador.prop("required", true);
    validarNombres($nombreCanalizador);
  }
});

$tutela = $("#nombreCanalizador");
$nombreCanalizador.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($nombreCanalizador.val() === null | $nombreCanalizador.val() === "")
  { 
    $nombreCanalizador.prop("required", false);
    $nombreCanalizador.removeClass("is-invalid");
    $nombreCanalizador.removeClass("is-valid");
    
  }
  else
  {
    console.log($nombreCanalizador.val());
    $nombreCanalizador.prop("required", true);
    validarNombres($nombreCanalizador);
  }
});

$situacionJuridica = $("#nombreCanalizador");
$nombreCanalizador.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($nombreCanalizador.val() === null | $nombreCanalizador.val() === "")
  { 
    $nombreCanalizador.prop("required", false);
    $nombreCanalizador.removeClass("is-invalid");
    $nombreCanalizador.removeClass("is-valid");
    
  }
  else
  {
    console.log($nombreCanalizador.val());
    $nombreCanalizador.prop("required", true);
    validarNombres($nombreCanalizador);
  }
});

$idEscolaridad = $("#escolaridad");
$idEscolaridad.change(function (){
  validarSelect($idEscolaridad);
});

$gradoEscolar = $("#nombreCanalizador");
$nombreCanalizador.keyup(function(){
  //si el campo no está vacio verificarlo.
  if($nombreCanalizador.val() === null | $nombreCanalizador.val() === "")
  { 
    $nombreCanalizador.prop("required", false);
    $nombreCanalizador.removeClass("is-invalid");
    $nombreCanalizador.removeClass("is-valid");
    
  }
  else
  {
    console.log($nombreCanalizador.val());
    $nombreCanalizador.prop("required", true);
    validarNombres($nombreCanalizador);
  }
});

function nextDatosIngreso(){
  document.getElementById("datosPersonales").style.opacity = 0;
  document.getElementById("datosPersonales").style.position = "absolute";
  document.getElementById("datosPersonales").style.width = "1%";
  document.getElementById("datosIngreso").style.opacity = 100;
  document.getElementById("datosIngreso").style.position = "relative";
  document.getElementById("datosIngreso").style.width = "100%";

  document.getElementById("progressBar").style.width = "20%"
};

function nextDatosFam(){
  document.getElementById("datosIngreso").style.opacity = 0;
  document.getElementById("datosIngreso").style.position = "absolute";
  document.getElementById("datosIngreso").style.width = "1%";
  document.getElementById("datosFamiliares").style.opacity = 100;
  document.getElementById("datosFamiliares").style.position = "relative";
  document.getElementById("datosFamiliares").style.width = "100%";

  document.getElementById("progressBar").style.width = "40%"
};

function nextDatosAcad(){
  document.getElementById("datosFamiliares").style.opacity = 0;
  document.getElementById("datosFamiliares").style.position = "absolute";
  document.getElementById("datosFamiliares").style.width = "1%";
  document.getElementById("datosAcademicos").style.opacity = 100;
  document.getElementById("datosAcademicos").style.position = "relative";
  document.getElementById("datosAcademicos").style.width = "100%";

  document.getElementById("progressBar").style.width = "60%"
};

function nextArchivos(){
  document.getElementById("datosAcademicos").style.opacity = 0;
  document.getElementById("datosAcademicos").style.position = "absolute";
  document.getElementById("datosAcademicos").style.width = "1%";
  document.getElementById("archivosVarios").style.opacity = 100;
  document.getElementById("archivosVarios").style.position = "relative";
  document.getElementById("archivosVarios").style.width = "100%";

  document.getElementById("progressBar").style.width = "80%"
};

function submitBeneficiarias(idBeneficiaria){

  let valido = true;

  if(!($edad.val() === null | $edad.val() === ""))
  {
    $edad.prop("required", true);

    if(!hasNumber($edad))
      valido = false;
  }

  if(!($otroMotivoIngreso.val() === null | $otroMotivoIngreso.val() === ""))
  {
    $otroMotivoIngreso.prop("required", true);
    
    if(!validarNombres($otroMotivoIngreso))
      valido = false;
  }

  if(!($nombreCanalizador.val() === null | $nombreCanalizador.val() === ""))
  {
    $nombreCanalizador.prop("required", true);
    
    if(!validarNombres($nombreCanalizador))
      valido = false;
  }

  if(!($consideracionesIngreso.val() === null | $consideracionesIngreso.val() === ""))
  {
    $consideracionesIngreso.prop("required", true);
    
    if(!validarNombres($consideracionesIngreso))
      valido = false;
  }

  if(!($diagnosticoMotriz.val() === null | $diagnosticoMotriz.val() === ""))
  {
    $diagnosticoMotriz.prop("required", true);
    
    if(!validarNombres($diagnosticoMotriz))
      valido = false;
  }

  if(!($edadMental.val() === null | $edadMental.val() === ""))
  {
    $edadMental.prop("required", true);
    
    if(!hasNumber($edadMental))
      valido = false;
  }

  if(!($antecedentes.val() === null | $antecedentes.val() === ""))
  {
    $antecedentes.prop("required", true);
    
    if(!validarNombres($antecedentes))
      valido = false;
  }

  if(!($vinculosFam.val() === null | $vinculosFam.val() === ""))
  {
    $vinculosFam.prop("required", true);
    
    if(!validarNombres($vinculosFam))
      valido = false;
  }

  if(!($tutela.val() === null | $tutela.val() === ""))
  {
    $tutela.prop("required", true);
    
    if(!validarNombres($tutela))
      valido = false;
  }

  if(!($situacionJuridica.val() === null | $situacionJuridica.val() === ""))
  {
    $situacionJuridica.prop("required", true);
    
    if(!validarNombres($situacionJuridica))
      valido = false;
  }

  if(!($gradoEscolar.val() === null | $gradoEscolar.val() === ""))
  {
    $gradoEscolar.prop("required", true);
    
    if(!validarNombres($gradoEscolar))
      valido = false;
  }


  if(!valido)
    return;
    
  document.getElementById("archivosVarios").style.opacity = 0;
  document.getElementById("archivosVarios").style.position = "absolute";
  document.getElementById("archivosVarios").style.width = "1%";
  document.getElementById("progressBar").style.width = "100%";
  //esperar a que cargue el progressbar
  setTimeout(function(){$("#"+id).submit()}, 800); 
};

function prevDatosIngreso(){
  document.getElementById("datosIngreso").style.opacity = 0;
  document.getElementById("datosIngreso").style.position = "absolute";
  document.getElementById("datosIngreso").style.width = "1%";
  document.getElementById("datosPersonales").style.opacity = 100;
  document.getElementById("datosPersonales").style.position = "relative";
  document.getElementById("datosPersonales").style.width = "100%";

  document.getElementById("progressBar").style.width = "0%"
};

function prevDatosFam(){
  document.getElementById("datosFamiliares").style.opacity = 0;
  document.getElementById("datosFamiliares").style.position = "absolute";
  document.getElementById("datosFamiliares").style.width = "1%";
  document.getElementById("datosIngreso").style.opacity = 100;
  document.getElementById("datosIngreso").style.position = "relative";
  document.getElementById("datosIngreso").style.width = "100%";

  document.getElementById("progressBar").style.width = "20%";
};

function prevDatosAcad(){
  document.getElementById("datosAcademicos").style.opacity = 0;
  document.getElementById("datosAcademicos").style.position = "absolute";
  document.getElementById("datosAcademicos").style.width = "1%";
  document.getElementById("datosFamiliares").style.opacity = 100;
  document.getElementById("datosFamiliares").style.position = "relative";
  document.getElementById("datosFamiliares").style.width = "100%";

  document.getElementById("progressBar").style.width = "40%";
};

function prevArchivos(){
  document.getElementById("archivosVarios").style.opacity = 0;
  document.getElementById("archivosVarios").style.position = "absolute";
  document.getElementById("archivosVarios").style.width = "1%";
  document.getElementById("datosAcademicos").style.opacity = 100;
  document.getElementById("datosAcademicos").style.position = "relative";
  document.getElementById("datosAcademicos").style.width = "100%";

  document.getElementById("progressBar").style.width = "60%";
};


