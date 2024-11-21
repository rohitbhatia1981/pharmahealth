<?php include "../../../private/settings.php"; 
if ($_SESSION['sess_pharmacy_id']=="")
exit;


	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=pharmacy-monthly-sales-report-".$_GET['m'].'-'.$_GET['y'].".xls" );
	
	// print your data here. note the following:
	// - cells/columns are separated by tabs ("\t")
	// - rows are separated by newlines ("\n")
	
	// for example:
	//echo 'Project Id' . "\t" . 'Project Name' . "\t" . 'Category' . 'DPR Cost (In Cr)' . "\t". 'Work Order Cost' . "\t". 'Physical Progress' . "\t". 'Implementing Agency' . "\t". 'Project being taken up' . "\t" . "\n";
	//echo 'ASCL-2' . "\t" . 'Redevelopment of Roads' . "\t" . 'Development' . "\t" . '5' . "\t" . '2'. "\t" . '20%' . "\t" . 'ASCL' . "\t" . 'City'. "\n";
	
	
	$arrHeading=array();
	
	$arrHeading[0] = "S.No.";
	$arrHeading[1] = "Order Date";
	$arrHeading[2] = "Order Id";
	$arrHeading[3] = "Patient Name";
	$arrHeading[4] = "Total Revenue";
	
	//$year=$_GET['y'];
	//$month=$_GET['m'];
	
	// $startDate = "$year-$month-01 00:00:00";
    // $endDate = date("Y-m-t 23:59:59", strtotime($startDate)); // t gives the last day of the month
	
	
	foreach($arrHeading as $x) {		
   		echo $x . "\t";
	}
	echo "\n";
	
	$sqlPayment = "
	SELECT 
    payment_date,
	payment_pres_id
	payment_id, 
	patient_first_name,
	patient_middle_name,
	patient_last_name,	
    payment_amount
   
FROM 
    tbl_payments, 
  	tbl_patients,
	tbl_pharmacies
WHERE 
	YEAR(payment_date) = ".$_GET['y']." AND MONTH(payment_date) = ".$_GET['m']."
   	and payment_status=1 
	and payment_patient_id=patient_id 
	and pharmacy_id=payment_pharmacy_id 
	and pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."'";
   
	$sqlPayment.=" order by payment_id desc";
						
		

		
	$results = $database->get_results( $sqlPayment );
	$totalRecords=count($results);
	
			if($totalRecords > 0) 				
				{
				$srno=0;
						for ($i = 0; $i < $totalRecords; $i++) 
							{
								$srno++;
								
								$rowPayment = $results[$i];
								
								//if ($rowPayment['payment_amount']==2) $refundAmount=$rowPayment['payment_amount']; else $refundAmount=0;
								//$date=date_create($rowPayment['patient_dob']); $dob=date_format($date,"d/m/Y");
								$totalRevenue=$rowPayment['payment_amount'];
								//$medicinesStr=str_replace("<br>"," ",getMedicationStringWithInfo($rowPayment['pres_id']));
								
								
								echo $srno . "\t";
								echo date("d/m/Y",strtotime($rowPayment['payment_date'])) . "\t";
								echo "PH-".$rowPayment['payment_pres_id'] . "\t";								
								echo $rowPayment['patient_first_name']." ".$rowPayment['patient_middle_name']." ".$rowPayment['patient_last_name'] . "\t";								
								echo $totalRevenue . "\t";								
								echo "\n";

							}
				}
	
?>
