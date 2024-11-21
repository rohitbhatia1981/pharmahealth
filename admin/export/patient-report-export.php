<?php include "../../private/settings.php"; 
if ($_SESSION['user_id']=="")
exit;


	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=pharmahealth-patient-report-".$_GET['d'].$_GET['m'].$_GET['y'].".xls" );
	
	// print your data here. note the following:
	// - cells/columns are separated by tabs ("\t")
	// - rows are separated by newlines ("\n")
	
	// for example:
	//echo 'Project Id' . "\t" . 'Project Name' . "\t" . 'Category' . 'DPR Cost (In Cr)' . "\t". 'Work Order Cost' . "\t". 'Physical Progress' . "\t". 'Implementing Agency' . "\t". 'Project being taken up' . "\t" . "\n";
	//echo 'ASCL-2' . "\t" . 'Redevelopment of Roads' . "\t" . 'Development' . "\t" . '5' . "\t" . '2'. "\t" . '20%' . "\t" . 'ASCL' . "\t" . 'City'. "\n";
	
	
	$arrHeading=array();
	
	$arrHeading[0] = "S.No.";
	$arrHeading[1] = "Patient ID";
	$arrHeading[2] = "Patient Name";
	$arrHeading[3] = "Gender";
	$arrHeading[4] = "DOB";
	$arrHeading[5] = "Email";
	$arrHeading[6] = "Phone";
	$arrHeading[7] = "Nominated Pharmacy";
	$arrHeading[8] = "KYC Status";
	$arrHeading[9] = "Address";
	$arrHeading[10] = "Date of Registration";
	
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
    patient_id,
	patient_title, 
    patient_first_name,
    patient_middle_name,
    patient_last_name,
	patient_phone,
    patient_gender,
    patient_dob,
    patient_email,
	patient_pharmacy,
	patient_kyc,
	patient_address1,
	patient_address2,
	patient_city,
	patient_postcode
FROM 
   	tbl_patients
WHERE 
    1";
   
	
				if ($_GET['cmbGender']!="")
						{
							$sql.=" and patient_gender='".$database->filter($_GET['cmbGender'])."'";
						}
						
						if ($_GET['cmbPharmacy']!="")
						{
							$sql.=" and patient_pharmacy='".$database->filter($_GET['cmbPharmacy'])."'";
						}
						
						if ($_GET['txtCity']!="")
						{
							$sql.=" and patient_city like '%".$database->filter($_GET['txtCity'])."%'";
						}
						
						if ($_GET['txtSDate']!="")
						{
							 $startDate = $_GET['txtSDate']." 00:00:00";
							$sql.=" and patient_registered_date>='".$database->filter($startDate)."'";
						}
						if ($_GET['txtEDate']!="")
						{
							$endDate = $database->filter($_GET['txtEDate']) . ' 23:59:59';
							$sql.=" and patient_registered_date<='".$database->filter($endDate)."'";
						}

		
	$results = $database->get_results( $sql );
	$totalRecords=count($results);
	
			if($totalRecords > 0) 				
				{
				$srno=0;
						for ($i = 0; $i < $totalRecords; $i++) 
							{
								$srno++;
								
								
								$row = $results[$i];
								
								if ($row['patient_kyc']==0) $kycStatus="Pending"; 
								else if ($row['patient_kyc']==1) $kycStatus="Verified";
								else if ($row['patient_kyc']==2) $kycStatus="Rejected";
								
							$address=$row['patient_address1'];
							
							if ($row['patient_address2']!="")
							$address.=", ".$row['patient_address2'];
							if ($row['patient_city']!="")
							$address.=", ".$row['patient_city'];
							
							$address.=", ".$row['patient_postcode'];
							
							$registeredDate=$row['patient_registered_date'];
							$registeredDate= fn_uk_format_date_time($registeredDate);
								
								echo $srno . "\t";
								echo $row['patient_id'] . "\t";
								echo $row['patient_title']." ".$row['patient_first_name']." ".$row['patient_middle_name']." ".$row['patient_last_name'] . "\t";
								echo getGenderName($row['patient_gender']) . "\t";
								echo fn_GiveMeDateInDisplayFormat($row['patient_dob']) . "\t";
								echo $row['patient_email'] . "\t";
								echo $row['patient_phone'] . "\t";	
								echo getPharmacyName($row['patient_pharmacy']) . "\t";							
								echo $kycStatus . "\t";
								echo $address . "\t";
								echo $registeredDate. "\t";			
								
								
								echo "\n";

							}
				}
	
?>
