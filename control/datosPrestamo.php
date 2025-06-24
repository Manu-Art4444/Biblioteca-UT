<?php 
include"../conexion/conexion.php";

$pId=$_POST['id'];

$consulta=$conexion->query("SELECT
						  p.*, l.*, a.matricula, CONCAT(per.nombre, ' ', per.ap_materno, ' ', per.ap_materno) as alumno, p.observaciones as observaciones_prestamo
						FROM
							biblioteca_prestamos as p 
						INNER JOIN biblioteca_libros as l ON p.id_libro = l.id_libro
						INNER JOIN alumnos as a ON p.id_alumno = a.id_alumno
						INNER JOIN personas as per ON per.id = a.id_persona
						WHERE id_prestamo='$pId' LIMIT 1") or die (mysqli_error());

$row=mysqli_fetch_array($consulta);
$res[] = $row; 
echo json_encode($res);