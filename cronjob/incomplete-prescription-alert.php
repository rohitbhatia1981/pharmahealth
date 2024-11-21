<?php include "../private/settings.php";

				
	$sql="select pres_id,DATE(pres_date) as pres_date,pres_patient_id from tbl_prescriptions where pres_incomplete_active=1";
	$res=$database->get_results($sql);
	
	for ($j=0;$j<count($res);$j++)
	{	
	
		$row=$res[$j];
		
		$presDate=$row['pres_date'];		
		$currentDate = date("Y-m-d");		
		$dayDifference = floor((strtotime($currentDate) - strtotime($presDate)) / (60 * 60 * 24));
		
		if ($dayDifference==1 || $dayDifference==3)
		{
	
	
				$patientId=$row['pres_patient_id'];
		
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
				
				
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
	
	
	
			$sql = "SELECT * FROM tbl_patients where patient_id='".$database->filter($row['pres_patient_id'])."'";
			$results = $database->get_results( $sql );
			
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				//--------Settings all values--------
				
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=23 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);					
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$rowMemberid['patient_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Incomplete Order - Don't give up, you're so close";
				$BodySend=$mailBody;	
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
			
		}
	
		

}




 ?>











      



    