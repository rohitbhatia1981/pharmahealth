<?php include "../../private/settings.php";

if (!isset($_SESSION['sessCart_common'])) {
    $_SESSION['sessCart_common'] = array();
}

$cid = $_POST['cid']; // Product ID
$qty = $_POST['qty']; // Product quantity

$productExists = false; // Flag to check if product already exists in the cart

// Loop through the session array to check if the product already exists
foreach ($_SESSION['sessCart_common'] as $key => $product) {
    if ($product['med_id'] == $cid) {
        // If product exists, update the quantity
        $_SESSION['sessCart_common'][$key]['med_qty'] = $qty; // Add to the existing quantity
        $productExists = true;
        break;
    }
}

// If the product doesn't exist, add it as a new entry
if (!$productExists) {
    $ctr = count($_SESSION['sessCart_common']);
    $_SESSION['sessCart_common'][$ctr]['med_id'] = $cid;
    $_SESSION['sessCart_common'][$ctr]['med_qty'] = $qty;
}


echo "1";


?>