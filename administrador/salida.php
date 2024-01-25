<?php 
// Obtiene la URL del servidor actual y la almacena en una variable llamada $url
$url="http://".$_SERVER['HTTP_HOST']."/proyecto";
// Incluye el archivo sesion.php que probablemente contiene el código para manejar la sesión del usuario
include("./template/sesion.php");
?>

<!-- Agrega un archivo de hoja de estilos CSS llamado "animacion.css" -->
<link rel="stylesheet" href="css/animacion.css">
<!-- Agrega un icono de acceso directo del sitio web -->
<link rel="shortcut icon" href="img/logo1.png"/>

<!-- Crea una animación de carga de tres niveles que se muestra mientras se realiza una operación en segundo plano -->
<div class="loading first">
  <div class="loading second">
    <div class="loading third"></div>  
  </div>  
</div>

<!-- Establece el título de la página como "Saliendo del Sistema..." -->
<title>Saliendo del Sistema...</title>

<!-- Crea una función JavaScript llamada "redireccionar()" que redirecciona automáticamente al usuario a la página "cerrar.php" después de un tiempo de espera de 1663 milisegundos (aproximadamente 1.6 segundos) -->
<script language="JavaScript">
  function redireccionar() {
    setTimeout("location.href='seccion/cerrar.php'", 1663);
  }
</script>

<!-- Llama a la función "redireccionar()" cuando se carga la página utilizando la función "onLoad()" -->
<body onLoad="redireccionar()">
