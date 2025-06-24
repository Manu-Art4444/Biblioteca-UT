<?php  
function CalculaEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < ($m-1).$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

//llamada
//echo CalculaEdad("1984-03-05");
?>