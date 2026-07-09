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

if (!empty($PARAMS['2'])) {
  if (DEBUG) {
	switch ($PARAMS['2']) {
		case 'test':
			include(__ROOT__.'/app/view/dev_test.html');
			break;

		case 'clear':
			session_unset();
			session_destroy();
			$_SESSION = array();
			echo 'session clear success!<hr>';echo json_encode($_SESSION, JSON_PRETTY_PRINT);
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

} else {
	$_SESSION=array();
	include(__ROOT__.'/app/view/_header.phtml');
	include(__ROOT__.'/app/view/page_home.phtml');
	include(__ROOT__.'/app/view/_footer.phtml');
}
