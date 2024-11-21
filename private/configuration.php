<?php
define ('PAGELIMIT','20');
define ("TITLE","Pharma Health");
define ("SITE_NAME","Pharma Health");

//

if (preg_match('/localhost/', $_SERVER['HTTP_HOST'])) 
{
define ("DB_HOST","localhost");
define ("DB_NAME", "pharmahealth-2024");
define ("DB_USER", "root");
define ("DB_PASS","");
}
else
{
define ("DB_HOST","localhost");
define ("DB_NAME", "webproje_pharmahealth");
define ("DB_USER", "webproje_dev");
define ("DB_PASS","pwd!2000");
}

?>