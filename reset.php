<?php
if(!file_exists('./core/config.inc.php')) header("Location: ./websetup");
require_once './core/config.inc.php';
?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer - Impostazioni Ripristino</title>

<?php require_once './core/header.php'; ?>

<style>
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

@media screen and (max-width: 997px) {
	button {
		width: 90%;
	}
}
</style>

<script>

reset = (id) => {
	const conf = window.confirm("Attezione!\nAvviare la procedura di ripristino?\nQuesta operazione è irreversibile");
	
	if(conf == true){
		
		const a = document.querySelectorAll("button");
		a[0].disabled = true;
		a[1].disabled = true;
		
		fetch('./post_reset.php?id='+id).then(response => response.json())
		.then(data => {
			if(data["result"] == "ok"){
				
				if(id == 1){
					document.getElementById('messaggio').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					a[0].disabled = false;
					a[1].disabled = false;
				} else {
					document.getElementById('messaggio').innerHTML = 'Operazione completata!<br>Reindirizzamento al Web Setup...';
					setTimeout(() => {
						location.href = "./websetup";
					}, 3500);
				}
				
			}
		});
	}
}

</script>

</head>

<body>

<?php require_once './core/menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">

<h1>Ripristino Database</h1>
<h3><span style="color:red;">Attenzione</span><br>Questa operazione canceller&agrave; tutti i dati dei paccheti contenuti nel Database.</h3>

<button type="submit" onclick="reset(1)">Reset</button>

<h1>Ripristino Completo</h1>
<h3><span style="color:red;">Attenzione</span><br>Questa operazione canceller&agrave; tutti i file di configurazione e tutti i dati nel Database.<br>
Eseguir&agrave; quindi nuovamente la configurazione iniziale</h3>

<button type="submit" onclick="reset(2)">Reset</button>

<p style="color:green;" id="messaggio"></p>

</div>

<?php
require_once './core/footer.php';
?>

</body>

</html>