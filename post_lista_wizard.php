<?php
if(!file_exists('./core/config.inc.php')) exit;
require_once './core/config.inc.php';

$db = mysqli_connect($host,$usDB,$passDB,$database);
$qq = mysqli_query($db,"SELECT * FROM pacchetti ORDER BY nome");
$numres = mysqli_num_rows($qq);


$nome = array();
$id = array();
$desc = array();

if($numres == 0){
	echo json_encode(array("result" => "empty"));
	mysqli_close($db);
	exit;
	
} else {
	
	while($row = mysqli_fetch_array($qq, MYSQLI_ASSOC)){
		$id[] = $row["id"];
		$nome[] = utf8_encode($row["nome"]);
		$desc[] = ''.utf8_encode($row["desc"]).'';
		//$desc[] = html_entity_decode($row["desc"]);
	}
	
	//mysqli_real_escape_string($db,$_POST["nomepkg"]);
	
	echo json_encode(array("result" => "ok","id" => $id,"nome" => $nome,"desc" => $desc));
	mysqli_close($db);
	exit;
}

