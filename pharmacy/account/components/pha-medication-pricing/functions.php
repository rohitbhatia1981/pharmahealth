<?php



	function showList()
	{	

	global $database, $page, $pagingObject;				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


		$sql = "SELECT * FROM tbl_medication,tbl_medication_pricing where mp_medicine=med_id";

		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and med_title like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}
		
		if($_GET['cmbCategory'] != "")
		{
			$sql .= " and find_in_set ('".$database->filter($_GET['cmbCategory'])."',med_conditions) ";
		}

		$sql .= " order by med_title asc";


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

			'mp_medicine' => $_POST['txtMedication'],
			'mp_strength' => $_POST['txtStrength'], 
			'mp_unit' => $_POST['txtUnit'],
			'mp_pres_type' => $_POST['txtPresType'], 
			'mp_formulation' => $_POST['txtFormulation'],
			'mp_pack_size' => $_POST['txtPackSize'],			
			'mp_pack_unit' => $_POST['txtPackUnit'],			
			'mp_quantity' => 1,					  
			'mp_cost_price' => $_POST['txtCostPrice'],
			'mp_condition1' => $_POST['mp_condition1'],
			'mp_condition1_max_qty' => $_POST['txtMaxQuantity1'],
			'mp_condition1_interval_days' => $_POST['txtInterval1'],
			'mp_condition2' => $_POST['mp_condition2'],
			'mp_condition2_max_qty' => $_POST['txtMaxQuantity2'],
			'mp_condition2_interval_days' => $_POST['txtInterval2'],
			'mp_condition3' => $_POST['mp_condition3'],
			'mp_condition3_max_qty' => $_POST['txtMaxQuantity3'],
			'mp_condition3_interval_days' => $_POST['txtInterval3'],
			'mp_medication_cost' => $_POST['mp_medication_cost'],
			
			'mp_dosage1' => $_POST['txtDosage1'],
			'mp_dosage2' => $_POST['txtDosage2'],
			'mp_length_treatment' => $_POST['txtApproxLength'],
			'mp_in_stock' => $_POST['rdoStock']

		);

		$add_query = $database->insert( 'tbl_medication_pricing', $names );

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&cmbCategory=".$_POST['hdCatId']."'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;				

				$sql = "SELECT * FROM tbl_medication_pricing where mp_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );		

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()
	{

			global $database,$component;	

			$update = array(

			'mp_medicine' => $_POST['txtMedication'],
			'mp_strength' => $_POST['txtStrength'], 
			'mp_unit' => $_POST['txtUnit'],
			'mp_pres_type' => $_POST['txtPresType'], 
			'mp_formulation' => $_POST['txtFormulation'],
			'mp_pack_size' => $_POST['txtPackSize'],			
			'mp_pack_unit' => $_POST['txtPackUnit'],			
			'mp_quantity' => 1,					  
			'mp_cost_price' => $_POST['txtCostPrice'],
			'mp_condition1' => $_POST['mp_condition1'],
			'mp_condition1_max_qty' => $_POST['txtMaxQuantity1'],
			'mp_condition1_interval_days' => $_POST['txtInterval1'],
			'mp_condition2' => $_POST['mp_condition2'],
			'mp_condition2_max_qty' => $_POST['txtMaxQuantity2'],
			'mp_condition2_interval_days' => $_POST['txtInterval2'],
			'mp_condition3' => $_POST['mp_condition3'],
			'mp_condition3_max_qty' => $_POST['txtMaxQuantity3'],
			'mp_condition3_interval_days' => $_POST['txtInterval3'],
			'mp_medication_cost' => $_POST['txtMedCost'],			
			'mp_dosage1' => $_POST['txtDosage1'],
			'mp_dosage2' => $_POST['txtDosage2'],
			'mp_length_treatment' => $_POST['txtApproxLength'],
			'mp_in_stock' => $_POST['rdoStock']

			);

//Add the WHERE clauses
		
		

		$where_clause = array(

			'mp_id' => $_POST['pageId']

		);
		$updated = $database->update( 'tbl_medication_pricing', $update, $where_clause, 1 );

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&task=edit&id=".$_POST['pageId']."'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];
		 

			$update = array(

				'mp_in_stock' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'mp_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_medication_pricing', $update, $where_clause, 1 );

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

				'mp_in_stock' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'mp_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_medication_pricing', $update, $where_clause, 1 );

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

				'mp_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_medication_pricing', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}


	

		



?>