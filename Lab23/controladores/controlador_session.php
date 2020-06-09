<?php


session_start();
include("../model.php");

 	   $user = $_POST["Usuario"];
       $pass = $_POST["Contraseña"];

   if(password_verify($pass, getQuery($user))){
        $_SESSION["Usuario"]=$user;

        $idU=recuperar_id($user);
         $idRol = recuperar($idU, "desempenia", "usuario_id", "rol_id");
//vista dependiendo del rol
         if($idRol==1){
           $_SESSION["activo"] = true;
           header("location:../usuarios/vistaAdmin.php");
         }else{
          $_SESSION["activo"] = true;
           header("location:../usuarios/vistaEmpleado.php");
         }
     
       
        

    }else{

     echo "<script>
              alert('El usuario y/o la contraseña son incorrector');
              window.location.href='../index.php';
              </script>";
      
}









?>