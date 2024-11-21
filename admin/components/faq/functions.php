<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_faq where 1 order by page_title asc";


		$sql = "SELECT * FROM tbl_faq where 1";

		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and faq_question like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}
		
		if($_GET['cmbCategory'] != "")
		{
			$sql .= " and faq_category='".$database->filter($_GET['cmbCategory'])."' ";

		}

		$sql .= " order by faq_question asc";


		//print_r($sql);

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		

		$faq_question = $_POST['faq_question'];

		$faq_answer = $_POST['faq_answer'];

		$faq_status = $_POST['rdoPublished'];

		$faq_category = $_POST['faq_category'];

		



		

		

		$names = array(

			'faq_question' => $faq_question, 
			'faq_answer' => $faq_answer, 
			'faq_category' => $faq_category,			
			'faq_display_on_home' => $_POST['rdoHome'],
			'faq_status' => $faq_status //Random thing to insert

		);
		$add_query = $database->insert( 'tbl_faq', $names );
		

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=9'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_faq where faq_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			
		$faq_question = $_POST['faq_question'];
		$faq_answer = $_POST['faq_answer'];
		$faq_status = $_POST['rdoPublished'];
		$faq_category = $_POST['faq_category'];

						

			$update = array(

			'faq_question' => $faq_question, 
			'faq_answer' => $faq_answer, 
			'faq_category' => $faq_category,			
			'faq_display_on_home' => $_POST['rdoHome'],
			'faq_status' => $faq_status //Random thing to insert

			);

//Add the WHERE clauses

		$where_clause = array(

			'faq_id' => $_POST['pageId']

		);
		$updated = $database->update( 'tbl_faq', $update, $where_clause, 1 );

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'faq_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'faq_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

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

				'faq_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'faq_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_faq', $update, $where_clause, 1 );

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

				'faq_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_faq', $where_clause, 1 );

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

				'faq_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_faq', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=9'</script>";

		}

		



?>