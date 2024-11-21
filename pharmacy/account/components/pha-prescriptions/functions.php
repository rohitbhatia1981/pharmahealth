<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";
		
		
		
		$sql = "SELECT    
	pres_id,	
	patient_first_name,
	patient_middle_name,
	patient_last_name,
	patient_address1,
	patient_address2,
	patient_city,
	patient_postcode,
	patient_dob,
	pres_condition,
	pres_stage,
	pres_date,
	pres_pharmacy_stage
   
FROM 
   
    tbl_prescriptions,
	tbl_patients
	
WHERE 
   	pres_patient_id=patient_id 	
	and pres_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and pres_id like '%".$database->filter(str_replace("PH-","",$_GET['txtSearchByTitle']))."%'";

		}
		
		if($_GET['cmbCategory'] != "" && $_GET['cmbCategory'] != 11)

		{

			$sql .= " and pres_pharmacy_stage='".$database->filter($_GET['cmbCategory'])."'";

		}
		else if($_GET['cmbCategory']=="")
		{
			$sql.= "and pres_pharmacy_stage=1";
			
		}
		
		
		if ($_GET['cmbPeriod']==1)
		$daysDe="14";
		else if ($_GET['cmbPeriod']==2)
		$daysDe="30";
		else if ($_GET['cmbPeriod']==3)
		$daysDe="90";
		else if ($_GET['cmbPeriod']==4)
		$daysDe="180";
		else if ($_GET['cmbPeriod']==6)
		$daysDe="365";
		
		
		if ($_GET['cmbPeriod']!="")
		{
		$strDays='P'.$daysDe.'D';
		$today = new DateTime();
		$interval = new DateInterval($strDays);
		$oldDate = $today->sub($interval)->format('Y-m-d');

		
		$sql.=" and pres_date > '".$oldDate."'";
		}

		$sql .= " order by pres_date asc";


		// print_r($sql);
		// exit;
		
		
		

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

		$names = array(
			'message_sender_id' => $_SESSION['sess_pharmacy_id'],
			'message_sender_type' => 'Pharmacy', 
			'message_sent_to' => $_POST['rdUser'], 
			'message_pres_id' => $_POST['hid'], 
			'message_date' => $curDate,
			'message_sender_status' => 0,
			'message_replier_status' => 0,
			'message_subject' => $_POST['txtSubject'],
			'message_attachment' => $arrFnamesSer,			
			'message_text' => $_POST['txtMessage']
			


		);

		$add_query = $database->insert( 'tbl_messages', $names );
		
		
		//---------update prescription status to Query----
		
		$sqlUpdate="update tbl_prescriptions set pres_pharmacy_stage=2 where pres_id='".$database->filter($_POST['hid'])."'";
		$database->query($sqlUpdate);
		
		
		//--------end update prescription status to query---
		
			
		getPresAction($_POST['hid'],$_SESSION['sess_pharmacy_id'],'pharmacy','Sent message to Clinician');
		
		
				//----------Creating log--------
		
					$name=$_SESSION['sess_pharmacy_name'];
					$uid=$_SESSION['sess_pharmacy_id'];
					$utype="pharmacy";
					$action=$name." has sent message for prescription id PH-".$_POST['hid'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
		
		
		
			
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
				'pres_pharmacy_note' => $_POST['txtPharmacyMsg'],
				'pres_clincian_update' => $curDate,
				'pres_stage' => $_POST['hdOutcomes']			

			);
			
			if ($_POST['hdOutcomes']==4)
			{
				$update2=array(
				'pres_rejection_reason' => $_POST['txtReject'] 
				);
				
			}
			
			if ($_POST['hdOutcomes']==2)
			{
				$names = array(
				'message_sender_id' => $_SESSION['sess_prescriber_id'],
				'message_sender_type' => 'Clinician', 
				'message_sent_to' => $_POST['rdUser'],  
				'message_pres_id' => $_POST['hdId'], 
				'message_parent_reply' => 0,			
				'message_date' => $curDate,
				'message_sender_status' => 0,
				'message_replier_status' => 0,
				'message_subject' => $_POST['txtSubject'],
				'message_text' => $_POST['txtMessage']
				);

				$add_query = $database->insert( 'tbl_messages', $names );
				
				
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
	
	
	function fnSaveNotes()
	{
		
			global $database;
			$id=$_POST['hdPid'];
			$component=$_GET['c'];
			$curDate=date("Y-m-d H:i:s");
			
			
			
			$names = array(
				'pn_user_id' => $_SESSION['sess_pharmacy_id'],
				'pn_user_type' => 'pharmacy', 			
				'pn_pres_id' => $_POST['hdPid'],							
				'pn_date_time' => $curDate,
				'pn_action_details' => $_POST['txtPNotes']
				);

				$add_query = $database->insert( 'tbl_prescriptions_notes', $names );
				
				getPresAction($_POST['hdPid'],$_SESSION['sess_pharmacy_id'],'pharmacy','Added notes');
				
				//----------Creating log--------
		
					$name=$_SESSION['sess_pharmacy_name'];
					$uid=$_SESSION['sess_pharmacy_id'];
					$utype="pharmacy";
					$action=$name." added notes for prescription Id ".PRES_ID.$_POST['hdPid'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
			
			print "<script>window.location='index.php?c=".$component."&task=detail&id=".$id."#notes'</script>";
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

function changepresStatus()
	{
			global $database, $component;
			$curDate=date("Y-m-d H:i:s");			
			$update2=array();			
			$update = array(
				'pres_pharmacy_stage' => $_POST['rdChange'],
				'pres_pharmacy_action_date' => $curDate						

			);
			
			
			
			
			
			if ($_POST['rdChange']==2)
			{
				
				//-------save message-----
				
				
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

		$names = array(
			'message_sender_id' => $_SESSION['sess_pharmacy_id'],
			'message_sender_type' => 'Pharmacy', 
			'message_sent_to' => $_POST['rdUser'], 
			'message_pres_id' => $_POST['hdId'], 
			'message_date' => $curDate,
			'message_sender_status' => 0,
			'message_replier_status' => 0,
			'message_subject' => $_POST['txtSubject'],
			'message_attachment' => $arrFnamesSer,			
			'message_text' => $_POST['txtMessage']
			


		);

		$add_query = $database->insert( 'tbl_messages', $names );
		
		
	
		
			
		getPresAction($_POST['hid'],$_SESSION['sess_pharmacy_id'],'pharmacy','Sent message to Clinician');
		
		
				//----------Creating log--------
		
					$name=$_SESSION['sess_pharmacy_name'];
					$uid=$_SESSION['sess_pharmacy_id'];
					$utype="pharmacy";
					$action=$name." has sent message for prescription id PH-".$_POST['hid'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
				
				
				
				//------end save message---
				
				
			}
			
			if ($_POST['rdChange']==5)
			{
				$update2 = array(
				'pres_stage' => 7				

				);
				
				$where_clause = array(			
				'pres_id' => $_POST['hdId']
				);
				$updated = $database->update( 'tbl_prescriptions', $update2, $where_clause, 1 );
			}
			
			//------keeping common code for ready for collection and collected---
			if ($_POST['rdChange']==3 || $_POST['rdChange']==5)
			{
				
				$sqlPayments = "SELECT * FROM tbl_payments WHERE payment_pres_id='" . $database->filter($_POST['hdId']) . "'";
       			$resPayments = $database->get_results($sqlPayments);
				if (count($resPayments) > 0) {
					$rowPayments = $resPayments[0];
					if ($rowPayments['payment_status']==1)
					$result="success";
					else
					{
					$charge_id = $rowPayments['payment_stripe_charge_id'];
					include PATH . "patient/questionnaire/capture-payment.php";
					
						if ($result=="success")
						{
							$updatePayStatus = array(
							 'payment_status' => 1
							 );
				
							$where_clause = array(
								'payment_id' => $rowPayments['payment_id']
							);
							$database->update('tbl_payments', $updatePayStatus, $where_clause, 1);
						}
						else
						{
							 echo "Payment is not charged, prescription couldn't be approved, please contact admin";
							 exit;
						}
					}
				}
				
			
			//---------------Send email to Patient for Ready for collection--
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				$arrMedicineName=array();
		
				/*$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($_POST['hdId'])."'";
				$resMedicine=$database->get_results($sqlMedicine);
				for ($m=0;$m<count($resMedicine);$m++)
					{
						$rowMedicine=$resMedicine[$m];																	
						array_push($arrMedicineName,$rowMedicine['pm_med']);
						
					}
	             */                                   
		
				//if (count($arrMedicineName)>0)
				$strMedicine=getMedicationStringWithInfo($_POST['hdId']);
				
				$getPatientId="select pres_patient_id,pres_condition from tbl_prescriptions where pres_id='".$database->filter($_POST['hdId'])."'";
				$resPatientId=$database->get_results($getPatientId);
				$patientId=$resPatientId[0]['pres_patient_id'];
				
				$getGp="select * from tbl_patient_gps where pg_patient_id='".$database->filter($patientId)."'";
				$resGp=$database->get_results($getGp);
				$rowGp=$resGp[0];
				
				$gpDetails=str_replace(",","\n",$rowGp['pg_gp']);
				$gpEmail=$rowGp['pg_gp_email'];
				
				
				
				
				
		
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
				$orderId=PRES_ID.$_POST['hdId'];
				$medicineName=$strMedicine;
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				
				
				$sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
				$resPharmacy = $database->get_results( $sqlPharmacy );
				$rowPharmacy=$resPharmacy[0];
				
				
				$pharmacy_details="<strong><br>".$rowPharmacy['pharmacy_name'].", <br>".$rowPharmacy['pharmacy_address'].", <br>";				
				if ($rowPharmacy['pharmacy_address2']!="")
				$pharmacy_details.=$rowPharmacy['pharmacy_address2'].",<br>";				
				$pharmacy_details.=$rowPharmacy['pharmacy_city'].", <br> ".$rowPharmacy['pharmacy_postcode'].", <br> ".$rowPharmacy['pharmacy_p_landline']."</strong>";
				
				if ($_POST['rdChange']==3)
				{
				
							$arrWeek=array();
							$arrTimings=array();
											
										if ($rowPharmacy['pharmacy_p_opening']!="")
										$arrWeek=unserialize(fnUpdateHTML($rowPharmacy['pharmacy_p_opening']));
										
										if ($rowPharmacy['pharmacy_p_timings']!="")
											$arrTimings=unserialize(fnUpdateHTML($rowPharmacy['pharmacy_p_timings']));
											if ($rowPharmacy['pharmacy_p_timings_closing']!="")
											$arrTimings2=unserialize(fnUpdateHTML($rowPharmacy['pharmacy_p_timings_closing']));
											$mydays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday');
											
											$strEmailTimings="";
											
											foreach ($arrWeek as $val)
															{
																$strEmailTimings.=$mydays[$val-1];
																$strEmailTimings.=": ";
																
																
																$strEmailTimings.=date('h:i a', strtotime($arrTimings[$val]));
																$strEmailTimings.=" - ";
																$strEmailTimings.=date('h:i a', strtotime($arrTimings2[$val]));
																$strEmailTimings.="<br>";
																
																
															}
												
												$pharmacy_details.="<br><br><b><u>Pharmacy Opening Times</u></b><br>";
												$pharmacy_details.=$strEmailTimings;
				}
				
			
			}
			//----end keeping common code
			
			if ($_POST['rdChange']==3)
			{
				$update2 = array(
				'pres_stage' => 3				

				);
				
				
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=27 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					$emailContent=str_replace("<order_id>",$orderId,$emailContent);
					$emailContent=str_replace("<medicine_name>",$medicineName,$emailContent);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<pharmacy_details>",$pharmacy_details,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				
				

				$ToEmail=$email;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Your Medicine is Ready for Collection";
				$BodySend=$mailBody;	
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				//------------send sms to patient informing to collect order---
				
				if ($rowMemberid['patient_marketing_emails']==1)
				{
				
				// Your ClickSend API credentials
				$username = SMS_USERNAME;
				$apiKey = SMS_APIKEY;

				// Recipient phone number (make sure to include country code, e.g., +14155552671)
				$patientPhone=str_replace(" ","",$rowMemberid['patient_phone']);
				$patientPhone = ltrim($patientPhone, '0');
				$recipient = '+44'.$patientPhone;


				$message = 'Your medication for Order ID: '.$orderId.' is ready for collection at your nominated pharmacy.';

				$data = [
					'messages' => [
						[
							'source' => 'php',
							'from' => 'PHHEALTHUK', // Optional: Sender ID (should be alphanumeric, up to 11 chars)
							'body' => $message,
							'to' => $recipient,
							'schedule' => '', // Optional: Unix timestamp if you want to schedule the message
						]
					]
				];
				
				// Convert data to JSON
				$jsonData = json_encode($data);
				
				// Initialize cURL
				$ch = curl_init();
				
				// Set the ClickSend API endpoint
				curl_setopt($ch, CURLOPT_URL, 'https://rest.clicksend.com/v3/sms/send');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, [
					'Content-Type: application/json',
					'Authorization: Basic ' . base64_encode("$username:$apiKey")
				]);
				
				// Execute cURL request
				$response = curl_exec($ch);
				
				
				/*if (curl_errno($ch)) {
					echo 'cURL error: ' . curl_error($ch);
				} else {
					
					$responseData = json_decode($response, true);
					print_r ($responseData);
					if (isset($responseData['http_code']) && $responseData['http_code'] == 200) {
						echo 'SMS sent successfully!';
					} else {
						echo 'Failed to send SMS: ' . $responseData['response_msg'];
					}
				}*/
				
				// Close cURL session
				curl_close($ch);
				}
				
				//-----------end sending sms--------
				
				
				}
				
				
				//--------------end Sending email to patient for ready for collection--
				
				
				$getPresGP="select pres_gp_option,pres_condition from tbl_prescriptions where pres_id='".$database->filter($_POST['hdId'])."'";
				$resPresGP=$database->get_results($getPresGP);
				$gpOptionByPatient=$resPresGP[0]['pres_gp_option'];
				
				$conditionId=$resPresGP[0]['pres_condition'];
				$conditionName=getConditionNameVar($conditionId);
				
				
				$genDate=date("d/m/Y");
				$patient_dob=fn_GiveMeDateInDisplayFormat($rowMemberid['patient_dob']);
				
				$patient_address=$rowMemberid['patient_address1'];
				
				if ($rowMemberid['patient_address2']!="")
				$patient_address.=", ".$rowMemberid['patient_address2'];				
				$patient_address.=", ".$rowMemberid['patient_city'];
				$patient_address.=", ".$rowMemberid['patient_postcode'];
				
				
				
				
				
				if ($gpOptionByPatient==1 || $gpOptionByPatient==2)
				{
				
				//------------send email to GP and inform about the medicine-----
				
				
				
				$sqlEmail="select * from tbl_emails where email_id=28 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent="
					<div style='font-weight:bold;text-align:right'>
					
						14/2G Docklands Business Centre\n
						10-16 Tiller Road\n
						London\n
						E14 8PX\n
						Tel 020 475 5761\n
						Email: admin@promanhelth.co.uk\n
											 
						
					</div>";

					$emailContent.="<p style='text-align:left'>".fnUpdateHTML($rowEmail['email_description'])."<p>";
					$emailContent=str_replace("<date>","<strong>".$genDate."</strong>",$emailContent);
					$emailContent=str_replace("<gp_details>","<strong>".$gpDetails."</strong>",$emailContent);
					
					$emailContent=str_replace("<condition>","<strong>".$conditionName."</strong>",$emailContent);
					
					$emailContent=str_replace("<patient_name>","<strong>".$receiverName."</strong>",$emailContent);
					$emailContent=str_replace("<dob>","<strong>".$patient_dob."</strong>",$emailContent);
					$emailContent=str_replace("<address>","<strong>".$patient_address."</strong>",$emailContent);
					
					
					
					$emailContent=str_replace("<accute/repeat>","<strong>accute</strong>",$emailContent);
					$emailContent=str_replace("<format>","<strong>as a one off/on 6/12 months repeat dispensing batch</strong>",$emailContent);
					$emailContent=str_replace("<medication_name>","<strong>".$medicineName."</strong>",$emailContent);
					//$emailContent=str_replace("<pharmacy_details>","<strong>".$pharmacy_details."</strong>",$emailContent);
					
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				
				
				

				$ToEmail=$gpEmail;
				//$ToEmail="rohitbhatia1@gmail.com";
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="GP Notification - Your patient has accessed our service";
				$BodySend=$mailBody;	
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				
				
				}
				
				
				
				//------------end send email to GP
				}
				else
				{
					
					
					
					//-------Send email to patient with attachment--
					$sqlEmail="select * from tbl_emails where email_id=29 and email_status=1";
			   		 $resEmail=$database->get_results($sqlEmail);
			
			
				//-------Generate pdf attachment----
				
				$pid=$_POST['hdId'];
				$fileId="PH-".$_POST['hdId'].uniqid().".pdf";
				
				include PATH."pdf/create-gp-report.php";
				
				
				
				$attachment=PATH."uploads/prescriptions/attachment/".$fileId;
				
				
				//--------end generating pdf attachment
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					
					$emailContent="";
					$emailContent="<p style='text-align:left'>".fnUpdateHTML($rowEmail['email_description'])."<p>";					
					$emailContent=str_replace("<name>","<strong>".$receiverName."</strong>",$emailContent);					
					$emailContent=str_replace("\n","<br>",$emailContent);					
					$headingContent=$emailContent;

					$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				
				

				$ToEmail=$email;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Keeping your GP informed";
				$BodySend=$mailBody;	
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend,$attachment);
				
			
				
				}
					
					
					
					//-------end sending email to patient with attachment---
				}
				
				
			
			}
			
			if ($_POST['rdChange']==4)
			{
				
				//if ($_POST['cmbRejectReason']=="Other")
				$messageText=$_POST['txtReject'];
				//else
				//$messageText=$_POST['cmbRejectReason'];
				
				
				$update2 = array(
				'pres_pharmacy_cancel_request' => 1,
				
								

				);
				
				
				
		$curDate=date("Y-m-d");

		$names = array(

			'pr_pres_id' => $_POST['hdId'], 
			'pr_pharmacy_id' => $_SESSION['sess_pharmacy_id'],
			'pr_message' => $messageText, 
			'pr_status' => 0,
			'pr_date' => $curDate
			


		);

		$add_query = $database->insert( 'tbl_pres_cancel_request', $names );
				
			
			}
			
			//----------Creating log--------
		
					$name=$_SESSION['sess_pharmacy_name'];
					$uid=$_SESSION['sess_pharmacy_id'];
					$utype="pharmacy";
					$action=$name." send a request for cancellation of prescription id PH-".$_POST['hid'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
			
			//---------Collected notification to Patient------
		if ($_POST['rdChange']==5)
			{
				
				
				
				$sqlEmail="select * from tbl_emails where email_id=62 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					$emailContent=str_replace("<order_id>",$orderId,$emailContent);
					$emailContent=str_replace("<medicine_name>","<strong>".$medicineName."</strong>",$emailContent);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<pharmacy_details>",$pharmacy_details,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				
				

				$ToEmail=$email;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Confirmation: Your Medication Has Been Collected";
				$BodySend=$mailBody;	
				
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				}
				
			}
					

//Add the WHERE clauses

		$mergedArray = array_merge($update, $update2);
		
		//print_r ($mergedArray);
		
		

		$where_clause = array(

			
			'pres_id' => $_POST['hdId']
			

		);
		$updated = $database->update( 'tbl_prescriptions', $mergedArray, $where_clause, 1 );

		
		
		
		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&task=detail&id=".$_POST['hdId']."'</script>";

		}
			
	}


		



?>