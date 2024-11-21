<?php
	function showList()
	{	

	global $database, $page, $pagingObject;
		
			$sql = "SELECT * FROM tbl_marketing WHERE file_for like '%Pharmacy%'";
			
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



	
?>	