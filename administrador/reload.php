<?php 
include("./template/cabecera.php");
include("./template/sesion.php");
include("config/bd.php");
$txtID=$_GET["tabsala"];

echo $txtID;


header('Location: '."edicion.php?tabla=$txtID&tabla1=$txtCI");

?>

<?php include("./template/pie.php") ?>