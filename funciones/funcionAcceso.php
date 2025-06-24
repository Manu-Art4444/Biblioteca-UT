<?php
function Acceso($modulo) 
{

global $conexion; 
//uscamos el modulo de acuerdo a el usuario y  su variable de session
$cve_usuario= $_SESSION["s_clave"];
$consultaACCESO=$conexion->query("SELECT usuarios.id,usuarios.id_perfil FROM usuarios
								INNER JOIN modulo_perfil ON
								usuarios.id_perfil=modulo_perfil.id_perfil
								WHERE usuarios.id=$cve_usuario and modulo_perfil.id_modulo=$modulo limit 1") 
								or die (mysqli_error());

//$rowACCESO=mysqli_fetch_row($consultaACCESO);
$valida_usuario=mysqli_num_rows($consultaACCESO);
//variables para el acceso del menu

 global $acceso_configuracion; 
  global $acceso_cerrar_sesion; 	
   global $acceso_cambiar_contrasena; 	
    global $bloque1;	
$acceso_configuracion=$_SESSION["s_configuracion"];
$acceso_cerrar_sesion=$_SESSION["s_cs"];
$acceso_cambiar_contrasena=$_SESSION["s_cambio_contra"];
$bloque1=$acceso_configuracion+$acceso_cerrar_sesion+$acceso_cambiar_contrasena;	
		   
//////////////////////////////;
//Restriccion de acceso por link prohibido los datos se extraen d
if($valida_usuario==0)
{ echo"<script language=\"javascript\">window.location=\"../inicio/index.php\"</script>";}
}



?>