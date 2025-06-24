<?
//se manda llamar la conexion
include'../conexion/conexion.php';

//verifico inicio de sesion
include'../sesiones/verificar_sesion.php';

//variables post
$activo=$_POST["val"]; 
$gId=$_POST["id"]; 

//se extrae de una funcion date 
$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

/*variable de session*/
$usuario=$_SESSION["s_clave"];

$actualizar = $conexion->query("UPDATE biblioteca_libros
							SET activo = '$activo',
							 fecha = '$fecha',
							 hora= '$hora',
							 usuario = '$usuario'
							WHERE
							 id_libro = $gId") or die (mysqli_error());

echo $activo;