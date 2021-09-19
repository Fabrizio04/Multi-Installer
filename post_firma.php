<?php
if(!file_exists('./core/config.inc.php')) exit;
require_once './core/config.inc.php';
$data = file_get_contents('php://input');
header('Content-Type: application/json');
header('Accept: application/json');

if($data == ""){
	echo json_encode(array("result" => "err"));
	exit;
}

$data = json_decode($data, true);
$db = mysqli_connect($host,$usDB,$passDB,$database);

if (mysqli_connect_errno()){
	echo json_encode(array("result" => "err"));
	exit;
	
} else {
	
	if (file_exists("./sign/codesign.pfx")) {
		
		//aggiorno il db
		if($data["sign"] == true) $sign = "on";
		else $sign = "off";
		
		mysqli_query($db,"UPDATE server set sin='$sign' WHERE id='1'");
		
		echo json_encode(array("result" => "ok"));
		exit;
		
	} else {
		echo json_encode(array("result" => "err"));
		exit;
	}
	
	mysqli_close($db);
	exit;
}
?>