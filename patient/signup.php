<?php include "../private/settings.php";
include PATH."include/headerhtml.php"
 ?>
 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
 <style>
.ui-menu .ui-menu-item {
	font-size:15px;
	color:#666;
}

</style>
  <body style="padding-top:0px;">  
<section class="register_screen">
    <div class="container">
        <div class="logo_box">
        <a href="<?php echo URL?>" class="logo"><img src="<?php echo URL?>images/Pharmacy-health-final-logo.svg"></a>
        </div>
        <div class="register_box">
        <form id="frmApp" name="frmApp" method="POST" class="grid spacer-24">
            <div class="top">
            <h2 class="title_h2">Create Your Account</h2>
            <p>Creating your Pharma Health account is quick and easy.</p>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="label-control">Title</label>
                        <select class="form-control" name="txtTitle" id="txtTitle" data-validation="required" data-validation-error-msg="Please select title" >
										<option label="Select Title"></option>
										<?php
				$query = "SELECT * FROM tbl_titles where title_status=1";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {

									?>

								<option value="<?php echo $value['title_name']; ?>"   ><?php echo $value['title_name']; ?></option>

							<?php	

							}

							?> 

									
									</select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="label-control">First Name </label>
                        <input class="form-control" type="text" id="txtFirstName" name="txtFirstName" value="" data-validation="required" data-validation-error-msg="Please enter first name" maxlength="70">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="label-control">Middle Name </label>
                        <input class="form-control" type="text" id="txtMiddleName" name="txtMiddleName" value="" maxlength="70">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="label-control">Last Name</label>
                        <input class="form-control" type="text" id="txtLastName" name="txtLastName" value="" data-validation="required" data-validation-error-msg="Please enter last name" maxlength="70">
                    </div>
                </div>
                <div class="col-sm-12">
                    <p class="info">Name must correspond to your passport or driving license</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="label-control">Email</label>
                        <input class="form-control" type="email" id="txtEmail" name="txtEmail" value="" data-validation="required" data-validation-error-msg="Please enter email address" maxlength="100">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group password-strength">
                        <label class="label-control" for="password">Password</label>
                        <input class="form-control" type="text" id="password" name="txtPassword" value="" data-validation="strength" data-validation-strength="3">
                    </div>
                </div>
                
             
                
                
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="label-control">Phone</label>
                        <input class="form-control" type="text" id="txtPhone" onBlur="checkPhone()" name="txtPhone" value="" data-validation="required" data-validation-error-msg="Please enter phone number">
                        <div id="errP" style="color:#F00; font-size:13px"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="label-control">Gender</label>
                        <select class="form-control" name="cmbGender" id="cmbGender" data-validation="required" data-validation-error-msg="Please select gender" >
										<option label="Select Gender"></option>
										<?php
				$query = "SELECT * FROM tbl_gender where gender_status=1";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {

									?>

								<option value="<?php echo $value['gender_id']; ?>"   ><?php echo $value['gender_name']; ?></option>

							<?php	

							}

							?> 

									
									</select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="label-control">Date of birth</label>
                        <select class="form-control custom-select select2" name="cmbDate" id="cmbDate" data-validation="required" data-validation-error-msg="Please select date of birth" >
										<option value="">Date</option>
                                       <?php for ($k=1;$k<=31;$k++) 
									   {
										   if ($k<10)
										   $prefix="0";
										   else
										   $prefix="";
										   ?>
                                        <option value="<?php echo $prefix.$k; ?>"><?php echo $prefix.$k; ?></option>				
                                       <?php } ?>
									</select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="label-control"></label>
                        <select class="form-control custom-select select2" name="cmbMonth" id="cmbMonth" data-validation="required" data-validation-error-msg="Please select month" >
										<option value="">Month</option>
                                       
										<?php for ($r = 1; $r <= 12; $r++){
                                            $month_name = date('F', mktime(0, 0, 0, $r, 1, 2023));
											
											if ($r<10)
										   $prefix="0";
										   else
										   $prefix="";
											
                                            echo '<option value="'.$prefix.$r.'">'.$month_name.'</option>';
                                        }?>				
									</select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="label-control"></label>
                        <select class="form-control custom-select select2" name="cmbYear" id="cmbYear" data-validation="required" data-validation-error-msg="Please select year" >
										<option value="">Year</option>
                                        <?php
										$year=date("Y");
										 for ($y=$year-18;$y>=$year-118;$y--) { ?>
                                        <option value="<?php echo $y; ?>"><?php echo $y; ?></option>				
                                        <?php } ?>
									</select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="label-control">Postcode</label>
                        <input class="form-control" type="text" id="txtPostCode" name="txtPostCode" value="" data-validation="required" data-validation-error-msg="Please enter postcode" maxlength="7">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="label-control">City</label>
                        <input class="form-control" type="text" id="txtCity" name="txtCity" value="" data-validation="required" data-validation-error-msg="Please enter city" maxlength="60" data-suggestions="London">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="label-control">Address 1</label>
                        <input class="form-control" type="text" id="txtAddress1" name="txtAddress1" value="" data-validation="required" data-validation-error-msg="Please enter address" maxlength="150">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="label-control">Address 2</label>
                        <input class="form-control" type="text" id="txtAddress2" name="txtAddress2" value="" maxlength="150">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="label-control">Partner Pharmacy</label>
                        <?php
						
						if ($_GET['p']!="" || $_COOKIE['ckPharmacy']!="")
						{
							if ($_GET['p']!="")
							$sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$database->filter($_GET['p'])."' and pharmacy_status=1";
							else if ($_COOKIE['ckPharmacy']!="")
							$sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$database->filter($_COOKIE['ckPharmacy'])."' and pharmacy_status=1";
							
							$resPharmacy=$database->get_results($sqlPharmacy);
							$rowPharmacy=$resPharmacy[0];
							$pharmacyName=$rowPharmacy['pharmacy_name'].", ".$rowPharmacy['pharmacy_postcode'];
						}
						
						
						?>
                        
                        
                        
                         <input class="form-control" type="text" placeholder="Enter pharmacy name or post code.." value="<?php echo $pharmacyName; ?>" id="cmbPharmacy" name="cmbPharmacy"  data-validation="required" data-validation-error-msg="Please select Partner Pharmacy">
                        <input type="hidden" name="hdPharmacyId" id="hdPharmacyId" value="<?php echo $rowPharmacy['pharmacy_id']; ?>">
                        <!--<select class="form-control" name="cmbPharmacy" id="cmbPharmacy" data-validation="required" data-validation-error-msg="Please select Partner Pharmacy" >
										<option label="Select Pharmacy"></option>
										<?php
				$query = "SELECT * FROM tbl_pharmacies where pharmacy_status=1";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {

									?>

								<option value="<?php echo $value['pharmacy_id']; ?>"  <?php if($row['patient_pharmacy'] == $value['pharmacy_id']) {	echo 'selected="selected"';}?>  ><?php echo $value['pharmacy_name']; ?></option>

							<?php	

							}

							?> 

									
									</select>-->
                    </div>
                    
                   <i class="fa-regular fa-circle-info"></i> Please select your local pharmacy from which you will collect your medicine
                </div>
                <div class="col-sm-12 mt-4 pt-2">
                 <div class="checkbox form-group">
                    <label class="custom_checkbox">
                        <input type="checkbox" name="CkTerms" id="CkTerms" value="1" class="form-check-input" data-validation="required" data-validation-error-msg="Please accept terms and conditions">
                        I have read, understood and agree to Pharma Health <a href="#">Terms & Conditions, </a><a href="#">Privacy Notice</a> and <a href="#">Terms of Sale</a>
                    </label>
                 </div>
                    <label class="custom_checkbox">
                        <input type="checkbox" name="CkMarketing" value="1" class="form-check-input">I would like to receive marketing messages & updates from Pharma Health.</label>
