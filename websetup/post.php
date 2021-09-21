<?php
$data = file_get_contents('php://input');
header('Content-Type: application/json');
header('Accept: application/json');
require_once '../core/openssl.php';

if($data == ""){
	echo json_encode(array("result" => "err", "text" => "Post Error"));
	exit;
}

$data = json_decode($data, true);
@$db = mysqli_connect($data['host'],$data['usDB'],$data['passDB'],$data['database']);

if (mysqli_connect_errno()){
	echo json_encode(array("result" => "err", "text" => "".mysqli_connect_error().""));
	exit;
} else {
	
	$percorsoWeb = mysqli_real_escape_string($db,$data["percorsoWeb"]);
	$percorsoRep = mysqli_real_escape_string($db,$data["percorsoRep"]);
	$lettera = mysqli_real_escape_string($db,$data["lettera"]);
	$userServer = mysqli_real_escape_string($db,$data["userServer"]);
	$passServer = mysqli_real_escape_string($db,$data["passServer"]);
	$motore = $data["motore"];
	
	//genero chiave privata
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $k_1 = '';
    $k_2 = '';
    
	for ($i = 0; $i < 64; $i++)
        $k_1 .= $characters[rand(0, $charactersLength - 1)];
	
	for ($i = 0; $i < 64; $i++)
        $k_2 .= $characters[rand(0, $charactersLength - 1)];
	
	$chiave = $k_1.$k_2;
    
	@$fp = fopen("../core/key.txt", 'wa+');
	if(fwrite($fp, $chiave) === FALSE){
		echo json_encode(array("result" => "err", "text" => "File System Error"));
		mysqli_close($db);
		exit;
	}
	
	sleep(2);
	
	if($passServer != "") $passServer = encrypt_decrypt("encrypt", $passServer, "../core/key.txt");

	
	$query = "
CREATE TABLE IF NOT EXISTS sha256 (
  id int(11) NOT NULL,
  file varchar(100) NOT NULL,
  sha256 text NOT NULL
) ENGINE=$motore DEFAULT CHARSET=latin1;
";
	mysqli_query($db,$query);
	
	$query = "
ALTER TABLE sha256
ADD PRIMARY KEY (id);
";
	
	mysqli_query($db,$query);
	
	$query = "
ALTER TABLE sha256
MODIFY id int(11) NOT NULL AUTO_INCREMENT;
";
	mysqli_query($db,$query);
	
	$query = "
CREATE TABLE IF NOT EXISTS server (
  id int(11) NOT NULL,
  web varchar(100) NOT NULL,
  rep varchar(100) NOT NULL,
  let varchar(1) NOT NULL,
  us varchar(100) NOT NULL,
  psw varchar(100) NOT NULL,
  sin varchar(3) NOT NULL,
  log varchar(3) NOT NULL,
  del varchar(50) NOT NULL
) ENGINE=$motore DEFAULT CHARSET=latin1;
";
	
	mysqli_query($db,$query);
	
	$query = "
ALTER TABLE server
ADD PRIMARY KEY (id);
";
	
	mysqli_query($db,$query);
	
	$query = "
ALTER TABLE server
MODIFY id int(11) NOT NULL AUTO_INCREMENT;
";
	mysqli_query($db,$query);
	
	$query = 'INSERT INTO server (web, rep, let, us, psw, sin, log) VALUES ("'.$percorsoWeb.'","'.$percorsoRep.'","'.$lettera.'","'.$userServer.'","'.$passServer.'", "off", "off");';
	
	mysqli_query($db,$query);
	
	$query = "
CREATE TABLE IF NOT EXISTS pacchetti (
  id int(11) NOT NULL,
  nome varchar(100) NOT NULL,
  file64 varchar(100) NOT NULL,
  file32 varchar(100) NOT NULL,
  param64 text NOT NULL,
  param32 text NOT NULL,
  controllo64 text NOT NULL,
  controllo32 text NOT NULL,
  `desc` text NOT NULL
) ENGINE=$motore DEFAULT CHARSET=latin1;
";
	mysqli_query($db,$query);
	
	$query = "
ALTER TABLE pacchetti
ADD PRIMARY KEY (id);
";
	
	mysqli_query($db,$query);
	
	$query = "
ALTER TABLE pacchetti
MODIFY id int(11) NOT NULL AUTO_INCREMENT;
";
	mysqli_query($db,$query);
	
	$query = "
CREATE TABLE IF NOT EXISTS pack (
  id int(11) NOT NULL,
  nome varchar(100) NOT NULL,
  packs text NOT NULL

) ENGINE=$motore DEFAULT CHARSET=latin1;
";
	mysqli_query($db,$query);
	
	$query = "
ALTER TABLE pack
ADD PRIMARY KEY (id);
";
	
	mysqli_query($db,$query);
	
	$query = "
ALTER TABLE pack
MODIFY id int(11) NOT NULL AUTO_INCREMENT;
";
	mysqli_query($db,$query);
	
	@$fp = fopen("../core/config.inc.php", 'wa+');
	$linea_structure = "";

	$linea_structure = "<?php";
	
	if($data['passDB'] != "") $data['passDB'] = encrypt_decrypt("encrypt", $data['passDB'], "../core/key.txt");
	
	$linea_structure .= '
$host = "'.$data['host'].'";
$usDB = "'.$data['usDB'].'";
$passDB = "'.$data['passDB'].'";
$database = "'.$data['database'].'";

require_once \'openssl.php\';
require_once \'c_functions.php\';
if($passDB != "") $passDB = encrypt_decrypt("decrypt", $passDB, "./core/key.txt");
';


	if (fwrite($fp, $linea_structure) === FALSE) {
		echo json_encode(array("result" => "err", "text" => "File System Error"));
	} else {	
		echo json_encode(array("result" => "ok"));
	}
	
	
	$date = new DateTime();
	$interval = new DateInterval('P1D');
	$date->add($interval);
	$info = simplexml_load_file('../core/Clean Setup.xml');
	$info->Actions->Exec->Command[0] = realpath('../')."\\core\clean.bat";
	$info->Triggers->CalendarTrigger->StartBoundary[0] = $date->format("Y-m-d")."T00:00:00";	
	$sid = explode(" ", trim(shell_exec("wmic useraccount where name='%username%' get sid")));
	$id = end($sid);
	$info->Principals->Principal->UserId[0] = $id;
	
	$info->asXML('../core/Clean Setup.xml');
	sleep(2);
	exec('schtasks /create /xml "../core/Clean Setup.xml" /tn "Multi-Installer\Clean Setup"');
		
	mysqli_close($db);
	exit;
}
?>