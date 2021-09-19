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
	
	$percorsoWeb = mysqli_real_escape_string($db,$data["percorsoWeb"]);
	$percorsoRep = mysqli_real_escape_string($db,$data["percorsoRep"]);
	$lettera = mysqli_real_escape_string($db,$data["lettera"]);
	$userServer = mysqli_real_escape_string($db,$data["userServer"]);
	$passServer = mysqli_real_escape_string($db,$data["passServer"]);
	$slog = $data["slog"];
	$spul = $data["spul"];
	$gg = $data["gg"];
	
	if($slog == "true") $slog = "on";
	else $slog = "off";
	
	if($spul == "true") {
		
		$linea_cmd = '@echo off
c:\\windows\\system32\\Forfiles /p "'.realpath('./')."\\setup".'" /s /m *.exe /d -'.$gg.' /c "cmd /c del /q @path"
c:\\windows\\system32\\Forfiles /p "'.realpath('./')."\\setup".'" /s /m *.bat /d -'.$gg.' /c "cmd /c del /q @path"
';
		
	} else {
		$gg = "";
		$linea_cmd = '@echo off
rem Pulizia cartella setup server disattivata
';
	}
	
	$fp = fopen("./core/clean.bat", 'wa+');
	if (fwrite($fp, $linea_cmd) === FALSE) {
		echo json_encode(array("result" => "err"));
		exit;
	}
	
	fclose($fp);
	
	
	if($userServer == ""){
		$query = "UPDATE server SET web = '$percorsoWeb', rep = '$percorsoRep', let = '$lettera', us = '', psw = '', log = '$slog', del = '$gg' WHERE id = 1";
	} else {
	
		if($passServer != "psw"){
			$passServer = encrypt_decrypt("encrypt", $passServer, "./core/key.txt");
			
			$query = "UPDATE server SET web = '$percorsoWeb', rep = '$percorsoRep', let = '$lettera', us = '$userServer', psw = '$passServer', log = '$slog', del = '$gg' WHERE id = 1";
		}
			
		else {
			$query = "UPDATE server SET web = '$percorsoWeb', rep = '$percorsoRep', let = '$lettera', us = '$userServer', log = '$slog', del = '$gg' WHERE id = 1";
		}
	}
	
	if(mysqli_query($db,$query)){
		echo json_encode(array("result" => "ok"));
	}
		
	mysqli_close($db);
	exit;
}
?>