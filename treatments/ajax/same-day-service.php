<?php include "../../private/settings.php";

if ($_POST['sid']!="")
{

if ($_POST['sid']==1)
$_SESSION['sessSameDay']=1;	
else
$_SESSION['sessSameDay']=0;	


echo "1";
}


?>