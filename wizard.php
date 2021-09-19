<?php
if(!file_exists('./core/config.inc.php')) header("Location: ./websetup");
require_once './core/config.inc.php';
?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer - Gestione Wizard</title>

<?php
require_once './core/header.php';
?>


<style>
.main2 {
	margin: auto;
	padding-top: 185px;
	padding-bottom: 15px;
	width: 90%;
}

@media only screen and (min-width:997px){
	.main2 {
		margin: auto;
		width: 75%;
		padding-top: 175px;
		padding-bottom: 15px;
	}
}

.myradio {
	display:none;
}

.mytd {
	padding: 10px;
}

.mytd:hover {
	cursor:pointer;
}

button {
    background-color: #212121;
    color: white;
    padding: 6px 10px 6px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    min-width: 50%;
}

button:hover {
  background-color: #404040;
  color: white;
}

input[type=text] {
    width: 50%;
    margin-top: 1rem;
    padding: 6px 10px 6px 10px;
    border: 1px solid #ccc;
    text-align: center;
	border:1px solid grey;
}

textarea {
	width:50%;
	border:1px solid grey;
}

@media only screen and (max-width: 996px) {
	button {
		width: 90%;
	}

	#archi {
		width: 90%;
	}
	
	input[type=text] {
		width: 90%;
	}

	textarea {
		width: 90%;
	}
}


</style>

<script>

