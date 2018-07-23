<?php
session_start();


if (isset($_POST['Invia'])){
	
$percorsoWeb = $_POST['percorsoWeb'];
$percorsoRep = $_POST['percorsoRep'];
$lettera = $_POST['lettera'];
$userServer = $_POST['userServer'];
$passServer = $_POST['passServer'];

$host = $_POST['host'];
$usDB = $_POST['usDB'];
$passDB = $_POST['passDB'];
$database = $_POST['database'];
$motore = $_POST['motore'];

?>

<!DOCTYPE html>

<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Description" content="Multi-Installer è un programma Gratuito e Open Source, che ti permette di installare tanti software su Windows.">
<title>Multi-Installer</title>
<link rel="shortcut icon" href="../img/favicon.ico" />
<link href="../css/bg.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/control.js" type="text/javascript"></script>
</head>

<body class="html">

<center>

<h1>Riepilogo</h1>

<br>

<h3>Parametri Server</h3>

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

<br>

<h3>Parametri Database</h3>

<table>

<tr>
<td>Host:</td>
<td><?php echo ''.$host.''; ?></td>
</tr>


<tr>
<td width="150">Username:</td>
<td><?php echo ''.$usDB.''; ?></td>
</tr>

<tr>
<td>Password:</td>
<td><?php

if ((strlen($passDB)) == 0){
	echo 'N/D';
} else {
	
	for ($i=0;$i<(strlen($passDB));$i++){
		echo '*';
	}
}

?>
</td>
</tr>

<tr>
<td>Database:</td>
<td><?php echo ''.$database.''; ?></td>
</tr>

<tr>
<td>Motore:</td>
<td><?php echo ''.$motore.''; ?></td>
</tr>

</table>

<br><br>

<?php
$_SESSION['percorsoWeb'] = $percorsoWeb;
$_SESSION['percorsoRep'] = $percorsoRep;
$_SESSION['lettera'] = $lettera;
$_SESSION['userServer'] = $userServer;
$_SESSION['passServer'] = $passServer;

$_SESSION['host'] = $host;
$_SESSION['usDB'] = $usDB;
$_SESSION['passDB'] = $passDB;
$_SESSION['database'] = $database;
$_SESSION['motore'] = $motore;
?>

<button class="myButton" onclick="javascript: history.go(-1);">INDIETRO</button>
<button class="myButton" onclick="javascript: location.href='installa.php';">FINE</button>

</center>

</body>

</html>

<?php
} else {
	header ("Location: ./");	
}