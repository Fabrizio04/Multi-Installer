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
$id = $data["id"];

$db = mysqli_connect($host,$usDB,$passDB,$database);
$q = mysqli_query($db,"SELECT * FROM pacchetti WHERE id='$id'");
$numres = mysqli_num_rows($q);

if($numres == 1){
	
	$row = mysqli_fetch_array($q, MYSQLI_ASSOC);
	
	$nome = $row["nome"];
	$file64 = $row["file64"];
	$file32 = $row["file32"];
	$param64 = $row["param64"];
	$param32 = $row["param32"];
	$controllo64 = $row["controllo64"];
	$controllo32 = $row["controllo32"];
	$desc = ''.utf8_encode($row["desc"]).'';
	
	echo json_encode(array("result" => "ok", "nome" => $nome, "file64" => $file64, "file32" => $file32, "param64" => $param64, "param32" => $param32, "controllo64" => $controllo64, "controllo32" => $controllo32, "desc" => $desc));
	exit;
	
} else {
	echo json_encode(array("result" => "err"));
	exit;
}