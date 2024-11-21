<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;


		$sql = "SELECT * FROM tbl_testimonials where 1";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and (testimonial_client like '%".$database->filter($_GET['txtSearchByTitle'])."%' || testimonial_text like '%".$database->filter($_GET['txtSearchByTitle'])."%')";

		}

		$sql .= " order by testimonial_id desc";

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

			'testimonial_client' => $_POST['txtClient'], 
			'testimonial_designation' => $_POST['txtDesignation'],
			'testimonial_text' => $_POST['txtDescription'], 
			'testimonial_image' => $_POST['images4ex'][0], 
			'testimonial_status' => $_POST['rdoPublished']

			

		);

		
		$add_query = $database->insert( 'tbl_testimonials', $names );
	
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

				

				$sql = "SELECT * FROM tbl_testimonials where testimonial_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;			

			$update = array(

			'testimonial_client' => $_POST['txtClient'], 
			'testimonial_designation' => $_POST['txtDesignation'],
			'testimonial_text' => $_POST['txtDescription'], 
			'testimonial_image' => $_POST['images4ex'][0], 
			'testimonial_status' => $_POST['rdoPublished']

				
			);

//Add the WHERE clauses

		$where_clause = array(

			'testimonial_id' => $_POST['id']

		);
		

		 $updated = $database->update( 'tbl_testimonials', $update, $where_clause, 1 ); 
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

				'testimonial_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'testimonial_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_testimonials', $update, $where_clause, 1 );

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

				'testimonial_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'testimonial_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_testimonials', $update, $where_clause, 1 );

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

				'testimonial_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_testimonials', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}
	
?>