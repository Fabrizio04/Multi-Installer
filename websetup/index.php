<?php
$percorso = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$npercorso = str_replace("websetup/", "", $percorso);

if(file_exists("../restricted/structure.php")){
	header("Location: ../");
}

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

<h1>Setup Multi-Installer</h1>

<br>

<form action="setup.php" method="POST" id="formsetup" name="formsetup">

<h3>Parametri Server</h3>

<table>

<tr>
<td>Percorso Web:</td>
<td><input type="text" id="percorsoWeb" name="percorsoWeb" placeholder="Esempio: http://192.168.1.75/installer/" size="30" value="<?php echo $npercorso; ?>"></td>
<td width="140"><label for="percorsoWeb" generated="true" class="error"></label></td>
</tr>


<tr>
<td width="150">Percorso Repository:</td>
<td><input type="text" id="percorsoRep" name="percorsoRep" placeholder="Esempio: \\192.168.1.75\files" size="30"></td>
<td><label for="percorsoRep" generated="true" class="error"></label></td>
</tr>

<tr>
<td>Assegna Lettera:</td>

<td>
<select name="lettera">
  <option value selected="selected">Seleziona</option>
  <option value="Z">Z:</option>
  <option value="Y">Y:</option>
  <option value="X">X:</option>
  <option value="W">W:</option>
  <option value="V">V:</option>
  <option value="U">T:</option>
  <option value="S">S:</option>
  <option value="R">R:</option>
  <option value="Q">Q:</option>
  <option value="P">P:</option>
  <option value="O">O:</option>
  <option value="N">N:</option>
  <option value="M">M:</option>
  <option value="L">L:</option>
  <option value="K">K:</option>
  <option value="J">J:</option>
  <option value="I">I:</option>
  <option value="H">H:</option>
  <option value="G">G:</option>
  <option value="F">F:</option>
  <option value="E">E:</option>
  <option value="B">B:</option>
  <option value="A">A:</option>
  </select>
</td>

<td><label for="lettera" generated="true" class="error"></label></td>

</tr>

<tr>
<td>Username:</td>
<td><input type="text" id="userServer" name="userServer" placeholder="" size="30"></td>
<td><label for="userServer" generated="true" class="error"></label></td>
</tr>

<tr>
<td>Password:</td>
<td><input type="password" id="passServer" name="passServer" placeholder="" size="30"></td>
<td><label for="passServer" generated="true" class="error"></label></td>
</tr>

</table>

<br>

<h3>Parametri Database</h3>

<table>

<tr>
<td>Host:</td>
<td><input type="text" id="host" name="host" placeholder="Esempio: localhost" size="30"></td>
<td width="140"><label for="host" generated="true" class="error"></label></td>
</tr>


<tr>
<td width="150">Username:</td>
<td><input type="text" id="usDB" name="usDB" placeholder="Esempio: root" size="30"></td>
<td><label for="usDB" generated="true" class="error"></label></td>
</tr>

<tr>
<td>Password:</td>
<td><input type="password" id="passDB" name="passDB" placeholder="" size="30"></td>
<td><label for="passDB" generated="true" class="error"></label></td>
</tr>

<tr>
<td width="150">Database:</td>
<td><input type="text" id="database" name="database" placeholder="" size="30"></td>
<td><label for="database" generated="true" class="error"></label></td>
</tr>

<tr>
<td>Motore:</td>

<td>
<select name="motore">
  <option value selected="selected">Seleziona</option>
  <option value="InnoDB">InnoDB</option>
  <option value="ARCHIVE">ARCHIVE</option>
  <option value="MEMORY">MEMORY</option>
  <option value="CSV">CSV</option>
  <option value="BLACKHOLE">BLACKHOLE</option>
  <option value="MyISAM">MyISAM</option>
  <option value="MRG_MYISAM">MRG_MYISAM</option>
  </select>
</td>

<td><label for="motore" generated="true" class="error"></label></td>

</tr>

</table>

<br><br>

<input type="submit" value="CONTINUA" class="myButton" name="Invia">

</form>

</center>

</body>

</html>