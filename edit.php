<?php

session_start();

if(file_exists("./restricted/structure.php")){
	
    require_once './restricted/structure.php';
	
	$c  = new mysqli($host,$usDB,$passDB,$database);
	
	if (isset($_GET['id'])){
		
		$id = $_GET['id'];
		
		$q = $c->query("SELECT * FROM pacchetti WHERE id='$id'");
		
		$n = $q->num_rows;
		
		if ($n == 0) {
			header ("Location: costruisci.php");
		} else {
			
			$d = $q->fetch_array();
			
			$nome1 = htmlentities($d['nome']);
			$stringa1 = htmlentities($d['stringa']);
			$controllo1 = htmlentities($d['controllo1']);
			
			//echo $controllo1;
			
			$form = '	
<button class="myButton" onclick="return annulla();">Annulla</button>
<button class="myButton2" onclick="elimina();">Elimina</button>

<form method="POST" action="update.php?id='.$d['id'].'" id="costruisci" name="costruisci">

<br><br>

<table>

<tr>

<td><input type="text" id="nome" name="nome" placeholder="Nome pacchetto" size="30" value="'.$nome1.'"></td>
<td><input type="text" id="stringa" name="stringa" placeholder="Stringa esecuzione" size="30" value="'.$stringa1.'"></td>
<td><input type="text" id="controllo" name="controllo" placeholder="Stringa controllo" size="30" value="'.$controllo1.'"></td>

</tr>

<tr>

<td><label for="nome" generated="true" class="error"></label></td>
<td><label for="stringa" generated="true" class="error"></label></td>
<td><label for="controllo" generated="true" class="error"></label></td>

</tr>

</table>

<br><br>

<input type="submit" value="Aggiorna" class="myButton" name="Invia">

</form>';
			
		}
		
	} else {
		header ("Location: costruisci.php");
	}

} else {
	header ("Location: setup.html");
}
?>
<!DOCTYPE html>

<html>

<head>
<title>Multi-Installer</title>

<link rel="shortcut icon" href="img/favicon.ico" />

<link href="./css/bg.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="./css/style.css">

<script src="./js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="./js/jquery.validate.js" type="text/javascript"></script>
<script src="./js/control.js" type="text/javascript"></script>
</head>

<script type="text/javascript">

function annulla(){
	
	history.go(-1);
	return false;
	
}

function elimina(){
	
	var a = confirm('ATTENZIONE: vuoi davvero cancellare il pacchetto <?php echo $d['nome']; ?> ?');
	
	if (a === true){
		
		location.href='remove.php?id=<?php echo $d['id']; ?>';
		
	}
	
}

</script>

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

<h1><?php echo $d['nome']; ?></h1>

<br>

<?php echo $form; ?>

</center>

</body>

</html>