<?php 
include("./template/cabecera.php");
include("./template/sesion.php");

// variables para el manejo de la logica
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$id=(isset($_POST['id']))?$_POST['id']:"";

//tabla datos personales
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtCI=(isset($_POST['txtCI']))?$_POST['txtCI']:"";
$txtApe=(isset($_POST['txtApe']))?$_POST['txtApe']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtNacimiento=(isset($_POST['txtNacimiento']))?$_POST['txtNacimiento']:"";
$txtGenero=(isset($_POST['txtGenero']))?$_POST['txtGenero']:"";
$txtEdad=(isset($_POST['txtEdad']))?$_POST['txtEdad']:"";
$txtLugarn=(isset($_POST['txtLugarn']))?$_POST['txtLugarn']:"";
$txtEstu=(isset($_POST['txtEstu']))?$_POST['txtEstu']:"";
$txtFecha=(isset($_POST['txtFecha']))?$_POST['txtFecha']:"";
$txtCivil=(isset($_POST['txtCivil']))?$_POST['txtCivil']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$txtDoce=(isset($_POST['txtDoce']))?$_POST['txtDoce']:"";
$txtID = $_GET["tabla"];

//tabla ubicacionycomunicacion

$txtEstado=(isset($_POST['txtEstado']))?$_POST['txtEstado']:"";
$txtMunicipio=(isset($_POST['txtMunicipio']))?$_POST['txtMunicipio']:"";
$txtSector=(isset($_POST['txtSector']))?$_POST['txtSector']:"";
$txtnrocel=(isset($_POST['txtnrocel']))?$_POST['txtnrocel']:"";
$email=(isset($_POST['email']))?$_POST['email']:"";
$txtparroquia=(isset($_POST['txtparroquia']))?$_POST['txtparroquia']:"";

//tabla entidad

$estadotrbj=(isset($_POST['estadotrbj']))?$_POST['estadotrbj']:"";
$municipiotrbj=(isset($_POST['municipiotrbj']))?$_POST['municipiotrbj']:"";
$parroquiatrbj=(isset($_POST['parroquiatrbj']))?$_POST['parroquiatrbj']:"";
$sectortrbj=(isset($_POST['sectortrbj']))?$_POST['sectortrbj']:"";
$cargo=(isset($_POST['cargo']))?$_POST['cargo']:"";
$tiempo_servicio=(isset($_POST['tiempo_servicio']))?$_POST['tiempo_servicio']:"";

//nivel educativo

$nivel_instrucción=(isset($_POST['nivel_instrucción']))?$_POST['nivel_instruccion']:"";
$carrera=(isset($_POST['carrera']))?$_POST['carrera']:"";
$estudios=(isset($_POST['estudios']))?$_POST['estudios']:"";

// estado
// municipio
// parroquia
// sector
// numero_casa
// nrocelular
// correo


include("config/bd.php");

//chatGPT

// Consulta SQL utilizando JOIN y filtrando por ID
$sql = "SELECT datos_personales.*, ubicacionycomunicacion.*, entidad.*, datos_educativos.*, datos_certificacion.*, facilitador.*
        FROM datos_personales
        LEFT JOIN ubicacionycomunicacion ON datos_personales.id = ubicacionycomunicacion.id
        LEFT JOIN entidad ON datos_personales.id = entidad.id
        LEFT JOIN datos_educativos ON datos_personales.id = datos_educativos.id
        LEFT JOIN datos_certificacion ON datos_personales.id = datos_certificacion.id
        LEFT JOIN facilitador ON datos_personales.id = facilitador.id
        WHERE datos_personales.id = :idEspecifico";

// Preparar la consulta
$sentenciaSQL = $conexion->prepare($sql);

// Asignar valor al parámetro :idEspecifico
$sentenciaSQL->bindParam(':idEspecifico', $txtID, PDO::PARAM_INT);

// Ejecutar la consulta
$sentenciaSQL->execute();

// Obtener los resultados
$resultados = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

// Imprimir los resultados
foreach ($resultados as $resultado) {
    // echo "ID: " . $resultado['id'] . "<br>";
    // echo "Nombre: " . $resultado['nombres'] . "<br>";
    // echo "Cédula: " . $resultado['cedula'] . "<br>";
    // echo "Estado: " . $resultado['estado'] . "<br>";
    // echo "Municipio: " . $resultado['municipio'] . "<br>";
    // Agregar otros campos según sea necesario
    echo "<hr>";
}

