<?php include "../private/settings.php";
 
// Get search term 
$searchTerm = $_GET['term']; 
 
// Fetch matched data from the database 
$query = $database->get_results("SELECT * FROM tbl_gps WHERE (gp_name LIKE '%".$database->filter($searchTerm)."%' || gp_address LIKE '%".$database->filter($searchTerm)."%') AND gp_status = 1 ORDER BY gp_name ASC limit 0,12"); 
 
// Generate array with skills data 
$gpData = array();

if (count($query)>0)
for ($j=0;$j<count($query);$j++)
{
	$row=$query[$j];
	 $data['id'] = $row['gp_id']; 
     $data['value'] = $row['gp_name'].", ".$row['gp_address']; 
     array_push($gpData, $data); 
	
}
 

 
// Return results as json encoded array 
echo json_encode($gpData); 
?>