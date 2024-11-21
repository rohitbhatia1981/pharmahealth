<?php include "../../private/settings.php";


// Specify the path to your CSV file
$csvFile = 'file/pricing-pharma-updates.csv';

// Open the CSV file for reading
$file = fopen($csvFile, 'r');

// Initialize an empty array to store the CSV data
$data = array();

$lineNumber = 0;

// Read each line of the CSV file until the end of the file is reached
while (($line = fgetcsv($file)) !== false) {
    // Add the line as an array to the $data array
	
	 $lineNumber++;
    
		// Skip the first line
		if ($lineNumber == 1) {
			continue;
		}
		
   // print_r ($line);
   

$condtion1='';
$condtion2='';
$condtion3='';

$medicineId = getMedicineId(rtrim(trim($line[0])));

if ($line[2]!="")
$condtion1=getConditionId(rtrim(trim($line[2])));

if ($line[5]!="")
$condtion2=getConditionId(rtrim(trim($line[5])));

if ($line[8]!="")
$condtion3=getConditionId(rtrim(trim($line[8])));




$sqlCheck="select * from tbl_medication_pricing where mp_medicine='".$medicineId."' and mp_strength='".$line[1]."'";
$resCheck=$database->get_results($sqlCheck);
$existingCount=count($resCheck);


if ($medicineId>0)
{
	if ($existingCount==1)
	{
		$rowCheck=$resCheck[0];
		
		$update = array(		
		'mp_condition1' => $condtion1,
		'mp_condition1_max_qty' => $line[3],
		'mp_condition1_interval_days' => $line[4],
		'mp_condition2' => $condtion2,
		'mp_condition2_max_qty' => $line[7],
		'mp_condition2_interval_days' => $line[6],
		'mp_condition3' => $condtion3,
		'mp_condition3_max_qty' => $line[9],
		'mp_condition3_interval_days' => $line[10],		
		'mp_dosage1' => $line[11],
		'mp_dosage2' => $line[12]
		
		);
		
		$where_clause = array(

			'mp_id' => $rowCheck['mp_id']

		);
		
		print_r ($update);
		
		print "<br><br>";
		
		$updated = $database->update( 'tbl_medication_pricing', $update, $where_clause, 1 );
		
		//$database->insert( 'tbl_medication_pricing', $names );
	}
	
}
else
echo "Medicine not found: >>> ".$line[0];
echo "<br>";




	
}


fclose($file);









?>