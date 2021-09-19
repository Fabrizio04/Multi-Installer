<?php require_once './core/config.inc.php'; ?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer - Contatti</title>

<?php require_once './core/header.php'; ?>

<style>
.socialmedia a {
	display: inline-block;
	width: 60px;
	height: 60px;
	color: #bfbebe;
	background-color: #333;
	line-height: 60px;
	border-radius: 50%;
	margin: 0 6px;
	font-size: 40px;
	transition: .3s linear;
	
}

.socialmedia #yt:hover{
	background-color: #ff0000;
	color: white;
}

.socialmedia #lnk:hover{
	background-color: #0274b3;
	color: white;
}

.socialmedia #git:hover{
	background-color: #f3f2f2;
	color: #333;
}
/*
.fa-fabri {
	font-size:50px;
}
.fa-fabri:hover {
	color: #404040;
}
.fa-youtube {
	color: #ff0000;
}

.fa-linkedin {
	color: #0274b3;
}

.fa-github2 {
	color: black;
}*/
</style>

</head>

<body>

<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<?php require_once './core/menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">

<h1>Multi-Installer</h1>
<h2>Realizzato da Fabrizio Amorelli</h2>
<h2>Versione: 3.0</h2>

<h3>Multi-Installer è un prodotto italiano, Gratuito e Open Source</h3>

<h2><a href="mailto:postmaster@multi-installer.it">postmaster@multi-installer.it</a></h2>

<div class="socialmedia">
<a href="https://www.youtube.com/c/FabriTutorial" target="_blank" title="YouTube" id="yt"><span class="fa fa-youtube fa-fabri"></span></a>
<a href="https://www.linkedin.com/in/fabrizio-amorelli/" target="_blank" title="LinkedIn" id="lnk"><span class="fa fa-linkedin fa-fabri"></a>
<a href="https://github.com/Fabrizio04" target="_blank" title="GitHub" id="git"><span class="fa fa-github fa-fabri fa-github2"></a>
</div>

<br>

<a href="https://multi-installer.it/donazione.php" title="Donazione PayPal" alt="Donazione" target="_blank"><img src="./img/PayPal.png"></a>

<br><br>
<em class="slogan">"Prosegui sempre, non mollare Mai".</em>

<h3><strong>&copy;</strong> 2018-<?php echo date("Y"); ?> Multi-Installer.it</h3>

</div>

<?php require_once './core/footer.php'; ?>

</body>

</html>