<?php include "../private/settings.php";
 
// Get search term 
$searchTerm = $_GET['term']; 
 
// Fetch matched data from the database 
$query = $database->get_results("(
  SELECT condition_title AS title, condition_id as id, 'Condition' AS keyty
  FROM tbl_conditions
  WHERE (condition_title LIKE '".$database->filter($searchTerm)."%') 
    AND condition_status = 1
)
UNION
(
  SELECT med_title AS title, med_id as id, 'Medication' AS keyty
  FROM tbl_medication
  WHERE (med_title LIKE '".$database->filter($searchTerm)."%') and med_status=1
)
ORDER BY 
  CASE 
    WHEN title LIKE '".$database->filter($searchTerm)."%' THEN 0 
    ELSE 1 
  END,
  title ASC
LIMIT 0, 12;

"); 
 
// Generate array with skills data 
$gpData = array();

if (count($query)>0)
for ($j=0;$j<count($query);$j++)
{
	$row=$query[$j];
	 $data['id'] = $row['id']."~".$row['keyty']; 
     $data['value'] = $row['title']; 
	  
     array_push($gpData, $data); 
	
}
 

 
// Return results as json encoded array 
echo json_encode($gpData); 
?>