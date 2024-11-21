<?php include "../../../private/settings.php"; 
if ($_SESSION['sess_pharmacy_id']=="")
exit;


	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=pharmacy-uncollected-report-".$_GET['d'].$_GET['m'].$_GET['y'].".xls" );
	
	// print your data here. note the following:
	// - cells/columns are separated by tabs ("\t")
	// - rows are separated by newlines ("\n")
	
	// for example:
	//echo 'Project Id' . "\t" . 'Project Name' . "\t" . 'Category' . 'DPR Cost (In Cr)' . "\t". 'Work Order Cost' . "\t". 'Physical Progress' . "\t". 'Implementing Agency' . "\t". 'Project being taken up' . "\t" . "\n";
	//echo 'ASCL-2' . "\t" . 'Redevelopment of Roads' . "\t" . 'Development' . "\t" . '5' . "\t" . '2'. "\t" . '20%' . "\t" . 'ASCL' . "\t" . 'City'. "\n";
	
	
	$arrHeading=array();
	
	$arrHeading[0] = "S.No.";
	$arrHeading[1] = "Patient Name";
	$arrHeading[2] = "DOB";
	$arrHeading[3] = "Patient Phone";
	$arrHeading[4] = "Patient Email";	
	$arrHeading[5] = "Medication";
	$arrHeading[6] = "Medical Condition";
	$arrHeading[7] = "Prescription ID";
	$arrHeading[8] = "Order Approved Date";
	$arrHeading[9] = "Pending to Collect";
	
	//$year=$_GET['y'];
	//$month=$_GET['m'];
	
	// $startDate = "$year-$month-01 00:00:00";
    // $endDate = date("Y-m-t 23:59:59", strtotime($startDate)); // t gives the last day of the month
	
	
	foreach($arrHeading as $x) {		
   		echo $x . "\t";
	}
	echo "\n";
	
	$sqlPayment = "	SELECT patient_first_name, patient_middle_name,patient_last_name, patient_phone, patient_email, pres_condition, pres_id, payment_condition,	pres_pharmacy_action_date from tbl_payments, tbl_prescriptions,tbl_patients,tbl_pharmacies where pres_id=payment_pres_id and payment_status=1 and pres_patient_id=patient_id and pharmacy_id=payment_pharmacy_id and pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."' and pres_pharmacy_stage=3 ";
   
	if ($_GET['cmbPeriod']==1)	
						{		
						
							  $startDate = date('Y-m-01'); // First day of the current month
       						 $endDate = date('Y-m-t'); // Last day of the current month	
							 		
							$sqlPayment.=" and DATE(pres_pharmacy_action_date) BETWEEN '$startDate' AND '$endDate'";
						} else if ($_GET['cmbPeriod']==2)	
						{		
						
							 $startDate = date('Y-m-01', strtotime('first day of last month')); // First day of the last month
       						 $endDate = date('Y-m-t', strtotime('last day of last month')); // Last day of the last month
							 		
							$sqlPayment.=" and DATE(pres_pharmacy_action_date) BETWEEN '$startDate' AND '$endDate'";
						}
						
						else if ($_GET['cmbPeriod']==3)	
						{		
						
							 $startDate = date('Y-m-d', strtotime('-3 months'));
       						
							 		
							$sqlPayment.=" and DATE(pres_pharmacy_action_date) BETWEEN '$startDate' AND '$currentDate'";
						}
						
						else if ($_GET['cmbPeriod']==4)	
						{		
						
							 $startDate = date('Y-m-d', strtotime('-6 months'));
       						
							 		
							$sqlPayment.=" and DATE(pres_pharmacy_action_date) BETWEEN '$startDate' AND '$currentDate'";
						}
						
						else if ($_GET['cmbPeriod']==5)	
						{		
						
							 $startDate = date('Y-m-d', strtotime('-12 months'));
       						
							 		
							$sqlPayment.=" and DATE(pres_pharmacy_action_date) BETWEEN '$startDate' AND '$currentDate'";
						}
						
						
						if ($_GET['cmbConditions']!="")
						{
							$sqlPayment.=" and payment_condition='".$database->filter($_GET['cmbConditions'])."'";
						}
						
						
						if ($_GET['cmbPeriod']==6)
						{
							if ($_GET['txtSDate']!="")
							{
								 $startDate = $_GET['txtSDate']." 00:00:00";
								$sqlPayment.=" and pres_pharmacy_action_date>='".$database->filter($startDate)."'";
							}
							if ($_GET['txtEDate']!="")
							{
								$endDate = $database->filter($_GET['txtEDate']) . ' 23:59:59';
								$sqlPayment.=" and pres_pharmacy_action_date<='".$database->filter($endDate)."'";
							}
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
								
								$rowPayment = $results[$i];
								
								$dateOrder=date_create($rowPayment['pres_pharmacy_action_date']); 
								$dateOrder=date_format($dateOrder,"d/m/Y");
								
								//if ($rowPayment['payment_amount']==2) $refundAmount=$rowPayment['payment_amount']; else $refundAmount=0;
								$dob=date_create($rowPayment['patient_dob']);
								
								echo $srno . "\t";
								echo $rowPayment['patient_first_name']." ".$rowPayment['patient_middle_name']." ".$rowPayment['patient_last_name'] . "\t";
								echo date_format($dob,"d/m/Y") . "\t";
								echo $rowPayment['patient_phone'] . "\t";								
								echo $rowPayment['patient_email'] . "\t";	
								echo getMedicationStringWithInfo($database->filter($rowPayment['pres_id'])) . "\t";																
								echo getConditionName($rowPayment['payment_condition']) . "\t";
								
								echo "PH-".$rowPayment['pres_id'] . "\t";
								echo  $dateOrder. "\t";
								echo fntimeDifference($rowPayment['pres_pharmacy_action_date']) . "\t";
								
								
								echo "\n";

							}
				}
	
?>
