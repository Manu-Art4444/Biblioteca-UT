<?php
include'../conexion/conexion.php';

$combo1 = $conexion->query("SELECT * FROM modulo_estante ORDER BY id_modulo");
$num1=mysqli_num_rows($combo1);

$combo2 = $conexion->query("SELECT * FROM biblioteca_clasificacion_libros ORDER BY id_clasificacion");
$num2=mysqli_num_rows($combo2);

function mysqli_result($res, $row, $field=0) {
    mysqli_data_seek($res, $row);
    return mysqli_fetch_array($res)[$field];
}