<?php
if(!file_exists('./core/config.inc.php')) exit;
require_once './core/config.inc.php';
header('Content-Type: application/json');
header('Accept: application/json');

if(isset($_GET['id'])){
	
	$db = mysqli_connect($host,$usDB,$passDB,$database);
	
	if($_GET['id'] == '1'){
		$query = 'TRUNCATE TABLE pacchetti;
TRUNCATE TABLE sha256;
TRUNCATE TABLE pack;';
	} else {
		$query = 'DROP TABLE pacchetti;
DROP TABLE server;
DROP TABLE sha256;
DROP TABLE pack;';
	}

	if(mysqli_multi_query($db,$query)){
		
		if($_GET['id'] == '2') unlink('./core/config.inc.php');
		
		echo json_encode(array("result" => "ok"));
	} else {
		echo json_encode(array("result" => "err"));
	}
	
	mysqli_close($db);
	exit;
	
} else {
	echo json_encode(array("result" => "err"));
}

