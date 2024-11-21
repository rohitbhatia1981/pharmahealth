<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


	 $sql="select * from tbl_pharmacies where pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
	
	
		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()
	{
		

		

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
			'pharmacy_o_mobile' => $_POST['txtMobile'], 						
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
			'pharmacy_about_us' => $_POST['txtAboutus'], 
			'pharmacy_website' => $_POST['txtWebsite'] 
			
			);


		$where_clause = array(

			'pharmacy_id' => $_SESSION['sess_pharmacy_id']

		);
		$updated = $database->update( 'tbl_pharmacies', $update, $where_clause, 1 );
		
		
		//-----------sending confirmation email---
		
				$sqlCheck="select * from tbl_pharmacies where pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."'";
				$resCheck=$database->get_results($sqlCheck);
				$rowMemberid=$resCheck[0];				
				
				$receiverName=$rowMemberid['pharmacy_name'];
				$email=$rowMemberid['pharmacy_o_email'];
		
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				$sqlEmail="select * from tbl_emails where email_id=45 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);					
					$emailContent=str_replace("<pharmacy_name>",$receiverName,$emailContent);					
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				 $mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				


				$ToEmail=$email;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Confirmation - Change of account details";
				$BodySend=$mailBody;	
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}

		
		if( $updated )
		{
			print "<script>window.location='index.php?c=".$component."'</script>";

		}

		
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

		



?>