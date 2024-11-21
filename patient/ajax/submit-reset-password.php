<?php session_start(); 
include "../../private/settings.php"; 


if ($_POST['txtLoginPwd']!="" && $_POST['txtLoginPwd']==$_POST['txtLoginPwd2'])
{
		$updateForgot = array(
			'patient_password' => md5($_POST['txtLoginPwd']), 
			);
			
			$where_clause = array(
				'patient_id' => $_SESSION['sessForId']
			);

	
			$database->update( 'tbl_patients', $updateForgot, $where_clause, 1 );
		

		echo "1";

		

	}

	else



	{		



		echo "0";



	}









?>