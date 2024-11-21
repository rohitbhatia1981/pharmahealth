<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


	 $sql = "SELECT * FROM tbl_patient_gps where pg_patient_id='".$database->filter($_SESSION['sess_patient_id'])."'";
	
	
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
				/*global $database;
				$sql = "SELECT * FROM tbl_patient_gps where pg_patient_id='".$database->filter($_SESSION['sess_patient_id'])."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_details($results);
*/
			}

	

	

	function saveModificationsOperation()

	{
global $database,$component;


$curDate=date("Y-m-d");

	$sqlData="select * from tbl_medical_background where mb_patient_id='".$database->filter($_SESSION['sess_patient_id'])."'";
	$resData=$database->get_results($sqlData);
	if (count($resData)==0)
		{	
		
		$names = array(

			'mb_patient_id' => $_SESSION['sess_patient_id'], 
			'mb_allergies_toggle' => $_POST['rdAllergy'],
			'mb_allergies' => $_POST['txtAllergy'],
			'mb_condition_toggle' => $_POST['rdCondition'],
			'mb_conditions' => $_POST['txtCondition'],
			'mb_medication_toggle' => $_POST['rdMedication'],
			'mb_medications' => $_POST['txtMedication'],
			'mb_other_info' => $_POST['txtOtherInfo'],
			'mb_mod_date' => $curDate
		

		);
		
		

		$updated = $database->insert( 'tbl_medical_background', $names );
			
		
		}
		else
		{
			
			
				$update = array(

				'mb_patient_id' => $_SESSION['sess_patient_id'], 
				'mb_allergies_toggle' => $_POST['rdAllergy'],
				'mb_allergies' => $_POST['txtAllergy'],
				'mb_condition_toggle' => $_POST['rdCondition'],
				'mb_conditions' => $_POST['txtCondition'],
				'mb_medication_toggle' => $_POST['rdMedication'],
				'mb_medications' => $_POST['txtMedication'],
				'mb_other_info' => $_POST['txtOtherInfo'],
				'mb_mod_date' => $curDate

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'mb_patient_id' => $_SESSION['sess_patient_id']

			);

			$updated = $database->update( 'tbl_medical_background', $update, $where_clause, 1 );
			
			
			
			
		}



		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&done=1'</script>";

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
		
		function fnSaveMedicalBackground()
		{
			global $database,$component;		
			
			$curDate=date("Y-m-d");
			$names = array(	
				'mb_details' => $_POST['txtAllergy'], 
				'mb_patient_id' => $_SESSION['sess_patient_id'],
				'mb_type' => $_POST['idType'],
				'mb_added_date' => $curDate,
				'mb_added_type' => 'Patient added information'		
			);
	
			$add_query = $database->insert( 'tbl_patient_medical_background', $names );			
			print "<script>window.location='index.php?c=".$component."'</script>";
			
		
		}

		



?>