<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;


		$sql = "SELECT * FROM tbl_clinical_team where 1";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and (team_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || team_designation like '%".$database->filter($_GET['txtSearchByTitle'])."%' || team_description like '%".$database->filter($_GET['txtSearchByTitle'])."%')";

		}

		$sql .= " order by team_id desc";

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

			'team_name' => $_POST['txtName'], 
			'team_designation' => $_POST['txtDesignation'],
			'team_gphc' => $_POST['txtGphc'],
			'team_description' => $_POST['txtDescription'], 
			'team_image' => $_POST['images4ex'][0], 
			'team_status' => $_POST['rdoPublished']

			

		);

		
		$add_query = $database->insert( 'tbl_clinical_team', $names );
	
		$lastInsertedId=$database->lastid();

		

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_clinical_team where team_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;			

			$update = array(

			'team_name' => $_POST['txtName'], 
			'team_designation' => $_POST['txtDesignation'],
			'team_gphc' => $_POST['txtGphc'],			
			'team_description' => $_POST['txtDescription'], 
			'team_image' => $_POST['images4ex'][0], 
			'team_status' => $_POST['rdoPublished']

				
			);

//Add the WHERE clauses

		$where_clause = array(

			'team_id' => $_POST['id']

		);
		

		 $updated = $database->update( 'tbl_clinical_team', $update, $where_clause, 1 ); 
		 $lastInsertedId=$database->lastid();

		

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'team_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'team_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_clinical_team', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

	}

	

	function unpublishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'team_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'team_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_clinical_team', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

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

				'team_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_clinical_team', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}
	
?>