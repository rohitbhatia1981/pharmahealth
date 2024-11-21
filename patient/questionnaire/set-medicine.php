<?php include "../../private/settings.php";
include PATH."patient/checksession.php";
//print_r ($_POST['txtAbtQue']);

$_SESSION['sessCart'][0]['med_id']=$_POST['medid'];
$_SESSION['sessCart'][0]['med_qty']=1;

echo 1;