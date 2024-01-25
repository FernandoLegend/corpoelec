<?php 
// Incluye los archivos necesarios
include("./template/cabecera.php");
include("./template/sesion.php");
include("config/bd.php");

// Define las variables y asegura que sean de tipo integer
$txtID = (isset($_POST['txtID'])) ? (int)$_POST['txtID'] : 0;
$busqueda = (isset($_POST['busqueda'])) ? (int)$_POST['busqueda'] : 0;

// Define las variables y asegura que sean de tipo string
$txtCI = (isset($_POST['txtCI'])) ? (string)$_POST['txtCI'] : "";
$txtApe = (isset($_POST['txtApe'])) ? (string)$_POST['txtApe'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? (string)$_POST['txtNombre'] : "";
settype($valor, "integer");

// Define la acción a realizar y asegura que sea de tipo string
$accion = (isset($_POST['accion'])) ? (string)$_POST['accion'] : "";
// $traspaso = (isset($_POST['txtID'])) ? (string)$_POST['txtID'] : "";

// Función para calcular la edad
function calcularEdad($fechaNacimiento) {
    $fechaNacimiento = new DateTime($fechaNacimiento);
    $fechaActual = new DateTime();
    $diferencia = $fechaNacimiento->diff($fechaActual);
    $edad = $diferencia->y;
    return $edad;
}

// Ejecuta la acción correspondiente según el botón presionado
switch($accion){
    case "Borrar":
        // Borra el registro con el ID especificado
        $sentenciaSQL = $conexion->prepare("DELETE FROM datos_personales WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID, PDO::PARAM_INT);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("DELETE FROM ubicacionycomunicacion WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID, PDO::PARAM_INT);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("DELETE FROM entidad WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID, PDO::PARAM_INT);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("DELETE FROM datos_educativos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID, PDO::PARAM_INT);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("DELETE FROM datos_certificacion WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID, PDO::PARAM_INT);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("DELETE FROM facilitador WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID, PDO::PARAM_INT);
        $sentenciaSQL->execute();
        break;

    case "Editar":
        // Actualizar el registro con el ID especificado
        $sentenciaSQL= $conexion->prepare("SELECT * FROM datos_personales WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $sentenciaSQL->bindParam(':cedula',$txtCI);
            
        $sentenciaSQL->execute();
        $listarows=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        // $sentenciaSQL= $conexion->prepare("UPDATE traspaso SET primero=:id");
        // $sentenciaSQL->bindParam(':id',$txtID);
        // $sentenciaSQL->execute();
        header('Location: edicion.php?tabla=' . $listarows['id'] . '&tabla1=' . $listarows['cedula']);

        case "Actualizar edades":
            
            // Consulta SQL para seleccionar todos los usuarios
            $sql = "SELECT id, fecha_nacimiento FROM datos_personales";

            // Ejecutar la consulta
            $result = $conexion->query($sql);

            // Recorrer los resultados
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
             // Obtener el ID y la fecha de nacimiento de cada usuario
                $id = $row['id'];
                $fechaNacimiento = $row['fecha_nacimiento'];

            // Calcular la edad
                $edad = calcularEdad($fechaNacimiento);

             // Actualizar la tabla con la edad calculada
                $sqlUpdate = "UPDATE datos_personales SET edad = :edad WHERE id = :id";

            // Preparar la consulta
                $stmt = $conexion->prepare($sqlUpdate);

            // Asignar valores a los parámetros
                $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Ejecutar la consulta de actualización
                $stmt->execute();
            }
        
        break;
}

$con=conectar();
$sql="SELECT * FROM datos_personales";
    // mediante una consulta sql buscamos la cedula
    if (isset($_POST['Buscar'])) {
        $cedula = $_POST['busqueda'];
        $sql = "SELECT * FROM datos_personales WHERE cedula LIKE '%$cedula%'";
    } elseif (isset($_POST['Limpiar'])) {
        // Lógica para limpiar los campos o simplemente volver a cargar la página
        header('Location: gestion.php');
        exit();
    } else {
        $sql = "SELECT * FROM datos_personales";
    }
    
    $query = mysqli_query($con, $sql);

?>

<title>Gestion de trabajadores</title>

<link rel="stylesheet" href="css/gestion.css">
    <div class="nuevo">
        <br>
        <h1>Trabajadores:</h1>
        <br>
        <div class="nuevo compartirs2">
        <input type="submit" name="accion" value="Actualizar edades" class="btn btn-info botonc"/>
        </div>
        <form action="gestion.php" class="compartirs2" method="post">
            <input required type="number" class="compartirs2 col-md-6 form-control" name="busqueda" placeholder="Búsqueda por Cédula">
            <br><br>
            <input type="submit" class="compartirs2" value="Buscar" name="Buscar">
        </form>

        <form class="compartirs2" action="gestion.php" method="post">
        <!-- Otros campos del formulario si es necesario -->
        <input type="submit" class="compartirs2" value="Limpiar">
    </form>

        <br><br>
        </div>
    </div>
<div class="tabla"> 
    <div class="col-md-12 radio">
        <table class="table align-middle rounded-circle">
        <div class="borders">
            <thead>
                
                <tr>
                    <th>Código</th>
                    <th>Cédula de Identidad</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Selección</th>
                    <th>Opciones</th>
                </tr>
                
            </thead>
        </div>
            <tbody>
            <?php             
            while($row=mysqli_fetch_array($query)){ 
                ?>
                <tr>
                    <td>#<?php echo $row['id'] ?></td>
                    <td><?php echo $row['cedula'] ?></td>
                    <td><?php echo $row['nombres'] ?></td>
                    <td><?php echo $row['apellidos'] ?></td>
                    <td><input type="checkbox" name="seleccion" id="seleccion"></td>
                    <div class="borrar">
                        <td><!--<a class="btn" href="<?php echo $url;?>/administrador/edicion.php">Detalles del Usuario</a>|-->
                        <div class="btn-group" role="group" arial-label="">
                            <form method="POST">
                                <!--<button type="submit" name="accion" value="Borrar" class="btn">Borrar</button>-->
                                <input type="hidden" name="txtID" id="txtID" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="txtCI" id="txtCI" value="<?php echo $row['cedula']; ?>">
                                <input type="hidden" name="txtApe" id="txtApe" value="<?php echo $row['apellidos']; ?>">
                                <input type="hidden" name="txtNombre" id="txtNombre" value="<?php echo $row['nombres']; ?>">

                                <input type="submit" name="accion" value="Editar" class="btn botona btn-outline"/>        |                                
                                <input type="submit" name="accion" value="Borrar" class="btn botonb btn-outline" onclick="return eliminar()"/>

                            </form>
                        </div>
                        </td>
                    </div>
                </tr>
                
            <?php } ?>
            </tbody>
        </table>        
    </div>  
</div>
<script src="../js/confirmar.js"></script>
<?php include("./template/pie.php") ?>