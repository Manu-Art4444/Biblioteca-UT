<?
//se manda llamar la conexion
include("../conexion/conexion.php");

//Recuperar variable de session
$identi=$_POST["claveid"];
$pass=$_POST["pass"];
$contras=md5("$pass");
//contra datos
$contra = $conexion->query("SELECT id FROM usuarios WHERE contra='$contras' AND id =$identi");
echo (mysqli_num_rows($contra) > 0)?"1":"0";
?>