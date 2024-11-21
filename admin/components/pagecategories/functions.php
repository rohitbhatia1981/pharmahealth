<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

		//$sql = "SELECT * FROM tbl_page_categories where 1 order by page_categories_name asc";


		$sql = "SELECT * FROM tbl_page_categories where 1";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and page_categories_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}

		$sql .= " order by page_categories_name asc";


		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		showRecordsListing( $results );		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		

		$page_categories = $_POST['category_title'];

		$page_meta_title = $_POST['page_meta_title'];

		$page_meta_keywords = $_POST['page_meta_keywords'];

		$page_meta_description = $_POST['page_meta_description'];	

		$categories_status = $_POST['rdoPublished'];

		

		

		$names = array(

			'page_categories_name' => $page_categories, 

			'page_categories_seo_title' => $page_meta_title, 

			'page_categories_seo_keywords' => $page_meta_keywords, 

			'page_categories_description' => $page_meta_description, 

			'page_categories_status' => $categories_status //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_page_categories', $names );

		$lastInsertedId=$database->lastid();

		if($_POST['images4ex'][0] != "")
		{
		$updateimage = array(
		'page_categories_banner_image' => $_POST['images4ex'][0]

		);

		$where_clause = array(
		'page_categories_id' => $lastInsertedId
		);

		$database->update( 'tbl_page_categories', $updateimage, $where_clause, 1 );
		}
		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}



		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_page_categories where page_categories_id  ='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			$page_categories = $_POST['category_title'];

			$page_meta_title = $_POST['page_meta_title'];
	
			$page_meta_keywords = $_POST['page_meta_keywords'];
	
			$page_meta_description = $_POST['page_meta_description'];	
	
			$categories_status = $_POST['rdoPublished'];

			$page_categories_id = $_POST['page_categories_id'];

			
	
			

			$update = array(


				'page_categories_name' => $page_categories, 

			'page_categories_seo_title' => $page_meta_title, 

			'page_categories_seo_keywords' => $page_meta_keywords, 

			'page_categories_description' => $page_meta_description, 
			
			'page_categories_banner_image' => $_POST['images4ex'][0],

			'page_categories_status' => $categories_status //Random thing to insert

			);

//Add the WHERE clauses

		$where_clause = array(

			'page_categories_id' => $page_categories_id

		);
	
		$updated = $database->update( 'tbl_page_categories', $update, $where_clause, 1 );

		$lastInsertedId=$page_categories_id;

		
		
		
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

				'page_categories_status' => 1

			);
			

			//Add the WHERE clauses

			$where_clause = array(

				'page_categories_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_page_categories', $update, $where_clause, 1 );

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

				'page_categories_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_categories_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_page_categories', $update, $where_clause, 1 );
			
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

				'page_categories_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_page_categories', $where_clause, 1 );

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

				'page_categories_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_page_categories', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

?>	