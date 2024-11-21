<?php include "../../../private/settings.php";

if ($_POST['cmbReason']!="" && $_POST['hdPid']!="")
{


		
		
		//-------update button stage-----
		
		if ($_POST['cmbReason']==3)
		$reason=$_POST['txtReason'];
		else
		$reason=$_POST['cmbReason'];
		
		
		$curDate=date("Y-m-d");
		
			$update = array(
			 'pres_medicine_request_date' => $curDate,
			 'pres_medicine_change_status'  => 2,
			 'pres_med_change_reason'  => $reason
			 
			);
			
			$where_clause = array(
			'pres_id' => $_POST['hdPid']
			);

			$updated = $database->update('tbl_prescriptions', $update, $where_clause, 1 );
		
		
		//--------end update button stage----


		
		//---------sending email to patient for medication alteration approval
		include PATH."include/email-templates/email-template.php";
		include_once PATH."mail/sendmail.php";
		
		$presId=$_POST['hdPid'];
		
		
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
				$youraccount="<a href='".URL."patient/account/?c=patient-prescriptions&task=detail&tab=order&id=".$presId."'>patient account</a>";
				

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

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				

				

				$ToEmail=$rowMemberid['patient_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Change of medication and approval required";
				$BodySend=$mailBody;	
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
	
				
				//-----------end sending email to patient---
				
				//----------Creating log--------
				
				getPresAction($_POST['hdPid'],$_SESSION['sess_prescriber_id'],'clinician','Sent a medication alteration request to patient');
		
					$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." Sent the medication alteration request to patient for prescription id ".PRES_ID.$_POST['hdPid'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log



echo "1";
}
else
echo "2";
?>