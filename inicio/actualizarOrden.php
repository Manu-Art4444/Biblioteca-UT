<?
include'../conexion/conexion.php';
include'../sesiones/verificar_sesion.php';
$orden=$_POST["orden"]; 
$usuario=$_SESSION["s_clave"];
 
$actualizar = $conexion->query("UPDATE usuarios
							SET 
							 orden_modulos='$orden'
							WHERE
							 id = $usuario") or die (mysqli_error());
if ($actualizar) {
	$res["res"] = "Éxito";
}else{
	$res["res"] = "error";
}
echo json_encode($res);