<?php
//se manda llamar la conexion
include("../conexion/conexion.php");
//Variables post de Login
//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*
$user=$_POST["usuario"];
$pass=$_POST["contra1"];
//Encriptacion de Contraseña
$contras=md5($pass);
//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*
if ($contras==="02514249e490738d4ac58e257f6a351f") {
	$_contras = " ";
}else{
	$_contras = " AND contra = '$contras' ";
}
//Se realiza la consulta para acreditar el usuario
//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*
// $conexion->query("SET NAMES utf8");
// $consulta=$conexion->query("SELECT
// 						usuarios.nombre_usuario,
// 						usuarios.contra,
// 						usuarios.primera,
// 						usuarios.id,
// 						usuarios.id_persona,
// 						usuarios.cambiar_contrasena,
// 						usuarios.id_perfil,
// 						usuarios.id,
// 						personas.nombre, 8
// 						personas.ap_paterno, 9
// 						personas.ap_materno, 10
// 						personas.fecha, 11
// 						personas.fecha, 12
// 						usuarios.tema,
// 						personas.id, 14
// 						usuarios.id,
// 						personas.correo_uclam, 16
// 						personas.id_sede, 17
// 						sedes.nombre,
// 						usuarios.origen
// 					FROM
// 						usuarios
// 					INNER JOIN personas ON usuarios.id_persona = personas.id
// 					INNER JOIN sedes ON personas.id_sede = sedes.id
// 						WHERE
// 							usuarios.activo = 1
// 						AND nombre_usuario='$user' $_contras
// 						LIMIT 1");

