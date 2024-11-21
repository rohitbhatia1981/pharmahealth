<?php 

session_start();

//include_once("private/settings.php");



			 	unset($_SESSION['sess_prescriber_id']);
				unset($_SESSION['sess_prescriber_name']);
  		        unset($_SESSION['sess_prescriber_email']);
 		        unset($_SESSION['sess_prescriber_groupid']);
				unset($_SESSION['sess_prescriber_user_status']);



			//session_unset();

	

			header("location:index.php");	  





?>