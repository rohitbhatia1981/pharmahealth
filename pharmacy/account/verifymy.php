<?php session_start(); 
include "../../private/settings.php"; 
if ($_GET['id']!="")
{

 $sqlCheck = "select * from tbl_pharmacies where pharmacy_forgot_password = '".$database->filter($_GET['id'])."'";
 $result = $database->get_results($sqlCheck);
 $totalMember = count($result);

	if($totalMember>0)
		{
		
		$rowMemberid = $result[0]; 
		$_SESSION['sessForId']=$rowMemberid['pharmacy_id'];
		$fcode="";	

      	
		$updateForgot = array(
			'pharmacy_forgot_password' => $fcode, 
			);
			
			$where_clause = array(
				'pharmacy_id' => $rowMemberid['pharmacy_id']
			);

	
			$database->update( 'tbl_pharmacies', $updateForgot, $where_clause, 1 );
		

		//setcookie("cookie_memberId", $rowMember->member_id,0,"/");
		print "<script>window.location='index.php?forgot-password=3'</script>";

		

	}

	else



	{		



		print "<script>window.location='index.php?forgot-password=1'</script>";	



	}



}







?>