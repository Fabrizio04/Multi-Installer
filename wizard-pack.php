<?php
if(!file_exists('./core/config.inc.php')) header("Location: ./websetup");
require_once './core/config.inc.php';
?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer - Wizard Pack</title>

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

.mySelect {
    background: #212121;
    color: white;
    text-align-last: center;
    padding: 6px;
    width: 50%;
	height: 40rem;
}

@media only screen and (max-width: 996px) {
	button {
		width: 90%;
	}
	
	input[type=text] {
		width: 90%;
	}

	.mySelect {
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

			<h1>Wizard Pack</h1>
			
			 <div class="row">
			 <button id="last_selected" class="myButton" onclick="open_modal_pack();"->Nuovo <i class="fa fa-plus" aria-hidden="true"></i></button>
			<a rel="modal:open" href="#ess" id="link1"></a>
			</div>
			<div class="row">
				<input type="search" id="myInput" onkeypress="return stop(event);" onkeyup="myFunction()" onmousemove="myFunction()" ontouchmove="myFunction()" placeholder="Ricerca wizard pack . . ." title="Ricerca wizard pack . . ." autocomplete="off">
			</div>
			
		</div>
		<!-- Fine menù -->
		
		<!-- Lista -->
		<div class="main2" align="center" id="lista">
		</div>
		<!-- Fine lista -->
		<script src="./js/lista_wizard_pack.js"></script>
		
</div>

<div id="ess" class="modal" style="max-width:1280px;">

<div style="word-wrap: break-word;text-align:center;">

<form method="POST" id="formwizardpack" name="formwizardpack">

<h2>Nuovo Wizard Pack</h2>

<input type="text" id="nomepack" title="Nome" name="nomepack" placeholder="Nome" size="30" required>
<br>

<br>
<select name="programmi[]" id="programmi" class="mySelect" multiple required>
</select>

<br><br>
<button type="submit">Aggiungi</button>

</form>

<p id="vpack"></p>

<script src="./js/form_wizard_pack.js"></script>
</div>

</div>

<!-- -->

<div id="edit" class="modal" style="max-width:1280px;">

<div style="word-wrap: break-word;text-align:center;">

<form method="POST" id="formedit" name="formedit">

<input type="hidden" name="idpkg" id="idpkg">

<h2>Modifica Wizard Pack</h2>

<input type="text" id="nomepack2" title="Nome" name="nomepack2" placeholder="Nome" size="30" required>
<br>

<br>
<select name="programmi2[]" id="programmi2" class="mySelect" multiple required>
</select>

<br><br>
<button type="submit">Modifica</button>

</form>

<button style="color:red;margin-top:2px;" onclick="delete_pkg()">Elimina</button>

<p id="vpack2"></p>

<script src="./js/update_wizard_pack.js"></script>
<script src="./js/delete_wizard_pack.js"></script>
</div>

</div>

<?php
require_once './core/footer.php';
require_once './core/footer_home.php';
?>
</body>

</html>