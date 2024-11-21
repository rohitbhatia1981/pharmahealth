<?php



	function showList()
	{	

	global $database, $page, $pagingObject;				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


		$sql = "SELECT lcb_id,condition_title,med_title, lcb_common_or_option, lcb_common_and_option FROM tbl_link_commonly_bought,tbl_medication,tbl_conditions where lcb_medication=med_id and lcb_condition=condition_id";

		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and med_title like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}
		
		if($_GET['cmbCategory'] != "")
		{
			$sql .=" and lcb_condition='".$database->filter($_GET['cmbCategory'])."'";
		}

		$sql .= " order by condition_title asc, med_title asc";


		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		
		$conditions=$_POST['ckConditions'];
		$medication=$_POST['cmbMedication'];
		
		if (isset($_POST['cmbCommon1']))
		{
			if (count($_POST['cmbCommon1'])>0)
			$strCommon1=implode(",",$_POST['cmbCommon1']);
			
		}
		
		if (isset($_POST['cmbCommon2']))
		{
			if (count($_POST['cmbCommon2'])>0)
			$strCommon2=implode(",",$_POST['cmbCommon2']);
			
		}
		
		$names = array(
			'lcb_condition' => $conditions,			
			'lcb_medication' => $medication,
			'lcb_common_or_option' => $strCommon1,
			'lcb_common_and_option' => $strCommon2			

		);

		$add_query = $database->insert( 'tbl_link_commonly_bought', $names );

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;				

				$sql = "SELECT * FROM tbl_link_commonly_bought where lcb_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );		

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

		
			$conditions=$_POST['ckConditions'];
			$medication=$_POST['cmbMedication'];
			
			if (isset($_POST['cmbCommon1']))
			{
				if (count($_POST['cmbCommon1'])>0)
				$strCommon1=implode(",",$_POST['cmbCommon1']);
				
			}
			
			if (isset($_POST['cmbCommon2']))
			{
				if (count($_POST['cmbCommon2'])>0)
				$strCommon2=implode(",",$_POST['cmbCommon2']);
				
			}

			$update = array(

			'lcb_condition' => $conditions,			
			'lcb_medication' => $medication,
			'lcb_common_or_option' => $strCommon1,
			'lcb_common_and_option' => $strCommon2	

			);

//Add the WHERE clauses

		$where_clause = array(

			'lcb_id' => $_POST['pageId']

		);
		$updated = $database->update( 'tbl_link_commonly_bought', $update, $where_clause, 1 );

		

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
				'lcb_id' => $provinceIdToPublish
			);
			$delete = $database->delete( 'tbl_link_commonly_bought', $where_clause, 1 );

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