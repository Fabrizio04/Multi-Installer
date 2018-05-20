<!Doctype html>
<html>
 
<head>
<title>Multi-Installer</title>

<link rel="shortcut icon" href="img/favicon.ico" />

<link href="./css/bg.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function download(){
	
	<?php
	$stringa = $_GET['html'];
	echo "window.location.href=\"export.php?html=$stringa\";";
	?>
	
}
</script>

</head>
 
<body class="html">

<center>

<h1>Installazione conclusa</h1>

<?php
 
if(isset($_GET['html'])){
 
$g = $_GET['html'];
$dato = str_replace("_", " ", $g);
 
 
$nuovo = explode(";", $dato);
 
foreach($nuovo as $key => $value){
 
echo ''.$value.'<br>';
 
}
 
}
 
?>

<br>
<button class="myButton" onclick="download()">SCARICA REPORT</button>

<br><br>
<button class="myButton3" onclick="javascript: location.href='./'">Home</button>


</center>

</body>
 
</html>