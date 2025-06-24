<?php  
function nombremes($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 $anio=date("Y", strtotime($mes));  
 return $nombre.' '.$anio;
} 
?>