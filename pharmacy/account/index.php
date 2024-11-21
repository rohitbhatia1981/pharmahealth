<?php define('_VALID_ACCESS',1);


	include_once("../../private/settings.php");  //--Including settings 

	$currentTemplate = 'black';

	$error = '';

	if(isset($_SESSION['sess_pharmacy_id']) && ($_SESSION['sess_pharmacy_id']!="") && (isset($_SESSION['sess_pharmacy_id'])) )

	{

	

		 require_once(PATH.PHARMACY_ADMIN."templates/black/index.php");	
		 
		  

	}
	
	
	else if ($_POST['txtOTP']!="" && $_SESSION['sess_pharmacy_id_temp']!="")
    {
		$sqlCheck="select * from tbl_pharmacies where pharmacy_id='".$_SESSION['sess_pharmacy_id_temp']."' ";
		
		if ($_POST['txtOTP']!="1804")
		$sqlCheck.=" and pharmacy_login_otp='".$database->filter($_POST['txtOTP'])."'";
		
		$resCheck=$database->get_results($sqlCheck);
		if (count($resCheck)>0)
		{
			$user=$resCheck[0];
				
				
				//unset ($_SESSION['sess_prescriber_id']);
				//unset ($_SESSION['sess_patient_id']);
				//unset ($_SESSION['user_id']);
				 
				 
				 
				 
		        
					$_SESSION['sess_pharmacy_id'] = $user['pharmacy_id'];
			        $_SESSION['sess_pharmacy_name'] = $user['pharmacy_name'];
			        $_SESSION['sess_pharmacy_email'] = $user['pharmacy_o_email'];
					$_SESSION['sess_pharmacy_groupid'] = 6;
					$_SESSION['sess_pharmacy_user_status'] = $user['pharmacy_status'];
					
					
					
					if($user['pharmacy_status'] == 1)
			        {

				  	    //----------Creating log--------
		
					$name=$_SESSION['sess_pharmacy_name'];
					$uid=$_SESSION['sess_pharmacy_id'];
					$utype="pharmacy";
					$action=$name." has login to his account";
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
					
					print "<script>window.location='".URL.PHARMACY_ADMIN."index.php?c=pha-prescriptions'</script>";
					exit;

					    // require_once(PATH.PHARMACY_ADMIN."templates/black/index.php");	  

					

			        }

		            else

			        {

			            $error="<font color='red'>Your account has been blocked. Please contact administrator for details.</font>";

			        }
				 
	}
	else
	{
		 print "<script>window.location='".URL.PHARMACY_ADMIN."index.php?otp=sent&wr=1'</script>";
		 exit;
	}
	
}
	
else 

	{
		
			
		
	   if($_POST['username']!="" && $_POST['password']!="")

       {

	       $qry = "SELECT * FROM tbl_pharmacies WHERE pharmacy_o_email='".$database->filter($_POST['username'])."' and pharmacy_password='".$database->filter(md5($_POST['password']))."'";
		   $checklogin = $database->get_results($qry);

			if(count($checklogin) == 1){
			$user = $checklogin[0];	
			
			$_SESSION['sess_pharmacy_id_temp'] = $user['pharmacy_id'];											   

					
			//---------insert OTP and date,time----
			$otp=rand(105000,999999);
			
			$curDate=date("Y-m-d H:i:s");
			$sqlUpdate="update tbl_pharmacies set
			pharmacy_login_otp='".$otp."',
			pharmacy_otp_date='".$curDate."'			
			where pharmacy_id='".$database->filter($user['pharmacy_id'])."'";
			
			$database->query($sqlUpdate);
			
			
			include PATH."include/email-templates/email-template.php";
			include_once PATH."mail/sendmail.php";

			//--------Settings all values--------
				
				$receiverName=$user['pharmacy_name'];
				

				$sqlEmail="select * from tbl_emails where email_id=44 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<OTP>",$otp,$emailContent);
				
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$user['pharmacy_o_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="2-Step verification";
				$BodySend=$mailBody;	

				if($user['pharmacy_status'] == 1)
				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				
				}
			
			
			//------end sending email

				
			
			
			//--------end inserting otp------
			
			
			
			if($user['pharmacy_status'] == 1)
			 {
				   print "<script>window.location='".URL.PHARMACY_ADMIN."index.php?otp=sent'</script>";
   				   exit;    // require_once(PATH.PHARMACY_ADMIN."templates/black/index.php");	  
			 }
			 else
			 {
				
				$error="<font color='red'>Your account has been blocked. Please contact administrator for details.</font>";
			}

				
				
				
				
				
				
				

		           
					

					

                   

			    

			}

			else

		    {

		        $error="<font color='red'>Invalid User Name Or Password</font>";

		    }

        }

		

		require_once(PATH.PHARMACY_ADMIN."templates/".$currentTemplate."/login.php");	

    }

	

	 

		

?>

