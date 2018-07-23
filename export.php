<?php
session_start();
require_once('ForceDownload.class.php');

if(file_exists("./restricted/structure.php")){
	
require_once './restricted/structure.php';

$c  = new mysqli($host,$usDB,$passDB,$database);

$q = $c->query("SELECT * FROM server");

$d = $q->fetch_array();

if(isset($_GET['html'])){
 
$g = $_GET['html'];

$dato1 = str_replace("reDownload.php", $d['web']."reDownload.php", $g);

$dato = str_replace("_", " ", $dato1);
 
 
$nuovo = explode(";", $dato);

$a=time();
$b=date('d-m-y_H-i-s', $a);
$filename = 'Log_'.$b.'.html';

	if(isset($_SESSION[''.$g.''])){
		
		$filename = $_SESSION[''.$g.''];
		
		$dir = "./log/";  
		$file = $filename;
		$download = New ForceDownload($dir, $file);
		$download->download() or die ($download->get_error());

		
	} else {
		
foreach($nuovo as $key => $value){
 
//echo ''.$value.'<br>';
 
 $var=fopen("./log/$filename","a");
	fwrite($var,''.$value.'<br>');
	fclose($var);
 
}

$_SESSION[''.$g.''] = $filename;

$dir = "./log/";  
$file = $filename;
$download = New ForceDownload($dir, $file);
$download->download() or die ($download->get_error());
		
		
	}

 


 
} else {
	header("Location: ./");
}

} else {
	header("Location: ./websetup");
}
 
?>