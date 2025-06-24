<?
//se manda llamar la conexion
include("../conexion/conexion.php");

//verifico inicio de sesion
include("../sesiones/verificar_sesion.php");

//variables post
$id_modulo=$_POST["id_modulo"]; 
$id_clasificacion=$_POST["id_clasificacion"]; 
$titulo=$_POST["titulo"]; 
$autores=$_POST["autores"];
$editorial_libro=$_POST["editorial_libro"];
$anio_publicacion=$_POST["anio_publicacion"];
$lugar_publicacion=$_POST["lugar_publicacion"];
$isbn=$_POST["isbn"];
$edicion=$_POST["edicion"];
$condicion_libro=$_POST["condicion_libro"];
$numero_identificacion=$_POST["numero_identificacion"];
$observaciones=$_POST["observaciones"];

//se extrae de una funcion date 
$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");
$activo=1;
/*variable de session*/
$usuario=$_SESSION["s_clave"];

$insertar= $conexion->query("INSERT INTO biblioteca_libros
							(id_modulo,id_clasificacion,titulo,autores,editorial_libro,anio_publicacion,lugar_publicacion,isbn,edicion,condicion_libro,numero_identificacion,observaciones,fecha,hora,usuario,activo)
						VALUES
							('$id_modulo','$id_clasificacion','$titulo','$autores','$editorial_libro','$anio_publicacion','$lugar_publicacion','$isbn','$edicion','$condicion_libro','$numero_identificacion','$observaciones','$fecha','$hora','$usuario',$activo)
						") or die (mysqli_error());

echo "exito";