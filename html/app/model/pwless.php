<?php
	$stamp = gmdate(DATE_ATOM);
	$log = '{"timestamp":"' . $stamp . '","event":"pwless","user_ip":"' . $_SESSION['SITE']['client_ip'] . '"}' . PHP_EOL;

	$filename = gmdate("Ym") . '_access.log';
	$file = __ROOT__ . '/log/' . $filename;
	file_put_contents($file, $log, FILE_APPEND);

	$url_basic = $_SESSION['SITE']['site_url'];
	header('Location: ' . $url_basic . 'results');
	exit;
