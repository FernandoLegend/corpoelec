<?php
session_start(); // Inicia una sesión para poder utilizar variables de sesión

if($_SESSION['seguridad'] == "nivel0"){ // Verifica el nivel de seguridad del usuario

    // Si el usuario no está logueado, lo redirige al login
    if(!isset($_SESSION['usuario'])){
        header("Location:../login.php");
    }else{

        // Si el usuario está logueado, verifica que haya iniciado sesión correctamente
        if(($_SESSION['usuario']=="ok")){        
           $nombreUsuario=$_SESSION["nombreUsuario"]; // Asigna el nombre del usuario a la variable $nombreUsuario
        }
   }
}else{
    header("Location:../login.php"); // Si el nivel de seguridad no es válido, redirige al login
}
?>
