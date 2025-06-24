<?php 
// Se realiza la conexón con los datos especificados anteriormente
function contarUrgencias($fecha1, $fecha2,$cedula)
{
	global $conn;
	$sql = "SELECT Count(*) AS enero
	FROM URGENCIAS
	WHERE (FECHAINGRESO Between "."#".$fecha1."#"." And "."#".$fecha2."#"." ) AND CEDULARESP LIKE '%".$cedula."%'";
	// Se ejecuta la consulta y se guardan los resultados en el recordset rs
	$rs = odbc_exec( $conn, $sql );
	return odbc_result($rs,"enero"); 
}
function totalUrgencias($fecha1, $fecha2)
{
	global $conn;
	$sql = "SELECT Count(*) AS enero
	FROM URGENCIAS
	WHERE (FECHAINGRESO Between "."#".$fecha1."#"." And "."#".$fecha2."#"." )";
	// Se ejecuta la consulta y se guardan los resultados en el recordset rs
	$rs = odbc_exec( $conn, $sql );
	return odbc_result($rs,"enero"); 
}
 ?>