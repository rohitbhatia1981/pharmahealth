<?php include "../private/settings.php";
 
// Get search term 
$sqlPhar = "SELECT pharmacy_name AS title, pharmacy_postcode AS postcode, pharmacy_id AS id, pharmacy_address 
            FROM tbl_pharmacies 
            WHERE pharmacy_status = 1";


$searchTerm=$_GET['term'];
if ($searchTerm != "") {
    $searchTermFiltered = $database->filter($searchTerm);
    $sqlPhar .= " AND (pharmacy_name LIKE '%" . $searchTermFiltered . "%'";

    // Handle postcode search with and without space
    $sqlPhar .= " OR REPLACE(pharmacy_postcode, ' ', '') LIKE '%" . $searchTermFiltered . "%')";
}

$sqlPhar .= " ORDER BY 
                CASE 
                    WHEN title LIKE '" . $database->filter($searchTerm) . "%' THEN 0 
                    ELSE 1 
                END,
                title ASC
             LIMIT 0, 12";

// Fetch matched data from the database 
$query = $database->get_results($sqlPhar);


// Generate array with skills data 
$gpData = array();

if (count($query)>0)
for ($j=0;$j<count($query);$j++)
{
	$row=$query[$j];
	 $data['id'] = $row['id']; 
     $data['value'] = $row['title'].", ".$row['pharmacy_address'].", ".$row['postcode']; 
	  
     array_push($gpData, $data); 
	
}
 

 
// Return results as json encoded array 
echo json_encode($gpData); 
?>