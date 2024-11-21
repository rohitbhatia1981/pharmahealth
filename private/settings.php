<?php session_start();
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

date_default_timezone_set('Europe/London');

if (preg_match('/localhost/', $_SERVER['HTTP_HOST'])) 
{
define("URL","http://{$_SERVER['SERVER_NAME']}/pharmahealth-dev/");
define("PATH","{$_SERVER['DOCUMENT_ROOT']}/pharmahealth-dev/");
}
else
{
define("URL","https://{$_SERVER['SERVER_NAME']}/projects/pharmahealth-dev/");
define("PATH","{$_SERVER['DOCUMENT_ROOT']}/projects/pharmahealth-dev/");
}


include_once(PATH."private/filenames.php");
include_once(PATH."private/configuration.php");

require_once( PATH.'classes/class.db.php' );
$database = new DB();

require_once( PATH.'classes/class_thumbnails.php' );
$image = new Thumbnail();

require_once(PATH."classes/pagination.php");
$pagingObject = new pagingRecords();

include_once(PATH."includes/front-common-functions.php");

//$loadSettingsData=$database->get_results("select * from tbl_settings");
//$resultSettingsData = $loadSettingsData[0];




//$loadSettingsData=$database->get_results("select * from tbl_settings");

//$resultSettingsData = $loadSettingsData[0];

define ("CURRENCY","&pound;");
define ("TITLE","Demo CMS");
define("ADMIN_EMAIL1","info@2fabdesigns.net");
define("ADMIN_EMAIL2","info@2fabdesigns.net");

define("ADMIN_FORM_EMAIL","info@pharma-health.co.uk");
define("ADMIN_NOTIFICATION","notification@pharma-health.co.uk");

define("ADMIN_GENERAL_EMAIL","info@pharmahealth.co.uk");

define("FROM_NAME","Pharma Health");

define ("PRES_ID","PH");

define ("SITE_PHONE","XXX-XXX-XXXX");

define ("GOOGLE_FEEDBACK_FORM","https://www.google.com/forms/about/");

define ("GOOGLE_MAP_KEY","AIzaSyBX5RABdr9q7B3RVQ440nt-lQP5iwM2JlQ");

define ("ENCRYPTION_KEY","9q7B3RVQ440ntKlQP5iwM");

define ("CONSULTATION_ACTUAL_PAY",5);
define ("CONSULTATION_COST",5);






?>