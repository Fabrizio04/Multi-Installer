disableMenu = () => {
	const x = document.querySelectorAll('a');
	
	x[1].href = "javascript:void(0);";
	x[2].href = "javascript:void(0);";
	x[4].href = "javascript:void(0);";
	x[5].href = "javascript:void(0);";
	x[6].href = "javascript:void(0);";
	x[8].href = "javascript:void(0);";
	x[9].href = "javascript:void(0);";
	x[10].href = "javascript:void(0);";
	x[11].href = "javascript:void(0);";
	x[12].href = "javascript:void(0);";
	x[13].href = "javascript:void(0);";
	
	x[15].href = "javascript:void(0);";
	x[17].href = "javascript:void(0);";
	x[18].href = "javascript:void(0);";
	x[20].href = "javascript:void(0);";
	x[21].href = "javascript:void(0);";

	x[23].href = "javascript:void(0);";
	x[24].href = "javascript:void(0);";
	x[25].href = "javascript:void(0);";
	
	x[27].href = "javascript:void(0);";
}

enableMenu = () => {
	const x = document.querySelectorAll('a');
	
	x[1].href = "./";
	x[2].href = "./pack.php";
	x[4].href = "./wizard.php";
	x[5].href = "./wizard-pack.php";
	x[6].href = "./filemanager.php";
	x[8].href = "./setup.php";
	x[9].href = "./firma.php";
	x[10].href = "./history.php";
	x[11].href = "./server.php";
	x[12].href = "./reset.php";
	x[13].href = "https://github.com/Fabrizio04/Multi-Installer";
	
	x[15].href = "./get_file.php?id=2";
	x[17].href = "./get_file.php?id=5";
	x[18].href = "./get_file.php?id=6";
	x[20].href = "./get_file.php?id=3";
	x[21].href = "./get_file.php?id=4";

	x[23].href = "https://multi-installer.it";
	x[24].href = "./info.php";
	x[25].href = "./licenza.php";
	
	x[27].href = "./Multinstaller.pdf";
}