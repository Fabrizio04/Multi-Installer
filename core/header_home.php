<style>

.main {
	margin: auto;
	padding-top: <?php if (isset($_SESSION['filename'])) echo '320px;'; else echo '265px'; ?>;
	padding-bottom: 15px;
	width: 90%;
}

#rec_avv {
	
	display:block;
}

#messaggio {
	
	display:none;
}


@media only screen and (min-width:997px){
	.main {
		margin: auto;
		width: 75%;
		padding-top: 210px;
		padding-bottom: 15px;
	}
	
	#rec_avv {
		display:none;
	}
	
	#messaggio {
		display:block;
	}
}

</style>

<script src="js/fabri.js"></script>

<script type="text/javascript">
controlla = () => {
	let conta = 0;
	
	const x = document.getElementById("sub");
	const y = document.getElementById("res");
	
	const mycheck = document.querySelectorAll("input[type='checkbox']");
	
	
	
	for(i = 0; i < mycheck.length; i+=1){
		if(mycheck[i].checked == true)
			conta+=1;
	}
	
	
	if (conta == 0) return false;
	
	else {
		loading();
			
		x.disabled = true;
		x.style.color = '#a9a9a9';
		y.disabled = true;
		y.style.color = '#a9a9a9';
		<?php if (isset($_SESSION['filename'])) : ?>
		document.getElementById("last_selected").disabled = true;
		document.getElementById("last_selected").style.color = '#a9a9a9';
		<?php endif; ?>
		disableMenu();
		return true;
	}
}
</script>