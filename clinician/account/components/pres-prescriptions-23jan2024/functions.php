<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";
	
	
	
	if ($_GET['ty']=="" || $_GET['ty']=="s")
	{
		if ($_GET['ty']=="")
		$sql = "SELECT * FROM tbl_prescriptions where FIND_IN_SET(".$_SESSION['sess_prescriber_id'].",pres_prescriber)";
		else
		$sql = "SELECT * FROM tbl_prescriptions where 1 ";
		
		if (($_GET['cmbPeriod']==1 ||  $_GET['cmbPeriod']==""))
		$daysDe="14";
		else if ($_GET['cmbPeriod']==2)
		$daysDe="30";
		else if ($_GET['cmbPeriod']==3)
		$daysDe="90";
		else if ($_GET['cmbPeriod']==4)
		$daysDe="180";
		else if ($_GET['cmbPeriod']==6)
		$daysDe="365";
		
		
		
		$strDays='P'.$daysDe.'D';
		$today = new DateTime();
		$interval = new DateInterval($strDays);
		$oldDate = $today->sub($interval)->format('Y-m-d');

		$sql.=" and (pres_date > '".$oldDate."'";
		
		if (($_GET['cmbCategory']=="" || $_GET['cmbCategory']==1))
			{
				$sql .= " and  pres_stage='1') || (pres_stage=2 && pres_patient_query_status=1)";
			}
			
			else if($_GET['cmbCategory'] != "" )
			{
				if ($_GET['cmbCategory']==6)
				$sql.= " and (pres_stage=6 || pres_stage=3))";
				else if ($_GET['cmbCategory']==7)
				$sql.= " and pres_stage>0)";
				else
				$sql .= " and pres_stage='".$database->filter($_GET['cmbCategory'])."')";
			}

			
		
		
	}
	
	else if ($_GET['ty']=="od")
	{
		
		$strDays='P3D';
		$today = new DateTime();
		$interval = new DateInterval($strDays);
		$oldDate = $today->sub($interval)->format('Y-m-d');
		
		$sql = "select * from tbl_prescriptions where (pres_stage=1 && pres_date <= '".$oldDate."') || (pres_stage=2 and pres_patient_query_status=1 && pres_patient_query_date <= '".$oldDate."')";
	}
	
	
	
		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and pres_id like '%".$database->filter(str_replace(PRES_ID,"",$_GET['txtSearchByTitle']))."%'";

		}
	
	 $sql .= " order by pres_patient_query_status desc, pres_id desc";
	
	
	//print_r($sql);
		
		
		
		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

	
		

		$curDate=date("Y-m-d");

		$names = array(

			'patient_title' => $_POST['txtTitle'], 
			'patient_first_name' => $_POST['txtFirstName'],
			'patient_middle_name' => $_POST['txtMiddleName'], 
			'patient_last_name' => $_POST['txtLastName'],
			'patient_email' => $_POST['txtEmail'],
			'patient_password' => $_POST['txtPassword'],
			'patient_phone' => $_POST['txtPhone'],
			'patient_gender' => $_POST['cmbGender'],
			'patient_dob' => $_POST[''],
			'patient_city' => $_POST['txtCity'],
			'patient_address1' => $_POST['txtAddress1'],
			'patient_address2' => $_POST['txtAddress2'],
			'patient_pharmacy' => $_POST[''],
			'patient_marketing_emails' => $_POST[''],
			'patient_registered_date' => $curDate,
			'patient_ip' => $_SERVER['REMOTE_ADDR'],
			'patient_kyc' => $_POST['rdoKYC'],
			'patient_status' => $_POST['rdoPublished']


		);

		$add_query = $database->insert( 'tbl_pages', $names );

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}
	
	function saveMessage()
	{

			global $database, $component;
			
		$fileCount = count($_FILES['flDoc']['name']);
		$arrFnamesSer=array();

		if ($fileCount>0)
		{
			
			$arrFileNames=array();
			
			for ($i = 0; $i < $fileCount; $i++) {
			$fileName = uniqid().$_FILES['flDoc']['name'][$i];
			$fileType = $_FILES['flDoc']['type'][$i];
			$fileTmpName = $_FILES['flDoc']['tmp_name'][$i];
			$fileError = $_FILES['flDoc']['error'][$i];
			$fileSize = $_FILES['flDoc']['size'][$i];	
			
			
			 if ($fileError === UPLOAD_ERR_OK) {
				
				$destination = PATH.'uploads/patients/' . $fileName;
				move_uploaded_file($fileTmpName, $destination);
				//echo "File $fileName uploaded successfully.";
				array_push($arrFileNames,$fileName);
			}
			
			
		}
			
			$arrFnamesSer=serialize($arrFileNames);
			//print_r ($arrFnamesSer);
			
		 
		
		
		}
			
		
		$curDate=date("Y-m-d H:i:s");
		
		if ($_POST['pid']!="")
		$pid=$_POST['pid'];
		else
		$pid=0;
		
		
		
		
		if ($_POST['cmbMessage']==1)
		{
			$subject="Could not reach you by telephone";
			$message="Could not reach you by telephone - further information required (Call again)";
			
			//------------sending email to patient----
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
			
			
		}
		else if ($_POST['cmbMessage']==2)
		{
			$subject=$_POST['txtSubject'];
			$message=$_POST['txtMessage'];
			
		}
		else
		{
			$subject=$_POST['txtSubject'];
			$message=$_POST['txtMessage'];
		}
		
		if ($_POST['cmbMessage']==1)
		$rdUserType="Patient";
		else
		$rdUserType=$_POST['rdUser'];
		
		

		$names = array(
			'message_sender_id' => $_SESSION['sess_prescriber_id'],
			'message_sender_type' => 'Clinician', 
			'message_sent_to' => $_POST['rdUser'], 
			'message_pres_id' => $_POST['hid'], 
			'message_parent_reply' => $pid,			
			'message_date' => $curDate,
			'message_sender_status' => 0,
			'message_replier_status' => 0,
			'message_subject' => $subject,
			'message_attachment' => $arrFnamesSer,
			'message_text' => $message
			


		);
		

		$add_query = $database->insert( 'tbl_messages', $names );


		getPresAction($_POST['hid'],$_SESSION['sess_prescriber_id'],'clinician','Sent a query to '.$rdUserType);
		
		
		//----------Creating log--------
		
					$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." has sent message for prescription id ".PRES_ID.$_POST['hid'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
		
	
		//-------update stage
				
				$update = array(				
				'pres_stage' => 2			

				);
				$where_clause = array(

				'pres_id' => $_POST['hid']

				);
				$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
				
				
			
		
			
			print "<script>window.location='index.php?c=".$component."&task=detail&id=".$_POST['hid']."&tab=message&msg=1'</script>";
	
	}
	
	function saveprescription()
	{
		
	

		
			global $database, $component;
			
			
			$curDate=date("Y-m-d H:i:s");
			
			$update=array();
			$update2=array();
			
			$update = array(

				'pres_clinician_notes' => $_POST['txtNotes'], 
				
				'pres_clincian_update' => $curDate,
				'pres_stage' => $_POST['hdOutcomes']			

			);
			
			if ($_POST['txtPharmacyMsg']!="")
			{
				$update_notes=array(
				'pres_pharmacy_note' => $_POST['txtPharmacyMsg'],
				'pres_pharmacy_note_date' => $curDate
				);
				
				$where_clause = array(
			    'pres_id' => $_POST['hdId']

				);
				$updated = $database->update( 'tbl_prescriptions', $update_notes, $where_clause, 1 );
			}
			
			
			
			
			if ($_POST['hdOutcomes']==6)
			{
				$update2=array(
				'pres_pharmacy_stage' => 1 
				);
				
				getPresAction($_POST['hdId'],$_SESSION['sess_prescriber_id'],'clinician','Approved Prescription');
				
				
				//------------sending email to patient----
				
		include PATH."include/email-templates/email-template.php";
		include_once PATH."mail/sendmail.php";
				
		//--------Settings all values--------
		
		$arrMedicineName=array();
		
		$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($_POST['hdId'])."'";
		$resMedicine=$database->get_results($sqlMedicine);
			for ($m=0;$m<count($resMedicine);$m++)
				{
					$rowMedicine=$resMedicine[$m];																	
					array_push($arrMedicineName,$rowMedicine['pm_med']);
					
				}
															
                                                            
                                                            
                                                          
		
		if (count($arrMedicineName)>0)
		$strMedicine=implode(",",$arrMedicineName);
		
				$getPatientId="select pres_patient_id from tbl_prescriptions where pres_id='".$database->filter($_POST['hdId'])."'";
				$resPatientId=$database->get_results($getPatientId);
				$patientId=$resPatientId[0]['pres_patient_id'];
		
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
				$orderId=PRES_ID.$_POST['hdId'];
				$medicineName=$strMedicine;
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				
				//$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				//end Settings all values
				
				
				$clName=$_SESSION['sess_prescriber_name'];

				$sqlEmail="select * from tbl_emails where email_id=19 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$emailContent=str_replace("<order_id>",$orderId,$emailContent);
					$emailContent=str_replace("<medicine_name>",$medicineName,$emailContent);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<clinician_name>",$clName,$emailContent);										
					//$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$rowMemberid['patient_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Order Approved";
				$BodySend=$mailBody;	
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
	
				
				//-----------end sending email to patient---
				
				
				
				
				//----------Creating log--------
		
					$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." has approved prescription id ".PRES_ID.$_POST['hdId'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
				
			}
			
			else if ($_POST['hdOutcomes']==4)
			{
				
				if ($_POST['cmbRejectReason']=="Other")
				$messageText=$_POST['txtReject'];
				else
				$messageText=$_POST['cmbRejectReason'];
				
				
				$update2=array(
				'pres_rejection_reason' => $messageText
				);
				
				
				
				
				$getPatientId="select pres_patient_id from tbl_prescriptions where pres_id='".$database->filter($_POST['hdId'])."'";
				$resPatientId=$database->get_results($getPatientId);
				$patientId=$resPatientId[0]['pres_patient_id'];
				
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
			
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				
				
				
				//-------------Send medication rejection email---------
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
				$sqlEmail="select * from tbl_emails where email_id=22 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$messageText="<strong>".$messageText."</strong>";
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<reason>",$messageText,$emailContent);					
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

					$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
																


					$ToEmail=$rowMemberid['patient_email'];
					$FromEmail=ADMIN_FORM_EMAIL;
					$FromName=FROM_NAME;
					
					$SubjectSend="Medication Request Rejected";
					$BodySend=$mailBody;	
					
					
	
					SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
				
				//------------end sending medication rejection email-----
				
				
				
				
				getPresAction($_POST['hdId'],$_SESSION['sess_prescriber_id'],'clinician','Rejected Prescription');
				
				//----------Creating log--------
		
					$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." has rejected prescription id ".PRES_ID.$_POST['hdId'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
				
				
			}
			
			else if ($_POST['hdOutcomes']==2)
			{
				
			
				
				
				//-----------updated code-------
				
					$fileCount = count($_FILES['flDoc']['name']);
		$arrFnamesSer=array();

		if ($fileCount>0)
		{
			
			$arrFileNames=array();
			
			for ($i = 0; $i < $fileCount; $i++) {
			$fileName = uniqid().$_FILES['flDoc']['name'][$i];
			$fileType = $_FILES['flDoc']['type'][$i];
			$fileTmpName = $_FILES['flDoc']['tmp_name'][$i];
			$fileError = $_FILES['flDoc']['error'][$i];
			$fileSize = $_FILES['flDoc']['size'][$i];	
			
			
			 if ($fileError === UPLOAD_ERR_OK) {
				
				$destination = PATH.'uploads/patients/' . $fileName;
				move_uploaded_file($fileTmpName, $destination);
				//echo "File $fileName uploaded successfully.";
				array_push($arrFileNames,$fileName);
			}
			
			
		}
			
			$arrFnamesSer=serialize($arrFileNames);
			
			
		
		
		
		}
			
		
		$curDate=date("Y-m-d H:i:s");
		
		if ($_POST['pid']!="")
		$pid=$_POST['pid'];
		else
		$pid=0;
		
				$getPatientId="select pres_patient_id from tbl_prescriptions where pres_id='".$database->filter($_POST['hdId'])."'";
				$resPatientId=$database->get_results($getPatientId);
				$patientId=$resPatientId[0]['pres_patient_id'];
				
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
			
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
		
		
		if ($_POST['cmbMessage']==1)
		{
			$subject="Could not reach you by telephone";
			$message="Could not reach you by telephone - further information required (Call again)";
			
			//--------Settings all values--------
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
				$sqlEmail="select * from tbl_emails where email_id=24 and email_status=1";
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
					
					$SubjectSend="Clinician could not reach you by Phone";
					$BodySend=$mailBody;	
					
					
	
					SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
				
				//-------end update stage
				
				//getPresAction($_POST['hdId'],$_SESSION['sess_prescriber_id'],'clinician','Sent a query to patient');
			
			
		}
		else if ($_POST['cmbMessage']==2)
		{
			$subject=$_POST['txtSubject'];
			$message=$_POST['txtMessage'];
			$usertype=$_POST['rdUser'];
			
			if ($subject=="" || $message=="" || $usertype=="")
			{
			print "<script>window.location='".$_SERVER["HTTP_REFERER"]."&error=1'</script>";
			exit;
			}
			
			//--------Settings all values--------
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
				$sqlEmail="select * from tbl_emails where email_id=25 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$patient_link="<a href='".URL.PATIENT_ADMIN."'>patient account</a>";
					
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<message>",$_POST['txtMessage'],$emailContent);
					$emailContent=str_replace("<patient_account>",$patient_link,$emailContent);
										
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

					$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
									


					$ToEmail=$rowMemberid['patient_email'];
					$FromEmail=ADMIN_FORM_EMAIL;
					$FromName=FROM_NAME;
					
					$SubjectSend="Clinician could not reach you by Phone";
					$BodySend=$mailBody;	
					
					
	
					SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
					
					//getPresAction($_POST['hdId'],$_SESSION['sess_prescriber_id'],'clinician','Sent a query to patient');
				}
			
			
			
		}
		else
		{
			
			
			
			
			$subject=$_POST['txtSubject'];
			$message=$_POST['txtMessage'];
			$usertype=$_POST['rdUser'];
			
			if ($subject=="" || $message=="" || $usertype=="")
			{
			print "<script>window.location='".$_SERVER["HTTP_REFERER"]."&error=1'</script>";
			exit;
			}
			
			
			include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
				$sqlEmail="select * from tbl_emails where email_id=52 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$patient_link="<a href='".URL.PATIENT_ADMIN."'>patient account</a>";
					$messagewithSub="Subject: ".$subject."<br>Message: ".$_POST['txtMessage']."<br>";
					
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<message>",$messagewithSub,$emailContent);
					$emailContent=str_replace("<patient_account>",$patient_link,$emailContent);
										
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

					$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
									


					$ToEmail=$rowMemberid['patient_email'];
					$FromEmail=ADMIN_FORM_EMAIL;
					$FromName=FROM_NAME;
					
					$SubjectSend="Our clinician sent you a Query";
					$BodySend=$mailBody;	
					
					
	
					SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
			
		}
		
		
		if ($_POST['cmbMessage']==1)
		$rdUserType="Patient";
		else
		$rdUserType=$_POST['rdUser'];

		$names = array(
			'message_sender_id' => $_SESSION['sess_prescriber_id'],
			'message_sender_type' => 'Clinician', 
			'message_sent_to' => $rdUserType, 
			'message_pres_id' => $_POST['hdId'], 
			'message_parent_reply' => 0,			
			'message_date' => $curDate,
			'message_sender_status' => 0,
			'message_replier_status' => 0,
			'message_subject' => $subject,
			'message_attachment' => $arrFnamesSer,
			'message_text' => $message
			


		);

		$add_query = $database->insert( 'tbl_messages', $names );

				
				//------end updated code------
				
			
				
				getPresAction($_POST['hdId'],$_SESSION['sess_prescriber_id'],'clinician','Sent a query to '.$rdUserType);
				
				
				
				//----------Creating log--------
		
					$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." has sent message for prescription Id ".PRES_ID.$_POST['hdId'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
				
				print "<script>window.location='index.php?c=".$component."&task=detail&id=".$_POST['hdId']."&tab=message&msg=1'</script>";
				
				exit;
				
			}
			
			
			else if ($_POST['hdOutcomes']==5)
			{
				
				$getPatientId="select pres_patient_id from tbl_prescriptions where pres_id='".$database->filter($_POST['hdId'])."'";
				$resPatientId=$database->get_results($getPatientId);
				$patientId=$resPatientId[0]['pres_patient_id'];
				
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
				$orderId=PRES_ID.$_POST['hdId'];
				
				$medicineName=$strMedicine;
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				
				
				$update2=array(
				'pres_stage' => 5, 
				'pres_cancel_reason' => $_POST['txtReject'],
				'pres_cancelled_user_type' => 'clinician',
				'pres_cancelled_user_id' => $_SESSION['sess_prescriber_id'],				
				'pres_cancelled_date' => $curDate 
				);
				
				getPresAction($_POST['hdId'],$_SESSION['sess_prescriber_id'],'clinician','Cancelled Prescription');
				
				//----------Creating log--------
		
					$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." has cancelled prescription id ".PRES_ID.$_POST['hdId'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
				
				
		//-------sending email to patient-------
		
				
		include PATH."include/email-templates/email-template.php";
		include_once PATH."mail/sendmail.php";
				
		//--------Settings all values--------
		
		$receiverName=$_SESSION['sess_prescriber_name'];
		$orderId=PRES_ID."-".$_POST['hdId'];
		$patient_link="<a href='".URL.PATIENT_ADMIN."'>patient account</a>";
		
		$sqlEmail="select * from tbl_emails where email_id=21 and email_status=1";
		$resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$emailContent=str_replace("<order_id>",$orderId,$emailContent);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<patient_account>",$patient_link,$emailContent);										
					//$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				 $mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				

				$ToEmail= $_SESSION['sess_prescriber_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Order Cancellation";
				$BodySend=$mailBody;	
				
				
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);

				}

				
				
				//-------end sending email to patient-----
				
				
			}
			
			
			
			
			
			
			$mergedArray = array_merge($update, $update2);

//Add the WHERE clauses

		$where_clause = array(

			'pres_id' => $_POST['hdId']

		);
		$updated = $database->update( 'tbl_prescriptions', $mergedArray, $where_clause, 1 );

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}
			
	}
	
	function fnSaveNotes()
	{
		
			global $database;
			$id=$_POST['hdPid'];
			$component=$_GET['c'];
			$curDate=date("Y-m-d H:i:s");
			
			$names = array(
				'pn_user_id' => $_SESSION['sess_prescriber_id'],
				'pn_user_type' => 'clinician', 			
				'pn_pres_id' => $_POST['hdPid'],							
				'pn_date_time' => $curDate,
				'pn_action_details' => $_POST['txtPNotes']
				);

				$add_query = $database->insert( 'tbl_prescriptions_notes', $names );
				
				getPresAction($_POST['hdPid'],$_SESSION['sess_prescriber_id'],'clinician','Added notes');
				
				//----------Creating log--------
		
					$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." added notes for prescription Id ".PRES_ID.$_POST['hdPid'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
			
			print "<script>window.location='index.php?c=".$component."&task=detail&id=".$id."#notes'</script>";
	}
	
	function fnSaveCanRequest()
	{
		
		global $database;
		
		$id=$_POST['hdId'];
		$pid=$_POST['hdPId'];
		
		
		
		
		
		$curDate=date("Y-m-d");
		
		if ($_POST['rdAction']==1)
		{
			$update = array(
			 'pr_status' => 1,
			 'pr_clinician_id' => $_SESSION['sess_prescriber_id'],
			 'pr_action_message' => $_POST['txtMsg'],
			 'pr_action_date' => $curDate
			 
			);
			
			$where_clause = array(
			'pr_id' => $id
			);

			$updated = $database->update('tbl_pres_cancel_request', $update, $where_clause, 1 );
			
			
			
			//------update prescription
			
			$update = array(
			 'pres_stage' => 5,
			 'pres_pharmacy_stage' => 4
			);
			
			$where_clause = array(
			'pres_id' => $pid
			);

			$updated = $database->update('tbl_prescriptions', $update, $where_clause, 1 );
			
			//----------Creating log--------
		
					
					$action="Accepted the cancellation request";
					
					
					
					getPresAction($pid,$_SESSION['sess_prescriber_id'],'clinician',$action);
		
				//----------end creating log
				
				
				//-------sending email to patient-------
		
				
		include PATH."include/email-templates/email-template.php";
		include_once PATH."mail/sendmail.php";
				
		//--------Settings all values--------
		
				$getPatientId="select pres_patient_id from tbl_prescriptions where pres_id='".$database->filter($pid)."'";
				$resPatientId=$database->get_results($getPatientId);
				$patientId=$resPatientId[0]['pres_patient_id'];
				
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
		
		$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
		$email=$rowMemberid['patient_email'];
		$orderId=PRES_ID."-".$pid;
		
		
		$sqlEmail="select * from tbl_emails where email_id=54 and email_status=1";
		$resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$emailContent=str_replace("<order_id>",$orderId,$emailContent);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<reason>",'<strong>'.$_POST['txtMsg'].'</strong>',$emailContent);										
					//$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				 $mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				

				$ToEmail= $email;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Order Cancellation";
				$BodySend=$mailBody;	
				
				
			
				
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);

				}
			
			
			
			
			} else if ($_POST['rdAction']==2)
		{
			
			
			
			//----------Creating log--------
		
					/*$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." has rejected the cancellation request for prescription id ".PRES_ID.$_POST['hdId'];
					
					createLogs($uid,$utype,$action);*/
					
					$action="Rejected the cancellation request";
					
					getPresAction($pid,$_SESSION['sess_prescriber_id'],'clinician',$action);
		
				//----------end creating log
			
			
			$update = array(
			 'pr_status' => 2,
			 'pr_clinician_id' => $_SESSION['sess_prescriber_id'],
			 'pr_action_message' => $_POST['txtMsg'],
			 'pr_action_date' => $curDate
			 
			);
			
			$where_clause = array(
			'pr_id' => $id
			);

			$updated = $database->update('tbl_pres_cancel_request', $update, $where_clause, 1 );
			
			
			
			//------update prescription
			
			$update = array(
			 'pres_stage' => 6,
			 'pres_pharmacy_stage' => 1
			);
			
			$where_clause = array(
			'pres_id' => $pid
			);

			$updated = $database->update('tbl_prescriptions', $update, $where_clause, 1 );
			
			
				//-------sending email to Pharmacy regarding the cancellation of his request-------
		
				
		include PATH."include/email-templates/email-template.php";
		include_once PATH."mail/sendmail.php";
				
		//--------Settings all values--------
		
				 $getPharmacyId="select pr_pharmacy_id from tbl_pres_cancel_request where pr_id='".$database->filter($_POST['hdId'])."'";
				$resPharmacyId=$database->get_results($getPharmacyId);
				$pharmacyId=$resPharmacyId[0]['pr_pharmacy_id'];
				
				
				$sqlCheck="select * from tbl_pharmacies where pharmacy_id='".$database->filter($pharmacyId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
		
				$receiverName=$rowMemberid['pharmacy_name'];
				$email=$rowMemberid['pharmacy_o_email'];
				$orderId=PRES_ID."-".$pid;
		
		
		$sqlEmail="select * from tbl_emails where email_id=55 and email_status=1";
		$resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$emailContent=str_replace("<order_id>",$orderId,$emailContent);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<reason>",'<strong>'.$_POST['txtMsg'].'</strong>',$emailContent);										
					//$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				 $mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				

				 $ToEmail= $email;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Cancellation request Rejected - Process the order";
				$BodySend=$mailBody;	
				
				
			
				
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);

				}
			
			
			
			
			}
		
		
		
		print "<script>window.location='index.php?c=pres-prescriptions&task=detail&id=".$pid."&tab=cr'</script>";
	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_pages where page_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}
	
	
	function createFormForPages_detail($id)
			{
				global $database;
				 $sql = "select * from tbl_prescriptions,tbl_patients where pres_patient_id=patient_id and pres_id='".$database->filter($_GET['id'])."'  order by pres_id desc";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_details($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			

				$pagetitleEntered = $_POST['page_title'];

				$pagedescEntered = $_POST['page_description'];

				$pagePublishedEntered = $_POST['rdoPublished'];	

				$page_categories = $_POST['txtCategories'];

				$pageId=$_POST['pageId'];

			

			$update = array(

				'page_title' => $pagetitleEntered, 

				'page_description' => $pagedescEntered,

				'page_categories' => $page_categories, 			

				'page_status' => $pagePublishedEntered

			);

//Add the WHERE clauses

		$where_clause = array(

			'page_id' => $pageId

		);
		$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'page_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}

	

	function unpublishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'page_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}

	

	

	function removeSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_pages', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}


	function removeDeletedItems()

	{

		global $database,$component;	

		

			 $provinceIdToPublish = $_GET['id'];

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_pages', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

function acceptprescription()
	{

			global $database, $component;		
			
			$curDate=date("Y-m-d H:i:s");				
			
			$update = array(

				'pres_prescriber' => $_SESSION['sess_prescriber_id'], 
				'pres_clincian_accept_date' => $curDate
							

			);
			
			

//Add the WHERE clauses

		$where_clause = array(

			'pres_id' => $_GET['hid']

		);
		$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
		
		

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}
			
	}


	function getUnassignedTotal()

	{

		global $database;
		$sql = "select count(*) as ctr from tbl_prescriptions where pres_stage>0 && pres_stage<=2 and pres_prescriber='0'";
		$res=$database->get_results($sql);
		$total=$res[0]['ctr'];
		return $total;

	}	
	
	



?>