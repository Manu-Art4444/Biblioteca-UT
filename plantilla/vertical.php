<?php 

include'../sesiones/variables_sesion.php';

//////////////////////
switch ($op) {
  case 'inicio':
        $v1="class=\"active\"";
    break;
  case 'datos':
        $v2="class=\"active\"";
    break;
  case 'foto':
        $v3="class=\"active\"";
    break;
  case 'cumple':
        $v4="class=\"active\"";
    break;
  case 'tema':
        $v5="class=\"active\"";
    break;
  case 'cambiar':
        $v6="class=\"active\"";
    break;
}

$mesActual=date("m");
//////////////////////
 ?>
         
            
            <li><span>&nbsp;</span></li>
            <li>
              <a href="../sesiones/cerrarsesion.php">
                <span>Cerrar sesión</span>
              </a>
            </li>