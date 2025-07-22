<?
require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.
session_start();

if (!isset($_POST["val"], $_POST["id"], $_SESSION["s_clave"])) {
    exit("Acceso no autorizado.");
}

$activo = ($_POST["val"] == "1") ? "1" : "0";
$gId = intval($_POST["id"]);
$fecha = date("Y-m-d");
$hora = date("H:i:s");
$usuario = $_SESSION["s_clave"];

// Consulta segura con prepared statement
$stmt = $conexion->prepare("UPDATE biblioteca_libros 
                            SET activo = ?, fecha = ?, hora = ?, usuario = ?
                            WHERE id_libro = ?");
$stmt->bind_param("ssssi", $activo, $fecha, $hora, $usuario, $gId);

if ($stmt->execute()) {
    echo $activo;
} else {
    error_log("Error al actualizar estado: " . $stmt->error);
    echo "error";
}
