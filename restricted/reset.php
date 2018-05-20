<?php

if (file_exists("structure.php")){
	
    require_once 'structure.php';
	
	$c  = new mysqli($host,$usDB,$passDB,$database);
	
	if (isset($_GET['Invia'])){
		
		$q = $c->query("DROP TABLE pacchetti");
		$q = $c->query("DROP TABLE server");
	
		unlink("./structure.php");
		header("Location: ../setup.html");
	
	} else if(isset($_GET['Invia1'])){
		
		$q = $c->query("TRUNCATE TABLE pacchetti");
		$q = $c->query("OPTIMIZE TABLE pacchetti");
		
		header("Location: ../costruisci.php");
	}

	
} else {
	header("Location: ../setup.html");
}

?>
<!DOCTYPE html>

<html>

<head>
<title>Multi-Installer</title>
<link rel="shortcut icon" href="../img/favicon.ico" />
<link href="../css/bg.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery-1.3.2.min.js" type="text/javascript"></script>

</head>



<body class="html">

<ul class="menu">

      <li title="Impostazioni"><a style="cursor: pointer;" class="menu-button home">menu</a></li>
      <li title="Home"><a href="../" class="archive">archive</a></li>
      <li title="Costruisci"><a href="../costruisci.php" class="pencil">pencil</a></li>
	  <li title="Info"><a href="../info.html" class="about">about</a></li>
   </ul>
    
    <ul class="menu-bar">
        <li><a style="cursor: pointer;" class="menu-button">Impostazioni</a></li>
        <li><a href="./repository.php">Repository</a></li>
        <li><a href="./reset.php">Ripristino</a></li>
    </ul>
	
	
<script src="../js/index.js"></script>

<center>

<h1>Ripristino Database</h1>

<br>

<h3 style="color: red;">ATTENZIONE:</h3>


<h3>Questa operazione canceller&agrave; tutti i dati dei paccheti contenuti nel Database.</h3>

<form action="" method="GET" name="formelimina" onsubmit="return confirm('Sei davvero sicuro di volere proseguire?');">

<input type="submit" value="CONTINUA" class="myButton" name="Invia1">

</form>

<br><br><br><br><br>

<h1>Ripristino Configurazione</h1>

<br>

<h3 style="color: red;">ATTENZIONE:</h3>


<h3>Questa operazione canceller&agrave; tutti i file di configurazione e tutti i dati nel Database.<br>Eseguir&agrave; quindi nuovamente la configurazione iniziale</h3>

<form action="" method="GET" name="formelimina" onsubmit="return confirm('Sei davvero sicuro di volere proseguire?');">

<input type="submit" value="CONTINUA" class="myButton" name="Invia">

</form>

</center>

</body>

</html>