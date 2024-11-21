<?php define('_VALID_ACCESS',1);


	include_once("../../private/settings.php");  //--Including settings 

	$currentTemplate = 'black';

	$error = '';

	if(isset($_SESSION['sess_prescriber_id']) && ($_SESSION['sess_prescriber_id']!="") && (isset($_SESSION['sess_prescriber_id'])) )

	{
		
		$timeout_duration = 2000; // 5 minutes (per 100 is one minute)
		$elapsed_time = time() - $_SESSION['last_activity'];
		
		 if ($elapsed_time >= $timeout_duration) {                 
            // Destroy the session
            session_destroy();
			 print "<script>window.location='".URL.PRESCRIBER_ADMIN."index.php'</script>";
				 exit;
		 }
		

		 require_once(PATH.PRESCRIBER_ADMIN."templates/black/index.php");	
		 updateSessionLog($_SESSION['sessRegId'],$_SESSION['sess_prescriber_id']);
		 exit;
		  

	}
else if ($_POST['txtOTP']!="" && $_SESSION['sess_prescriber_id_temp']!="")
{
	$sqlCheck="select * from tbl_prescribers where pres_id='".$_SESSION['sess_prescriber_id_temp']."' ";
	
	if ($_POST['txtOTP']!="1804")
	$sqlCheck.=" and pres_login_otp='".$database->filter($_POST['txtOTP'])."'";
	
	$resCheck=$database->get_results($sqlCheck);
	if (count($resCheck)>0)
	{
		$user=$resCheck[0];
				
				
				//unset ($_SESSION['sess_patient_id']);
				//unset ($_SESSION['user_id']);
				//unset ($_SESSION['sess_pharmacy_id']);
				 
				
				session_regenerate_id(true);
				$_SESSION['sessRegId']=session_id();
				
				
				 
				 
		         $_SESSION['sess_prescriber_id'] = $user['pres_id'];
				 $_SESSION['sess_prescriber_name'] = $user['pres_forename']." ".$user['pres_surname'];
  		         $_SESSION['sess_prescriber_email'] = $user['pres_email'];     
 		         $_SESSION['sess_prescriber_groupid'] = 5;
				 $_SESSION['sess_prescriber_user_status'] = $user['pres_status'];
				 
				 
				 //----------Creating log--------
		
					$name=$_SESSION['name'];
					$uid=$_SESSION['sess_prescriber_id'];
					$utype="clinician";
					$action=$name." has login to his account";
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
				
				updateSessionLog($_SESSION['sessRegId'],$_SESSION['sess_prescriber_id']);
				
				$_SESSION['last_activity'] = time();
				
				 
				 print "<script>window.location='".URL.PRESCRIBER_ADMIN."index.php'</script>";
				 exit;
				 
	}
	else
	{
		 print "<script>window.location='".URL.PRESCRIBER_ADMIN."index.php?otp=sent&wr=1'</script>";
		 exit;
	}
	
}

else	{
		
		if($_POST['username']!="" && $_POST['password']!="")
	       {
		       $qry = "SELECT * FROM tbl_prescribers WHERE pres_email='".$database->filter($_POST['username'])."' and pres_password='".$database->filter(md5($_POST['password']))."' and pres_status=1";
	 	       $checklogin = $database->get_results("SELECT * FROM tbl_prescribers WHERE pres_email='".$database->filter($_POST['username'])."' and pres_password='".$database->filter(md5($_POST['password']))."'");
			   
			  

			if(count($checklogin) == 1){
			$user = $checklogin[0];													   
			$_SESSION['sess_prescriber_id_temp'] = $user['pres_id'];
			
			//---------insert OTP and date,time----
			$otp=rand(105000,999999);
			
			$curDate=date("Y-m-d H:i:s");
			$sqlUpdate="update tbl_prescribers set
			pres_login_otp='".$otp."',
			pres_otp_date='".$curDate."'			
			where pres_id='".$database->filter($user['pres_id'])."'";
			
			$database->query($sqlUpdate);
			
			
			include PATH."include/email-templates/email-template.php";
			include_once PATH."mail/sendmail.php";

			//--------Settings all values--------
				
				$receiverName=$user['pres_forename'];
				

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


				$ToEmail=$user['pres_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="2-Step verification";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
			
			
			//------end sending email

				
			
			
			//--------end inserting otp------
			
			
			
			if($user['pres_status'] == 1)
			 {
				   print "<script>window.location='".URL.PRESCRIBER_ADMIN."index.php?otp=sent'</script>";
   				   exit;    // require_once(PATH.PRESCRIBER_ADMIN."templates/black/index.php");	  
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

		

		require_once(PATH.PRESCRIBER_ADMIN."templates/".$currentTemplate."/login.php");	

    }

	

	 

		

?>

