
function sendRequest(tabla)
{
	$userInput = $("#userInput_"+tabla);
	$ajaxResponse = $("#ajaxResponse_"+tabla);

	$.get("../controladores/donantes/controlador_ajaxDonantes.php",{
		Tabla: tabla,
		pattern: $userInput.val()
	}).done(function (data) {

		$ajaxResponse.html(data);
		$ajaxResponse.css("visibility","visible");
	});
}

function selectValue(tabla)
{
	let list = document.getElementById("list");
	let userInput = document.getElementById("userInput_"+tabla);
	let input = document.getElementById(tabla);
	let ajaxResponse = document.getElementById("ajaxResponse_"+tabla);
	userInput.value = list.options[list.selectedIndex].text;
	input.value = list.options[list.selectedIndex].value;
	console.log(input.value);
	ajaxResponse.style.visibility = "hidden";
	$("#ajaxResponse_"+tabla).empty();
	userInput.focus();
	buscarDonantes(false);
}

/*
	busqueda por ajax de donantes
	--------------------------------------
*/
function buscarDonantes(reset)
{
	$.post("../controladores/donantes/controlador_buscarDonante.php", {
		donantes: $("#donantes").val(),
		tipodeDonante: $("#tipodeDonante").val(),
	}).done(function (data) {
		$("#resultados_consulta").html(data);
		if(reset)
		{
			$("#donantes").val("");
			$("#userInput_donantes").val("");
			$("#tipodeDonante").val("");
		}
	});
}

$("#buscar").click(function(){
	$("#donantes").val("");
	$("#userInput_donantes").val("");
	$("#tipodeDonante").val("");
	buscarDonantes(true);
});

$("#tipodeDonante").change(function(){
	buscarDonantes(false);
});
//------------------------------

//------------------------------
//------Botones de prueba-------
//------------------------------
function siguientePrueba() {
	$.get("controller_registro.php", {
		btnprueba : "mas",
		seccion : $("#seccionActual").val(),
		contadorAct : $("#contadorAct").val()

	}).done(function (data) {
			$("#tablaPrueba").html(data);
	});
}

function anteriorPrueba() {
	$.get("controller_registro.php", {
		btnprueba : "menos",
		seccion : $("#seccionActual").val(),
		contadorAct : $("#contadorAct").val()

	}).done(function (data) {
			$("#tablaPrueba").html(data);
	});
}

$("#sigPrueba").click(siguientePrueba);
$("#antPrueba").click(anteriorPrueba);



//------------------------------
//--Valor de prueba input radio-
//------------------------------
function getValorRadio(idboton) {
	return $("#idboton").val();
}
