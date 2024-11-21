<?php include "../private/settings.php";
include PATH."include/headerhtml.php"
 ?>
  <body>
  		<?php include PATH."include/header.php"; ?> 
<div class="contact_screen">
<section class="banner_1 d-inline-flex align-items-center" style="background-image: url(<?php echo URL?>images/banner-3.jpg);">
	<div class="container">
		<h3 class="title_h3">Contact Us</h3>
	</div>
</section>
<section class="contact_info">
	<div class="container">
		<p class="text-center">If you have any questions regarding anything on our website then please don't hesitate to contact us. You can do this by telephone <br>
or via email. We are always happy to help, whether you actually want to buy from us or not, and value all feedback.</p>
<div class="row mt-5">
	<div class="col-sm-4">
		<div class="call_info_box">
			<i class="fa-regular fa-solid fa-phone"></i>
			<h5><i class="fa-brands fa-square-whatsapp"></i>020 895 1264 <p>(Patient only)</p></h5>
			<h5>020 475 5761 <p>(Patient only)</p></h5>			
		</div>
	</div>
	<div class="col-sm-4">
		<div class="call_info_box">
			<i class="fa-regular fa-envelope"></i>
			<h5>help@pharmahealth.co.uk</h5>			
			<p>Inquiry type</p>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="call_info_box">
			<i class="fa-regular fa-solid fa-location-dot"></i>
			<h5>Pharma Health</h5>			
			<p>87a Worship Street, EC2A 2BE <br>London, United Kingdom</p>
		</div>
	</div>
</div>
	</div>
</section>
<section class="get_in_touch_form">
	<div class="container">
		<h2 class="title_h2 text-center w100p">Get in touch with us</h2>
		<form action="#" method="POST" id="frmApp" class="xs-contact-form contact-form-v2">
		<div class="radio_inline_box">
			<label class="custom_radio">
				<input type="radio" value="Patient" class="form-check-input" name="inquiry_type" id="rdInquiry" onChange="CheckInquiryType()"> 
				Patient  
			</label>
			<label class="custom_radio">
				<input type="radio" value="Pharmacy" class="form-check-input" name="inquiry_type" id="rdInquiry" onChange="CheckInquiryType()" <?php if ($_GET['contact']=="pharmacy") echo "checked"; ?>>
				Pharmacy  
			</label>
			<label class="custom_radio">
				<input type="radio" <?php if ($_GET['contact']!="pharmacy") echo "checked"; ?> value="General Enquiry" class="form-check-input" name="inquiry_type" id="rdInquiry" onChange="CheckInquiryType()">
				General Inquiry  
			</label>
		</div>
		<div class="form_box">
       		 <div class="form-group" id="id_inquiryType" style="display:none">
				<select style="border:1px solid;" name="cmbReason" class="form-control"  data-validation="required" data-validation-error-msg="Select reason for contacting">
                	<option value="" style="display:none">Reason for contacting us</option>
                    
                    <option value="Query">Query</option>
                    <option value="Feedback">Feedback</option>
                    <option value="Complaint">Complaint</option>
                    <option value="Register  your Interest (Pharmacy Sign up)" <?php if ($_GET['contact']=="pharmacy") echo "selected"; ?>>Register  your Interest (Pharmacy Sign up)</option>
                     
                    
                </select>
			</div>
        
			<div class="form-group">
				<input type="text"  class="form-control" id="txtName" name="txtName" placeholder="Full Name" data-validation="required" data-validation-error-msg="Enter your name" />
			</div>
			<div class="form-group">
				<input  type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone Number" maxlength="12" data-validation="required" data-validation-error-msg="Enter your Phone number"/>
			</div>
			<div class="form-group">
				<input  type="email" class="form-control" id="txtEmail" name="txtEmail" data-validation="email required" data-validation-error-msg="Enter your Email address" placeholder="Email Address" />
			</div>
			<div class="form-group">
				<textarea name="txtMessage" placeholder="Message" id="txtMessage" class="form-control" data-validation="required" data-validation-error-msg="Enter Message"><?php if ($_GET['contact'] == "pharmacy") { ?>
Dear Pharma Health,

We are interested in signing up to your service or wish to discuss it. Can you please contact us:
(Please type preferred contact method and time)
<?php } ?>
</textarea>

			</div>
			
			<div class="form-group">
				<input class="g-recaptcha" data-validation="recaptcha" data-validation-recaptcha-sitekey="6Lc38CkUAAAAAGSzBr9awm5tAfiMLHitD5f21vI4">
			</div>
			
			<div class="w100p text-center">
				<input type="submit" id="submitBtn" name="submitBtn" class="btn btn-primary btn-lg" value="Send Message">
			</div>
		</div>
		<div class="form-group"> <div id="error-container" style="margin-top: 10px;"></div></div>
		</form>
	</div>
