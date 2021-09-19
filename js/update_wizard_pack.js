const formedit = document.forms.namedItem("formedit");

formedit.addEventListener('submit', (ev) => {
	
	let idpkg = document.getElementById("idpkg").value;
	let nome = document.getElementById("nomepack2").value;
	let select = document.getElementById("programmi2");
	let result = [];
	let options = select && select.options;
	let opt;

	for (let i=0, iLen=options.length; i<iLen; i++) {
		opt = options[i];

		if (opt.selected) {
			result.push(opt.value || opt.text);
		}
	}
	
	const requestBody = {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'Accept': 'application/json'
		},
		body: JSON.stringify({
			"id": idpkg,
			"nome": nome,
			"value": result
			
		})
	};
	
	fetch('./post_update_pack.php', requestBody).then(response => response.json())
	.then(data => {
		if(data["result"] == "ok"){
			document.getElementById('vpack2').style.color = "green";
			document.getElementById('vpack2').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'vpack2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';		
			load_lista();
			myFunction();
		} else if(data["result"] == "dup") {
			document.getElementById('vpack2').style.color = "red";
			document.getElementById('vpack2').innerHTML = 'Nome pack già esistente! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'vpack2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
		} else {
			document.getElementById('vpack2').style.color = "red";
			document.getElementById('vpack2').innerHTML = 'Errore! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'vpack2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
		}
		
	});
	
	ev.preventDefault();

}, false);