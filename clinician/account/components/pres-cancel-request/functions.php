<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


	 $sql = "SELECT * FROM tbl_pres_cancel_request,tbl_prescriptions where pres_id=pr_pres_id";
		
		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and (pr_id like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pr_message like '%".$database->filter($_GET['txtSearchByTitle'])."%') ";

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
		
		
		$sqlPres="select * from tbl_pres_cancel_request where pr_id='".$database->filter($_GET['id'])."'";
		$resPres=$database->get_results($sqlPres);
		$rowPres=$resPres[0];
		
		
		$curDate=date("Y-m-d");
		
		if ($_GET['action']==1)
		{
			$update = array(
			 'pr_status' => 1,
			 'pr_clinician_id' => $_SESSION['sess_prescriber_id'],
			 'pr_action_date' => $curDate
			 
			);
			
			$where_clause = array(
			'pr_id' => $_GET['id']
			);

			$updated = $database->update('tbl_pres_cancel_request', $update, $where_clause, 1 );
			
			
			
			//------update prescription
			
			$update = array(
			 'pres_stage' => 5,
			 'pres_pharmacy_stage' => 4
			);
			
			$where_clause = array(
			'pres_id' => $rowPres['pr_pres_id']
			);

			$updated = $database->update('tbl_prescriptions', $update, $where_clause, 1 );
			
			
			} else if ($_GET['action']==0)
		{
			$update = array(
			 'pr_status' => 2,
			 'pr_clinician_id' => $_SESSION['sess_prescriber_id'],
			 'pr_action_date' => $curDate
			 
			);
			
			$where_clause = array(
			'pr_id' => $_GET['id']
			);

			$updated = $database->update('tbl_pres_cancel_request', $update, $where_clause, 1 );
			
			
			
			//------update prescription
			
			$update = array(
			 'pres_stage' => 6,
			 'pres_pharmacy_stage' => 1
			);
			
			$where_clause = array(
			'pres_id' => $rowPres['pr_pres_id']
			);

			$updated = $database->update('tbl_prescriptions', $update, $where_clause, 1 );
			
			
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