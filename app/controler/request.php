<?php
#####################################################################################
#	MIT License   -   Copyright 2019 Claus Lohmar
#
#	Permission is hereby granted, free of charge, to any person obtaining a copy of
#	this software and associated documentation files (the "Software"), to deal in the
#	Software without restriction, including without limitation the rights to use,
#	copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the
#	Software, and to permit persons to whom the Software is furnished to do so,
#	subject to the following conditions:
#
#	The above copyright notice and this permission notice shall be included in all
#	copies or substantial portions of the Software.
#
#	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
#	INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
#	PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
#	HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
#	OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
#	OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#####################################################################################
// inciate Demo


// ONLY 'do' IS ACCEPTED
// any incoming POST or GET is processed and submittet to the controler
// no direct database access and cleensing of data to avoid SQL injection

if(!empty($HTML_REQUEST['do'])){
	switch ($HTML_REQUEST['do']) {
//==========>> MENUE OPTIONS
		case 'access':
			$_SESSION['SITE']['apiToken']=$HTML_REQUEST['token'];
			$_SESSION['SITE']['datacenter']=$HTML_REQUEST['dc'];
			$_SESSION['SITE']['access']='true';
			header("Location:".$url_basic."home");exit;
			break;
		case 'one':
			$_SESSION['TRANSACTION']['MODEL']="M01";
			$_SESSION['TRANSACTION']["FORM"]['firstName']= $HTML_REQUEST['first-name'];
			$_SESSION['TRANSACTION']["FORM"]['lastName']= $HTML_REQUEST['last-name'];
			$_SESSION['TRANSACTION']["FORM"]['dateOfBirth']= $HTML_REQUEST['date-of-birth'];
			$_SESSION['TRANSACTION']["FORM"]['street']= $HTML_REQUEST['street'];
			$_SESSION['TRANSACTION']["FORM"]['city']= $HTML_REQUEST['city'];
			$_SESSION['TRANSACTION']["FORM"]['postcode']= $HTML_REQUEST['postcode'];
			$_SESSION['TRANSACTION']["FORM"]['country']= $HTML_REQUEST['country'];
			$_SESSION['TRANSACTION']["FORM"]['phone']= $HTML_REQUEST['phone'];
			$_SESSION['TRANSACTION']["FORM"]['email']= $HTML_REQUEST['email'];
			include(__ROOT__.'/app/model/M01.php');
			exit;
		break;

		case 'four':
			$_SESSION['TRANSACTION']['MODEL']="M04";
			$_SESSION['TRANSACTION']["FORM"]['firstName']= $HTML_REQUEST['first-name'];
			$_SESSION['TRANSACTION']["FORM"]['lastName']= $HTML_REQUEST['last-name'];
			$_SESSION['TRANSACTION']["FORM"]['dateOfBirth']= $HTML_REQUEST['date-of-birth'];
			$_SESSION['TRANSACTION']["FORM"]['street']= $HTML_REQUEST['street'];
			$_SESSION['TRANSACTION']["FORM"]['city']= $HTML_REQUEST['city'];
			$_SESSION['TRANSACTION']["FORM"]['postcode']= $HTML_REQUEST['postcode'];
			$_SESSION['TRANSACTION']["FORM"]['country']= $HTML_REQUEST['country'];
			$_SESSION['TRANSACTION']["FORM"]['phone']= $HTML_REQUEST['phone'];
			$_SESSION['TRANSACTION']["FORM"]['email']= $HTML_REQUEST['email'];
			include(__ROOT__.'/app/model/M04.php');
			exit;
		break;

		case 'login':
			include(__ROOT__.'/app/model/login.php');
			exit;
		break;

		case 'webauthn_register':
			$__oldDir = getcwd();
			chdir(__ROOT__ . '/class/blockid');
			require_once 'BIDTenant.php';
			require_once 'BIDWebAuthn.php';
			chdir($__oldDir);

			$tenantInfo = array(
				"dns"           => "blockid-trial.1kosmos.net",
				"communityName" => "devx",
				"licenseKey"    => "1b2f1624-6b7e-45e4-ba03-e0b32a0de074"
			);

			$currentDomain = parse_url($url_basic, PHP_URL_HOST);
		    $resultData = json_decode($HTML_REQUEST['result'] ?? '{}', true);

			$responseObj = $resultData['response'] ?? [];
			$responseObj['getAuthenticatorData'] = new stdClass();
			$responseObj['getPublicKey'] = new stdClass();
			$responseObj['getPublicKeyAlgorithm'] = new stdClass();
			$responseObj['getTransports'] = new stdClass();

			$clientExtResults = $resultData['getClientExtensionResults'] ?? [];
			$clientExtResultsObj = empty($clientExtResults) ? new stdClass() : $clientExtResults;

			$resultRequest = array(
				"rawId"       => $resultData['rawId'] ?? '',
				"response"    => $responseObj,
				"authenticatorAttachment" => $resultData['authenticatorAttachment'] ?? null,
				"getClientExtensionResults" => $clientExtResultsObj,
				"id"          => $resultData['id'] ?? '',
				"type"        => $resultData['type'] ?? '',
				"dns"         => $currentDomain
			);

			try {
				$attestationResult = BIDWebAuthn::submitAttestationResult($tenantInfo, $resultRequest);
				debug_log("BlockID WebAuthn register raw response", json_encode($attestationResult));
				echo json_encode($attestationResult, JSON_PRETTY_PRINT);
			} catch (Exception $e) {
				debug_log("BlockID WebAuthn register error", $e->getMessage());
				echo "Error: " . $e->getMessage();
			}
			exit;
		break;

		case 'verify_code':
			$__oldDir = getcwd();
			chdir(__ROOT__ . '/class/blockid');
			require_once 'BIDTenant.php';
			require_once 'BIDOTP.php';
			chdir($__oldDir);

			$tenantInfo = array(
				"dns"           => "blockid-trial.1kosmos.net",
				"communityName" => "devx",
				"licenseKey"    => "1b2f1624-6b7e-45e4-ba03-e0b32a0de074"
			);

			$submitted = trim($HTML_REQUEST['code'] ?? '');
			$email     = $_SESSION['SITE']['pending_email'] ?? '';

			try {
				$result = BIDOTP::verifyOTP($tenantInfo, $email, $submitted);
				debug_log("BlockID verify raw response", json_encode($result));

				if (!empty($result) && !isset($result['error_code']) && (($result['status'] ?? '') === 'true' || ($result['status'] ?? '') === true)) {
					$_SESSION['SITE']['access'] = 'true';
					header("Location:".$url_basic."dashboard");
					exit;
				} else {
					$_SESSION['SITE']['verify_error'] = 'Invalid or expired code. Please try again.';
					header("Location:".$url_basic."verify");
					exit;
				}
			} catch (Exception $e) {
				$_SESSION['SITE']['verify_error'] = 'Verification failed. Please try again.';
				debug_log("BlockID verify error", $e->getMessage());
				header("Location:".$url_basic."verify");
				exit;
			}
		break;

		case 'reset':
			include(__ROOT__.'/app/model/reset.php');
			exit;
		break;

		case 'pwless':
			include(__ROOT__.'/app/model/pwless.php');
			exit;
		break;

		case 'callback':
			echo "callback";
			#include(__ROOT__.'/app/model/callback.php');
			#header("Location:".$redirect_url);
			exit;
		break;

		case 'success':
			$_SESSION['TRANSACTION']["RETURN_2"]['accountId']= $HTML_REQUEST['accountId'];
			$_SESSION['TRANSACTION']["RETURN_2"]['acquisitionStatus']= $HTML_REQUEST['acquisitionStatus'];
			$_SESSION['TRANSACTION']["RETURN_2"]['customerInternalReference']= $HTML_REQUEST['customerInternalReference'];
			$_SESSION['TRANSACTION']["RETURN_2"]['workflowExecutionId']= $HTML_REQUEST['workflowExecutionId'];
			include(__ROOT__.'/app/model/success.php');
			exit;
		break;

		case 'error':
			$_SESSION['TRANSACTION']["RETURN_2"]['accountId']= $HTML_REQUEST['accountId'];
			$_SESSION['TRANSACTION']["RETURN_2"]['acquisitionStatus']= $HTML_REQUEST['acquisitionStatus'];
			$_SESSION['TRANSACTION']["RETURN_2"]['customerInternalReference']= $HTML_REQUEST['customerInternalReference'];
			$_SESSION['TRANSACTION']["RETURN_2"]['workflowExecutionId']= $HTML_REQUEST['workflowExecutionId'];
			$_SESSION['TRANSACTION']["RETURN_2"]['errorCode']= $HTML_REQUEST['errorCode'];
			debug_log("Jumio Request Error",$HTML_REQUEST);
			$error_msg=ERROR_404;
			include(__ROOT__.'/app/view/_header.phtml');
			include(__ROOT__.'/app/view/page_error.phtml');
			include(__ROOT__.'/app/view/_footer.phtml');
			exit;
		break;
//==========>>
		default:
		echo "oh shit";
			#debug_log("Request Wrong",$HTML_REQUEST);
			#session_unset();
			#session_destroy();
			#$_SESSION = array();
			#header('Location: '.$url_basic);
			exit;
	}
} else {
		debug_log("Request Error",$HTML_REQUEST);
		session_unset();
		session_destroy();
		$_SESSION = array();
		header('Location: '.$url_basic);
		exit;
}

#echo '<hr>'.json_encode($_SESSION, JSON_PRETTY_PRINT).'<hr>';exit;

?>