<?php define('_VALID_ACCESS',1);

	include_once("../../private/settings.php");  //--Including settings 
	



	$currentTemplate = 'black';

	$error = '';

	if(isset($_SESSION['sess_patient_id']) && ($_SESSION['sess_patient_id']!="") && (isset($_SESSION['sess_patient_id'])) )

	{

	
		 require_once(PATH.PATIENT_ADMIN."templates/black/index.php");	
		 
		 if ($_SESSION['sessRedirectURL']!="")
		 {
			 print "<script>window.location='".$_SESSION['sessRedirectURL']."'</script>";  
			 unset ($_SESSION['sessRedirectURL']);
		 }

	}

	else 

	{	
		if ($_SERVER['REQUEST_URI'] !== URL . "patient/login") {
   		 // Get the current page URL and save it into a session variable
    	$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
   		 $_SESSION['sessRedirectURL'] = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
		print "<script>window.location='".URL."patient/login'</script>";

    }

	 

		

?>

