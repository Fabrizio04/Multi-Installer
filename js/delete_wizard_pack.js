delete_pkg = () => {
	
	const idpkg = document.getElementById('idpkg').value;
	const r = confirm("Rimuovere definitivamente questo wizard pack ?");
	
	if (r == true) {
		
		
		fetch('./delete_wizard_pack.php?id='+idpkg, {method: "get"}).then(response => response.json())
		.then(data => {
			
			if(data["result"] == "ok"){
				document.getElementById('vpack2').style.color = "green";
				document.getElementById('vpack2').innerHTML = 'Operazione completata! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'vpack2\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
				
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