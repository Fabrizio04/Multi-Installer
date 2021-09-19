let globalPercorsoWeb = document.getElementById("percorsoWeb").value;
let globalPercorsoRep = document.getElementById("percorsoRep").value;
let globalLettera = document.getElementById("lettera").value;
let globalUserServer = document.getElementById("userServer").value;
let globalPassServer = document.getElementById("passServer").value;

let globalSlog = document.getElementById("slog").checked;
let globalSpul = document.getElementById("spul").checked;
let globalGG = document.getElementById("gg").value;

const form = document.forms.namedItem("formsetup");

form.addEventListener('submit', (ev) => {
	
	const percorsoWeb = document.getElementById("percorsoWeb").value;
	const percorsoRep = document.getElementById("percorsoRep").value;
	const lettera = document.getElementById("lettera").value;
	const userServer = document.getElementById("userServer").value;
	const passServer = document.getElementById("passServer").value;

	const slog = document.getElementById("slog").checked;
	const spul = document.getElementById("spul").checked;
	const gg = document.getElementById("gg").value;
	
	if(percorsoWeb != globalPercorsoWeb || percorsoRep != globalPercorsoRep || lettera != globalLettera || userServer != globalUserServer || passServer != globalPassServer || slog != globalSlog || spul != globalSpul || gg != globalGG){
		
		if(percorsoRep.toLowerCase().includes("localhost") || percorsoRep.toLowerCase().includes("127.0.0.1")){
			alert("Il server share non puo' essere localhost - 127.0.0.1");
		} else if((userServer != "" && passServer == "") || (userServer == "" && passServer != "")){
			alert("Compilare correttamente username / password del server share. Lasciarli entrambi vuoti se autenticazione non richiesta");
		}else if(spul == true && gg == ""){
			alert("Inserire il N. di giorni");
		} else {
			
			document.getElementById("percorsoWeb").disabled = true;
			document.getElementById("percorsoRep").disabled = true
			document.getElementById("lettera").disabled = true
			document.getElementById("userServer").disabled = true
			document.getElementById("passServer").disabled = true
			document.getElementById("slog").disabled = true
			document.getElementById("spul").disabled = true
			document.getElementById("gg").disabled = true
			document.getElementById("sendForm").disabled = true
			document.getElementById("sendForm").innerHTML = "Attendere...";
			
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
					"slog": slog,
					"spul": spul,
					"gg": gg
					
				})
			};
			
			fetch('./post_server.php', requestBody).then(response => response.json())
			.then(data => {
				if(data["result"] == "ok"){
					
					document.getElementById("percorsoWeb").disabled = false;
					document.getElementById("percorsoRep").disabled = false;
					document.getElementById("lettera").disabled = false;
					document.getElementById("userServer").disabled = false;
					document.getElementById("passServer").disabled = false;
					document.getElementById("slog").disabled = false;
					document.getElementById("spul").disabled = false;
					document.getElementById("gg").disabled = false;
					document.getElementById("sendForm").disabled = false;
					document.getElementById("sendForm").innerHTML = "Aggiorna";
					
					document.getElementById('messaggio').innerHTML = 'Impostazioni salvate! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
					
					if(passServer != "")
						document.getElementById("passServer").value = 'psw';
					
					//aggiorno le variabili globali
					globalPercorsoWeb = percorsoWeb;
					globalPercorsoRep = percorsoRep;
					globalLettera = lettera;
					globalUserServer = userServer;
					globalPassServer = document.getElementById("passServer").value;
					globalSlog = slog;
					globalSpul = spul;
					globalGG = gg;
					
				}else{
					alert("Errore");
				}
				
			});
			
		}
	}
	
	ev.preventDefault();

}, false);