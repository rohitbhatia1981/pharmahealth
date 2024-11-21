<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";

		if ($_GET['cmbCategory']==8)
		$sql = "select * from tbl_prescriptions,tbl_patients where patient_id=pres_patient_id and (pres_stage=1 && pres_date <= DATE_SUB(NOW(), INTERVAL 3 DAY) || (pres_stage=2 and pres_patient_query_status=1 && pres_patient_query_date <= DATE_SUB(NOW(), INTERVAL 3 DAY) ))";
		else
		{
		
		$sql = "select * from tbl_prescriptions,tbl_patients where patient_id=pres_patient_id and pres_stage>0";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and (pres_id like '%".$database->filter(str_replace("PH-","",$_GET['txtSearchByTitle']))."%' || patient_first_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_middle_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_last_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_id like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_email like '%".$database->filter($_GET['txtSearchByTitle'])."%'  || patient_dob like '%".$database->filter($_GET['txtSearchByTitle'])."%'|| patient_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%') ";

		}
		
		if($_GET['cmbCategory'] != "")

		{

			$sql .= " and pres_stage='".$database->filter($_GET['cmbCategory'])."'";

		}
		if($_GET['txtSDate'] != "")

		{
			$sql.=" and pres_date >='".$_GET['txtSDate']." 00:00:00'";

		}
		
		if($_GET['txtEDate'] != "")

		{
			$sql.=" and pres_date <='".$_GET['txtEDate']." 23:59:59'";

		}

		$sql .= " order by pres_id desc";
		}

		//print_r($sql);
		
		
		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}
	
	function showOptions()
	{
		
		showListToSelect($results);
	}
	
	function showPharmacySale()
	{
		$results=array();
		
		showPharmacySaleHTML($results);
	}
	
	function showClinicianHoursReport()
	{
		$results=array();
		
		showClinicianHoursReportHTML($results);
	}
	
	function showRefundReport()
	{
		$results=array();
		
		showRefundReportHTML($results);
	}
	
	function showPatientReport()
	{
		$results=array();
		
		showPatientReportHTML($results);
	}
	
	function showClinicianReport()
	{
		$results=array();
		
		showClinicianReportHTML($results);
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
		
		$sendTo=$_POST['rdUser'];

		$names = array(
			'message_sender_id' => $_SESSION['user_id'],
			'message_sender_type' => 'Admin', 
			'message_sent_to' => $sendTo, 
			'message_pres_id' => $_POST['hid'], 					
			'message_date' => $curDate,
			'message_sender_status' => 0,
			'message_replier_status' => 0,
			'message_subject' => $_POST['txtSubject'],
			'message_attachment' => $arrFnamesSer,			
			'message_text' => $_POST['txtMessage']
			


		);

		$add_query = $database->insert( 'tbl_messages', $names );
		
		
		if ($_POST['rdUser']=="Patient")
		{
				$getPatientId="select pres_patient_id from tbl_prescriptions where pres_id='".$database->filter($_POST['hid'])."'";
				$resPatientId=$database->get_results($getPatientId);
				$patientId=$resPatientId[0]['pres_patient_id'];
		
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($patientId)."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
				
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				$sqlEmail="select * from tbl_emails where email_id=58 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);					
					
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<message>","<strong>".$_POST['txtMessage']."</strong>",$emailContent);
															
					//$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				

				$ToEmail=$email;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Message from Admin";
				$BodySend=$mailBody;	
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
			
				
		} 
		
		
		
		
		
		
		
			
		//getPresAction($_POST['hid'],$_SESSION['sess_patient_id'],'patient','Replied by Patient');
		
		
				//----------Creating log--------
		
					/*$name=$_SESSION['sess_prescriber_name'];
					$uid=$_SESSION['sess_patient_id'];
					$utype="patient";
					$action=$name." has sent message for prescription id PH-".$_POST['hid'];
					
					createLogs($uid,$utype,$action);*/
		
				//----------end creating log
		
		
			
			print "<script>window.location='index.php?c=".$component."&task=detail&id=".$_POST['hid']."&tab=message&msg=1'</script>";
	
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
		
		function changePresStatus()
		{
			
			global $database,$component;
						
			$update = array(
				'pres_stage' => $_POST['pesStatus']
			);	
			$where_clause = array(
				'pres_id' => $_POST['hdPId']
			);
			$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
			
			
			
			if ($_POST['pesStatus']==6)  //-- if prescription status is approved then pharmacy status will updated other set to 0
			$pharmacyStatus=$_POST['cmbPharmacyStage'];
			else
			$pharmacyStatus=0;
			
				
				$update = array(
				'pres_pharmacy_stage' => $pharmacyStatus
				);	
				$where_clause = array(
					'pres_id' => $_POST['hdPId']
				);
				$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );
				
				print "<script>window.location='index.php?c=".$component."&task=detail&id=".$_POST['hdPId']."'</script>";
			
		}

		



?>