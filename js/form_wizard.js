global_change = false;

open_modal_pack = () => {
	document.getElementById('link1').click();
	
	document.getElementById('vfile32').innerHTML = '';
	document.getElementById('vfile64').innerHTML = '';
	
	document.getElementById('messaggio').innerHTML = '';
	document.getElementById('desc').innerHTML = '';
	document.getElementById("formwizard").reset();

}

remove_File = (id,id2) => {
	document.getElementById(id).value = "";
	document.getElementById(id2).innerHTML = "";
}

showname32 = () => {
	const name = document.getElementById('file32');
	document.getElementById('vfile32').style.color = "black";
    document.getElementById('vfile32').innerHTML = name.files.item(0).name+' <a href="javascript:remove_File(\'file32\',\'vfile32\');" style="color:red;"><span class="fa fa-times" aria-hidden="true"></span></a>'; 
}

showname64 = () => {
	const name = document.getElementById('file64');
	document.getElementById('vfile64').style.color = "black";
    document.getElementById('vfile64').innerHTML = name.files.item(0).name+' <a href="javascript:remove_File(\'file64\',\'vfile64\');" style="color:red;"><span class="fa fa-times" aria-hidden="true"></span></a>'; 
}

showname32_2 = () => {
	const name = document.getElementById('file32-2');
	document.getElementById('vfile32-2').style.color = "black";
    document.getElementById('vfile32-2').innerHTML = name.files.item(0).name+' <a href="javascript:remove_File(\'file32-2\',\'vfile32-2\');" style="color:red;"><span class="fa fa-times" aria-hidden="true"></span></a>'; 
}

showname64_2 = () => {
	const name = document.getElementById('file64-2');
	document.getElementById('vfile64-2').style.color = "black";
    document.getElementById('vfile64-2').innerHTML = name.files.item(0).name+' <a href="javascript:remove_File(\'file64-2\',\'vfile64-2\');" style="color:red;"><span class="fa fa-times" aria-hidden="true"></span></a>'; 
}

const form = document.forms.namedItem("formwizard");

form.addEventListener('submit', (ev) => {
	
	const arch = document.getElementsByName('arch');
	let valarch = '';
	
	const allowedExtensions = /(\.msi|\.exe|\.bat|\.cmd)$/i;
	const formData = new FormData();
	
	for(let i = 0; i < 3; i+=1){
		if(arch[i].checked == true){
			valarch = arch[i].value;
		}
	}
	
	const file32 = document.getElementById('file32');
	const file64 = document.getElementById('file64');
	
	const nomepkg = document.getElementById('nomepkg').value;
	const param32 = document.getElementById('param32').value;
	const controllo32 = document.getElementById('controllo32').value;
	const param64 = document.getElementById('param64').value;
	const controllo64 = document.getElementById('controllo64').value;
	const desc = document.getElementById('desc').value;
	
	switch(valarch){
		
		case 'auto':
			if (!allowedExtensions.exec(file32.value) || !allowedExtensions.exec(file64.value)) {
				document.getElementById('messaggio').style.color = "red";
				document.getElementById('messaggio').innerHTML = 'Errore! Selezionare i files corretti.<br> Sono ammessi i file .msi - .exe - .bat - .cmd <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
			} else {
				//creo il pacchetto auto
				formData.append("file32",file32.files[0]);
				formData.append("file64",file64.files[0]);
				
				formData.append("nomepkg",nomepkg);
				formData.append("param32",param32);
				formData.append("param64",param64);
				formData.append("controllo32",controllo32);
				formData.append("controllo64",controllo64);
				formData.append("desc",desc);
				
				document.getElementById('messaggio').style.color = "black";
				document.getElementById('messaggio').innerHTML = '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>';
				
				fetch('./post_new_wizard.php?t=auto', {method: "post", body: formData}).then(response => response.json())
				.then(data => {
					if(data["result"] == "ok"){
						document.getElementById('messaggio').style.color = "green";
						document.getElementById('messaggio').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
						
						document.getElementById("formwizard").reset();
						document.getElementById('vfile32').innerHTML = '';
						document.getElementById('vfile64').innerHTML = '';
						
						load_lista();
						myFunction();
						
					} else if(data["result"] == "dup"){
						document.getElementById('messaggio').style.color = "red";
						document.getElementById('messaggio').innerHTML = 'Nome pacchetto già esistente! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					} else {
						document.getElementById('messaggio').style.color = "red";
						document.getElementById('messaggio').innerHTML = 'Errore! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					}
							
				});
				
			}
			
		break;
		
		case '32':
		
			if (!allowedExtensions.exec(file32.value)) {
				document.getElementById('messaggio').style.color = "red";
				document.getElementById('messaggio').innerHTML = 'Errore! Selezionare un file corretto.<br> Sono ammessi i file .msi - .exe - .bat - .cmd <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
			} else {
				formData.append("file32",file32.files[0]);
				formData.append("nomepkg",nomepkg);
				formData.append("param32",param32);
				formData.append("controllo32",controllo32);
				formData.append("desc",desc);
				
				document.getElementById('messaggio').style.color = "black";
				document.getElementById('messaggio').innerHTML = '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>';
				
				fetch('./post_new_wizard.php?t=32', {method: "post", body: formData}).then(response => response.json())
				.then(data => {
					if(data["result"] == "ok"){
						document.getElementById('messaggio').style.color = "green";
						document.getElementById('messaggio').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
						
						document.getElementById("formwizard").reset();
						document.getElementById('vfile32').innerHTML = '';
						
						load_lista();
						myFunction();
						
					} else if(data["result"] == "dup"){
						document.getElementById('messaggio').style.color = "red";
						document.getElementById('messaggio').innerHTML = 'Nome pacchetto già esistente! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					} else {
						document.getElementById('messaggio').style.color = "red";
						document.getElementById('messaggio').innerHTML = 'Errore! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					}
							
				});
			}
		
		break;

		case '64':
		
			if (!allowedExtensions.exec(file64.value)) {
				document.getElementById('messaggio').style.color = "red";
				document.getElementById('messaggio').innerHTML = 'Errore! Selezionare un file corretto.<br> Sono ammessi i file .msi - .exe - .bat - .cmd <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
			} else {
				formData.append("file64",file64.files[0]);
				formData.append("nomepkg",nomepkg);
				formData.append("param64",param64);
				formData.append("controllo64",controllo64);
				formData.append("desc",desc);
				
				document.getElementById('messaggio').style.color = "black";
				document.getElementById('messaggio').innerHTML = '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>';
				
				fetch('./post_new_wizard.php?t=64', {method: "post", body: formData}).then(response => response.json())
				.then(data => {
					if(data["result"] == "ok"){
						document.getElementById('messaggio').style.color = "green";
						document.getElementById('messaggio').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
						
						document.getElementById("formwizard").reset();
						document.getElementById('vfile64').innerHTML = '';
						
						load_lista();
						myFunction();
						
					} else if(data["result"] == "dup"){
						document.getElementById('messaggio').style.color = "red";
						document.getElementById('messaggio').innerHTML = 'Nome pacchetto già esistente! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					} else {
						document.getElementById('messaggio').style.color = "red";
						document.getElementById('messaggio').innerHTML = 'Errore! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					}
							
				});
			}
		
		break;	
		
	}
	
	ev.preventDefault();
}, false);