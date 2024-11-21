<?php include "../../private/settings.php"; 
if ($_SESSION['user_id']=="")
exit;


	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=pharmahealth-clinician-report-".$_GET['d'].$_GET['m'].$_GET['y'].".xls" );
	
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
	$arrHeading[3] = "Profession";
	$arrHeading[4] = "Registration No.";
	$arrHeading[5] = "Address";
	$arrHeading[6] = "Email";
	$arrHeading[7] = "Phone";
	$arrHeading[8] = "Date";
	$arrHeading[9] = "Status";
	
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
	pres_id,
    pres_emp_number,
	pres_title, 
    pres_forename,
	pres_email,
	pres_mobile,
    pres_surname,    
	pres_profession,
    pres_address1,
    pres_address2,
    pres_city,
	pres_postcode,
	pres_gphc_reg_number,
	pres_gmc_reg_number,
	pres_nmc_reg_number,
	pres_status
	
FROM 
   	tbl_prescribers
WHERE 
    1";
   
	
				if ($_GET['cmbProf']!="")
						{
							$sql.=" and pres_profession='".$database->filter($_GET['cmbProf'])."'";
						}
						
						if ($_GET['cmbStatus']!="")
						{
							$sql.=" and pres_status='".$database->filter($_GET['cmbStatus'])."'";
						}
						
						$sql.=" order by pres_forename asc";

		
	$results = $database->get_results( $sql );
	$totalRecords=count($results);
	
			if($totalRecords > 0) 				
				{
				$srno=0;
						for ($i = 0; $i < $totalRecords; $i++) 
							{
								$srno++;
								
								
								$row = $results[$i];
								
								if ($row['pres_status']==0) $status="Inactive"; 
								else if ($row['pres_status']==1) $status="Active";
								
								
							$address=$row['pres_address1'];
							
							if ($row['pres_address2']!="")
							$address.=", ".$row['pres_address2'];
							if ($row['pres_city']!="")
							$address.=", ".$row['pres_city'];
							
							$address.=", ".$row['pres_postcode'];
							
							$registeredDate=$row['pres_registered_on'];
							$registeredDate= fn_uk_format_date_time($registeredDate);
								
								echo $srno . "\t";
								echo $row['pres_emp_number'] . "\t";
								echo getClincianNameWithTitle($row['pres_id']) . "\t";
								echo getProfName($row['pres_profession']) . "\t";
								echo getGhpCRegNo($row['pres_id']) . "\t";
								echo $address . "\t";
								echo $row['pres_email'] . "\t";	
								echo $row['pres_mobile'] . "\t";							
								echo $registeredDate . "\t";								
								echo $status. "\t";		
								
								
								echo "\n";

							}
				}
	
?>
