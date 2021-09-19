load_lista = () => {
	
	let body = '';
	
	fetch('./post_lista_wizard.php').then(response => response.json())
	.then(data => {
		if(data["result"] == "ok"){
			
			body += '<ul id="myUL">';
			
			for(let i = 0; i < data["id"].length; i+=1){
				body += '<li title="'+data["desc"][i]+'"><a rel="modal:open" href="#edit" onclick="load_value(\''+data["id"][i]+'\')"><table style="text-align:center;"><tbody><tr><td width="400"><strong>'+data["nome"][i]+'</strong></td></tr></tbody></table></a></li>';
			}
			
			body += '<ul>';
			document.getElementById("lista").innerHTML = body;
			document.getElementById("myInput").disabled = false;
			
		} else {
			document.getElementById("lista").innerHTML = '<h3 class="sistema">Nessun pacchetto</h3>';
			document.getElementById("myInput").disabled = true;
		}
	});

}

load_lista();

const decodeHtmlCharCodes = str => 
  str.replace(/(&#(\d+);)/g, (match, capture, charCode) => 
    String.fromCharCode(charCode));

getSHA256fromDB = (file,id) => {
	
	const request = {
		method: 'POST',
		headers: {
		  'Accept': 'application/json',
		  'Content-Type': 'application/json'
		},
		body: JSON.stringify({nome: file})
	};
	
	fetch('./post_get_sha256.php',request).then(response => response.json())
	.then(data => {
		
		if(data["result"] == "ok")
			document.getElementById(id).innerHTML = "<i>"+file+":</i> "+data["sha256"];
		else
			document.getElementById(id).innerHTML = "File non trovato";
		
	});
	
	
}

load_value = (id) => {
	
	document.getElementById('file32-2').value = "";
	document.getElementById('vfile32-2').innerHTML = "";
	
	document.getElementById('file64-2').value = "";
	document.getElementById('vfile64-2').innerHTML = "";
	
	const request = {
		method: 'POST',
		headers: {
		  'Accept': 'application/json',
		  'Content-Type': 'application/json'
		},
		body: JSON.stringify({id: id})
	};
	
	fetch('./post_value_wizard.php',request).then(response => response.json())
	.then(data => {
		
		if(data["result"] == "ok"){
			
			document.getElementById("nomepkg-2").value = data["nome"];
			document.getElementById("param32-2").value = data["param32"];
			document.getElementById("controllo32-2").value = data["controllo32"];
			document.getElementById("param64-2").value = data["param64"];
			document.getElementById("controllo64-2").value = data["controllo64"];
			document.getElementById("desc-2").innerHTML = data["desc"];
			document.getElementById("idpkg").value = id;
			document.getElementById("messaggio-2").innerHTML = "";
			
			//controllo arch
			if(data["param32"] != "" && data["param64"] != "")
				seleziona2('auto2-2');
			else if(data["param32"] != "" && data["param64"] == "")
				seleziona2('32-2');
			else if(data["param32"] == "" && data["param64"] != "")
				seleziona2('64-2');
			
			if(data["file32"] != "")
				getSHA256fromDB(data["file32"],'vfile32-2');
			
			if(data["file64"] != "")
				getSHA256fromDB(data["file64"],'vfile64-2');
			
		} else alert("Errore");
	});
	
}