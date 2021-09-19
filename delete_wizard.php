<?php
if(!file_exists('./core/config.inc.php')) exit;
require_once './core/config.inc.php';

if(isset($_GET["id"])){
	
	$c  = new mysqli($host,$usDB,$passDB,$database);
	$q = $c->query("SELECT * FROM server");
	$d = $q->fetch_array();
	$percorsoRep = $d['rep'];
	$userServer = $d['us'];
	$passServer = $d['psw'];
	$c->close();
	
	//controllo che la share sia accessibile
	if(!is_dir($percorsoRep)) smb_connect($percorsoRep,$userServer,$passServer);
	
	$id = $_GET["id"];
	$db = mysqli_connect($host,$usDB,$passDB,$database);
	
	$q = mysqli_query($db,"SELECT * FROM pacchetti WHERE id = '$id'");
	$numres = mysqli_num_rows($q);
	
	if($numres == 0){
		mysqli_close($db);
		echo json_encode(array("result" => "err"));
		exit;
	} else {
		
		$row = mysqli_fetch_array($q, MYSQLI_ASSOC);
		
		if($row['file64'] != ""){
			$file = $row['file64'];
			
			if (file_exists($percorsoRep."\\".$row['file64']))
				unlink($percorsoRep."\\".$row['file64']);
			
			mysqli_query($db,"DELETE FROM sha256 WHERE file = '$file'");
		}
		
		if($row['file32'] != ""){
			$file = $row['file32'];
			
			if (file_exists($percorsoRep."\\".$row['file32']))
				unlink($percorsoRep."\\".$row['file32']);
		
			mysqli_query($db,"DELETE FROM sha256 WHERE file = '$file'");
		}
		
		mysqli_query($db,"DELETE FROM pacchetti WHERE id = '$id'");
		
		echo json_encode(array("result" => "ok"));
		exit;
		
	}	
			
			
} else {
	echo json_encode(array("result" => "err"));
	exit;
}
?>