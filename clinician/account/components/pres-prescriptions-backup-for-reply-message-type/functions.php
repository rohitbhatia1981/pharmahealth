<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";
		

		
		if ($_GET['ty']=="s")
		{
			$sql = "SELECT *
FROM 		tbl_prescriptions
INNER 		JOIN tbl_patients ON tbl_prescriptions.pres_patient_id = tbl_patients.patient_id ";
			
			
			
			
			
			
			
		}
		else if ($_GET['ty']=="od")
		$sql = "select * from tbl_prescriptions,tbl_patients where patient_id=pres_patient_id and (pres_stage=1 && pres_date <= DATE_SUB(NOW(), INTERVAL 3 DAY) || (pres_stage=2 and pres_patient_query_status=1 && pres_patient_query_date <= DATE_SUB(NOW(), INTERVAL 3 DAY) ))";
		else
		$sql = "select * from tbl_prescriptions,tbl_patients where patient_id=pres_patient_id and FIND_IN_SET(".$_SESSION['sess_prescriber_id'].",pres_prescriber)  ";



		if (($_GET['cmbPeriod']==1 ||  $_GET['cmbPeriod']=="") && $_GET['ty']!="od")
			$sql.=" and pres_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 14 DAY) AND CURDATE() ";
			else if ($_GET['cmbPeriod']==2)
			$sql.=" and pres_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE()";
			else if ($_GET['cmbPeriod']==3)
			$sql.=" and pres_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 90 DAY) AND CURDATE()";
			else if ($_GET['cmbPeriod']==4)
			$sql.=" and pres_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 180 DAY) AND CURDATE()";
			
			

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and pres_id like '%".$database->filter(str_replace("PH-","",$_GET['txtSearchByTitle']))."%'";

		}
		
		if (($_GET['cmbCategory']=="" || $_GET['cmbCategory']==1) && $_GET['ty']!="od")
			{
				$sql .= " and  (pres_stage='1' || (pres_stage=2 && pres_patient_query_status=1))";
			}
		
		else if($_GET['cmbCategory'] != "" && $_GET['ty']!="od" && $_GET['cmbCategory'] != "All")

		{
			
			
			$sql .= " and pres_stage='".$database->filter($_GET['cmbCategory'])."'";

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
			
			
		
		$curDate=date("Y-m-d H:i:s");
		
		if ($_POST['pid']!="")
		$pid=$_POST['pid'];
		else
		$pid=0;
		

		$names = array(
			'message_sender_id' => $_SESSION['sess_prescriber_id'],
			'message_sender_type' => 'Clinician', 
			'message_sent_to' => $_POST['rdUser'], 
			'message_pres_id' => $_POST['hid'], 
			'message_parent_reply' => $pid,			
			'message_date' => $curDate,
			'message_sender_status' => 0,
			'message_replier_status' => 0,
			'message_subject' => $_POST['txtSubject'],
			'message_text' => $_POST['txtMessage']
			


		);

		$add_query = $database->insert( 'tbl_messages', $names );


		getPresAction($_POST['hid'],$_SESSION['sess_prescriber_id'],'clinician','Sent a query to patient');
		
	
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
				'pres_pharmacy_note' => $_POST['txtPharmacyMsg'],
				'pres_clincian_update' => $curDate,
				'pres_stage' => $_POST['hdOutcomes']			

			);
			
			if ($_POST['hdOutcomes']==6)
			{
				$update2=array(
				'pres_pharmacy_stage' => 1 
				);
				
				getPresAction($_POST['hdId'],$_SESSION['sess_prescriber_id'],'clinician','Approved Prescription');
				
			}
			
			else if ($_POST['hdOutcomes']==4)
			{
				$update2=array(
				'pres_rejection_reason' => $_POST['txtReject'] 
				);
				
				getPresAction($_POST['hdId'],$_SESSION['sess_prescriber_id'],'clinician','Rejected Prescription');
				
				
			}
			
			else if ($_POST['hdOutcomes']==2)
			{
				$names = array(
				'message_sender_id' => $_SESSION['sess_prescriber_id'],
				'message_sender_type' => 'Clinician', 
				'message_sent_to' => "Patient", 
				'message_pres_id' => $_POST['hdId'], 
				'message_parent_reply' => 0,			
				'message_date' => $curDate,
				'message_sender_status' => 0,
				'message_replier_status' => 0,
				'message_subject' => $_POST['txtSubject'],
				'message_text' => $_POST['txtMessage']
				);

				$add_query = $database->insert( 'tbl_messages', $names );
				
				
				
				//-------end update stage
				
				getPresAction($_POST['hdId'],$_SESSION['sess_prescriber_id'],'clinician','Sent a query to patient');
				
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
			
			print "<script>window.location='index.php?c=".$component."&task=detail&id=".$id."#notes'</script>";
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

			'pres_id' => $_GET['pId']

		);
		$updated = $database->update( 'tbl_prescriptions', $update, $where_clause, 1 );

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}
			
	}


	function getUnassignedTotal()

	{

		global $database;
		$sql = "select count(*) as ctr from tbl_prescriptions where pres_stage>0 and pres_prescriber='0'";
		$res=$database->get_results($sql);
		$total=$res[0]['ctr'];
		return $total;

	}	
	
	function getOverDueTotal()

	{

		global $database;
		$sql = "select count(*) as ctr from tbl_prescriptions where (pres_stage=1 && pres_date <= DATE_SUB(NOW(), INTERVAL 3 DAY) || (pres_stage=2 and pres_patient_query_status=1 && pres_patient_query_date <= DATE_SUB(NOW(), INTERVAL 3 DAY) ))";
		$res=$database->get_results($sql);
		$total=$res[0]['ctr'];
		return $total;

	}	



?>