</section>
<section class="treating_section">
	<div class="container">
		<h4>Medical Emergency</h4>
		<p>Call 999 in a medical emergency – when someone is seriously ill or injured and their life is at risk.</p>
		<p class="mb-2"><b>Medical emergencies can include:</b></p>
		<ul class="list_option_1 ps-2">
			<li>Loss of consciousness</li>
			<li>An acute confused state</li>
			<li>Fits that are not stopping</li>
			<li>Persistent, severe chest pain</li>
			<li>Breathing difficulties</li>
			<li>Severe bleeding that cannot be stopped</li>
			<li>Severe allergic reactions</li>
			<li>Severe burns or scalds</li>
		</ul>
		<p>You should use the NHS 111 service if you urgently need medical help or advice but it's not a life-threatening situation</p>
		<p class="mb-2">Call 111 if:</p>
		<ul class="list_option_1">
			<li>You need medical help fast but it's not a 999 emergency</li>
			<li>You think you need to go to A&E or need another NHS urgent care service</li>
			<li>You don't know who to call or you don't have a GP to call</li>
			<li>You need health information or reassurance about what to do next</li>
		</ul>
	</div>
</section> 

</div>


<section class="our-company">
	<div class="container">
		<ul class="owl-carousel-4 our_logos owl-carousel">
			<li class="item"><img src="<?php echo URL?>images/logo_01.png"></li>
			<li class="item"><img src="<?php echo URL?>images/logo_02.png"></li>
			<li class="item"><img src="<?php echo URL?>images/logo_03.png"></li>
			<li class="item"><img src="<?php echo URL?>images/logo_01.png"></li>
			<li class="item"><img src="<?php echo URL?>images/logo_02.png"></li>
			<li class="item"><img src="<?php echo URL?>images/logo_03.png"></li>
		</ul>
	</div>
</section>
<?php include PATH."include/footer.php"; ?> 

<script src="<?php echo URL?>js/form-validator/jquery.form-validator.js"></script>
			
				<script language="javascript">
				
				CheckInquiryType();
			
				(function($, window) {
			
					// setup datepicker
			
					window.applyValidation = function(validateOnBlur, forms, messagePosition, xtraModule) {
			
			
			
						if( !forms )
			
							forms = 'form';
			
						if( !messagePosition )
			
							messagePosition = 'bottom';
			
			
			
						$.validate({
			
							form : forms,
			
							validateOnBlur : validateOnBlur,
			
							errorMessagePosition : messagePosition,
			
							scrollToTopOnError : true,
			
							sanitizeAll : 'trim', // only used on form C
			
			
			
							// borderColorOnError : 'purple',
			
			
			
							modules : 'security, location,' +( xtraModule ? ','+xtraModule:''),
			
							onModulesLoaded: function() {
			
			
			
							   // $('#country-suggestions').suggestCountry();
			
								//$('#swedish-county-suggestions').suggestSwedishCounty();
			
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
			
							 $("#submitBtn").attr('disabled','disabled');
			
							 $("#submitBtn").html("Please wait..</div>");
			
								
			
								var myform = document.getElementById("frmApp");
			
								var fd = new FormData(myform);	
			
								   $.ajax({		
								   type: "POST",			
								   url: "<?php echo URL?>pages/sendcontact.php",			
								   data: fd,			
								   cache: false,			
								   processData: false,			
								   contentType: false,	 
						
								   success: function(msg){		
								   
									if (msg==1)											
									    window.location='<?php echo URL?>pages/thanks.php';	
									   else if (msg==2)			
									   {
			
										$("#submitBtn").removeAttr("disabled");			
										$("#submitBtn").html("Submit");		
			
									   }
			
			
			
								  }
			
			
								 });
					
								return false;
			
							}
		
						});
	
					};
			
			
				   window.applyValidation(true, '#frmApp', $('#error-container'), 'sanitize');
		
				})(jQuery, window);
				
				
				function CheckInquiryType()
				{
					var selectedValue = $('#rdInquiry:checked').val();
					
					if (selectedValue=="Patient" || selectedValue=="Pharmacy")
					$("#id_inquiryType").show();
					else
					$("#id_inquiryType").hide();
					
					
					
					
				}
			
			</script>