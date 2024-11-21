<?php include "../../private/settings.php"; 
if ($_SESSION['user_id']=="")
exit;


	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=pharmacy-sales-report-".$_GET['d'].$_GET['m'].$_GET['y'].".xls" );
	
	// print your data here. note the following:
	// - cells/columns are separated by tabs ("\t")
	// - rows are separated by newlines ("\n")
	
	// for example:
	//echo 'Project Id' . "\t" . 'Project Name' . "\t" . 'Category' . 'DPR Cost (In Cr)' . "\t". 'Work Order Cost' . "\t". 'Physical Progress' . "\t". 'Implementing Agency' . "\t". 'Project being taken up' . "\t" . "\n";
	//echo 'ASCL-2' . "\t" . 'Redevelopment of Roads' . "\t" . 'Development' . "\t" . '5' . "\t" . '2'. "\t" . '20%' . "\t" . 'ASCL' . "\t" . 'City'. "\n";
	
	
	$arrHeading=array();
	
	$arrHeading[0] = "S.No.";
	$arrHeading[1] = "Pharmacy Name";
	$arrHeading[2] = "Pharmacy Address";
	$arrHeading[3] = "Pharmacy Phone";
	$arrHeading[4] = "Sale Amount";
	
	
	//$year=$_GET['y'];
	//$month=$_GET['m'];
	
	// $startDate = "$year-$month-01 00:00:00";
    // $endDate = date("Y-m-t 23:59:59", strtotime($startDate)); // t gives the last day of the month
	
	
	foreach($arrHeading as $x) {		
   		echo $x . "\t";
	}
	echo "\n";
	
	$sql = "
	SELECT 
    pharmacy_id,
	pharmacy_address,
	pharmacy_city,
	pharmacy_postcode,
	pharmacy_name,
	pharmacy_o_mobile
	FROM 
    tbl_pharmacies 
   
WHERE
   1";
   
	
					if ($_GET['cmbPharmacy']!="")
						{
							$sql.=" and pharmacy_id='".$database->filter($_GET['cmbPharmacy'])."'";
						}
						
						
						
					$sql.=" order by pharmacy_name asc";
					

		
	$results = $database->get_results( $sql );
	$totalRecords=count($results);
	
			if($totalRecords > 0) 				
				{
				$srno=0;
						for ($i = 0; $i < $totalRecords; $i++) 
							{
								$srno++;
								
								
								$row = $results[$i];
								
								$address=$row['pharmacy_address'].", ".$row['pharmacy_city'].", ".$row['pharmacy_postcode'];
								
								if ($_GET['txtSDate']!="")
								$sDate=$_GET['txtSDate'];
								if ($_GET['txtEDate']!="")
								$eDate=$_GET['txtEDate']; 
								$saleAmount=getPharmacyIncome($row['pharmacy_id'],$sDate,$eDate);
								
								echo $srno . "\t";								
								echo $row['pharmacy_name'] . "\t";
								echo $address . "\t";
								echo $row['pharmacy_o_mobile'] . "\t";
								echo $saleAmount . "\t";
								
								
								
								
								
								echo "\n";

							}
				}
	
?>
