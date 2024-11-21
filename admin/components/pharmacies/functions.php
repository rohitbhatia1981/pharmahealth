<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pharmacies where 1 order by page_title asc";


		$sql = "SELECT * FROM tbl_pharmacies where 1 ";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and (pharmacy_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_address like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_o_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_o_email like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_o_mobile like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_p_landline like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_city like '%".$database->filter($_GET['txtSearchByTitle'])."%') ";

		}
		
		if($_GET['cmbStatus'] != "")

		{

			$sql .= " and pharmacy_status='".$database->filter($_GET['cmbStatus'])."'";

		}

		$sql .= " order by pharmacy_id  desc";


		//print_r($sql);
		
		
		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}
	
	

	

	

	function saveFormValues()

	{

	global $database, $component;

	if (is_array($_POST['ckWeek']))
	
	{
		
	$arrTime=array();
	$arrTime2=array();
	foreach ($_POST['ckWeek'] as $week)
	{
		
		$strTime=$_POST['cmbOpening_h'][$week-1].":".$_POST['cmbOpening_m'][$week-1];
		$strTime2=$_POST['cmbClosing_h'][$week-1].":".$_POST['cmbClosing_m'][$week-1];
		
		$arrTime[$week]=$strTime;
		$arrTime2[$week]=$strTime2;
	}
	
		$openingWeek=serialize($_POST['ckWeek']);
		$weekTiming=serialize($arrTime);
		$closeTiming=serialize($arrTime2);
		
	
	}
	
	

	$dtToday=date('Y-m-d H:i:s');
		

		$names = array(

			'pharmacy_name' => $_POST['txtPharmacyName'], 
			'pharmacy_address' => $_POST['txtAddress'],  
			'pharmacy_address2' => $_POST['txtAddress2'],  
			 
			'pharmacy_city' => $_POST['txtCity'], 
			'pharmacy_country' => $_POST['cmbCountry'], 
			'pharmacy_postcode' => $_POST['txtPostcode'],
			'pharmacy_s_name' => $_POST['textSupPharma'],  
			
			'pharmacy_o_name' => $_POST['txtName'], 
			'pharmacy_o_email' => $_POST['txtEmail'], 
			'pharmacy_o_mobile' => $_POST['txtMobile'], 
			
			'pharmacy_tier' => $_POST['cmbTier'],
				
						
			'pharmacy_p_landline' => $_POST['txtLandline_for_pat'], 
			'pharmacy_p_email' => $_POST['txtEmail_for_pat'], 			
			'pharmacy_p_gphc' => $_POST['txtGHPC'], 
			
			
			'pharmacy_p_opening' => $openingWeek, 
			'pharmacy_p_timings' => $weekTiming, 
			'pharmacy_p_timings_closing' => $closeTiming,	
			
			
			'pharmacy_bank_holiday' => $_POST['txtBankTimings'], 
			
			'pharmacy_primary_name' => $_POST['txtPrimaryName'], 
			'pharmacy_primary_email' => $_POST['txtPrimaryEmail'], 
			'pharmacy_primary_mobile' => $_POST['txtPrimaryMobile'], 
			
			'pharmacy_about_us' => $_POST['txtAboutus'], 
			'pharmacy_website' => $_POST['txtWebsite'], 
			'pharmacy_map' => $_POST['txtMap'],	
			
			'pharmacy_notes' => $_POST['txtNotes'], 			
			'pharmacy_logo' => $_POST['images4ex'][0],			
			'pharmacy_reg_date' => $dtToday,	
			'pharmacy_sms' => $_POST['rdoSMS'],		
			'pharmacy_status' => $_POST['rdoPublished'] //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_pharmacies', $names );
		
		$lastInsertedId=$database->lastid();
		
		if ($_POST['ckEmail']==1)
			{
				
				$password=rand(10000,99999);
				
				$updateApp = array(
					'pharmacy_password' => md5($password),
					'pharmacy_welcome_email' =>1
										
				);
				
				$where_clause = array(
				'pharmacy_id' => $lastInsertedId
				);
			
				$database->update( 'tbl_pharmacies', $updateApp, $where_clause, 1 );
				
				
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				$sqlEmail="select * from tbl_emails where email_id=42 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
				
			
				if (count($resEmail)>0)
				{
					
					$pharmacy_faq="<a href='".URL."faqs-for-pharmacies' style='text-decoration:underline'>Pharmacies FAQs</a>";
					
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);					
					$emailContent=str_replace("<name>",$_POST['txtPharmacyName'],$emailContent);					
					$emailContent=str_replace("<email>",$_POST['txtEmail'],$emailContent);
					$emailContent=str_replace("<password>",$password,$emailContent);					
					$emailContent=str_replace("-","&bull;",$emailContent);										
					$emailContent=str_replace("\n","<br>",$emailContent);
					$emailContent=str_replace("<Pharmacy_FAQ>",$pharmacy_faq,$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				
				


				$ToEmail=$_POST['txtEmail'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Pharmacy Account Set Up Confirmation";
				$BodySend=$mailBody;	
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
					
					
					
					
				
				
				
			}

		
		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_pharmacies where pharmacy_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}
	
	
	function createFormForPages_detail($id)
			{
				global $database;
				$sql = "SELECT * FROM tbl_pharmacies where pharmacy_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_details($results);

			}

	

	

	function saveModificationsOperation()
	{
		
			global $database,$component;
			
	if (is_array($_POST['ckWeek']))	
	{
		
	$arrTime=array();
	$arrTime2=array();
	foreach ($_POST['ckWeek'] as $week)
	{
		
		$strTime=$_POST['cmbOpening_h'][$week-1].":".$_POST['cmbOpening_m'][$week-1];
		$strTime2=$_POST['cmbClosing_h'][$week-1].":".$_POST['cmbClosing_m'][$week-1];
		
		$arrTime[$week]=$strTime;
		$arrTime2[$week]=$strTime2;
	}
	
		$openingWeek=serialize($_POST['ckWeek']);
		$weekTiming=serialize($arrTime);
		$closeTiming=serialize($arrTime2);
		
	
	}
		

			

			$update = array(

			'pharmacy_name' => $_POST['txtPharmacyName'], 
			'pharmacy_address' => $_POST['txtAddress'],  
			'pharmacy_address2' => $_POST['txtAddress2'],  			 
			'pharmacy_city' => $_POST['txtCity'], 
			'pharmacy_country' => $_POST['cmbCountry'], 
			'pharmacy_postcode' => $_POST['txtPostcode'],
			'pharmacy_s_name' => $_POST['textSupPharma'],			
			'pharmacy_o_name' => $_POST['txtName'], 
			'pharmacy_o_email' => $_POST['txtEmail'], 
			'pharmacy_o_mobile' => $_POST['txtMobile'], 			
			'pharmacy_tier' => $_POST['cmbTier'],					
			'pharmacy_p_landline' => $_POST['txtLandline_for_pat'], 
			'pharmacy_p_email' => $_POST['txtEmail_for_pat'], 			
			'pharmacy_p_gphc' => $_POST['txtGHPC'], 			
			'pharmacy_p_opening' => $openingWeek, 
			'pharmacy_p_timings' => $weekTiming, 
			'pharmacy_p_timings_closing' => $closeTiming,		
			
			'pharmacy_bank_holiday' => $_POST['txtBankTimings'], 			
			'pharmacy_primary_name' => $_POST['txtPrimaryName'], 
			'pharmacy_primary_email' => $_POST['txtPrimaryEmail'], 
			'pharmacy_primary_mobile' => $_POST['txtPrimaryMobile'], 
			
			'pharmacy_notes' => $_POST['txtNotes'], 			
			'pharmacy_logo' => $_POST['images4ex'][0],			
			'pharmacy_reg_date' => $dtToday,				
			'pharmacy_about_us' => $_POST['txtAboutus'], 
			'pharmacy_website' => $_POST['txtWebsite'], 
			'pharmacy_map' => $_POST['txtMap'],
			'pharmacy_sms' => $_POST['rdoSMS'],			
			'pharmacy_status' => $_POST['rdoPublished']

			);

//Add the WHERE clauses



		$where_clause = array(

			'pharmacy_id' => $_POST['pId']

		);
		$updated = $database->update( 'tbl_pharmacies', $update, $where_clause, 1 );
		
		
		if ($_POST['ckEmail']==1)
			{
				
				$password=rand(10000,99999);
				
				$updateApp = array(
					'pharmacy_password' => md5($password),
					'pharmacy_welcome_email' =>1
										
				);
				
				$where_clause = array(
				'pharmacy_id' => $_POST['pId']
				);
			
				$database->update( 'tbl_pharmacies', $updateApp, $where_clause, 1 );
				
				
				
				
					
					
					
					include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				$sqlEmail="select * from tbl_emails where email_id=42 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					
					$pharmacy_faq="<a href='".URL."faqs-for-pharmacies' style='text-decoration:underline'>Pharmacies FAQs</a>";
					
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);					
					$emailContent=str_replace("<name>",$_POST['txtPharmacyName'],$emailContent);					
					$emailContent=str_replace("<email>",$_POST['txtEmail'],$emailContent);
					$emailContent=str_replace("<password>",$password,$emailContent);
					$emailContent=str_replace("-","&bull;",$emailContent);					
					$emailContent=str_replace("\n","<br>",$emailContent);
					$emailContent=str_replace("<Pharmacy_FAQ>",$pharmacy_faq,$emailContent);
					
					
					
					
					$headingContent=$emailContent;

				 $mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				
				
				
				


				$ToEmail=$_POST['txtEmail'];
				
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Pharmacy Account set up confirmation";
				$BodySend=$mailBody;	
				
				
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
				
				
				
			}

		

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

				'pharmacy_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'pharmacy_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pharmacies', $update, $where_clause, 1 );

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

				'pharmacy_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'pharmacy_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pharmacies', $update, $where_clause, 1 );

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

				'pharmacy_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_pharmacies', $where_clause, 1 );

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

				'pharmacy_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_pharmacies', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



?>