$genereopc = $resultado['genero'];
$valorgenero = array("Femenino", "Masculino");

$civilopc = $resultado['estado_civil'];
$valorcivil = array("Soltero(a)", "Casado(a)", "Viudo(a)");

$estudianteopc = $resultado['participar_estudiante'];
$docenteopc = $resultado['participar_docente'];
$valorsino = array("Si", "No");





// Cerrar la conexión


switch($accion){

    case "Actualizar":

        $sentenciaSQL= $conexion->prepare("UPDATE `datos_personales` SET `fecha`=:fecha,`participar_estudiante`=:participar_estudiante,`participar_docente`=:participar_docente,`nombres`=:nombres,`apellidos`=:apellidos,`cedula`=:cedula,`genero`=:genero,`estado_civil`=:estado_civil,`fecha_nacimiento`=:fecha_nacimiento,`edad`=:edad,`lugar_nacimiento`=:lugar_nacimiento WHERE id=:id");

        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':nombres',$txtNombre);
        $sentenciaSQL->bindParam(':cedula',$txtCI);
        $sentenciaSQL->bindParam(':fecha_nacimiento',$txtNacimiento);
        $sentenciaSQL->bindParam(':genero',$txtGenero);
        $sentenciaSQL->bindParam(':lugar_nacimiento',$txtLugarn);
        $sentenciaSQL->bindParam(':fecha',$txtFecha);
        $sentenciaSQL->bindParam(':estado_civil',$txtCivil);
        $sentenciaSQL->bindParam(':edad',$txtEdad);
        $sentenciaSQL->bindParam(':participar_estudiante',$txtEstu);
        $sentenciaSQL->bindParam(':apellidos',$txtApe);
        $sentenciaSQL->bindParam(':participar_docente',$txtDoce);

        $sentenciaSQL->execute();

        $sentenciaSQL1= $conexion->prepare("UPDATE `ubicacionycomunicacion` SET `estado`=:estado,`municipio`=:municipio,`parroquia`=:parroquia,`sector`=:sector, `nrocelular`=:nrocelular,`correo`=:correo WHERE id=:id");

        $sentenciaSQL1->bindParam(':id',$txtID);
        $sentenciaSQL1->bindParam(':estado',$txtEstado);
        $sentenciaSQL1->bindParam(':municipio',$txtMunicipio);
        $sentenciaSQL1->bindParam(':parroquia',$txtparroquia);
        $sentenciaSQL1->bindParam(':sector',$txtSector);
        $sentenciaSQL1->bindParam(':nrocelular',$txtnrocel);
        $sentenciaSQL1->bindParam(':correo',$email);
        
        $sentenciaSQL1->execute();

        $sentenciaSQL2= $conexion->prepare("UPDATE `entidad` SET `estado_trbj`=:estado,`municipio_trbj`=:municipio,`parroquia_trbj`=:parroquia,`sector_trbj`=:sector,`cargo`=:cargo,`tiempo_servicio`=:tiempo_servicio WHERE id=:id");

        $sentenciaSQL2->bindParam(':id',$txtID);
        $sentenciaSQL2->bindParam(':estado',$estadotrbj);
        $sentenciaSQL2->bindParam(':municipio',$municipiotrbj);
        $sentenciaSQL2->bindParam(':parroquia',$parroquiatrbj);
        $sentenciaSQL2->bindParam(':sector',$sectortrbj);
        $sentenciaSQL2->bindParam(':cargo',$cargo);
        $sentenciaSQL2->bindParam(':tiempo_servicio',$tiempo_servicio);
        
        $sentenciaSQL2->execute();

        //sentencia SQL para la insercion de la 3ra tabla
        $sentenciaSQL3= $conexion->prepare("UPDATE `datos_educativos` SET `id`=:id,`nivel_instruccion`=:nivel_instrucción,`carrera`=:carrera,`estudios`=:estudios WHERE id=:id");
        
        $sentenciaSQL3->bindParam(':id',$txtID);
        $sentenciaSQL3->bindParam(':nivel_instrucción',$nivel_instrucción);
        $sentenciaSQL3->bindParam(':carrera',$carrera);
        $sentenciaSQL3->bindParam(':estudios',$estudios);     
        
        $sentenciaSQL3->execute();

        header('Location: '."reload.php?tabsala=$txtID");
        exit();
        

        break;
        
        case "carga":
        $suma = 0;
        $suma = $_GET["tabla10"]+$carga;
        $sentenciaSQL= $conexion->prepare("UPDATE afiliados SET Saldo=:Saldo WHERE id=:id");
        $sentenciaSQL->bindParam(':Saldo',$suma);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        
        
}

