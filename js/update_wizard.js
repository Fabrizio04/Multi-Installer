const formedit = document.forms.namedItem("formedit");

formedit.addEventListener('submit', (ev) => {
	
	const arch = document.getElementsByName('arch2');
	let valarch = '';
	
	const allowedExtensions = /(\.msi|\.exe|\.bat|\.cmd)$/i;
	const formData = new FormData();
	
	for(let i = 0; i < 3; i+=1){
		if(arch[i].checked == true){
			valarch = arch[i].value;
		}
	}
	
	const file32 = document.getElementById('file32-2');
	const file64 = document.getElementById('file64-2');
	
	const nomepkg = document.getElementById('nomepkg-2').value;
	const param32 = document.getElementById('param32-2').value;
	const controllo32 = document.getElementById('controllo32-2').value;
	const param64 = document.getElementById('param64-2').value;
	const controllo64 = document.getElementById('controllo64-2').value;
	const desc = document.getElementById('desc-2').value;
	const idpkg = document.getElementById('idpkg').value;
	
	switch(valarch){
		
		case 'auto':
			
			if(file32.value != "" && !allowedExtensions.exec(file32.value)){
				document.getElementById('messaggio-2').style.color = "red";
				document.getElementById('messaggio-2').innerHTML = 'Errore! Selezionare i files corretti.<br> Sono ammessi i file .msi - .exe - .bat - .cmd <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
			}
			
			else if (file64.value != "" && !allowedExtensions.exec(file64.value)){
				document.getElementById('messaggio-2').style.color = "red";
				document.getElementById('messaggio-2').innerHTML = 'Errore! Selezionare i files corretti.<br> Sono ammessi i file .msi - .exe - .bat - .cmd <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
			}
			
			else {
				
				
				//creo il pacchetto auto
				
				if(file32.value != "")
					formData.append("file32-2",file32.files[0]);
				
				if(file64.value != "")
					formData.append("file64-2",file64.files[0]);
				
				formData.append("nomepkg-2",nomepkg);
				formData.append("param32-2",param32);
				formData.append("param64-2",param64);
				formData.append("controllo32-2",controllo32);
				formData.append("controllo64-2",controllo64);
				formData.append("desc-2",desc);
				formData.append("idpkg",idpkg);
				
				document.getElementById('messaggio-2').style.color = "black";
				document.getElementById('messaggio-2').innerHTML = '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>';
				
				fetch('./post_update_wizard.php?t=auto', {method: "post", body: formData}).then(response => response.json())
				.then(data => {
					
					if(data["result"] == "ok"){
						document.getElementById('messaggio-2').style.color = "green";
						document.getElementById('messaggio-2').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
						
						document.getElementById('vfile32-2').innerHTML = '';
						document.getElementById('vfile64-2').innerHTML = '';
						
						load_lista();
						myFunction();
						
					} else if(data["result"] == "dup"){
						document.getElementById('messaggio-2').style.color = "red";
						document.getElementById('messaggio-2').innerHTML = 'Nome pacchetto già esistente! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					} else {
						document.getElementById('messaggio-2').style.color = "red";
						document.getElementById('messaggio-2').innerHTML = 'Errore! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					}
							
				});
					
				
			}
			
		break;
		
		case '32':
			
			if(file32.value != "" && !allowedExtensions.exec(file32.value)){
				document.getElementById('messaggio-2').style.color = "red";
				document.getElementById('messaggio-2').innerHTML = 'Errore! Selezionare i files corretti.<br> Sono ammessi i file .msi - .exe - .bat - .cmd <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
			}
			
			else {
				
				if(file32.value != "")
					formData.append("file32-2",file32.files[0]);
				
				formData.append("nomepkg-2",nomepkg);
				formData.append("param32-2",param32);
				formData.append("controllo32-2",controllo32);
				formData.append("desc-2",desc);
				formData.append("idpkg",idpkg);
				
				document.getElementById('messaggio-2').style.color = "black";
				document.getElementById('messaggio-2').innerHTML = '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>';
				
				fetch('./post_update_wizard.php?t=32', {method: "post", body: formData}).then(response => response.json())
				.then(data => {
					
					if(data["result"] == "ok"){
						document.getElementById('messaggio-2').style.color = "green";
						document.getElementById('messaggio-2').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
						
						document.getElementById('vfile32-2').innerHTML = '';
						
						load_lista();
						myFunction();
						
					} else if(data["result"] == "dup"){
						document.getElementById('messaggio-2').style.color = "red";
						document.getElementById('messaggio-2').innerHTML = 'Nome pacchetto già esistente! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					} else {
						document.getElementById('messaggio-2').style.color = "red";
						document.getElementById('messaggio-2').innerHTML = 'Errore! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					}
							
				});
				
			}
			
		break;
		
		case '64':
		
			if (file64.value != "" && !allowedExtensions.exec(file64.value)){
				document.getElementById('messaggio-2').style.color = "red";
				document.getElementById('messaggio-2').innerHTML = 'Errore! Selezionare i files corretti.<br> Sono ammessi i file .msi - .exe - .bat - .cmd <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
			}
			
			else {
				
				if(file64.value != "")
					formData.append("file64-2",file64.files[0]);
				
				formData.append("nomepkg-2",nomepkg);
				formData.append("param64-2",param64);
				formData.append("controllo64-2",controllo64);
				formData.append("desc-2",desc);
				formData.append("idpkg",idpkg);
				
				document.getElementById('messaggio-2').style.color = "black";
				document.getElementById('messaggio-2').innerHTML = '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>';
				
				fetch('./post_update_wizard.php?t=64', {method: "post", body: formData}).then(response => response.json())
				.then(data => {
					
					if(data["result"] == "ok"){
						document.getElementById('messaggio-2').style.color = "green";
						document.getElementById('messaggio-2').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
						
						document.getElementById('vfile32-2').innerHTML = '';
						document.getElementById('vfile64-2').innerHTML = '';
						
						load_lista();
						myFunction();
						
					} else if(data["result"] == "dup"){
						document.getElementById('messaggio-2').style.color = "red";
						document.getElementById('messaggio-2').innerHTML = 'Nome pacchetto già esistente! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					} else {
						document.getElementById('messaggio-2').style.color = "red";
						document.getElementById('messaggio-2').innerHTML = 'Errore! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					}
							
				});
					
				
			}
		
		break;
		
	}
	
	ev.preventDefault();

}, false);