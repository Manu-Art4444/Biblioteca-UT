<?php 
// include"../conexion/conexion.php";

// $pId=$_POST['id'];

// $consulta=$conexion->query("SELECT
// 						  *
// 						FROM
// 						  biblioteca_libros
// 						WHERE id_libro='$pId' LIMIT 1") or die (mysqli_error());

// $row=mysqli_fetch_array($consulta);
// $res[] = $row; 
// echo json_encode($res);


<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.

// Validar entrada
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID inválido']);
    exit;
}

$pId = intval($_POST['id']); // sanitizar

// Usar consulta preparada
$stmt = $conexion->prepare("SELECT id_libro, titulo, autores, editorial_libro, anio_publicacion, lugar_publicacion, isbn, 
edicion, condicion_libro, numero_identificacion, observaciones FROM biblioteca_libros WHERE id_libro = ? LIMIT 1");
$stmt->bind_param('i', $pId);
$stmt->execute();
$result = $stmt->get_result();

// Devolver resultado
if ($row = $result->fetch_assoc()) {
    echo json_encode($row); // objeto JSON
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Libro no encontrado']);
}
