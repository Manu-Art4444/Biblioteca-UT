<?php  
function nombremes($mesx){

$fecha = $mesx; 
list($anio, $mes, $dia) = explode("-",$fecha); 

 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));  
 return $nombre.' '.$anio;
} 

function nombremes1($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));   
 return $nombre;
} 
?>