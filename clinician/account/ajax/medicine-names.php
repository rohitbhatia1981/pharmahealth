<?php include "../../../private/settings.php";

$condition=$_GET['cid'];
// Get search term 
$searchTerm = $_GET['term']; 
 
// Fetch matched data from the database 
$query = $database->get_results("SELECT *
FROM tbl_medication
WHERE med_title LIKE '%".$database->filter($searchTerm)."%'
  AND med_status = 1
  AND FIND_IN_SET('".$database->filter($condition)."', med_conditions)
ORDER BY
  CASE
    WHEN med_title LIKE '".$database->filter($searchTerm)."%' THEN 0
    ELSE 1
  END,
  med_title ASC
LIMIT 0, 12"); 
 
// Generate array with skills data 
$gpData = array();

if (count($query)>0)
for ($j=0;$j<count($query);$j++)
{
	$row=$query[$j];
	 $data['id'] = $row['med_id']; 
     $data['value'] = $row['med_title']; 
     array_push($gpData, $data); 
	
}
 

 
// Return results as json encoded array 
echo json_encode($gpData); 
?>