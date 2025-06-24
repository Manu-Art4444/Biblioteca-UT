<?
//se manda llamar la conexion
include("../conexion/conexion.php");

//verifico inicio de sesion
include("../sesiones/verificar_sesion.php");

//variables post
$id_libro = $_POST["id_libro"]; 
$id_alumno = $_POST["id_alumno"]; 
$fecha_prestamo = $_POST["fecha_prestamo"]; 
$fecha_compromiso = $_POST["fecha_compromiso"]; 
$observaciones = $_POST["observaciones"]; 

//se extrae de una funcion date 
$fecha=date("Y-m-d"); 
$hora=date("H:i:s");
$activo=1;
/*variable de session*/
$usuario=$_SESSION["s_clave"];

$insertar= $conexion->query("INSERT INTO biblioteca_prestamos (id_libro, id_alumno, fecha_prestamo, fecha_compromiso, observaciones, vigente) VALUES ('$id_libro','$id_alumno','$fecha_prestamo','$fecha_compromiso','$observaciones','1')") or die (mysqli_error());

echo "exito";