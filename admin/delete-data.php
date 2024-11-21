<?php include "../private/settings.php";
if ($_SESSION['user_id']=="")
exit;
// Function to delete data from tables
function deleteDataFromTables($database, $tables) {
	global $database;
    foreach ($tables as $table) {
        $query = "DELETE FROM $table";
        $database->query($query);
    }
}

// Assuming $database is your database connection object
$tables = array(
    'tbl_prescription_medicine',
    'tbl_prescriptions',
    'tbl_prescriptions_actions',
    'tbl_prescriptions_notes',
    'tbl_prescription_medicine_change_requests',   
    'tbl_pres_cancel_request',
	'tbl_payments'
);

// Call the function to delete data from tables
deleteDataFromTables($database, $tables);
?>
