<?php include "../../private/settings.php";
include PATH."patient/checksession.php";
include PATH."include/headerhtml.php";
 ?>
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

 <style>

.ui-menu .ui-menu-item {
	font-size:15px;
	color:#666;
}



</style>

  <body style="padding-top:0px;">  
    <div class="header_2">
       <a href="#"><img src="<?php echo URL?>images/logo.png"></a>
   </div>
 <section class="medication-questionaire setup_option_2 setup_option_6">
     <div class="container">
         <h1>Medical Assessment</h1>
       <?php include "include/step-navigation.php"; ?>
         <div class="setup_white_box mt-4" style="text-align:left">
             <h3 class="title_3 mt-0 w100p text-center">Agreement</h3>
             <h5>Please tick the box to confirm you have read and understood the following information and 
agree to act on it.</h5>

<?php $strAgreement.='<ul class="list_items">
    <li>I have answered all the questions honestly, and provided complete and accurate information that 
reflects my up to date medical history and information. I understand that the Pharma Health clinical 
team takes my answers in good faith and base their prescribing decisions accordingly; and that 
incorrect information can potentially harm my health.</li>
<li>I have read the key facts about this medication & condition, including the medication effectiveness
and the alternative treatment options available.</li>
<li>I will read the Patient Information Leaflet (PIL) supplied with the medicine including the dosage 
instructions, side effects and contra-indications prior to starting the treatment</li>';

$sqlCondition="select * from tbl_conditions where condition_id='".$database->filter($_SESSION['sessCondition'])."'";
$resCondition=$database->get_results($sqlCondition);
		
$rowCondition=$resCondition[0];
$agreement=str_replace("\n","</li>",$rowCondition['condition_agreement']);
$agreement=str_replace("-","<li>",$agreement);


$strAgreement.=$agreement;

$strAgreement.='
<p style="padding-top:20px;color:#039; font-weight:bold"><input type="checkbox" name="ckTerms" id="ckTerms" value="1">&nbsp;I have read and understood the above points, and I agree to act on them.</p>

</ul>
<h5>We are legally required to inform your GP about the treatment/medication we are providing 
under this service, so they can update your medical record on their system and continue to 
provide safe medical care. Please provide your GP\'s contact details.</h5>';

echo $strAgreement;

$_SESSION['sessAgreement']=$strAgreement;
?>



 <form id="frmApp" name="frmApp" method="POST" >
<div class="practice_box">
    <label class="custom_radio">
        <input type="radio" class="form-check-input" value="1" checked name="ckGP" onChange="checkGP()">
        <span>I know my GP Practice details</span>
    </label>
    <div id="id_gp_know">
    <div class="form-group" >
    <div class="row align-items-center">
        
        <div class="col-sm-8">
            <input type="text" id="txtGP" name="txtGP"  placeholder="Search by GP Practice, Address or Post Code" class="form-control" data-validation="required" data-validation-error-msg="Please select your GP">
           
             <ul class="list-group" style="position: absolute; min-width:320px; " >

    		 </ul>
             
             <div id="localSearchSimple"></div>
     		
        </div>
    </div>
    </div>
    </div>
</div>
<div class="practice_box mt-4">
    <label class="custom_radio">
        <input type="radio" class="form-check-input" name="ckGP" value="2" onChange="checkGP()">
        <span> I know my GP Practice details but unable to locate it on the drop down menu </span>
    </label>
    
    <div style="display:none" id="id_notFound">
    
    <div class="form-group mt-2 mb-1" >
        <div class="row align-items-center">
            <label class="col-sm-4 form-label">GP Practice *:</label>
            <div class="col-sm-8">
                <input type="text" placeholder="" class="form-control" name="txtGP_request" data-validation="required" data-validation-error-msg="Please enter your GP Practice name">
            </div>
        </div>
    </div>
    <div class="form-group mt-2 mb-1">
        <div class="row align-items-center">
            <label class="col-sm-4 form-label">Address *:</label>
            <div class="col-sm-8">
                <input type="text" placeholder="" class="form-control" name="txtAddress" data-validation="required" data-validation-error-msg="Please select your GP Address">
            </div>
        </div>
    </div>
    <div class="form-group mt-2 mb-1">
        <div class="row align-items-center">
            <label class="col-sm-4 form-label">Email:</label>
            <div class="col-sm-8">
                <input type="Email" name="txtEmail" placeholder="" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group mt-2 mb-1">
        <div class="row align-items-center">
            <label class="col-sm-4 form-label">Telephone *:</label>
            <div class="col-sm-8">
                <input type="text" placeholder="" class="form-control" name="txtPhone" data-validation="required" data-validation-error-msg="Please select your GP Phone">
            </div>
        </div>
    </div>
    
    </div>
    
    
</div>
<div class="practice_box mt-4">
    <label class="custom_radio">
        <input type="radio" class="form-check-input" name="ckGP" value="3" onChange="checkGP()">
        <span>I don’t know my GP Practice details</span>
    </label>
</div>
<div class="practice_box mt-2">
    <label class="custom_radio">
        <input type="radio" class="form-check-input" name="ckGP" value="4" onChange="checkGP()">
        <span>I do not have a registered GP in the UK</span>
    </label>
</div>
<div class="practice_box mt-2">
    <label class="custom_radio">
        <input type="radio" class="form-check-input" name="ckGP" value="5" onChange="checkGP()">
        <span>I will take responsibility to inform my GP </span>
    </label>
</div>
         
                  
                

              
              
<div class="w100p text-center">

    <div class="left_right_buttons">
          <button class="btn btn-gray btn-lg d-inline-flex align-items-center mt-4 mb-4" onClick="javascript:history.back()"> < Back</button>
        <button class="btn btn-danger btn-lg d-inline-flex align-items-center mt-4 mb-4" id="submitBtn" name="submitBtn">Continue</button>
    </div>
</div>  
 
</form> 
         </div>
     </div>
 </section>
<?php include PATH."include/footer-simple.php"; ?>


<script language="javascript">
function checkGP()
{
	var getGP=$("input[name='ckGP']:checked").val();
	
	if (getGP=="2")
	{
		$("#id_notFound").show();
		$("#id_gp_know").hide();
	} 
	else if (getGP=="1")
	{
		$("#id_notFound").hide();
		$("#id_gp_know").show();
	}
	else if (getGP=="3" || getGP=="4")
	{
		$("#id_notFound").hide();
		$("#id_gp_know").hide();
	}
	
}

$(function() {
    $("#txtGP").autocomplete({
		 minLength: 2,
        source: "<?php echo URL?>ajax/gps",
       /*select: function( event, ui ) {
            event.preventDefault();
            $("#hdGP").val(ui.item.id);
        }*/
    });
});


</script>

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
							
							
							var isChecked = $("#ckTerms").is(":checked");
							if (!isChecked) { 
							alert ("Please accept the terms to proceed further");
							return false;
							} 
							
							
							
			
							$("#submitBtn").attr('disabled','disabled');
			
							$("#submitBtn").html("Please wait..</div>");
			
								
			
								var myform = document.getElementById("frmApp");
			
								var fd = new FormData(myform);	
			
								   $.ajax({		
								   type: "POST",			
								   url: "<?php echo URL?>patient/questionnaire/ajax/insert-step6.php",			
								   data: fd,			
								   cache: false,			
								   processData: false,			
								   contentType: false,						   
			
			
			
								   success: function(msg){	
								  // alert (msg);
								  
								 // $("#error-container").html(msg);	
								  
								  	
									if (msg==1)			
									  window.location='<?php echo URL?>patient/questionnaire/checkout';	
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