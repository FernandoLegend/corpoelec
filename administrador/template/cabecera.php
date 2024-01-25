<?php
// Definir el tema por defecto
$tema = 'claro'; 
// Verificar si se ha establecido una cookie de tema y actualizar la variable en consecuencia
if (isset($_COOKIE['tema'])) {
  $tema = $_COOKIE['tema'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Incluir el archivo de estilo correspondiente al tema actual -->
    <link id="mi-estilo" rel="stylesheet" href="./css/<?php echo $tema; ?>.css">

    <!-- Incluir otros archivos de estilo -->
    <link rel="stylesheet" href="css/cabecera.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo1.png" />

    <!-- Incluir el archivo de script para cambiar el tema -->
    <script src="./js/tema.js"></script>   
    <script src="./template/jquery.js"></script>
</head>
<body>

    <?php 
    // Definir la URL base del sitio web
    $url="http://".$_SERVER['HTTP_HOST']."/corpoelec" 
    ?>

    <nav class="navbar navbar-expand navbar-light bg-primary align-items-center">
    
        <div class="nav navbar-nav ">
            <div class="navegacion">
               <a class="nav-item nav-link active" href="<?php echo $url;?>/administrador/inicio.php"><b>Inicio</b></a>
            </div>
            <div class="navegacion">
               <a class="nav-item nav-link active" href="<?php echo $url;?>/administrador/agregar.php"><b>Nuevo Registro</b></a>
            </div>
            <div class="navegacion">
               <a class="nav-item nav-link active" href="<?php echo $url;?>/administrador/gestion.php"><b>Edición</b></a>
            </div>
            <!-- <div class="navegacion">
               <a class="nav-item nav-link active" href="<?php echo $url;?>/administrador/prestamos.php"><b>Prestamos</b></a>
            </div> -->
            <!-- <div class="navegacion"> -->
               <!-- <a class="nav-item nav-link active" href="<?php echo $url;?>/administrador/conversion.php"><b>Reconversión Monetaria</b></a>
            </div> -->
            <div class="navegacion">
               <a class="nav-item nav-link active" href="<?php echo $url;?>/administrador/salida.php"><b>Cerrar</b></a>
            </div>            
        </div>        
        <div class="imagen">
            <img src="img/logo.ico" alt="">
        </div>
        
    </nav>

    <div class="container">

        <div class="row"> 
