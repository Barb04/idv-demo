<?php
# GB_en language file
// SITE META
define('SITE_NAME', 'iovation wallet demonstration');
define('SITE_DESCRIPTION', 'This is a demonstration of an digital wallet build byiovation inc.');
define('SITE_AUTHOR', 'iovation inc.');
define('SITE_KEYWORDS', 'iovation,wallet,device,demo,test');
// NAVIGATION
define('URL_HOME',    'home');
define('URL_LINK_1',  'wallet');
define('URL_LINK_2',  'fraud force');
define('URL_LINK_3',  'link page');
define('URL_LINK_4',  'link page');
define('X', 'xxx');
//==========>>
// == PAGES
// == HOME
define('HOME_TITLE', 'HOME_TITLE');
define('HOME_CONTENT', 'HOME_CONTENT');
// == PAGE_LINK
define('PAGE_LINK_TITLE', 'PAGE_LINK_TITLE');
define('PAGE_LINK_CONTENT', 'PAGE_LINK_CONTENT');
//==========>>

define('WALLET_TOP_UP_TITLE','Your e-wallet by iovation');
define('WALLET_TOP_UP_CONTENT_1','Provide your login credential and the amount you wish to top-up.');
define('WALLET_TOP_UP_CONTENT_2', '
<p>You need to provide mock-up login credentials. You can use your email or invent an email but please ensue that you can remember the email and use the same email during testing. The email provide is converted in to a GDPR compliant fingerprint and stored on iovations servers. We use the email only as an account identifier.
You can invent a password and don`t need to remember this, we are not useing password verification for this mock-up demonstration.</p>
<p>
<h5>You can controle the result of the fraud screening.</h5><br>
Any amount below <b>100.00</b> will result in <b>ALLOWED</b>.<br>
Any amount between <b>100.01</b> and <b>199.99</b> will result in <b>REVIEW</b><br>
Any amount over <b>200.00</b> will result in <b>DENIED</b><br>
</p>
');
//==========>>

define('WALLET_CHECKOUT_A_TITLE','Card Payment');
define('WALLET_CHECKOUT_A_CONTENT_1','This was a <b>low risk transaction</b>, therefore no liability shift through 3D secure is required.');
define('WALLET_CHECKOUT_A_CONTENT_2','
<p>Please provide a credit card number for testing. This can be any random number of 16 digits.For the card expiry date,
take any date from 2019 to 2029 and 4 random digits for the CVV number.</p>'
);
define('WALLET_CHECKOUT_AMT_FINAL', 'You will top up ');
define('WALLET_CHECKOUT_SUBMIT', 'execute top up');

//==========>>

define('WALLET_CHECKOUT_D_TITLE', 'SEPA Instant Bank Payment');
define('WALLET_CHECKOUT_D_CONTENT_1','This was a <b>high risk transaction</b>, therefore only SEPA instant bank payment is offerd.');
define('WALLET_CHECKOUT_D_CONTENT_2','
<p>Please provide a  IBAN number for testing. This can be any random number of 16 digits.</p>'
);
//==========>>

define('WALLET_CHECKOUT_R_TITLE', 'Card Payment');
define('WALLET_CHECKOUT_R_CONTENT_1','This was a <b>medium risk transaction</b>, therefore a liability shift through <b>3D secure</b> is initiated.');
define('WALLET_CHECKOUT_R_CONTENT_2','
<p>Please provide a credit card number for testing. This can be any random number of 16 digits.For the card expiry date,
take any date from 2019 to 2029 and 4 random digits for the CVV number.</p>'
);
//==========>>
