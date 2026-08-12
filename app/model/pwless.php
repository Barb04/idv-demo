<?php
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

$email = $_SESSION['SITE']['pending_email'] ?? 'demo-user';
$currentDomain = parse_url($_SESSION['SITE']['site_url'], PHP_URL_HOST);

$optionsRequest = array(
    "displayName" => $email,
    "username"    => $email,
    "dns"         => $currentDomain,
    "attestation" => "none",
    "authenticatorSelection" => array(
        "authenticatorAttachment" => "platform"
    )
);

try {
    $attestationOptions = BIDWebAuthn::fetchAttestationOptions($tenantInfo, $optionsRequest);
    debug_log("BlockID WebAuthn options raw response", json_encode($attestationOptions));
    $_SESSION['SITE']['webauthn_options'] = $attestationOptions;

    include(__ROOT__.'/app/view/_header.phtml');
    include(__ROOT__.'/app/view/page_webauthn.phtml');
    include(__ROOT__.'/app/view/_footer.phtml');
} catch (Exception $e) {
    debug_log("BlockID WebAuthn options error", $e->getMessage());
    $error_msg = "Something went wrong starting passwordless registration.";
    include(__ROOT__.'/app/view/_header.phtml');
    include(__ROOT__.'/app/view/page_error.phtml');
    include(__ROOT__.'/app/view/_footer.phtml');
}
exit;