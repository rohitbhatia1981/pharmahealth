<?php include "../private/settings.php";
include PATH."include/headerhtml.php";

require_once 'vendor/autoload.php';
 
// init configuration
$clientID = '946734008564-mm50u0q0sb04ol8hlrj13a42j0jc7vpd.apps.googleusercontent.com';
$clientSecret = 'ovcyS8FuhB3PyMJ19HMzIUAq';
$redirectUri = 'https://hidemos.com/projects/pharmahealth/patient/login.php';
  
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  
  
  $sqlCheck = "select * from tbl_patients where patient_email = '".$database->filter($email)."' and patient_status='1'";
 
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
					
					//---------get pharmacy tier-----
					$sqlPharmacy="select pharmacy_tier from tbl_pharmacies where pharmacy_id='".$database->filter($_SESSION['sess_patient_pharmacy'])."'";
					$resPharmacy=$database->get_results($sqlPharmacy);
					$rowPharmacy=$resPharmacy[0];
					$_SESSION['sess_tier']=$rowPharmacy['pharmacy_tier'];
					
					//--------
					
					print "<script>window.location='".URL."patient/account/'</script>";
					exit;
		}
		
		
  
}


 ?>
  <body style="padding-top:0px;"> 
<section class="login_screen">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
           
				<div class="left text-center">
					<a href="<?php echo URL?>" class="logo">
						<img src="<?php echo URL?>images/Pharmacy-health-final-logo.svg">
					</a>
                    
                    <?php if ($_GET['reset']==1)
					{ ?>
                    <h5 style="color:#093">Your password is changed, you can login with the new password.</h5>
                    <?php } ?>
						
					<h4 class="title_h4">Sign in</h4>
                    <div id="error-container-login" style="color:#F00; padding:10px"></div>
                     <form action="" method="post" name="frmLogin" id="frmLogin">
					<div class="form-group">
						<input type="email" class="form-control" id="txtLoginEmail" name="txtLoginEmail" placeholder="Your Email" data-validation="required" data-validation-error-msg="Please enter email address">
					</div>
					<div class="form-group mb-2">
						<input type="text" class="form-control" id="password" name="txtLoginPassword" placeholder="Your Password" data-validation="required" data-validation-error-msg="Please enter password">
					</div>
					<a href="forgot-password" class="link float-end">Forgot Password?</a>
					<button type="submit" id="LoginBtn" name="LoginBtn" class="me-2 btn btn-danger btn-lg d-inline-flex align-items-center ps-5 pe-5 w100p">Login</button>
                    </form>
					<div class="signup_box">
						<div class="or_line"><span>or</span></div>
						<a href="<?php echo $client->createAuthUrl(); ?>" class="btn btn-outline-blue"><img src="<?php echo URL?>images/google_icon.png"> Sign in with Google</a>
						<a href="<?php echo URL?>patient/signup" class="btn btn-outline-blue">Register with Pharma Health</a>
					</div>
				</div>
               
			</div>
			<div class="col-sm-6">
				<div class="login_img">
				<img src="<?php echo URL?>images/login_img.jpg">
				</div>
			</div>
		</div>
	</div>
</section>

<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 

  </body>
</html>


  
  
 <script src="<?php echo URL?>js/form-validator/jquery.form-validator.js"></script>
<script language="javascript">
	//-----------login---------------

    (function($, window) {
        // setup datepicker   
		
			$('#password').on('focus', function () {
				   $(this).attr('type', 'password'); 
				});   

        window.applyValidation = function(validateOnBlur, forms, messagePosition, xtraModule) {
            if( !forms )
                forms = 'form';
            if( !messagePosition )
                messagePosition = 'top';
            $.validate({
                form : forms,       
				errorMessagePosition : messagePosition,
                scrollToTopOnError : false,			
 			    sanitizeAll : 'trim', // only used on form C
                // borderColorOnError : 'purple',
                modules : 'security, location,' +( xtraModule ? ','+xtraModule:''),
                onModulesLoaded: function() {
                // $('#password').displayPasswordStrength();
                },

                onValidate : function($f) {
                console.log('about to validate form '+$f.attr('id'));

                var $callbackInput = $('#callback');
                if( $callbackInput.val() == 1 ) {
                        return {

                            element : $callbackInput,

                            message : 'This validation was made in a callback'

                        };

                    }

                },

                onError : function($form) {

                    //alert('Invalid '+$form.attr('id'));

                },

                onSuccess : function($form) {

                   // alert('Valid '+$form.attr('id'));
				   $("#LoginBtn").attr('disabled','disabled');
				    $("#LoginBtn").html('Please wait..');
				  // $("#error-container-login").html("Please wait..</div>");

		   			var myform = document.getElementById("frmLogin");
				    var fd = new FormData(myform );	

				

		  			   $.ajax({
					   type: "POST",
					   url: "<?php echo URL?>patient/ajax/checklogin.php",
					   data: fd,
					   cache: false,
       				   processData: false,
        			   contentType: false,
					   success: function(msg){	
					  // alert (msg);
						   if (msg==1)
						   {
						   	window.location='<?php echo URL?>patient/account/';	

						   }

						   else if (msg==2)
						   {	
						  
						    $("#error-container-login").html("Wrong username or password");
							
							 
 						  	 $("#LoginBtn").removeAttr('disabled',''); 
							 $("#LoginBtn").html('Login');
 			  			  	 
							}
							else if (msg==3)
						   {	
						  
						    $("#error-container-login").html("Your email is not verified; kindly verify your email before logging in.");
							
							 
 						  	 $("#LoginBtn").removeAttr('disabled',''); 
							 $("#LoginBtn").html('Login');
 			  			  	 
							}

						  // window.location='<?php echo URL?>request/thanks-for-booking';

						   

					  

					  }

					 });

					 

					

					

                    return false;

                }

            });

        };



     

       window.applyValidation(true, '#frmLogin', $('#error-container'), 'sanitize');

  



    })(jQuery, window);
	
	
	
//--------------end login--------
	</script>