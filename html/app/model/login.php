<?php
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

if (!empty($HTML_REQUEST['email'])) {
    $email = $HTML_REQUEST['email'];
    $_SESSION['SITE']['pending_email'] = $email;

    try {
        $otpResponse = BIDOTP::requestOTP($tenantInfo, $email, $email, null, null);
        debug_log("BlockID OTP raw response", json_encode($otpResponse));
        $_SESSION['SITE']['mail_status'] = 'sent';
    } catch (Exception $e) {
        $_SESSION['SITE']['mail_status'] = 'failed';
        debug_log("BlockID OTP error", $e->getMessage());
    }
}

$url_basic = $_SESSION['SITE']['site_url'];
header('Location: ' . $url_basic . 'verify');
exit;