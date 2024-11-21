<?php include "../../private/settings.php";
include PATH."patient/checksession.php";

if ($_SESSION['sess_pres_id']=="")
print "<script>window.location='".URL."patient/questionnaire/step1'</script>";

$_SESSION['questions3']=array();


include PATH."include/headerhtml.php"
 ?>
  <body style="padding-top:0px;">  
    <div class="header_2">
       <a href="#"><img src="<?php echo URL?>images/logo.png"></a>
   </div>
 <section class="medication-questionaire setup_option_2 setup_option_3">
     <div class="container">
         <h1>Medical Assessment</h1>
  <?php include "include/step-navigation.php"; ?>
  <form id="frmApp" name="frmApp" method="POST" >
         <div class="setup_white_box mt-4" style="text-align:left">
             <h3 class="title_3 mt-0 w100p  text-center">Your Medical History</h3>
  
  
  
             
                    <?php // code start
			 
			 	$sqlQ = "SELECT * FROM tbl_medical_questions where mq_status=1 and mq_category=3 and mq_conditions='".$database->filter($_SESSION['sessCondition'])."' order by mq_id asc";
				$resQ = $database->get_results($sqlQ);
				
				if (count($resQ)>0)
				{
				
					for ($q=0;$q<count($resQ);$q++)
					{
						$rowQ=$resQ[$q];
					
				 ?>
             
             
                     <div class="form-group">
                         <label class="form-label"><?php echo $rowQ['mq_questions'] ?></label>
                         
                         <?php
						 $arrOptions=array();
						 $arrRisk=array();
						 $arrOptions=unserialize(fnUpdateHTML($rowQ['mq_multiple_options']));
						 $arrRisk=unserialize(fnUpdateHTML($rowQ['mq_risk_level']));
						 
						 $_SESSION['questions3'][$q]['question']=$rowQ['mq_questions'];
						 $_SESSION['questions3'][$q]['id']=$rowQ['mq_id'];
						 $_SESSION['questions3'][$q]['type']=$rowQ['mq_answer_type'];
						 
						
						
						  if ($rowQ['mq_answer_type']==1)
						  {
							  
							   
						 ?>
                         
                         <div class="w100p">
                            <div class="radio_inline_box">
                            
                            <?php for ($j=0;$j<count($arrOptions);$j++)
							{
								?>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="rd_<?php echo $rowQ['mq_id']?>" value="<?php echo $arrOptions[$j]?>" <?php if ($j==0) echo 'data-validation="required"'; ?>>
                                    <span><?php echo $arrOptions[$j]?></span>
                                </label>
                            <?php } ?>
                                
                             </div>
                         </div>
                         
                         <?php } 
                         
                          if ($rowQ['mq_answer_type']==2)
						  {
							  
							   
						 ?>
                         
                         <ul class="conditions_list">
                         
                         	 <?php for ($j=0;$j<count($arrOptions);$j++)
							{
								?>
                         
                             <li><?php echo $arrOptions[$j]?>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"/>
                                </div>
                             </li>
                            
                            <?php } ?>

                         </ul>
                         
                         <?php } ?>
                         
                     </div> 
                 
                 <?php }
				}
				  ?>    
                     
                     
                     
            <!--<div class="form-group">
                         <label class="form-label">How long have you been sexually active?</label>
                         <div class="radio_inline_box_grid">
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>< 6 months  </span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span> 6-12 months </span>
                                </label>
                             </div>
                         </div>
                         <div class="w100p">
                            <div class="radio_inline_box">
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>1-5 months</span>
                                </label>
                                <label class="custom_radio">
                                    <input type="radio" class="form-check-input" name="a2">
                                    <span>> 5 years</span>
                                </label>
                             </div>
                         </div>
                     </div>
                     </div>--> 
             
                  

                 
                
                     
              
<div class="w100p text-center">
    <div class="left_right_buttons">
        <button class="btn btn-gray btn-lg d-inline-flex align-items-center mt-4 mb-4" onClick="javascript:history.back()"> < Back</button>
        <button class="btn btn-danger btn-lg d-inline-flex align-items-center mt-4 mb-4" id="submitBtn" name="submitBtn">Continue</button>
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
								   url: "<?php echo URL?>patient/questionnaire/ajax/insert-step4.php",			
								   data: fd,			
								   cache: false,			
								   processData: false,			
								   contentType: false,						   
			
			
			
								   success: function(msg){	
								  // alert (msg);		
									if (msg==1)			
									  window.location='<?php echo URL?>patient/questionnaire/step5';	
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