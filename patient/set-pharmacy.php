<?php include "private/settings.php";
unset($_COOKIE['ckPharmacy']);

setcookie("ckPharmacy", $_GET['pid'], time() + (86400 * 10), "/");

header("Location:https://hidemos.com/projects/pharmahealth?auth=1", true, 301);
exit();



 ?>
