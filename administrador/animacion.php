<?php
// Definimos la URL base del proyecto
$url="http://".$_SERVER['HTTP_HOST']."/proyecto";

// Incluimos el archivo que maneja la sesión del usuario
include("./template/sesion.php");

// Incluimos la hoja de estilos para la animación de carga
echo '<link rel="stylesheet" href="css/animacion.css">';

// Definimos el ícono de la página
echo '<link rel="shortcut icon" href="img/logo1.png"/>';

// Creamos la animación de carga con tres elementos
echo '<div class="loading first">
          <div class="loading second">
            <div class="loading third"></div>  
          </div>  
      </div>';

// Definimos el título de la página
echo '<title>Cargando Sistema...</title>';

// Creamos una función en JavaScript para redireccionar al usuario a la página de inicio después de cierto tiempo
echo '<script language="JavaScript">
          function redireccionar() {
            setTimeout("location.href=\'inicio.php\'", 1663);
          }
      </script>';

// Llamamos a la función redireccionar() cuando se carga la página
echo '<body onLoad="redireccionar()">';
