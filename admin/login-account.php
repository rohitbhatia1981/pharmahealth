<?php 
	define('_VALID_ACCESS',1);
	include_once("../private/settings.php");
	
	
	
	if($_SESSION['user_id']!="")
	{
		
		if ($_GET['t']=="patient")
		{
				   
					$sqlCheck = "select * from tbl_patients where patient_id='".$database->filter(decryptId($_GET['id']))."'";
					
 
					 $result = $database->get_results($sqlCheck);
 					$totalMember = count($result);

					if($totalMember>0)
				
						{
				
						$rowMemberid = $result[0]; 
					
					$_SESSION['sess_patient_id'] = $rowMemberid['patient_id'];
			        $_SESSION['sess_patient_username'] = $rowMemberid['patient_email'];
			        $_SESSION['sess_patient_name'] = $rowMemberid['patient_first_name']." ".$rowMemberid['patient_last_name'];
			        $_SESSION['sess_patient_email'] = $rowMemberid['patient_email'];	
					$_SESSION['sess_patient_pharmacy'] = $rowMemberid['patient_pharmacy'];
							       
			        $_SESSION['sess_patient_groupid'] = 4;
					
					$sqlPharmacy="select pharmacy_tier from tbl_pharmacies where pharmacy_id='".$database->filter($rowMemberid['patient_pharmacy'])."'";
					$resPharmacy=$database->get_results($sqlPharmacy);
					$rowPharmacy=$resPharmacy[0];
					$_SESSION['sess_tier']=$rowPharmacy['pharmacy_tier'];
			
						print "<script>window.location='".URL."patient/account'</script>";
						}
		}
		
		else if ($_GET['t']=="clinician")
		{
				   
			
			 $qry = "SELECT * FROM tbl_prescribers WHERE pres_id='".$database->filter(decryptId($_GET['id']))."' and pres_status=1";
	 	     $res = $database->get_results($qry);
			 if (count($res)>0)
			 {
				 $user=$res[0];
			 
			  	 $_SESSION['sess_prescriber_id'] = $user['pres_id'];
				 $_SESSION['sess_prescriber_name'] = $user['pres_forename']." ".$user['pres_surname'];
  		         $_SESSION['sess_prescriber_email'] = $user['pres_email'];     
 		         $_SESSION['sess_prescriber_groupid'] = 5;
				 $_SESSION['sess_prescriber_user_status'] = $user['pres_status'];
				 
				 $_SESSION['last_activity'] = time();
			
					
			
						print "<script>window.location='".URL."clinician/account'</script>";
			 }
			
		}
		
		else if ($_GET['t']=="pharmacy")
		{
				   
			
			 $qry = "select * from tbl_pharmacies where pharmacy_id='".$database->filter(decryptId($_GET['id']))."' and pharmacy_status=1";
	 	     $res = $database->get_results($qry);
			 if (count($res)>0)
			 {
				 $user=$res[0];
			 
			  	 	$_SESSION['sess_pharmacy_id'] = $user['pharmacy_id'];
			        $_SESSION['sess_pharmacy_name'] = $user['pharmacy_name'];
			        $_SESSION['sess_pharmacy_email'] = $user['pharmacy_o_email'];
					$_SESSION['sess_pharmacy_groupid'] = 6;
					$_SESSION['sess_pharmacy_user_status'] = $user['pharmacy_status'];
				 
				
			
					
			
						print "<script>window.location='".URL."pharmacy/account/index.php?c=pha-prescriptions'</script>";
			 }
			
		}
		
		
	}
	 

		

?>

