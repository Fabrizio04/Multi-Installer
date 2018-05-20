<?php
session_start();
require_once './restricted/structure.php';

$nome_var = $_GET['nomeVar'];
	
if(!empty($_GET['nomeVar'])){
		
$a=time();
$b=date('d-m-y_H-i-s', $a);
$filename = 'Setup_'.$b.'.bat';
$fp = fopen("setup/$filename", 'a');


$linea_cmd = "";
$programmi_selezionati = "";

/** **/

if (isset($_GET['uac'])){
	
$linea_cmd .= "@ECHO off
:start
ECHO.
set /p choice= Disattivare il Controllo UAC ? (attenzione, il pc verra' riavviato) [si o no] : 
rem if not '%choice%'=='' set choice=%choice:~0;1% (non usare questo comando, perché prende solo il primo carattere nel caso in cui ne vengano inseriti più di 1. Infatti con quel comando la scelta 23455666 corrisponderebbe con la scelta 2 ed otterresti \"Bye\").
if '%choice%'=='' ECHO \"%choice%\" non e' un'opzione valida, si prega di riprovare
if '%choice%'=='si' goto Si
if '%choice%'=='no' goto No

ECHO.
goto start
:no
ECHO Perfetto ! Allora Puoi continuare ...
goto end
:si
ECHO Disattivazione UAC ...
reg add \"HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Policies\System\" /v EnableLUA /T reg_dword /d 0x0 /f
ECHO Completato per Applicare le Modifiche è Necessario Riavviare il PC
ECHO Riavvio da 15 Secondi
shutdown -r -t 15
exit
:end
ECHO.
ECHO.

";
} else {
	$linea_cmd .= "";
}

/** **/

$c  = new mysqli($host,$usDB,$passDB,$database);
$q = $c->query("SELECT * FROM server");
$d = $q->fetch_array();

$percorsoWeb = $d['web'];
$percorsoRep = $d['rep'];
$lettera = $d['let'];
$userServer = $d['us'];
$passServer = $d['psw'];
$hash = $d['hash'];

//echo $passServer;

if (isset($_GET['connect'])){
	
	if($userServer == ""){
		
$linea_cmd .= '@echo off
ECHO Connessione al Server Repository
net use '.$d['let'].': '.$d['rep'].'

ECHO.
ECHO Accesso eseguito correttamente
ECHO.

';
	
	} else {

	
$linea_cmd .= '@echo off
ECHO Connessione al Server Repository
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
		
$linea_cmd .= '@echo off
ECHO Connessione al Server Repository
net use '.$d['let'].': '.$d['rep'].'

ECHO.
ECHO Accesso eseguito correttamente
ECHO.

';
	
	} else {
	
$linea_cmd .= '@echo off
ECHO Connessione al Server Repository
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

/** **/
		
	foreach($_GET['nomeVar'] as $selected){
		//echo $selected."</br>";
		
		$q = $c->query("SELECT * FROM pacchetti WHERE id=$selected");
		$d = $q->fetch_array();
		
		$linea_cmd .= '@echo off
ECHO Installazione di '.$d['nome'].'
ECHO Attendere ...
'.$d['stringa'].'
ECHO.

';

$proId = 'progr'.$d['id'].'';
$programma = str_replace(" ", "_", $d['nome']);
$catena .= '%'.$proId.'%';

$linea_cmd .= 'if exist "'.$d['controllo1'].'" (
set '.$proId.'="'.$programma.':_<span_style=\'color:green\'_>Installato</span>;"
) else (
set '.$proId.'="'.$programma.':_<span_style=\'color:red\'_>Errore</span>_<a_href=\'reDownload.php?id='.$selected.'\'>[Scarica_script]</a>;"
)
ECHO.

';
	



/**

if exist "C:\Program Files\Java\jre6\bin" (
set java1625="Java_1.6.25:_<span_style='color:green'_>Installato</span>;"
) else (
set java1625="Java_1.6.25:_<span_style='color:red'_>Errore</span>_<a_href='file/java1625.bat'>[Scarica_script]</a>;"
)
ECHO.

**/

$programmi_selezionati .= str_replace(" ", "_", ''.$d['nome'].';');
	}
	
	$q = $c->query("SELECT * FROM server");
	$d = $q->fetch_array();
	
	//$linea_cmd .= 'start '.$d['web'].'end.php?html='.$programmi_selezionati.'';
	
	$linea_cmd .= '@echo off
ECHO Disconnessione Server Repository
net use '.$d['let'].': /delete
ECHO.

';
	
	$linea_cmd .= 'start '.$d['web'].'end.php?html='.$catena.'';
	
	if (fwrite($fp, $linea_cmd) === FALSE) {
        echo "ERRORE";
        //exit;
	}
	
	

	
	fclose($fp);
	
	$tipo = $_GET['tipo'];
	
	if($tipo == "exe"){
		
		//system("converter\Bat_To_Exe_Converter.exe /bat setup\'$filename' /exe setup\prova.exe /icon converter\favicon.ico");
		//$filename= "Setup_27-04-18_18-50-57.bat";
		//system("converter\Bat_To_Exe_Converter.exe /bat setup\'$filename' /exe setup\prova.exe /icon favicon.ico");
		
		$a=time();
		$b=date('d-m-y_H-i-s', $a);
		$exename = 'Setup_'.$b.'.exe';
		
		system("converter\Bat_To_Exe_Converter.exe /bat setup\\\"$filename\" /exe setup\\\"$exename\" /icon favicon.ico");
		
		unlink ("./setup/$filename");
		
		$filename = $exename;
		
	}
	
	$_SESSION['programs'] = $programmi_selezionati;
	$_SESSION['filename'] = $filename;
	
	
	header("Location: download.php");
	
} else {
	header("Location: ./");
}