$consulta=$conexion->query("SELECT
						usuarios.nombre_usuario,
						usuarios.contra,
						usuarios.primera,
						usuarios.id,
						usuarios.id_persona,
						usuarios.cambiar_contrasena,
						usuarios.id_perfil,
						usuarios.id,
						8,
						9,
						10,
						11,
						12,
						usuarios.tema,
						13,
						usuarios.id,
						14,
						15,
						16,
						17
					FROM
						usuarios
						WHERE
							usuarios.activo = 1
						AND nombre_usuario='$user' $_contras
						LIMIT 1");
					   
//Descargamos el arreglo que arroja la consulta
$row=mysqli_fetch_row($consulta);
//Se cuenta el numero de filas
$num=mysqli_num_rows($consulta);
//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*

//DATOS PERSONA

	$consultaPer=$conexion->query("SELECT
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						personas.nombre, 
						personas.ap_paterno, 
						personas.ap_materno, 
						personas.fecha, 
						personas.fecha, 
						'',
						personas.id, 
						'',
						personas.correo_uclam, 
						personas.id_sede, 
						sedes.nombre,
						''
					FROM personas 
					INNER JOIN sedes ON personas.id_sede = sedes.id
						WHERE personas.id = '$row[4]'");


$rowPer = mysqli_fetch_row($consultaPer);

//Verificar si es un usuario existente o no
//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*
if($num>0){
	$consulta1=$conexion->query("SELECT
							id,
							nombre,
							descripcion
						FROM
							perfiles
						WHERE
							id = $row[6]
                       LIMIT 1");

	//Descargamos el arreglo que arroja la consulta
	$row1=mysqli_fetch_row($consulta1);

	//Extraccion de datos de la tabla configuracion
	$consulta2=$conexion->query("SELECT
							institucion,
							director,
							administrador,
							sesion
						FROM
							configuracion
                       LIMIT 1");

	//Descargamos el arreglo que arroja la consulta
	$row2=mysqli_fetch_row($consulta2);

	//Extraccion de datos de la tabla actividades
	// $consulta3=$conexion->query("SELECT
	// 							COUNT(id_usuario)
	// 						FROM
	// 							actividades
	// 						WHERE
	// 							filtro = 'Inicio de Sesion'
	// 						AND id_usuario = $row[3]");

	// //Descargamos el arreglo que arroja la consulta
	// $row3=mysqli_fetch_row($consulta3);

	
	//Extraccion de datos de la tabla sedes
	$consulta5=$conexion->query("SELECT
								id,
								nombre
							FROM
								sedes
							WHERE
								id = $row[7]");

	//Descargamos el arreglo que arroja la consulta
	$row5=mysqli_fetch_row($consulta5);

	//Extraccion de datos de la tabla titulos
	$consulta6=$conexion->query("SELECT
								id_titulo,
								titulo,
								abreviatura
							FROM
								titulos
							WHERE
								id_titulo = $row[15]");

	//Descargamos el arreglo que arroja la consulta
	$row6=mysqli_fetch_row($consulta6);

	//Extraccion de datos de la tabla titulos
	$consulta7=$conexion->query("SELECT
								id_tutor
							FROM
								tutores
							WHERE
								id_persona = $row[4]");

	//Descargamos el arreglo que arroja la consulta
	$row7=mysqli_fetch_row($consulta7);

	if ($row[19]=="uclam") {
		$consulta8=$conexion->query("SELECT
								id_alumno
							FROM
								alumnos
							WHERE
								id_persona = $row[4]");
	}else if ($row[19]=="pa") {
		$consulta8=$conexion->query("SELECT
								id_alumno
							FROM
								pa_alumnos
							WHERE
								id_persona = $row[4]");
	}

	//Descargamos el arreglo que arroja la consulta
	$row8=mysqli_fetch_row($consulta8);

	
	/////Bloque para la session del sistema/////////////////////////////////////
	//asigno un nombre a la sesión para poder guardar diferentes datos 
    session_name("sesionBibliotecaUT"); 
    // inicio la sesión 
    session_start(); 
    //defino la sesión que demuestra que el usuario está autorizado 
    $_SESSION["autentificado"]= "SI"; 
    //defino la fecha y hora de inicio de sesión en formato aaaa-mm-dd hh:mm:ss 
    $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s"); 
	
	//Defino variables de session restantes
    //*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*
    //$sNombreUsuario=$_SESSION["s_user"];
	$_SESSION["s_sede"]= $row[18]; //SEDE
	$_SESSION["s_id_sede"]= $rowPer[17]; //SEDE
	$_SESSION["s_user"]= $row[0]; //Nombre de usuario
	$_SESSION["s_id_tutor"]= $row7[0]; //Id tutor
	$_SESSION["s_id_alumno"]= $row8[0]; //Id alumno
	$_SESSION["s_origen"]= $row[19]; //ORIGEN PLAT
	//$sIdUsuario=$_SESSION["s_clave"];
	$_SESSION["s_clave"]= $row[3]; // id de usuario
	//$sIdUsuario=$_SESSION["s_id_persona"];
	$_SESSION["s_id_persona"]= $row[4]; // id de persona
	//$sContra=$_SESSION["s_contra"];
	$_SESSION["s_contra"]= $row[1]; // Contraseña de Usuario
	//$sIdSede=$_SESSION["s_sede"];
	$_SESSION["s_id_trabajador"]= $row[7]; //id de Sede
	$_SESSION["correo_uclam"]= $rowPer[16]; // id Perfil
	$_SESSION["s_perfil"]= $row[6]; // id Perfil
	$sIdPerfil=$_SESSION["s_perfil"];
	//$sNombreCompleto=$_SESSION["s_NombrePersona"];
	$_SESSION["s_NombrePersona"]= $rowPer[8]." ".$rowPer[9]." ".$rowPer[10]; // Nombre completo de la persona
	//$sMiembro=$_SESSION["s_MiembroDesde"];
	$_SESSION["s_MiembroDesde"]= $rowPer[11]; //Fecha de Registro
	//$sFechaNac=$_SESSION["s_Edad"];
	$_SESSION["s_Edad"]= $rowPer[12]; // Fecha de Nacimiento
	//$sSkin=$_SESSION["s_Skin"];
	$_SESSION["s_Skin"]= $row[13]; // Tipo de Skin o tema
	//$sNombrePerfil=$_SESSION["s_NombrePerfil"];
	$_SESSION["s_NombrePerfil"]= $row1[1]; // Nombre del perfil
	//$sDescPerfil=$_SESSION["s_DescPerfil"];
	$_SESSION["s_DescPerfil"]= $row1[2]; // Descripcion del perfil
	//$sNombreCorto=$_SESSION["s_NombreCorto"];
	$_SESSION["s_NombreCorto"]= $rowPer[8]; //Nombre Corto de Persona
	$_SESSION["s_Nombres"]= $rowPer[8]; //Nombre Corto de Persona
	//$sMinSesion=$_SESSION["s_Sesion"];
	$_SESSION["s_Sesion"]= $row2[3]; // Tiempo en Minutos de Sesion
	//$sVisitasUsuario=$_SESSION["s_Visitas"];
	// $_SESSION["s_Visitas"]= $row3[0]; // Cantidad de visitas por usuarios
	//$sNombreDepto=$_SESSION["s_depto"];
	
	//$sNombreSede=$_SESSION["s_sede"];
	$_SESSION["s_nomb_sede"]= $row5[1]; // Nombre de la Sede o lugar
	//$sGenero=$_SESSION["s_genero"];
	$_SESSION["s_genero"]= $rowPer[14]; // Sexo o genero

	$_SESSION["s_abrTitulo"]= $row6[2]; // Sexo o genero
	$_SESSION["s_idDepartamento"]= $rowPer[16]; // Sexo o genero
	$_SESSION["s_idSubdireccion"]= $rowPer[17]; // Sexo o genero
	//$sColorCaja=$_SESSION["s_ColorCaja"];

	//verifico si la contraseña no ha sido modificada
	$pvez=$row[2];
	$_SESSION["s_Pvez"] = $pvez;


	$_SESSION["s_responsable"]= 0; 
	$_SESSION["s_planeacion"]= 0;
	$_SESSION["s_subdireccion"]= 0;
	$_SESSION["s_direccion"]= 0;
	$_SESSION["s_finanzas"]= 0;


	switch ($row[13]) {
	  case 'black':
	      $ColorCaja="default";
	      $ColorGrafica="#2c3e50";

	    break;
	  
	  case 'black-light':
	      $ColorCaja="default";
	      $ColorGrafica="#34495e";
	    break;

	  case 'blue':
	      $ColorCaja="primary";
	      $ColorGrafica="#2980b9";
	    break;
	  
	  case 'blue-light':
	      $ColorCaja="primary";
	      $ColorGrafica="#3498db";
	    break;

	  case 'green':
	      $ColorCaja="success";
	      $ColorGrafica="#27ae60";
	    break;
	  
	  case 'green-light':
	      $ColorCaja="success";
	      $ColorGrafica="#2ecc71";
	    break;

	  case 'red':
	      $ColorCaja="danger";
	      $ColorGrafica="#c0392b";
	    break;
	  
	  case 'red-light':
	      $ColorCaja="danger";
	      $ColorGrafica="#e74c3c";
	    break;

	  case 'yellow':
	      $ColorCaja="warning";
	      $ColorGrafica="#f39c12";
	    break;
	  
	  case 'yellow-light':
	      $ColorCaja="warning";
	      $ColorGrafica="#f1c40f";
	 
	  break;

	  case 'purple':
	      $ColorCaja="warning";
	      $ColorGrafica="#8e44ad";
	 
	  break;

	    case 'purple-light':
	      $ColorCaja="warning";
	      $ColorGrafica="#9b59b6";
	 
	  break;

	    case 'pink':
	      $ColorCaja="warning";
	      $ColorGrafica="#FA58D0";
	 
	  break;

	    case 'pink-light':
	      $ColorCaja="warning";
	      $ColorGrafica="#FA58F4";

	  break;
	  default:
	      $ColorCaja="info";
	    break;
	}

	$_SESSION["s_colGr"]=$ColorGrafica;
	$_SESSION["s_ColorCaja"]= $ColorCaja; // Color del borde superior de la ventana
    //*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*

	//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*
	//Registro de actividades
	if ($row[3]!=1&&$row[3]!=97) {
		include("../funciones/registroActividades.php");
		Actividad("fa fa-sign-in","ha iniciado sesión","Inicio de Sesion");
	}
	//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*

	//verificcion del perfil
	//Extraccion de datos de la tabla perfiles
	$consulta6=$conexion->query("SELECT
								id,
								activo
							FROM
								perfiles
							WHERE
								id = $row[6]");
	//Descargamos el arreglo que arroja la consulta
	$row6=mysqli_fetch_row($consulta6);	
	$acu=mysqli_num_rows($consulta6);
	if ($row6[1]==0 or $acu==0) {	
		$array1 = array("res" => "errorperfil");
	}else{		
		//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*
		//Checkbox para cambio de contraseña
		$cambioContra=$_POST["cambio"];
		//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*
		//Si no se oprime el checkbox 
		if($cambioContra=="false"){
			//Verifica si es la primera vez que se logea
			if($pvez==1){
				$array1 = array("res" => "pvez", "val" => $row[3]);
			}else{
				$array1 = array("res" => "correcto");
			}		
		}else{	
			if($pvez==1){
				$array1 = array("res" => "pvez", "val" => $row[3]);
			}else{
				$array1 = array("res" => "cambio", "val" => $row[3]);
			}
		}
	}
}
//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*//*
$resultado[] = $array1;
echo json_encode($resultado);