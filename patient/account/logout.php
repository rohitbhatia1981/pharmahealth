<?php 

session_start();

//include_once("private/settings.php");



					unset($_SESSION['sess_patient_id']);
			        unset($_SESSION['sess_patient_username']);
			        unset($_SESSION['sess_patient_name']);
			        unset($_SESSION['sess_patient_email']);	
					unset($_SESSION['sess_patient_pharmacy']);			       
			        unset($_SESSION['sess_patient_groupid']);	



			//session_unset();

	

			header("location:../login");	  





?>