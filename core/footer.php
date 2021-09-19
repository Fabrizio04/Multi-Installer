<script src="js/jquery.min.js"></script>
<script src="js/nav.jquery.min.js"></script>
<script>
    $('.nav').nav();
</script>

<script src="vid/modal-video.min.js"></script>
<script>
	$(".js-video-button").modalVideo({channel:'vimeo'});
	$(".js-video-button-2").modalVideo();
</script>

<script src="modal/jquery.modal.min.js"></script>

<script>
m_close = () => {
	
	 const w = window.innerWidth;
	 const x = document.getElementsByClassName("nav-button");
	
	//if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	  if (w < 997) {
		  x[0].click();
	  }
	//}
}

copy = () => {
  const textarea = document.getElementById("textarea");
  textarea.select();
  document.execCommand("copy");
  
  const tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copiato!";
}

outFunc = () => {
  const tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Clicca per copiare";
}
</script>

<script id="rendered-js">
$(window).scroll(function () {
  if ($(this).scrollTop() >= 50) {
    $('#return-to-top').fadeIn(200);
  } else {
    $('#return-to-top').fadeOut(200);
  }
});
$('#return-to-top').click(function () {
  $('body,html').animate({
    scrollTop: 0
  }, 500);
});
</script>