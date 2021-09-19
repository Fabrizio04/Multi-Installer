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

$paese = $data["paese"];
$stato = $data["stato"];
$luogo = $data["luogo"];
$org = $data["org"];
$uni = $data["uni"];
$cname = $data["cname"];
$mail = $data["mail"];
$pass = $data["pass"];

system('sign\openssl\bin\openssl.exe req -x509 -days 365 -newkey rsa:2048 -keyout sign\private-key.pem -out sign\certificate.pem -passout pass:'.$pass.' -subj "/C='.$paese.'/ST='.$stato.'/L='.$luogo.'/O='.$org.'/OU='.$uni.'/CN='.$cname.'/emailAddress='.$mail.'"');

if(file_exists("./sign/certificate.pem")){
	system('sign\openssl\bin\openssl.exe pkcs12 -export -in sign\certificate.pem -inkey sign\private-key.pem -out sign\codesign.pfx -passin pass:'.$pass.' -password pass:'.$pass.'');
	
	if(file_exists("./sign/codesign.pfx")){
		
		$pass = encrypt_decrypt("encrypt", $pass, "./core/key.txt");
		
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
	
} else {
	echo json_encode(array("result" => "err"));
	exit;
}

?>