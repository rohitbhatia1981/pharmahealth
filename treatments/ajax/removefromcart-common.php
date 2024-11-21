<?php include "../../private/settings.php";


// Cast $_POST['cid'] to ensure it has the correct data type
$cid = (int)$_POST['cid'];

// Search for the value in the 'med_id' column of the multidimensional array
$key = array_search($cid, array_column($_SESSION['sessCart_common'], 'med_id'));

// If found, remove it from the array
if ($key !== false) {
    unset($_SESSION['sessCart_common'][$key]);
	$_SESSION['sessCart_common'] = array_values($_SESSION['sessCart_common']);
}


//print_r ($_SESSION['sessCart']);

echo "1";


?>