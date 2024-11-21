<?php include "../private/settings.php";
include PATH."include/headerhtml.php";

?>
  <body style="padding-top:0px;"> 
<section class="login_screen">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
           
				<div class="left text-center">
					<a href="<?php echo URL?>" class="logo">
						<img src="<?php echo URL?>images/logo.png">
					</a>
					<h4 class="title_h4">Forgot Password</h4>
                    <div id="error-container-login" style="color:#F00; padding:10px"></div>
                     <form action="" method="post" name="frmLogin" id="frmLogin">
					<div class="form-group">
						<input type="email" class="form-control" id="txtLoginEmail" name="txtLoginEmail" placeholder="Your Email" data-validation="required" data-validation-error-msg="Please enter email address">
					</div>
					
					
					<button type="submit" id="LoginBtn" name="LoginBtn" class="me-2 btn btn-danger btn-lg d-inline-flex align-items-center ps-5 pe-5 w100p">Submit</button>
                    </form>
					
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
					   url: "<?php echo URL?>patient/ajax/checkforgotemail.php",
					   data: fd,
					   cache: false,
       				   processData: false,
        			   contentType: false,
					   success: function(msg){	
					  // alert (msg);
						   if (msg==1)
						   {
						   	window.location='<?php echo URL?>patient/instruction-sent';	

						   }

						   else
						   {	
						  
						    $("#error-container-login").html("Sorry, email id which you enetered is not registered with us");
							
							 
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