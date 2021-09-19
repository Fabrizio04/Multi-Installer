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
$nome = $data["nome"];

$db = mysqli_connect($host,$usDB,$passDB,$database);
$q = mysqli_query($db,"SELECT * FROM sha256 WHERE file='$nome'");
$numres = mysqli_num_rows($q);

if($numres == 1){
	
	$row = mysqli_fetch_array($q, MYSQLI_ASSOC);
	
	echo json_encode(array("result" => "ok", "sha256" => $row["sha256"]));
	exit;
	
} else {
	echo json_encode(array("result" => "err"));
	exit;
}