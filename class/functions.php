<?php
//====================================================
function debug_log($log_point,$log_data) {
	$stamp= gmdate(DATE_ATOM);
	$log	= '{"Timestamp":"'.$stamp.'","TRANSACTION":'.json_encode($_SESSION['TRANSACTION']).', "'.$log_point.'":"'.$log_data.'"}';
	$filename = gmdate("Ym").'.log';
	$file = __ROOT__.'/log/'.$filename;
	if (DEBUG) {file_put_contents($file,$log. PHP_EOL,FILE_APPEND);}
}
//====================================================
function oAuth(){
	# === get oAuth token
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => "https://auth.".$_SESSION['SITE']['datacenter']."/oauth2/token",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "grant_type=client_credentials",
	    CURLOPT_HTTPHEADER => [
	    "Authorization: Basic ".$_SESSION['SITE']['apiToken'],
	    "Content-Type: application/x-www-form-urlencoded",
	    "User-Agent: ACME Payments testing"
	  ],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	if ($err) {
		$result='error';
		$_SESSION['SITE']['ERROR']="cURL Error #:" . $err;
	  $_SESSION['SITE']['ERROR']['API']=array();
	  $_SESSION['SITE']['ERROR']['API']=$response;
	} else {
		$oAuth = array();
		$oAuth = json_decode($response,TRUE);
	}
	return $oAuth["access_token"];
}
