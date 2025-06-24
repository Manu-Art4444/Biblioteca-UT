<?php  

function Fotografia($idUsuario) {

$nombre_fichero = '../fotos/'.$idUsuario.'.jpg';

	if (file_exists($nombre_fichero)) 
	{
	    return'../fotos/'.$idUsuario.'.jpg';
	} 
	else 
	{
		return'../fotos/hombre.jpg';
	    
	}
}

?>