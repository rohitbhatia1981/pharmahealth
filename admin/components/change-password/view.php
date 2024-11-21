		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$row=$rows[0];

		

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>	
		

<style>
.form-error{display:none}
</style>

<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title"><?php echo pageheading(); ?></h4>
			</div>
			<div class="page-rightheader ml-md-auto">
        <?php if ($_GET['mode']=="edit") { ?>
		<div class=" btn-list">
		<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
		</a>
        
		</div>
        <?php } ?>
	</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
          
         
            
           <div class="row">
           
           
							
							<div class="col-md-12 col-xl-9">
								<div class="tab-content adminsetting-content" id="setting-tabContent">
									<div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                                    
                                   <form  method="post" id="frmChange" >
										<div class="card">
											<div class="card-header  border-0">
												<h4 class="card-title">Change Password</h4>
											</div>
											<div class="card-body">
												<div class="form-group">
                                                <div id="success-container" style="color:#090"></div>
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Old Password</label>
														</div>
														<div class="col-md-9">
															<input type="password" id="txtOldPassword" name="txtOldPassword" data-validation="required" data-validation-error-msg="Enter old password" class="form-control" placeholder="Please enter your existing password" value="">
														</div>
													</div>
												</div>
												
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">New Password</label>
														</div>
														<div class="col-md-9">
															<input type="password" id="txtPassword" name="txtPassword" data-validation="required" data-validation-error-msg="Enter new password" class="form-control" placeholder="Please enter your new password" value="">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Confirm Password</label>
														</div>
														<div class="col-md-9">
															<input type="password" id="txtCPassword" name="txtCPassword" data-validation-confirm="txtPassword" data-validation="confirmation" class="form-control" placeholder="Re-enter your password" data-validation-error-msg="Password mismatched" value="">
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer">
                                            
                                            <div id="errorMessage" style="color:#F00; padding-bottom:20px"></div>
                                            
                                            <button type="submit" id="submitBtn" name="submitBtn" class="btn btn-primary">
                                            
												Save Changes
                                             </button>
												
											</div>
										</div>
                                        
                                        </form>					
								</div>
                                
                                
                                
                                
                                
                                
											
                                           
										</div>
                                     

				<input type="hidden" name="c" value="<?php echo $component?>" />
                
               

			</form>  
                                        
                                        
									</div>
									
									
									
									
								</div>
							
                        
	
                        
                        
	
			<!-- End Row -->
            
          <script src="<?php echo URL?>js/form-validator/jquery.form-validator.js"></script>

									<script type="text/javascript">           


									(function($, window) {
										   // setup datepicker    
								
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
								
												   $("#submitBtn").attr('disabled','disabled');
												   $("#submitBtn").html("<i class='fa fa-circle-o-notch fa-spin'></i> Please wait..</div>");
								
													var myform = document.getElementById("frmChange");
													var fd = new FormData(myform );	
								
													   $.ajax({
								
													   type: "POST",
													   url: "ajax/update-password.php",
													   data: fd,
													   cache: false,
													   processData: false,
													   contentType: false,
								
													   success: function(msg){
								
													 alert (msg);
													 
													 $("#errorMessage").html("");
													 $("#success-container").html("");
								
														   if (msg==1)
														   {
																 $("#success-container").show();
																$("#success-container").html("Password updated sucessfully");
																myform.reset();
																$("#submitBtn").html("Update Password");
															$("#submitBtn").removeAttr("disabled");
								
														   }
								
								
								
														  else if(msg == 0)
														 {
															
															$("#errorMessage").html("Old password did not matched with our records");
															 $("#submitBtn").html("Update Password");
															$("#submitBtn").removeAttr("disabled");
															myform.reset();
								
															}
								
														   else 
														  {
															$('#errorMessage').html('Something went wrong, please try again');
															$("#submitBtn").html("Update Password");
															$("#submitBtn").removeAttr("disabled");
															myform.reset();
														  }
													  
													  
													 
													  
													  }
								
								
													 });
								
								
													return false;
								
												}
								
											});
								
								
										};
										  window.applyValidation(true, '#frmChange', $('#error-container'), 'sanitize');
									})(jQuery, window);
								</script>



				


             <?php } ?>

	<!-----------End Listing function------------------>

    

    

   

     <?php function createFormForPagesHtml_details(&$rows) {

	$row=array();

	global $component, $database;

	$row = &$rows[0];

	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>
	 
<!--Page header-->

<!--End Page header-->	 

				


             <?php } ?>
  