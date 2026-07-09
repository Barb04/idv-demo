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
