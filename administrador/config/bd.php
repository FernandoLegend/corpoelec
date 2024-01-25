<?php
// Conexión a la base de datos mediante mysqli
$conn = mysqli_connect("localhost", "root", "", "sistema");

// Variables de conexión para la función "conectar()"
$host="localhost";
$bd="sistema";
$usuario="root";
$contrasenia="";

// Función para conectar a la base de datos
function conectar(){
    $host="localhost";    
    $usuario="root";
    $pass="";
    $contrasenia="";    

    $bd="sistema";

    $con=mysqli_connect($host,$usuario,$pass,$contrasenia);

    mysqli_select_db($con,$bd);

    return $con;
}

// Conexión a la base de datos mediante PDO
try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);

} catch ( Exception $ex) {

echo $ex->getMessage();
}
?>
