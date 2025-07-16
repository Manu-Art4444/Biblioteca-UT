<?
// //se manda llamar la conexion
// include("../conexion/conexion.php");

// //verifico inicio de sesion
// include("../sesiones/verificar_sesion.php");

// //variables post
// $id_libro = $_POST["id_libro"]; 
// $id_alumno = $_POST["id_alumno"]; 
// $fecha_prestamo = $_POST["fecha_prestamo"]; 
// $fecha_compromiso = $_POST["fecha_compromiso"]; 
// $observaciones = $_POST["observaciones"]; 

// //se extrae de una funcion date 
// $fecha=date("Y-m-d"); 
// $hora=date("H:i:s");
// $activo=1;
// /*variable de session*/
// $usuario=$_SESSION["s_clave"];

// $insertar= $conexion->query("INSERT INTO biblioteca_prestamos (id_libro, id_alumno, fecha_prestamo, fecha_compromiso, observaciones, vigente) 
// VALUES ('$id_libro','$id_alumno','$fecha_prestamo','$fecha_compromiso','$observaciones','1')") or die (mysqli_error());

// echo "exito";


<?php
declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.

/* 1. Filtrar y validar entrada */
$id_libro   = filter_input(INPUT_POST, 'id_libro',  FILTER_VALIDATE_INT);
$id_alumno  = filter_input(INPUT_POST, 'id_alumno', FILTER_VALIDATE_INT);

$fecha_prestamo   = trim($_POST['fecha_prestamo']   ?? '');
$fecha_compromiso = trim($_POST['fecha_compromiso'] ?? '');
$observaciones    = trim($_POST['observaciones']    ?? '');

/* Validar fechas rápidas (yyyy-mm-dd) */
$fecha_regex = '/^\d{4}-\d{2}-\d{2}$/';
if (!$id_libro || !$id_alumno ||
    !preg_match($fecha_regex, $fecha_prestamo) ||
    !preg_match($fecha_regex, $fecha_compromiso)) {
    http_response_code(400);
    echo json_encode(['status'=>'error','msg'=>'Datos inválidos']);
    exit;
}

$usuario = $_SESSION['s_clave'] ?? '';
$vigente = 1;

try {
    /* 2. Sentencia preparada */
    $stmt = $conexion->prepare(
        'INSERT INTO biblioteca_prestamos
         (id_libro,id_alumno,fecha_prestamo,fecha_compromiso,observaciones,vigente,usuario_creo)
         VALUES (?,?,?,?,?,?,?)'
    );
    if (!$stmt) {
        throw new RuntimeException($conexion->error);
    }

    $stmt->bind_param('iisssis',
        $id_libro,
        $id_alumno,
        $fecha_prestamo,
        $fecha_compromiso,
        $observaciones,
        $vigente,
        $usuario
    );

    $stmt->execute();

    /* 3. Respuesta */
    echo json_encode(['status'=>'ok','id'=>$stmt->insert_id]);
} catch (Throwable $e) {
    error_log('[BD] '.$e->getMessage());
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>'Error interno']);
}
