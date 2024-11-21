<?php include "../../private/settings.php";


// Specify the path to your CSV file
$csvFile = 'file/medicine-import.csv';

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

$medicineId = getMedicineId(rtrim(trim($line[0])));

if ($line[10]!="")
$condtion1=getConditionId($line[10]);

if ($line[13]!="")
$condtion2=getConditionId($line[13]);

if ($line[16]!="")
$condtion3=getConditionId($line[16]);


print $sqlCheck="select * from tbl_medication_pricing where mp_medicine='".$medicineId."' and mp_strength='".$line[1]."'";
$resCheck=$database->get_results($sqlCheck);
$existingCount=count($resCheck);


if ($medicineId>0)
{
	if ($existingCount==0)
	{
		
		$strength=str_replace('"','',$line[1]);
		
		$names = array(
		'mp_medicine' => $medicineId,
		'mp_strength' => $strength,
		'mp_unit' => $line[2],
		'mp_pres_type' => $line[3],
		'mp_formulation' => $line[4],
		'mp_pack_size' => $line[5],
		'mp_quantity' => $line[6],
		/*'total' => $line[7],
		'unit' => $line[8],*/
		'mp_cost_price' => $line[9],
		'mp_condition1' => $condtion1,
		'mp_condition1_max_qty' => $line[11],
		'mp_condition1_interval_days' => $line[12],
		'mp_condition2' => $condtion2,
		'mp_condition2_max_qty' => $line[14],
		'mp_condition2_interval_days' => $line[15],
		'mp_condition3' => $condtion3,
		'mp_condition3_max_qty' => $line[17],
		'mp_condition3_interval_days' => $line[18],
		'mp_medication_cost' => $line[19],
		/*'consultation_fees' => $line[20],*/
		'mp_tier1_price' => $line[21],
		'mp_tier2_price' => $line[22],
		'mp_tier3_price' => $line[23],
		'mp_tier4_price' => $line[24]
		
		);
		
		$database->insert( 'tbl_medication_pricing', $names );
	}
}
else
echo "Medicine not found: >>> ".$line[0];
echo "<br>";




	
}


fclose($file);









?>