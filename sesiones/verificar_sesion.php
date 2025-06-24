<?php
date_default_timezone_set('America/Monterrey');

//iniciamos la sesión 
if(session_id() == '') {
    session_name("sesionBibliotecaUT"); 
    session_start();
}

$sMinSesion=$_SESSION["s_Sesion"];
//**************************************************
//se manda llamar el archivo de configuracion*******
//include("../configuracion/configuracion.php");
//**************************************************

//convierto los minutos de la base de datos en segundos
$seg_sesion=$sMinSesion * 60 ;

//antes de hacer los cálculos, compruebo que el usuario está logueado 
//utilizamos el mismo script que antes 
if ($_SESSION["autentificado"] != "SI") 
{ 
    //si no está logueado lo envío a la página de autentificación 
    echo"<script language=\"javascript\">window.location=\"../login/login.php\"</script>";
} 
else 
{ 
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 

 //    //comparamos el tiempo transcurrido 
 //    if($tiempo_transcurrido >= $seg_sesion || $_SESSION["s_Pvez"] == 1)//30 segundos 
	// { 
	// 	session_destroy(); // destruyo la sesión 
	// 	echo"<script language=\"javascript\">window.location=\"../login/login.php\"</script>";
		
 //    }
	// else //sino, actualizo la fecha y hora de la sesión 
	// { 
         $_SESSION["ultimoAcceso"] = $ahora; 
	// } 
}
?>