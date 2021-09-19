disableMenu = () => {
	const x = document.querySelectorAll('a');
	
	for (let i = 0; i < x.length; i++) {
		x[i].href = "javascript:void(0);";
	}
	
	document.getElementById("last_selected").disabled = true;
	document.getElementById("last_selected").style.color = '#a9a9a9';
	
}

clearData = () => {
	const a = window.confirm('Confermi di voler cancellare la cronologia ?');
	
	if (a == true) {
		disableMenu();
		location.href='?clearData';
	} else {
		return false;
	}
	
}

deleteHistory = (myid) => {
	
	const a = window.confirm('Confermi di cancellare la riga ?')
	
	if (a == true) {
		disableMenu();
		$.post("history.php", {id:myid}, function(data){
			if(data == 'OK')
				location.reload();
			else {
				alert('Errore');
				location.reload();
			}
		});
	} else {
		return false;
	}
	
	
}