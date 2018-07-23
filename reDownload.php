<?php
session_start();


require_once('ForceDownload.class.php');

if(file_exists("./restricted/structure.php")){
	
require_once './restricted/structure.php';

$c  = new mysqli($host,$usDB,$passDB,$database);


if(isset($_GET['id'])){
	
	$id = $_GET['id'];	
	$q = $c->query("SELECT * FROM pacchetti WHERE id='$id'");
	$d = $q->fetch_array();
	
	$a=time();
	$b=date('d-m-y_H-i-s', $a);
	$filename = $d['nome'].'_'.$b.'.bat';
	
	if(isset($_SESSION['redownload'.$id.''])){
		
		$filename = $_SESSION['redownload'.$id.''];
		header("Location: ./redownload/$filename");
		
	} else {
		
	
	
	$fp = fopen("redownload/$filename", 'a');
	
			$linea_cmd = '@echo off
ECHO Installazione di '.$d['nome'].'
ECHO Attendere ...
'.$d['stringa'].'
ECHO.

';
	if (fwrite($fp, $linea_cmd) === FALSE) {
        echo "ERRORE";
        //exit;
	} else {
		$_SESSION['redownload'.$id.''] = $filename;
		header("Location: ./redownload/$filename");
	}
	
	}
	
} else {
	header("Location: ./");
}

} else {
	header("Location: ./websetup");
}