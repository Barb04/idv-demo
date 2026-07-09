<?php
	if (!empty($HTML_REQUEST['email'])) {
		$email = $HTML_REQUEST['email'];

		$stamp = gmdate(DATE_ATOM);
		$log = '{"timestamp":"' . $stamp . '","event":"reset","email":"' . $email . '"}' . PHP_EOL;

		$filename = gmdate("Ym") . '_access.log';
		$file = __ROOT__ . '/log/' . $filename;
		file_put_contents($file, $log, FILE_APPEND);
	}

	$url_basic = $_SESSION['SITE']['site_url'];
	header('Location: ' . $url_basic . 'results');
	exit;
