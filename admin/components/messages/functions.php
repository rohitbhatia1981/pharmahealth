<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


	 $sql = "SELECT message_id,message_pres_id, message_sender_id, message_read_status, message_sender_type, message_sent_to, message_pres_id, message_subject, message_text, message_date, pres_id,pres_condition FROM tbl_messages,tbl_prescriptions where pres_id=message_pres_id and message_sent_to='Admin' ";
	 
	 
	 if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and (message_pres_id like '%".$database->filter(str_replace("PH-","",$_GET['txtSearchByTitle']))."%' || message_subject like '%".$database->filter($_GET['txtSearchByTitle'])."%' || message_text like '%".$database->filter($_GET['txtSearchByTitle'])."%')";

		}
	
	if($_GET['txtSDate'] != "")

		{
			$sql.=" and message_date >='".$database->filter($_GET['txtSDate'])." 00:00:00' ";

		}
		
		if($_GET['txtEDate'] != "")

		{
			$sql.=" and message_date <='".$database->filter($_GET['txtEDate'])." 23:59:59'";

		}
		
	if ($_GET['usertype']!="")
	$sql.=" and message_sender_type='".$database->filter($_GET['usertype'])."'";		

		
		/*if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and (patient_first_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_middle_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_last_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_id like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_email like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%') ";

		}		
		if($_GET['cmbCategory'] != "")
		{

			$sql .= " and patient_kyc='".$database->filter($_GET['cmbCategory'])."'";

		}*/
		$sql .= " order by message_id desc";
		
		//print_r($sql);
		
		
		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

function removeSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			$provinceIdToPublish = $_GET['deletes'][$i];

			

			

			//Add the WHERE clauses

			$where_clause = array(

				'message_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_messages', $where_clause, 1 );

		}


		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}


	





?>