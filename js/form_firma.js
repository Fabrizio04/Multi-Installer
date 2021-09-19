const form = document.forms.namedItem("formsetup");
const form2 = document.forms.namedItem("genera");
const form3 = document.forms.namedItem("carica");

form.addEventListener('submit', (ev) => {
	const sign = document.getElementById('ssign').checked;
	
	const requestBody = {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'Accept': 'application/json'
		},
		body: JSON.stringify({
			"sign": sign
			
		})
	};
	
	fetch('./post_firma.php', requestBody).then(response => response.json())
	.then(data => {
		if(data["result"] == "ok"){
			document.getElementById('messaggio').style.color = "green";
			document.getElementById('messaggio').innerHTML = 'Modifica salvata. <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
		}else{
			document.getElementById('ssign').checked = false;
			document.getElementById('sign').style.backgroundColor = '#eee';
			document.getElementById('messaggio').style.color = "red";
			document.getElementById('messaggio').innerHTML = 'Errore!<br>Nessun certificato presente sul server. <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
		}
		
	});
	
	ev.preventDefault();
}, false);

form2.addEventListener('submit', (ev) => {
	const paese = document.getElementById('paese').value;
	const stato = document.getElementById('stato').value;
	const luogo = document.getElementById('luogo').value;
	const org = document.getElementById('org').value;
	const uni = document.getElementById('uni').value;
	const cname = document.getElementById('cname').value;
	const mail = document.getElementById('mail').value;
	const pass = document.getElementById('pass').value;
	
	const requestBody = {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'Accept': 'application/json'
		},
		body: JSON.stringify({
			"paese": paese,
			"stato": stato,
			"luogo": luogo,
			"org": org,
			"uni": uni,
			"cname": cname,
			"mail": mail,
			"pass": pass
			
		})
	};
	
	fetch('./post_genera.php', requestBody).then(response => response.json())
	.then(data => {
		if(data["result"] == "ok"){
			document.getElementById('messaggio').style.color = "green";
			document.getElementById('messaggio').innerHTML = 'Certificato generato! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
			
			document.getElementById('paese').value = "";
			document.getElementById('stato').value = "";
			document.getElementById('luogo').value = "";
			document.getElementById('org').value = "";
			document.getElementById('uni').value = "";
			document.getElementById('cname').value = "";
			document.getElementById('mail').value = "";
			document.getElementById('pass').value = "";
			
		}else{
			document.getElementById('messaggio').style.color = "red";
			document.getElementById('messaggio').innerHTML = 'Errore! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
		}
		
	});
	
	ev.preventDefault();
}, false);

remove_File = () => {
	document.getElementById('cert').value = "";
	document.getElementById('filename').innerHTML = "";
}

showname = () => {
	const name = document.getElementById('cert');
	document.getElementById('filename').style.color = "black";
    document.getElementById('filename').innerHTML = name.files.item(0).name+' <a href="javascript:remove_File();" style="color:red;"><span class="fa fa-times" aria-hidden="true"></span></a>'; 
}


form3.addEventListener('submit', (ev) => {
	
	const inpFile = document.getElementById('cert');
	const pass2 = document.getElementById('pass2').value;
	const formData = new FormData();
	
	document.getElementById("bt_up").disabled = true;
	document.getElementById("pass2").disabled = true;
	document.getElementById("up_cert").disabled = true;
	
	const allowedExtensions = /(\.pfx)$/i;
	
	if (!allowedExtensions.exec(inpFile.value)) {
		
		document.getElementById("bt_up").disabled = false;
		document.getElementById("pass2").disabled = false;
		document.getElementById('cert').value = "";
		document.getElementById("up_cert").disabled = false;
		document.getElementById('filename').innerHTML = "";
		
		document.getElementById('messaggio').style.color = "red";
		document.getElementById('messaggio').innerHTML = 'Errore! Selezionare un certificato .pfx <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
    } else {
	
		if (inpFile.value != "") {
			formData.append("inpFile",inpFile.files[0]);
			formData.append("pass2",pass2);
			
			fetch('./post_upload.php', {method: "post", body: formData}).then(response => response.json())
			.then(data => {
				if(data["result"] == "ok"){
					document.getElementById('messaggio').style.color = "green";
					document.getElementById('messaggio').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
				} else {
					document.getElementById('messaggio').style.color = "red";
					document.getElementById('messaggio').innerHTML = 'Errore! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
				}
				
				document.getElementById("bt_up").disabled = false;
				document.getElementById("pass2").disabled = false;
				document.getElementById("pass2").value = "";
				document.getElementById('cert').value = "";
				document.getElementById('filename').innerHTML = "";
				document.getElementById("up_cert").disabled = false;
				
			});
			
		} else {
			document.getElementById("bt_up").disabled = false;
			document.getElementById("pass2").disabled = false;
			document.getElementById("up_cert").disabled = false;
		}
		
	}
	
	ev.preventDefault();
}, false);