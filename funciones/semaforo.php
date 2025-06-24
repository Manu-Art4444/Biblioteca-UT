<?php  
function CalculaEdad( $planeacion $subdireccion $direccion ) {

    if ($planeacion==0 and $subdireccion==0 and $direccion==0) {
    	$sPla="gris";
    	$sSub="gris";
    	$sDir="gris";
    }

    //Cuando planeacion lo acepta
    if ($planeacion==1 and $subdireccion==0 and $direccion==0) {
    	return array ("verde", "rojo", "rojo");
    }
    //Cuando subdireccion lo acepta
    if ($planeacion==1 and $subdireccion==1 and $direccion==0) {
    	return array ("verde", "verde", "rojo");
    }

    //Cuando direccion lo acepta
    if ($planeacion==1 and $subdireccion==1 and $direccion==1) {
    	return array ("verde", "verde", "verde");
    }

	list ($cero, $uno, $dos) = semaforo();

    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

//llamada
//echo CalculaEdad("1984-03-05");
?>