//SEND REQUEST PARA BUSQUEDA POR NOMBRE 
function sendRequest(tabla)
{
  $userInput = $("#userInput"+tabla);
  $ajaxResponse = $("#ajaxResponse"+tabla);
  $.get("ssajaxBeneficiarias.php",{
    Tabla: tabla,
    pattern: $userInput.val()
  }).done(function (data) {
    
    $ajaxResponse.html(data);
    $ajaxResponse.css("visibility","visible");
  });
}

// SEND REQUEST PARA BUSQUEDA POR DI
function sendRequestD(tabla)
{
  $userInput = $("#userInput_"+tabla);
  $ajaxResponse = $("#ajaxResponse_"+tabla);
  $.get("ssajax.php",{
    Tabla: tabla,
    pattern: $userInput.val()
  }).done(function (data) {
    $ajaxResponse.html(data);
    $ajaxResponse.css("visibility","visible");
  });
}

// SELECT VALUE PARA NOMBRES 
function selectValue(tabla)
{ 
  let list = document.getElementById("list");
  let userInput = document.getElementById("userInput"+tabla);
  let input = document.getElementById(tabla);
  let ajaxResponse = document.getElementById("ajaxResponse"+tabla);
  userInput.value = list.options[list.selectedIndex].text;
  input.value = list.options[list.selectedIndex].value;
  console.log(input.value);
  ajaxResponse.style.visibility = "hidden";
  $("#ajaxResponse"+tabla).empty();
  userInput.focus();
  buscarBeneficiarias(false);
  buscarBeneficiariasEgresadas(false);
}

// SELECT VALUE PARA DI 
function selectValueD(tabla)
{ 
  let list = document.getElementById("list");
  let userInput = document.getElementById("userInput_"+tabla);
  let input = document.getElementById("_" + tabla);
  let ajaxResponse = document.getElementById("ajaxResponse_"+tabla);
  userInput.value = list.options[list.selectedIndex].text;
  input.value = list.options[list.selectedIndex].value;
  console.log(input.value);
  ajaxResponse.style.visibility = "hidden";
  $("#ajaxResponse_"+tabla).empty();
  userInput.focus();
  buscarBeneficiarias(false);
}


function buscarBeneficiarias(reset)
{
  $.post("controlador_busquedaBeneficiarias.php", {
    beneficiarias: $("#beneficiarias").val(),
    motivosIngreso: $("#motivosIngreso").val(),
  }).done(function (data) {
    $("#resultados_consulta").html(data);
    if(reset)
    {
      $("#beneficiarias").val("");
      $("#userInputbeneficiarias").val("");
      $("#motivosIngreso").val("");
    }
  });
}

function buscarBeneficiariasEgresadas(reset)
{
  $.post("controlador_busquedaBeneficiariasInactivas.php", {
    beneficiarias: $("#beneficiarias").val(),
    motivosEgreso: $("#motivosEgreso").val(),
    destinos: $("#destinos").val(),
  }).done(function (data) {
    $("#resultados_consultaEgreso").html(data);
    if(reset)
    {
      $("#beneficiarias").val("");
      $("#userInputbeneficiarias").val("");
      $("#motivosEgreso").val("");
      $("#destinos").val("");
    }
  });
}


//LIMPIAR LA BUSQUEDA 
$("#buscar").click(function(){
  $("#beneficiarias").val("");
  $("#_beneficiarias").val("");
  $("#userInputbeneficiarias").val("");
  $("#userInput_beneficiarias").val("");
  $("#motivosIngreso").val("");
  $("#motivosEgreso").val("");
  $("#destinos").val("");
  buscarBeneficiarias(true);
  buscarBeneficiariasEgresadas(true);
});

//BUSCAR ACTIVAS POR MOTIVO DE INGRESO
$("#motivosIngreso").change(function(){
  buscarBeneficiarias(false);
});

//BUSCAR INACTIVAS POR MOTIVO DE EGRESO
$("#motivosEgreso").change(function(){
  buscarBeneficiariasEgresadas(false);
});

//BUSCAR INACTIVAS POR MOTIVO DE EGRESO
$("#destinos").change(function(){
  buscarBeneficiariasEgresadas(false);
});


