<?php include "../private/settings.php";

$sqlCheck="select * from tbl_patients where patient_verification_code='".$database->filter($_GET['auth'])."' and patient_email_verify=0 and patient_id='".$database->filter(base64_decode($_GET['e']))."'";
$resCheck=$database->get_results($sqlCheck);
if (count($resCheck)>0)
{

$rowMemberid=$resCheck[0];


					$_SESSION['sess_patient_id'] = $rowMemberid['patient_id'];
			        $_SESSION['sess_patient_username'] = $rowMemberid['patient_email'];
			        $_SESSION['sess_patient_name'] = $rowMemberid['patient_first_name']." ".$rowMemberid['patient_last_name'];
			        $_SESSION['sess_patient_email'] = $rowMemberid['patient_email'];			       
			        $_SESSION['sess_patient_groupid'] = 4;

$authorize=1;


$update="update tbl_patients set patient_email_verify=1 where patient_id='".$rowMemberid['patient_id']."'";
$database->query($update);

include PATH."include/email-templates/email-template.php";
include_once PATH."mail/sendmail.php";

//--------Settings all values--------
				
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				$forgotPwd='<a href="'.URL.'patient/forgot-password">here</a>';
				//$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=5 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("-","&bull;&nbsp;",$emailContent);
					$emailContent=str_replace("<email>",$email,$emailContent);
					$emailContent=str_replace("<forgot_password_link>",$forgotPwd,$emailContent);
					//$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$rowMemberid['patient_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Welcome to Pharma Health";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
			
			
			//------end sending email




	
				/*$headingTemplate="Welcome to Pharma Health";	
				$headingContent='<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%">
 				<tr><td height=30 colspan=2><p>Dear '.$rowMemberid['patient_first_name'].' '.$rowMemberid['patient_last_name'].' <br><br> Welcome to Pharma Health! We are excited to offer you a wide range of prescription medicines without the need of GP appointments. We value your trust in us and thank you for choosing us. <br><br>Take advantage of our convenient services today and get the medication you need quickly and easily. <br><br> We look forward to serving you!</p></td></tr>
				</table>';*/

			

				

				


}
else
$authorize=0;

include PATH."include/headerhtml.php"
 ?>
  <body style="padding-top:0px;">  
<section class="register_screen">
    <div class="container">
        <div class="logo_box">
        <a href="<?php echo URL?>" class="logo"><img src="<?php echo URL?>images/logo.png"></a>
        </div>
        <div class="register_box">
        
        			 <div align="center">
                     	<h3>Account Activation</h3>
                        <br>
                        <?php if ($authorize==1)
						{
							
							
							$_SESSION['sess_patient_id'] = $rowMemberid['patient_id'];
							$_SESSION['sess_patient_username'] = $rowMemberid['patient_email'];
							$_SESSION['sess_patient_name'] = $rowMemberid['patient_first_name'];
							$_SESSION['sess_patient_email'] = $rowMemberid['patient_email'];			       
							$_SESSION['sess_patient_groupid'] = 4;
							
							
						?>
                     	<p>Your account has been activated</p>
                        <p><button id="submitBtn" type="button" class="btn btn-danger btn-lg d-inline-flex align-items-center ps-5 pe-5 w50p" onClick="window.location='<?php echo URL?>patient/account/'">My Account</button></div></p>
                        <?php } else {?>
                        <p style="color:#F00">Wrong / expired verification link.</p>
                        <?php } ?>
                     </div>
        
        </div>
    </div>
</section>



<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  </body>
</html>

