<?
//se manda llamar la conexion
include("../conexion/conexion.php");

//iniciamos la sesión 
session_name("sessionUclamOnlinecolbach"); 
session_start(); 
$_SESSION["s_Pvez"] = 0;

//verifico inicio de sesion
include("../sesiones/verificar_sesion.php");

//Recuperar variable de session
$identi=$_POST["claveid"];
$pass=$_POST["pass"];
$contras=md5("$pass");
//actualizar datos
$actualizar = $conexion->query("UPDATE usuarios set primera=0 , contra='$contras'  where id =$identi ");

?>