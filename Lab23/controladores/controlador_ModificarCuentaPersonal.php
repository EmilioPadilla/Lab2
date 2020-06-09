<?php
	session_start();
	include("../model.php");
	
	$usuario = htmlspecialchars($_POST["usuario"]);
	$idUc=recuperar_id($usuario);
	$oldPass= $_POST["oldPass"];
	$password= $_POST["password"];

if( $_POST["oldPass"] != ""  && $_POST["password"] != "" &&  $usuario !=""){
	if($oldPass==$password){

  		$_SESSION["warning"] = "Tu nueva contraseña debe ser diferente a la anterior";
    }else if(password_verify($oldPass, getQuery($usuario))){
			$password= password_hash($_POST["password"], PASSWORD_DEFAULT);
			if (editar_usuarioP($idUc,$password)){
			$_SESSION["mensaje"] = "Se modificó la contraseña";
			}
		}



  }else{
  	 $_SESSION["warning"] = "Debe llenar los campos para hacer una modificacion";
  }
  

	
		

	
	



  header("location:../usuarios/modificarCuentaPersonal.php");

 
?>