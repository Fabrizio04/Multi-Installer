myFunction = () => {
    let input, filter, ul, li, a;
	
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
	
    for (let i = 0; i < li.length; i++) {
		
        a = li[i].getElementsByTagName("a")[0];
		
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

resetSearch = () => {
	document.getElementById("myInput").value = '';
	myFunction();
}

stop = (event) => {
	
	const x = event.which || event.keyCod;
	
	if (x == 13){
		return false;
	}
	
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

window.onload = () => {cleanALL()};

cleanALL = () => {
	let i;
	
	for (i = 1; i < 81; i++) {
		if(document.getElementById(i.toString()) != null){
			
			document.getElementById(i.toString()).checked = false;
			const id2 = "scelta"+i.toString();
			document.getElementById(id2).style.backgroundColor = '';
		}
	}
}

ultimo = () => {
	location.href="download.php";
	return false;
}

disableMenu = () => {
	const x = document.querySelectorAll('a');
	
	for (let i = 0; i < x.length; i++) {
		x[i].href = "javascript:void(0);";
	}
	
	document.getElementById("myInput").disabled = true;
}

loading = () => {
	document.getElementById("myUL").style.display = "none";
	document.getElementById("load_gif").style.display = "";
}