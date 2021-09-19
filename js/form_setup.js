const form = document.forms.namedItem("formsetup");

form.addEventListener('submit', (ev) => {
	const uac = document.getElementById('suac').checked;
	const conn = document.getElementById('scon').checked;
	const tipo = document.getElementsByName('fil');
	const arch = document.getElementsByName('arch');
	
	if(uac == true)
		setCookie("uac","on");
	else
		setCookie("uac","off");
	
	if(conn == true)
		setCookie("connect","on");
	else
		setCookie("connect","off");
	
	
	for(let i = 0; i < 2; i+=1){
		if(tipo[i].checked == true){
			setCookie("tipo",tipo[i].value);
		}
	}
	
	for(let i = 0; i < 3; i+=1){
		if(arch[i].checked == true){
			setCookie("arch",arch[i].value);
		}
	}
	
	document.getElementById('messaggio').innerHTML = 'Impostazioni salvate! <span style="cursor:pointer;" title="Chiudi" onclick="document.getElementById(\'messaggio\').innerHTML=\'\';"><i class="fa fa-times" aria-hidden="true"></i></span>';
	ev.preventDefault();

}, false);

if(getCookie('uac') == ""){
	document.getElementById('suac').checked = true;
	document.getElementById('uac').style.backgroundColor = '#bfbebe';
} else {
	if(getCookie('uac') == "on"){
		document.getElementById('suac').checked = true;
		document.getElementById('uac').style.backgroundColor = '#bfbebe';
	} else {
		document.getElementById('suac').checked = false;
		document.getElementById('uac').style.backgroundColor = '#eee';
	}
}

if(getCookie('connect') == ""){
	document.getElementById('scon').checked = true;
	document.getElementById('conn').style.backgroundColor = '#bfbebe';
} else {
	if(getCookie('connect') == "on"){
		document.getElementById('scon').checked = true;
		document.getElementById('conn').style.backgroundColor = '#bfbebe';
	} else {
		document.getElementById('scon').checked = false;
		document.getElementById('conn').style.backgroundColor = '#eee';
	}
}