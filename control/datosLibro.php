<?php 
include"../conexion/conexion.php";

$pId=$_POST['id'];

$consulta=$conexion->query("SELECT
						  *
						FROM
						  biblioteca_libros
						WHERE id_libro='$pId' LIMIT 1") or die (mysqli_error());

$row=mysqli_fetch_array($consulta);
$res[] = $row; 
echo json_encode($res);