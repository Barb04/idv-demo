<?php
$__oldDir = getcwd();
chdir(__ROOT__ . '/class/blockid');
require_once 'BIDTenant.php';
require_once 'BIDVerifyDocument.php';
chdir($__oldDir);

$tenantInfo = array(
    "dns"           => "blockid-trial.1kosmos.net",
    "communityName" => "devx",
    "licenseKey"    => "1b2f1624-6b7e-45e4-ba03-e0b32a0de074"
);

$dvcId = "devx_1d96626a-deb3-4b57-99d4-5e08ea2d59db";
$documentType = "dl_object";

try {
    $sessionResponse = BIDVerifyDocument::createDocumentSession($tenantInfo, $dvcId, $documentType);
    debug_log("BlockID IDVerify session raw response", json_encode($sessionResponse));

    $_SESSION['TRANSACTION']['idverify_response'] = $sessionResponse;

    include(__ROOT__.'/app/view/_header.phtml');
    include(__ROOT__.'/app/view/page_idverify.phtml');
    include(__ROOT__.'/app/view/_footer.phtml');
} catch (Exception $e) {
    debug_log("BlockID IDVerify error", $e->getMessage());
    $error_msg = "Something went wrong starting identity verification. Please try again.";
    include(__ROOT__.'/app/view/_header.phtml');
    include(__ROOT__.'/app/view/page_error.phtml');
    include(__ROOT__.'/app/view/_footer.phtml');
}
exit;