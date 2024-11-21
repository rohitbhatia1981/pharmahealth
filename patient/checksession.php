<?php  
 
if ($_SESSION['sess_patient_id']=="")
{
	$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
	$_SESSION['sessRedirectURL'] = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
	
	
	exit;
	
print "<script>window.location='".URL."patient/login'</script>";
exit;
}



?>


