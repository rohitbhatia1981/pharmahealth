<?php session_start(); 

include "../private/settings.php"; 


if ($_GET['id']!="")
{





 $sqlCheck = "select * from tbl_patients where patient_forgot_password = '".$database->filter($_GET['id'])."'";
 $result = $database->get_results($sqlCheck);
 $totalMember = count($result);

	if($totalMember>0)
		{
		
		$rowMemberid = $result[0]; 
		$_SESSION['sessForId']=$rowMemberid['patient_id'];
		$fcode="";	

      	
		$updateForgot = array(
			'patient_forgot_password' => $fcode, 
			);
			
			$where_clause = array(
				'patient_id' => $rowMemberid['patient_id']
			);

	
			$database->update( 'tbl_patients', $updateForgot, $where_clause, 1 );
		

		//setcookie("cookie_memberId", $rowMember->member_id,0,"/");
		print "<script>window.location='resetpassword'</script>";

		

	}

	else



	{		



		print "<script>window.location='forgot-password?type=".$_GET['typ']."</script>";	



	}



}







?>