<?php require_once './core/config.inc.php'; ?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer - Pack</title>

<?php require_once './core/header.php'; ?>
<link rel="stylesheet" href="css/select.css">
<script type="text/javascript" src="js/support.js"></script>

<style>

.myProgr {
	width: 90%;
	margin: 0 auto;
}

@media only screen and (min-width:997px){
	.myProgr {
		width: 35%;
		margin: 0 auto;

	}

}
</style>

<script type="text/javascript" src="./js/pack.js"></script>



</head>

<body>

<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<?php require_once './core/menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">

<h1>Pack</h1>

<br>

<select id="pack" onchange="closeAll()">
    <option value="">&nbsp;</option>
	<?php
	$c  = new mysqli($host,$usDB,$passDB,$database);
	$q = $c->query("SELECT * FROM pack ORDER BY nome");
	while($d = $q->fetch_array()){
		echo '<option value="'.$d["id"].'">'.$d["nome"].'</option>';
	}
	?>
</select>

<br><br>

<div class="row">
	<button id="last_selected" class="myButton" onclick="download()">Download</button>
	<button id="last_selected" class="myButton" onclick="mostra()">Modifica</button>
	<button id="last_selected" class="myButton" onclick="info()">Info</button>
	<a rel="modal:open" href="#ess" id="link1"></a>
</div>

<br>

<div class="lds-spinner" id="load_gif" style="margin-top:20px;display:none;">
	<div></div><div></div><div></div><div></div><div></div><div></div>
	<div></div><div></div><div></div><div></div><div></div><div></div>
</div>

<?php require_once './core/form_pack.php'; ?>

</div>

<?php require_once './core/footer.php'; ?>
<?php require_once './core/popup_pack.php'; ?>

</body>

</html>