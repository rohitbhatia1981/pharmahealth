<?php include "../../private/settings.php";
include PATH."patient/checksession.php";

include PATH."include/headerhtml.php";

$_SESSION['questions']=array();
$_SESSION['questions'][0]="Are you genetically (i.e. born) male or female?";
$_SESSION['questions'][1]="Please tick if any of the following statements apply to you";
$_SESSION['questions'][2]="Date of birth";
$_SESSION['questions'][3]="Do you smoke?";
$_SESSION['questions'][4]="How much do you smoke?";
$_SESSION['questions'][5]="When did you quit smoking?";
$_SESSION['questions'][6]="Do you often drink more than 21 units";




 ?>
  <body style="padding-top:0px;">  
    <div class="header_2">
       <a href="#"><img src="<?php echo URL?>images/logo.png"></a>
   </div>
 <section class="medication-questionaire setup_option_2">
     <div class="container">
         <h1>Medical Assessment</h1>
        <?php include "include/step-navigation.php"; ?>
        
         </div>
          <form id="frmApp" name="frmApp" method="POST" >
         <div class="setup_white_box mt-4">
             <h3 class="title_3 mt-0 w100p text-center">About You</h3>
             <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group">
                     
                         <label class="form-label"><?php echo $_SESSION['questions'][0]; ?></label>
                         
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" value="Male" class="form-check-input" name="rdGender" onChange="showOptions()" data-validation="required">
                                    <span>Male</span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" value="Female" class="form-check-input" name="rdGender" onChange="showOptions()">
                                    <span>Female </span>
                                </label>
                             </div>
                             
                             <div id="femaleOpt" style="display:none;padding-left:5%; padding-top:10px;width:100%; border:1px solid #CCC">
                             
                             <div class="row">
                 <div class="col-sm-12">
                 
                 <?php $question2=""; ?>
                     <div class="form-group">
                         <label class="form-label"><?php echo $_SESSION['questions'][1]; ?></label>
                          
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" value="You are currently pregnant" class="form-check-input" name="rdFemale" id="rdFemale" onChange="chkFemale()" data-validation="required">
                                    <span>You are currently pregnant</span>
                                </label>
                                <div style="clear:both"></div>
                                <label class="custom_radio">
                                    <input type="radio" value="You are intending to become pregnant" class="form-check-input" name="rdFemale" id="rdFemale" onChange="chkFemale()">
                                    <span>You are intending to become pregnant</span>
                                </label>
                                  <div style="clear:both"></div>                             
                                
                                <label class="custom_radio">
                                    <input type="radio" value="You are currently breastfeeding" class="form-check-input" name="rdFemale" id="rdFemale" onChange="chkFemale()">
                                    <span>You are currently breastfeeding </span>
                                </label>
                                <div style="clear:both"></div>
                                
                                <label class="custom_radio">
                                    <input type="radio" value="You are intending to start breastfeeding within the next 6 months" class="form-check-input" name="rdFemale" id="rdFemale" onChange="chkFemale()">
                                    <span>You are intending to start breastfeeding within the next 6 months</span>
                                </label>
                                <div style="clear:both"></div>
                                
                                 <label class="custom_radio">
                                    <input type="radio" value="None of the above apply" class="form-check-input" name="rdFemale" id="rdFemale" onChange="chkFemale()">
                                    <span>None of the above apply</span>
                                </label>
                                
                             </div>
                             <font style="color:#F00; padding-bottom:10px" id="femErr"></font>
                         </div>
                     </div>
                 </div>
             </div>
                             
                             
                             </div>
                             
                             
                         </div>
                     </div>
                 </div>
             </div>
             
             
             
             
             <div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            <label class="form-label"><?php echo $_SESSION['questions'][2]; ?></label>
            <div class="row">
                <div class="col-sm-4"> <!-- Adjusted column size for mobile -->
                    <select class="form-control" name="cmbDate" id="cmbDate" data-validation="required" data-validation-error-msg="Please select date of birth" style="appearance: auto; -webkit-appearance: menulist; -moz-appearance: menulist;color:#000">
                        <option value="">Date</option>
                        <?php for ($k=1; $k<=31; $k++) {
                            $prefix = ($k < 10) ? "0" : "";
                        ?>
                        <option value="<?php echo $prefix.$k; ?>"><?php echo $prefix.$k; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4"> <!-- Adjusted column size for mobile -->
                    <select class="form-control custom-select select2" name="cmbMonth" id="cmbMonth" data-validation="required" data-validation-error-msg="Please select month" style="appearance: auto; -webkit-appearance: menulist; -moz-appearance: menulist;color:#000">
                        <option value="">Month</option>
                        <?php for ($r = 1; $r <= 12; $r++){
											if ($r<10)
										   $prefix="0";
										   else
										   $prefix="";
                            $month_name = date('F', mktime(0, 0, 0, $r, 1, 2023));
                            echo '<option value="'.$prefix.$r.'">'.$month_name.'</option>';
                        }?>
                    </select>
                </div>
                <div class="col-sm-4"> <!-- Adjusted column size for mobile -->
                    <select class="form-control custom-select select2" name="cmbYear" id="cmbYear" data-validation="required" data-validation-error-msg="Please select year" style="appearance: auto; -webkit-appearance: menulist; -moz-appearance: menulist;color:#000">
                        <option value="">Year</option>
                        <?php
                        $year = date("Y");
                        for ($y = $year-18; $y >= $year-65; $y--) { ?>
                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <font style="color:#F00; padding-bottom:10px" id="ageErr"></font>
</div>


             <div class="row">
                  <div class="col-sm-12">
                     <div class="form-group">
                         <label class="form-label"><?php echo $_SESSION['questions'][3]; ?> <img src="<?php echo URL?>images/i-icon.png" style="max-height:22px"  title="Seeking help to stop smoking will help reduce your risk of cancer, COPD and heart disease."></label>
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" value="Yes" name="rdSmoke" id="rdSmoke" onChange="chkSmoke()" data-validation="required">
                                    <span>Yes</span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" value="No" name="rdSmoke" id="rdSmoke" onChange="chkSmoke()">
                                    <span>No </span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" value="Ex-Smoker" name="rdSmoke" id="rdSmoke" onChange="chkSmoke()">
                                    <span>Ex-Smoker </span>
                                </label>
                             </div>
                             
           <div id="smokeOpt" style="display:none;padding-left:5%; padding-top:10px;width:100%; border:1px solid #CCC">
                             
                             <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group">
                         <label class="form-label"><?php echo $_SESSION['questions'][4]; ?></label>
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio"  class="form-check-input" name="rdHowmuchSmoke" value="More than 15 a day" id="rdHowmuchSmoke" data-validation="required" >
                                    <span>More than 15 a day</span>
                                </label>
                                <div style="clear:both"></div>
                               
                                 <label class="custom_radio">
                                    <input type="radio"  class="form-check-input" name="rdHowmuchSmoke" value="Less than 15 a day" id="rdHowmuchSmoke" >
                                    <span>Less than 15 a day</span>
                                </label>
                             <div style="clear:both"></div>
                             <div style="height:20px"></div>
                             
                                
                             </div>
                             
                         </div>
                     </div>
                 </div>
             </div>
             
             </div>
             
             <div id="smokeOpt2" style="display:none;padding-left:5%; padding-top:10px;width:100%; border:1px solid #CCC">
             
             <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group">
                         <label class="form-label"><?php echo $_SESSION['questions'][5]; ?></label>
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" value="Less than a year ago"  class="form-check-input" name="rdSmoking" id="rdSmoking" data-validation="required" >
                                    <span>Less than a year ago</span>
                                </label>
                                <div style="clear:both"></div>
                               
                                 <label class="custom_radio">
                                    <input type="radio" value="More than a year ago" class="form-check-input" name="rdSmoking" id="rdSmoking" >
                                    <span>More than a year ago</span>
                                </label>
                                
                                 <div style="clear:both"></div>
                             <div style="height:20px"></div>
                             
                                
                             </div>
                             
                         </div>
                     </div>
                 </div>
             </div>
             
            
                             
                             
                             </div>
                             
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                  <div class="col-sm-12">
                     <div class="form-group">
                         <label class="form-label"><?php echo $_SESSION['questions'][6]; ?></label> <img src="<?php echo URL?>images/i-icon.png" style="max-height:22px"  title="This is likely to be increasing your risk of serious health conditions, such as heart disease, stroke and liver disease. To keep your risk of alcohol-related harm to a minimum, it is recommended not regularly drinking more than 14 units of alcohol a week. If you drink as much as 14 units a week, it's best to spread this over three or more days. ">
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="rdDrink" id="rdDrink" value="Yes"  data-validation="required">
                                    <span>Yes</span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="rdDrink" id="rdDrink" value="No" onChange="fnDrinkNote()">
                                    <span>No </span>
                                </label>
                                
                             
                             
                              
                              
                                
                             </div>
                         </div>
                     </div>
                     
                     
                 </div>
             </div>
<div class="w100p text-center">

<div id="error-container" style="text-align:left"></div>

    <div class="left_right_buttons">
        <button type="button" class="btn btn-gray btn-lg d-inline-flex align-items-center mt-4 mb-4" onClick="window.location='step1'"> < Back</button>
        <button type="submit" class="btn btn-danger btn-lg d-inline-flex align-items-center mt-4 mb-4" id="submitBtn">Continue</button>
    </div>
</div>  
         </div>
         
         </form>
     </div>
 </section>
<?php include PATH."include/footer-simple.php"; ?>

<script src="<?php echo URL?>js/form-validator/jquery.form-validator.js"></script>
<script language="javascript">
				
				
			
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
							
							
							/*var isChecked = $("#CkTerms").is(":checked");
							if (!isChecked) { 
							alert ("Please accept the terms and conditions");
							return false;
							} */
							
							
							
			
							$("#submitBtn").attr('disabled','disabled');
			
							$("#submitBtn").html("Please wait..</div>");
			
								
			
								var myform = document.getElementById("frmApp");
			
								var fd = new FormData(myform);	
			
								   $.ajax({		
								   type: "POST",			
								   url: "<?php echo URL?>patient/questionnaire/ajax/insert-step2.php",			
								   data: fd,			
								   cache: false,			
								   processData: false,			
								   contentType: false,						   
			
			
			
								   success: function(msg){	
								  // alert (msg);
								  
								 // $("#error-container").html(msg);	
								  
								  	
									if (msg==1)			
									  window.location='<?php echo URL?>patient/questionnaire/step3';	
									   else if (msg==2)			
									   {
			
											
										$("#error-container").html("Something went wrong!");	
			
									   }
			
			
			
								  }
			
			
			
								 });
			
			
			
								return false;
			
			
			
							}
			
			
			
						});
			
			
			
					};
			
			
			
			
			
				   window.applyValidation(true, '#frmApp', $('#error-container'), 'sanitize');
			
			
			
			
			
				})(jQuery, window);
			
			
			
			</script>



