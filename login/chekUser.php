<?
//se manda llamar la conexion
include("../conexion/conexion.php");

//Recuperar variable de session
$usuario=$_POST["usuario"];
//contra datos
$rUser = $conexion->query("SELECT DISTINCT
						CASE
							WHEN EXISTS ( SELECT 1 FROM usuarios WHERE nombre_usuario = '$usuario' AND primera = 1 ) THEN '2'
							WHEN EXISTS ( SELECT 1 FROM usuarios WHERE nombre_usuario = '$usuario' ) THEN '1'
							ELSE '0' END AS res
						FROM
							usuarios");
$row = mysqli_fetch_row($rUser);
echo $row[0];