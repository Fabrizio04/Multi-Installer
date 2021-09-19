<?php
if(!file_exists('./core/config.inc.php')) exit;
require_once './core/config.inc.php';

$db = mysqli_connect($host,$usDB,$passDB,$database);

$qq_0 = mysqli_query($db,"SELECT * FROM pacchetti");
$numres_0 = mysqli_num_rows($qq_0);

if($numres_0 >= 3) {

	$qq = mysqli_query($db,"SELECT * FROM pack ORDER BY nome");
	$numres = mysqli_num_rows($qq);

	$nome = array();
	$id = array();

	if($numres == 0){
		echo json_encode(array("result" => "empty"));
		mysqli_close($db);
		exit;
		
	} else {
		
		while($row = mysqli_fetch_array($qq, MYSQLI_ASSOC)){
			$id[] = $row["id"];
			$nome[] = utf8_encode($row["nome"]);
		}
		
		echo json_encode(array("result" => "ok","id" => $id,"nome" => $nome));
		mysqli_close($db);
		exit;
	}

} else {
	echo json_encode(array("result" => "min"));
	mysqli_close($db);
	exit;
}