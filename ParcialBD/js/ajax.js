$(document).ready(function(){
    $('select').formSelect();
});

//Funcion para registrar nuevo incidente
function registrar() {
  console.log("Esta fucnionando");
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("controller_registrar.php", {
        lugar_id: $("#lugar").val(),
        tipo_id: $("#tipo").val()
    }).done(function (data) {
        $("#tablaIncidentes").html(data);
    });
}

$("#registrarIncid").click(registrar);
