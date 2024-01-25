<?php 

// Incluimos los archivos necesarios
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("./template/cabecera.php");
include("./template/sesion.php");

// Inicializamos variables y asignamos los valores recibidos en $_POST o un valor vacío si no se reciben
settype($txtID, "integer");
settype($id, "integer");
settype($ultimo_id, "integer");
$ultimo_id=(isset($_POST['ultimo_id']))?$_POST['ultimo_id']:"";
$id=(isset($_POST['id']))?$_POST['id']:"";
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtCI=(isset($_POST['txtCI']))?$_POST['txtCI']:"";
$txtApe=(isset($_POST['txtApe']))?$_POST['txtApe']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtNacimiento=(isset($_POST['txtNacimiento']))?$_POST['txtNacimiento']:"";
$txtGenero=(isset($_POST['txtGenero']))?$_POST['txtGenero']:"";


$txtLugarn=(isset($_POST['txtLugarn']))?$_POST['txtLugarn']:"";
$txtEstu=(isset($_POST['txtEstu']))?$_POST['txtEstu']:"";
$txtFecha=(isset($_POST['txtFecha']))?$_POST['txtFecha']:"";
$txtCivil=(isset($_POST['txtCivil']))?$_POST['txtCivil']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$txtDoce=(isset($_POST['txtDoce']))?$_POST['txtDoce']:"";

$txtEstado=(isset($_POST['txtEstado']))?$_POST['txtEstado']:"";
$txtMunicipio=(isset($_POST['txtMunicipio']))?$_POST['txtMunicipio']:"";
$txtSector=(isset($_POST['txtSector']))?$_POST['txtSector']:"";
$txtnrocel=(isset($_POST['txtnrocel']))?$_POST['txtnrocel']:"";
$email=(isset($_POST['email']))?$_POST['email']:"";
$txtparroquia=(isset($_POST['txtparroquia']))?$_POST['txtparroquia']:"";

$estadotrbj=(isset($_POST['estadotrbj']))?$_POST['estadotrbj']:"";
$municipiotrbj=(isset($_POST['municipiotrbj']))?$_POST['municipiotrbj']:"";
$parroquiatrbj=(isset($_POST['parroquiatrbj']))?$_POST['parroquiatrbj']:"";
$sectortrbj=(isset($_POST['sectortrbj']))?$_POST['sectortrbj']:"";
$cargo=(isset($_POST['cargo']))?$_POST['cargo']:"";
$tiempo_servicio=(isset($_POST['tiempo_servicio']))?$_POST['tiempo_servicio']:"";

$nivel_instrucción=(isset($_POST['nivel_instrucción']))?$_POST['nivel_instruccion']:"";
$carrera=(isset($_POST['carrera']))?$_POST['carrera']:"";
$estudios=(isset($_POST['estudios']))?$_POST['estudios']:"";

$certificacion=(isset($_POST['certificacion']))?$_POST['certificacion']:"";
$cursos_talleres=(isset($_POST['cursos_talleres']))?$_POST['cursos_talleres']:"";
$areas=(isset($_POST['areas']))?$_POST['areas']:"";
$estado_certificado=(isset($_POST['estado_certificado']))?$_POST['estado_certificado']:"";

$componente=(isset($_POST['componente']))?$_POST['componente']:"";
$posee_experiencia=(isset($_POST['posee_experiencia']))?$_POST['posee_experiencia']:"";
$tiempo_experiencia=(isset($_POST['tiempo_experiencia']))?$_POST['tiempo_experiencia']:"";
$division=(isset($_POST['division']))?$_POST['division']:"";
$gerente=(isset($_POST['gerente']))?$_POST['gerente']:"";
$nro_personal=(isset($_POST['nro_personal']))?$_POST['nro_personal']:"";


// Incluimos el archivo que contiene la conexión a la base de datos
include("config/bd.php");

