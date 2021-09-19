<?php
if(!file_exists('./core/config.inc.php')) exit;
require_once './core/config.inc.php';

if(isset($_GET['id'])){
	
	$file = explode(":",$_GET['id'])[0];
	$sha256 = strtoupper(explode(":",$_GET['id'])[1]);
	
	$db = mysqli_connect($host,$usDB,$passDB,$database);
	
	$result = mysqli_query($db,"SELECT * FROM sha256 WHERE file='$file'");
	$row_cnt = mysqli_num_rows($result);
	
	if($row_cnt == 0){
		
		mysqli_query($db,"INSERT INTO sha256 (id, file, sha256) VALUES (NULL, '$file', '$sha256')");
	
	} else {
		
		mysqli_query($db,"UPDATE sha256 SET sha256='$sha256' WHERE file='$file'");
		
	}
	
	echo "ok";
	
	mysqli_close($db);
} else {
	echo "errore";
}