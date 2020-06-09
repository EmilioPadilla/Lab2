function checkboxes(){
    // var inputElems = document.getElementsByTagName("input");
    // var count = 0;
    // for (var i=0; i<inputElems.length; i++) {
    // if (inputElems[i].type === "checkbox" && inputElems[i].checked === true){
    //     count++;
    // // }
    // alert(document.querySelectorAll('input[type="checkbox"]:checked').length);
    if ((document.querySelectorAll('input[type="checkbox"]:checked').length) >= 2) {
      document.querySelector(".btn-comparar").style.display = "block";
      alert("Estas listo para comparar");
    } else {
      alert("Necesitas escoger minimo 2");
    }

};
