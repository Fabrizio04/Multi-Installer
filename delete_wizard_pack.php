<?php
if(!file_exists('./core/config.inc.php')) exit;
require_once './core/config.inc.php';

if(isset($_GET["id"])){
	
	$id = $_GET["id"];
	$db = mysqli_connect($host,$usDB,$passDB,$database);
	
	$q = mysqli_query($db,"SELECT * FROM pack WHERE id = '$id'");
	$numres = mysqli_num_rows($q);
	
	if($numres == 0){
		mysqli_close($db);
		echo json_encode(array("result" => "err"));
		exit;
	} else {
		
		mysqli_query($db,"DELETE FROM pack WHERE id = '$id'");
		
		echo json_encode(array("result" => "ok"));
		exit;
		
	}	
			
			
} else {
	echo json_encode(array("result" => "err"));
	exit;
}
?>