<?php 
// include"../conexion/conexion.php";

// $pId=$_POST['id'];

// $consulta=$conexion->query("SELECT
// 						  p.*, l.*, a.matricula, CONCAT(per.nombre, ' ', per.ap_materno, ' ', per.ap_materno) as alumno, p.observaciones as observaciones_prestamo
// 						FROM
// 							biblioteca_prestamos as p 
// 						INNER JOIN biblioteca_libros as l ON p.id_libro = l.id_libro
// 						INNER JOIN alumnos as a ON p.id_alumno = a.id_alumno
// 						INNER JOIN personas as per ON per.id = a.id_persona
// 						WHERE id_prestamo='$pId' LIMIT 1") or die (mysqli_error());

// $row=mysqli_fetch_array($consulta);
// $res[] = $row; 
// echo json_encode($res);


<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.

// Validación
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID inválido']);
    exit;
}

$pId = intval($_POST['id']);

$sql = <<<SQL
SELECT
  p.*, 
  l.*, 
  a.matricula, 
  CONCAT(per.nombre, ' ', per.ap_paterno, ' ', per.ap_materno) as alumno,
  p.observaciones as observaciones_prestamo
FROM
  biblioteca_prestamos AS p
INNER JOIN biblioteca_libros AS l ON p.id_libro = l.id_libro
INNER JOIN alumnos AS a ON p.id_alumno = a.id_alumno
INNER JOIN personas AS per ON per.id = a.id_persona
WHERE p.id_prestamo = ?
LIMIT 1
SQL;

$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $pId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Préstamo no encontrado']);
}
