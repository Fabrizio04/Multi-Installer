<?php

session_start();


if ( (isset($_GET['Invia'])) && (isset($_GET['nome'])) && (isset($_GET['stringa'])) && (isset($_GET['controllo'])) ) {
	
	if(file_exists("./restricted/structure.php")){
	
		require_once './restricted/structure.php';
		
		$c  = new mysqli($host,$usDB,$passDB,$database);
		
		$nome = $c->real_escape_string($_GET['nome']);
		$stringa = $c->real_escape_string($_GET['stringa']);
		$controllo = $c->real_escape_string($_GET['controllo']);
		
		$qs = $c->query('INSERT INTO pacchetti (nome, stringa, controllo1) VALUES ("'.$nome.'","'.$stringa.'","'.$controllo.'");');
		
		header ("Location: costruisci.php");

	} else {		
		header ("Location: ./websetup");
	}
	
} else {
	header ("Location: costruisci.php");
}