<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

	
		  $sql = "SELECT * FROM tbl_tickets WHERE  message_parent=0";
		
		if($_GET['txtSearch'] != "")
		{
			$sql .= " and (message_subject like '%".$database->filter($_GET['txtSearch'])."%' || message_id like '%".$database->filter($_GET['txtSearch'])."%' || message_text like '%".$database->filter($_GET['txtSearch'])."%') ";

		}
		
		if($_GET['tkStatus'] == "1")
		$sql .= " and message_close=1 ";
		else
		$sql .= " and message_close=0 ";
		
		
		
		if($_GET['dtFrom'] != "")
		{
			$sql .= " and message_date>='".$_GET['dtFrom']."'";
		}
		
		if($_GET['dtTo'] != "")
		{
			$sql .= " and message_date<='".$_GET['dtTo']."'";
		}
		
		
		
		 $sql .= " order by message_id desc";
		
		//print_r($sql);
		
		
		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{
		global $database,$component;

	$fileCount = count($_FILES['flDoc']['name']);
		$arrFnamesSer=array();

		if ($fileCount>0)
		{
			
			$arrFileNames=array();
			
			for ($i = 0; $i < $fileCount; $i++) {
			$fileName = uniqid().$_FILES['flDoc']['name'][$i];
			$fileType = $_FILES['flDoc']['type'][$i];
			$fileTmpName = $_FILES['flDoc']['tmp_name'][$i];
			$fileError = $_FILES['flDoc']['error'][$i];
			$fileSize = $_FILES['flDoc']['size'][$i];	
			
			
			 if ($fileError === UPLOAD_ERR_OK) {
				
				$destination = PATH.'uploads/support/' . $fileName;
				move_uploaded_file($fileTmpName, $destination);
				//echo "File $fileName uploaded successfully.";
				array_push($arrFileNames,$fileName);
			}
			
			
		}
			
			$arrFnamesSer=serialize($arrFileNames);
			//print_r ($arrFnamesSer);
			
		 
		
		
		}
		
		
			
				
			
			
		$curDate=date("Y-m-d H:i:s");
		
		if ($_POST['hid']=="")
		$hid=0;
		else
		$hid=$_POST['hid'];
		
		

		$names = array(
			'message_sender_id' => $_SESSION['user_id'],
			'message_sender_type' => 'Admin', 
			'message_parent' => $hid,
			'message_date' => $curDate,
			'message_sender_status' => 0,
			'message_read_status_admin' => 1,
			'message_attachment' => $arrFnamesSer,			
			'message_text' => $_POST['txtMessage']
			


		);

		$add_query = $database->insert( 'tbl_tickets', $names );
		
		
		$updateStatus="update tbl_tickets set message_replier_status=1,message_read_status=0 where message_id='".$database->filter($hid)."'";
		$database->query($updateStatus);
		
			
		
		
		
				//----------Creating log--------
		
					/*$name=$_SESSION['name'];
					$uid=$_SESSION['user_id'];
					$utype="admin";
					$action=$name." has replied in support ticket";
					
					createLogs($uid,$utype,$action);*/
		
				//----------end creating log
		
		
		
			
			print "<script>window.location='index.php?c=".$component."'</script>";

		

	

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_pages where page_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}
	
	
	function createFormForPages_detail($id)
			{
				global $database;
				$sql = "SELECT * FROM tbl_patients where patient_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_details($results);

			}

	
	function closeTicket($id)
	{
		global $database,$component;
		
		
		$update = array(
			'message_close' => 1
		);

			//Add the WHERE clauses
			$where_clause = array(
				'message_id' => $id
			);

			$updated = $database->update( 'tbl_tickets', $update, $where_clause, 1 );
					
			print "<script>window.location='index.php?c=".$component."&task=detail&id=".$id."'</script>";
	}

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			

				$pagetitleEntered = $_POST['page_title'];

				$pagedescEntered = $_POST['page_description'];

				$pagePublishedEntered = $_POST['rdoPublished'];	

				$page_categories = $_POST['txtCategories'];

				$pageId=$_POST['pageId'];

			

			$update = array(

				'page_title' => $pagetitleEntered, 

				'page_description' => $pagedescEntered,

				'page_categories' => $page_categories, 			

				'page_status' => $pagePublishedEntered

			);

//Add the WHERE clauses

		$where_clause = array(

			'page_id' => $pageId

		);
		$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

		

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

				'page_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

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

				'page_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

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

				'page_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_pages', $where_clause, 1 );

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