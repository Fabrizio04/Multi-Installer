<?php
require_once './core/config.inc.php';

if(isset($_GET['html'])){
	$c  = new mysqli($host,$usDB,$passDB,$database);
	$g2 = $_GET['html'];
	$g = substr($g2, 0, strlen($g2)-1);
	$dato = str_replace(":", ":", $g);
	$nuovo = explode(";", $dato);

	$a=time();
	$b=date('d-m-y_H-i-s', $a);
	$nomefile = 'Log_'.$b.'.html';
	
	foreach($nuovo as $key => $value){
		
		$nuovo2 = explode(":", $value);
		$q = $c->query("SELECT * FROM pacchetti WHERE id=$nuovo2[0]");
		$d = $q->fetch_array();
		if($nuovo2[1] == 1){ $risultato = '<span style="color:green">Installato</span>'; } else { $risultato = '<span style="color:red">Errore</span>'; }
		echo $d['nome'].': '.$risultato.'<br>';
	}
	
	header ("Content-Type: application/octet-stream"); 
	header ("Content-Disposition: inline; filename=$nomefile"); 

} else {
	header("Location: ./");
}