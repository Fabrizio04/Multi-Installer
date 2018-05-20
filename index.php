<?php
session_start();
?>
<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Multi-Installer</title>
 
<link rel="shortcut icon" href="img/favicon.ico" />
  
<link href="./css/bg.css" rel="stylesheet" type="text/css" />
<script src="./js/jquery-1.3.2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="./css/style.css">

<script type="text/javascript">

function spunta(param){

	var a = document.getElementById( param ).checked;
	
	if (a == false){
		document.getElementById( param ).checked = true;
	} else {
		document.getElementById( param ).checked = false;
	}

}

function pulisci(){
	location.reload();
	return false;
}

function clenALL(){
	
	//document.getElementById( 'uac' ).checked = true;
	//document.getElementById( 'connect' ).checked = true;
	
	<?php
	
	if(file_exists("./restricted/structure.php")){
	
    require_once './restricted/structure.php';
		
	$c  = new mysqli($host,$usDB,$passDB,$database);

	$q = $c->query("SELECT * FROM pacchetti");
	
	while($d = $q->fetch_array()){
		echo 'document.getElementById("'.$d['id'].'").checked = false;';
	}
	
	}
	?>
	
}

function ultimo(){
	location.href='download.php';
	return false;
}
</script>

</head>

<body class="html" onload="clenALL()">

<ul class="menu">

      <li title="Impostazioni"><a style="cursor: pointer;" class="menu-button home">menu</a></li>
      <li title="Home"><a href="./" class="archive">archive</a></li>
      <li title="Costruisci"><a href="./costruisci.php" class="pencil">pencil</a></li>
	  <li title="Info"><a href="info.html" class="about">about</a></li>
   </ul>
    
    <ul class="menu-bar">
        <li><a style="cursor: pointer;" class="menu-button">Impostazioni</a></li>
        <li><a href="./restricted/repository.php">Repository</a></li>
        <li><a href="./restricted/reset.php">Ripristino</a></li>
    </ul>
	
	
<script src="js/index.js"></script>

<center>

<div class="navbar">

<h1>Multi-Installer</h1>

<br>

<?php

if(file_exists("./restricted/structure.php")){
	
require_once './restricted/structure.php';

$c  = new mysqli($host,$usDB,$passDB,$database);

$q = $c->query("SELECT * FROM pacchetti ORDER BY nome");

$n = $q->num_rows;

if($n == 0){
	
	echo '<h3>Attualmente non hai nessun pacchetto.</h3>';
	
	echo '<button class="myButton" onclick="javascript: location.href=\'costruisci.php\';">Costruisci</button>';
	
	
} else {
	
	if (isset($_SESSION['filename'])){ $ultimo = '<button class="myButton" onclick="javascript: return ultimo();">Ultimo Setup</button>'; }else{ $ultimo = ""; }
	
	echo '<form method="GET" action="execute.php" id="spunta" name="spunta">

<input type="submit" value="Download" class="myButton" name="Invia"> <button class="myButton" onclick="return pulisci();">Pulisci</button> '.$ultimo.'
<br>


<br>

<table style="text-align: center;">

<tr>
<td>Controllo UAC <input type="checkbox" id="uac" name="uac" checked="checked"></td>
</tr>

<tr>
<td>Connessione automatica <input type="checkbox" id="connect" name="connect" checked="checked"></td>
</tr>

<tr>
<td><input type="radio" name="tipo" value="bat" checked="checked"> .bat <input type="radio" name="tipo" value="exe"> .exe</td>
</tr>

</table>
<br>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Ricerca pacchetti..." title="Ricerca pacchetti..." autocomplete="off">

</div>

<div class="main" style="width: 50%;" align="center">

<ul id="myUL">';
	
	while($d = $q->fetch_array()){
		//echo $d['nome'];
		//echo '<li><a href="javascript: spunta(\''.$d['id'].'\');"><strong>'.$d['nome'].'</strong> <input type="checkbox" style="cursor: pointer;" id="'.$d['id'].'" name="nomeVar[]" value="'.$d['id'].'"></li></a>';
		echo '<li><a href="javascript: spunta(\''.$d['id'].'\');"><strong>'.$d['nome'].'</strong> <input type="checkbox" style="cursor: pointer;" id="'.$d['id'].'" name="nomeVar[]" value="'.$d['id'].'"></li></a>';
	}
	
	echo '</ul>


</div>

</form>';
	
}

	
} else {
	header ("Location: setup.html");	
}//style="text-align:center; valign: middle;"

?>

<script>
function myFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
		
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>

</center>

<br><br>

<a href="#top" class="UP" id="f_up" style="display: none;"><img src="./img/freccia.png" width="125px" height="120px"></a><!-- http://i.imgur.com/2qXWm.png -->

<script type="text/javascript">
$(document).ready(function(){
	$(function(){
		if(navigator.appVersion.indexOf("MSIE ")!=-1) $('#f_up').fadeIn();
		else
		{
			var statusF='out';
			$(window).scroll(function()
			{
				if(statusF!='in' && $(this).scrollTop()>25){statusF='in'; $('#f_up').fadeIn()}
				else if(statusF!='out' && $(this).scrollTop()<25){statusF='out'; $('#f_up').fadeOut()}
			});
		}		//$('.UP').click(function(){ $('body,html').animate({scrollTop:0},600); return false})
	})
})
</script>

</body>
</html>