settype($txtID, "integer");
$sentenciaSQL = $conexion->prepare("SELECT * FROM datos_personales WHERE id=:id");
$sentenciaSQL->bindParam(':id', $txtID);
$sentenciaSQL->execute();
$listaAfiliados = $sentenciaSQL->fetch(PDO::FETCH_LAZY);


?>




<br>

<title>Edicion</title>
<link rel="stylesheet" href="css/edicion.css">
<div class="orden">
    <div class="card">
        <div class="card-header">
            Actualización y Consulta de datos:
        </div>
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">
            
            <?php foreach ($resultados as $resultado) : ?>
        <!-- Imprimir cada campo en un input -->
        
        <h4 class="lado font-weight-bold"><strong>Datos Personales</strong></h4>

        <div class="formulario__grupo compartirs" style="width: 29rem;" id=grupo__nombre>
            <label for="txtNombre" class="formulario__label">Nombres:</label>
            <div class="formulario__grupo-input">
                <input type="text" class="form-control" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" value="<?php echo $resultado['nombres']; ?>" class="formulario__input border" name="txtNombre" id="txtNombre" placeholder="Indique sus nombres">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>


        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtApe" class="formulario__label">Apellidos</label>
            <div class="formulario__grupo-input">
                <input class="form-control" type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" value="<?php echo $resultado['apellidos']; ?>" class="formulario__input border" name="txtApe" id="txtApe" placeholder="Indique sus apellidos">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtCI" class="formulario__label">Cédula de indentidad</label>
            <div class="formulario__grupo-input">
                <input class="form-control" type="text" required value="<?php echo $resultado['cedula']; ?>" pattern="^[A-Z0-9-]*$" class="formulario__input border" name="txtCI" id="txtCI" placeholder="Indique su cédula de identidad">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>
        
        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtGenero" class="formulario__label">Género</label>
            <div class="formulario__grupo-input">
            <select type="text"  required name="txtGenero" class="form-control border" id="txtGenero">
                        <?php
        // Mostrar las opciones en el select
        foreach ($valorgenero as $valor) {
            // Marcar la opción seleccionada si coincide con el valor existente
            $selected = ($valor == $genereopc) ? "selected" : "";

            echo "<option value=\"$valor\" $selected>$valor</option>";
        }
        ?>
                </select>
            </div>
        </div>

        <div class="formulario__grupo compartirs" style="width: 29rem;" id=grupo__nombre>
            <label for="txtCivil" class="formulario__label">Estado Civil</label>
            <div class="formulario__grupo-input">
            <select type="text"  required name="txtCivil" class="form-control border" id="txtCivil">
            <?php
        // Mostrar las opciones en el select
        foreach ($valorcivil as $valor) {
            // Marcar la opción seleccionada si coincide con el valor existente
            $selected = ($valor == $civilopc) ? "selected" : "";

            echo "<option value=\"$valor\" $selected>$valor</option>";
        }
        ?>
                </select>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtEstu" class="formulario__label">¿Desea Participar como estudiante?</label>
            <div class="formulario__grupo-input">
            <select type="text"  required name="txtEstu" class="form-control border" id="txtEstu">
                        <?php
        // Mostrar las opciones en el select
        foreach ($valorsino as $valor) {
            // Marcar la opción seleccionada si coincide con el valor existente
            $selected = ($valor == $estudianteopc) ? "selected" : "";

            echo "<option value=\"$valor\" $selected>$valor</option>";
        }
        ?>
                </select>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtDoce" class="formulario__label">¿Desea Participar como docente?</label>
            <div class="formulario__grupo-input">
            <select type="text"  required name="txtDoce" class="form-control border" id="txtDoce">
            <?php
        // Mostrar las opciones en el select
        foreach ($valorsino as $valor) {
            // Marcar la opción seleccionada si coincide con el valor existente
            $selected = ($valor == $docenteopc) ? "selected" : "";

            echo "<option value=\"$valor\" $selected>$valor</option>";
        }
        ?>
                </select>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtLugarn" class="formulario__label">Lugar de Nacimiento</label>
            <div class="formulario__grupo-input">
                <input class="form-control" value="<?php echo $resultado['lugar_nacimiento']; ?>" type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="txtLugarn" id="txtLugarn" placeholder="Lugar de Nacimiento">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtNacimiento" class="formulario__label">Fecha de Nacimiento</label>
            <div class="formulario__grupo-input">
                <input class="form-control" value="<?php echo $resultado['fecha_nacimiento']; ?>" type="date" required class="formulario__input border" name="txtNacimiento" id="txtNacimiento" placeholder="Fecha de Nacimiento">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtEdad" class="formulario__label">Edad</label>
            <div class="formulario__grupo-input">
                <input type="text" required readonly value="<?php echo $resultado['edad']; ?>" pattern="^[0-9]\d*$" Max="99" class="formulario__input border form-control" name="txtEdad" id="txtEdad" placeholder="Edad">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <!-- Agregar otros campos según sea necesario -->
        <h4 class="lado"><strong>Ubicación y Comunicación</strong></h4>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtEstado" class="formulario__label">Estado</label>
            <div class="formulario__grupo-input">
                <input type="text" required value="<?php echo $resultado['estado']; ?>" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" Max="99" class="formulario__input border form-control" name="txtEstado" id="txtEstado" placeholder="Estado">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtMunicipio" class="formulario__label">Municipio</label>
            <div class="formulario__grupo-input">
                <input type="text" required value="<?php echo $resultado['municipio']; ?>" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" Max="99" class="formulario__input border form-control" name="txtMunicipio" id="txtMunicipio" placeholder="Estado">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtparroquia" class="formulario__label">Municipio</label>
            <div class="formulario__grupo-input">
                <input type="text" required value="<?php echo $resultado['parroquia']; ?>" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" Max="99" class="formulario__input border form-control" name="txtparroquia" id="txtparroquia" placeholder="Estado">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtSector" class="formulario__label">Sector</label>
            <div class="formulario__grupo-input">
                <input type="text" required value="<?php echo $resultado['sector']; ?>" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border form-control" name="txtSector" id="txtSector" placeholder="Estado">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="txtnrocel" class="formulario__label">Número de Celular</label>
            <div class="formulario__grupo-input">
                <input type="text" required value="<?php echo $resultado['nrocelular']; ?>" pattern="^[0-9]\d*$" class="formulario__input border form-control" name="txtnrocel" id="txtnrocel" placeholder="Estado">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="email" class="formulario__label">Correo</label>
            <div class="formulario__grupo-input">
                <input type="email" required value="<?php echo $resultado['correo']; ?>" class="formulario__input border form-control" name="email" id="email" placeholder="Estado">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <h4 class="lado"><strong>Lugar de Trabajo:</strong></h4>
        
        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="estadotrbj" class="formulario__label">Estado</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" value="<?php echo $resultado['estado_trbj']; ?>" class="formulario__input border form-control" name="estadotrbj" id="estadotrbj" placeholder="Indique el estado de trabajo">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="municipiotrbj" class="formulario__label">Municipio</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" value="<?php echo $resultado['municipio_trbj']; ?>" class="formulario__input border form-control" name="municipiotrbj" id="municipiotrbj" placeholder="Indique el municipio de trabajo">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="parroquiatrbj" class="formulario__label">Parroquia</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" value="<?php echo $resultado['parroquia_trbj']; ?>" class="formulario__input border form-control" name="parroquiatrbj" id="parroquiatrbj" placeholder="Indique la parroquia de trabajo">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>    
        </div>
        
        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="sectortrbj" class="formulario__label">Sector</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" value="<?php echo $resultado['sector_trbj']; ?>" class="formulario__input border form-control" name="sectortrbj" id="sectortrbj" placeholder="Indique el sector de trabajo">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="cargo" class="formulario__label">Cargo que desempeña</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" value="<?php echo $resultado['cargo']; ?>" class="formulario__input border form-control" name="cargo" id="cargo" placeholder="Indique el cargo que desempeña">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="tiempo_servicio" class="formulario__label">Tiempo de servicio</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[A-Z0-9-]*$" value="<?php echo $resultado['tiempo_servicio']; ?>" class="formulario__input border form-control" name="tiempo_servicio" id="tiempo_servicio" placeholder="Indique el tiempo de servicio en la empresa">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <h4 class="lado"><strong>Datos educativos:</strong></h4>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="nivel_instrucción" class="formulario__label">Nivel de instrucción</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[A-Z0-9-]*$" value="<?php echo $resultado['nivel_instruccion']; ?>" class="formulario__input border form-control" name="nivel_instrucción" id="nivel_instrucción" placeholder="Indique el nivel de instrucción">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="carrera" class="formulario__label">Carrera</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[A-Z0-9-]*$" value="<?php echo $resultado['carrera']; ?>" class="formulario__input border form-control" name="carrera" id="carrera" placeholder="Indique la(s) carrera(s) ya finalizada(s)">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

        <div style="width: 29rem;" class="formulario__grupo compartirs" id=grupo__nombre>
            <label for="estudios" class="formulario__label">¿Estudia actualmente?</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[A-Z0-9-]*$" value="<?php echo $resultado['estudios']; ?>" class="formulario__input border form-control" name="estudios" id="estudios" placeholder="Indique los estudios en curso">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>

    <?php endforeach; ?>

            <div class="btn-group" role="group" arial-label="">

                <button type="submit" class="btn btn-warning">Restablecer</button>
                <button type="submit" name="accion" value="Actualizar" class="btn btn-info">Actualizar datos</button>

            </div>
            
            </form>
            
            <form method="POST">

                <!-- datos personales -->
                
                <input type="hidden" name="txtID" id="txtID" value="<?php echo $afiliado['id']; ?>">
                <input type="hidden" name="txtCI" id="txtCI" value="<?php echo $afiliado['cedula']; ?>">
                <input type="hidden" name="txtApe" id="txtApe" value="<?php echo $afiliado['apellidos']; ?>">
                <input type="hidden" name="txtNombre" id="txtNombre" value="<?php echo $afiliado['nombres']; ?>">
                <input type="hidden" name="txtEstu" id="txtEstu" value="<?php echo $afiliado['participar_estudiante']; ?>">
                <input type="hidden" name="txtDoce" id="txtDoce" value="<?php echo $afiliado['participar_docente']; ?>">
                <input type="hidden" name="txtGenero" id="txtGenero" value="<?php echo $afiliado['genero']; ?>">
                <input type="hidden" name="txtCivil" id="txtCivil" value="<?php echo $afiliado['estado_civil']; ?>">
                <input type="hidden" name="txtNacimiento" id="txtNacimiento" value="<?php echo $afiliado['fecha_nacimiento']; ?>">
                <input type="hidden" name="txtEdad" id="txtEdad" value="<?php echo $afiliado['edad']; ?>">
                <input type="hidden" name="txtLugarn" id="txtLugarn" value="<?php echo $afiliado['lugar_nacimiento']; ?>">
                <input type="hidden" name="txtFecha" id="txtFecha" value="<?php echo $afiliado['fecha']; ?>">

                <!-- ubicacionycomunicacion -->

                <input type="hidden" name="txtEstado" id="txtEstado" value="<?php echo $afiliado['estado']; ?>">
                <input type="hidden" name="txtMunicipio" id="txtMunicipio" value="<?php echo $afiliado['municipio']; ?>">
                <input type="hidden" name="txtparroquia" id="txtparroquia" value="<?php echo $afiliado['parroquia']; ?>">
                <input type="hidden" name="txtSector" id="txtSector" value="<?php echo $afiliado['sector']; ?>">
                <input type="hidden" name="txtnrocel" id="txtnrocel" value="<?php echo $afiliado['nrocelular']; ?>">
                <input type="hidden" name="email" id="email" value="<?php echo $afiliado['correo']; ?>">

                <!-- entidad -->

                <input type="hidden" name="estadotrbj" id="estadotrbj" value="<?php echo $afiliado['estado_trbj']; ?>">
                <input type="hidden" name="municipiotrbj" id="municipiotrbj" value="<?php echo $afiliado['municipio_trbj']; ?>">
                <input type="hidden" name="parroquiatrbj" id="parroquiatrbj" value="<?php echo $afiliado['parroquia_trbj']; ?>">
                <input type="hidden" name="sectortrbj" id="sectortrbj" value="<?php echo $afiliado['sector_trbj']; ?>">
                <input type="hidden" name="cargo" id="cargo" value="<?php echo $afiliado['cargo']; ?>">
                <input type="hidden" name="tiempo_servicio" id="tiempo_servicio" value="<?php echo $afiliado['tiempo_servicio']; ?>">

                <!-- datos educativos -->

                <input type="hidden" name="nivel_instrucción" id="nivel_instrucción" value="<?php echo $afiliado['nivel_instruccion']; ?>">
                <input type="hidden" name="carrera" id="carrera" value="<?php echo $afiliado['carrera']; ?>">
                <input type="hidden" name="estudios" id="estudios" value="<?php echo $afiliado['estudios']; ?>">


            </form>
        </div>
    </div>  
</div>


<?php include("./template/pie.php") ?>