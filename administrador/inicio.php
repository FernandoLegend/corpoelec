<?php 
  // Incluye el archivo de sesión
  include("./template/sesion.php");

  // Incluye el archivo de cabecera
  include("./template/cabecera.php");

  // Define el título de la página
  echo '<title>Inicio</title>';

  // Incluye la hoja de estilos
  echo '<link rel="stylesheet" href="css/inicio.css">';

  // Abre un contenedor
  echo '<div class="espa">';

  // Imprime un mensaje de bienvenida con el nombre de usuario
  echo '<h2>Bienvenido, ' . $nombreUsuario . '</h2>';

  // Abre un contenedor para la imagen
  echo '<div class="img">';
  
  // Agrega una imagen
  echo '<img src="img/admin.png" alt="">';
  
  // Cierra el contenedor de la imagen
  echo '</div>';

  // Cierra el contenedor principal
  echo '</div>';

  // Incluye el archivo de pie de página
  include("./template/pie.php");
?>
