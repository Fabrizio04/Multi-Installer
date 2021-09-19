const form = document.forms.namedItem("formsetup");

form.addEventListener('submit', (ev) => {
	
	const conf = window.confirm("Avviare la procedura di configurazione?");
	
	if(conf == true){
	
		document.getElementById("percorsoWeb").disabled = true;
		document.getElementById("percorsoRep").disabled = true
		document.getElementById("lettera").disabled = true
		document.getElementById("userServer").disabled = true
		document.getElementById("passServer").disabled = true
		document.getElementById("host").disabled = true
		document.getElementById("database").disabled = true
		document.getElementById("motore").disabled = true
		document.getElementById("usDB").disabled = true
		document.getElementById("passDB").disabled = true
		document.getElementById("sendForm").disabled = true
		document.getElementById("sendForm").innerHTML = "Attendere...";
		
		
		const percorsoWeb = document.getElementById("percorsoWeb").value;
		const percorsoRep = document.getElementById("percorsoRep").value;
		const lettera = document.getElementById("lettera").value;
		const userServer = document.getElementById("userServer").value;
		const passServer = document.getElementById("passServer").value;
		
		const host = document.getElementById("host").value;
		const database = document.getElementById("database").value;
		const motore = document.getElementById("motore").value;
		const usDB = document.getElementById("usDB").value;
		const passDB = document.getElementById("passDB").value;
		
		const requestBody = {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			},
			body: JSON.stringify({
				"percorsoWeb": percorsoWeb,
				"percorsoRep": percorsoRep,
				"lettera": lettera,
				"userServer": userServer,
				"passServer": passServer,
				"host": host,
				"database": database,
				"motore": motore,
				"usDB": usDB,
				"passDB": passDB
			})
		};
		
		if(percorsoRep.toLowerCase().includes("localhost") || percorsoRep.toLowerCase().includes("127.0.0.1")){
			alert("Il server share non puo' essere localhost - 127.0.0.1");
			
			document.getElementById("percorsoWeb").disabled = false;
			document.getElementById("percorsoRep").disabled = false;
			document.getElementById("lettera").disabled = false;
			document.getElementById("userServer").disabled = false;
			document.getElementById("passServer").disabled = false;
			document.getElementById("host").disabled = false;
			document.getElementById("database").disabled = false;
			document.getElementById("motore").disabled = false;
			document.getElementById("usDB").disabled = false;
			document.getElementById("passDB").disabled = false;
			document.getElementById("sendForm").disabled = false;
			document.getElementById("sendForm").innerHTML = "Conferma";
			
		} else if((userServer != "" && passServer == "") || (userServer == "" && passServer != "")){
			
			alert("Compilare correttamente username / password del server share. Lasciarli entrambi vuoti se autenticazione non richiesta");
			
			document.getElementById("percorsoWeb").disabled = false;
			document.getElementById("percorsoRep").disabled = false;
			document.getElementById("lettera").disabled = false;
			document.getElementById("userServer").disabled = false;
			document.getElementById("passServer").disabled = false;
			document.getElementById("host").disabled = false;
			document.getElementById("database").disabled = false;
			document.getElementById("motore").disabled = false;
			document.getElementById("usDB").disabled = false;
			document.getElementById("passDB").disabled = false;
			document.getElementById("sendForm").disabled = false;
			document.getElementById("sendForm").innerHTML = "Conferma";
			
		} else {
		
			fetch('./post.php', requestBody).then(response => response.json())
			.then(data => {
				if(data["result"] == "ok"){
					alert("Configurazione iniziale completata!");
					location.href = '../';
				}else{
					alert(data["text"])
				}
				
				document.getElementById("percorsoWeb").disabled = false;
				document.getElementById("percorsoRep").disabled = false;
				document.getElementById("lettera").disabled = false;
				document.getElementById("userServer").disabled = false;
				document.getElementById("passServer").disabled = false;
				document.getElementById("host").disabled = false;
				document.getElementById("database").disabled = false;
				document.getElementById("motore").disabled = false;
				document.getElementById("usDB").disabled = false;
				document.getElementById("passDB").disabled = false;
				document.getElementById("sendForm").disabled = false;
				document.getElementById("sendForm").innerHTML = "Conferma";
				
			});
		}
	}
	
	ev.preventDefault();

}, false);