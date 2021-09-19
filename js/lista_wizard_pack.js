load_lista = () => {
	
	let body = '';
	
	fetch('./post_lista_pack.php').then(response => response.json())
	.then(data => {
		if(data["result"] == "ok"){
			
			body += '<ul id="myUL">';
			
			for(let i = 0; i < data["id"].length; i+=1){
				body += '<li><a rel="modal:open" href="#edit" onclick="load_value(\''+data["id"][i]+'\')"><table style="text-align:center;"><tbody><tr><td width="400"><strong>'+data["nome"][i]+'</strong></td></tr></tbody></table></a></li>';
			}
			
			body += '<ul>';
			document.getElementById("lista").innerHTML = body;
			document.getElementById("myInput").disabled = false;
			
		} else if(data["result"] == "empty") {
			document.getElementById("lista").innerHTML = '<h3 class="sistema">Nessun pacchetto</h3>';
			document.getElementById("myInput").disabled = true;
		} else {
			document.getElementById("lista").innerHTML = '<h3 class="sistema">Inserisci almeno 3 pacchetti wizard per creare un pack</h3>';
			document.getElementById("myInput").disabled = true;
			document.getElementById("last_selected").disabled = true;
		}
	});

}

load_lista();


load_value = (id) => {
	
	document.getElementById("vpack2").innerHTML = "";
	document.getElementById("programmi2").innerHTML = "";		
	
	const request = {
		method: 'POST',
		headers: {
		  'Accept': 'application/json',
		  'Content-Type': 'application/json'
		},
		body: JSON.stringify({id: id})
	};
	
	fetch('./post_value_pack.php',request).then(response => response.json())
	.then(data => {
		
		if(data["result"] == "ok"){
			
			document.getElementById("idpkg").value = id;
			document.getElementById("nomepack2").value = data["nome"];
			
			const myArr = data["packs"].split(",");
			let body = "";
	
			fetch('./post_lista_wizard.php').then(response => response.json())
			.then(data => {
				if(data["result"] == "ok"){
					
					for(let i = 0; i < data["id"].length; i+=1){
						
						if(myArr.includes(data["id"][i]))
							body += '<option value="'+data["id"][i]+'" selected>'+data["nome"][i]+'</option>';
						else
							body += '<option value="'+data["id"][i]+'">'+data["nome"][i]+'</option>';
					}
					
					document.getElementById("programmi2").innerHTML = body;					
					
				}
			});
			
			
		} else alert("Errore");
	});
	
}