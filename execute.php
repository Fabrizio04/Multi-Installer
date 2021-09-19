<?php
if(!file_exists('./core/config.inc.php')) header("Location: ./websetup");
require_once './core/config.inc.php';

$nome_var = $_POST['nomeVar'];
	
if(!empty($_POST['nomeVar'])){

//genero un id casuale
$characters = '0123456789';
$charactersLength = strlen($characters);
$randomString = '';

for ($i = 0; $i < 5; $i++) {
	$randomString .= $characters[rand(0, $charactersLength - 1)];
}

$randomString = strtoupper($randomString);

$a=time();
$b=date('d-m-y_H-i-s', $a);
$filename = 'Setup_'.$b.'_'.$randomString.'.bat';
$fp = fopen("setup/$filename", 'a');


$linea_cmd = "";
$programmi_selezionati = "";
$catena = "";

$linea_cmd .= "@echo off
title Multi-Installer by Fabrizio Amorelli
color 70

";

//riscrivere la parte dell'uac
if (isset($_COOKIE['uac'])){
	
	if($_COOKIE['uac'] == "on" && $tipo == "bat"){
		/*$linea_cmd .= '>nul 2>&1 "%SYSTEMROOT%\system32\cacls.exe" "%SYSTEMROOT%\system32\config\system"

if \'%errorlevel%\' NEQ \'0\' (
echo Apertura UAC ...
goto UACPrompt
) else (
goto gotAdmin
)

:UACPrompt
echo Set UAC = CreateObject^("Shell.Application"^) > "%temp%\getadmin.vbs"
set params = %*:"="
echo UAC.ShellExecute "cmd.exe", "/c %~s0 %params%", "", "runas", 1 >> "%temp%\getadmin.vbs"

"%temp%\getadmin.vbs"
del "%temp%\getadmin.vbs"
exit /B

:gotAdmin
title Multi-Installer by Fabrizio Amorelli
color 70

';*/

$linea_cmd .= 'set "params=%*"
cd /d "%~dp0" && ( if exist "%temp%\getadmin.vbs" del "%temp%\getadmin.vbs" ) && fsutil dirty query %systemdrive% 1>nul 2>nul || (  echo Set UAC = CreateObject^("Shell.Application"^) : UAC.ShellExecute "cmd.exe", "/k cd ""%~sdp0"" && %~s0 %params%", "", "runas", 1 >> "%temp%\getadmin.vbs" && "%temp%\getadmin.vbs" && exit /B )

';
	}
	
} else {
	
	if($tipo == "bat"){
	
	$linea_cmd .= '>nul 2>&1 "%SYSTEMROOT%\system32\cacls.exe" "%SYSTEMROOT%\system32\config\system"

if \'%errorlevel%\' NEQ \'0\' (
echo Apertura UAC ...
goto UACPrompt
) else (
goto gotAdmin
)

:UACPrompt
echo Set UAC = CreateObject^("Shell.Application"^) > "%temp%\getadmin.vbs"
set params = %*:"="
echo UAC.ShellExecute "cmd.exe", "/c %~s0 %params%", "", "runas", 1 >> "%temp%\getadmin.vbs"

"%temp%\getadmin.vbs"
del "%temp%\getadmin.vbs"
exit /B

:gotAdmin
title Multi-Installer by Fabrizio Amorelli
color 70

';
	}
}

$c  = new mysqli($host,$usDB,$passDB,$database);
$q = $c->query("SELECT * FROM server");
$d = $q->fetch_array();

$percorsoWeb = $d['web'];
$percorsoRep = $d['rep'];
$lettera = $d['let'];
$userServer = $d['us'];
$passServer = $d['psw'];
$signature = $d['sin'];
$log = $d['log'];

/** Log **/

