<?php include "../private/settings.php";

	$currentDate = date('Y-m-d');			
	$sql="select * from tbl_prescriptions where (pres_stage=3 && pres_pharmacy_stage=3)";
	
	
	$res=$database->get_results($sql);
	
	for ($i=0;$i<count($res);$i++)
	{
	$rowPres=$res[$i];
	
	 $dateFromDatabase = $rowPres['pres_pharmacy_action_date']; 
	 $collect_reminder = date('Y-m-d', strtotime($dateFromDatabase . ' +5 days'));
	
	
	
		if ($collect_reminder==$currentDate)
			{
	
						
				$patientId=$rowPres['pres_patient_id'];				
				
		
				 $sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];				
				
				
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				
				
				
			
			
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				//--------Settings all values--------
				
				
				
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=33 and email_status=1";
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
				
				$SubjectSend="Reminder - Medication yet to be collected from nominated pharmacy";
				$BodySend=$mailBody;	
				
				

				 SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				}
							
							
							
							
	}
	}

 ?>











      



    