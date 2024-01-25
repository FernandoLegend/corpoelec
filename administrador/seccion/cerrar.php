<?php
session_start();
$_SESSION['seguridad']="";
session_destroy();
header('Location:../../login.php');
?>