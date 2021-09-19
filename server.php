<?php
if(!file_exists('./core/config.inc.php')) header("Location: ./websetup");
require_once './core/config.inc.php';

$c  = new mysqli($host,$usDB,$passDB,$database);
$q = $c->query("SELECT * FROM server");

$d = $q->fetch_array();

$percorsoWeb = $d['web'];
$repository = $d['rep'];
$lettera = $d['let'];
$username = $d['us'];
$password = $d['psw'];
$log = $d['log'];
$del = $d['del'];

if($log == "off"){
	$check1 = "";
	$color1 = "#eee";
} else {
	$check1 = " checked";
	$color1 = "#bfbebe";
}

if($del == ""){
	$check2 = "";
	$color2 = "#eee";
	$display = "none";
} else {
	$check2 = " checked";
	$color2 = "#bfbebe";
	$display = "";
}
	

?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer - Impostazioni Server</title>

<?php require_once './core/header.php'; ?>

<style>
input[type=text], input[type=url], input[type=password] {
	width: 25%;
    margin-top: 1rem;
    padding: 6px 10px 6px 10px;
    border: 1px solid #ccc;
	text-align: center;
}

input[type=number] {
	text-align: center;
	padding: 6px 10px 6px 10px;
}

#sendForm {
    background-color: #212121;
    color: white;
    padding: 6px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    min-width: 10%;
}

#sendForm:hover {
    background-color: #404040;
    color: white;
}

select {
    width: 25%;
    height: 30px;
    background: #cccccc;
	text-align: center;
}

@media screen and (max-width: 997px) {
	select {
		width: 90%;
	}
	#sendForm {
		width: 90%;
	}
	
	input[type=text], input[type=url], input[type=password], input[type=number] {
		width: 90%;
	}
	
	
	.main {
		top: 60%;
	}
	
	button {
		margin-bottom: 25px;
	}
		
}

/** **/
td {
	padding: 10px;
}

td:hover {
	cursor:pointer;
}

input[type=radio] {
	display:none;
}

/* */

/* The container */
.container {
  display: inherit;
  position: relative;
  padding-left: 35px;
  margin-bottom: 0px;
  cursor: pointer;
  font-size: 13px;
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
  height: 18px;
  width: 18px;
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
  left: 6px;
  top: 4px;
  width: 3px;
  height: 5px;
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
}
</style>

<script>

seleziona_check = (id,id2) => {
	if(document.getElementById(id).checked == true){
		document.getElementById(id).checked = false;
		document.getElementById(id2).style.backgroundColor = '#eee';
	}
	else {
		document.getElementById(id).checked = true;
		document.getElementById(id2).style.backgroundColor = '#bfbebe';
	}
	
	if(id == "spul"){
		if(document.getElementById("ggdel").style.display == "none")
			document.getElementById("ggdel").style.display = "";
		else
			document.getElementById("ggdel").style.display = "none";
	}
	
} 
</script>

</head>

<body>

<?php
require_once './core/form_server.php';
require_once './core/footer.php';
?>

</body>

</html>