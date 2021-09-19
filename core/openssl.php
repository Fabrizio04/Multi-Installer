<?php
function encrypt_decrypt($action, $string, $file) {
	
	$output = false;
	$encrypt_method = "AES-256-CBC";
	
	$f = fopen($file, 'r');
	$line = fgets($f);
	fclose($f);
	
	$secret_key = substr($line,0,64);
	$secret_iv =  substr($line,64,64);
	
	// hash
	$key = hash('sha256', $secret_key);    
	// iv - encrypt method AES-256-CBC expects 16 bytes 
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if( $action == 'decrypt' ) {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
}