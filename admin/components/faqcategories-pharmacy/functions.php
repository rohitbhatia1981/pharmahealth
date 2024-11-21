<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

		//$sql = "SELECT * FROM tbl_faq_categories_pharmacy where 1 order by faq_categories_name asc";

		$sql = "SELECT * FROM tbl_faq_categories_pharmacy where 1";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and faq_categories_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}

		$sql .= " order by faq_categories_id asc";

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		showRecordsListing( $results );		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		

		$faq_categories = $_POST['faqcat_title'];

		$faq_status = $_POST['rdoPublished'];

		

		

		$names = array(

			'faq_categories_name' => $faq_categories, 

			'faq_categories_status' => $faq_status //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_faq_categories_pharmacy', $names );
		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=9'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_faq_categories_pharmacy where faq_categories_id ='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			$faq_categories = $_POST['faqcat_title'];

			$faq_status = $_POST['rdoPublished'];
	
			$categories_id = $_POST['faqCat_id'];

			

			$update = array(


				'faq_categories_name' => $faq_categories, 

				'faq_categories_status' => $faq_status //Random thing to insert

			);

//Add the WHERE clauses

		$where_clause = array(

			'faq_categories_id' => $categories_id

		);
	
		$updated = $database->update( 'tbl_faq_categories_pharmacy', $update, $where_clause, 1 );
		
		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=9'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i]; 

			

			$update = array(

				'faq_categories_status' => 1

			);
			

			//Add the WHERE clauses

			$where_clause = array(

				'faq_categories_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_faq_categories_pharmacy', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=9'</script>";

		}

	}

	

	function unpublishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'faq_categories_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'faq_categories_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_faq_categories_pharmacy', $update, $where_clause, 1 );
			
		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=9'</script>";

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

				'faq_categories_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_faq_categories_pharmacy', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=9'</script>";

		}

	}

	function removeDeletedItems()

	{

		global $database,$component;	

		

			 $provinceIdToPublish = $_GET['id'];

			

			//Add the WHERE clauses

			$where_clause = array(

				'faq_categories_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_faq_categories_pharmacy', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=9'</script>";

		}

?>	