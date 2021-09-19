<script>
window.onscroll = () => {scrolla()};

scrolla = () => {
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
			document.getElementById("mainmenu").style.display = "none";
		} else {
			document.getElementById("mainmenu").style.display = "block";
		}
	}
}
</script>

<script>
document.getElementById("myInput").onsearch = () => {
	myFunction();
}
</script>