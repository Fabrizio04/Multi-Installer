<?php require_once './core/config.inc.php'; ?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer</title>

<?php require_once './core/header.php'; ?>

<script type="text/javascript">
function download(){
	var query = window.location.search;
	window.location.href="export.php"+query;
}
</script>

</head>

<body>

<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<?php require_once './core/menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">

<h1>Installazione conclusa</h1>

<?php
if(isset($_GET['html'])){
	
	$g2 = $_GET['html'];
	$g = substr($g2, 0, strlen($g2)-1);
	$dato = str_replace(":", ":", $g);
	$c  = new mysqli($host,$usDB,$passDB,$database);
	$nuovo = explode(";", $dato);
 
	foreach($nuovo as $key => $value){
		
		$nuovo2 = explode(":", $value);
		$q = $c->query("SELECT * FROM pacchetti WHERE id=$nuovo2[0]");
		$d = $q->fetch_array();
		if($nuovo2[1] == 1){ $risultato = '<span style="color:green">Installato</span>'; } else { $risultato = '<span style="color:red">Errore</span>'; }
		echo $d['nome'].': '.$risultato.'<br>';
	}
 
} else {
	header ("Location: ./");
}
 
?>

<br>
<button id="last_selected" onclick="download()">SCARICA REPORT</button>

</div>

<?php require_once './core/footer.php'; ?>

</body>

</html>