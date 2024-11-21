<?php



	function showList()
	{	

	global $database, $page, $pagingObject;				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


		$sql = "SELECT * FROM tbl_medication where 1";

		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and med_title like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}
		
		if($_GET['cmbCategory'] != "")
		{
			$sql .= " and find_in_set ('".$database->filter($_GET['cmbCategory'])."',med_conditions) ";
		}

		$sql .= " order by med_title asc";


		//print_r($sql);

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		$strConditions="";
		
		if (count($_POST['ckConditions'])>0)			
		$strConditions=implode(",",$_POST['ckConditions']);
				

		$names = array(

			'med_title' => $_POST['txtTitle'],
			'med_conditions' => $strConditions, 
			'med_image' => $_POST['images4ex'][0],
			'med_highlights' => $_POST['txtHighlights'], 
			'med_description' => $_POST['txtDescription'],
			'med_directions' => $_POST['txtDirections'],			
			'med_side_effects' => $_POST['txtSideEffects'],			
			'med_warnings' => $_POST['txtWarnings'],					  
			'med_status' => $_POST['rdoPublished'] //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_medication', $names );

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&cmbCategory=".$_POST['hdCatId']."'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;				

				$sql = "SELECT * FROM tbl_medication where med_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );		

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			

			
			
			$strConditions="";
		
			if (count($_POST['ckConditions'])>0)			
			$strConditions=implode(",",$_POST['ckConditions']);
			

			
			
			

			$update = array(

			'med_title' => $_POST['txtTitle'],
			'med_conditions' => $strConditions, 
			'med_image' => $_POST['images4ex'][0],
			'med_highlights' => $_POST['txtHighlights'], 
			'med_description' => $_POST['txtDescription'],
			'med_directions' => $_POST['txtDirections'],			
			'med_side_effects' => $_POST['txtSideEffects'],			
			'med_warnings' => $_POST['txtWarnings'],					  
			'med_status' => $_POST['rdoPublished']

			);

//Add the WHERE clauses

		$where_clause = array(

			'med_id' => $_POST['pageId']

		);
		$updated = $database->update( 'tbl_medication', $update, $where_clause, 1 );

		

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

				'med_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'med_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_medication', $update, $where_clause, 1 );

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

				'med_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'med_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_medication', $update, $where_clause, 1 );

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

				'med_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_medication', $where_clause, 1 );

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