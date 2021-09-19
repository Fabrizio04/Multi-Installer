<?php

if(isset($_SERVER['HTTPS'])) {
    if ($_SERVER['HTTPS'] == "on") {
        $percorso = "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    }
} else {
	$percorso = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}

$npercorso = str_replace("websetup/", "", $percorso);

if(file_exists("../core/config.inc.php")){
	header("Location: ../");
}

?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>
<title>Multi-Installer - Web Setup</title>

<link rel="stylesheet" href="../css/scroll.css">
<link rel="stylesheet" href="./style.css">

</head>

<body>


<div class="main">

<form method="POST" id="formsetup" name="formsetup">

<h3>Server</h3>

<input type="url" id="percorsoWeb" name="percorsoWeb" placeholder="URL Web App - Esempio: http://192.168.1.75/installer/" size="30" value="<?php echo $npercorso; ?>" required>
<input type="text" id="percorsoRep" name="percorsoRep" placeholder="Share File Path - Esempio: \\192.168.1.75\files" size="30" pattern="[\\]+[\\]+[a-z0-9\.]+\\[a-z0-9.-]+" required><br>

<br>
<select name="lettera" id="lettera" required>
  <option value selected="selected" disabled>Assegna lettera</option>
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
<br>
<input type="text" id="userServer" name="userServer" placeholder="Username Share" size="30">
<input type="password" id="passServer" name="passServer" placeholder="Password Share" size="30">


<br><br><h3>Database</h3>

<input type="text" id="host" name="host" placeholder="Hostname / IP" size="30" required>
<input type="text" id="database" name="database" placeholder="Nome DB" size="30" required>
<br><br>
<select name="motore" id="motore" required>
  <option value selected="selected" disabled>Seleziona Engine</option>
  <option value="InnoDB">InnoDB</option>
  <option value="MyISAM">MyISAM</option>
  <option value="Aria">Aria</option>
  <option value="MRG_MYISAM">MRG_MYISAM</option>
  <option value="CSV">CSV</option>
</select>

<br>

<input type="text" id="usDB" name="usDB" placeholder="Username" size="30" required>
<input type="password" id="passDB" name="passDB" placeholder="Password" size="30">

<br><br>

<button id="sendForm" type="submit" class="btn btn-form btn-info">Conferma</button>

</form>

<script src="./index.js"></script>

</div>

</body>

</html>