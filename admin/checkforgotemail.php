<?php include "../private/settings.php"; 

if ($_POST['txtLoginEmail']!="")
{


 $sqlCheck = "select * from tbl_users where email = '".$database->filter($_POST['txtLoginEmail'])."' and user_status=1";
 $result = $database->get_results($sqlCheck);
 
 
 $totalMember = count($result);

	if($totalMember>0)

		{

		
		$rowMemberid = $result[0]; 
		
		
		   $fcode=md5(uniqid().$rowMemberid['user_id']."777");
      	
		   $updateForgot = array(
			'user_forgot_password' => $fcode, 
			);
			
			$where_clause = array(
				'user_id' => $rowMemberid['user_id']
			);

	
			$database->update( 'tbl_users', $updateForgot, $where_clause, 1 );
			
			$sendEmailTo=$rowMemberid['email'];
		
		

		//setcookie("cookie_memberId", $rowMember->member_id,0,"/");

			
		
		
		include PATH."include/email-templates/email-template.php";
		include PATH."mail/sendmail.php";
		
		
		//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=39 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
				
			
				if (count($resEmail)>0)
				{
					
					
					$rowEmail=$resEmail[0];
					$resetLink="<strong><a href='".URL."admin/verifymy.php?id=".$fcode."&typ=admin'>".URL."admin/verifymy.php?id=".$fcode."</a></strong>";
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
		
		print "<script>window.location='index.php?forgot-password=2'</script>";
				

	}

	else



	{		



		print "<script>window.location='index.php?forgot-password=1&wrong=1'</script>";		



	}



}







?>