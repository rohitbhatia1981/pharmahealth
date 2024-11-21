<?php include "../../private/settings.php";


if (isset($_SESSION['sessCart']))
{
if (count($_SESSION['sessCart'])>0 && $_SESSION['sess_patient_id']!="" && $_SESSION['sess_pres_id']!="")
{
	
	
	$add_date = date('Y-m-d H:i:s');
	
	$med_expiry_date= date("Y-m-d", strtotime("+28 days", strtotime($add_date)));

	
	$update = array(
	'pres_stage' => 1,
	'pres_incomplete_active' => 0,
	'pres_expiry_date' => $med_expiry_date,
	'pres_date' => $add_date
	);
	
	$where_clause = array(
	'pres_id' => $_SESSION['sess_pres_id']

	 );
	
	$database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
	
	$arrMedicineName=array();
	
	for ($j=0;$j<count($_SESSION['sessCart']);$j++)
	{
		
		$mName=getMedicineName($_SESSION['sessCart'][$j]['med_id']);
		
		$names = array(
		'pm_pres_id' => $_SESSION['sess_pres_id'],
		'pm_med' => $mName,
		'pm_med_price' => getMedicinePrice($_SESSION['sessCart'][$j]['med_id']),
		'pm_med_qty' => $_SESSION['sessCart'][$j]['med_qty'],
		'pm_med_total' => getMedicinePrice($_SESSION['sessCart'][$j]['med_id'])
		
		);
		$add_query = $database->insert('tbl_prescription_medicine', $names );
		
		array_push($arrMedicineName,$mName);
	}
	
	if (isset($_SESSION['sessCart_common']))
	{
		if (count($_SESSION['sessCart_common'])>0)
		{
		for ($j=0;$j<count($_SESSION['sessCart_common']);$j++)
		{
			
			$mName=getMedicineName_common($_SESSION['sessCart_common'][$j]['med_id']);
			
			$names = array(
			'pm_pres_id' => $_SESSION['sess_pres_id'],
			'pm_med' => $mName,
			'pm_med_price' => getMedicinePrice_common($_SESSION['sessCart_common'][$j]['med_id']),
			'pm_med_qty' => $_SESSION['sessCart_common'][$j]['med_qty'],
			'pm_med_common' => 1,
			'pm_med_total' => getMedicinePrice($_SESSION['sessCart_common'][$j]['med_id'])
			
			);
			$add_query = $database->insert('tbl_prescription_medicine', $names );
			
			array_push($arrMedicineName,$mName);
		}
		}
	}
	
	//---------updating medical background
	
	if (count($_SESSION['arrAllergy'])>0)
	{
	foreach ($_SESSION['arrAllergy'] as $value)
	{
			$curDate=date("Y-m-d");
				$names = array(	
					'mb_details' => $value, 
					'mb_patient_id' => $_SESSION['sess_patient_id'],
					'mb_type' => 1,
					'mb_added_date' => $curDate,
					'mb_added_type' => 'through assessment'		
				);
		
				$add_query = $database->insert( 'tbl_patient_medical_background', $names );		
	
	}
	}

	if (count($_SESSION['arrCondition'])>0)
	{
	foreach ($_SESSION['arrCondition'] as $value)
	{
			$curDate=date("Y-m-d");
				$names = array(	
					'mb_details' => $value, 
					'mb_patient_id' => $_SESSION['sess_patient_id'],
					'mb_type' => 2,
					'mb_added_date' => $curDate,
					'mb_added_type' => 'through assessment'		
				);
		
				$add_query = $database->insert( 'tbl_patient_medical_background', $names );		
	
	}
	}

	if (count($_SESSION['arrMedication'])>0)
	{
	foreach ($_SESSION['arrMedication'] as $value)
	{
			$curDate=date("Y-m-d");
				$names = array(	
					'mb_details' => $value, 
					'mb_patient_id' => $_SESSION['sess_patient_id'],
					'mb_type' => 3,
					'mb_added_date' => $curDate,
					'mb_added_type' => 'through assessment'		
				);
		
				$add_query = $database->insert( 'tbl_patient_medical_background', $names );		
	
	}
	}
	
	
	
	//---------end updating medical background
	
	//------------- sending email---
	
			    include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
		//--------Settings all values--------
		
		if (count($arrMedicineName)>0)
		$strMedicine=implode(",",$arrMedicineName);
		
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($_SESSION['sess_patient_id'])."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
				$orderId=PRES_ID.$_SESSION['sess_pres_id'];
				$medicineName=$strMedicine;
				$subPrice=$_SESSION['sessTotal'];
				$totalPrice=$_SESSION['sessTotal'];
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				
				//$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=16 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$emailContent=str_replace("<order_id>",$orderId,$emailContent);
					$emailContent=str_replace("<medicine_name>",$medicineName,$emailContent);
					$emailContent=str_replace("<price>",CURRENCY.$subPrice,$emailContent);
					$emailContent=str_replace("<total_price>",CURRENCY.$totalPrice,$emailContent);				
					$emailContent=str_replace("<name>",$receiverName,$emailContent);										
					//$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$rowMemberid['patient_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Order Confirmation";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
	
	
	
	
	//-------- send email----
	
	
	unset ($_SESSION['sessCondition']);
	unset ($_SESSION['sess_pres_id']);
	
	unset ($_SESSION['questions']);
	unset ($_SESSION['questions3']);
	unset ($_SESSION['sessCart']);
	unset ($_SESSION['sessTotal']);
	
	unset ($_SESSION['sessCart_common']);
	
	unset ($_SESSION['arrAllergy']);
	unset ($_SESSION['arrCondition']);
	unset ($_SESSION['arrMedication']);
	
	
	//----------Creating log--------
		
					$name=$_SESSION['name'];
					$uid=$_SESSION['sess_patient_id'];
					$utype="patient";
					$action=$name." has submitted a new medical questionnaire Id: PH-".$_SESSION['sess_pres_id'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
				
				
	
	print "<script>window.location='order-submitted'</script>";
	
}
}
?>