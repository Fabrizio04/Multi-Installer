<?php session_start(); ?>
<!Doctype html>

<html>

<head>
<title>Multi-Installer</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="img/favicon.ico" />

<link href="./css/bg.css" rel="stylesheet" type="text/css" />
<script src="./js/jquery-1.3.2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/style.css">

<script type="text/javascript">

function download(){
	window.location.href='setup/<?php if(isset($_SESSION['filename'])){ echo $_SESSION['filename'];}else{echo '#noFile';} ?>';
}

</script>

</head>

<body class="html">

<ul class="menu">

      <li title="Impostazioni"><a style="cursor: pointer;"class="menu-button home">menu</a></li>
      <li title="Home"><a href="./" class="archive">archive</a></li>
      <li title="Costruisci"><a href="./costruisci.php" class="pencil">pencil</a></li>
	  <li title="Info"><a href="./info.html" class="about">about</a></li>
   </ul>
    
    <ul class="menu-bar">
        <li><a style="cursor: pointer;" class="menu-button">Impostazioni</a></li>
        <li><a href="./restricted/repository.php">Repository</a></li>
        <li><a href="./restricted/reset.php">Ripristino</a></li>
    </ul>
	
	
<script src="js/index.js"></script>

<center>

<?php
if(isset($_SESSION['programs'])){

$g = $_SESSION['programs'];

$dato = str_replace("_", " ", $g);
 
$nuovo = explode(";", $dato);

echo '<br><br><br><button class="myButton" onclick="download()">SCARICA E AVVIA IL SETUP</button>

<br><br><br><button class="myButton3" onclick="javascript: location.href=\'./\';">HOME</button>

<h1>Riepilogo programmi selezionati:</h1>';


foreach($nuovo as $key => $value){

echo '<strong>'.$value.'</strong><br>';

}

}else {
	header("Location: ./");
}

?>
</center>

</body>

</html>