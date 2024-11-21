<?php include "../../private/settings.php"; 
setcookie("ckPharmacy", $_POST['pid'], time() + (86400 * 10), "/");

?>