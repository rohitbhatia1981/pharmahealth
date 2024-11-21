<?php include "../../../private/settings.php";

if (($_POST['txtOldPassword']!="") && ($_POST['txtPassword']!="") && ($_POST['txtCPassword'] == $_POST['txtPassword']) ) {

				 $password= md5($_POST['txtPassword']);
				 $oldpassword= md5($_POST['txtOldPassword']);	

				 $userId=$_SESSION['sess_pharmacy_id'];


				 $sql = "SELECT * FROM tbl_pharmacies where pharmacy_id='".$database->filter($userId)."' and pharmacy_password='".$database->filter($oldpassword)."'";
				 $results = $database->get_results( $sql );
				 $Total = count($results);

		if($Total > 0) 
		{
			$update = array(
		'pharmacy_password' => $password
		);

		$where_clause = array(
		'pharmacy_id' => $userId
		);
		
			$updated = $database->update( 'tbl_pharmacies', $update, $where_clause );

			if( $updated )
			{
				
				
				//-----------Email for confirmation of editing to Patient---
				
		
				
				$rowMemberid=$results[0];				
				
				$receiverName=$rowMemberid['pharmacy_name'];
				$email=$rowMemberid['pharmacy_o_email'];
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				$sqlEmail="select * from tbl_emails where email_id=57 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);					
					$emailContent=str_replace("<name>",$receiverName,$emailContent);					
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				 $mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				


				$ToEmail=$email;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Confirmation - Change of Password";
				$BodySend=$mailBody;	
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
		
		
		//------------end email for confirmation of password change----
				
				
				
				echo 1;
			}

		}else{

			echo 0;

		}	

}else{

	echo 2;

}		

		







?>