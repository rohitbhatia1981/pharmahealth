<?php include "private/settings.php";  
include PATH."include/email-templates/email-template.php"; 
include_once PATH."mail/sendmail.php";


//---------sending email to patient for medication alteration approval
		
		
		$presId=15312;
		$reason="Not suitable for Aasthma patients";
		
		$arrMedicineName=array();		
		$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($presId)."'";
		$resMedicine=$database->get_results($sqlMedicine);
			for ($m=0;$m<count($resMedicine);$m++)
				{
					$rowMedicine=$resMedicine[$m];																	
					array_push($arrMedicineName,$rowMedicine['pm_med']." @".$rowMedicine['pm_med_price']);
					
				}
				
				if (count($arrMedicineName)>0)
				$strMedicine=implode("\n",$arrMedicineName);
				
		
		$arrAltMedicine=array();		
		$sqlAltMedicine="select * from tbl_prescription_medicine_change_requests where pm_pres_id='".$database->filter($presId)."'";
		$resAltMedicine=$database->get_results($sqlAltMedicine);
			for ($m=0;$m<count($resAltMedicine);$m++)
				{
					$rowAltMedicine=$resAltMedicine[$m];																	
					array_push($arrAltMedicine,$rowAltMedicine['pm_med']." @".$rowAltMedicine['pm_med_price']);
					
				}
		if (count($arrAltMedicine)>0)
		$strAltMedicine=implode("\n",$arrAltMedicine);
															
                                                            
                                                            
                                                          
		
		
		
				$getPatientId="select pres_patient_id from tbl_prescriptions where pres_id='".$database->filter($presId)."'";
				$resPatientId=$database->get_results($getPatientId);
				$patientId=$resPatientId[0]['pres_patient_id'];
		
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
				$orderId=PRES_ID.$presId;
				$medicineName=$strMedicine;
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				
				//$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				//end Settings all values
				
				$patientlink="<a href='".URL."patient/login'>patient account</a>";
				$youraccount="<a href='".URL."patient/login'>your account</a>";
				

				$sqlEmail="select * from tbl_emails where email_id=26 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<reason>","<strong>".$reason."</strong>",$emailContent);
					$emailContent=str_replace("<patient_pres>","<strong>".$medicineName."</strong>",$emailContent);
					$emailContent=str_replace("<alter_pres>","<strong>".$strAltMedicine."</strong>",$emailContent);
					
					$emailContent=str_replace("<patient_account>",$patientlink,$emailContent);
					$emailContent=str_replace("<your_account>",$youraccount,$emailContent);										
					
					
					
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				print $mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				

				exit;

				$ToEmail=$rowMemberid['patient_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Order Approved";
				$BodySend=$mailBody;	
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
	
				
				//-----------end sending email to patient---

?>