// Evaluamos el valor de $accion para determinar la acción a realizar
switch($accion){
    case "oka":

        $sql = "SELECT * FROM datos_personales WHERE cedula = '$txtCI'";
        $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                // El valor existe, realiza las acciones correspondientes

                echo "<script language='javascript' src='./template/alertaci.js'>";
                echo "</script>";
                // Puedes agregar aquí las acciones que deseas realizar si el valor existe

            } else {
                $sql7 = "SELECT * FROM facilitador WHERE nro_personal = '$nro_personal'";
                $result = $conn->query($sql7);

                if ($result->num_rows > 0) {
                    
                    echo "<script language='javascript' src='./template/alertapersonal.js'>";
                    echo "</script>";

                } else {

                     // Preparamos la sentencia SQL para insertar los datos en la tabla 'datos_personales'
        $sentenciaSQL= $conexion->prepare("INSERT INTO datos_personales (id,nombres,cedula,apellidos,genero,estado_civil,participar_estudiante,participar_docente,lugar_nacimiento,fecha_nacimiento) VALUES (:id,:nombres,:ci,:apellidos,:genero,:civil,:Estu,:Doce,:Lugarn,:Nacimiento);");

        // Ligamos los parámetros a las variables
        $sentenciaSQL->bindParam(':id',$id);
        $sentenciaSQL->bindParam(':nombres',$txtNombre);
        $sentenciaSQL->bindParam(':ci',$txtCI);
        $sentenciaSQL->bindParam(':apellidos',$txtApe);
        $sentenciaSQL->bindParam(':genero',$txtGenero);
        $sentenciaSQL->bindParam(':civil',$txtCivil);
        $sentenciaSQL->bindParam(':Estu',$txtEstu);
        $sentenciaSQL->bindParam(':Doce',$txtDoce);
        $sentenciaSQL->bindParam(':Lugarn',$txtLugarn);
        $sentenciaSQL->bindParam(':Nacimiento',$txtNacimiento);

        // Ejecutamos la sentencia SQL
        $sentenciaSQL->execute();

        // Obtenemos el último ID insertado
        $ultimo_id = $conexion->lastInsertId();

        echo $ultimo_id;
        
        // Preparamos la segunda sentencia SQL para insertar datos en la segunda tabla
        $sentenciaSQL1= $conexion->prepare("INSERT INTO `ubicacionycomunicacion`(`id`, `estado`, `municipio`, `parroquia`, `sector`, `nrocelular`, `correo`) VALUES (:lastid, :estado, :municipio, :parroquia, :sector, :nrocel, :email);");
        
        // Ligamos los parámetros a las variables
        $sentenciaSQL1->bindParam(':lastid',$ultimo_id);
        $sentenciaSQL1->bindParam(':estado',$txtEstado);
        $sentenciaSQL1->bindParam(':municipio',$txtMunicipio);
        $sentenciaSQL1->bindParam(':parroquia',$txtparroquia);
        $sentenciaSQL1->bindParam(':sector',$txtSector);
        $sentenciaSQL1->bindParam(':nrocel',$txtnrocel);
        $sentenciaSQL1->bindParam(':email',$email);

        // Ejecutamos la sentencia SQL
        $sentenciaSQL1->execute();

        //sentencia SQL para la insercion de la 3ra tabla
        $sentenciaSQL2= $conexion->prepare("INSERT INTO `entidad`(`id`, `estado_trbj`, `municipio_trbj`, `parroquia_trbj`, `sector_trbj`, `cargo`, `tiempo_servicio`) VALUES (:lastid, :estado, :municipio, :parroquia, :sector, :cargo, :tiempo_servicio);");

        //Ligando Variables para la insercion de la tabla
        $sentenciaSQL2->bindParam(':lastid',$ultimo_id);
        $sentenciaSQL2->bindParam(':estado',$estadotrbj);
        $sentenciaSQL2->bindParam(':municipio',$municipiotrbj);
        $sentenciaSQL2->bindParam(':parroquia',$parroquiatrbj);
        $sentenciaSQL2->bindParam(':sector',$sectortrbj);
        $sentenciaSQL2->bindParam(':cargo',$cargo);
        $sentenciaSQL2->bindParam(':tiempo_servicio',$tiempo_servicio);
        
        $sentenciaSQL2->execute();

        //sentencia sql para insercion de la 4ta tabla

        function validarVariables(&$variable1, &$variable2, &$variable3) {
            // Verificar y asignar valor predeterminado si la variable está vacía
            $variable1 = (empty($variable1)) ? "Bachiller" : $variable1;
            $variable2 = (empty($variable2)) ? "Sin carreras Universitarias finalizadas" : $variable2;
            $variable3 = (empty($variable3)) ? "Sin Estudios en curso" : $variable3;
        }
        
        validarVariables($nivel_instruccion, $carrera, $estudios);
        
        $sentenciaSQL3= $conexion->prepare("INSERT INTO `datos_educativos`(`id`, `nivel_instruccion`, `carrera`, `estudios`) VALUES (:lastid, :nivel_instruccion, :carrera, :estudios);");

        //Variables preparadas para la tabla
    
        $sentenciaSQL3->bindParam(':lastid',$ultimo_id);
        $sentenciaSQL3->bindParam(':nivel_instruccion',$nivel_instruccion);
        $sentenciaSQL3->bindParam(':carrera',$carrera);
        $sentenciaSQL3->bindParam(':estudios',$estudios);

        $sentenciaSQL3->execute();

        //setencia sql para la 5ta tabla
        $sentenciaSQL4= $conexion->prepare("INSERT INTO `datos_certificacion`(`id`, `certificacion`, `cursos_talleres`, `areas`, `estado_certificado`) VALUES (:lastid, :certificacion, :cursos_talleres, :areas, :estado_certificado);");

        //Variables para la tabla
        $sentenciaSQL4->bindParam(':lastid',$ultimo_id);
        $sentenciaSQL4->bindParam(':certificacion',$certificacion);
        $sentenciaSQL4->bindParam(':cursos_talleres',$cursos_talleres);
        $sentenciaSQL4->bindParam(':areas',$areas);
        $sentenciaSQL4->bindParam(':estado_certificado',$estado_certificado);

        $sentenciaSQL4->execute();

        function validarVariables(&$variabla1) {
            // Verificar y asignar valor predeterminado si la variable está vacía
            $variablea1 = (empty($variablea1)) ? "Sin tiempo de experiencia" : $variablea1;
        }

        validarVariables($tiempo_experiencia);

        //sentencia sql para la 6ta tabla
        $sentenciaSQL5= $conexion->prepare("INSERT INTO `facilitador`(`id`, `componente`, `posee_experiencia`, `tiempo_experiencia`, `division`, `gerente`, `nro_personal`) VALUES (:lastid, :componente, :posee_experiencia, :tiempo_experiencia, :division, :gerente, :nro_personal);");

        //variables de la tabla
        $sentenciaSQL5->bindParam(':lastid',$ultimo_id);
        $sentenciaSQL5->bindParam(':componente',$componente);
        $sentenciaSQL5->bindParam(':posee_experiencia',$posee_experiencia);
        $sentenciaSQL5->bindParam(':tiempo_experiencia',$tiempo_experiencia);
        $sentenciaSQL5->bindParam(':division',$division);
        $sentenciaSQL5->bindParam(':gerente',$gerente);
        $sentenciaSQL5->bindParam(':nro_personal',$nro_personal);

        $sentenciaSQL5->execute();

        header("Location: ./agregar.php");
                }
            }


       

    break;
}
?>

