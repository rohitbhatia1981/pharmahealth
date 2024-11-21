		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$row=$rows[0];

		

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['sess_prescriber_groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];
			
			$signature=$row['pres_signature'];
			if ($signature=="")
			$mode="add";
			else
			$mode="view";

		?>	
		



<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title"><?php if ($mode=="add") echo "Add"; else echo "Your" ?> Signature</h4>
			</div>
			<div class="page-rightheader ml-md-auto">
       
	</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
          
          
            
           <div class="row">
							
							<div class="col-md-12 col-xl-12">
								<div class="tab-content adminsetting-content" id="setting-tabContent">
								
									<div class="tab-pane fade show active" id="tab-2" role="tabpanel">
                                    
                                    <form action="" method="post" id="frmApp" >
										<div class="card">
											
                                             
											<div class="card-body">
                                            
                                            <?php if ($mode=="view") { ?>
												<div class="form-group">
                                                <div id="success-container" style="color:#090"></div>
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Your Signature</label>
														</div>
														<div class="col-md-9" style="padding:10px">
															<img src="<?php echo URL?>signature/uploads/<?php echo $signature?>" style="max-width:500px" />
														</div>
													</div>
												</div>
                                                <?php } ?>
												<?php if ($mode=="add") { ?>
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Draw your Signature</label>
														</div>
														<div class="col-md-9">
                                                    <div class="form-group">
                                                        <!--<p class="text-left"><strong>Draw Signature</strong></p>-->
                                                <div id="signatureError" style="color: red; display: none;"></div>
                                                        <!-- js signature widget -->
                                                        <div class='js-signature'></div>
                                                
                                                        <!-- action button to clear the signature -->
                                                        <p><button type="button" id="clearBtn" class="btn btn-default" onClick="clearCanvas();">Clear Signature</button></p>
                                                        
                                                        <!-- populate the base64 encoded image in the textarea -->
                                                        <textarea id="signature64" name="signed"  style="display: none"></textarea>
                                                        
                                                        (Keep your signature on center of box)
                                                      </div>
                                                    <!-- /.input-box-one -->
                                                    
                                              </div>
													</div>
												</div>
                                                
                                                <?php } ?>
												
											</div>
                                            <?php if ($mode=="add") { ?>
											<div class="card-footer">
                                            
                                            <div id="errorMessage" style="color:#F00; padding-bottom:20px"></div>
                                            
                                            <button type="submit" id="submitBtn" name="submitBtn" class="btn btn-primary">
                                            
												Save Changes
                                             </button>
												
											</div>
                                            <?php } ?>
										</div>
                                        
                                      </form>
									</div>
									
<script src="<?php echo URL; ?>js/jquery.validate.js"></script>
<script language="javascript">
$(document).ready(function() {	
	
    $("#frmApp").validate({
		 ignore: [], // Ensures hidden fields are validated
        rules: {           
           
			 signed: {
                required: true
            }
			
        },
        messages: {
            // Uncomment and customize messages if needed
            // txtName: "Please enter first name",
            // txtEmail: "Please enter a valid email ID",
            // txtMobile: "Please enter a mobile number",
			
			signed: "Please provide a signature",
			
			
        },
		
		errorPlacement: function(error, element) {
        if (element.attr("name") == "signed") {
            $("#signatureError").html(error).show();
        } else {
            error.insertAfter(element);
        }
    },
		
   submitHandler: function(form) {
            $("#submitBtn").attr('disabled', 'disabled');
            $("#submitBtn").html("<i class='fa fa-spinner fa-spin'></i>");

            var formData = new FormData(form); // Create a new FormData object

            $.ajax({
                url: 'ajax/submit-signature.php',
                type: 'POST',
                data: formData, // Use FormData object
                processData: false, // Prevent jQuery from automatically transforming the data into a query string
                contentType: false, // Set the content type to false to tell jQuery not to set any content type header
                success: function(response) {
					
                    // Handle success response
                    if (response == 1) {
                       window.location.reload();

                    } else {
                        $("#messages").html(response);
                    }
                    $("#submitBtn").removeAttr('disabled'); // Re-enable the submit button
                    $("#submitBtn").html("Save Changes"); // Restore the button text
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.log(error);
                    $("#submitBtn").removeAttr('disabled'); // Re-enable the submit button
                    $("#submitBtn").html("Save Changes"); // Restore the button text
                }
            });


            return false; // Prevent default form submission
        }
    });

   

});
</script>	
                                
  <script src="<?php echo URL?>signature/js/jq-signature.js"></script>

	<script>
     // initiate jq-signature
     $('.js-signature').jqSignature({
         autoFit: true, // allow responsive
         height: 182, // set height
         border: '1px solid #a0a0a0', // set widget border
     });
     
     // create hook for clear button
     function clearCanvas() {
		
         $('.js-signature').jqSignature('clearCanvas');
         $("#signature64").val(''); // clear the textarea as well
     }

     // update the generated encoded image in the textarea
     $('.js-signature').on('jq.signature.changed', function() {
         var data = $('.js-signature').jqSignature('getDataURL');
         $("#signature64").val(data);
     });
	 
		
			</script>
									
								</div>
							</div>
						</div>
                        
                     
                    
	
			<!-- End Row -->
            
            <script language="javascript">
			
			function showRegNo(val)
				{
					
					
					$("#regGphc").hide();
					$("#regGmc").hide();
					$("#regNmc").hide();
					
					if (val==1)
					{
						$("#IdRegisterNo").show();
						$("#regGphc").show();
					}
					else if (val==2)
					{
						$("#IdRegisterNo").show();
						$("#regGmc").show();
					}
					else if (val==3)
					{
						$("#IdRegisterNo").show();
						$("#regNmc").show();
					}
					else if (val==4)
					{
						$("#IdRegisterNo").hide();
						
					}
				}
			
			function addMoreFile(val)
					{
						if (val==1)
						{
						str='<div><input style="margin-top:15px" class="form-control" name="flCert[]" type="file" accept=".pdf,.jpg,.png"></div>';
						$("#cont_addmore_"+val).append(str);
						} 
						
						if (val==2)
						{
						str='<div><input style="margin-top:15px" class="form-control" name="flCPD[]" type="file" accept=".pdf,.jpg,.png"></div>';
						$("#cpd_addmore_"+val).append(str);
						} 
					}

$("#adminForm").validate({
			rules: {
				txtPostcode: "required",
				txtAddress1: "required",
				txtCity: "required"
			},
			messages: {
				txtPostcode: "Postcode cannot be blank",
				txtAddress1: "Address cannot be blank",
				txtCity: "City cannot be blank"
				
				}			
		});

</script>

		</div>
	</div><!-- end app-content-->
</div>
				


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

				
<div class="row">
		<div class="col-lg-12 col-md-12">
        
        <div class="main-content">
					<div class="container">

						
						<!--End Page header-->

						<!-- Row -->
						
						<!-- End Row-->

					</div><!-- end app-content-->
				</div>
		</div>
</div>

             <?php } ?>
  