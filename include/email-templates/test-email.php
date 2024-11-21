<?php include "../../private/settings.php";
include_once "email-template.php";
include "../../mail/sendmail.php";

$headingTemplate="You have a new lead";
$headingContent="Dear User, <br> Thank you for registering with Goagent";
$buttonTitle="Click to Accept";	
$buttonLink=URL."management/user/leadaccept";

$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);
$Bodysend = $mailBody;
$ToEmail="info@2fabdesigns.net";
$FromEmail="info@goagent.com.au";
$SubjectSend="Thank you for Registration";
$FromName="Goagent";

$mail = SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $Bodysend);			
		
?>