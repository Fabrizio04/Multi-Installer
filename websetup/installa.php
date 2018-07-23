<?php
session_start();

if(isset($_SESSION['percorsoWeb'])){

$percorsoWeb = $_SESSION['percorsoWeb'];
$percorsoRep = $_SESSION['percorsoRep'];
$lettera = $_SESSION['lettera'];
$userServer = $_SESSION['userServer'];
$passServer = $_SESSION['passServer'];

$host = $_SESSION['host'];
$usDB = $_SESSION['usDB'];
$passDB = $_SESSION['passDB'];
$database = $_SESSION['database'];
$motore = $_SESSION['motore'];

@$c  = new mysqli($host,$usDB,$passDB,$database);

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



<?php



if ($c->connect_errno) {
	
    echo "<h1>Errore</h1>Failed to connect to MySQL: (" . $c->connect_errno . ") " . $c->connect_error;
	
	echo '<br><br><br>
	<button class="myButton" onclick="javascript: history.go(-2);">INDIETRO</button>';
	
} else {
	
	$q = $c->query("
	
CREATE TABLE IF NOT EXISTS server (
  web varchar(100) NOT NULL,
  rep varchar(100) NOT NULL,
  let varchar(1) NOT NULL,
  us varchar(100) NOT NULL,
  psw varchar(100) NOT NULL
) ENGINE=$motore DEFAULT CHARSET=latin1;

");

$q = $c->query("
	
CREATE TABLE IF NOT EXISTS pacchetti (
  id int(11) NOT NULL,
  nome varchar(100) NOT NULL,
  stringa text NOT NULL,
  controllo1 text NOT NULL
) ENGINE=$motore DEFAULT CHARSET=latin1;

");

$q = $c->query("
	
ALTER TABLE pacchetti
ADD PRIMARY KEY (id);

");

$q = $c->query("
	
ALTER TABLE pacchetti
MODIFY id int(11) NOT NULL AUTO_INCREMENT;

");


$rep1 = $c->real_escape_string($percorsoRep);
$web1 = $c->real_escape_string($percorsoWeb);
$user1 = $c->real_escape_string($userServer);
$psw1 = $c->real_escape_string($passServer);
	
	if ((($passServer == "") || ($userServer == "")) || (($passServer == "") && ($userServer == ""))){
		
		$qs = $c->query('INSERT INTO server (web, rep, let) VALUES ("'.$web1.'","'.$rep1.'","'.$lettera.'");');
	} else {
		$qs = $c->query('INSERT INTO server (web, rep, let, us, psw) VALUES ("'.$web1.'","'.$rep1.'","'.$lettera.'","'.$user1.'","'.$psw1.'");');
	}
	


$fp = fopen("../restricted/structure.php", 'a');

$linea_structure = "";

$linea_structure = "<?php";
	
$linea_structure .= '
$host = "'.$_SESSION['host'].'";
$usDB = "'.$_SESSION['usDB'].'";
$passDB = "'.$_SESSION['passDB'].'";
$database = "'.$_SESSION['database'].'";
$motore = "'.$_SESSION['motore'].'";
';


if (fwrite($fp, $linea_structure) === FALSE) {
        echo "ERRORE";
        //exit;
} else {
	header ("Location: fine.html");
}

}

} else {
	header ("Location: ./");	
}


session_destroy();

?>

</center>

</body>

</html>