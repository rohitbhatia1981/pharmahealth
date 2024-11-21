<?php include "../../private/settings.php";


// Specify the path to your CSV file
$csvFile = 'condition-questions/contact-dematitis.csv';

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
	


$condition=$line[1];
$category=$line[2];
$question=$line[3];
$answerType=$line[4];
$answerOpt=$line[5];
$answerRisk=$line[6];
$strAskOptions=$line[7];
$position=$line[8];
$tooltip=$line[9];
$tooltipInfo=$line[10];


$strOptions="";
if ($answerOpt!="")
{
$arrOptions=explode("|",$answerOpt);
$strOptions=serialize($arrOptions);
}

$strRisks="";
if ($answerRisk!="")
{
$arrRisks=explode(",",$answerRisk);
$strRisks=serialize($arrRisks);
}

if ($condition!="") {
	
$names = array(

			'mq_conditions' => $condition, 
			'mq_questions' => $question, 
			'mq_category' => $category,
			'mq_answer_type' => $answerType,			
			'mq_multiple_options' => $strOptions,
			'mq_risk_level' =>$strRisks,
			'mq_tooltip_status' => $tooltip,
			'mq_tooltip_text' => $tooltipInfo,			
			'mq_ask_for_information' => $strAskOptions,
			'mq_order' => $position,
			'mq_status' => 1 //Random thing to insert

		);
		
		print_r ($names);
		$add_query = $database->insert( 'tbl_medical_questions', $names );
		
		
		print "<br><br>";
}
	
	
}

// Close the file
fclose($file);

// Output the data








?>