if($log == "on"){
	
	$listapro_log = '';

	foreach($_POST['nomeVar'] as $selected){
		$listapro_log .= "$selected;";
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	//aggiungere username più avanti...
	$log_file = './log_request/log.txt';
	
	if(filesize($log_file)){
		$log_data = "\n".date("d/m/Y H:i:s",time())." - $ip - execute.php - $listapro_log";
	} else {
		$log_data = date("d/m/Y H:i:s",time())." - $ip - execute.php - $listapro_log";
	}
	file_put_contents($log_file, $log_data, FILE_APPEND | LOCK_EX);
}

/** Fine log **/

if($passServer != "") $passServer = encrypt_decrypt("decrypt", $passServer, "./core/key.txt");

if (isset($_COOKIE['connect'])){
	
	if($_COOKIE['connect'] == "on"){
		
		if($userServer == ""){
			
			$linea_cmd .= 'ECHO Connessione al Server Repository
net use '.$d['let'].': '.$d['rep'].'

ECHO.
ECHO Accesso eseguito correttamente
ECHO.

';
	
		} else {
			
			$linea_cmd .= 'ECHO Connessione al Server Repository
for /l %%a in (1, 1, 15) do ( 
if exist '.$d['rep'].' (
goto cont
) else (
net use '.$d['let'].': '.$d['rep'].' /user:'.$d['us'].' '.$passServer.'
)
)

:cont
ECHO Accesso eseguito correttamente
ECHO.

';
	
		}
		
	} else {
		
		if($userServer == ""){
			
			$linea_cmd .= 'ECHO Connessione al Server Repository
net use '.$d['let'].': '.$d['rep'].'

ECHO.
ECHO Accesso eseguito correttamente
ECHO.

';
	
		} else {
	
$linea_cmd .= 'ECHO Connessione al Server Repository
for /l %%a in (1, 1, 15) do ( 
if exist '.$d['rep'].' (
goto cont
) else (
net use '.$d['let'].': '.$d['rep'].' /user:'.$d['us'].' *
)
)

:cont
ECHO Accesso eseguito correttamente
ECHO.

';
	
		}
		
	}
	
} else {
	
	if($userServer == ""){
		
		$linea_cmd .= 'ECHO Connessione al Server Repository
net use '.$d['let'].': '.$d['rep'].'

ECHO.
ECHO Accesso eseguito correttamente
ECHO.

';
	
	} else {
		
		$linea_cmd .= 'ECHO Connessione al Server Repository
for /l %%a in (1, 1, 15) do ( 
if exist '.$d['rep'].' (
goto cont
) else (
net use '.$d['let'].': '.$d['rep'].' /user:'.$d['us'].' '.$passServer.'
)
)

:cont
ECHO Accesso eseguito correttamente
ECHO.

';
	
	}
	
}

/** **/
		
	foreach($_POST['nomeVar'] as $selected){
		//echo $selected."</br>";
		
		$q = $c->query("SELECT * FROM pacchetti WHERE id=$selected");
		$d = $q->fetch_array();
		
		if ($architettura == 64){ 
			$file = $d['file64'];
			$stringa = $d['param64'];
		} else {
			$file = $d['file32'];
			$stringa = $d['param32'];
		}
		
		if($file == ""){
			$linea_cmd .= 'ECHO Pacchetto '.$d['nome'].' a '.$architettura.' bit non disponibile
timeout /t 10 >nul
ECHO.

';
		} else {
			$linea = str_replace(''.$file.'', ''.$lettera.''.":\\".''.$file.'', ''.$stringa.'');
		
			$linea_cmd .= 'ECHO Installazione di '.$d['nome'].'
ECHO Attendere ...
'.$linea.'
ECHO.

';
		}

$proId = 'progr'.$d['id'].'';
$programma = str_replace(" ", "_", $d['nome']);
$catena .= '%'.$proId.'%';

if ($architettura == 64){ $controllo = $d['controllo64']; } else { $controllo = $d['controllo32']; }//$linea_cmd .= 'if exist "'.$d['controllo64'].'" (

if (strpos($d['controllo32'], 'Program Files') !== false) {
    $controlloB = str_replace("Program Files", "Program Files (x86)", $d['controllo32']);
} else $controlloB = '';

if ($controlloB == ""){

$linea_cmd .= 'if exist "'.$controllo.'" (
set '.$proId.'="'.$d['id'].':1;"
) else (
set '.$proId.'="'.$d['id'].':2;"
)
ECHO.

';

} else {
	
$linea_cmd .= 'if exist "'.$controllo.'" (
set '.$proId.'="'.$d['id'].':1;"
) else if exist "'.$controlloB.'" (
set '.$proId.'="'.$d['id'].':1;"
) else (
set '.$proId.'="'.$d['id'].':2;"
)
ECHO.

';

}

$programmi_selezionati .= str_replace(" ", "_", ''.$d['nome'].';');

	}
	
	
	$linea_cmd .= 'ECHO Disconnessione Server Repository
net use '.$lettera.': /delete
ECHO.

';
	
	$linea_cmd .= 'start '.$percorsoWeb.'end.php?html='.$catena.'
	
exit';
	
	if (fwrite($fp, $linea_cmd) === FALSE) {
        echo "ERRORE";
        //exit;
	}
	
	

	
	fclose($fp);
	
	if($tipo == "exe"){
		$a=time();
		$b=date('d-m-y_H-i-s', $a);
		$exename = 'Setup_'.$b.'_'.$randomString.'.exe';
		
		
		if (isset($_COOKIE['uac'])){
			
			if($_COOKIE['uac'] == "on")
				system("converter\Bat_To_Exe_Converter.exe /bat setup\\\"$filename\" /exe setup\\\"$exename\" /icon favicon.ico");
			else
				system("converter\Bat_To_Exe_Converter.exe /bat setup\\\"$filename\" /exe setup\\\"$exename\" /icon favicon.ico /uac-user");
			
		} else {
			system("converter\Bat_To_Exe_Converter.exe /bat setup\\\"$filename\" /exe setup\\\"$exename\" /icon favicon.ico");
		}
		
		/* firma digitale */
		if($signature == "on"){
			$ff = fopen("./sign/key.txt", 'r');
			$psw_sign = fgets($ff);
			fclose($ff);
			
			$psw_sign = encrypt_decrypt("decrypt", $psw_sign, "./core/key.txt");
			shell_exec(realpath('./')."\\sign\\firma.bat $exename $psw_sign");
		}
		
		unlink ("./setup/$filename");
		
		$filename = $exename;
	}
	
	$filename = str_replace("-","",$filename);
	$filename = str_replace("_","",$filename);
	$filename = str_replace("Setup","",$filename);
	$filename = str_replace(".exe","0",$filename);
	$filename = str_replace(".bat","1",$filename);
	
	$filename = str_replace($randomString,"",$filename);
	$filename = strrev($randomString).":".strrev($filename);
	
	$_SESSION['programs'] = $programmi_selezionati;
	$_SESSION['filename'] = $filename;
	
	/** cronologia **/
	$ll = str_replace(";",",",$_SESSION['programs']);
	$lll = substr($ll, 0, -1);
	$miofile = $_SESSION['filename'];
	$timestamp = time();
	
	if (isset($_SESSION['history'])){
		$_SESSION['history'] = $timestamp."=".$miofile."=".$lll."=".$architettura.";".$_SESSION['history'];
	} else {
		$_SESSION['history'] = $timestamp."=".$miofile."=".$lll."=".$architettura.";";
	}
	
	/** Fine cronologia **/
	
	header("Location: download.php");
	
} else {
	header("Location: ./");
}