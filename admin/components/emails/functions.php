<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


		$sql = "SELECT * FROM tbl_emails where 1";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and email_title like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}

		$sql .= "";


		//print_r($sql);

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		

				

		$names = array(

			'email_title' => $_POST['txtTitle'], 			
			'email_description' => $_POST['page_description'],						  
			'email_status' => $_POST['rdoPublished'] //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_emails', $names );

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;				

				$sql = "SELECT * FROM tbl_emails where email_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );		

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

		

			$update = array(

			'email_title' => $_POST['txtTitle'], 			
			'email_description' => $_POST['page_description'],						  
			'email_status' => $_POST['rdoPublished'] 

			);

//Add the WHERE clauses

		$where_clause = array(

			'email_id' => $_POST['pageId']

		);
		$updated = $database->update( 'tbl_emails', $update, $where_clause, 1 );

		

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

				'email_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'email_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_emails', $update, $where_clause, 1 );

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

				'email_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'email_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_emails', $update, $where_clause, 1 );

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

				'email_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_emails', $where_clause, 1 );

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

				'email_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_emails', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



?>