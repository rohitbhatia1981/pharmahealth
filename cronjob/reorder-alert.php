<?php include "../private/settings.php";

				
	$sql="select * from tbl_prescriptions where (pres_stage=3 || pres_stage=7)";
	$res=$database->get_results($sql);
	
	for ($i=0;$i<count($res);$i++)
	{
	$rowPres=$res[$i];
	

	
	 $dateFromDatabase = $rowPres['pres_expiry_date']; 
	 $reorder_activate = date('Y-m-d', strtotime($dateFromDatabase . ' -28 days'));
	$reorder_activate2 = date('Y-m-d', strtotime($dateFromDatabase . ' -10 days'));
	$reorder_activate3 = date('Y-m-d', strtotime($dateFromDatabase . ' -2 days'));
	 $currentDate = date('Y-m-d');
	 $reorder_expiry = date('Y-m-d', strtotime($dateFromDatabase . ' +12 months'));
	
	
	
	if ($reorder_expiry>$currentDate)
			{
				
					if ($reorder_activate==$currentDate || $reorder_activate2==$currentDate || $reorder_activate3==$currentDate)
						{
							
							
							
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

				$sqlEmail="select * from tbl_emails where email_id=31 and email_status=1";
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
				
				$SubjectSend="Medication reorder reminder - Has your medication run out?";
				$BodySend=$mailBody;	
				
				

				 SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				}
							
							
							
							
						}
			}

	}

 ?>











      



    