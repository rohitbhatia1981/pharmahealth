<?php include "../../private/settings.php"; 

if ($_POST['txtLoginEmail']!="" && $_POST['txtLoginPassword']!="")
{

//print "select * from tbl_agents where agent_email = '".$database->filter($_POST['txtLoginEmail'])."' and agent_password='".$database->filter(md5($_POST['txtLoginPassword']))."' and agent_status='1'";

 $sqlCheck = "select * from tbl_patients where patient_email = '".$database->filter($_POST['txtLoginEmail'])."' and patient_password='".$database->filter(md5($_POST['txtLoginPassword']))."' and patient_status='1'";
 
 $result = $database->get_results($sqlCheck);
 $totalMember = count($result);

	if($totalMember>0)

		{

		$rowMemberid = $result[0]; 
		
		if ($rowMemberid['patient_email_verify']==0)
		echo "3";
		else
		{
		
		
					//unset ($_SESSION['sess_prescriber_id']);
					//unset ($_SESSION['user_id']);
					//unset ($_SESSION['sess_pharmacy_id']);
		
					$_SESSION['sess_patient_id'] = $rowMemberid['patient_id'];
			        $_SESSION['sess_patient_username'] = $rowMemberid['patient_email'];
			        $_SESSION['sess_patient_name'] = $rowMemberid['patient_first_name']." ".$rowMemberid['patient_last_name'];
			        $_SESSION['sess_patient_email'] = $rowMemberid['patient_email'];	
					$_SESSION['sess_patient_pharmacy'] = $rowMemberid['patient_pharmacy'];			       
			        $_SESSION['sess_patient_groupid'] = 4;
					
					
					//---------get pharmacy tier-----
					$sqlPharmacy="select pharmacy_tier from tbl_pharmacies where pharmacy_id='".$database->filter($_SESSION['sess_patient_pharmacy'])."'";
					$resPharmacy=$database->get_results($sqlPharmacy);
					$rowPharmacy=$resPharmacy[0];
					$_SESSION['sess_tier']=$rowPharmacy['pharmacy_tier'];

		
					//----------Creating log--------
		
					$name=$_SESSION['name'];
					$uid=$_SESSION['sess_patient_id'];
					$utype="patient";
					$action=$name." has login to his account";
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
		
		
									
					
					/*  -- Record last login------
					$todaysDate=date("Y-m-d h:m:s");
					
					$sqlUpdate="update tbl_member set agent_last_logged='".$todaysDate."' where agent_id='".$database->filter($_SESSION['agentId'])."'";
					$database->query($sqlUpdate);
					
					*/
			
				//setcookie("cookie_memberId", $rowMember->member_id,0,"/");
				
					echo "1";	
		}

	}

	else
	{
		echo "2";
	}



}







?>