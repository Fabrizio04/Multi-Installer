<?php

session_start();

function calcolaNome($id){
	
	$token = strrev(explode(":",$id)[0]);
	
	@$id = explode(":",$id)[1];
	
	$stringa = strrev($id);
	
	$gg =  substr($stringa, 0, 2);
	$mm =  substr($stringa, 2, 2);
	$aa =  substr($stringa, 4, 2);
	
	$hh =  substr($stringa, 6, 2);
	$mi =  substr($stringa, 8, 2);
	$ss =  substr($stringa, 10, 2);
	
	$estensione = substr($stringa, -1);
	
	if ($estensione == "0") $estensione = ".exe";
	else $estensione = ".bat";
	
	$nomefile = "Setup_{$gg}-{$mm}-{$aa}_{$hh}-{$mi}-{$ss}_{$token}{$estensione}";
	
	return $nomefile;
}

function smb_connect($path,$us,$psw){
	
	if($psw != "") $psw = encrypt_decrypt("decrypt", $psw, "./core/key.txt");
	
	if($us == "") $command = 'net use z: "'.$path.'"';
	else $command = 'net use z: "'.$path.'" /user:'.$us.' %1';
	
	$command = '@echo off
cd
'.$command.'
exit
';

	$fp = fopen("./netuse.bat", 'wa+');
	if (fwrite($fp, $command) === FALSE) {
		exit;
	}
	
	fclose($fp);
	sleep(1);
	
	if($psw != "") exec('start "" netuse.bat '.$psw.'');
	else exec('start "" netuse.bat');
}

/** Personalizzazione sistema **/

if (isset($_COOKIE['tipo'])){
	
	$tipo = $_COOKIE['tipo'];
		
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 10') !== FALSE){
	   $so = '10';
	   $sistema = 'Microsoft &copy; Windows '.$so.'';
	   $estensione = '(.'.$tipo.')';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.3') !== FALSE) {
	   $so = '8.1';
	   $sistema = 'Microsoft &copy; Windows '.$so.'';
	   $estensione = '(.'.$tipo.')';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.2') !== FALSE) {
	   $so = '8';
	   $sistema = 'Microsoft &copy; Windows '.$so.'';
	   $estensione = '(.'.$tipo.')';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.1') !== FALSE) {
	   $so = '7';
	   $sistema = 'Microsoft &copy; Windows '.$so.'';
	   $estensione = '(.'.$tipo.')';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.0') !== FALSE) {
	   $so = 'Vista';
	   $sistema = 'Microsoft &copy; Windows '.$so.'';
	   $estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 5.1') !== FALSE) {
	   $so = 'XP';
	   $sistema = 'Microsoft &copy; Windows XP';
	   $estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPod') !== FALSE) {
		$so = 'iOS';
		$sistema = "iPod";
		$estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== FALSE) {
		$so = 'iOS';
		$sistema = "iPhone";
		$estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== FALSE) {
		$so = 'iOS';
		$sistema = "iPad";
		$estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== FALSE) {
		$so = 'Android';
		$sistema = "Android";
		$estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'webOS') !== FALSE) {
		$so = 'webOS';
		$sistema = "webOS";
		$estensione = 'N/D';
	} else {
	   $so = 'Altro';
	   $sistema = "Sistema Sconosciuto";
	   $estensione = 'N/D';
	}
		
} else {
	
	$tipo = "exe";
	
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 10') !== FALSE){
		$so = '10';
		$sistema = 'Microsoft &copy; Windows '.$so.'';
		$estensione = '(.exe)';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.3') !== FALSE) {
		$so = '8.1';
		$sistema = 'Microsoft &copy; Windows '.$so.'';
		$estensione = '(.exe)';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.2') !== FALSE) {
		$so = '8';
		$sistema = 'Microsoft &copy; Windows '.$so.'';
		$estensione = '(.exe)';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.1') !== FALSE) {
		$so = '7';
		$sistema = 'Microsoft &copy; Windows '.$so.'';
		$estensione = '(.exe)';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.0') !== FALSE) {
		$so = 'Vista';
		$sistema = 'Microsoft &copy; Windows '.$so.'';
		$estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 5.1') !== FALSE) {
		$so = 'XP';
		$sistema = 'Microsoft &copy; Windows XP';
		$estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPod') !== FALSE) {
		$so = 'iOS';
		$sistema = "iPod";
		$estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== FALSE) {
		$so = 'iOS';
		$sistema = "iPhone";
		$estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== FALSE) {
		$so = 'iOS';
		$sistema = "iPad";
		$estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== FALSE) {
		$so = 'Android';
		$sistema = "Android";
		$estensione = 'N/D';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'webOS') !== FALSE) {
		$so = 'webOS';
		$sistema = "webOS";
		$estensione = 'N/D';
	} else {
	   $so = 'Altro';
	   $sistema = "Sistema Sconosciuto";
	   $estensione = 'N/D';
	}
}

/** Personalizzazione Architettura**/

if (isset($_COOKIE['arch'])){
	
	$arch = $_COOKIE['arch'];
	
	if ($arch == "auto") {
		
		if((strpos($_SERVER['HTTP_USER_AGENT'], 'Win64') !== FALSE) ||(strpos($_SERVER['HTTP_USER_AGENT'], 'WOW64') !== FALSE)){
			$bit = '64 Bit';
			$architettura = '64';
		} else {
			$bit = '32 Bit';
			$architettura = '32';
		}
		
	} else if ($arch == "32"){
		
		$bit = '32 Bit';
		$architettura = '32';
		
	} else if ($arch == "64"){
		
		$bit = '64 Bit';
		$architettura = '64';
	}
	
} else {
	
	if((strpos($_SERVER['HTTP_USER_AGENT'], 'Win64') !== FALSE) ||(strpos($_SERVER['HTTP_USER_AGENT'], 'WOW64') !== FALSE)){
		$bit = '64 Bit';
		$architettura = '64';
	} else {
		$bit = '32 Bit';
		$architettura = '32';
	}
	
}