myFunction = () => {
    let input, filter, ul, li, a;
	
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
	
    for (let i = 0; i < li.length; i++) {
		
        a = li[i].getElementsByTagName("a")[0];
		
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

resetSearch = () => {
	document.getElementById("myInput").value = '';
	myFunction();
}

stop = (event) => {
	
	const x = event.which || event.keyCod;
	
	if (x == 13){
		return false;
	}
	
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


</head>

<body>

<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<?php require_once './core/menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">
	
		<!-- Menù -->
		<div id="mainmenu">

			<h1>Gestione Wizard</h1>
			
			 <div class="row">
			 <button id="last_selected" class="myButton" onclick="open_modal_pack();">Nuovo <i class="fa fa-plus" aria-hidden="true"></i></button>
			<a rel="modal:open" href="#ess" id="link1"></a>
			</div>
			<div class="row">
				<input type="search" id="myInput" onkeypress="return stop(event);" onkeyup="myFunction()" onmousemove="myFunction()" ontouchmove="myFunction()" placeholder="Ricerca pacchetti . . ." title="Ricerca pacchetti . . ." autocomplete="off">
			</div>
			
		</div>
		<!-- Fine menù -->
		
		<!-- Lista -->
		<div class="main2" align="center" id="lista">
		</div>
		<!-- Fine lista -->
		<script src="./js/lista_wizard.js"></script>
		
</div>

<div id="ess" class="modal" style="max-width:1280px;">

<div style="word-wrap: break-word;text-align:center;">

<form method="POST" id="formwizard" name="formwizard">

<h2>Architettura</h2>

<table border align="center" id="archi">
<tr>

<td class="mytd" title="Auto" onclick="seleziona('auto2')" id="4" style="background-color:#bfbebe;"><img src="img/auto.png"></td>
<td class="mytd" title="32 bit" onclick="seleziona('32')" id="5" style="background-color:transparent;"><img src="img/32.png"></td>
<td class="mytd" title="64 bit" onclick="seleziona('64')" id="6" style="background-color:transparent;"><img src="img/64.png"></td>

</tr>

</table>

<br>
<input type="text" id="nomepkg" title="Nome pacchetto" name="nomepkg" placeholder="Nome pacchetto" size="30" required>
<br>

<h3>32 bit</h3>

<input type="file" id="file32" name="file32" style="display:none;" accept=".msi,.exe,.bat,.cmd" onchange="showname32()">
<button id="bt_up" onclick="document.getElementById('file32').click();return false;">Seleziona File <i class="fa fa-paperclip" aria-hidden="true"></i></button>
<br>

<br>
<textarea id="param32" name="param32" rows="5" placeholder="CMD Command - Esempio: 7z1900.exe /S" required></textarea>

<br>
<input type="text" id="controllo32" title="Path installazione" name="controllo32" placeholder="Path installazione - Es. C:\Program Files\7-Zip" pattern="([^\s][A-z0-9À-ž:\\\-_\s]+)" minlength="3" required>

<p id="vfile32"></p>

<h3>64 bit</h3>

<input type="file" id="file64" name="file64" style="display:none;" accept=".msi,.exe,.bat,.cmd" onchange="showname64()">
<button id="bt_up2" onclick="document.getElementById('file64').click();return false;">Seleziona File <i class="fa fa-paperclip" aria-hidden="true"></i></button>
<br>

<br>
<textarea id="param64" name="param64" rows="5" placeholder="CMD Command - Esempio: 7z1900-x64.exe /S" required></textarea>
<br>

<br>
<input type="text" id="controllo64" title="Path installazione" name="controllo64" placeholder="Path installazione - Es. C:\Program Files\7-Zip" pattern="([^\s][A-z0-9À-ž:\\\-_\s]+)" minlength="3" required>

<p id="vfile64"></p>

<br>
<textarea id="desc" name="desc" rows="5" placeholder="Descrizione (facoltativa)"></textarea>
<br>

<input class="myradio" type="radio" name="arch" id="auto2" value="auto" required checked="checked">
<input class="myradio" type="radio" name="arch" id="32" value="32">
<input class="myradio" type="radio" name="arch" id="64" value="64">

<br>
<button type="submit">Aggiungi</button>

</form>

<p style="color:green;" id="messaggio"></p>

<script src="./js/form_wizard.js"></script>
</div>

</div>

<!-- -->

<div id="edit" class="modal" style="max-width:1280px;">

<div style="word-wrap: break-word;text-align:center;">

<form method="POST" id="formedit" name="formedit">

<h2>Architettura</h2>

<table border align="center" id="archi2">
<tr>

<td class="mytd" title="Auto" onclick="seleziona2('auto2-2')" id="7" style="background-color:#bfbebe;"><img src="img/auto.png"></td>
<td class="mytd" title="32 bit" onclick="seleziona2('32-2')" id="8" style="background-color:transparent;"><img src="img/32.png"></td>
<td class="mytd" title="64 bit" onclick="seleziona2('64-2')" id="9" style="background-color:transparent;"><img src="img/64.png"></td>

</tr>

</table>

<br>
<input type="text" id="nomepkg-2" title="Nome pacchetto" name="nomepkg" placeholder="Nome pacchetto" size="30" required>
<br>

<h3>32 bit</h3>

<input type="file" id="file32-2" name="file32-2" style="display:none;" accept=".msi,.exe,.bat,.cmd" onchange="showname32_2()">
<button id="bt_up-2" onclick="document.getElementById('file32-2').click();return false;">Seleziona File <i class="fa fa-paperclip" aria-hidden="true"></i></button>
<br>

<br>
<textarea id="param32-2" name="param32-2" rows="5" placeholder="CMD Command - Esempio: 7z1900.exe /S" required></textarea>

<br>
<input type="text" id="controllo32-2" title="Path installazione" name="controllo32-2" placeholder="Path installazione - Es. C:\Program Files\7-Zip" pattern="([^\s][A-z0-9À-ž:\\\-_\s]+)" minlength="3" required>

<p id="vfile32-2"></p>

<h3>64 bit</h3>

<input type="file" id="file64-2" name="file64-2" style="display:none;" accept=".msi,.exe,.bat,.cmd" onchange="showname64_2()">
<button id="bt_up2-2" onclick="document.getElementById('file64-2').click();return false;">Seleziona File <i class="fa fa-paperclip" aria-hidden="true"></i></button>
<br>

<br>
<textarea id="param64-2" name="param64-2" rows="5" placeholder="CMD Command - Esempio: 7z1900-x64.exe /S" required></textarea>
<br>

<br>
<input type="text" id="controllo64-2" title="Path installazione" name="controllo64-2" placeholder="Path installazione - Es. C:\Program Files\7-Zip" pattern="([^\s][A-z0-9À-ž:\\\-_\s]+)" minlength="3" required>

<p id="vfile64-2"></p>

<br>
<textarea id="desc-2" name="desc-2" rows="5" placeholder="Descrizione (facoltativa)"></textarea>
<br>

<input class="myradio" type="radio" name="arch2" id="auto2-2" value="auto" required checked="checked">
<input class="myradio" type="radio" name="arch2" id="32-2" value="32">
<input class="myradio" type="radio" name="arch2" id="64-2" value="64">

<input type="hidden" name="idpkg" id="idpkg">

<br>
<button type="submit">Modifica</button>

</form>

<button style="color:red;margin-top:2px;" onclick="delete_pkg()">Elimina</button>

<p style="color:green;" id="messaggio-2"></p>

<script src="./js/update_wizard.js"></script>
<script src="./js/delete_wizard.js"></script>
</div>

</div>

<script>
seleziona = (id) => {
	
	document.getElementById(id).checked = true;
	
	switch(id){
		case 'auto2':
			document.getElementById(4).style.backgroundColor = "#bfbebe";
			document.getElementById(5).style.backgroundColor = "transparent";
			document.getElementById(6).style.backgroundColor = "transparent";
			
			document.getElementById('bt_up').disabled = false;
			document.getElementById('file32').disabled = false;
			document.getElementById('param32').disabled = false;
			document.getElementById('controllo32').disabled = false;
			
			document.getElementById('bt_up2').disabled = false;
			document.getElementById('file64').disabled = false;
			document.getElementById('param64').disabled = false;
			document.getElementById('controllo64').disabled = false;
			
			break;
		case '32':
			document.getElementById(4).style.backgroundColor = "transparent";
			document.getElementById(5).style.backgroundColor = "#bfbebe";
			document.getElementById(6).style.backgroundColor = "transparent";
			
			document.getElementById('bt_up').disabled = false;
			document.getElementById('file32').disabled = false;
			document.getElementById('param32').disabled = false;
			document.getElementById('controllo32').disabled = false;
			
			document.getElementById('bt_up2').disabled = true;
			document.getElementById('file64').disabled = true;
			document.getElementById('param64').disabled = true;
			document.getElementById('controllo64').disabled = true;
			
			break;
		case '64':
			document.getElementById(4).style.backgroundColor = "transparent";
			document.getElementById(5).style.backgroundColor = "transparent";
			document.getElementById(6).style.backgroundColor = "#bfbebe";
			
			document.getElementById('bt_up').disabled = true;
			document.getElementById('file32').disabled = true;
			document.getElementById('param32').disabled = true;
			document.getElementById('controllo32').disabled = true;
			
			document.getElementById('bt_up2').disabled = false;
			document.getElementById('file64').disabled = false;
			document.getElementById('param64').disabled = false;
			document.getElementById('controllo64').disabled = false;
			
			break;
	}
	
}

seleziona2 = (id) => {
	
	document.getElementById(id).checked = true;
	
	switch(id){
		case 'auto2-2':
			document.getElementById(7).style.backgroundColor = "#bfbebe";
			document.getElementById(8).style.backgroundColor = "transparent";
			document.getElementById(9).style.backgroundColor = "transparent";
			
			document.getElementById('bt_up-2').disabled = false;
			document.getElementById('file32-2').disabled = false;
			document.getElementById('param32-2').disabled = false;
			document.getElementById('controllo32-2').disabled = false;
			
			document.getElementById('bt_up2-2').disabled = false;
			document.getElementById('file64-2').disabled = false;
			document.getElementById('param64-2').disabled = false;
			document.getElementById('controllo64-2').disabled = false;
			
			break;
		case '32-2':
			document.getElementById(7).style.backgroundColor = "transparent";
			document.getElementById(8).style.backgroundColor = "#bfbebe";
			document.getElementById(9).style.backgroundColor = "transparent";
			
			document.getElementById('bt_up-2').disabled = false;
			document.getElementById('file32-2').disabled = false;
			document.getElementById('param32-2').disabled = false;
			document.getElementById('controllo32-2').disabled = false;
			
			document.getElementById('bt_up2-2').disabled = true;
			document.getElementById('file64-2').disabled = true;
			document.getElementById('param64-2').disabled = true;
			document.getElementById('controllo64-2').disabled = true;
			
			break;
		case '64-2':
			document.getElementById(7).style.backgroundColor = "transparent";
			document.getElementById(8).style.backgroundColor = "transparent";
			document.getElementById(9).style.backgroundColor = "#bfbebe";
			
			document.getElementById('bt_up-2').disabled = true;
			document.getElementById('file32-2').disabled = true;
			document.getElementById('param32-2').disabled = true;
			document.getElementById('controllo32-2').disabled = true;
			
			document.getElementById('bt_up2-2').disabled = false;
			document.getElementById('file64-2').disabled = false;
			document.getElementById('param64-2').disabled = false;
			document.getElementById('controllo64-2').disabled = false;
			
			break;
	}
	
}
</script>

<?php
require_once './core/footer.php';
require_once './core/footer_home.php';
?>
</body>

</html>