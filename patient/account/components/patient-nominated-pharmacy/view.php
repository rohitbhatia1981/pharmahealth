		

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
		
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

 <style>

.ui-menu .ui-menu-item {
	font-size:15px;
	color:#666;
}





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
          
          <?php if ($_GET['mode']=="edit") { ?>
            
           <div class="row">
							
							<div class="col-md-12 col-xl-12">
								<div class="tab-content adminsetting-content" id="setting-tabContent">
									<div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                                    
                                   <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=saveedit" method="post" class="form-horizontal">
										<div class="card">
											<div class="card-header  border-0">
												<!--<h4 class="card-title">GP Details</h4>-->
											</div>
                                            
                                             
                                            
											<div class="card-body">
												<div class="form-group">
													<div class="row">
                                                    		<div class="col-md-12">
                                                            <h5>We are legally required to inform your GP about the treatment/medication we are providing 
under this service, so they can update your medical record on their system and continue to 
provide safe medical care. Please provide your GP's contact details.</h5>
                                                            </div>
                                                    </div>
												</div>
                                               
                                                
<div id="GP_options" style="padding:20px">
                                              
                                              
    <div class="practice_box">
    <label class="custom_radio">
        <input type="radio" class="form-check-input" value="1" <?php if ($row['pg_option']==1) echo "checked"; ?> name="ckGP" onChange="checkGP()">
        <span>I know my GP Practice details</span>
    </label>
    <div id="id_gp_know">
    <div class="form-group" >
    <div class="row align-items-center">
        
        <div class="col-sm-8">
            <input type="text" id="txtGP" name="txtGP" required value="<?php if ($row['pg_option']==1) echo $row['pg_gp']; ?>"  placeholder="Search by GP Practice, Address or Post Code" class="form-control">
           
             <ul class="list-group" style="position: absolute; min-width:320px;" >
				
    		 </ul>
             
             <div id="localSearchSimple"></div>
     		
        </div>
    </div>
    </div>
    </div>
</div>

<div class="practice_box mt-4">
    <label class="custom_radio">
        <input type="radio" class="form-check-input" <?php if ($row['pg_option']==2) echo "checked"; ?> name="ckGP" value="2" onChange="checkGP()">
        <span> I know my GP Practice details but unable to locate it on the drop down menu </span>
    </label>
    
    
    <?php
	if ($row['pg_option']==2)
	{
		$gpPractice=$row['pg_gp_name'];
		$gpAddress=$row['pg_gp_address'];
		$gpEmail=$row['pg_gp_email'];
		$gpPhone=$row['pg_gp_phone'];
		
	}
	?>
    
    
    <div style="display:none" id="id_notFound">
    
    <div class="form-group mt-2 mb-1" >
        <div class="row align-items-center">
            <label class="col-sm-4 form-label">GP Practice *:</label>
            <div class="col-sm-8">
                <input type="text" placeholder="" value="<?php echo $gpPractice; ?>" class="form-control" value="<?php echo $gpPractice; ?>" name="txtGP_request" data-validation="required" data-validation-error-msg="Please enter your GP Practice name">
            </div>
        </div>
    </div>
    <div class="form-group mt-2 mb-1">
        <div class="row align-items-center">
            <label class="col-sm-4 form-label">Address *:</label>
            <div class="col-sm-8">
                <input type="text" placeholder="" value="<?php echo $gpAddress; ?>" class="form-control" name="txtAddress" data-validation="required" data-validation-error-msg="Please select your GP Address">
            </div>
        </div>
    </div>
    <div class="form-group mt-2 mb-1">
        <div class="row align-items-center">
            <label class="col-sm-4 form-label">Email:</label>
            <div class="col-sm-8">
                <input type="Email" name="txtEmail" value="<?php echo $gpEmail; ?>" placeholder="" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group mt-2 mb-1">
        <div class="row align-items-center">
            <label class="col-sm-4 form-label">Telephone *:</label>
            <div class="col-sm-8">
                <input type="text" placeholder="" value="<?php echo $gpPhone; ?>" class="form-control" name="txtPhone" data-validation="required" data-validation-error-msg="Please select your GP Phone">
            </div>
        </div>
    </div>
    
    </div>   
    
	</div>
    
    <div class="practice_box mt-4">
    <label class="custom_radio">
        <input type="radio" class="form-check-input" <?php if ($row['pg_option']==3) echo "checked"; ?> name="ckGP" value="3" onChange="checkGP()">
        <span>I don’t know my GP Practice details</span>
    </label>
</div>
<div class="practice_box mt-2">
    <label class="custom_radio">
        <input type="radio" class="form-check-input" name="ckGP" <?php if ($row['pg_option']==4) echo "checked"; ?> value="4" onChange="checkGP()">
        <span>I do not have a registered GP in the UK</span>
    </label>
</div>
<div class="practice_box mt-2">
    <label class="custom_radio">
        <input type="radio" class="form-check-input" name="ckGP" <?php if ($row['pg_option']==5) echo "checked"; ?> value="5" onChange="checkGP()">
        <span>I will take responsibility to inform my GP </span>
    </label>
</div>
                                              
                                              
</div>

<script language="javascript">
checkGP();
</script>                                           
												
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
												
												
												
												
                                                
												
												
												
                                                
                                                
												
											</div>
											<div class="card-footer">
                                            	
												<button  class="btn btn-primary mt-4 mb-0">Submit</button>
											</div>
                                           
										</div>
                                     

				<input type="hidden" name="c" value="<?php echo $component?>" />
                
               

			</form>  
                                        
                                        
									</div>
									
									
									
									
								</div>
							</div>
						</div>
                        
                        <?php } else {
							
							
							
							$sqlData="select * from tbl_patients,tbl_pharmacies where patient_pharmacy=pharmacy_id and patient_id='".$database->filter($_SESSION['sess_patient_id'])."'";
							$resData=$database->get_results($sqlData);
							$rowData=$resData[0];
							
							$_SESSION['sessOldPharmacy']=$rowData['pharmacy_address'];
							
							 ?>
                        
                        <div class="row">
                        <div class="col-xl-12 col-md-12">
                        	<div class="card">
									<div class="card-body">
                                    	<div class="table-responsive">
											<table class="row table-borderless w-100 m-0 text-nowrap">
												<tbody class="col-lg-12 col-xl-12 mb-4">
												<tr>
                                                	<td style="width:30%"><img src="<?php echo URL?>patient/account/templates/black/assets/images/pharmacy.png"></td>
                                                    <td>
                                                    	<table class="row table-borderless" style="line-height:28px">
                                                        	<tr>
                                                            	<td><h4 class="mb-2"><?php echo $rowData['pharmacy_name']?></h4> 
                                                                	<?php echo $rowData['pharmacy_address']?>, <?php echo $rowData['pharmacy_address2']?>, <?php echo $rowData['pharmacy_city']?>, <?php echo $rowData['pharmacy_postcode']?>
                                                                     
                                                                </td>
                                                            </tr>
                                                            <tr><td><a href="mailto:<?php echo $rowData['pharmacy_o_email']?>"><?php echo $rowData['pharmacy_o_email']?></a></td></tr>
                                                        </table>
                                                    </td>
                                                 </tr>
                                                 </tbody>
                                            </table>
                                            </div>
                                         </div>        
                               </div>
                           </div>     
                        </div>
                        
                        
                        
                        <div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<h4 class="page-title">Want to change your Pharmacy?</h4>
							</div>
							
						</div>
                        <div class="row">
                        <div class="col-xl-12 col-md-12">
								<div class="card">
                                
                                <?php
								
								$sqlData="select * from tbl_pharmacy_request where pr_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' and pr_status=0";
							    $resData=$database->get_results($sqlData);
								if (count($resData)==0)
								{								
								?>
									<div class="card-body col-xl-9 col-md-12">
                                    
                                    <form method="POST" action="" onsubmit="return loadPharmacy()">
                                    
                                     <div class="row">
                       					 <div class="col-xl-4 col-md-4">
                                          <h5 style="margin-top:10px">Search  by Postcode</h5>
                                          <input class="form-control d-flex mr-3" onkeyup="removeOther(1)"  name="postcode" id="postcode" placeholder="" style="text-transform:uppercase">
                                         </div>
                                         <div class="col-xl-3 col-md-3">
                                          <h5 style="margin-top:10px"><input type="radio" class="custom-control-input" name="rdPharmacy"  value="1"> &nbsp;Search within miles</h5>
                                          <select class="form-control" name="cmbMiles" id="cmbMiles" >
                                          	<option value="1">1 mile</option>
                                            <option value="3">3 miles</option>
                                            <option value="5">5 miles</option>
                                            <option value="10">10 miles</option>
                                           </select>
                                         </div>
                                        </div>
                                         <div class="row">
                                         
                                          <div class="col-xl-4 col-md-4" style="padding-top:20px">
                                          Or
                                          <h5 style="margin-top:10px">Search  by Name</h5>
                                          <input class="form-control d-flex mr-3"  name="pharmacy" id="pharmacy" onkeyup="removeOther(2)" placeholder="">
                                          
                                       </div>
                                         
                                       </div>
                                       <div style="height:20px"></div>
                                       <div class="row">
                                       
                                        <div class="col-xl-4 col-md-4">
                                      		<button type="button" class="btn btn-primary" onclick="loadPharmacy()">Search</button>
                                        </div>
                                       
                                       </div>
                                     </form>
                                         
                                    
                                    	
                                       
                                    
                                    
                                    <div id="pharm_container" style="padding:20px">
                                       
                                     
                                 		</div>
                                    
                                   
									</div>
                                  <?php } else {
									  
									  $rowData=$resData[0];
									   ?>
                                  
                                  <div class="card-body col-xl-12 col-md-12"> <h5>Status of your request ID #<?php echo $rowData['pr_id']?> for a change of pharmacy is currently - <span style="color:#F00">Pending</span></h5> </div>
                                  <?php } ?>
									
								</div>
							</div>
                            
							
							
						</div>
                        
                        <?php } ?>
	
			<!-- End Row -->
            
            <script language="javascript">
			
			function removeOther(val)
			{
				if (val==1)
				{
					$("#pharmacy").val("");
				}
				else if (val==2)
				{
					$("#postcode").val("");
				}
			}
			
			</script>
            
            <script language="javascript">
			
	function loadPharmacy()
	{
				
		zipcode=$("#postcode").val();	
		pharmacy=$("#pharmacy").val();
		miles=$("#cmbMiles").val();		
		
		
				var encodedZipcode = encodeURIComponent(zipcode);
				var encodedPharmacy = encodeURIComponent(pharmacy);
				
				$("#pharm_container").html("<img src='https://cdnjs.cloudflare.com/ajax/libs/galleriffic/2.0.1/css/loader.gif'>");
				
				$("#pharm_container").load("components/patient-nominated-pharmacy/loadpharmacy.php?code=" + encodedZipcode + "&pharmacy=" + encodedPharmacy + "&miles=" + miles + "", function(response, status, xhr) {
					
				if (status == "success") {
				  console.log("Content loaded successfully!");
				} else if (status == "error") {
				  console.log("Error loading content: " + xhr.status + " " + xhr.statusText);
				}
			  });
			  $("#errord").html("");
		
		
		
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

				



             <?php } ?>
             
           

  