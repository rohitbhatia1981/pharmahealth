<?php include "../../../private/settings.php"; 
if ($_SESSION['sess_pharmacy_id']=="")
exit;


	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=pharmacy-performance-report-".$_GET['d'].$_GET['m'].$_GET['y'].".xls" );
	
	// print your data here. note the following:
	// - cells/columns are separated by tabs ("\t")
	// - rows are separated by newlines ("\n")
	
	// for example:
	//echo 'Project Id' . "\t" . 'Project Name' . "\t" . 'Category' . 'DPR Cost (In Cr)' . "\t". 'Work Order Cost' . "\t". 'Physical Progress' . "\t". 'Implementing Agency' . "\t". 'Project being taken up' . "\t" . "\n";
	//echo 'ASCL-2' . "\t" . 'Redevelopment of Roads' . "\t" . 'Development' . "\t" . '5' . "\t" . '2'. "\t" . '20%' . "\t" . 'ASCL' . "\t" . 'City'. "\n";
	
	
	$arrHeading=array();
	
	$arrHeading[0] = "Rank";
	$arrHeading[1] = "Conditions";
	$arrHeading[2] = "No. of Orders";
	
	
	
	
	
	foreach($arrHeading as $x) {		
   		echo $x . "\t";
	}
	echo "\n";
	
	$sqlPayment = "SELECT condition_title, COUNT(*) as ctrOrders from tbl_payments, tbl_conditions where payment_condition=condition_id and payment_status=1 and payment_pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."'";
   
	
											$currentDate = date('Y-m-d');
											
											if ($_GET['cmbPeriod']==1)	
												{		
												
													 $startDate = date('Y-m-01'); // First day of the current month
													 $endDate = date('Y-m-t'); // Last day of the current month	
															
													$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$endDate'";
												} else if ($_GET['cmbPeriod']==2)	
												{		
						
												 $startDate = date('Y-m-01', strtotime('first day of last month')); // First day of the last month
												 $endDate = date('Y-m-t', strtotime('last day of last month')); // Last day of the last month
														
												$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$endDate'";
												}
						
												else if ($_GET['cmbPeriod']==3)	
												{		
												
													 $startDate = date('Y-m-d', strtotime('-3 months'));
													
															
													$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$currentDate'";
												}
												
												else if ($_GET['cmbPeriod']==4)	
												{		
												
													 $startDate = date('Y-m-d', strtotime('-6 months'));
													
															
													$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$currentDate'";
												}
						
												else if ($_GET['cmbPeriod']==5)	
												{		
												
													 $startDate = date('Y-m-d', strtotime('-12 months'));
													
															
													$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$currentDate'";
												}
						
						
											
												
												if ($_GET['cmbPeriod']==6)
												{
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
												}
											
											$sqlPayment.=" GROUP BY condition_title order by ctrOrders desc";
		

		
	$results = $database->get_results( $sqlPayment );
	$totalRecords=count($results);
	
			if($totalRecords > 0) 				
				{
				$srno=0;
						for ($i = 0; $i < $totalRecords; $i++) 
							{
								$srno++;
								
								$rowPayment = $results[$i];
								
								
								echo $srno . "\t";												
								echo $rowPayment['condition_title'] . "\t";
								echo $rowPayment['ctrOrders'] . "\t";						
								echo "\n";

							}
				}
				
				echo "\n";
				echo "\n";
				
				
				
	$arrHeading=array();
	
	$arrHeading[0] = "Rank";
	$arrHeading[1] = "Medication";
	$arrHeading[2] = "No. of Orders";
	
	
	
	
	
	foreach($arrHeading as $x) {		
   		echo $x . "\t";
	}
	echo "\n";
	
	$sqlPayment = "SELECT med_title, COUNT(*) as ctrOrders from tbl_payments, tbl_medication where payment_medicine_id=med_id and payment_status=1 and payment_pharmacy_id='".$database->filter($_SESSION['sess_pharmacy_id'])."'";
   
	
											$currentDate = date('Y-m-d');
											
											if ($_GET['cmbPeriod']==1)	
												{		
												
													 $startDate = date('Y-m-01'); // First day of the current month
													 $endDate = date('Y-m-t'); // Last day of the current month	
															
													$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$endDate'";
												} else if ($_GET['cmbPeriod']==2)	
												{		
						
												 $startDate = date('Y-m-01', strtotime('first day of last month')); // First day of the last month
												 $endDate = date('Y-m-t', strtotime('last day of last month')); // Last day of the last month
														
												$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$endDate'";
												}
						
												else if ($_GET['cmbPeriod']==3)	
												{		
												
													 $startDate = date('Y-m-d', strtotime('-3 months'));
													
															
													$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$currentDate'";
												}
												
												else if ($_GET['cmbPeriod']==4)	
												{		
												
													 $startDate = date('Y-m-d', strtotime('-6 months'));
													
															
													$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$currentDate'";
												}
						
												else if ($_GET['cmbPeriod']==5)	
												{		
												
													 $startDate = date('Y-m-d', strtotime('-12 months'));
													
															
													$sqlPayment.=" and DATE(payment_date) BETWEEN '$startDate' AND '$currentDate'";
												}
						
						
											
												
												if ($_GET['cmbPeriod']==6)
												{
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
												}
											
											$sqlPayment.=" GROUP BY med_title order by ctrOrders desc";
		

		
	$results = $database->get_results( $sqlPayment );
	$totalRecords=count($results);
	
			if($totalRecords > 0) 				
				{
				$srno=0;
						for ($i = 0; $i < $totalRecords; $i++) 
							{
								$srno++;
								
								$rowPayment = $results[$i];
								
								
								echo $srno . "\t";												
								echo $rowPayment['med_title'] . "\t";
								echo $rowPayment['ctrOrders'] . "\t";						
								echo "\n";

							}
				}
	
?>
