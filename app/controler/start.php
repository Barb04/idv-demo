<?php
if (!empty($PARAMS['1'])) {
	switch ($PARAMS['1']) {
//==========>> MENUE OPTIONS
		case 'home':
		  include(__ROOT__.'/app/view/_header.phtml');
			include(__ROOT__.'/app/view/page_home.phtml');
			include(__ROOT__.'/app/view/_footer.phtml');
		break;
		case 'one':
		$_SESSION['TRANSACTION']=array();
		$_SESSION['TRANSACTION']["RETURN_1"]=array();
		$_SESSION['TRANSACTION']["RETURN_2"]=array();
		$_SESSION['TRANSACTION']["RETRIVAL_1"]=array();
		$_SESSION['TRANSACTION']["RETRIVAL_2"]=array();
		  include(__ROOT__.'/app/view/_header.phtml');
			include(__ROOT__.'/app/view/page_01.phtml');
			include(__ROOT__.'/app/view/_footer.phtml');
		break;
		case 'two':
		$_SESSION['TRANSACTION']=array();
		$_SESSION['TRANSACTION']['status']='';
		$_SESSION['TRANSACTION']["RETURN_1"]=array();
		$_SESSION['TRANSACTION']["RETURN_2"]=array();
		$_SESSION['TRANSACTION']["RETRIVAL_1"]=array();
		$_SESSION['TRANSACTION']["RETRIVAL_2"]=array();
		  include(__ROOT__.'/app/view/_header.phtml');
		  include(__ROOT__.'/app/view/page_02.phtml');
			include(__ROOT__.'/app/view/_footer.phtml');
		break;
		case 'three':
		$_SESSION['TRANSACTION']=array();
		$_SESSION['TRANSACTION']['status']='';
		$_SESSION['TRANSACTION']["RETURN_1"]=array();
		$_SESSION['TRANSACTION']["RETURN_2"]=array();
		$_SESSION['TRANSACTION']["RETRIVAL_1"]=array();
		$_SESSION['TRANSACTION']["RETRIVAL_2"]=array();
		  include(__ROOT__.'/app/view/_header.phtml');
		  include(__ROOT__.'/app/view/page_03.phtml');
			include(__ROOT__.'/app/view/_footer.phtml');
		break;
		case 'four':
		$_SESSION['TRANSACTION']=array();
		$_SESSION['TRANSACTION']['status']='';
		$_SESSION['TRANSACTION']["RETURN_1"]=array();
		$_SESSION['TRANSACTION']["RETURN_2"]=array();
		$_SESSION['TRANSACTION']["RETRIVAL_1"]=array();
		$_SESSION['TRANSACTION']["RETRIVAL_2"]=array();
		  include(__ROOT__.'/app/view/_header.phtml');
		  include(__ROOT__.'/app/view/page_04.phtml');
			include(__ROOT__.'/app/view/_footer.phtml');
		break;

		case 'dashboard':
include(__ROOT__.'/app/view/_header.phtml');
include(__ROOT__.'/app/view/page_dashboard.phtml');
include(__ROOT__.'/app/view/_footer.phtml');
break;

case 'reset-confirm':
    $__oldDir = getcwd();
    chdir(__ROOT__ . '/class/blockid');
    require_once 'BIDTenant.php';
    require_once 'BIDAccessCodes.php';
    chdir($__oldDir);

    $tenantInfo = array(
        "dns"           => "blockid-trial.1kosmos.net",
        "communityName" => "devx",
        "licenseKey"    => "1b2f1624-6b7e-45e4-ba03-e0b32a0de074"
    );

    $code = $PARAMS[2] ?? '';
    $resetResult = null;
    $resetError = null;

    if (!empty($code)) {
        try {
            $resetResult = BIDAccessCode::verifyAndRedeemEmailVerificationCode($tenantInfo, $code);
            debug_log("BlockID reset redeem raw response", json_encode($resetResult));
        } catch (Exception $e) {
            $resetError = $e->getMessage();
            debug_log("BlockID reset redeem error", $e->getMessage());
        }
    }

    include(__ROOT__.'/app/view/_header.phtml');
    include(__ROOT__.'/app/view/page_reset_confirm.phtml');
    include(__ROOT__.'/app/view/_footer.phtml');
break;

		case 'verify':
include(__ROOT__.'/app/view/_header.phtml');
include(__ROOT__.'/app/view/page_verify.phtml');
include(__ROOT__.'/app/view/_footer.phtml');
break;
		case 'results':
		include(__ROOT__.'/app/view/_header.phtml');
		include(__ROOT__.'/app/view/results.phtml');
		include(__ROOT__.'/app/view/_footer.phtml');
		break;
//==========>> FUNCTIONAL OPTIONS
		case 'dev':
				include(__ROOT__.'/app/controler/dev.php');
		break;

		case 'clear':
			$url_basic=$_SESSION['SITE']['site_url'];
			$_SESSION=array();
			header('Location: '.$url_basic);

			break;
//==========>>
		default:
			debug_log("URI WRONG",$_SERVER['REQUEST_URI']);
			$error_msg=ERROR_404;
			include(__ROOT__.'/app/view/_header.phtml');
			include(__ROOT__.'/app/view/page_error.phtml');
			include(__ROOT__.'/app/view/_footer.phtml');
	}

} else {
	$_SESSION=array();
	include(__ROOT__.'/app/view/_header.phtml');
	include(__ROOT__.'/app/view/page_home.phtml');
	include(__ROOT__.'/app/view/_footer.phtml');
}
