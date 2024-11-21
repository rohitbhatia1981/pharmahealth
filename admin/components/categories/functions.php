<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

		// $sql = "SELECT * FROM tbl_blog_categories where 1 order by categories_name asc";

			$sql = "SELECT * FROM tbl_blog_categories where 1";

			if($_GET['txtSearchByTitle'] != "")

			{

			$sql .= " and categories_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

			}

			$sql .= " order by categories_name asc";	

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		showRecordsListing( $results );		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		

		$blog_categories = $_POST['categories_title'];

		$blog_status = $_POST['rdoPublished'];

		

		

		$names = array(

			'categories_name' => $blog_categories, 

			'categories_status' => $blog_status //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_blog_categories', $names );
		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_blog_categories where categories_id ='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

				$categories_name = $_POST['categories_title'];

				$categories_status = $_POST['rdoPublished'];
	
				$categories_id = $_POST['categories_id'];

			

			$update = array(


				'categories_name' => $categories_name, 

				'categories_status' => $categories_status //Random thing to insert

			);

//Add the WHERE clauses

		$where_clause = array(

			'categories_id' => $categories_id

		);
	
		$updated = $database->update( 'tbl_blog_categories', $update, $where_clause, 1 );
		
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

				'categories_status' => 1

			);
			

			//Add the WHERE clauses

			$where_clause = array(

				'categories_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_blog_categories', $update, $where_clause, 1 );

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

				'categories_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'categories_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_blog_categories', $update, $where_clause, 1 );
			
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

				'categories_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_blog_categories', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

	}

	function removeDeletedItems()

	{

		global $database,$component;	

		

			 $provinceIdToPublish = $_GET['id'];

			

			//Add the WHERE clauses

			$where_clause = array(

				'categories_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_blog_categories', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

?>	