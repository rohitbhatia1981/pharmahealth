<?php include "../private/settings.php";

	$currentDate = date('Y-m-d');			
	$sql="select * from tbl_prescriptions where (pres_stage=3 || pres_stage=7) and pres_expiry_date='".$currentDate."'";
	
	
	$res=$database->get_results($sql);
	
	for ($i=0;$i<count($res);$i++)
	{
	$rowPres=$res[$i];
	
						
				$patientId=$rowPres['pres_patient_id'];
		
				 $sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];				
				
				
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				
				
				$arrMedicineName=array();	
				$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
				$resMedicine=$database->get_results($sqlMedicine);
					for ($m=0;$m<count($resMedicine);$m++)
						{
							$rowMedicine=$resMedicine[$m];																	
							array_push($arrMedicineName,$rowMedicine['pm_med']);
							
						}
															
                                                            
                                                            
                                                          
		
					if (count($arrMedicineName)>0)
					$strMedicine=implode(",",$arrMedicineName);
	
			
			
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				//--------Settings all values--------
				
				
				
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=32 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
				
			
				if (count($resEmail)>0)
				{
					
					$patient_link="<a href='".URL.PATIENT_ADMIN."'>patient account</a>";
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<medicine_name>",$strMedicine,$emailContent);
					$emailContent=str_replace("<patient_account>",$patient_link,$emailContent);
										
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				

				$ToEmail=$rowMemberid['patient_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Prescription expiry reminder";
				$BodySend=$mailBody;	
				
				

				 SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				}
							
							
							
							
	}
		

 ?>











      



    