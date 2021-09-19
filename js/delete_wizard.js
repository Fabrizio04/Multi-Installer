delete_pkg = () => {
	
	const idpkg = document.getElementById('idpkg').value;
	const r = confirm("Rimuovere definitivamente il pacchetto ed eventuali file allegati ?");
	
	if (r == true) {
		
		
		fetch('./delete_wizard.php?id='+idpkg, {method: "get"}).then(response => response.json())
		.then(data => {
			
			if(data["result"] == "ok"){
				document.getElementById('messaggio-2').style.color = "green";
				document.getElementById('messaggio-2').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio-2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
				
				document.getElementById('vfile32-2').innerHTML = '';
				document.getElementById('vfile64-2').innerHTML = '';
				
				load_lista();
				myFunction();
				
				alert("Operazione conclusa");
				document.getElementsByClassName("jquery-modal blocker current")[0].click();
				
				
			} else {
				alert("Errore");
			}
					
		});
	}
	
}