<?php
// //se manda llamar la conexion
// include'../conexion/conexion.php';
// //verifico inicio de sesion
// include'../sesiones/verificar_sesion.php';

// //variables post
// $id_prestamo = $_POST["id_prestamo"]; 
// $fecha_devolucion = $_POST["fecha_devolucion"]; 
// $observaciones_prestamo = $_POST["observaciones_prestamo"]; 

// $actualizar = $conexion->query("UPDATE biblioteca_prestamos
// 							SET
// 							 fecha_devolucion='$fecha_devolucion',
// 							 vigente='0',
// 							 observaciones='$observaciones_prestamo'
// 							WHERE
// 							 id_prestamo = $id_prestamo") or die (mysqli_error());

// echo "exito";


<?php
declare(strict_types=1);

// 1. Dependencias
require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.

// 2. Obtener y sanear la entrada
$id_prestamo  = filter_input(INPUT_POST, 'id_prestamo',  FILTER_VALIDATE_INT);
$fecha_dev    = filter_input(INPUT_POST, 'fecha_devolucion', FILTER_SANITIZE_STRING);
$observaciones = filter_input(INPUT_POST, 'observaciones_prestamo', FILTER_SANITIZE_STRING);

// 3. Validaciones mínimas
if ($id_prestamo === false || !$fecha_dev) {
    http_response_code(400);                       // Bad Request
    echo json_encode(['status'=>'error','msg'=>'Datos inválidos']);
    exit;
}

try {
    // 4. Usar prepared statements para evitar inyección
    $stmt = $conexion->prepare(
        'UPDATE biblioteca_prestamos
         SET    fecha_devolucion = ?, 
                vigente          = 0, 
                observaciones    = ?
         WHERE  id_prestamo      = ?'
    );
    if (!$stmt) {
        throw new RuntimeException($conexion->error);
    }

    $stmt->bind_param('ssi', $fecha_dev, $observaciones, $id_prestamo);
    $stmt->execute();

    // 5. Comprobar si realmente se modificó alguna fila
    if ($stmt->affected_rows === 0) {
        http_response_code(404);                   // Not Found
        echo json_encode(['status'=>'error','msg'=>'Préstamo no encontrado']);
    } else {
        echo json_encode(['status'=>'ok']);
    }
} catch (Throwable $e) {
    // 6. Registrar el error sin exponerlo al usuario
    error_log('[BD] '.$e->getMessage());
    http_response_code(500);                       // Internal Server Error
    echo json_encode(['status'=>'error','msg'=>'Error interno']);
}