<title>Agregar</title>
<link rel="stylesheet" href="css/agregar.css">

<main>
    <form action="" method="post" onsubmit="return validar()" class="formulario" id="formulario">
        <!-- Datos Personales -->
        <h1>Datos Personales:</h1>
        <br>
        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtNombre" class="formulario__label">Nombres</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="txtNombre" id="txtNombre" placeholder="Indique sus nombres">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtApe" class="formulario__label">Apellidos</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="txtApe" id="txtApe" placeholder="Indique sus apellidos">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtCI" class="formulario__label">Cédula de indentidad</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[A-Z0-9-]*$" class="formulario__input border" name="txtCI" id="txtCI" placeholder="Indique su cédula de identidad">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener numeros solamente</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtGenero" class="formulario__label">Género</label>
            <div class="formulario__grupo-input">
            <select type="text"  required name="txtGenero" class="form-control border" id="txtGenero">
                        <option value="">Selecciona una opción</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                </select>
            </div>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtCivil" class="formulario__label">Estado Civil</label>
            <div class="formulario__grupo-input">
            <select type="text"  required name="txtCivil" class="form-control border" id="txtCivil">
                        <option value="">Selecciona una opción</option>
                        <option value="Soltero(a)">Soltero(a)</option>
                        <option value="Casado(a)">Casado(a)</option>
                        <option value="Viudo(a)">Viudo(a)</option>
                </select>
            </div>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtEstu" class="formulario__label">¿Desea Participar como estudiante?</label>
            <div class="formulario__grupo-input">
            <select type="text"  required name="txtEstu" class="form-control border" id="txtEstu">
                        <option value="">Selecciona una opción</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                </select>
            </div>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtDoce" class="formulario__label">¿Desea Participar como docente?</label>
            <div class="formulario__grupo-input">
            <select type="text"  required name="txtDoce" class="form-control border" id="txtDoce">
                        <option value="">Selecciona una opción</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                </select>
            </div>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtLugarn" class="formulario__label">Lugar de Nacimiento</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="txtLugarn" id="txtLugarn" placeholder="Lugar de Nacimiento">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtNacimiento" class="formulario__label">Fecha de Nacimiento</label>
            <div class="formulario__grupo-input">
                <input type="date" required class="formulario__input border" name="txtNacimiento" id="txtNacimiento" placeholder="Fecha de Nacimiento">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>
        <br>

        <h1>Ubicación y Comunicación del Trabajador:</h1>
        <br>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtEstado" class="formulario__label">Estado</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="txtEstado" id="txtEstado" placeholder="Indique el estado de residencia">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtMunicipio" class="formulario__label">Municipio</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="txtMunicipio" id="txtMunicipio" placeholder="Indique el municipio donde reside">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>
        
        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtparroquia" class="formulario__label">Parroquia</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="txtparroquia" id="txtparroquia" placeholder="Indique su parroquia de residencia">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtSector" class="formulario__label">Sector</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="txtSector" id="txtSector" placeholder="Indique su sector de residencia">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="txtnrocel" class="formulario__label">Número de celular:</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[0-9]\d*$" class="formulario__input border" name="txtnrocel" id="txtnrocel" placeholder="Indique su número de celular">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Solo debe contener numeros.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="email" class="formulario__label">Correo electronico:</label>
            <div class="formulario__grupo-input">
                <input type="email" required class="formulario__input border" name="email" id="email" placeholder="Introduzca su correo electronico">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        </div>
        
        <h1>Lugar de Trabajo:</h1>
        <br>
        
        <div class="formulario__grupo" id=grupo__nombre>
            <label for="estadotrbj" class="formulario__label">Estado</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="estadotrbj" id="estadotrbj" placeholder="Indique el estado de trabajo">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="municipiotrbj" class="formulario__label">Municipio</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="municipiotrbj" id="municipiotrbj" placeholder="Indique el municipio de trabajo">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>
        
        <div class="formulario__mensaje" id="formulario__mensaje">
            <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente.
            </p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="parroquiatrbj" class="formulario__label">Parroquia</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="parroquiatrbj" id="parroquiatrbj" placeholder="Indique la parroquia de trabajo">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>
        
        <div class="formulario__grupo" id=grupo__nombre>
            <label for="sectortrbj" class="formulario__label">Sector</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="sectortrbj" id="sectortrbj" placeholder="Indique el sector de trabajo">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="cargo" class="formulario__label">Cargo que desempeña</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="cargo" id="cargo" placeholder="Indique el cargo que desempeña">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="tiempo_servicio" class="formulario__label">Tiempo de servicio</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[A-Z0-9-]*$" class="formulario__input border" name="tiempo_servicio" id="tiempo_servicio" placeholder="Indique el tiempo de servicio en la empresa">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        
        <h1>Datos Educativos:</h1>
        <br>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="nivel_instruccion" class="formulario__label">Nivel de instrucción</label>
            <div class="formulario__grupo-input">
            <select type="text" required name="nivel_instruccion" class="form-control border" id="nivel_instruccion">
                        <option value="">Selecciona una opción</option>
                        <option value="Bachiller">Bachiller</option>
                        <option value="T.S.U.">T.S.U.</option>
                        <option value="Universitario">Universitario</option>
                </select>
            </div>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="carrera" class="formulario__label">Carrera</label>
            <div class="formulario__grupo-input">
                <input type="text" pattern="^[a-zA-ZÀ-ÿ,\s]{1,40}$" class="formulario__input border" name="carrera" id="carrera" placeholder="Indique la(s) carreras ya finalizadas">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="estudios" class="formulario__label">¿Estudia actualemte?</label>
            <div class="formulario__grupo-input">
                <input type="text" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="estudios" id="estudios" placeholder="Dejar vacio si no estudia actualmente, caso contrario indicar los estudios en curso">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <br>
        <h1>Datos para la certificacion:</h1>
        <br>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="certificacion" class="formulario__label">¿Requiere certificación?</label>
            <div class="formulario__grupo-input">
            <select type="text" required name="certificacion" class="form-control border" id="certificacion">
                        <option value="">Selecciona una opción</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                </select>
            </div>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="areas" class="formulario__label">Área para la certificación</label>
            <div class="formulario__grupo-input">
                <input type="text" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="areas" id="areas" placeholder="En caso de ser afirmativo, indique el área o las áreas requeridas">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="cursos_talleres" class="formulario__label">Talleres y cursos</label>
            <div class="formulario__grupo-input">
                <input type="text" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="cursos_talleres" id="cursos_talleres" placeholder="Indique talleres y cursos realizados, especificando institución y fecha">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="estado_certificado" class="formulario__label">Estado de la certificación</label>
            <div class="formulario__grupo-input">
            <select type="text" name="estado_certificado" class="form-control border" id="estado_certificado">
                        <option value="">Selecciona una opción</option>
                        <option value="Entregado">Entregado</option>
                        <option value="No entregado">No entregado</option>
                        <option value="En tramite">En tramite</option>
                        <option value="Ninguno">Ninguno</option>
                </select>
            </div>
        </div>

        <h1>Datos complementarios del facilitador/facilitadora</h1>
        <br>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="componente" class="formulario__label">¿Posee componente docente?</label>
            <div class="formulario__grupo-input">
            <select type="text" required name="componente" class="form-control border" id="componente">
                        <option value="">Selecciona una opción</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                </select>
            </div>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="posee_experiencia" class="formulario__label">¿Posee experiencia como docente?</label>
            <div class="formulario__grupo-input">
            <select type="text" required name="posee_experiencia" class="form-control border" id="posee_experiencia">
                        <option value="">Selecciona una opción</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                </select>
            </div>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="tiempo_experiencia" class="formulario__label">¿Tiempo de experiencia?</label>
            <div class="formulario__grupo-input">
                <input type="text" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="tiempo_experiencia" id="tiempo_experiencia" placeholder="De ser afirmativa su respuesta, indique tiempo de experiencia como docente">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="division" class="formulario__label">Division</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="division" id="division" placeholder="Indique su division/área de trabajo">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="gerente" class="formulario__label">Gerente territorial</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" class="formulario__input border" name="gerente" id="gerente" placeholder="Indique su gerente territorial">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo" id=grupo__nombre>
            <label for="nro_personal" class="formulario__label">Número de personal</label>
            <div class="formulario__grupo-input">
                <input type="text" required pattern="^[a-zA-ZÀ-ÿ\s0-9-]{1,40}$" class="formulario__input border" name="nro_personal" id="nro_personal" placeholder="Indique su número de personal">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Debe Contener Letras y espacios, pueden llevar acentos.</p>
        </div>

        <div class="formulario__grupo formulario__grupo-btn-enviar">
            <button type="submit" class="formulario__btn" value="oka" name="accion">Enviar</button>
            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario se envio correctamente!</p>
        </div>

        
    </form>
</main>
<!-- <script src="js/formulario.js"></script> -->
<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<?php include("./template/pie.php") ?>