<?php 
// Se incluyen los archivos necesarios para la página
include("./template/cabecera.php");
include("./template/sesion.php");

// Se define el tipo de dato de las variables
settype($id, "integer");
settype($contador, "integer");

// Se asigna un valor a las variables si estas existen en el array POST, de lo contrario se asigna una cadena vacía
$id=(isset($_POST['id']))?$_POST['id']:"";
$cedula=(isset($_POST['cedula']))?$_POST['cedula']:"";
$monto=(isset($_POST['monto']))?$_POST['monto']:"";
$tipo=(isset($_POST['tipo']))?$_POST['tipo']:"";
$interes=(isset($_POST['interes']))?$_POST['interes']:"";
$cuotas=(isset($_POST['cuotas']))?$_POST['cuotas']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$txtSaldo=(isset($_POST['txtSaldo']))?$_POST['txtSaldo']:"";
$contador=0;
$a='Por pagar';

// Se establece la zona horaria y se guarda la fecha actual en una variable global
date_default_timezone_set('America/Caracas');
$GLOBALS['fecha']=date("Y-m-d");

// Se incluye el archivo de configuración de la base de datos
include("config/bd.php");

// Se realiza una acción dependiendo del valor de la variable $accion
switch($accion){

        case "Agregar":
            // Se calcula el total a pagar y el monto de cada cuota
            $total=$monto+$monto*$interes/100;
            $mntct=$total/$cuotas;            
            $sentenciaSQL= $conexion->prepare("INSERT INTO prestamos (id, cedula, tipo, monto, cuotas, interes, montoxcuota, total, fecha) VALUES (:id,:cedula,:tipo,:monto,:cuotas,:interes,:mntct,:total,:fecha);");
            $fecha = $GLOBALS['fecha'];
            $sentenciaSQL->bindParam(':id',$id);
            $sentenciaSQL->bindParam(':cedula',$cedula);
            $sentenciaSQL->bindParam(':monto',$monto);
            $sentenciaSQL->bindParam(':tipo',$tipo);
            $sentenciaSQL->bindParam(':interes',$interes);
            $sentenciaSQL->bindParam(':cuotas',$cuotas);
            $sentenciaSQL->bindParam(':total',$total);
            $sentenciaSQL->bindParam(':mntct',$mntct);
            $sentenciaSQL->bindParam(':fecha',$fecha);
            $sentenciaSQL->execute();
            $intanueal = $interes/12*$cuotas;
            $calc = $monto*$intanueal/100;
            $abc = $calc+$monto;
            $montocuota = $abc/$cuotas;
            $ultimo_id = $conexion->lastInsertId();

            // Se crean las cuotas correspondientes al préstamo
            while($cuotas > $contador){
                $contador = $contador + 1;
                $sentenciaSQL= $conexion->prepare("INSERT INTO cuotas (id, clave, cedula, estado, pago) VALUES (:a,:lastid,:cedula,:a,:mntct);");
                $sentenciaSQL->bindParam(':a',$a);
                $sentenciaSQL->bindParam(':lastid',$ultimo_id);
                $sentenciaSQL->bindParam(':cedula',$cedula);
                $sentenciaSQL->bindParam(':mntct',$montocuota);
                $sentenciaSQL->execute();
            }
          
            header('Location: '."newprestamo.php?alert=true");            
            break;

}
// Se establece conexión a la base de datos y se realiza una consulta
$con=conectar();
$sql="SELECT * FROM afiliados";

    if(isset($_POST['buscar'])){
         $cedula=$_POST['busqueda'];
        $sql="SELECT * FROM afiliados WHERE cedula LIKE '%$cedula%'";
    }

$query=mysqli_query($con, $sql);

?>


<title>Agregar</title>
<link rel="stylesheet" href="css/edicion.css">
<div class="orden">
    <div class="card">
        <div class="card-header">
            Nuevo Préstamo:
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" >
                
                <div class = "form-group">
                <label for="cedula">Número de Cédula</label>
                    <input type="text" required name="cedula" class="form-control" id="cedula" value="<?php echo $_GET["tabla1"] ?>" readonly>
                </div>
                
                <div class = "form-group">
                <label for="tipo">Grupo de Nomina</label>
                    <select type="text" required name="tipo" class="form-select" id="tipo">
                        <option value="Corto">Corto</option>
                        <option value="Mediano">Mediano</option>
                        <option value="Largo">Largo</option>
                    </select>
                </div>
                
                <div class = "form-group">
                    <label for="monto">Monto</label>
                    <?php $presta=0.8;
                    $int2=$_GET['tabla10']*$presta;
                    ?>
                    <input required type="number" min="0,1" max="<?php echo $int2 ?>" name="monto" class="form-control" id="monto" placeholder="Monto">
                </div>
                
                <div class = "form-group">
                    <label for="cuotas">Cuotas</label>
                    <input required type="text" name="cuotas" class="form-control" id="cuotas" placeholder="Cantidad de Cuotas">
                </div>

                <div class = "form-group">
                    <label for="interes">Intereses</label>
                    <select required type="text" name="interes" class="form-select" id="interes">
                        <option value=""></option>
                        <option value="10">10%</option>
                        <option value="12">12%</option>
                        <option value="15">15%</option>
                    </select>
                </div>
<br><br><br>
<hr>
                <div class="btn-group" role="group" arial-label="">

                    <button type="submit" name="accion" value="Agregar" class="btn btn-warning">Agregar +</button> 
                    
                </div>
                
            </form>        
        </div>
    </div>  
</div>
<?php include("./template/pie.php") ?>