<?php
// include'../conexion/conexion.php';

// $combo1 = $conexion->query("SELECT * FROM modulo_estante ORDER BY id_modulo");
// $num1=mysqli_num_rows($combo1);

// $combo2 = $conexion->query("SELECT * FROM biblioteca_clasificacion_libros ORDER BY id_clasificacion");
// $num2=mysqli_num_rows($combo2);

// function mysqli_result($res, $row, $field=0) {
//     mysqli_data_seek($res, $row);
//     return mysqli_fetch_array($res)[$field];
// }


require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.

$modulos = [];
$clasificaciones = [];

// Consulta módulos
$result = $conexion->query("SELECT id_modulo, nombre FROM modulo_estante ORDER BY id_modulo");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $modulos[] = $row;
    }
} else {
    die("Error en módulos: " . $conexion->error);
}

// Consulta clasificaciones
$result2 = $conexion->query("SELECT id_clasificacion, nombre FROM biblioteca_clasificacion_libros ORDER BY id_clasificacion");
if ($result2) {
    while ($row = $result2->fetch_assoc()) {
        $clasificaciones[] = $row;
    }
} else {
    die("Error en clasificaciones: " . $conexion->error);
}

// Si es para AJAX / JSON:
header('Content-Type: application/json');
echo json_encode([
    'modulos' => $modulos,
    'clasificaciones' => $clasificaciones
]);
