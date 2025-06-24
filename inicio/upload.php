<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include '../plugins/google-api-php-client-1.1.7/src/Google/autoload.php';
// putenv("GOOGLE_APPLICATION_CREDENTIALS=configGoogle.json");

$client = new Google_Client();
$credentials = $client->loadServiceAccountJson('../conexion/configGoogle.json',"https://www.googleapis.com/auth/drive");
$client->setAssertionCredentials($credentials);
if ($client->getAuth()->isAccessTokenExpired()) {
    $client->getAuth()->refreshTokenWithAssertion();
}

try {

	// SUBIR ARCHIVO
	// $service = new Google_Service_Drive($client);
	// $file_path = "imagen.jpg";
	// $file = new Google_Service_Drive_DriveFile();
	// $file->setTitle("cargado.jpg");

	// $parent = new Google_Service_Drive_ParentReference(); //previously Google_ParentReference
	// $parent->setId('1LPsM6AvIer5lpakIOHFe4xO781n9ABf7');
	// $file->setParents(array($parent));

	// // $file->setParents(array("1LPsM6AvIer5lpakIOHFe4xO781n9ABf7"));
	// $file->setDescription("Archivo cargado desde PHP 5.3");
	// $file->setMimeType("image/jpeg");

	// $resultado = $service->files->insert(
	// 	$file,
	// 	array(
	// 		'data' => file_get_contents($file_path),
	// 		'mimeType' => 'image/jpeg',
	// 		"uploadType" => 'media'
	// 	)
 	//  );
	// echo '<a href="https://drive.google.com/open?id='.$resultado->id.'" target="_blank">'.$resultado->title."</a><br>".json_encode($resultado);


	// CREAR CARPETA
	// $service = new Google_Service_Drive($client);
	// $file = new Google_Service_Drive_DriveFile();
	// $file->setTitle('CB-0000055');
	// $file->setMimeType('application/vnd.google-apps.folder');
	
	// $parent = new Google_Service_Drive_ParentReference(); //previously Google_ParentReference
	// $parent->setId('1LPsM6AvIer5lpakIOHFe4xO781n9ABf7');
	// $file->setParents(array($parent));

	// $folder = $service->files->insert($file);


	$service = new Google_Service_Drive($client);
	$folderIdPrincipal = "1LPsM6AvIer5lpakIOHFe4xO781n9ABf7"; // Please set the folder name here.
	$folderBuscar = "CB-0000755"; // Please set the folder name here.
	$optParams = array(
	  'maxResults' => 1,
	  'q' => "'".$folderIdPrincipal."' in parents and title = '".$folderBuscar."' and mimeType = 'application/vnd.google-apps.folder'"
	);
	$results = $service->files->listFiles($optParams);

	if(count($results)>0){
		$newID = $results[0]->id;
		echo "ID: ".$newID."<br><br>";

		$optParams2 = array(
		  'q' => "'".$newID."' in parents"
		);
		$results2 = $service->files->listFiles($optParams2);
		if(count($results2)>0){
			foreach ($results2 as $item) {
				$tipo = $item->mimeType;
				echo $item->title."<br>";
				if ($tipo=="image/jpeg") {
					echo '<img src="https://drive.google.com/uc?export=view&id='.$item->id.'">', "<br/> \n";
				}else if($tipo == "application/pdf"){
					echo '<iframe width="1000px" src="https://drive.google.com/uc?export=view&id='.$item->id.'">', "<br/> \n";
				}
			}
		}else{
			echo "Sin archivos";
		}
	}else{
		echo "Sin resultados";
	}

	// foreach ($results as $item) {
	// 	echo $item->id, "<br /> \n";
	// }

} catch (Google_Service_Exception $gs) {
	$mensaje = json_decode($gs->getMessage());
	echo $gs->getMessage();
} catch (Exception $e){
	echo $e->getMessage();
}
?>

</body>
</html>