<?php include "../../private/settings.php"; 
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=clinician-hours-".$_GET['m']." ".$_GET['y']." ".$_GET['pUserId'].".xls" );
	
	// print your data here. note the following:
	// - cells/columns are separated by tabs ("\t")
	// - rows are separated by newlines ("\n")
	
	// for example:
	//echo 'Project Id' . "\t" . 'Project Name' . "\t" . 'Category' . 'DPR Cost (In Cr)' . "\t". 'Work Order Cost' . "\t". 'Physical Progress' . "\t". 'Implementing Agency' . "\t". 'Project being taken up' . "\t" . "\n";
	//echo 'ASCL-2' . "\t" . 'Redevelopment of Roads' . "\t" . 'Development' . "\t" . '5' . "\t" . '2'. "\t" . '20%' . "\t" . 'ASCL' . "\t" . 'City'. "\n";
	
	
	$arrHeading=array();
	
	$arrHeading[0] = "S.No.";
	$arrHeading[1] = "Employee Number";
	$arrHeading[2] = "Clinician Name";
	
	$arrHeading[3] = "Login Time";
	$arrHeading[4] = "Logout Time";
	$arrHeading[5] = "Time Spent in Session";
	
	$year=$_GET['y'];
	$month=$_GET['m'];
	
	 $startDate = "$year-$month-01 00:00:00";
     $endDate = date("Y-m-t 23:59:59", strtotime($startDate)); // t gives the last day of the month
	
	
	foreach($arrHeading as $x) {		
   		echo $x . "\t";
	}
	echo "\n";
	
	$sql = "
	SELECT 
    pres_forename, 
	pres_emp_number, 
    pres_surname,
    pres_mobile,
    pres_email,
    pres_id,
    cs_login,
    cs_last_activity 
FROM 
    tbl_prescribers, 
    tbl_clinician_sessions 
WHERE 
    cs_user_id = pres_id 
    AND pres_id = '" . $database->filter($_GET['pUserId']) . "'
	AND cs_login BETWEEN '" . $database->filter($startDate) . "' AND '" . $database->filter($endDate) . "'";
	
	

		
	$results = $database->get_results( $sql );
	$totalRecords=count($results);
	
			if($totalRecords > 0) 				
				{
				$srno=0;
						for ($i = 0; $i < $totalRecords; $i++) 
							{
								$srno++;
								
								
								
								$row = $results[$i];
								echo $srno . "\t";
								echo $row['pres_emp_number'] . "\t";
								echo $row['pres_forename']." ".$row['pres_surname'] . "\t";
								
								echo $row['cs_login'] . "\t";
								echo $row['cs_last_activity'] . "\t";
								echo CalTimeSpent($row['cs_login'],$row['cs_last_activity']) . "\t";
								
								
								echo "\n";
								
								 $loginTime = new DateTime($row['cs_login']);
								$logoutTime = new DateTime($row['cs_last_activity']);
								$interval = $logoutTime->diff($loginTime);
								$totalSeconds += $interval->h * 3600;
								$totalSeconds += $interval->i * 60;
								$totalSeconds += $interval->s;

							}
							
							$totalHours = floor($totalSeconds / 3600);
   							$totalMinutes = floor(($totalSeconds % 3600) / 60);
							
							echo "\n";	
							echo "\t"."\t"."\t"."\t"."Total Hours" . "\t";
							echo $totalHours." hours ".$totalMinutes." mins";
	
				}
	
?>
