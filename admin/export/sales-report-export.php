<?php include "../../private/settings.php"; 
if ($_SESSION['user_id']=="")
exit;


	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=pharmahealth-sales-report-".$_GET['d'].$_GET['m'].$_GET['y'].".xls" );
	
	// print your data here. note the following:
	// - cells/columns are separated by tabs ("\t")
	// - rows are separated by newlines ("\n")
	
	// for example:
	//echo 'Project Id' . "\t" . 'Project Name' . "\t" . 'Category' . 'DPR Cost (In Cr)' . "\t". 'Work Order Cost' . "\t". 'Physical Progress' . "\t". 'Implementing Agency' . "\t". 'Project being taken up' . "\t" . "\n";
	//echo 'ASCL-2' . "\t" . 'Redevelopment of Roads' . "\t" . 'Development' . "\t" . '5' . "\t" . '2'. "\t" . '20%' . "\t" . 'ASCL' . "\t" . 'City'. "\n";
	
	
	$arrHeading=array();
	
	$arrHeading[0] = "S.No.";
	$arrHeading[1] = "Date";
	$arrHeading[2] = "Payment Received (in £)";
	$arrHeading[3] = "Estimated Clinician Fees";
	$arrHeading[4] = "Pharmacy Fees";
	$arrHeading[5] = "Medication Cost";
	$arrHeading[6] = "Amount Refunded";
	$arrHeading[7] = "Net Amount";
	$arrHeading[8] = "Medical Condition";
	$arrHeading[9] = "Medication";
	
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
	payment_id, 
    payment_amount,
    payment_consultation_cost,
    payment_pharmacy_profit,
    payment_medication_cost,
    payment_condition,
    payment_medicine_id ,
	payment_pharma_profit
FROM 
    tbl_payments, 
    tbl_prescriptions,
	tbl_patients
WHERE 
    pres_id=payment_pres_id
	and pres_patient_id=patient_id";
   
	
					if ($_GET['cmbConditions']!="")
						{
							$sqlPayment.=" and payment_condition='".$database->filter($_GET['cmbConditions'])."'";
						}
						
						if ($_GET['cmbMedication']!="")
						{
							$sqlPayment.=" and payment_medicine_id='".$database->filter($_GET['cmbMedication'])."'";
						}
						
						if ($_GET['txtSDate']!="")
						{
							 $startDate = $_GET['txtSDate']." 00:00:00";
							$sqlPayment.=" and payment_date>='".$database->filter($startDate)."'";
						}
						if ($_GET['txtEDate']!="")
						{
							$endDate = $database->filter($_GET['txtEDate']) . ' 23:59:59';
							$sqlPayment.=" and payment_date<='".$database->filter($endDate)."'";
						}
						
						$sqlPayment.=" order by payment_id desc";

		
	$results = $database->get_results( $sqlPayment );
	$totalRecords=count($results);
	
			if($totalRecords > 0) 				
				{
				$srno=0;
						for ($i = 0; $i < $totalRecords; $i++) 
							{
								$srno++;
								
								if ($rowPayment['payment_amount']==2) $refundAmount=$rowPayment['payment_amount']; else $refundAmount=0;
								
								
								
								$rowPayment = $results[$i];
								echo $srno . "\t";
								echo date("d/m/Y",strtotime($rowPayment['payment_date'])) . "\t";
								echo $rowPayment['payment_id'] . "\t";
								
								echo $rowPayment['payment_consultation_cost'] . "\t";
								echo $rowPayment['payment_pharmacy_profit'] . "\t";
								echo $rowPayment['payment_medication_cost'] . "\t";
								echo $refundAmount . "\t";	
								echo $rowPayment['payment_pharma_profit'] . "\t";							
								echo getConditionName($rowPayment['payment_condition']) . "\t";
								echo getMedicineName($rowPayment['payment_medicine_id']) . "\t";
								
								
								
								
								echo "\n";

							}
				}
	
?>
