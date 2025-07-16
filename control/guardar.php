<?
// //se manda llamar la conexion
// include("../conexion/conexion.php");

// //verifico inicio de sesion
// include("../sesiones/verificar_sesion.php");

// //variables post
// $id_modulo=$_POST["id_modulo"]; 
// $id_clasificacion=$_POST["id_clasificacion"]; 
// $titulo=$_POST["titulo"]; 
// $autores=$_POST["autores"];
// $editorial_libro=$_POST["editorial_libro"];
// $anio_publicacion=$_POST["anio_publicacion"];
// $lugar_publicacion=$_POST["lugar_publicacion"];
// $isbn=$_POST["isbn"];
// $edicion=$_POST["edicion"];
// $condicion_libro=$_POST["condicion_libro"];
// $numero_identificacion=$_POST["numero_identificacion"];
// $observaciones=$_POST["observaciones"];

// //se extrae de una funcion date 
// $fecha=date("Y-m-d"); 
// $hora=date ("H:i:s");
// $activo=1;
// /*variable de session*/
// $usuario=$_SESSION["s_clave"];

// $insertar= $conexion->query("INSERT INTO biblioteca_libros
// 							(id_modulo,id_clasificacion,titulo,autores,editorial_libro,anio_publicacion,lugar_publicacion,
// 							isbn,edicion,condicion_libro,numero_identificacion,observaciones,fecha,hora,usuario,activo)
// 						VALUES
// 							('$id_modulo','$id_clasificacion','$titulo','$autores','$editorial_libro','$anio_publicacion','$lugar_publicacion',
// 							'$isbn','$edicion','$condicion_libro','$numero_identificacion','$observaciones','$fecha','$hora','$usuario',$activo)
// 						") or die (mysqli_error());

// echo "exito";


<?php
declare(strict_types=1);

// 1. Dependencias
require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.

// 2. Recoger y validar entrada
$id_modulo        = filter_input(INPUT_POST, 'id_modulo',        FILTER_VALIDATE_INT);
$id_clasificacion = filter_input(INPUT_POST, 'id_clasificacion', FILTER_VALIDATE_INT);
$titulo           = trim($_POST['titulo']   ?? '');
$autores          = trim($_POST['autores']  ?? '');
$editorial        = trim($_POST['editorial_libro'] ?? '');
$anio_publicacion = filter_input(INPUT_POST, 'anio_publicacion', FILTER_VALIDATE_INT);
$lugar            = trim($_POST['lugar_publicacion'] ?? '');
$isbn             = trim($_POST['isbn'] ?? '');
$edicion          = trim($_POST['edicion'] ?? '');
$condicion        = trim($_POST['condicion_libro'] ?? '');
$numero_id        = filter_input(INPUT_POST, 'numero_identificacion', FILTER_VALIDATE_INT);
$observaciones    = trim($_POST['observaciones'] ?? '');

// 3. Validaciones mínimas
if (!$id_modulo || !$id_clasificacion || !$titulo) {
    http_response_code(400); // Bad Request
    echo json_encode(['status'=>'error','msg'=>'Datos requeridos incompletos']);
    exit;
}

$fecha = date('Y-m-d');
$hora  = date('H:i:s');
$usuario = $_SESSION['s_clave'] ?? '';
$activo  = 1;

try {
    // 4. Sentencia preparada
    $stmt = $conexion->prepare(
        'INSERT INTO biblioteca_libros
         (id_modulo,id_clasificacion,titulo,autores,editorial_libro,anio_publicacion,
          lugar_publicacion,isbn,edicion,condicion_libro,numero_identificacion,
          observaciones,fecha,hora,usuario,activo)
         VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
    );
    if (!$stmt) {
        throw new RuntimeException($conexion->error);
    }

    $stmt->bind_param(
        'iisssisisssissii',
        $id_modulo,
        $id_clasificacion,
        $titulo,
        $autores,
        $editorial,
        $anio_publicacion,
        $lugar,
        $isbn,
        $edicion,
        $condicion,
        $numero_id,
        $observaciones,
        $fecha,
        $hora,
        $usuario,
        $activo
    );

    $stmt->execute();

    echo json_encode(['status'=>'ok','id'=>$stmt->insert_id]);
} catch (Throwable $e) {
    error_log('[BD] '.$e->getMessage());        // log interno
    // Si el error es clave duplicada, devuelve 409; cualquier otro → 500
    if ($conexion->errno === 1062) {
        http_response_code(409);
        $msg = 'Registro duplicado (ISBN o número de identificación ya existe)';
    } else {
        http_response_code(500);
        $msg = 'Error interno';
    }
    echo json_encode(['status'=>'error','msg'=>$msg]);
}
