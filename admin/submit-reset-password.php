<?php session_start(); 
include "../private/settings.php"; 


if ($_POST['txtLoginPwd']!="" && $_POST['txtLoginPwd']==$_POST['txtLoginPwd2'])
{
		$updateForgot = array(
			'password' => md5($_POST['txtLoginPwd']), 
			);
			
			$where_clause = array(
				'user_id' => $_SESSION['sessForId']
			);

	
			$database->update( 'tbl_users', $updateForgot, $where_clause, 1 );
		

		print "<script>window.location='index.php?forgot-password=4'</script>";

		

	}

	else



	{		



		print "<script>window.location='index.php?forgot-password=1'</script>";



	}









?>