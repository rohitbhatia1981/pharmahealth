<?php 

session_start();

//include_once("private/settings.php");



					unset($_SESSION['user_id']);
			        unset($_SESSION['username']);
			        unset($_SESSION['name']);
			        unset($_SESSION['email']);
			        unset($_SESSION['alt_email']);
			        unset($_SESSION['groupid']);
			        unset($_SESSION['parentgroupid']);
			        unset($_SESSION['cityid']);
					unset($_SESSION['user_status']);
					unset($_SESSION['company']);
					unset($_SESSION['parentuserid']);
			
			



			//session_unset();

	

			header("location:index.php");	  





?>