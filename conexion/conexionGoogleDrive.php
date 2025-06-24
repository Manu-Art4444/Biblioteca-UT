<?php
include '../plugins/google-api-php-client-1.1.7/src/Google/autoload.php';
$client = new Google_Client();
$credentials = $client->loadServiceAccountJson('../conexion/configGoogle.json',"https://www.googleapis.com/auth/drive");
$client->setAssertionCredentials($credentials);
if ($client->getAuth()->isAccessTokenExpired()) {
    $client->getAuth()->refreshTokenWithAssertion();
}
$service = new Google_Service_Drive($client);
$folderIdPrincipal = "1vidGeESPtTWYNlFOcH2ON9EH937X7klh"; // Please set the folder name here.

function crearCarpetaDrive($nombre){
	global $service;
	global $folderIdPrincipal;
	$file = new Google_Service_Drive_DriveFile();
	$file->setTitle($nombre);
	$file->setMimeType('application/vnd.google-apps.folder');
	$parent = new Google_Service_Drive_ParentReference(); //previously Google_ParentReference
	$parent->setId($folderIdPrincipal);
	$file->setParents(array($parent));
	$folder = $service->files->insert($file);
	$is_success = false;
    if( isset( $folder['title'] ) && !empty( $folder['title'] ) ){
        $is_success = true;
    	$res["id_folder"] = $folder['id'];
    }
    $res["res"] = $is_success;
	return $res;
}

function renameFileDrive($idFile, $newTitle){
	global $service;
	$file = new Google_Service_Drive_DriveFile();
    $file->setTitle($newTitle);
	$updatedFile = $service->files->update($idFile, $file);
}