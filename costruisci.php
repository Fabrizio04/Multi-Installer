<?php
session_start();
?>
<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Description" content="Multi-Installer è un programma Gratuito e Open Source, che ti permette di installare tanti software su Windows.">
<title>Multi-Installer</title>
 
<link rel="shortcut icon" href="img/favicon.ico" />
  
<link href="./css/bg.css" rel="stylesheet" type="text/css" />
<script src="./js/jquery-1.3.2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="./css/style.css">

<script src="./js/jquery.validate.js" type="text/javascript"></script>
<script src="./js/control.js" type="text/javascript"></script>

<script type="text/javascript">

function pulisci(){
	location.reload();
	return false;
}

</script>

</head>

<body class="html">

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

<h1>Gestione pacchetti</h1>

<br>

<form method="GET" action="add.php" id="costruisci" name="costruisci">
	
<input type="submit" value="Aggiungi" class="myButton" name="Invia"> <button class="myButton" onclick="return pulisci();">Pulisci</button>

<br><br><br>

<table>

<tr>

<td><input type="text" id="nome" name="nome" placeholder="Nome pacchetto" size="30"></td>
<td><input type="text" id="stringa" name="stringa" placeholder="Stringa esecuzione" size="30"></td>
<td><input type="text" id="controllo" name="controllo" placeholder="Stringa controllo" size="30"></td>

</tr>

<tr>

<td><label for="nome" generated="true" class="error"></label></td>
<td><label for="stringa" generated="true" class="error"></label></td>
<td><label for="controllo" generated="true" class="error"></label></td>

</tr>

</table>

</form>

<?php

if(file_exists("./restricted/structure.php")){
	
require_once './restricted/structure.php';

$c  = new mysqli($host,$usDB,$passDB,$database);

$q = $c->query("SELECT * FROM pacchetti ORDER BY nome");

$n = $q->num_rows;

if($n == 0){
	
	echo '<h3>Attualmente non hai nessun pacchetto.</h3>';
	
	
} else {
	
	echo '

<br>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Ricerca pacchetti..." title="Ricerca pacchetti..." autocomplete="off">

</div>

<div class="main" style="width: 50%;" align="center">

<ul id="myUL">';
	
	while($d = $q->fetch_array()){
		
		echo '<li><a href="edit.php?id='.$d['id'].'"><strong>'.$d['nome'].'</strong> &#91;'.$d['stringa'].'&#93; &#91'.$d['controllo1'].'&#93;</li></a>';
	}
	
	echo '</ul>


</div>

';
	
}

	
} else {
	header ("Location: ./websetup");
}

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
		}
	})
})
</script>

</body>
</html>