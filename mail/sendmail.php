<?php
/**
 * This example shows sending a message using a local sendmail binary.
 */
function SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend, $attachment='')
	{
	include_once 'PHPMailerAutoload.php';
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom($FromEmail, $FromName);
	//Set an alternative reply-to address
	$mail->addReplyTo($FromEmail, $FromName);
	//Set who the message is to be sent to
	$mail->addAddress($ToEmail, '');
	//Set the subject line
	$mail->Subject = $SubjectSend;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	
	$mail->msgHTML($BodySend, dirname(__FILE__));
	
	//Replace the plain text body with one created manually
	//$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	if ($attachment!="")
	$mail->addAttachment($attachment);
	
	//send the message, check for errors
	if (!$mail->send()) {
	//	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		 return "";
	}
	
}

//SendMail("rohitbhatia1@gmail.com", "admin@taskeasy.com.au", "Taskeasy", "Final Test", "Is this is a final test");
