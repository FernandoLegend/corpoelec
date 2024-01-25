<?php
session_start();
include("./administrador/config/bd.php");
$user=(isset($_POST['usuario']))?$_POST['usuario']:"";
$contra=(isset($_POST['contrasenia']))?$_POST['contrasenia']:"";
$alert=(isset($_POST['alert']))?$_POST['alert']:"";
$con=conectar();
if (!empty($user && (!empty($_POST['contrasenia'])))){

    if($_POST){

        if(($_POST['usuario']=="admin")&&($_POST['contrasenia']=="sistema")){

            $_SESSION['usuario']="ok";
            $_SESSION['nombreUsuario']="Administrador";
            $_SESSION['seguridad']="nivel0";
            header("Location:administrador/animacion.php");        

        }if(($_POST['usuario']=="Contador")&&($_POST['contrasenia']=="Contador")){

            $_SESSION['usuario']="koe";
            $_SESSION['nombreUsuario']="Contador";
            $_SESSION['seguridad']="nivel2";
            header("Location:tesorero-contador/animacion.php");        

        }if(($_POST['usuario']=="Tesorero")&&($_POST['contrasenia']=="Tesorero")){

            $_SESSION['usuario']="koe";
            $_SESSION['nombreUsuario']="Tesorero";
            $_SESSION['seguridad']="nivel2";
            header("Location:tesorero-contador/animacion.php");
        
        }if(($_POST['usuario']!="Tesorero")&&($_POST['usuario']!="Contador")&&($_POST['usuario']!="admin")&&($_POST['usuario']!="")){

            $records = $conexion->prepare('SELECT * FROM afiliados WHERE cedula=:cedula and cedula=:contrasenia') ;
            $_SESSION['seguridad']="nivel3";
            $_SESSION['usuario']="oka";
            $_SESSION['Identity']=$contra;
            $records->bindParam(':cedula',$user);
            $records->bindParam(':contrasenia',$contra);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            $valor = $records->fetch(PDO::FETCH_COLUMN);?>
            <form method="POST">
                <input type="hidden" name="cedusession" id="cedusession">
            </form>
            <?php
            $message = '';
            

            if ($results > 0 ){

                if(($results['cedula'] == $user)&&($results['cedula'] == $contra)){
                    $_SESSION['usuario']="oka";
                    $_SESSION['nombreUsuario']=$results['nombres'];
                    $_SESSION['seguridad']="nivel3";
                    header("Location:afiliados/animacion.php");
                    
                }
            }
        }if($alert == "ok"){
            $message = "Favor de ingresar los datos correctos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/inicio.css">    
    <link rel="stylesheet" href="./css/index.css">
    <link rel="shortcut icon" href="./administrador/img/logo1.png" />
    <link rel="stylesheet" href="./pagina/css/1login.css">
    <script src="./alerta.js"></script>

</head>
<body>
    
<div class="padre">
    
        <div class="login-box">
            
            <h1 class="title-login">INICIAR SESION</h1>                        
            <br>
            <?php if(!empty($message)) : ?>                
                <script>
                    alert("Usuario y/o Contraseña Incorrecctos");
                </script>
            <?php endif; ?>
            <form method="POST">
            <div class = "form-group">
                <!-- User name -->
                <input type="text" class="input-name inputs form-control" name="usuario" placeholder="Usuario">
                <!-- User password -->
                <br>
                <input type="password" class="input-password inputs form-control" name="contrasenia" placeholder="Contraseña">
                <!-- recuerdame -->

                <!-- User boton -->
                <br>
                <input type="hidden" class="input-password inputs form-control" name="alert" value="ok">
                <input type="submit" value="Ingresar" class="input-submit inputs botoni">
                
                
                
                <!-- registrarse -->
                
            </div>
            </form>
        </div>
    </div>


</body>
</html>