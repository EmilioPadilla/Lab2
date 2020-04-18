//Función para crear el objeto para realizar una petición asíncrona
function getRequestObject() {
    // Asynchronous objec created, handles browser DOM differences
    if (window.XMLHttpRequest) {
        // Mozilla, Opera, Safari, Chrome IE 7+
        return (new XMLHttpRequest());
    } else if (window.ActiveXObject) {
        // IE 6-
        return (new ActiveXObject("Microsoft.XMLHTTP"));
    } else {
        // Non AJAX browsers
        return (null);
    }
}

//Función que detonará la petición asíncrona
function buscar() {
    request = getRequestObject();
    if (request != null) {
        let material_id = document.getElementById("Materiales").value;
        let proveedor_id = document.getElementById("Proveedores").value;
        let proyecto_id = document.getElementById("Proyectos").value;
        var url = 'controller_buscar.php?Materiales=' + material_id
        + '&Proveedores=' + proveedor_id + '&Proyectos=' + proyecto_id;

        request.open('GET', url, true);
        request.onreadystatechange =
            function () {
                if ((request.readyState == 4)) {
                    // Se recibió la respuesta asíncrona, entonces hay que actualizar el cliente.
                    // A esta parte comúnmente se le conoce como la función del callback
                    document.getElementById("resultados_consulta").innerHTML = request.responseText;
                }
            };
        // Limpiar la petición
        request.send(null);

    }
}

//Asignar al botón buscar, la función buscar()
document.getElementById("buscar").onclick = buscar;
