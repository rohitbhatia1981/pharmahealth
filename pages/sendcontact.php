<?php include "../private/settings.php";

if ($_POST['txtName']!="" && $_POST['txtEmail']!="" )
{

$recaptcha=$_POST['g-recaptcha-response'];

	if(!empty($recaptcha))

	{
		
	$mailBody='	<style>	
	.greyboxText {			
	font-family:Verdana;		
	font-size:12px;				
	color:#5f5f5f;			
	line-height:18px;		
	}	
	</style>
	
	<table cellpadding="0" class="greyboxText" cellspacing="0" align="center">
		<Tr><Td colspan=2><strong>Inquiry Details:</strong></td></tr>	
		<tr><td colspan="2" height="6px"></td></tr>		
		<tr>
        <tr><td colspan="2" height="6px"></td></tr>	
		<tr>		
		<td width="200">Inquiry From</td>	
		<td>'.$_POST['inquiry_type'].'</td>
		</tr>';	
		
		if ($_POST['inquiry_type']=="Patient" || $_POST['inquiry_type']=="Pharmacy")
		{
			$mailBody.='<tr><td colspan="2" height="6px"></td></tr>			
			<td  width="200">Reason for contacting us</td>	
			<td>'.$_POST['cmbReason'].'</td>		
			</tr>';
			
		}
		
		
		$mailBody.='<tr><td colspan="2" height="6px"></td></tr>			
		<td  width="200">Name</td>	
		<td>'.$_POST['txtName'].'</td>		
		</tr>		
		<tr><td colspan="2" height="6px"></td></tr>	
		<tr>		
		<td class="greyboxText">Email</td>	
		<td>'.$_POST['txtEmail'].'</td>	
		</tr>
		<tr><td colspan="2" height="6px"></td></tr>	
		<tr>		
		<td class="greyboxText">Phone number</td>	
		<td>'.$_POST['txtPhone'].'</td>	
		</tr>
			
		<tr><td colspan="2" height="6px"></td></tr>	
		<tr>		
		<td class="greyboxText">Message</td>	
		<td>'.$_POST['txtMessage'].'</td>
		</tr>
		<tr><td colspan="2" height="6px"></td></tr>
	</table>';	
	
	
	
	
	include_once PATH."mail/sendmail.php";	

				$ToEmail=ADMIN_NOTIFICATION;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Inquiry Details";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				$curDate = date('Y-m-d H:i:s');
		        $dob=$_POST['cmbYear']."-".$_POST['cmbMonth']."-".$_POST['cmbDate'];
						 $values = array(
						'inquiry_name' => $_POST['txtName'],
						'inquiry_email' => $_POST['txtEmail'], 
						'inquiry_phone' => $_POST['txtPhone'],
						'inquiry_message' => $_POST['txtMessage'],
						'inquiry_reason' => $_POST['cmbReason'],
						'inquiry_type' => $_POST['inquiry_type'],
						'date' => $curDate,											

						);			

						$add_query = $database->insert( 'tbl_inquiry', $values );
						$lastInsertedId=$database->lastid();
						
					
					//-----------Sending acknowlegement to Patient or Pharmacy	
					if ($_POST['inquiry_type']=="Patient" || $_POST['inquiry_type']=="Pharmacy")
					{	
					
				include PATH."include/email-templates/email-template.php";
			
			
			    if ($_POST['cmbReason']=="Query")
				$emailId=38;
				else if ($_POST['cmbReason']=="Feedback")
				$emailId=37;
				else if ($_POST['cmbReason']=="Complaint")
				$emailId=36;
								
				
				$sqlEmail="select * from tbl_emails where email_id='".$emailId."' and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					
					$emailContent=str_replace("<name>",$_POST['txtName'],$emailContent);									
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

					$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
																


					$ToEmail=$_POST['txtEmail'];
					$FromEmail=ADMIN_NOTIFICATION;
					$FromName=FROM_NAME;
					
					$SubjectSend="Acknowledgement of ".$_POST['cmbReason'];
					$BodySend=$mailBody;	
					
					
					
	
					SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
					
					}
					
					//----------End Sending acknowlegement to patient or pharmacy
						
						
						

				echo "1";
	
	}

}

 ?>
 