<div><input class="g-recaptcha" data-validation="recaptcha" data-validation-recaptcha-sitekey="6Lc38CkUAAAAAGSzBr9awm5tAfiMLHitD5f21vI4"></div>
                      
                         <div class="button_box">
                         <div id="error-container" align="left" style="padding-top:20px; padding-bottom:20px; color:#F00"></div>
                              <button id="submitBtn" type="submit" class="btn btn-danger btn-lg  align-items-center ps-5 pe-5 w100p">Create your Account</button></div>
                        
                        
                        <div class="signup_box">                           
                            <h6>Already registered? <a href="<?php echo URL?>patient/login">Sign in</a></h6>
                        <div class="or_line"><span>or</span></div>
                        <a href="#" class="btn btn-outline-blue"><img src="<?php echo URL?>images/google_icon.png"> Sign in with Google</a> 
                    </div>
                </div>


            </div>
            </form>
        </div>
    </div>
</section>
<?php include PATH."include/footer-simple.php"; ?>


<script src="<?php echo URL?>js/form-validator/jquery.form-validator.js"></script>
<script src="<?php echo URL?>js/jquery.inputmask.bundle.js"></script>
			
				<script>
				
				$('#password').on('focus', function () {
				   $(this).attr('type', 'password'); 
				});
				
				function phoneFormat()
				  {
					  var phones = [{ "mask": "##### ######"}, { "mask": "(###) ###-##############"}];
					$('#txtPhone').inputmask({ 
					mask: phones, 
					greedy: false, 
					definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
				  }
			
				(function($, window) {
			
					// setup datepicker
					
					phoneFormat();
			
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
			
			
			
							   $('#password').displayPasswordStrength();
			
			
			
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
							
							var phoneval=checkPhone();
							
							if (phoneval==0)
							return false;
						
							
							
							
							var isChecked = $("#CkTerms").is(":checked");
							if (!isChecked) { 
							alert ("Please accept the terms and conditions");
							return false;
							}
							
							if ($("#hdPharmacyId").val()=="")
							{
								alert ("Please select pharmacy from the autocomplete list");
								return false;
								
							}
							
							
							
			
							 $("#submitBtn").attr('disabled','disabled');
			
							 $("#submitBtn").html("Please wait..</div>");
			
								
			
								var myform = document.getElementById("frmApp");
			
								var fd = new FormData(myform);	
			
								   $.ajax({		
								   type: "POST",			
								   url: "<?php echo URL?>patient/ajax/insert-patient.php",			
								   data: fd,			
								   cache: false,			
								   processData: false,			
								   contentType: false,						   
			
			
			
								   success: function(msg){	
								  // alert (msg);		
									if (msg==1)			
									  window.location='<?php echo URL?>patient/thanks';	
									   else if (msg==2)			
									   {
			
										$("#submitBtn").removeAttr("disabled");			
										$("#submitBtn").html("Submit");	
										$("#error-container").html("Your email id is already registered with us, please click here to login");	
			
									   }
			
			
			
								  }
			
			
			
								 });
			
			
			
								return false;
			
			
			
							}
			
			
			
						});
			
			
			
					};
			
			
			
			
			
				   window.applyValidation(true, '#frmApp', $('#error-container'), 'sanitize');
			
			
			
			
			
				})(jQuery, window);
			
			
			function checkPhone()
			{
				
                var inputValue = $('#txtPhone').val();
				
			    var cleanedValue = inputValue.replace(/[_ ]/g, '');
                var length = cleanedValue.length;
				
						if (length<11 && length>0)
							{
							$("#errP").html("Phone number must be 11 digits");
							return 0;
							}
							else
							{
							$("#errP").html("");
							return 1;
							}
				
				
				
			}
			

  $("#cmbPharmacy").keyup(function(){
        $("#hdPharmacyId").val(""); // Clear the value of #hdPharmacyId
    });	
	
 $("#cmbPharmacy").autocomplete({
		 minLength: 1,
        source: "<?php echo URL?>ajax/pharmacies",
       select: function( event, ui ) {
            event.preventDefault();
			$("#cmbPharmacy").val(ui.item.value);
            $("#hdPharmacyId").val(ui.item.id);
			idVal=ui.item.id;
			
		
			
        }
    });
	
	
			
			</script>
