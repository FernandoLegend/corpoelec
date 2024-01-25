<?php 
// Incluye los archivos cabecera.php y sesion.php
include("./template/cabecera.php");
include("./template/sesion.php");

// Obtiene los valores de la URL usando $_GET y los almacena en variables
$id=$_GET["tabla"];
$cedula=$_GET["tabla"];
$tipo=$_GET["tabla1"];
$monto=$_GET["tabla2"];
$cuotas=$_GET["tabla3"];
$interes=$_GET['interes'];

// Define la zona horaria por defecto para la función date()
date_default_timezone_set('America/Caracas');

// Obtiene la fecha actual en formato Y-m-d y la almacena en la variable global $fecha
$GLOBALS['fecha']=date("Y-m-d");

// Obtiene los valores enviados a través de $_POST y los almacena en variables
$clave=(isset($_POST['clave']))?$_POST['clave']:"";
$cota=(isset($_POST['pago']))?$_POST['pago']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$interes=(isset($_POST['interes']))?$_POST['interes']:"";
$id=(isset($_POST['id']))?$_POST['id']:"";
$cedula=(isset($_POST['cedula']))?$_POST['cedula']:"";
$tipo=(isset($_POST['tipo']))?$_POST['tipo']:"";
$monto=(isset($_POST['monto']))?$_POST['monto']:"";
$cuotas=(isset($_POST['cuotas']))?$_POST['cuotas']:"";
$txtCuota=(isset($_POST['txtCuota']))?$_POST['txtCuota']:"";
$txtIngreso=(isset($_POST['txtIngreso']))?$_POST['txtIngreso']:"";
$txtRetiro=(isset($_POST['txtRetiro']))?$_POST['txtRetiro']:"";
$txtDescuento=(isset($_POST['txtDescuento']))?$_POST['txtDescuento']:"";
$txtSaldo=(isset($_POST['txtSaldo']))?$_POST['txtSaldo']:"";
$txtSueldo=(isset($_POST['txtSueldo']))?$_POST['txtSueldo']:"";
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$estado=(isset($_POST['estado']))?$_POST['estado']:"";

// Incluye el archivo de configuración de la base de datos
include("config/bd.php");

