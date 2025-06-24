<?php  

function firmax( $idUsuario) {

$nombre_fichero = '../firmas/'.$idUsuario.'firma.jpg';

	if (file_exists($nombre_fichero)) 
	{
	    return'../firmas/'.$idUsuario.'firma.jpg';
	} 
	else 
	{

		return'../firmas/default.jpg';
	}
}

?>