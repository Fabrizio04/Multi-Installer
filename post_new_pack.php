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
	
//verifico se nome pacchetto già esiste
$db = mysqli_connect($host,$usDB,$passDB,$database);

$nome = mysqli_real_escape_string($db,$data["nome"]);

$qq = mysqli_query($db,"SELECT * FROM pack WHERE nome = '$nome'");
$numres = mysqli_num_rows($qq);

if($numres > 0){
	mysqli_close($db);
	echo json_encode(array("result" => "dup"));
	exit;
}

$stringa = "";

for($i = 0; $i < count($data["value"]); $i++){
	
	if($i == count($data["value"])-1)
		$stringa .= $data["value"][$i];
	else
		$stringa .= $data["value"][$i].",";
}

if(mysqli_query($db,"INSERT INTO pack(id,nome,packs) VALUES (NULL,'$nome','$stringa')")) {
	echo json_encode(array("result" => "ok"));
} else {
	echo json_encode(array("result" => "err"));
}

mysqli_close($db);
?>