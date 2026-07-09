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
#echo 'empty session ';echo '<hr>'.json_encode($_SESSION, JSON_PRETTY_PRINT).'<hr>';exit;
/// Set default timezone
	date_default_timezone_set('UCT');

//==============================================================================
	$tmp=explode('.', $_SERVER['HTTP_HOST']);
	$modus = array_shift(($tmp));
	if($modus == 'dev'){define('DEBUG',TRUE);}else{define('DEBUG',FALSE);}
	define('__ROOT__', dirname(dirname(__FILE__)));

	
// API Credentials for IDV
	$api_key = '2b2i83jup3eu2tr3tn581kl2dc';
	$api_secret = '1vat6laeka5gv8riltk1j0hqlguo80bue3q6gvrnk9u3f2adl39i';
	$api_token = base64_encode($api_key . ":" . $api_secret);
	define( 'API_URL' , 'emea-1.jumio.ai');
	define( 'API_TOKEN' , $api_token);
