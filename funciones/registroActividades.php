<?php  

function Actividad( $icono , $descripcion , $actividad) {

	global $conexion; 

	$cadena = iconv('ISO-8859-1','UTF-8//TRANSLIT',$descripcion);
	$cadena1 = iconv('ISO-8859-1','UTF-8//TRANSLIT',$actividad);
	$desc=$_SESSION["s_NombreCorto"]." ".$cadena." con perfil ". $_SESSION["s_NombrePerfil"];
	//inserto los datos del usuario
	$sIdUsuario=$_SESSION["s_clave"];
	$sIdPersona=$_SESSION["s_id_persona"];
	$p_fecha=date("Y-m-d"); 
	$p_hora=date ("H:i:s");

	 
	$insertar = $conexion->query("INSERT INTO actividades (icono,descripcion,filtro,id_usuario,id_persona,fecha,hora) VALUES 
                                               ('$icono','$desc','$cadena1',$sIdUsuario,$sIdPersona,'$p_fecha','$p_hora')") or die (mysqli_error());
}

?>