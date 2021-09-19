<?php
if(!file_exists('./core/config.inc.php')) header("Location: ./websetup");
require_once './core/config.inc.php';

if(isset($_GET['id'])){
	$nomefile = calcolaNome($_GET['id']);
	require_once './core/ForceDownload.class.php';
	
	$download = New ForceDownload("setup/", $nomefile);
	$download->download() or die ($download->get_error());
	exit;
	
} else if(isset($_SESSION['filename'])){
	
	$g = $_SESSION['programs'];
	$dato = str_replace("_", " ", $g);
	$nuovo = explode(";", $dato);
	
} else header("Location: ./");


if(isset($_SERVER['HTTPS'])) {
    if ($_SERVER['HTTPS'] == "on") {
        $percorso = "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    }
} else {
	$percorso = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}

?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer</title>

<?php require_once './core/header.php'; ?>
<?php require_once './core/header_download.php'; ?>

</head>

<body>

<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<?php require_once './core/menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">

<div class="tooltip2">
<h1 class="tit" onclick="copy2('myInput','myTooltip2')" onmouseout="outFunc2('myTooltip2')"><?php echo calcolaNome($_SESSION['filename']);?></h1>
<span class="tooltiptext2" id="myTooltip2">Copia URL negli appunti</span>
<input type="text" id="myInput" value="<?php echo $percorso; ?>?id=<?php echo $_SESSION['filename']; ?>" style="display:none;">
</div>

<br><br>

<p>Il file richiesto, verrà mantenuto<span id="resp"> sul server per 7 giorni.</span><span id="resp"></span><br>Potrebbe essere necessario,<span id="resp"></span> disabilitare temporaneamente l'Anti-Virus</p>

<div class="row">
<button onclick="download('<?php echo $_SESSION['filename']; ?>')" id="last_selected">SCARICA E AVVIA IL SETUP</button>
</div>

<p>
<span>Puoi ritrovare i tuoi download disponibili,</span>
<span id="resp"> su <a href="history.php">Impostazioni / Cronologia</a></span>
</p>


<br>
<h1 class="tit">Riepilogo programmi selezionati</h1>

<p>
<?php
foreach($nuovo as $key => $value){
	echo ''.$value.'<br>';
}
?>
<p>

</div>

<?php require_once './core/footer.php'; ?>

</body>

</html>