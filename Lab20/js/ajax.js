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
        let mat_id = document.getElementById("Materiales").value;
        let proy_id = document.getElementById("Proyectos").value;
        let prov_id = document.getElementById("Proveedores").value;
        var url = 'controller_buscar.php?Materiales=' + mat_id + '&Proyectos=' + proy_id + '&Proveedores=' + prov_id;

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

function sendRequest(tabla) {
  request = getRequestObject();
  if(request != null) {
    let userInput = document.getElementById("userInput"+tabla);

    let url = 'controller_ajax.php?tabla='+tabla+'&pattern='+userInput.value;

    request.open('GET', url, true);
    request.onreadystatechange =
      function() {
        if(request.readyState == 4) {
          let ajaxResponse = document.getElementById("ajaxResponse"+tabla);

          ajaxResponse.innerHTML = request.responseText;
          ajaxResponse.style.visibility = "visible";
        }
      };
    request.send(null);
  }
}

function selectValue(tabla) {
  let list = document.getElementById("list");
  let userInput = document.getElementById("userInput"+tabla);
  let input = document.getElementById(tabla);
  let ajaxResponse = document.getElementById("ajaxResponse"+tabla);
  userInput.value = list.options[list.selectedIndex].text;
  input.value = list.options[list.selectedIndex].value;
  ajaxResponse.style.visibility = "hidden";
  userInput.focus();
}

//Asignar al botón buscar, la función buscar()
document.getElementById("buscar").onclick = buscar;
