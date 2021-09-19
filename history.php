<?php
require_once './core/config.inc.php';

if (isset($_GET['clearData'])){
	$_SESSION['history'] = NULL;
	$_SESSION['filename'] = NULL;
	header("Location: ./history.php");
}

if (isset($_POST['id'])){
	
	if (@strpos($_SESSION['history'], $_POST['id']) !== false) {
		
		$lll = substr($_SESSION['history'], 0, -1) . '';
		$pieces = explode(";", $lll);
		
		$riga = '';
		
		foreach ($pieces as $key => $value){
			
			$pieces2 = explode("=", $value);
			$id = $pieces2[1];
			
			if ($id == $_POST['id']){
				$riga = $value;
				break;
			}
			
		}
		
		$riga = $riga.";";
		$_SESSION['history'] = str_replace($riga, "", $_SESSION['history']);
		
		if($_SESSION['filename'] == $id) {
			$_SESSION['filename'] = NULL;
		}
		
		if($_SESSION['history'] == "") {
			$_SESSION['history'] = NULL;
			$_SESSION['filename'] = NULL;
		}
		
		echo 'OK';
		
	} else {
		echo 'Er';
	}
	
	exit;
}
?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer - Cronologia</title>

<?php require_once './core/header_history.php'; ?>

<style>
.main {
	margin: auto;
	padding-top: 150px;
	padding-bottom: 15px;
	width: 100%;
}

.fa-trash {
	cursor:pointer;
}


@media only screen and (min-width:997px){
	.main {
		margin: auto;
		width: 100%;
		padding-top: 150px;
		padding-bottom: 15px;
	}
	
	#nomefile {
		width: 270px;
	}
	
	#datafile {
		width: 120px;
	}
	
	#architettura {
		width: 100px;
	}
	

}
</style>

<script type="text/javascript" src="./js/fabri3.js"></script>

</head>

<body>

<?php require_once './core/menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">

<div id="mainmenu">

	<h1>Cronologia</h1>	
	
	<?php
	if (isset($_SESSION['history'])){
		echo '<button id="last_selected" onclick="javascript: return clearData();">Cancella</button>';
	}else {
		echo '<h2>Vuota</h2>';
	}
	?>
			
</div>

<?php
if (isset($_SESSION['history'])){
	
	require_once './core/table_history.php';
}
?>


</div>

<?php require_once './core/footer.php'; ?>

</body>

</html>