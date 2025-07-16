<?php
/********************************************************************
 *  BOOTSTRAP  —  Inicialización global del Sistema Bibliotecario
 ********************************************************************/

/* ========= 1. ZONA HORARIA Y ENCODING ========= */
date_default_timezone_set('America/Monterrey');
mb_internal_encoding('UTF-8');

/* ========= 2. SESIÓN SEGURA ========= */
if (session_id() === '') {
    session_name('sesionBibliotecaUT');
    session_start([
        'cookie_httponly' => true,      // Previene XSS vía JS
        'cookie_secure'   => isset($_SERVER['HTTPS']), // Solo HTTPS
        'use_strict_mode' => true
    ]);
}

/* 2.1 Duración de la sesión (minutos) — permite override vía config */
define('SESSION_MINUTES', $_SESSION['s_Sesion'] ?? 20);   // 20 min por defecto
define('SESSION_SECONDS', SESSION_MINUTES * 60);

/* ========= 3. FUNCIÓN PARA VALIDAR/AUTORIZAR USUARIO ========= */
function ensureAuthenticated(): void
{
    // 3.1 ¿Está autenticado?
    if (($_SESSION['autentificado'] ?? 'NO') !== 'SI') {
        redirectLogin();
    }

    // 3.2 Control de inactividad
    $últimoAcceso = $_SESSION['ultimoAcceso'] ?? null;
    $ahora        = time();

    if ($últimoAcceso !== null && ($ahora - $últimoAcceso) >= SESSION_SECONDS) {
        session_unset();
        session_destroy();
        redirectLogin();
    }

    // 3.3 Refresca el sello de tiempo
    $_SESSION['ultimoAcceso'] = $ahora;
}

function redirectLogin(): void
{
    header('Location: ../login/login.php');
    exit;
}

/* ========= 4. CONEXIÓN PDO A LA BASE DE DATOS ========= */
/*  ⚠️  Idealmente lee las credenciales de un .env o variables de entorno
 *      (aquí se mantienen por claridad del ejemplo).                 */
$dbHost = 'localhost';
$dbUser = 'u421264217_bibliotecaut';
$dbPass = 'BiblioUT25.';
$dbName = 'u421264217_bibliotecaut';

try {
    $dsn  = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
    $opts = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $db = new PDO($dsn, $dbUser, $dbPass, $opts);
} catch (PDOException $e) {
    // Log interno y mensaje neutro al usuario
    error_log('DB‑ERROR: '.$e->getMessage());
    die('Ocurrió un problema al conectar con la base de datos.');
}

/* ========= 5. CABECERAS CACHE (opcional) ========= */
// header('Cache-Control: no-cache, no-store, must-revalidate');
// header('Pragma: no-cache');
// header('Expires: 0');
