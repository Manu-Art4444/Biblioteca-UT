<?php
$bd_host = "localhost";
$bd_usuario = "u421264217_bibliotecaut";
$bd_password = "BiblioUT25.";
$bd_base = "u421264217_bibliotecaut";

$conexion = new mysqli($bd_host, $bd_usuario, $bd_password, $bd_base);
$conexion->set_charset("utf8");

date_default_timezone_set('America/Monterrey');

// header('Cache-Control: no-cache, no-store, must-revalidate');
// header('Pragma: no-cache');
// header('Expires: 0');