<?php include "../../private/settings.php"; 

if ($_POST['txtLoginEmail']!="" && $_POST['txtLoginPassword']!="")
{

//print "select * from tbl_agents where agent_email = '".$database->filter($_POST['txtLoginEmail'])."' and agent_password='".$database->filter(md5($_POST['txtLoginPassword']))."' and agent_status='1'";

 $sqlCheck = "select * from tbl_patients where patient_email = '".$database->filter($_POST['txtLoginEmail'])."' and patient_password='".$database->filter(md5($_POST['txtLoginPassword']))."' and patient_status='1'";
 
 $result = $database->get_results($sqlCheck);
 $totalMember = count($result);
 
 exit;

	if($totalMember>0)

		{

		$rowMemberid = $result[0]; 
		
		
		
		
					$_SESSION['sess_patient_id'] = $rowMemberid['patient_id'];
			        $_SESSION['username'] = $rowMemberid['patient_email'];
			        $_SESSION['sess_prescriber_name'] = $rowMemberid['patient_first_name']." ".$rowMemberid['patient_last_name'];
			        $_SESSION['sess_prescriber_email'] = $rowMemberid['patient_email'];			       
			        $_SESSION['sess_prescriber_groupid'] = 4;

		
		
		
		
									
					
					/*  -- Record last login------
					$todaysDate=date("Y-m-d h:m:s");
					
					$sqlUpdate="update tbl_member set agent_last_logged='".$todaysDate."' where agent_id='".$database->filter($_SESSION['agentId'])."'";
					$database->query($sqlUpdate);
					
					*/
			
				//setcookie("cookie_memberId", $rowMember->member_id,0,"/");
				
				
				
				
				
				
					echo "1";	
				

	}

	else



	{		



		echo "2";		



	}



}







?>