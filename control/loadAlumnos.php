<?php 
require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.

$alumno = $_GET["term"];

$combo3 = $conexion->query("SELECT a.id_alumno, CONCAT(p.nombre, ' ', p.ap_paterno, ' ', p.ap_materno) as nombreAlumno
						 FROM alumnos as a INNER JOIN personas as p ON p.id = a.id_persona 
						WHERE a.activo = 1 AND ( a.situacion = 'Regular' OR  a.situacion = 'Reingreso') AND CONCAT(p.nombre, ' ', p.ap_paterno, ' ', p.ap_materno) LIKE '%$alumno%' || matricula LIKE '%$alumno%' || matricula LIKE '%$alumno%'
						ORDER BY
							nombreAlumno
						LIMIT 20");

$n = 0;
while ($row = mysqli_fetch_row($combo3)) {
	$res[$n]["id"] = $row[0];
	$res[$n]["text"] = $row[0]." - ".$row[1];
	$n++;
}
echo json_encode($res);