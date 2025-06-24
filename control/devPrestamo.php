<?php
//se manda llamar la conexion
include'../conexion/conexion.php';
//verifico inicio de sesion
include'../sesiones/verificar_sesion.php';

//variables post
$id_prestamo = $_POST["id_prestamo"]; 
$fecha_devolucion = $_POST["fecha_devolucion"]; 
$observaciones_prestamo = $_POST["observaciones_prestamo"]; 

$actualizar = $conexion->query("UPDATE biblioteca_prestamos
							SET
							 fecha_devolucion='$fecha_devolucion',
							 vigente='0',
							 observaciones='$observaciones_prestamo'
							WHERE
							 id_prestamo = $id_prestamo") or die (mysqli_error());

echo "exito";