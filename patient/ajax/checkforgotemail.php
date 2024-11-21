<?php session_start(); 
include "../../private/settings.php"; 
if ($_POST['txtLoginEmail']!="")
{


 $sqlCheck = "select * from tbl_patients where patient_email = '".$database->filter($_POST['txtLoginEmail'])."'";
 $result = $database->get_results($sqlCheck);
 
 
 $totalMember = count($result);

	if($totalMember>0)

		{

		
		$rowMemberid = $result[0]; 
		
		
		   $fcode=md5(uniqid().$rowMemberid['patient_id']."777");
      	
		   $updateForgot = array(
			'patient_forgot_password' => $fcode, 
			);
			
			$where_clause = array(
				'patient_id' => $rowMemberid['patient_id']
			);

	
			$database->update( 'tbl_patients', $updateForgot, $where_clause, 1 );
			
			$sendEmailTo=$rowMemberid['patient_email'];
		
		

		//setcookie("cookie_memberId", $rowMember->member_id,0,"/");

		echo "1";	
		
		
		include PATH."include/email-templates/email-template.php";
		include PATH."mail/sendmail.php";
		
		
		//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=39 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
				
			
				if (count($resEmail)>0)
				{
					
					
					$rowEmail=$resEmail[0];
					$resetLink="<strong><a href='".URL."patient/verifymy?id=".$fcode."&typ=patient'>".URL."patient/verifymy?id=".$fcode."</a></strong>";
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					
					$emailContent=str_replace("<name>",$sendEmailTo,$emailContent);
					$emailContent=str_replace("<reset_link>",$resetLink,$emailContent);
					
															
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				

				$ToEmail=$sendEmailTo;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Password Reset";
				$BodySend=$mailBody;	
				
				

				 SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				}
		
		
				

	}

	else



	{		



		echo "0";		



	}



}







?>