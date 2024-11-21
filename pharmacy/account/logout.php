<?php 

session_start();

//include_once("private/settings.php");



					unset($_SESSION['sess_pharmacy_id']);
			        unset($_SESSION['sess_pharmacy_name']);
			        unset($_SESSION['sess_pharmacy_email']);
					unset($_SESSION['sess_pharmacy_groupid']);
					unset($user['pharmacy_status']);



			//session_unset();

	

			header("location:index.php");	  





?>