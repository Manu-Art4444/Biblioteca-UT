<?php  
//llamada
//echo ColorEspanol("red");
function ColorPanel() {
	$con=rand(1, 30);
	switch ($con) {
                        case 1:
                          $colbg="bg-red";
                          break;
                        case 2:
                          $colbg="bg-yellow";
                          break;
                        case 3:
                          $colbg="bg-aqua";
                          break;
                        case 4:
                          $colbg="bg-blue";
                          break;
                        case 5:
                          $colbg="bg-light-blue";
                          break;
                        case 6:
                          $colbg="bg-green";
                          break;
                        case 7:
                          $colbg="bg-navy";
                          break;
                        case 8:
                          $colbg="bg-teal";
                          break;
                        case 9:
                          $colbg="bg-olive";
                          break;
                        case 10:
                          $colbg="bg-lime";
                          break; 
                        case 11:
                          $colbg="bg-orange";
                          break;
                        case 12:
                          $colbg="bg-fuchsia";
                          break;
                        case 13:
                          $colbg="bg-purple";
                          break;
                        case 14:
                          $colbg="bg-maroon";
                          break;
                        case 15:
                          $colbg="bg-black";
                          break;
                        case 16:
                          $colbg="bg-black-active";
                          break;
                        case 17:
                          $colbg="bg-red-active";
                          break;
                        case 18:
                          $colbg="bg-yellow-active";
                          break;
                        case 19:
                          $colbg="bg-aqua-active";
                          break;
                        case 20:
                          $colbg="bg-blue-active";
                          break; 
                        case 21:
                          $colbg="bg-light-blue-active";
                          break;
                        case 22:
                          $colbg="bg-green-active";
                          break;
                        case 23:
                          $colbg="bg-navy-active";
                          break;
                        case 24:
                          $colbg="bg-teal-active";
                          break;
                        case 25:
                          $colbg="bg-olive-active";
                          break;
                        case 26:
                          $colbg="bg-lime-active";
                          break;
                        case 27:
                          $colbg="bg-orange-active";
                          break;
                        case 28:
                          $colbg="bg-fuchsia-active";
                          break;
                        case 29:
                          $colbg="bg-purple-active";
                          break;
                        case 30:
                          $colbg="bg-maroon-active";
                          break;              
	}
	return($colbg);
}
?>

