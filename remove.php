<?php

session_start();


if (isset($_GET['id']) ) {
	
	if(file_exists("./restricted/structure.php")){
	
		require_once './restricted/structure.php';
		
		$c  = new mysqli($host,$usDB,$passDB,$database);
		
		$id = $_GET['id'];
		
		$qs = $c->query("DELETE FROM pacchetti WHERE id='$id'");
		$qs = $c->query("OPTIMIZE TABLE pacchetti");
		
		header ("Location: costruisci.php");

	} else {
		header ("Location: setup.html");
	}
	
} else {
	header ("Location: costruisci.php");
}