<script language="javascript">




function showOptions()
{
	if ($("input[name='rdGender']:checked").val()=="Female")
	$("#femaleOpt").show();
	else
	$("#femaleOpt").hide();
	
	
}

function checkDate()
{
		
	var dob = $("#txtDOB").val();
	dob = new Date(dob);
	
	if(dob != ''){
		var today = new Date();
		var dayDiff = Math.floor(today - dob) / (1000 * 60 * 60 * 24 * 365);
		var age = parseInt(dayDiff);
		
		
		if (age<18 )
		{
			$("#ageErr").html("Not suitable age <18 - The safety of our patients is paramount, and therefore we recommend you liaise with your GP for this treatment. They are in a better position to safely assess and monitor your symptoms as they hold your full medical record.");
			$("#submitBtn").attr('disabled','disabled');
		}
		
		else if (age>65 )
		{
			$("#ageErr").html("Not suitable age >65 - The safety of our patients is paramount, and therefore we recommend you liaise with your GP for this treatment. They are in a better position to safely assess and monitor your symptoms as they hold your full medical record.");
			$("#submitBtn").attr('disabled','disabled');
		}
		else
		{
			$("#ageErr").html("");
			$("#submitBtn").removeAttr('disabled');
		}
		
		
		//$('#yourage').html(age+' years old');
	}
	
	
}

