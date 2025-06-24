<?php 
function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);	

	if ($dias==0) {       
        $dias="Hoy";
      }
     else{
        if ($dias==1) {
           $dias=$dias." dia";
        }
        else{
           $dias=$dias." Dias";
        }
     }
	
	return $dias;
}

function dias_transcurridos1($fecha_i,$fecha_f)
{
  $dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
  $dias   = abs($dias); $dias = floor($dias); 

  if ($dias==0) {       
        $dias="1";
      }
     else{
        if ($dias==1) {
           $dias=$dias." dia";
        }
        else{
           $dias=$dias." Dias";
        }
     }
  
  return $dias;
}
 ?>