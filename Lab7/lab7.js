function change_font() {
  setTimeout(function(){ document.getElementById("cinco_seg").style.display = "block"; }, 5000);
  if (document.getElementById("title").style.fontStyle == "normal") {
    document.getElementById("title").style.fontStyle = "italic";
  } else if (document.getElementById("title").style.fontStyle == "italic") {
    document.getElementById("title").style.fontStyle = "oblique";
  } else if (document.getElementById("title").style.fontStyle = "oblique") {
    document.getElementById("title").style.fontStyle = "normal";
  }

}

function help() {
  document.getElementById("ayuda").style.display = "block";
}

function quit() {
  document.getElementById("ayuda").style.display = "none";
}

if (time_start) {
  setTimeout(function(){ alert("Hello"); }, 3000);
  document.getElementById("cinco_seg").style.display = "block";
}

// Estas son las funciones necesarias para el drag and drop!
function allowDrop(ev) {
  ev.preventDefault();
  document.getElementById("info_rect").style.display = "none";
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}