function chkFemale()
{
  var fem=$("input[name='rdFemale']:checked").val();
  
  
  
	  if (fem=="You are currently pregnant")
	  {
	  $("#femErr").html("You are currently pregnant - Not suitable - The safety of our patients is paramount, and therefore we recommend you liaise with your GP for this treatment. They are in a better position to safely assess and monitor your symptoms as they hold your full medical record.");
	  $("#submitBtn").attr('disabled','disabled');
	  }
	  else if (fem=="You are intending to become pregnant")
	  {
	  $("#femErr").html("You are intending to become pregnant - Not suitable - The safety of our patients is paramount, and therefore we recommend you liaise with your GP for this treatment. They are in a better position to safely assess and monitor your symptoms as they hold your full medical record.");
	  $("#submitBtn").attr('disabled','disabled');
	  }
	  else
	  {
	  	$("#femErr").html("");
	 	 $("#submitBtn").removeAttr('disabled','disabled');
	  }
  
}

function chkSmoke()
{
  var smoke=$("input[name='rdSmoke']:checked").val();
  if (smoke=="Yes")
  {
  $("#smokeOpt").show();
  $("#smokeOpt2").hide();
  }
  else if (smoke=="Ex-Smoker")
  {
  $("#smokeOpt2").show();
   $("#smokeOpt").hide();
  }
  else
  {
	   $("#smokeOpt").hide();
	   $("#smokeOpt2").hide();
  }
  
  
}

/*function fnDrinkNote()
{
	var drink=$("input[name='rdDrink']:checked").val();
	
	if (drink=="Yes")
	  {
	  $("#drinkNotice").show();
	 
	  }
	  else
	  {
		   $("#drinkNotice").hide();
		  
	  }
	
	
}*/

</script>

