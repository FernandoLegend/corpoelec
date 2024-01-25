<?php 
// Se incluyen archivos necesarios
include("./template/cabecera.php"); 
include("./template/sesion.php"); 
include("config/bd.php");

// Se obtiene el valor de la variable eliminación, si no se ha definido, se establece como vacío
$eliminacion=(isset($_POST['eliminacion']))?$_POST['eliminacion']:"";

// Se evalúa el valor de la variable eliminación
switch($eliminacion){
    // Si se seleccionó "Vaciar Ingresos por Intereses"
    case 'Vaciar Ingresos por Intereses':
        // Se prepara la sentencia SQL para vaciar la tabla "traspaso"
        $sentenciaSQL= $conexion->prepare("TRUNCATE TABLE traspaso;");
        // Se ejecuta la sentencia SQL
        $sentenciaSQL->execute();
}

// Se establece una conexión a la base de datos
$con=conectar();

// Se obtiene la suma total de los saldos de todos los afiliados
$sql="SELECT Saldo FROM afiliados";
$query=mysqli_query($con, $sql);
$suma=0;
while($row=mysqli_fetch_array($query)){
    $suma=$suma+$row[0];
}

// Se obtiene la suma total de los montos de todos los préstamos
$sql1="SELECT monto FROM prestamos";
$query1=mysqli_query($con, $sql1);
$suma1=0;
while($row=mysqli_fetch_array($query1)){
    $suma1=$suma1+$row[0];
}

// Se obtiene la suma total de la columna "prueba" de la tabla "traspaso"
$sql2="SELECT prueba FROM traspaso";
$query2=mysqli_query($con, $sql2);
$suma2=0;
while($row=mysqli_fetch_array($query2)){
    $suma2=$suma2+$row[0];
}
?> 

<link rel="stylesheet" href="css/balance.css">
<title>Balance Total</title>
<div class="espa">
    <h3>Balance Total de Ahorros</h3>
</div>
<br>
<?php             
    while($row=mysqli_fetch_array($query)){ 
        $suma = $suma + $row['Saldo'];
        
    };        
?>
<b><h3><?php echo number_format($suma, 2, "," , ".");?> Bs.</h3></b>
<br><br>
<hr>
<div class="espa">
    <h3>Total de los Prestamos Otorgados</h3>
</div>
<br>
<?php             
    while($row1=mysqli_fetch_array($query1)){ 
        $suma1 = $suma1 + $row1['monto'];
        
    };        
?>
<b><h3><?php echo number_format($suma1, 2, "," , ".")?> Bs.</h3></b>
<br><br>
<hr>
<div class="espa">
    <h3>Total de Ingresos por Pago de Intereses</h3>
</div>
<br>
<?php             
    while($row2=mysqli_fetch_array($query2)){ 
        $suma2 = $suma2 + $row2['prueba'];
        
    };        
?>
<b><h3><?php echo number_format($suma2, 2, "," , "."); ?> Bs.</h3></b>


<form method="POST">
    <input type="submit" name="eliminacion" class="btn btn-info" value="Vaciar Ingresos por Intereses" id="eliminacion" class="btn botona btn-outline" onclick="return eliminar()"/>
</form>

<script src="../js/confirma2.js"></script>
<?php include("./template/pie.php") ?>