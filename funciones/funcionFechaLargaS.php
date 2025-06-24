<?php 
    function actual_date($fecha)  
    {  
        $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
        $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
        $year_now =date("Y", strtotime($fecha));  
        $month_now =date("n", strtotime($fecha));  
        $day_now =date("j", strtotime($fecha));  
        $week_day_now =date("w", strtotime($fecha));  
        $date =  $day_now . " de " . $months[$month_now] . " de " . $year_now;   
        return $date;    
    }  
 ?>