<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


	 $sql = "SELECT * FROM tbl_pharmacy_request, tbl_patients where pr_patient_id=patient_id";
		
		if($_GET['txtSearch'] != "")
		{
			$sql .= " and (pr_id like '%".$database->filter($_GET['txtSearch'])."%' || patient_first_name like '%".$database->filter($_GET['txtSearch'])."%' || patient_last_name like '%".$database->filter($_GET['txtSearch'])."%') ";

		}		
		
		$sql .= " order by pr_id desc";
		
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
				$sql = "SELECT * FROM tbl_patients where patient_id='".$database->filter($id)."'";
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


	function takeaction()
	{
		
		global $database,$component;
		
		
		
		
		$sqlPr="select * from tbl_pharmacy_request where pr_id='".$database->filter($_GET['id'])."'";
		$resPr=$database->get_results($sqlPr);
		$rowPr=$resPr[0];
				
		
		$curDate=date("Y-m-d");
		
		if ($_GET['action']==1)
		{
			$update = array(
			 'pr_status' => 1,
			 'pr_action_date' => $curDate
			 
			);
			
			$where_clause = array(
			'pr_id' => $_GET['id']
			);

			$updated = $database->update('tbl_pharmacy_request', $update, $where_clause, 1 );
			
			
			
			//------update prescription
			
			$update = array(
			 'patient_pharmacy' => $rowPr['pr_new_pharmacy']
			
			);
			
			$where_clause = array(
			'patient_id' => $rowPr['pr_patient_id']
			);

			$updated = $database->update('tbl_patients', $update, $where_clause, 1 );
			
			
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($rowPr['pr_patient_id'])."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				
			
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
			
				$sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$database->filter($rowPr['pr_new_pharmacy'])."'";
				$resPharmacy=$database->get_results($sqlPharmacy);
				$rowPharmacy=$resPharmacy[0];
				
				$pharmacyName=$rowPharmacy['pharmacy_name'];
				$pharmacyAddress=$rowPharmacy['pharmacy_address'];
				if ($rowPharmacy['pharmacy_address2']!="")
				$pharmacyAddress.=", ".$rowPharmacy['pharmacy_address2'];
				$pharmacyAddress.=", ".$rowPharmacy['pharmacy_city'];
				$pharmacyAddress.=", ".$rowPharmacy['pharmacy_postcode'];
				
				$pharmacyPhone=$rowPharmacy['pharmacy_p_landline'];
				
				
			
			//-------------Send Pharmacy Change confirmation email---------
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
				$sqlEmail="select * from tbl_emails where email_id=35 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					
					$emailContent=str_replace("<pharmacy_name>",$pharmacyName,$emailContent);
					$emailContent=str_replace("<pharmacy_address>",$pharmacyAddress,$emailContent);
					$emailContent=str_replace("<pharmacy_phone>",$pharmacyPhone,$emailContent);
									
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

					$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
																


					$ToEmail=$rowMemberid['patient_email'];
					$FromEmail=ADMIN_FORM_EMAIL;
					$FromName=FROM_NAME;
					
					$SubjectSend="Confirmation of change of nominated pharmacy";
					$BodySend=$mailBody;	
					
					
					
	
					SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
				
				//------------end sending medication rejection email-----
			
			
			} else if ($_GET['action']==0)
		{
			
			
			$update = array(
			 'pr_status' => 2,
			 'pr_action_date' => $curDate
			 
			);
			
			$where_clause = array(
			'pr_id' => $_GET['id']
			);
			
			$updated = $database->update('tbl_pharmacy_request', $update, $where_clause, 1 );
			
			
			
			//-------------Send Pharmacy Change confirmation email---------
			
				$sqlCheck="select * from tbl_patients where patient_id='".$database->filter($rowPr['pr_patient_id'])."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				
				
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
				$sqlEmail="select * from tbl_emails where email_id=63 and email_status=1";
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
					
					$SubjectSend="Nominated Pharmacy Change Request - Rejected";
					$BodySend=$mailBody;	
						
					
	
					SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
				
				//------------end sending nominated pharmacy rejection email-----
			
			
		
			
			
			
					
			
			
			
			}
			
			
			
			
			print "<script>window.location='index.php?c=".$component."'</script>";
			
		

			

			

			
		
		
		
		
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

		



?>