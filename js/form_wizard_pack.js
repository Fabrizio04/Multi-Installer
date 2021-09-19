const form = document.forms.namedItem("formwizardpack");

form.addEventListener('submit', (ev) => {
	
	let nome = document.getElementById("nomepack").value;
	let select = document.getElementById("programmi");
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
			"nome": nome,
			"value": result
			
		})
	};
	
	fetch('./post_new_pack.php', requestBody).then(response => response.json())
	.then(data => {
		if(data["result"] == "ok"){
			document.getElementById('vpack').style.color = "green";
			document.getElementById('vpack').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'vpack\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';		
			document.getElementById("formwizardpack").reset();
			load_lista();
			myFunction();
		} else if(data["result"] == "dup") {
			document.getElementById('vpack').style.color = "red";
			document.getElementById('vpack').innerHTML = 'Nome pack già esistente! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'vpack\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
		} else {
			document.getElementById('vpack').style.color = "red";
			document.getElementById('vpack').innerHTML = 'Errore! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'vpack\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
		}
		
	});

	ev.preventDefault();
}, false);

open_modal_pack = () => {
	let body = "";
	
	fetch('./post_lista_wizard.php').then(response => response.json())
	.then(data => {
		if(data["result"] == "ok"){
			
			for(let i = 0; i < data["id"].length; i+=1){
				body += '<option value="'+data["id"][i]+'">'+data["nome"][i]+'</option>';
			}
			
			document.getElementById("programmi").innerHTML = body;
			
		}
	});
	
	document.getElementById('link1').click();
	document.getElementById('vpack').innerHTML = '';
	document.getElementById("formwizardpack").reset();

}