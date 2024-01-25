<?php 
// Incluye el archivo de cabecera de la página
include("./template/cabecera.php"); 
// Incluye el archivo de sesión
include("./template/sesion.php"); 
// Incluye el archivo de configuración de la base de datos
include("config/bd.php");

// Verifica si se ha enviado un valor a través del método POST
$accion=(isset($_POST['carga']))?$_POST['carga']:"";
// Obtiene el valor del input "floatingInput"
$valor=(isset($_POST['floatingInput']))?$_POST['floatingInput']:"";

// Crea una estructura de control switch para realizar diferentes acciones dependiendo del valor de $accion
switch($accion){

    case "Devaluación":
        // Prepara una sentencia SQL para actualizar la columna "prueba" de la tabla "traspaso"
        $sentenciaSQL= $conexion->prepare("UPDATE traspaso SET prueba = prueba/:valor");
        // Asocia el valor de $valor con el marcador de posición :valor en la sentencia SQL
        $sentenciaSQL->bindParam(':valor',$valor);
        // Ejecuta la sentencia SQL
        $sentenciaSQL->execute();

        // Prepara una sentencia SQL para actualizar las columnas "Saldo" y "sueldo" de la tabla "afiliados"
        $sentenciaSQL= $conexion->prepare("UPDATE afiliados SET Saldo = Saldo/:valor, sueldo = sueldo/:valor");
        // Asocia el valor de $valor con el marcador de posición :valor en la sentencia SQL
        $sentenciaSQL->bindParam(':valor',$valor);
        // Ejecuta la sentencia SQL
        $sentenciaSQL->execute();

        // Prepara una sentencia SQL para actualizar las columnas "monto", "total" y "montoxcuota" de la tabla "prestamos"
        $sentenciaSQL= $conexion->prepare("UPDATE prestamos SET monto = monto/:valor, total = total/:valor, montoxcuota = montoxcuota/:valor ");
        // Asocia el valor de $valor con el marcador de posición :valor en la sentencia SQL
        $sentenciaSQL->bindParam(':valor',$valor);
        // Ejecuta la sentencia SQL
        $sentenciaSQL->execute();

        // Prepara una sentencia SQL para actualizar la columna "pago" de la tabla "cuotas"
        $sentenciaSQL= $conexion->prepare("UPDATE cuotas SET pago = pago/:valor");
        // Asocia el valor de $valor con el marcador de posición :valor en la sentencia SQL
        $sentenciaSQL->bindParam(':valor',$valor);
        // Ejecuta la sentencia SQL
        $sentenciaSQL->execute();
}
?>

<!-- Incluye una hoja de estilos para dar estilo a la página -->
<link rel="stylesheet" href="css/conversion.css">
<title>Conversión</title>
<hr><br>

<!-- Crea un formulario para realizar la conversión -->
<div class="compartirs">
<form method="POST">
    <div class="form-floating col-3 form">
        <input type="number" min="1" class="form-control" name="floatingInput" id="floatingInput" class="compartirs col-md-6 form-control" placeholder="Valor de la conversión">
        <label for="floatingInput">Valor de la Conversión</label>
    </div>
<br>
<div class="boton">
    <input type="submit" name="carga" id="carga" value="Devaluación" class="btn btn-success" onclick="return eliminar()">
</div>
</div>
<script src="../js/confirma3.js"></script>