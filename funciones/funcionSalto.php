<?php 
// $cadenax=cadena completa a cortar
// $salto=numero de palabras para decidir salto
function salto($cadenax,$salto)
{
            $espBaja  = $cadenax;
            $porciones = explode(" ", $espBaja);
            $contWord=str_word_count($cadenax) ;
            $numSalto=$salto;
            $n=0;
            $acu=0;
            while ( $n<= $contWord) {
            
                if ($numSalto!=$acu) {
                    $acu=$acu;
                   $cadena.=$porciones[$n].' ';
                }
                else{
                   $acu=0; 
                   $cadena.=$porciones[$n].'<br>';
                }
                $n++;
                $acu++;
            }
            return $cadena;
}
 ?>
