<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


		$sql = "SELECT * FROM tbl_conditions where 1";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and condition_title like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}

		$sql .= " order by condition_title asc";


		//print_r($sql);

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		
		if (count($_POST['ckCategory'])>0)			
		$strCategory=implode(",",$_POST['ckCategory']);
				

		$names = array(

			'condition_title' => $_POST['txtTitle'], 
			'condition_sub_title' => $_POST['txtSubTitle'], 
			'condition_category' => $strCategory, 
			'condition_short_desc' => $_POST['txtShortDesc'],
			
			'condition_overview' => $_POST['txtOverview'],
			'condition_home_icon' => $_POST['images4ex'][0],
			
			'condition_listing_icon' => $_POST['imgListing'][0],
			'condition_detail_banner' => $_POST['imgDetail'][0],
						
			'condition_symptoms' => $_POST['txtSymptoms'],
			'condition_causes' => $_POST['txtCauses'],
			'condition_treatments' => $_POST['txtTreatments'],
			'condition_alt_treatments' => $_POST['txtAltTreatments'],
			'condition_disclaimer_content' => $_POST['txtDisclaimer'],
			'condition_agreement' => $_POST['txtAgreement'],	
			'condition_followup' => $_POST['rdoFollowup'],		  
			'condition_status' => $_POST['rdoPublished'] //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_conditions', $names );

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;				

				$sql = "SELECT * FROM tbl_conditions where condition_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );		

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			

				$pagetitleEntered = $_POST['page_title'];

				$pagedescEntered = $_POST['page_description'];

				$pagePublishedEntered = $_POST['rdoPublished'];	

				$page_categories = $_POST['txtCategories'];

				$pageId=$_POST['pageId'];
			
			$strCategory="";
			
			if (count($_POST['ckCategory'])>0)			
			$strCategory=implode(",",$_POST['ckCategory']);
			

			$update = array(

			'condition_title' => $_POST['txtTitle'], 
			'condition_sub_title' => $_POST['txtSubTitle'], 
			'condition_category' => $strCategory, 
			'condition_short_desc' => $_POST['txtShortDesc'],
			
			'condition_overview' => $_POST['txtOverview'],
			'condition_home_icon' => $_POST['images4ex'][0],
			
			'condition_listing_icon' => $_POST['imgListing'][0],
			'condition_detail_banner' => $_POST['imgDetail'][0],
						
			'condition_symptoms' => $_POST['txtSymptoms'],
			'condition_causes' => $_POST['txtCauses'],
			'condition_treatments' => $_POST['txtTreatments'],
			'condition_alt_treatments' => $_POST['txtAltTreatments'],
			'condition_disclaimer_content' => $_POST['txtDisclaimer'],
			'condition_agreement' => $_POST['txtAgreement'],	
			'condition_followup' => $_POST['rdoFollowup'],				  
			'condition_status' => $_POST['rdoPublished']

			);

//Add the WHERE clauses

		$where_clause = array(

			'condition_id' => $pageId

		);
		
		
		
		$updated = $database->update( 'tbl_conditions', $update, $where_clause, 1 );

		

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

				'condition_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'condition_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_conditions', $update, $where_clause, 1 );

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

				'condition_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'condition_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_conditions', $update, $where_clause, 1 );

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

				'condition_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_conditions', $where_clause, 1 );

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