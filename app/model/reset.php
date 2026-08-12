<?php
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

if (!empty($HTML_REQUEST['email'])) {
    $email = $HTML_REQUEST['email'];
    $_SESSION['SITE']['pending_email'] = $email;

   $emailTemplate = "Click the link below to recover your account access.\n\n"
        . $_SESSION['SITE']['site_url'] . "reset-confirm/{{MAGICLINK}}\n\n"
        . "This link will expire soon.";
    $emailTemplateB64 = base64_encode($emailTemplate);
    $emailSubject = "Your 1Kosmos Demo Account Recovery Link";

    try {
        $linkResponse = BIDAccessCode::requestEmailVerificationLink($tenantInfo, $email, $emailTemplateB64, $emailSubject, "idv-demo", null);
        debug_log("BlockID recovery link raw response", json_encode($linkResponse));
        $_SESSION['SITE']['mail_status'] = 'sent';
    } catch (Exception $e) {
        $_SESSION['SITE']['mail_status'] = 'failed';
        debug_log("BlockID recovery link error", $e->getMessage());
    }
}

$url_basic = $_SESSION['SITE']['site_url'];
header('Location: ' . $url_basic . 'two');
exit;