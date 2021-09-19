let global_programmi = "";

info = () => {
	
	const idpkg = document.getElementById("pack").value;
	let lista = "";
	
	if(idpkg != ""){
		
		const myArr = global_programmi.split(",");
		for(i = 0; i < myArr.length; i+=1){
			if(i == myArr.length-1)
				lista += myArr[i];
			else
				lista += myArr[i]+"<br>";
		}
		
		document.getElementById("program_list").innerHTML = lista;
		document.getElementById("link1").click();
	}
	
}

mostra = () => {
	
	if(document.getElementById("progr").style.display == 'none')
		document.getElementById("progr").style.display = '';
	else
		document.getElementById("progr").style.display = 'none';
}

cecca = (id) => {

	const a = document.getElementById(id).checked;
	const id2 = "scelta"+id;
	
	if (a == false) {
		document.getElementById(id).checked = true;
		document.getElementById(id2).style.backgroundColor = '#73e600';
	} else {
		document.getElementById(id).checked = false;
		document.getElementById(id2).style.backgroundColor = '';
	}

}


closeAll = async() => {
	
	const idpkg = document.getElementById("pack").value;
	
	if(idpkg != ""){
	
		document.getElementById("progr").style.display = 'none';
		global_programmi = "";
		
		const request = {
			method: 'POST',
			headers: {
			  'Accept': 'application/json',
			  'Content-Type': 'application/json'
			},
			body: JSON.stringify({id: idpkg})
		};
		
		
		const myrequest = await fetch('./post_value_pack.php',request);
		const response = await myrequest.json();
		
		//console.log(response)
		
		const myArr = response["packs"].split(",");
		//console.log(myArr)
		
		let myhead = "";
		let myreq = "";
		let myresp = "";
		let mybody = "";
		
		for(i = 0; i < myArr.length; i+=1){
			myhead = {
				method: 'POST',
				headers: {
				  'Accept': 'application/json',
				  'Content-Type': 'application/json'
				},
				body: JSON.stringify({id: myArr[i]})
			};
			
			myreq = await fetch('./post_value_wizard.php',myhead);
			myresp = await myreq.json();
			
			mybody += '<li title="'+myresp["desc"]+'"><a style="background-color:#73e600;" id="scelta'+myArr[i]+'" onclick="cecca(\''+myArr[i]+'\')"><table style="text-align:center;"><tbody><tr><td width="400"><strong>'+myresp["nome"]+'</strong><input type="checkbox" style="display:none;cursor:pointer;" id="'+myArr[i]+'" name="nomeVar[]" value="'+myArr[i]+'" checked></td></tr></tbody></table></a></li>';
			
			if(i == myArr.length-1)
				global_programmi += myresp["nome"];
			else
				global_programmi += myresp["nome"]+",";
			//console.log(myresp)
		}
		
		//console.log(mybody)
		document.getElementById("myUL").innerHTML =  mybody;
	
	}
}

download = () => {
	const idpkg = document.getElementById("pack").value;
	
	if(idpkg != ""){
		
		const x = document.querySelectorAll('input');
		let c = 0;
		
		for(i = 0; i < x.length; i += 1){
			if(x[i].checked)
				c += 1;
		}
		
		if(c > 0){
			loading();
			const formData = new FormData(document.getElementById("form1")); 
			fetch('./executePack.php', {method: "post", body: formData}).then(response => response.text())
			.then(data => {
				location.href='download.php?id='+data;
				enable();
			});
			
		}
		
	}
	
}

loading = () => {
	closeAll();
	document.getElementById("load_gif").style.display = '';
	disableMenu();
	const x = document.getElementsByClassName("myButton");
	x[0].disabled = true;
	x[0].style.color = '#a9a9a9';
	x[1].disabled = true;
	x[1].style.color = '#a9a9a9';
	x[2].disabled = true;
	x[2].style.color = '#a9a9a9';
	document.getElementById("pack").disabled = true;
}

enable = () => {
	setTimeout(() => {
		
		const x = document.getElementsByClassName("myButton");
		x[0].disabled = false;
		x[0].style.color = 'white';
		x[1].disabled = false;
		x[1].style.color = 'white';
		x[2].disabled = false;
		x[2].style.color = 'white';
		document.getElementById("pack").disabled = false;
		document.getElementById("load_gif").style.display = 'none';
		enableMenu();
	}, 700);
}