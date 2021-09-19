<?php
if(!file_exists('./core/config.inc.php')) exit;
require_once './core/config.inc.php';

if(isset($_GET["t"])){
	
	$c  = new mysqli($host,$usDB,$passDB,$database);
	$q = $c->query("SELECT * FROM server");
	$d = $q->fetch_array();
	$percorsoRep = $d['rep'];
	$userServer = $d['us'];
	$passServer = $d['psw'];
	$c->close();
	
	//controllo che la share sia accessibile
	if(!is_dir($percorsoRep)) smb_connect($percorsoRep,$userServer,$passServer);
	
	//verifico se nome pacchetto già esiste
	$db = mysqli_connect($host,$usDB,$passDB,$database);
	
	$nome = mysqli_real_escape_string($db,$_POST["nomepkg"]);
	
	$qq = mysqli_query($db,"SELECT * FROM pacchetti WHERE nome = '$nome'");
	$numres = mysqli_num_rows($qq);
	mysqli_close($db);
	
	if($numres > 0){
		echo json_encode(array("result" => "dup"));
		exit;
	}
	
	if($_GET["t"] == "auto"){
		
		//caso di omonimia
		if($_FILES["file32"]["name"] == $_FILES["file64"]["name"]){
			
			$targetPath32 = $percorsoRep."\\".$_FILES["file32"]["name"];
			move_uploaded_file($_FILES["file32"]["tmp_name"], $targetPath32);
			
		} else {
			$targetPath32 = $percorsoRep."\\".$_FILES["file32"]["name"];
			move_uploaded_file($_FILES["file32"]["tmp_name"], $targetPath32);
		
			$targetPath64 = $percorsoRep."\\".$_FILES["file64"]["name"];
			move_uploaded_file($_FILES["file64"]["tmp_name"], $targetPath64);
		}
		
		$db = mysqli_connect($host,$usDB,$passDB,$database);
		
		$nomepkg = mysqli_real_escape_string($db,$_POST["nomepkg"]);
		$param32 = mysqli_real_escape_string($db,$_POST["param32"]);
		$param64 = mysqli_real_escape_string($db,$_POST["param64"]);
		$desc = mysqli_real_escape_string($db,$_POST["desc"]);
		$controllo32 = mysqli_real_escape_string($db,$_POST["controllo32"]);
		$controllo64 = mysqli_real_escape_string($db,$_POST["controllo64"]);
		
		$file64 = mysqli_real_escape_string($db,$_FILES["file64"]["name"]);
		$file32 = mysqli_real_escape_string($db,$_FILES["file32"]["name"]);
		
		//salvo e creo
		mysqli_query($db,"INSERT INTO pacchetti (id, nome, file64, file32, param64, param32, controllo64, controllo32, `desc`) VALUES (NULL, '$nomepkg', '$file64', '$file32', '$param64', '$param32', '$controllo64', '$controllo32', '$desc')");
		
		
		//sha256
		if($file64 == $file32)
			pclose(popen('start /B sha256\launch.bat "'.$file32.'" "'.$percorsoRep.'"', "r"));
		else {
			pclose(popen('start /B sha256\launch.bat "'.$file32.'" "'.$percorsoRep.'"', "r"));
			pclose(popen('start /B sha256\launch.bat "'.$file64.'" "'.$percorsoRep.'"', "r"));
		}
		
		mysqli_close($db);
		
		echo json_encode(array("result" => "ok"));
		exit;
		
	} else if($_GET["t"] == "32"){
		
		$targetPath32 = $percorsoRep."\\".$_FILES["file32"]["name"];
		move_uploaded_file($_FILES["file32"]["tmp_name"], $targetPath32);
		
		$db = mysqli_connect($host,$usDB,$passDB,$database);
		
		$nomepkg = mysqli_real_escape_string($db,$_POST["nomepkg"]);
		$param32 = mysqli_real_escape_string($db,$_POST["param32"]);
		$desc = mysqli_real_escape_string($db,$_POST["desc"]);
		$controllo32 = mysqli_real_escape_string($db,$_POST["controllo32"]);
		$file32 = mysqli_real_escape_string($db,$_FILES["file32"]["name"]);
		
		//salvo e creo
		mysqli_query($db,"INSERT INTO pacchetti (id, nome, file64, file32, param64, param32, controllo64, controllo32, `desc`) VALUES (NULL, '$nomepkg', '', '$file32', '', '$param32', '', '$controllo32', '$desc')");
		
		
		//sha256
		pclose(popen('start /B sha256\launch.bat "'.$file32.'" "'.$percorsoRep.'"', "r"));
		
		mysqli_close($db);
		
		echo json_encode(array("result" => "ok"));
		exit;
		
	} else if($_GET["t"] == "64"){
		
		$targetPath64 = $percorsoRep."\\".$_FILES["file64"]["name"];
		move_uploaded_file($_FILES["file64"]["tmp_name"], $targetPath64);
		
		$db = mysqli_connect($host,$usDB,$passDB,$database);
		
		$nomepkg = mysqli_real_escape_string($db,$_POST["nomepkg"]);
		$param64 = mysqli_real_escape_string($db,$_POST["param64"]);
		$desc = mysqli_real_escape_string($db,$_POST["desc"]);
		$controllo64 = mysqli_real_escape_string($db,$_POST["controllo64"]);
		$file64 = mysqli_real_escape_string($db,$_FILES["file64"]["name"]);
		
		//salvo e creo
		mysqli_query($db,"INSERT INTO pacchetti (id, nome, file64, file32, param64, param32, controllo64, controllo32, `desc`) VALUES (NULL, '$nomepkg', '$file64', '', '$param64', '', '$controllo64', '', '$desc')");
		
		
		//sha256
		pclose(popen('start /B sha256\launch.bat "'.$file64.'" "'.$percorsoRep.'"', "r"));
		
		mysqli_close($db);
		
		echo json_encode(array("result" => "ok"));
		exit;
		
	} else {
		echo json_encode(array("result" => "err"));
		exit;
	}

} else {
	echo json_encode(array("result" => "err"));
	exit;
}

?>