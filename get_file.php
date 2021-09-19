<?php
require_once './core/config.inc.php';
require_once './core/ForceDownload.class.php';

if (isset($_GET['id'])){
	
	$type = "file";
	
	switch($_GET['id']){
		case 2: $type = "url"; $url = "https://download.visualstudio.microsoft.com/download/pr/7afca223-55d2-470a-8edc-6a1739ae3252/abd170b4b0ec15ad0222a809b761a036/ndp48-x86-x64-allos-enu.exe"; break;
		case 3: $dir = "./vc/"; $file = "visual_08.zip"; break;
		case 4: $dir = "./vc/"; $file = "visual_15-19.zip"; break;
		case 5: $type = "url"; $url = "https://download.visualstudio.microsoft.com/download/pr/c089205d-4f58-4f8d-ad84-c92eaf2f3411/5cd3f9b3bd089c09df14dbbfb64124a4/windowsdesktop-runtime-5.0.5-win-x86.exe"; break;
		case 6: $type = "url"; $url = "https://download.visualstudio.microsoft.com/download/pr/c1ef0b3f-9663-4fc5-85eb-4a9cadacdb87/52b890f91e6bd4350d29d2482038df1c/windowsdesktop-runtime-5.0.5-win-x64.exe"; break;
	}
	
	switch($type){
		case "file":
			$download = New ForceDownload($dir, $file);
			$download->download() or die ($download->get_error());
			break;
		case "url":
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-disposition: attachment; filename=\"" . basename($url) . "\""); 
			header("Content-Transfer-Encoding: binary");
			readfile($url);
			break;
	}
	
	
} else header("Location: ./");