// Realiza diferentes acciones dependiendo del valor de la variable $accion
switch($accion){

    case "Pagar":
        
        // Si el estado es 'Por pagar'
        if($estado=='Por pagar'){

            // Calcula el porcentaje de la cuota a pagar
            $cota=$cota*$_GET["tabla5"]/100;

            // Inserta el pago en la tabla traspaso
            $sentenciaSQL= $conexion->prepare("INSERT INTO traspaso (prueba) VALUES (:pago);");
            $sentenciaSQL->bindParam(':pago',$cota);
            $sentenciaSQL->execute();

            // Selecciona los datos de la cuota que se va a cancelar
            $sentenciaSQL= $conexion->prepare("SELECT * FROM cuotas WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$id);
            $sentenciaSQL->execute();

            // Define el nuevo estado de la cuota
            $cancelado="Cancelada";

            // Actualiza el estado y la fecha de la cuota
            $sentenciaSQL= $conexion->prepare("UPDATE cuotas SET estado=:Cancelado, fecha=:fecha WHERE id=:id AND estado='Por pagar'");
            $fecha = $GLOBALS['fecha'];
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->bindParam(':Cancelado',$cancelado);
            $sentenciaSQL->bindParam(':fecha',$fecha);
            $sentenciaSQL->execute();
            
        }
        
        break;
        
}

// Obtener el valor del parámetro "tabla" enviado por GET
$idafiliado = $_GET["tabla"];

// Conectar a la base de datos
$con = conectar();

// Consulta SQL para seleccionar todas las filas de la tabla "cuotas" que tengan una clave que contenga el valor de $idafiliado
$sql = "SELECT * FROM cuotas WHERE clave LIKE '%$idafiliado%'";
$query = mysqli_query($con, $sql);

// Conectar a la base de datos nuevamente
$con1 = conectar();

// Consulta SQL para seleccionar la columna "primero" de la tabla "traspaso"
$sql1 = "SELECT `primero` FROM `traspaso`";
$query1 = mysqli_query($con1, $sql1);

// Convertir el valor de $txtID a un entero
settype($txtID, "integer");

// Consulta SQL para seleccionar todas las filas de la tabla "afiliados" que tengan un ID igual al valor de $txtID
$sentenciaSQL = $conexion->prepare("SELECT * FROM afiliados WHERE id=:' & $txtID & '");
$sentenciaSQL->bindParam(':id', $txtID);
$sentenciaSQL->execute();

// Obtener la fila correspondiente a la consulta anterior
$listaAfiliados = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

// Establecer el valor de $conta a 1
$conta = 1;

// Consulta SQL para seleccionar todas las filas de la tabla "traspaso" que tengan un valor de "conta" igual a 1
$sentenciaSQL1 = $conexion->prepare("SELECT * FROM traspaso WHERE conta=:conta");
$sentenciaSQL1->bindParam(':conta', $conta);
$sentenciaSQL1->execute();

// Obtener la fila correspondiente a la consulta anterior
$sqltraspaso = $sentenciaSQL1->fetch(PDO::FETCH_LAZY);

?>





<br>

<title>Edicion</title>
<link rel="stylesheet" href="css/edicion.css">
<div class="orden">
    <div class="card">
        <div class="card-header">
            Consulta de datos:
        </div>
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">
            
            <?php 
            $afiliado = $listaAfiliados;
            ?>

                <div class = "form-group">
                    <label for="txtID">Codigo del Prestamo</label>
                    <input type="number" readonly name="id" class="form-control" id="id" readonly="readonly" value="<?php echo $_GET["tabla"] ?>" placeholder="ID o Codigo">
                </div>
            
                <div class = "form-group">
                    <label for="txtCI">Número de Cédula</label>
                    <input type="number" readonly name="cedula" class="form-control" id="cedula" value="<?php echo $_GET["tabla1"] ?>" placeholder="Cédula de Identidad">
                </div>

                <div class = "form-group">
                    <label for="txtApe">Plazo</label>
                    <input type="text" readonly name="txtApe" class="form-control" id="txtApe" value="<?php echo $_GET["tabla2"] ?>" placeholder="Apellido(s)">
                </div>

                <div class = "form-group">
                    <label for="txtNombre">Valor del Prestamo</label>
                    <input type="text" readonly name="txtNombre" class="form-control" id="txtNombre" placeholder="Nombre(s)" value="<?php  echo number_format($_GET["tabla3"], 2, "," , ".")  ?>">
                </div>
                <br><br><br>

                <div class = "form-group">
                    <label for="txtTrabajo">Cutoas</label>
                    <input type="text" readonly name="txtTrabajo" class="form-control" id="txtTrabajo" value="<?php echo $_GET["tabla4"] ?>" placeholder="Unidad de Trabajo">
                </div>

                <div class = "form-group">
                    <label for="txtNomina">Interes</label>
                    <input type="text" readonly name="txtNomina" class="form-control" value="<?php echo $_GET["tabla5"] ?> %" id="txtNomina">                                            
                </div>
                <?php $int2=$_GET['tabla3']*$_GET['tabla5']/100;
                    $pago=$int2+$_GET['tabla3'];
                    $tt=$pago;                  
                    $int2=$_GET['tabla3']*$_GET['tabla5']/100;
                    $pago=$int2+$_GET['tabla3'];
                    $pago=$pago/$_GET['tabla4'];?>
                <div class = "form-group">
                    <label for="txtCuota">Monto x Cuota</label>
                    <input type="text" name="txtCuota" class="form-control" readonly id="txtCuota" value="<?php echo number_format($pago, 2, "," , "."); ?>" placeholder="">
                </div>

                <div class = "form-group">
                    <label for="txtIngreso">Total a Pagar</label>
                    <input type="text" name="txtIngreso" class="form-control" readonly id="txtIngreso" value="<?php echo number_format($tt, 2, "," , "."); ?>" placeholder="">
                </div>
                <br><br><br>
                
                    

                </div>
            
            </form>        
            <form method="POST">
                <input type="hidden" name="id" id="id" value="<?php echo $afiliado['id']; ?>">
                <input type="hidden" name="cedula" id="cedula" value="<?php echo $afiliado['cedula']; ?>">
                <input type="hidden" name="tipo" id="tipo" value="<?php echo $afiliado['apellidos']; ?>">
                <input type="hidden" name="monto" id="monto" value="<?php echo $afiliado['nombres']; ?>">
                <input type="hidden" name="cuotas" id="cuotas" value="<?php echo $afiliado['trabajo']; ?>">
                <input type="hidden" name="interes" id="interes" value="<?php echo $afiliado['nomina']; ?>">
            </form>
        </div>
    </div>  
</div>
<br><br>
<div class="tabla"> 
    <div class="col-md-12 radio">
        <table class="table align-middle rounded-circle">
        <div class="borders">
            <thead>
                
                <tr>
                    <th>Código</th>
                    <th>Cédula de Identidad</th>
                    <th>Estado</th>
                    <th>Sueldo</th>
                    <th>Fecha de Cancelación</th>
                    <th>Acciones</th>
                </tr>
                
            </thead>
        </div>
            <tbody>
            <?php             
            while($row=mysqli_fetch_array($query)){ 
                $cota=$row['pago'];
                ?>
                <tr>
                    <td>#<?php echo $row['id'] ?></td>
                    <td><?php echo $row['cedula'] ?></td>
                    <td><?php echo $row['estado'] ?></td>
                    <td>Bs. <?php echo number_format($row['pago'], 2, "," , ".")?></td>
                    <td><?php echo $row['fecha'] ?></td>                    
                    <div class="borrar">
                        <td>
                            <form method="POST">
                                <input type="hidden" name="txtID" id="txtID" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="pago" id="pago" value="<?php echo $row['pago']; ?>">
                                <input type="hidden" name="int3" id="int3" value="<?php echo $row['pago']; ?>">
                                <input type="hidden" name="clave" id="clave" value="<?php echo $row['clave']; ?>">
                                <input type="hidden" name="txtSueldo" id="txtSueldo" value="<?php echo $row['sueldo']; ?>">
                                <input type="hidden" name="estado" id="estado" value="<?php echo $row['estado']; ?>">
                                <input type="hidden" name="interes" id="interes" value="<?php echo $row['interes']; ?>">
                                <input type="submit" name="accion" value="Pagar" class="btn botona btn-outline"/>
                            </form>
                        </td>
                    </div>
                </tr>
            <?php } 
             ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("./template/pie.php") ?>