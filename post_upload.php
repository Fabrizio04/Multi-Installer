<?php
if(!file_exists('./core/config.inc.php')) exit;
require_once './core/config.inc.php';

if(isset($_FILES["inpFile"]) && isset($_POST["pass2"])){

	$targetPath = "sign/codesign.pfx";
	move_uploaded_file($_FILES["inpFile"]["tmp_name"], $targetPath);

	$pass = encrypt_decrypt("encrypt", $_POST["pass2"], "./core/key.txt");
		
	@$fp = fopen("./sign/key.txt", 'wa+');
	if(fwrite($fp, $pass) === FALSE){
		echo json_encode(array("result" => "err"));
		exit;
	} else {
		echo json_encode(array("result" => "ok"));
		exit;
	}

} else {
	echo json_encode(array("result" => "err"));
	exit;
}

?>