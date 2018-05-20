<?php

session_start();

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
<!DOCTYPE html>

<html>

<head>
<title>Multi-Installer</title>
<link rel="shortcut icon" href="../img/favicon.ico" />
<link href="../css/bg.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/style.css">

<script src="../js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/control.js" type="text/javascript"></script>
</head>

<script type="text/javascript">

function annulla(){
	
	history.go(-1);
	return false;
	
}

</script>

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

<h1>Modifica Repository</h1>

<br>

<?php

if (isset($_POST['Invia'])){
	
	$percorsoWeb = $_POST['percorsoWeb'];
	$percorsoRep = $_POST['percorsoRep'];
	$lettera = $_POST['lettera'];
	$userServer = $_POST['userServer'];
	$passServer = $_POST['passServer'];
	
	$web1 = $c->real_escape_string($percorsoWeb);
	$rep1 = $c->real_escape_string($percorsoRep);
	$us1 = $c->real_escape_string($userServer);
	$psw1 = $c->real_escape_string($passServer);
	
	
	if ((($passServer == "") || ($userServer == "")) || (($passServer == "") && ($userServer == ""))){
		
		$qs = $c->query("TRUNCATE TABLE server");
		$qs = $c->query('INSERT INTO server (web, rep, let) VALUES ("'.$web1.'","'.$rep1.'","'.$lettera.'");');
		
	} else {
		
		$qs = $c->query("TRUNCATE TABLE server");
		$qs = $c->query('INSERT INTO server (web, rep, let, us, psw) VALUES ("'.$web1.'","'.$rep1.'","'.$lettera.'","'.$us1.'","'.$psw1.'");');
		
	}
	
	header("refresh:2;url=repository.php");	
	echo '<h3 style="color: green;">Modifica Completata</h3>';
	
	
	
} else {
	
	$selected1 = '';
	$selected2 = '';
	$selected3 = '';
	$selected4 = '';
	$selected5 = '';
	$selected6 = '';
	$selected7 = '';
	$selected8 = '';
	$selected9 = '';
	$selected10 = '';
	$selected11 = '';
	$selected12 = '';
	$selected13 = '';
	$selected14 = '';
	$selected15 = '';
	$selected16 = '';
	$selected17 = '';
	$selected18 = '';
	$selected19 = '';
	$selected20 = '';
	$selected21 = '';
	$selected22 = '';
	$selected23 = '';
	
	
	if ($lettera == "Z"){ $selected1 = 'selected="selected"'; }
	if ($lettera == "Y"){ $selected2 = 'selected="selected"'; }
	if ($lettera == "X"){ $selected3 = 'selected="selected"'; }
	if ($lettera == "W"){ $selected4 = 'selected="selected"'; }
	if ($lettera == "V"){ $selected5 = 'selected="selected"'; }
	if ($lettera == "U"){ $selected6 = 'selected="selected"'; }
	if ($lettera == "S"){ $selected7 = 'selected="selected"'; }
	if ($lettera == "R"){ $selected8 = 'selected="selected"'; }
	if ($lettera == "Q"){ $selected9 = 'selected="selected"'; }
	if ($lettera == "P"){ $selected10 = 'selected="selected"'; }
	if ($lettera == "O"){ $selected11 = 'selected="selected"'; }
	if ($lettera == "N"){ $selected12 = 'selected="selected"'; }
	if ($lettera == "M"){ $selected13 = 'selected="selected"'; }
	if ($lettera == "L"){ $selected14 = 'selected="selected"'; }
	if ($lettera == "K"){ $selected15 = 'selected="selected"'; }
	if ($lettera == "J"){ $selected16 = 'selected="selected"'; }
	if ($lettera == "I"){ $selected17 = 'selected="selected"'; }
	if ($lettera == "H"){ $selected18 = 'selected="selected"'; }
	if ($lettera == "G"){ $selected19 = 'selected="selected"'; }
	if ($lettera == "F"){ $selected20 = 'selected="selected"'; }
	if ($lettera == "E"){ $selected21 = 'selected="selected"'; }
	if ($lettera == "B"){ $selected22 = 'selected="selected"'; }
	if ($lettera == "A"){ $selected23 = 'selected="selected"'; }
	
	echo '<form action="" method="POST" id="formsetup" name="formsetup">

<h3>Parametri Server</h3>

<table>

<tr>
<td>Percorso Web:</td>
<td><input type="text" id="percorsoWeb" name="percorsoWeb" placeholder="Esempio: http://192.168.1.75/installer/" size="30" value="'.htmlentities($percorsoWeb).'"></td>
<td width="140"><label for="percorsoWeb" generated="true" class="error"></label></td>
</tr>


<tr>
<td width="150">Percorso Repository:</td>
<td><input type="text" id="percorsoRep" name="percorsoRep" placeholder="Esempio: \\192.168.1.75\files" size="30" value="'.htmlentities($percorsoRep).'"></td>
<td><label for="percorsoRep" generated="true" class="error"></label></td>
</tr>

<tr>
<td>Assegna Lettera:</td>

<td>
<select name="lettera">
  <option value>Seleziona</option>
  <option value="Z" '.$selected1.'>Z:</option>
  <option value="Y" '.$selected2.'>Y:</option>
  <option value="X" '.$selected3.'>X:</option>
  <option value="W" '.$selected4.'>W:</option>
  <option value="V" '.$selected5.'>V:</option>
  <option value="U" '.$selected6.'>T:</option>
  <option value="S" '.$selected7.'>S:</option>
  <option value="R" '.$selected8.'>R:</option>
  <option value="Q" '.$selected9.'>Q:</option>
  <option value="P" '.$selected10.'>P:</option>
  <option value="O" '.$selected11.'>O:</option>
  <option value="N" '.$selected12.'>N:</option>
  <option value="M" '.$selected13.'>M:</option>
  <option value="L" '.$selected14.'>L:</option>
  <option value="K" '.$selected15.'>K:</option>
  <option value="J" '.$selected16.'>J:</option>
  <option value="I" '.$selected17.'>I:</option>
  <option value="H" '.$selected18.'>H:</option>
  <option value="G" '.$selected19.'>G:</option>
  <option value="F" '.$selected20.'>F:</option>
  <option value="E" '.$selected21.'>E:</option>
  <option value="B" '.$selected22.'>B:</option>
  <option value="A" '.$selected23.'>A:</option>
  </select>
</td>

<td><label for="lettera" generated="true" class="error"></label></td>

</tr>

<tr>
<td>Username:</td>
<td><input type="text" id="userServer" name="userServer" placeholder="" size="30" value="'.htmlentities($userServer).'"></td>
<td><label for="userServer" generated="true" class="error"></label></td>
</tr>

<tr>
<td>Password:</td>
<td><input type="password" id="passServer" name="passServer" placeholder="" size="30" value="'.htmlentities($passServer).'"></td>
<td><label for="passServer" generated="true" class="error"></label></td>
</tr>

</table>

<br><br>

<input type="submit" value="Aggiorna" class="myButton" name="Invia">

</form>

<br>

<button class="myButton" onclick="javascript: return annulla();">Annula</button>';
	
}

?>

</center>

</body>

</html>