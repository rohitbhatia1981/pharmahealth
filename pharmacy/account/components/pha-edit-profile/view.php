		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$row=$rows[0];

		

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['sess_pharmacy_groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>	
		



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
           
           
							
							<div class="col-md-12 col-xl-9">
								<div class="tab-content adminsetting-content" id="setting-tabContent">
									<div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                                    
                                   <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=saveedit" method="post" class="form-horizontal">
										<div class="card">
											<div class="card-header  border-0">
												<h4 class="card-title">My Details</h4>
											</div>
                                            
                                             
                                            
											<div class="card-body pb-2">
						
		 <h4 style="text-transform:uppercase"><u>PHARMACY DETAILS</u></h4>
         <div style="height:20px"></div>
					
                            
                           <div class="form-group">
								<label class="form-label">Name of Pharmacy  *</label>
								<input class="form-control mb-4" type="text" id="txtPharmacyName" name="txtPharmacyName" value="<?php echo $row['pharmacy_name']?>" >
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Address 1 *</label>
								<input class="form-control mb-4" type="text" id="txtAddress" name="txtAddress" value="<?php echo $row['pharmacy_address']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Address 2</label>
								<input class="form-control mb-4" type="text" id="txtAddress2" name="txtAddress2" value="<?php echo $row['pharmacy_address']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">City</label>
								<input class="form-control mb-4" type="text" id="txtCity" name="txtCity" value="<?php echo $row['pharmacy_address']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Country *</label>
								<select class="form-control mb-4" type="text" id="cmbCountry" name="cmbCountry">
                                	<option value="1">United Kingdom</option>
                                </select>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Postcode *</label>
								<input class="form-control mb-4" type="text" id="txtPostcode" name="txtPostcode" value="<?php echo $row['pharmacy_postcode']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">GPhC Pharmacy Premise Number </label>
								<input class="form-control mb-4" type="text" id="txtGHPC" name="txtGHPC" value="<?php echo $row['pharmacy_p_gphc']?>" >
							</div>
                            
                            
                             <div class="form-group">
								<label class="form-label">Name of Superintendent Pharmacist </label>
								<input class="form-control mb-4" type="text" id="textSupPharma" name="textSupPharma" value="<?php echo $row['pharmacy_s_name']?>" >
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Name of Owner </label>
								<input class="form-control mb-4" type="text" id="txtOName" name="txtName" value="<?php echo $row['pharmacy_o_name']?>" >
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Email of Owner </label>
								<input class="form-control mb-4" type="email" id="txtOEmail" name="txtEmail" value="<?php echo $row['pharmacy_o_email']?>" readonly="readonly" >
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Mobile of Owner </label>
								<input class="form-control mb-4" type="text" id="txtPMobile" name="txtMobile" value="<?php echo $row['pharmacy_o_mobile']?>" >
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Pharmacy Logo Image</label>
								<div id="images4ex" orakuploader="on"></div>
							</div>
                            
                            <div style="height:20px"></div>
                            
                            <h4 style="text-transform:uppercase"><u>Primary Contact details</u></h4>
                            
                            <div class="form-group">
								<label class="form-label">Name</label>
								<input class="form-control mb-4" type="text" id="txtPrimaryName" name="txtPrimaryName" value="<?php echo $row['pharmacy_primary_name']?>" >
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Email</label>
								<input class="form-control mb-4" type="email" id="txtPrimaryEmail" name="txtPrimaryEmail" value="<?php echo $row['pharmacy_primary_email']?>" >
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Mobile</label>
								<input class="form-control mb-4" type="text" id="txtPrimaryMobile" name="txtPrimaryMobile" value="<?php echo $row['pharmacy_primary_phone']?>" >
							</div>
                            
                            <!-- <div class="form-group">
								<label class="form-label">Landline</label>
								<input class="form-control mb-4" type="text" id="txtLandline" name="txtLandline" value="<?php echo $row['pharmacy_o_landline']?>" >
							</div>-->
                             <div style="height:20px"></div>
                             <h4 style="text-transform:uppercase"><u>Contact Details for Patients</u></h4>
                            
                            <div class="form-group">
								<label class="form-label">Landline</label>
								<input class="form-control mb-4" type="text" id="txtLandline_for_pat" name="txtLandline_for_pat" value="<?php echo $row['pharmacy_p_landline']?>" >
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Email</label>
								<input class="form-control mb-4" type="email" id="txtEmail_for_pat" name="txtEmail_for_pat" value="<?php echo $row['pharmacy_p_email']?>" >
							</div>
                            
                             
                            
                             <div class="form-group">
								<label class="form-label">Opening Timings</label>
								
                                <div class="custom-controls-stacked">
                                
                                			<?php
											$arrWeek=array();
											$arrTimings=array();
											
											if ($row['pharmacy_p_opening']!="")
											$arrWeek=unserialize(fnUpdateHTML($row['pharmacy_p_opening']));
											
											if ($row['pharmacy_p_timings']!="")
											$arrTimings=unserialize(fnUpdateHTML($row['pharmacy_p_timings']));
											
											if ($row['pharmacy_p_timings_closing']!="")
											$arrTimings2=unserialize(fnUpdateHTML($row['pharmacy_p_timings_closing']));
											//print_r ($arrTimings2);
											
											 $mydays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday');
											
											$val=1;
											
											for ($j=0;$j<7;$j++)
											{
												
												
												
											 ?>
                                            
                                            
														<label class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" name="ckWeek[]" id="ck_<?php echo $val?>" onclick="openDiv(<?php echo $val?>)" value="<?php echo $val?>" <?php if (in_array($val,$arrWeek)) echo "checked"; ?> >
															<span class="custom-control-label"><?php echo $mydays[$j] ?></span>
                                                            
                                                           <div id="timings_<?php echo $val?>" <?php if (!in_array($val,$arrWeek)) echo 'style="display:none"'; ?>>
                                                            <div class="row" >
                                                            	<div class="col-md-6">
                                                                
                                                                <div class="row">
                                                                	<div class="col-md-4" style="padding-top:6px">
                                                                	Opening Time  
																		<?php 
																		$arrOt=array();
																		if ($arrTimings[$val]!="")
																		$arrOt=explode(":",$arrTimings[$val]);
																		 ?>
                                                                    </div>
                                                                
                                                            		<div class="col-md-4">
                                                                	<select class="form-control mb-4" id="cmb_o_<?php echo $val?>" name="cmbOpening_h[]">
                                                                    	<option value="">Hours</option>
                                                                        <?php for ($h=1;$h<=24;$h++) 
																		{
																			if (strlen($h)==1)
																			$prefix="0";
																			else
																			$prefix="";
																			
																			 ?>
                                                                        <option value="<?php echo $prefix.$h?>" <?php if ($arrOt[0]==$prefix.$h) echo "selected"; ?>><?php echo $prefix.$h?></option>
                                                                        <?php } ?>
																		
                                                                    </select></div>
                                                                    <div class="col-md-4">
                                                                    <select class="form-control mb-4" id="cmb_o_<?php echo $val?>" name="cmbOpening_m[]">
                                                                    	<option value="">Minutes</option>
                                                                        
                                                                         <?php for ($m=0;$m<=55;$m=$m+5) 
																		{
																			if (strlen($m)==1)
																			$prefix="0";
																			else
																			$prefix="";
																			
																			 ?>
                                                                        <option value="<?php echo $prefix.$m?>" <?php if ($arrOt[1]==$prefix.$m) echo "selected"; ?>><?php echo $prefix.$m?></option>
                                                                        <?php } ?>
                                                                        
                                                                    </select>
                                                                    </div>
                                                                 </div>
                                                                    
                                                                    
                                                                  </div>
                                                               </div>
                                                               
                                                               <div class="row">
                                                            	<div class="col-md-6">
                                                                
                                                                <div class="row">
                                                                	<div class="col-md-4" style="padding-top:6px">
                                                                	Closing Time
                                                                    </div>
                                                                
                                                            		<div class="col-md-4">
                                                                    
                                                                    <?php 
																		$arrOt2=array();
																		if ($arrTimings2[$val]!="")
																		$arrOt2=explode(":",$arrTimings2[$val]);
																		 ?>
                                                                    
                                                                    
                                                                	<select class="form-control mb-4" id="cmb_c_<?php echo $val?>" name="cmbClosing_h[]">
                                                                    	<option value="">Hours</option>
                                                                        
                                                                         <?php for ($h=1;$h<=24;$h++) 
																		{
																			if (strlen($h)==1)
																			$prefix="0";
																			else
																			$prefix="";
																			
																			 ?>
                                                                        <option value="<?php echo $prefix.$h?>" <?php if ($arrOt2[0]==$prefix.$h) echo "selected"; ?>><?php echo $prefix.$h?></option>
                                                                        <?php } ?>
                                                                        
                                                                    </select></div>
                                                                    <div class="col-md-4">
                                                                    <select class="form-control mb-4" id="cmb_c_<?php echo $val?>" name="cmbClosing_m[]">
                                                                    	<option value="">Minutes</option>
                                                                        
                                                                          <?php for ($m=0;$m<=55;$m=$m+5) 
																		{
																			if (strlen($m)==1)
																			$prefix="0";
																			else
																			$prefix="";
																			
																			 ?>
                                                                        <option value="<?php echo $prefix.$m?>" <?php if ($arrOt2[1]==$prefix.$m) echo "selected"; ?>><?php echo $prefix.$m?></option>
                                                                        <?php } ?>
                                                                        
                                                                        
                                                                    </select>
                                                                    </div>
                                                                 </div>
                                                                    
                                                                    
                                                                  </div>
                                                               </div>
                                                              
                                                              </div> 
                                                                <div class="col-md-2">
                                                            </div>
                                                            
														</label>
                                                        
                                                  <?php 
												  $val=$val+1;
												  } ?>      
                                                        
														
														
													</div>
                                
                                
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Bank Holiday Opening Description</label>
								<textarea name="txtBankTimings" class="form-control"><?php echo $row['pharmacy_bank_opening']?></textarea> 
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Notes for Admin</label>
								<textarea name="txtNotes" class="form-control"><?php echo $row['pharmacy_notes']?></textarea> 
							</div>
                            
                            <div style="height:20px"></div>
                             <h4 style="text-transform:uppercase"><u>Contact Details for Patients</u></h4>
                            
                            <div class="form-group">
								<label class="form-label">Landline</label>
								<input class="form-control mb-4" type="text" id="txtLandline_for_pat" name="txtLandline_for_pat" value="<?php echo $row['pharmacy_p_landline']?>" >
							</div>
                            
         					 <div style="height:20px"></div>
                             <h4 style="text-transform:uppercase"><u>Profile page updates</u></h4>
                            
                            <div class="form-group">
								<label class="form-label">About us</label>
								<textarea name="txtAboutus" class="form-control"><?php echo $row['pharmacy_about_us']?></textarea>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Website Link</label>
								<input class="form-control mb-4" type="text" id="txtWebsite" name="txtWebsite" value="<?php echo $row['pharmacy_website']?>" >
							</div>
                            
                          
						
					<div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

<input type="hidden" name="pId" value="<?php echo $row['pharmacy_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['sess_pharmacy_groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>					
								</div>
                                
                                
                                
                                
                                
                                
											
                                           
										</div>
                                     

				<input type="hidden" name="c" value="<?php echo $component?>" />
                
               

			</form>  
                                        
                                        
									</div>
									
									
									
									
								</div>
							
                        
	<?php if ($row['pharmacy_logo']!="")
		  $pImageStr="'".$row['pharmacy_logo']."'";		 
	?>

 <script language="javascript">
 
 function openDiv(id)
 {
	 
	if ($("#ck_"+id).prop('checked')== true)
	$("#timings_"+id).show();
	else
	$("#timings_"+id).hide();

	 
 }
 
 
$(document).ready(function(){
	$('#images4ex').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../../images/pharmacies/',
		orakuploader_thumbnail_path : '../../images/pharmacies/',
		
		orakuploader_use_main : true,
		orakuploader_use_sortable : true,
		orakuploader_use_dragndrop : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 800,
		orakuploader_thumbnail_size  : 400,
		orakuploader_maximum_uploads : 1,
		orakuploader_attach_images: [<?php echo $pImageStr?>],
		
		orakuploader_main_changed    : function (filename) {
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
		}

	});
});
</script>	

                        
                        <?php } else { ?>
                        
                        <div class="row">
		<div class="col-lg-12 col-md-12">
        
        <div class="">
					<div class="container">
                    
                    
                  

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
                        
                        
                        <div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list" style="padding-bottom:20px; padding-right:20px">
                                    
                                    
                                    <a href="?c=<?php echo $_GET['c']?>&mode=edit" class="btn btn-primary">Edit Profile</a>
									
										
									</div>
                                    
								</div>
							</div>
                           
							
							<div class="col-xl-12 col-md-12 col-lg-12">
								
                                
                                
                                
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										
										<div class="tab-pane active" id="tab6">
											<div class="card-body">
												<div class="table-responsive">
                                                
                                               <div class="table-responsive">
                                              
                                              <p style="font-size:18px; font-weight:bold">Basic Details
                                              </p> 
                                              
                                            
                                            
                                            
                                             
                                             
											<table class="table">
												<tbody>
                                                
                                                <?php 
												if (is_array($medication))
												foreach($medication as $que => $val) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
														<td>
															<?php echo base64_decode($que) ?> :
														</td>
														
														<td width="40%" style="color:#03C">
                                                        
                                                        <?php echo base64_decode($val) ?>
															
														</td>
													</tr>
                                                    
                                            <?php } ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                             
                                            	<div class="table-responsive">
											<table class="table" width="100%">
												<tbody>
                                                <tr><td colspan="2">
                                                
                                                <?php if ($row['pharmacy_logo']!="") { ?>
										
												<img src="<?php echo URL; ?>classes/timthumb.php?src=<?php echo URL ?>images/pharmacies/<?php echo $row['pharmacy_logo']; ?>&w=200&zc=1">
                                                <?php } ?>
                                                </td></tr>
													<tr>
														<td width="22%">
															<span class="w-50">Pharmacy ID</span>
														</td>
														<td width="1%">:</td>
														<td width="77%">
															<span class="font-weight-semibold"><?php echo $row['pharmacy_id'] ?></span>
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Pharmacy Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $row['pharmacy_name'];
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    <tr>
														<td>
															<span class="w-50">Pharmacy Address 1</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $row['pharmacy_address'];
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Pharmacy Address 2</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $row['pharmacy_address2'];
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    <tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">City</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $row['pharmacy_city'];
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Postcode</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $row['pharmacy_postcode'];
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Pharmacy Landline</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $row['pharmacy_p_landline'];
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Pharmacy Email</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $row['pharmacy_p_email'];
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    <tr>
														<td>
															<span class="w-50">Primary Contact Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $row['pharmacy_o_name'];
															
															?>
                                                            </span>
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Primary Contact Email</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pharmacy_o_email']; ?></span>
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Primary Contact Mobile </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pharmacy_o_mobile']; ?></span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span class="w-50">GPhC Pharmacy Premise Number</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pharmacy_p_gphc']; ?> </span>
														</td>
													</tr>
                                                    
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Name of Superintendent Pharmacist</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pharmacy_s_name']; ?> </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Name of Owner</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pharmacy_o_name']; ?> </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Email of Owner </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pharmacy_o_email']; ?> </span>
														</td>
													</tr>
                                                    
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Mobile of Owner</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pharmacy_o_mobile']; ?> </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td style="vertical-align:top !important">
															<span class="w-50">Opening Hours</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
                                                            
                                                            
                                                            
                                                            <?php
															$arrWeek=array();
															$arrTimings=array();
											
															if ($row['pharmacy_p_opening']!="")
															$arrWeek=unserialize(fnUpdateHTML($row['pharmacy_p_opening']));
															
															
															
															if ($row['pharmacy_p_timings']!="")
															$arrTimings=unserialize(fnUpdateHTML($row['pharmacy_p_timings']));
															//print_r ($arrTimings);
															
															if ($row['pharmacy_p_timings_closing']!="")
															$arrTimings2=unserialize(fnUpdateHTML($row['pharmacy_p_timings_closing']));
															//print_r ($arrTimings2);
															
															
															$mydays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday');
															
															foreach ($arrWeek as $val)
															{
																echo $mydays[$val-1];
																echo ": ";
																//echo $arrTimings[$val];
																
																echo date('h:i a', strtotime($arrTimings[$val]));
																echo " - ";
																echo date('h:i a', strtotime($arrTimings2[$val]));
																echo "<br><br>";
																
																
															}
															
															?>
                                                            
                                                             </span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Bank Holiday details</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pharmacy_bank_holiday']; ?> </span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Profile About us Content</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo fnUpdateHTML($row['pharmacy_about_us']); ?> </span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Website</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pharmacy_website']; ?> </span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Pharmacy Notes</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pharmacy_notes']; ?> </span>
														</td>
													</tr>
                                                    
                                                    
                                                   <!-- <tr>
														<td>
															<span class="w-50">Registered Date</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if ($row['pharmacy_reg_date']!="0000-00-00 00:00:00") echo displayDateTimeFormat($row['pharmacy_reg_date']); ?> </span>
														</td>
													</tr>-->
													
													
													
                                                    
												</tbody>
											</table>
										</div>
                                            
										</div>
													
													
												</div>
											</div>
										</div>
										
										
										
										
										
									</div>
								</div>
							</div>
						</div>
						<!-- End Row-->

					</div><!-- end app-content-->
				</div>
		</div>
</div>
                        
                        <?php } ?>
	
			<!-- End Row -->
            
           <script language="javascript">

$("#adminForm").validate({
			rules: {
				txtPharmacyName: "required",
				txtAddress: "required",
				txtPostcode: "required"
			},
			messages: {
				txtPharmacyName: "Please enter pharmacy name",
				txtAddress: "Please enter pharmacy address",
				txtPostcode: "Please enter pharmacy postcode"
				
				}			
		});

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
  