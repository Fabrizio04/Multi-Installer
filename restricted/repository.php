<?php

session_start();

?>
<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Multi-Installer</title>

<link rel="shortcut icon" href="../img/favicon.ico" />

<link href="../css/bg.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/style.css">

<script src="../js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/control.js" type="text/javascript"></script>

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

<h1>Impostazioni Repository</h1>

<br>

<h3>Riepilogo:</h3>

<?php

if(file_exists("structure.php")){
	
    require_once 'structure.php';
	
	$c  = new mysqli($host,$usDB,$passDB,$database);
	
	$q = $c->query("SELECT * FROM server");
	$d = $q->fetch_array();
	
	$percorsoWeb = $d['web'];
	$percorsoRep = $d['rep'];
	$lettera = $d['let'];
	$userServer = $d['us'];
	$passServer = $d['psw'];
	
} else {
	header ("Location: ../setup.html");
}
?>

<table>

<tr>
<td>Percorso Web:</td>
<td><?php echo ''.$percorsoWeb.''; ?></td>
</tr>


<tr>
<td width="150">Percorso Repository:</td>
<td><?php echo ''.$percorsoRep.''; ?></td>
</tr>

<tr>
<td>Assegna Lettera:</td>
<td><?php echo ''.$lettera.''; ?></td>
</tr>

<tr>
<td>Username:</td>
<td><?php

if ((strlen($userServer)) == 0){
	echo 'N/D';
} else {
	
	echo ''.$userServer.'';
}

?>
</td>
</tr>

<tr>
<td>Password:</td>
<td><?php

if ((strlen($passServer)) == 0){
	echo 'N/D';
} else {
	
	for ($i=0;$i<(strlen($passServer));$i++){
		echo '*';
	}
}

?>
</td>
</tr>

</table>

<br><br>

<button class="myButton" onclick="javascript: location.href='repEdit.php';">Modifica</button>

</center>

</body>

</html>