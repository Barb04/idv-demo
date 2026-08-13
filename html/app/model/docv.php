<?php
$_SESSION['TRANSACTION']['MODEL']='-M01';
$guid = strtoupper(bin2hex(openssl_random_pseudo_bytes(16)));
// Format the time in the specified format
$now = new DateTime();
$time = $now->format('Y-m-d\TH:i:s');
$consentTimeNow = $time . '.000Z';
$access_token = oAuth();

# === iniciate the transaction
# -- prepare the API request
$request_body ='{
   	"workflowDefinition": {
  		"key": "10055",
      "credentials": [{
          "category": "DOCUMENT",
          "country": {
            "predefinedType": "DEFINED",
            "values": ["GBR"]
            },
          "type": {
            "predefinedType": "DEFINED",
          "values": ["UB"]
          }
        }]
  	},
  	"customerInternalReference": "'.$guid.'",
  	"userReference": "'.$guid.'",
  	"reportingCriteria":"Jumio Web App",
  	"callbackUrl": "'.$_SESSION['SITE']['site_url'].'?do=callback",
  	"tokenLifetime": "90m",
    "web":{
      "successUrl":"'.$_SESSION['SITE']['site_url'].'?do=success",
      "errorUrl":"'.$_SESSION['SITE']['site_url'].'?do=error"
    },
  	"userConsent": {
      "userIp": "'.$_SERVER['REMOTE_ADDR'].'",
      "userLocation": {
          "country": "GBR",
          "state": ""
      },
       "consent": {
        "obtained": "yes",
        "obtainedAt": "'.$consentTimeNow.'"
      },
      "privacyPolicy": {
        "read": "yes",
        "readAt": "'.$consentTimeNow.'"
      }
  }
}';

	$curl = curl_init();
	curl_setopt_array($curl, [
	  CURLOPT_URL => "https://account.".$_SESSION['SITE']['datacenter']."/api/v1/accounts",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => $request_body,
	  CURLOPT_HTTPHEADER => [
	    "Authorization: Bearer ". $access_token ,
	    "Content-Type: application/json",
	    "User-Agent: Jumio SE Testing"
	  ],
	]);
	$response_json = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
echo $response_json;
	if ($err) {
    $_SESSION['SITE']['ERROR']="cURL Error #:" . $err;
    $_SESSION['SITE']['ERROR']['API']=array();
    $_SESSION['SITE']['ERROR']['API']=$response_json;
    debug_log("API ERROR",json_encode($_SESSION, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ));
    $error_msg=ERROR_501;
    include(__ROOT__.'/app/view/_header.phtml');
    include(__ROOT__.'/app/view/page_error.phtml');
    include(__ROOT__.'/app/view/_footer.phtml');
	} else {
		$iniciate=array();
		$iniciate=json_decode($response_json,TRUE);
	}
  $redirect_url = $iniciate["web"]["href"];
  header("Location:".$redirect_url);
  //====================================================
  #echo '<hr>'.json_encode($_SESSION, JSON_PRETTY_PRINT).'<hr>';
  exit;
