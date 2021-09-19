<style>

.tooltip2 {
    position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
  cursor:pointer;
}

.tooltip2 .tooltiptext2 {
  visibility: hidden;
  width: 150px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  top: 100%;
  left: 50%;
  margin-left: -75px;
}



.tooltip2:hover .tooltiptext2 {
  visibility: visible;
  opacity: 1;
}

@media only screen and (max-width: 996px) {
	
	#resp::before {
	  content: "\A";
	  white-space: pre;
	}

	.tit {
		font-size: 1.8rem;
	}
}
</style>

<script>
copy2 = (input,tool) => {
  const copyText = document.getElementById(input);
  copyText.style.display = "";
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  copyText.style.display = "none";
  
  const tooltip = document.getElementById(tool);
  tooltip.innerHTML = "Copiato!";
  
  if (document.activeElement) {
	  document.activeElement.blur();
  }
    
}

outFunc2 = (tool) => {
  const tooltip = document.getElementById(tool);
  tooltip.innerHTML = "Copia URL negli appunti";
}

download = (id) => {
	window.location.href="?id="+id;
}
</script>