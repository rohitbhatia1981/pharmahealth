<?php
	function showList()
	{	

	global $database, $page, $pagingObject;
		
			$sql = "SELECT * FROM tbl_marketing where 1";
			if($_GET['txtSearchByTitle'] != "")
			{
			$sql .= " and (file_title like '%".$database->filter($_GET['txtSearchByTitle'])."%') ";
			}

			$sql .= " order by file_title asc";	

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		showRecordsListing( $results );		

	}



	function saveFormValues()
	{
	global $database, $component;		

		$curDate=date("Y-m-d");	
		
		
		$for=implode(",",$_POST['ckFor']);	

		$names = array(

			'file_title' => $_POST['txtTitle'],
			'file_for' => $for,			
			'file_last_updated' => $curDate,
			'file_status' => 1
		);

		$add_query = $database->insert( 'tbl_marketing', $names );
		$lastInsertedId=$database->lastid();
		
		if($_FILES['flFile']['name'] != "")
			{					

				$fileTitle=str_replace(" ","-",$_POST['txtTitle']);
				
				$target1 = PATH."uploads/marketing/";
				$filename=$fileTitle."-".md5(uniqid());				
				$file_ext=strtolower(end(explode('.',$_FILES['flFile']['name'])));	
				$fileName=$filename.'-'.$lastInsertedId.'.'.$file_ext;
				move_uploaded_file($_FILES['flFile']['tmp_name'],$target1.$fileName);

				$updateApp = array(
					'file_name' => $fileName, 					
				);
				
				$where_clause = array(
				'file_id' => $lastInsertedId
				);
			
				$database->update( 'tbl_marketing', $updateApp, $where_clause, 1 );
			}
		
		
		if( $add_query )
		{
			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}

	

	function createFormForPages($id)
			{
				global $database;			

				$sql = "SELECT * FROM tbl_marketing where file_id ='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()
	{	

			global $database,$component;
						
			$curDate=date("Y-m-d");	
			
			$for=implode(",",$_POST['ckFor']);	
			
			$update = array(
			'file_title' => $_POST['txtTitle'],
			'file_for' => $for,			
			'file_last_updated' => $curDate,
			
			

			);
			
	

//Add the WHERE clauses

		$where_clause = array(

			'file_id' => $_POST['id']

		);
	
		$updated = $database->update( 'tbl_marketing', $update, $where_clause, 1 );
		
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

				'file_status' => 1

			);
			

			

			$where_clause = array(

				'file_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_marketing', $update, $where_clause, 1 );

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

				'file_status' => 0

			);

			


			$where_clause = array(

				'file_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_marketing', $update, $where_clause, 1 );
			
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

		

			$where_clause = array(

				'file_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_marketing', $where_clause, 1 );

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

				'file_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_marketing', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}


?>	