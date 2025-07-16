<?php
declare(strict_types=1);
require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.

header('Content-Type: application/json; charset=utf-8');

try {
    // 1. Validación rápida
    $required = [
        'e_id'               => FILTER_VALIDATE_INT,
        'e_modulo'           => FILTER_VALIDATE_INT,
        'e_clasificacion'    => FILTER_VALIDATE_INT,
        'e_titulo'           => FILTER_UNSAFE_RAW,
        'e_autores'          => FILTER_UNSAFE_RAW,
        'e_editorial_libro'  => FILTER_UNSAFE_RAW,
        'e_anio_publicacion' => FILTER_VALIDATE_INT,
        'e_lugar_publicacion'=> FILTER_UNSAFE_RAW,
        'e_isbn'             => FILTER_UNSAFE_RAW,
        'e_edicion'          => FILTER_UNSAFE_RAW,
        'e_condicion_libro'  => FILTER_UNSAFE_RAW,
        'e_numero_identificacion' => FILTER_UNSAFE_RAW,
        'e_observaciones'    => FILTER_UNSAFE_RAW,
    ];

    $data = filter_input_array(INPUT_POST, $required, true);
    if (in_array(false, $data, true) || in_array(null, $data, true)) {
        http_response_code(400);
        throw new RuntimeException('Parámetros incompletos o inválidos');
    }

    // 2. Preparar consulta
    $sql = <<<SQL
        UPDATE biblioteca_libros SET
            id_modulo              = :modulo,
            id_clasificacion       = :clasificacion,
            titulo                 = :titulo,
            autores                = :autores,
            editorial_libro        = :editorial,
            anio_publicacion       = :anio,
            lugar_publicacion      = :lugar,
            isbn                   = :isbn,
            edicion                = :edicion,
            condicion_libro        = :condicion,
            numero_identificacion  = :numId,
            observaciones          = :obs,
            actualizado_por        = :usuario,
            actualizado_en         = NOW()
        WHERE id_libro = :id
        LIMIT 1
    SQL;

    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':modulo'       => $data['e_modulo'],
        ':clasificacion'=> $data['e_clasificacion'],
        ':titulo'       => trim($data['e_titulo']),
        ':autores'      => trim($data['e_autores']),
        ':editorial'    => trim($data['e_editorial_libro']),
        ':anio'         => $data['e_anio_publicacion'],
        ':lugar'        => trim($data['e_lugar_publicacion']),
        ':isbn'         => trim($data['e_isbn']),
        ':edicion'      => trim($data['e_edicion']),
        ':condicion'    => trim($data['e_condicion_libro']),
        ':numId'        => trim($data['e_numero_identificacion']),
        ':obs'          => trim($data['e_observaciones']),
        ':usuario'      => $_SESSION['s_clave'],
        ':id'           => $data['e_id'],
    ]);

    echo json_encode(['status' => 'ok']);
} catch (Throwable $e) {
    // registrar error a archivo/monitoring
    error_log($e);
    http_response_code($e instanceof RuntimeException ? 400 : 500);
    echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
}
