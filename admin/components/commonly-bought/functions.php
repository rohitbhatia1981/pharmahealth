<?php



	function showList()
	{	

	global $database, $page, $pagingObject;				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


		$sql = "SELECT * FROM tbl_commonly_bought where 1";

		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and med_c_title like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}

		$sql .= " order by med_c_title asc";


		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		
				

		$names = array(

			'med_c_title' => $_POST['txtTitle'],			
			'med_c_image' => $_POST['images4ex'][0],
			'med_c_price' => $_POST['txtPrice'],
			'med_c_desc' => $_POST['txtDescription'],
			'med_c_dosage1' => $_POST['txtDosage1'],
			'med_c_dosage2' => $_POST['txtDosage2'],							  
			'med_c_status' => $_POST['rdoPublished'] //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_commonly_bought', $names );

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;				

				$sql = "SELECT * FROM tbl_commonly_bought where med_c_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );		

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			

			
			
		
			

			
			
			

			$update = array(

			'med_c_title' => $_POST['txtTitle'],
			
			'med_c_price' => $_POST['txtPrice'],
			'med_c_desc' => $_POST['txtDescription'],
			'med_c_dosage1' => $_POST['txtDosage1'],
			'med_c_dosage2' => $_POST['txtDosage2'],
			'med_c_image' => $_POST['images4ex'][0],							  
			'med_c_status' => $_POST['rdoPublished'] //Random thing to insert

			);

//Add the WHERE clauses

		$where_clause = array(

			'med_c_id' => $_POST['pageId']

		);
		$updated = $database->update( 'tbl_commonly_bought', $update, $where_clause, 1 );

		

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

				'med_c_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'med_c_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_commonly_bought', $update, $where_clause, 1 );

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

				'med_c_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'med_c_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_commonly_bought', $update, $where_clause, 1 );

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

				'med_c_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_commonly_bought', $where_clause, 1 );

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