<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";
	
	
	
	if ($_GET['ty']=="" || $_GET['ty']=="s")
	{
		if ($_GET['ty']=="s")
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
				if ($_GET['ty']!="s")
				$sql .= " and  pres_stage='1') || (pres_stage=2)";
				else
				$sql.=")";
				
				
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
	
	else if ($_GET['ty']=="ro")
	{
		
			
		$sql = "select * from tbl_prescriptions where pres_reorder_of>0";
		
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
	
	
	
		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and pres_id like '%".$database->filter(str_replace(PRES_ID,"",$_GET['txtSearchByTitle']))."%'";

		}
	
	 $sql .= " order by  pres_same_day desc,pres_pullback desc, pres_stage, pres_date asc";
	
	
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
	

	
	function saveprescription()
{
	
	//print_r ($_POST);
	


    global $database, $component;
     $curDate = date("Y-m-d H:i:s");
	//print_r ($_POST);
	//exit;
	
    
    $update = array(
        'pres_clinician_notes' => $_POST['txtNotes'],
        'pres_clincian_update' => $curDate,
        'pres_stage' => $_POST['hdOutcomes']
    );
	
	$where_clause = array(
            'pres_id' => $_POST['hdId']
        );
	
	$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
    
    if ($_POST['txtPharmacyMsg'] != "") {
        $update_notes = array(
            'pres_pharmacy_note' => $_POST['txtPharmacyMsg'],
            'pres_pharmacy_note_date' => $curDate
        );
        
        $where_clause = array(
            'pres_id' => $_POST['hdId']
        );
        $database->update('tbl_prescriptions', $update_notes, $where_clause, 1);
    }
	
	$update = array(
				'pres_prescriber' => $_SESSION['sess_prescriber_id']
			);

			$where_clause = array(
			'pres_id' => $_POST['hdId']
			);
		$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
	
	
	//-------moving prescription to my task---
				$update = array(

				'pres_prescriber' => $_SESSION['sess_prescriber_id']
				);

				$where_clause = array(
				'pres_id' => $_POST['hdId']
				);
				
				
				
				$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
				
				
				
				
				//-----end moving prescription to my task---
	
    //------If prescription is approved-------
    if ($_POST['hdOutcomes'] == 6) {
        $result = "";
		
		
        
        // Charge Patient Stripe payment
       	 /*$sqlPayments = "SELECT * FROM tbl_payments WHERE payment_pres_id='" . $database->filter($_POST['hdId']) . "'";
       	 $resPayments = $database->get_results($sqlPayments);
				if (count($resPayments) > 0) {
					$rowPayments = $resPayments[0];
					if ($rowPayments['payment_status']==1)
					$result="success";
					else
					{
					$charge_id = $rowPayments['payment_stripe_charge_id'];
					include PATH . "patient/questionnaire/capture-payment.php";
					}
				}*/
				
		//-----if payment gateway is charged sucessfully-------
        
		$result="success";
        if ($result == "success") {
            $update = array(
                'pres_stage' => 6,
                'pres_pharmacy_stage' => 1
            );            
          
		  $database->update('tbl_prescriptions', $update, $where_clause, 1);
            
            getPresAction($_POST['hdId'], $_SESSION['sess_prescriber_id'], 'clinician', 'Approved Prescription');
            
          /*  $updatePayStatus = array(
                'payment_status' => 1
            );
            
            $where_clause = array(
                'payment_id' => $rowPayments['payment_id']
            );
            $database->update('tbl_payments', $updatePayStatus, $where_clause, 1); */
            
            // Send email to patient
            include PATH . "include/email-templates/email-template.php";
            include_once PATH . "mail/sendmail.php";
            
            $arrMedicineName = array();
            $sqlMedicine = "SELECT * FROM tbl_prescription_medicine WHERE pm_pres_id='" . $database->filter($_POST['hdId']) . "'";
            $resMedicine = $database->get_results($sqlMedicine);
            for ($m = 0; $m < count($resMedicine); $m++) {
                $rowMedicine = $resMedicine[$m];
                array_push($arrMedicineName, $rowMedicine['pm_med']);
            }
            
            $strMedicine = count($arrMedicineName) > 0 ? implode(",", $arrMedicineName) : "";
           
		    $getPatientId = "SELECT pres_patient_id,pres_condition FROM tbl_prescriptions WHERE pres_id='" . $database->filter($_POST['hdId']) . "'";
            $resPatientId = $database->get_results($getPatientId);
			$rowPatientDet=$resPatientId[0];
            $patientId = $rowPatientDet['pres_patient_id'];
           
		    $sqlCheck = "SELECT * FROM tbl_patients WHERE patient_id='" . $database->filter($patientId) . "'";
            $resCheck = $database->get_results($sqlCheck);
            $rowMemberid = $resCheck[0];
            
            $orderId = PRES_ID . $_POST['hdId'];
            $medicineName = $strMedicine;
            $receiverName = $rowMemberid['patient_title'] . " " . $rowMemberid['patient_first_name'] . " " . $rowMemberid['patient_middle_name'] . " " . $rowMemberid['patient_last_name'];
            $email = $rowMemberid['patient_email'];
            
            $clName = $_SESSION['sess_prescriber_name'];
			
			
            $sqlEmail = "SELECT * FROM tbl_emails WHERE email_id=19 AND email_status=1";
            $resEmail = $database->get_results($sqlEmail);
            
            if (count($resEmail) > 0) {
                $rowEmail = $resEmail[0];
                $emailContent = fnUpdateHTML($rowEmail['email_description']);
                $emailContent = str_replace("<order_id>", $orderId, $emailContent);
                $emailContent = str_replace("<medicine_name>", $medicineName, $emailContent);
                $emailContent = str_replace("<name>", $receiverName, $emailContent);
                $emailContent = str_replace("<clinician_name>", $clName, $emailContent);
                $emailContent = str_replace("\n", "<br>", $emailContent);
                
                $headingContent = $emailContent;
                $mailBody = generateEmailBody($headingTemplate, $headingContent, $buttonTitle, $buttonLink, $bottomHeading, $bottomText);
                
                $ToEmail = $rowMemberid['patient_email'];
                $FromEmail = ADMIN_FORM_EMAIL;
                $FromName = FROM_NAME;
                $SubjectSend = "Order Approved";
                $BodySend = $mailBody;
                
                SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				
				
				//---------Adding Follow up--------
				
				$selectedTimeframe = $_POST['cmbFollowup'];
				
			
				if ($selectedTimeframe!="")
				{
				// Get the current date
				$currentDate = date('Y-m-d');
			
				// Calculate the follow-up date based on the dropdown selection
				switch ($selectedTimeframe) {
					case '2 weeks':
						$followupDate = date('Y-m-d', strtotime($currentDate . ' + 2 weeks'));
						break;
					case '1 month':
						$followupDate = date('Y-m-d', strtotime($currentDate . ' + 28 days'));
						break;
					case '2 months':
						$followupDate = date('Y-m-d', strtotime($currentDate . ' + 56 days'));
						break;
					case '3 months':
						$followupDate = date('Y-m-d', strtotime($currentDate . ' + 84 days'));
						break;
					case '6 months':
						$followupDate = date('Y-m-d', strtotime($currentDate . ' + 6 months'));
						break;
					case '12 months':
						$followupDate = date('Y-m-d', strtotime($currentDate . ' + 12 months'));
						break;
					case 'custom':
						$followupDate =$_POST['txtFollowupDate'];
						break;
					case 'Follow up not required':
						$followupDate ="";
						break;
				
					
				}
				
				if ($followupDate!="")
				{
					$names = array(
							'follow_up_pres_id' => $_POST['hdId'],
							'follow_up_patient_id' => $rowMemberid['patient_id'], 
							'follow_up_date' => $followupDate, 
							'follow_up_added_by' => $_SESSION['sess_prescriber_id'], 
							'follow_up_active' => 1	
				
						);
					
					$add_query = $database->insert( 'tbl_follow_ups', $names );
					
					$lastInsertedId=$database->lastid();
					$curDate = date("Y-m-d H:i:s");
					
					$names = array(
							'fnotes_fid' => $lastInsertedId,
							'fnotes_actions' => "Created Follow-up on approval", 
							'fnotes_clinician' => $_SESSION['sess_prescriber_id'], 							
							'fnotes_date' => $curDate							
				
						);					
					$add_query = $database->insert( 'tbl_follow_up_notes', $names );
					
				}
					
			
					
				
				}
				
	
				
				
				//--------adding follow up-------
				
				
				
				
               }
			   
			   
			   //-----------Send email to Pharmacy on approval------
				
					
					
					$sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$database->filter($rowMemberid['patient_pharmacy'])."'";
					$loadPharmacy=$database->get_results($sqlPharmacy);
					$rowPharmacy=$loadPharmacy[0];
					$pharmacy_name=$rowPharmacy['pharmacy_name'];
					$pharmacy_email=$rowPharmacy['pharmacy_o_email'];
					$patient_condition=getConditionNameVar($rowPatientDet['pres_condition']);
					
					
			$sqlEmail = "SELECT * FROM tbl_emails WHERE email_id=61 AND email_status=1";
            $resEmail = $database->get_results($sqlEmail);
            
            if (count($resEmail) > 0) {
                $rowEmail = $resEmail[0];
                $emailContent = fnUpdateHTML($rowEmail['email_description']);
              
                $emailContent = str_replace("<pharmacy_name>", $pharmacy_name, $emailContent);
                $emailContent = str_replace("<condition>", "<strong>".$patient_condition."</strong>", $emailContent);
				$emailContent = str_replace("<patient_name>", "<strong>".$receiverName."</strong>", $emailContent);
				
                $emailContent = str_replace("\n", "<br>", $emailContent);
                
                $headingContent = $emailContent;
                $mailBody = generateEmailBody($headingTemplate, $headingContent, $buttonTitle, $buttonLink, $bottomHeading, $bottomText);
                
                $ToEmail = $pharmacy_email;
                $FromEmail = ADMIN_FORM_EMAIL;
                $FromName = FROM_NAME;
                $SubjectSend = "Patient order approval notification";
              	$BodySend = $mailBody;
				
                
                SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				
				//------------send sms to pharmacy informing patient assessment approval---
				
				if ($rowPharmacy['pharmacy_sms']==1)
				{
				
				// Your ClickSend API credentials
				$username = SMS_USERNAME;
				$apiKey = SMS_APIKEY;

				// Recipient phone number (make sure to include country code, e.g., +14155552671)
				$pharmacyPhone=str_replace(" ","",$rowPharmacy['pharmacy_primary_phone']);
				$pharmacyPhone = ltrim($pharmacyPhone, '0');
				$recipient = '+44'.$pharmacyPhone;


				$message = 'Dear '.$pharmacy_name.', The prescription for '.$receiverName.' '.$patient_condition.' has been approved and sent to your pharmacy portal. Please log in to access it.';

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
				
				//-----------end sending email to pharmacy on approval---
			   
            }
         else 
		 {
         //echo "Payment is not charged, prescription couldn't be approved, please contact admin";
		// exit;
		 
		 }
 //---when it is rejected       
    } else if ($_POST['hdOutcomes'] == 4) {
        $messageText = ($_POST['cmbRejectReason'] == "Other") ? $_POST['txtReject'] : $_POST['cmbRejectReason'];
        $update2 = array(
            'pres_rejection_reason' => $messageText
        );
        
        $getPatientId = "SELECT pres_patient_id FROM tbl_prescriptions WHERE pres_id='" . $database->filter($_POST['hdId']) . "'";
        $resPatientId = $database->get_results($getPatientId);
        $patientId = $resPatientId[0]['pres_patient_id'];
        $sqlCheck = "SELECT * FROM tbl_patients WHERE patient_id='" . $database->filter($patientId) . "'";
        $resCheck = $database->get_results($sqlCheck);
        $rowMemberid = $resCheck[0];
        
        $receiverName = $rowMemberid['patient_title'] . " " . $rowMemberid['patient_first_name'] . " " . $rowMemberid['patient_middle_name'] . " " . $rowMemberid['patient_last_name'];
        
        // Send medication rejection email
        include PATH . "include/email-templates/email-template.php";
        include_once PATH . "mail/sendmail.php";
        
        $sqlEmail = "SELECT * FROM tbl_emails WHERE email_id=22 AND email_status=1";
        $resEmail = $database->get_results($sqlEmail);
        
        if (count($resEmail) > 0) {
            $rowEmail = $resEmail[0];
            $emailContent = fnUpdateHTML($rowEmail['email_description']);
            $messageText = "<strong>" . $messageText . "</strong>";
            $emailContent = str_replace("<name>", $receiverName, $emailContent);
            $emailContent = str_replace("<reason>", $messageText, $emailContent);
            $emailContent = str_replace("\n", "<br>", $emailContent);
            
            $headingContent = $emailContent;
            $mailBody = generateEmailBody($headingTemplate, $headingContent, $buttonTitle, $buttonLink, $bottomHeading, $bottomText);
            
            $ToEmail = $rowMemberid['patient_email'];
            $FromEmail = ADMIN_FORM_EMAIL;
            $FromName = FROM_NAME;
            $SubjectSend = "Medication Request Rejected";
            $BodySend = $mailBody;
            
            SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
        }
        
        getPresAction($_POST['hdId'], $_SESSION['sess_prescriber_id'], 'clinician', 'Rejected Prescription');
        
        // Create log
        $name = $_SESSION['sess_prescriber_name'];
        $uid = $_SESSION['sess_prescriber_id'];
        $utype = "clinician";
        $action = $name . " has rejected prescription id " . PRES_ID . $_POST['hdId'];
        createLogs($uid, $utype, $action);
    } else if ($_POST['hdOutcomes'] == 2) {
		
		
        // Updated code
        $fileCount = count($_FILES['flDoc']['name']);
        $arrFnamesSer = array();
        
        if ($fileCount > 0) {
            $arrFileNames = array();
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = uniqid() . $_FILES['flDoc']['name'][$i];
                $fileTmpName = $_FILES['flDoc']['tmp_name'][$i];
                $fileError = $_FILES['flDoc']['error'][$i];
                
                if ($fileError === UPLOAD_ERR_OK) {
                    $destination = PATH . 'uploads/patients/' . $fileName;
                    move_uploaded_file($fileTmpName, $destination);
                    array_push($arrFileNames, $fileName);
                }
            }
            $arrFnamesSer = serialize($arrFileNames);
        }
		
		if ($_POST['cmbMessage']==1)
		$message="Could not reach you by telephone – further information required (Call again)";
		
		else
		$message=$_POST['txtMessage'];
		
		$subject=$_POST['txtSubject'];
		
		
		$names = array(
			'message_sender_id' => $_SESSION['sess_prescriber_id'],
			'message_sender_type' => 'Clinician', 
			'message_sent_to' => $_POST['rdUser'], 
			'message_pres_id' => $_POST['hdId'], 
			'message_parent_reply' => $pid,			
			'message_date' => $curDate,
			'message_sender_status' => 0,
			'message_replier_status' => 0,
			'message_subject' => $subject,
			'message_attachment' => $arrFnamesSer,
			'message_text' => $message
			


		);
		
		

		$add_query = $database->insert( 'tbl_messages', $names );
		
		
		
		$update = array(

				'pres_prescriber' => $_SESSION['sess_prescriber_id']
			);

			$where_clause = array(

			'pres_id' => $_POST['hdId']

			);
		$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
        
		
		
        $curDate = date("Y-m-d H:i:s");
        $update1 = array(
            'pres_request_more_info' => $_POST['txtMoreinfo'],
            'pres_more_info_files' => $arrFnamesSer,
            'pres_request_more_info_date' => $curDate,
            'pres_stage' => 2
        );
        
        $where_clause = array(
            'pres_id' => $_POST['hdId']
        );
        $database->update('tbl_prescriptions', $update1, $where_clause, 1);
        
        // Send request more information email to patient
        include PATH . "include/email-templates/email-template.php";
        include_once PATH . "mail/sendmail.php";
        
        $getPatientId = "SELECT pres_patient_id FROM tbl_prescriptions WHERE pres_id='" . $database->filter($_POST['hdId']) . "'";
        $resPatientId = $database->get_results($getPatientId);
        $patientId = $resPatientId[0]['pres_patient_id'];
        $sqlCheck = "SELECT * FROM tbl_patients WHERE patient_id='" . $database->filter($patientId) . "'";
        $resCheck = $database->get_results($sqlCheck);
        $rowMemberid = $resCheck[0];
        
        $receiverName = $rowMemberid['patient_title'] . " " . $rowMemberid['patient_first_name'] . " " . $rowMemberid['patient_middle_name'] . " " . $rowMemberid['patient_last_name'];
        $email = $rowMemberid['patient_email'];
        
        $sqlEmail = "SELECT * FROM tbl_emails WHERE email_id=20 AND email_status=1";
        $resEmail = $database->get_results($sqlEmail);
        
        if (count($resEmail) > 0) {
            $rowEmail = $resEmail[0];
            $emailContent = fnUpdateHTML($rowEmail['email_description']);
            $emailContent = str_replace("<name>", $receiverName, $emailContent);
            $emailContent = str_replace("<more_info>", $_POST['txtMoreinfo'], $emailContent);
            $emailContent = str_replace("\n", "<br>", $emailContent);
            
            $headingContent = $emailContent;
            $mailBody = generateEmailBody($headingTemplate, $headingContent, $buttonTitle, $buttonLink, $bottomHeading, $bottomText);
            
            $ToEmail = $rowMemberid['patient_email'];
            $FromEmail = ADMIN_FORM_EMAIL;
            $FromName = FROM_NAME;
            $SubjectSend = "Prescription Request for More Information";
            $BodySend = $mailBody;
            
            SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
        }
        
        getPresAction($_POST['hdId'], $_SESSION['sess_prescriber_id'], 'clinician', 'Requested more information for prescription');
        
        // Create log
        $name = $_SESSION['sess_prescriber_name'];
        $uid = $_SESSION['sess_prescriber_id'];
        $utype = "clinician";
        $action = $name . " has requested more information for prescription id " . PRES_ID . $_POST['hdId'];
        createLogs($uid, $utype, $action);
    }
	 //---when it is cancelled 
	else if ($_POST['hdOutcomes']==5)
	{
		
		
        $sqlPayments = "SELECT * FROM tbl_payments WHERE payment_pres_id='" . $database->filter($_POST['hdId']) . "'";
       	 $resPayments = $database->get_results($sqlPayments);
				if (count($resPayments) > 0) {
					$rowPayments = $resPayments[0];
					 $charge_id = $rowPayments['payment_stripe_charge_id'];
					include PATH . "patient/questionnaire/refund-payment.php";
					
				}
				
		//-----if payment gateway is charged sucessfully-------
		
	
	
	$update = array(
		'pres_stage' => 5,
		'pres_pharmacy_stage' => 4
		);
    
    $where_clause = array(
        'pres_id' => $_POST['hdId']
    );
    $database->update('tbl_prescriptions', $update, $where_clause, 1);
	
	
	 $getPatientId = "SELECT pres_patient_id FROM tbl_prescriptions WHERE pres_id='" . $database->filter($_POST['hdId']) . "'";
        $resPatientId = $database->get_results($getPatientId);
        $patientId = $resPatientId[0]['pres_patient_id'];
        $sqlCheck = "SELECT * FROM tbl_patients WHERE patient_id='" . $database->filter($patientId) . "'";
        $resCheck = $database->get_results($sqlCheck);
        $rowMemberid = $resCheck[0];
	
	   $receiverName = $rowMemberid['patient_title'] . " " . $rowMemberid['patient_first_name'] . " " . $rowMemberid['patient_middle_name'] . " " . $rowMemberid['patient_last_name'];
        $email = $rowMemberid['patient_email'];
        
        $sqlEmail = "SELECT * FROM tbl_emails WHERE email_id=64 AND email_status=1";
        $resEmail = $database->get_results($sqlEmail);
        
        if (count($resEmail) > 0) {
            $rowEmail = $resEmail[0];
            $emailContent = fnUpdateHTML($rowEmail['email_description']);
            $emailContent = str_replace("<name>", $receiverName, $emailContent);
            $emailContent = str_replace("<reason>", "<strong>".$_POST['txtReject']."</strong>", $emailContent);
            $emailContent = str_replace("\n", "<br>", $emailContent);
            
            $headingContent = $emailContent;
			
			 include PATH . "include/email-templates/email-template.php";
        	 include_once PATH . "mail/sendmail.php";
			
            $mailBody = generateEmailBody($headingTemplate, $headingContent, $buttonTitle, $buttonLink, $bottomHeading, $bottomText);
            
            $ToEmail = $rowMemberid['patient_email'];
            $FromEmail = ADMIN_FORM_EMAIL;
            $FromName = FROM_NAME;
            $SubjectSend = "Order Cancellation by Clinician";
            $BodySend = $mailBody;
		   
			
            
            SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
		}
   
   getPresAction($_POST['hdId'], $_SESSION['sess_prescriber_id'], 'clinician', 'Cancelled previously approved prescription');
   
    // Create log
    $name = $_SESSION['sess_prescriber_name'];
    $uid = $_SESSION['sess_prescriber_id'];
    $utype = "clinician";
    $action = $name . " has cancelled the previously approved prescription id " . PRES_ID . $_POST['hdId'];
    createLogs($uid, $utype, $action);
	
	
	
    
  
}

//---when it is pulled back

else if ($_POST['hdOutcomes']==8)
	{
		
	
	
	$update = array(
		'pres_stage' => 1,
		'pres_pullback' => 1,
		'pres_pharmacy_stage' => 0
		);
    
    $where_clause = array(
        'pres_id' => $_POST['hdId']
    );
    $database->update('tbl_prescriptions', $update, $where_clause, 1);
	
	  $getPatientId = "SELECT pres_patient_id FROM tbl_prescriptions WHERE pres_id='" . $database->filter($_POST['hdId']) . "'";
        $resPatientId = $database->get_results($getPatientId);
        $patientId = $resPatientId[0]['pres_patient_id'];
        $sqlCheck = "SELECT * FROM tbl_patients WHERE patient_id='" . $database->filter($patientId) . "'";
        $resCheck = $database->get_results($sqlCheck);
        $rowMemberid = $resCheck[0];
	
	   $receiverName = $rowMemberid['patient_title'] . " " . $rowMemberid['patient_first_name'] . " " . $rowMemberid['patient_middle_name'] . " " . $rowMemberid['patient_last_name'];
        $email = $rowMemberid['patient_email'];
        
        $sqlEmail = "SELECT * FROM tbl_emails WHERE email_id=65 AND email_status=1";
        $resEmail = $database->get_results($sqlEmail);
        
        if (count($resEmail) > 0) {
            $rowEmail = $resEmail[0];
            $emailContent = fnUpdateHTML($rowEmail['email_description']);
            $emailContent = str_replace("<name>", $receiverName, $emailContent);
            $emailContent = str_replace("<reason>", "<strong>".$_POST['txtReject']."</strong>", $emailContent);
            $emailContent = str_replace("\n", "<br>", $emailContent);
            
            $headingContent = $emailContent;
			
			 include PATH . "include/email-templates/email-template.php";
        	 include_once PATH . "mail/sendmail.php";
			
            $mailBody = generateEmailBody($headingTemplate, $headingContent, $buttonTitle, $buttonLink, $bottomHeading, $bottomText);
            
            $ToEmail = $rowMemberid['patient_email'];
            $FromEmail = ADMIN_FORM_EMAIL;
            $FromName = FROM_NAME;
            $SubjectSend = "Order Temporarily Withdrawn by Clinician";
            $BodySend = $mailBody;
			
            
            SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
        }
	
	
   
   getPresAction($_POST['hdId'], $_SESSION['sess_prescriber_id'], 'clinician', 'Prescription is pulled back after approval <br><br>Reason: '.fnUpdateHTML($_POST['txtReject']));
   
    // Create log
    $name = $_SESSION['sess_prescriber_name'];
    $uid = $_SESSION['sess_prescriber_id'];
    $utype = "clinician";
    $action = $name . " has pulled back the previously approved prescription id " . PRES_ID . $_POST['hdId'];
    createLogs($uid, $utype, $action);
	
	
	
    
  
}


  print "<script>window.location='index.php?c=" . $component . "'</script>";
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
				
				
				//-------moving prescription to my task---
				$update = array(

				'pres_prescriber' => $_SESSION['sess_prescriber_id']
				
				);

				$where_clause = array(
				'pres_id' => $_POST['hdPid']
				);
				$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
				
				//-----end moving prescription to my task---
				
				
				//----------Creating log--------
		
					$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." added notes for prescription Id ".PRES_ID.$_POST['hdPid'];
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
			
			print "<script>window.location='index.php?c=".$component."&task=detail&id=".$id."#notes'</script>";
	}
	
	function fnSaveDosage()
	{
		
			global $database;
			$id=$_POST['hdmp'];
			$component=$_GET['c'];
			//$curDate=date("Y-m-d H:i:s");
			
			if ($_POST['txtDosage']==1)
			$dosageText=$_POST['txtDosage_freetext_modal'];
			else
			$dosageText=$_POST['txtDosage'];
			
				$update = array(
				'pm_med_dosage' => $dosageText
				
				);
				
				$where_clause = array(
				'pm_id' => $_POST['hdmp']
				);
				
				

			$updated = $database->update('tbl_prescription_medicine', $update, $where_clause, 1 );

			$pid=$_GET['pid']; 
				
				
				getPresAction($pid,$_SESSION['sess_prescriber_id'],'clinician','Edited dosage');
				
				//----------Creating log--------
		
					$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." edited dosage prescription Id ".PRES_ID.$pid;
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
			
			print "<script>window.location='index.php?c=".$component."&task=detail&id=".$pid."#medicine'</script>";
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
				
				 $sqlCheckApprovalTable="select pm_id from tbl_prescription_medicine_change_requests where pm_pres_id='".$database->filter($_GET['id'])."'";
									  $resCheckApprovalTable=$database->get_results($sqlCheckApprovalTable);
									  if (count($resCheckApprovalTable)==0)
									  {
										  $update = array(
										 'pres_medicine_change_status' => 0
										 
										);
									$where_clause = array(
										'pres_id' => $_GET['id']
										);
										$database->update('tbl_prescriptions', $update, $where_clause, 1 );
									  }
				
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



	function getUnassignedTotal()

	{

		global $database;
		//$sql = "select count(*) as ctr from tbl_prescriptions where pres_stage>0 && pres_stage<=2 and pres_prescriber='0'";
		$sql = "select count(*) as ctr from tbl_prescriptions where (pres_stage='1') || (pres_stage=2 && pres_patient_query_status=1) and pres_prescriber='0'";
		
		$res=$database->get_results($sql);
		$total=$res[0]['ctr'];
		return $total;

	}	
	
	function getReorderTotal()

	{

		global $database;
		$sql = "select count(*) as ctr from tbl_prescriptions where pres_stage>0 && pres_stage<=2 and pres_reorder_of>0";
		$res=$database->get_results($sql);
		$total=$res[0]['ctr'];
		return $total;

	}	
	
	



?>