<?php
define('BASEURL',$_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/');
define('CART_COOKIE', 'SBwi72UCKlwiqzz2');
define('CART_COOKIE_EXPIRE', time() + (86400 * 30));
define('TAXRATE', 0.04);

define('CURRENCY', 'usd');
define('CHECKOUTMODE','TEST');

if(CHECKOUTMODE =='TEST')
{
  define('STRIPE_PRIVATE','sk_test_ipdnCQXQlfQjmKnFOjbemRVw');
  define('STRIPE_PUBLIC', 'pk_test_scbi25IjuxlAjYgwLfArDtcY');

}
