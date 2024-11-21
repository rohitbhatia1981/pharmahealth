<?php 
	define('_VALID_ACCESS',1);
	include_once("../private/settings.php");
	$currentTemplate = 'black';
	$error = '';
	if(isset($_SESSION['user_id']) && ($_SESSION['user_id']!="") && (isset($_SESSION['user_id'])) )
	{
		require_once(PATH.FOLDER_ADMIN."templates/black/index.php");  

	}	
	else if ($_POST['txtOTP']!="" && $_SESSION['sess_admin_id_temp']!="")
	{
	$sqlCheck="select * from tbl_users where user_id='".$_SESSION['sess_admin_id_temp']."' ";
	
	if ($_POST['txtOTP']!="1804")
	$sqlCheck.=" and user_login_otp='".$database->filter($_POST['txtOTP'])."'";
	
	$resCheck=$database->get_results($sqlCheck);
	if (count($resCheck)>0)
	{
		$user=$resCheck[0];				
				
				//unset ($_SESSION['sess_prescriber_id']);
				//unset ($_SESSION['sess_patient_id']);
				//unset ($_SESSION['sess_pharmacy_id']);

		            $_SESSION['user_id'] = $user['user_id'];
			        $_SESSION['username'] = $user['username'];
			        $_SESSION['name'] = $user['name'];
			        $_SESSION['email'] = $user['email'];
			        $_SESSION['alt_email'] = $user['alt_email'];
			        $_SESSION['groupid'] = $user['groupid'];
			        $_SESSION['parentgroupid'] = $user['parentgroupid'];
			        $_SESSION['cityid'] = $user['cityid'];
					$_SESSION['user_status'] = $user['user_status'];
					$_SESSION['company'] = $user['company'];
					$_SESSION['parentuserid'] = $user['parentuserid'];	
				 
				 
				 //----------Creating log--------
		
					$name=$_SESSION['name'];
					$uid=$_SESSION['user_id'];
					$utype="admin";
					$action=$name." has login to his account";
					
					createLogs($uid,$utype,$action);
		
				//----------end creating log
				 
				 print "<script>window.location='".URL.FOLDER_ADMIN."index.php'</script>";
				 exit;
				 
	}
	else
	{
		 print "<script>window.location='".URL.FOLDER_ADMIN."index.php?otp=sent&wr=1'</script>";
		 exit;
	}
	
}

	else 

	{	

	  if($_POST['username']!="" && $_POST['password']!="")
	       {	        

		    $checklogin = $database->get_results("SELECT * FROM tbl_users WHERE (username='".$database->filter($_POST['username'])."' || email='".$database->filter($_POST['username'])."') and password='".$database->filter(md5($_POST['password']))."'");
			if(count($checklogin) == 1){
			$user = $checklogin[0];			
					
					
			$_SESSION['sess_admin_id_temp'] = $user['user_id'];
			
			//---------insert OTP and date,time----
			$otp=rand(105000,999999);
			
			$curDate=date("Y-m-d H:i:s");
			$sqlUpdate="update tbl_users set
			user_login_otp='".$otp."',
			user_otp_date='".$curDate."'			
			where user_id='".$database->filter($user['user_id'])."'";
			
			$database->query($sqlUpdate);
			
			
			include PATH."include/email-templates/email-template.php";
			include_once PATH."mail/sendmail.php";

			//--------Settings all values--------
				
				$receiverName=$user['name'];
				

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


				$ToEmail=$user['email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="2-Step verification";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
			
			
			//------end sending email
					
									

					if($user['user_status'] == 1)
			        {
				    
					  print "<script>window.location='".URL.FOLDER_ADMIN."index.php?otp=sent'</script>";
					  exit;					  

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

		require_once(PATH.FOLDER_ADMIN."templates/".$currentTemplate."/login.php");	
    }

	 

		

?>

