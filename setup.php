<?php
if(!file_exists('./core/config.inc.php')) header("Location: ./websetup");
require_once './core/config.inc.php';

$c  = new mysqli($host,$usDB,$passDB,$database);

if (isset($_COOKIE['arch'])){
	$arch = $_COOKIE['arch'];
	
} else { $arch = 'auto'; }

if ($arch == "auto"){ $checkA1 = 'checked="checked"'; $styleS4 = "#bfbebe";} else {$checkA1 = ''; $styleS4 = "transparent";}
if ($arch == "32"){ $checkA2 = 'checked="checked"'; $styleS5 = "#bfbebe";} else {$checkA2 = ''; $styleS5 = "transparent";}
if ($arch == "64"){ $checkA3 = 'checked="checked"'; $styleS6 = "#bfbebe";} else {$checkA3 = ''; $styleS6 = "transparent";}

if (isset($_COOKIE['tipo'])){
	$tipo = $_COOKIE['tipo'];
	
} else { $tipo = 'exe'; }

if ($tipo == "bat"){ $check1 = 'checked="checked"'; $style1 = "#bfbebe";} else {$check1 = ''; $style1 = "transparent";}
if ($tipo == "exe"){ $check2 = 'checked="checked"'; $style2 = "#bfbebe";} else {$check2 = ''; $style2 = "transparent";}

?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer - Impostazioni Setup</title>

<?php require_once './core/header.php'; ?>

<style>
td {
	padding: 10px;
}

td:hover {
	cursor:pointer;
}

input[type=radio] {
	display:none;
}

button {
    background-color: #212121;
    color: white;
    padding: 6px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    min-width: 10%;
}

button:hover {
    background-color: #404040;
    color: white;
}

/* */

/* The container */
.container {
  display: inherit;
  position: relative;
  padding-left: 35px;
  margin-bottom: 0px;
  cursor: pointer;
  font-size: 20px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #bfbebe;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

@media only screen and (max-width: 996px) {
	table {
		width: 90%;
	}
	
	.container {
		display: inline;
	}
	
	button {
		width: 90%;
	}
}
</style>

<script>
seleziona = (id) => {
	
	document.getElementById(id).checked = true;
	
	switch(id){
		case 'auto2':
			document.getElementById(4).style.backgroundColor = "#bfbebe";
			document.getElementById(5).style.backgroundColor = "transparent";
			document.getElementById(6).style.backgroundColor = "transparent";
			break;
		case '32':
			document.getElementById(4).style.backgroundColor = "transparent";
			document.getElementById(5).style.backgroundColor = "#bfbebe";
			document.getElementById(6).style.backgroundColor = "transparent";
			break;
		case '64':
			document.getElementById(4).style.backgroundColor = "transparent";
			document.getElementById(5).style.backgroundColor = "transparent";
			document.getElementById(6).style.backgroundColor = "#bfbebe";
			break;
		case 'bat':
			document.getElementById(1).style.backgroundColor = "#bfbebe";
			document.getElementById(2).style.backgroundColor = "transparent";
			break;
		case 'exe':
			document.getElementById(1).style.backgroundColor = "transparent";
			document.getElementById(2).style.backgroundColor = "#bfbebe";
			break;
	}
	
}

seleziona_check = (id,id2) => {
	if(document.getElementById(id).checked == true){
		document.getElementById(id).checked = false;
		document.getElementById(id2).style.backgroundColor = '#eee';
	}
	else {
		document.getElementById(id).checked = true;
		document.getElementById(id2).style.backgroundColor = '#bfbebe';
	}
	
} 
</script>

<script type="text/javascript" src="./js/cookie.js"></script>

</head>

<body>

<?php
require_once './core/form_setup.php';
require_once './core/footer.php';
?>

</body>

</html>