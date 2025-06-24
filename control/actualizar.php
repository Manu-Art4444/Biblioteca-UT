<?
//se manda llamar la conexion
include'../conexion/conexion.php';

//verifico inicio de sesion
include'../sesiones/verificar_sesion.php';

//variables post
$id=$_POST["e_id"]; 
$id_modulo=$_POST["e_modulo"]; 
$id_clasificacion=$_POST["e_clasificacion"]; 
$titulo=$_POST["e_titulo"]; 
$autores=$_POST["e_autores"];
$editorial_libro=$_POST["e_editorial_libro"];
$anio_publicacion=$_POST["e_anio_publicacion"];
$lugar_publicacion=$_POST["e_lugar_publicacion"];
$isbn=$_POST["e_isbn"];
$edicion=$_POST["e_edicion"];
$condicion_libro=$_POST["e_condicion_libro"];
$numero_identificacion=$_POST["e_numero_identificacion"];
$observaciones=$_POST["e_observaciones"];

//se extrae de una funcion date 
$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");
$activo=1;
/*variable de session*/
$usuario=$_SESSION["s_clave"];

$actualizar = $conexion->query("UPDATE biblioteca_libros
							SET
							 id_modulo='$id_modulo',
							 id_clasificacion='$id_clasificacion',
							 titulo = '$titulo',
							 autores = '$autores',
							 editorial_libro = '$editorial_libro',
							 anio_publicacion = '$anio_publicacion',
							 lugar_publicacion = '$lugar_publicacion',
							 isbn = '$isbn',
							 edicion = '$edicion',
							 condicion_libro = '$condicion_libro',
							 numero_identificacion = '$numero_identificacion',
							 observaciones = '$observaciones'
							WHERE
							 id_libro = $id") or die (mysqli_error());

echo "exito";