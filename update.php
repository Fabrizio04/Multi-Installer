<?php

session_start();



if ( (isset($_POST['Invia'])) && (isset($_POST['nome'])) && (isset($_POST['stringa'])) && (isset($_POST['controllo'])) ) {
	
	if(file_exists("./restricted/structure.php")){
	
		require_once './restricted/structure.php';
		
		$c  = new mysqli($host,$usDB,$passDB,$database);
		
		$nome = $c->real_escape_string($_POST['nome']);
		$stringa = $c->real_escape_string($_POST['stringa']);
		$controllo = $c->real_escape_string($_POST['controllo']);
		
		if (isset($_GET['id'])){
			$id = $_GET['id'];
		} else {
			header ("Location: costruisci.php");
		}
		
		$qs = $c->query("UPDATE pacchetti SET nome='$nome', stringa='$stringa', controllo1='$controllo' WHERE id='$id'");
		$qs = $c->query("OPTIMIZE TABLE pacchetti");
		
		header ("Location: costruisci.php");

	} else {		
		header ("Location: ./websetup");
	}
	
} else {
	header ("Location: costruisci.php");
}