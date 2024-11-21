<?php	function showList()
	{


	global $database, $page, $pagingObject;


		$sql = "SELECT * FROM tbl_bank_holidays where 1";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and (holiday_title like '%".$database->filter($_GET['txtSearchByTitle'])."%')";

		}

		$sql .= " order by holiday_date asc";

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
			'holiday_title' => $_POST['txtHoliday'], 
			'holiday_date' => $_POST['txtHolidayDate'],			
			'holiday_status' => $_POST['rdoPublished']	

		);

		
		$add_query = $database->insert( 'tbl_bank_holidays', $names );	

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}

	

	function createFormForPages($id)
			{
				global $database;		

				$sql = "SELECT * FROM tbl_bank_holidays where holiday_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{
			global $database,$component;	
			$update = array(
			'holiday_title' => $_POST['txtHoliday'], 
			'holiday_date' => $_POST['txtHolidayDate'],			
			'holiday_status' => $_POST['rdoPublished']	
				
			);

//Add the WHERE clauses

		$where_clause = array(
			'holiday_id' => $_POST['id']
		);
		

		 $updated = $database->update( 'tbl_bank_holidays', $update, $where_clause, 1 ); 
		 	

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
				'holiday_status' => 1
			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'holiday_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_bank_holidays', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}

	

	function unpublishSelectedItems()

	{

		global $database,$component;	
		for($i = 0; $i < count($_GET['deletes']); $i++)
		{

			 $provinceIdToPublish = $_GET['deletes'][$i]; 
			$update = array(
				'holiday_status' => 0
			);		

			//Add the WHERE clauses

			$where_clause = array(
				'holiday_id' => $provinceIdToPublish
			);
			$updated = $database->update( 'tbl_bank_holidays', $update, $where_clause, 1 );

		}	

		if( $updated )
		{
			print "<script>window.location='index.php?c=".$component."'</script>";

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

				'holiday_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_bank_holidays', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}
	
?>