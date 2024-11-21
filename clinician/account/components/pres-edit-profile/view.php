		

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

		?>	
		



<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title">My Profile</h4>
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
									<!--<div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                                    
                                   <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=saveedit" method="post" class="form-horizontal" enctype="multipart/form-data">
                                   
                                   <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Employee Number </h3>
									</div>
									<div class="card-body pb-2">
										<div class="row row-sm">
											<div class="col-lg-8">
												<input class="form-control mb-4" placeholder="Enter Employee Number" name="txtEmpNumber" value="<?php echo $row['pres_emp_number'] ?>" id="txtEmpNumber" type="text" readonly="readonly">
											</div>
											
									</div>
		</div>
                                
                                </div>
                                
                                
                                <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Personal Details</h3>
									</div>
   
   <div class="card-body pb-2">
						
					
                     
                    
                    
					
                            
                           <div class="form-group">
								
							</div>
                            
                            <div class="row">
                            
                            
                            				<div class="col-sm-2 col-md-2">
												<div class="form-group">
													<label class="form-label">Title <span class="text-red">*</span></label>
					<select class="form-control" name="cmbTitle" id="cmbTitle"  >
										<option label="Select Title"></option>
										<?php
				$query = "SELECT * FROM tbl_titles where title_status=1";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {

									?>

								<option value="<?php echo $value['title_id']; ?>"  <?php if($row['pres_title'] == $value['title_id']) {	echo 'selected="selected"';}?>  ><?php echo $value['title_name']; ?></option>

							<?php	

							}

							?> 

									
									</select>
												</div>
											</div>
											<div class="col-sm-3 col-md-3">
												<div class="form-group">
													<label class="form-label">Forename/s <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="First name" value="<?php echo $row['pres_forename'] ?>" name="txtForename">
												</div>
											</div>
											<div class="col-sm-3 col-md-3">
												<div class="form-group">
													<label class="form-label">Surname <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="Last name" value="<?php echo $row['pres_surname'] ?>" name="txtSurname">
												</div>
											</div>
										<div class="col-sm-4 col-md-4">
												<div class="form-group">
													<label class="form-label">Profession <span class="text-red">*</span></label>
					<select class="form-control" name="cmbProf" id="cmbProf"  >
										<option label="Select"></option>
										<?php
				$query = "SELECT * FROM tbl_professions where prof_status=1";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {

									?>

								<option value="<?php echo $value['prof_id']; ?>"  <?php if($row['pres_profession'] == $value['prof_id']) {	echo 'selected="selected"';}?>  ><?php echo $value['prof_title']; ?></option>

							<?php	

							}

							?> 

									
									</select>
												</div>
											</div>
										</div>
                            
                            
                            <div class="row">
                            
                            				
                                          </div>
                                          
                                          <div class="row">
                            				
											<div class="col-sm-12 col-md-5">
												<div class="form-group">
													<label class="form-label">Address <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="" value="<?php echo $row['pres_address1'] ?>" name="txtAddress">
												</div>
											</div>
											<div class="col-sm-12 col-md-7">
												<div class="form-group">
													<label class="form-label">Address 2</label>
													<input type="text" class="form-control" placeholder="" name="txtAddress2" value="<?php echo $row['pres_address2'] ?>">
												</div>
											</div>
										
										</div>
                            
                           
                            <div class="row">
                            
                            
                            				
											<div class="col-sm-6 col-md-2">
												<div class="form-group">
													<label class="form-label">City <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="" name="txtCity" value="<?php echo $row['pres_city'] ?>">
												</div>
											</div>
											<div class="col-sm-6 col-md-2">
												<div class="form-group">
												  <label class="form-label">Country <span class="text-red">*</span></label>
													<select class="form-control custom-select select2" name="cmbCountry" id="cmbCountry" required >
														<option value="">Select Country</option>
                                                        <option value="1" selected="selected">United Kingdom</option>
                                                    </select>
                                        
												</div>
											</div>
                                            
                                            <div class="col-sm-6 col-md-2">
												<div class="form-group">
												  <label class="form-label">Postcode <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="" name="txtPostcode" id="txtPostcode" value="<?php echo $row['pres_postcode'] ?>" maxlength="7" data-validation="required" data-validation-error-msg="Please enter postcode">
                                        
												</div>
											</div>
                                            
                                            
                                            
                                            
										
										</div>
                            
                            <?php $dob=$row['pres_dob']; 
							
							$arrDob=explode("-",$dob);
							
							?>
                            
                            <div class="form-group">
								<label class="form-label">Date of Birth *</label>
                                
                                <div class="row">
									<div class="col-lg-2 col-md-2">
									<select class="form-control custom-select select2" name="cmbDate" id="cmbDate">
										<option value="">Select Date</option>
                                       <?php for ($k=1;$k<=31;$k++) 
									   {
										   if ($k<10)
										   $prefix="0";
										   else
										   $prefix="";
										   ?>
                                        <option value="<?php echo $prefix.$k; ?>" <?php if ($arrDob[2]==$prefix.$k) echo "selected"; ?>><?php echo $prefix.$k; ?></option>				
                                       <?php } ?>
									</select>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
									<select class="form-control custom-select select2" name="cmbMonth" id="cmbMonth"  >
										<option value="">Select Month</option>
                                       
										<?php for ($r = 1; $r <= 12; $r++){
                                            $month_name = date('F', mktime(0, 0, 0, $r, 1, date("Y")));
                                            ?> <option value="<?php echo $r ?>" <?php if ($arrDob[1]==$r) echo "selected"; ?>><?php echo $month_name ?></option> <?php 
                                        }?>				
									</select>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
									<select class="form-control custom-select select2" name="cmbYear" id="cmbYear"  >
										<option value="">Select Year</option>
                                        <?php
										$year=date("Y");
										 for ($y=$year-18;$y>=$year-118;$y--) { ?>
                                        <option value="<?php echo $y; ?>" <?php if ($arrDob[0]==$y) echo "selected"; ?>><?php echo $y; ?></option>				
                                        <?php } ?>
									</select>
                                    </div>
                                </div>
							</div>
                            
                            
                           <div style="height:20px"></div>   
                            
                        
                    
                    
                    
                            
                         
				
						
							
								</div>
</div>



<div class="card">
                                        <div class="card-header border-bottom-0">
                                            <h3 class="card-title">Professional Details</h3>
                                        </div>
									<div class="card-body pb-2">
                                    
                                   
                                           <div class="row">
                                            <div class="col-lg-6 col-md-6">  
                                            
                                                <div class="form-group">
                                                    <label class="form-label">National Insurance Number</label>
                                                    <input class="form-control mb-4" type="text" id="txtNIN" name="txtNIN" value="<?php echo $row['pres_insurance_number']?>">
                                                </div>                                            
                                             </div>                                        
                                            </div>
                                            
                                            <div style="height:20px"></div>
                                            
                                            <div class="row">
                                            <div class="col-lg-6 col-md-6">  
                                                <div class="form-group ">
                                                <div class="form-label">Eligibility to work in the UK</div>
                                                <div class="custom-controls-stacked">
                                                    <label class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" name="rdoWorkUk" id="rdoWorkUk" value="1" <?php if($row['pres_work_permit']==1 && $row['pres_id']!='') echo 'checked="checked"'; ?> >
                                                        <span class="custom-control-label">Yes</span>
                                                    </label>
                                                    <label class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" name="rdoWorkUk" id="rdoWorkUk" value="0" <?php if($row['pres_work_permit']==0 && $row['pres_id']!='') echo 'checked="checked"'; ?>  >
                                                        <span class="custom-control-label">No</span>
                                                    </label>
                                            
                                               	 </div>
                                           		 </div>
                                              </div>
                                             </div>  
                                             
                                              <div style="height:20px"></div> 
                                                 
                                               <div class="form-group">
                     
                          <div class="row">
                                <div class="col-lg-6 col-md-6">
                         
                         
                                    <label class="form-label">Photo ID (Upload Passport or Driving License)</label>
                                    <input class="form-control" type="file" id="flPhotoId" name="flPhotoId" >
                                    
                                     <?php if ($row['pres_photo_id']!="") { ?>
                                    <div style="height:5px"></div>
                                    <span class="font-weight-semibold"><?php if ($row['pres_photo_id']!="") { ?> <i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_photo_id']?>" style="color:#69C; text-decoration:underline" download> Uploaded Photo ID</a><?php } ?></span>
                                    <?php } ?>
                                    
                                </div>
                           </div>
                            
                            
					</div>
                    
                     <div style="height:20px"></div>
                    
                    <div class="form-group">
                    
                        		 <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                    <label class="form-label">Upload Address Proof 1</label>
                                    <input class="form-control" type="file" id="flProof1" name="flProof1" >
                                    
                                    <?php if ($row['pres_proof_address1']!="") { ?>
                                    <div style="height:5px"></div>
                                    <span class="font-weight-semibold"><i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> <?php if ($row['pres_proof_address1']!="") { ?> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_proof_address1']?>" style="color:#69C; text-decoration:underline" download>Uploaded Address Proof 1</a><?php } ?></span>
                                    <?php } ?>
                                    
                                    </div>
                          		 </div>
                      
                      
					</div>
                    
                     <div style="height:20px"></div>
                    
                     <div class="form-group">
                     
                     			<div class="row">
                                    <div class="col-lg-6 col-md-6">
								<label class="form-label">Upload Address Proof 2</label>
								<input class="form-control" type="file" id="flProof2" name="flProof2" >
                                
                                <?php if ($row['pres_proof_address2']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_proof_address2']!="") { ?> <i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_proof_address2']?>" style="color:#69C; text-decoration:underline" download>Uploaded Address Proof 2</a><?php } ?></span>
                                <?php } ?>
                                </div>
                               </div>
					</div>
                    
                    		 <div style="height:20px"></div>
                            
                            
                             <div class="form-group">
                             
                             <div class="row">
                                    <div class="col-lg-6 col-md-6">
								<label class="form-label">Upload DBS Certificate</label>
								<input class="form-control" type="file" id="flDBS" name="flDBS" >
                                
                                
                                 <?php if ($row['pres_dbs']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_dbs']!="") { ?> <i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_dbs']?>" style="color:#69C; text-decoration:underline" download>Uploaded DBS Certificate</a><?php } ?></span>
                                <?php } ?>
                               			</div>
                                </div>
                                
							</div>
                            
                             <div style="height:20px"></div>
                            
                             <div class="form-group">
                             
                             <div class="row">
                                    <div class="col-lg-6 col-md-6">
								<label class="form-label">Upload CV</label>
								<input class="form-control" type="file" id="flCV" name="flCV" >
                                
                                
                                 <?php if ($row['pres_cv']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_cv']!="") { ?> <i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_cv']?>" style="color:#69C; text-decoration:underline" download>Uploaded CV</a><?php } ?></span>
                                <?php } ?>
                                </div>
                              </div>
                                
							</div>
                            
                             <div style="height:20px"></div>
                            
                      <div class="form-group ">
						<div class="form-label">Regulatory body</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" onChange="showRegNo(1)" id="rdoRegBody" value="1" <?php if($row['pres_regulatory_body']==1 && $row['pres_id']!='') echo 'checked="checked"'; ?> >
								<span class="custom-control-label">GPhC</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" onChange="showRegNo(2)" id="rdoRegBody" value="2" <?php if($row['pres_regulatory_body']==2 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">GMC </span>
							</label>
                            <label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" onChange="showRegNo(3)" id="rdoRegBody" value="3" <?php if($row['pres_regulatory_body']==3 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">NMC </span>
							</label>
                             <label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" onChange="showRegNo(4)" id="rdoRegBody" value="4" <?php if($row['pres_regulatory_body']==4 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Not Applicable </span>
							</label>
                            
                            
                            	
					
						</div>
					</div> 
                    
                     <div style="height:20px"></div>
                    
                    <div class="form-group ">
                    <div class="form-label">Registration Numbers</div>
                                            
											<div class="col-sm-4 col-md-4" <?php if($row['pres_regulatory_body']!=1) { ?>style="display:none" <?php } ?> id="regGphc">
												<div class="form-group">
													<label class="form-label">GPhC </label>
													<input type="text" class="form-control" placeholder="" value="<?php echo $row['pres_gphc_reg_number']; ?>" name="txtGPHCReg" data-validation="required" data-validation-error-msg="Please enter GPhC registration number" maxlength="30">
												</div>
											</div>
											<div class="col-sm-4 col-md-4" <?php if($row['pres_regulatory_body']!=2) { ?>style="display:none" <?php } ?> id="regGmc">
												<div class="form-group">
													<label class="form-label">GMC </label>
													<input type="text" class="form-control" placeholder="" value="<?php echo $row['pres_gmc_reg_number']; ?>" name="txtGMCReg" data-validation="required" data-validation-error-msg="Please enter GMC registration number" maxlength="30">
												</div>
											</div>
                                            
                                            <div class="col-sm-4 col-md-4" <?php if($row['pres_regulatory_body']!=3) { ?>style="display:none" <?php } ?> id="regNmc">
												<div class="form-group">
													<label class="form-label">NMC </label>
													<input type="text" class="form-control" placeholder="" value="<?php echo $row['pres_nmc_reg_number']; ?>" name="txtNMCReg" data-validation="required" data-validation-error-msg="Please enter NMC registration number" maxlength="30">
												</div>
											</div>
										
										</div>  
                                        
                      <div style="height:20px"></div>
                     
                     
                  			 <div class="form-group">
                             
                                 <div class="col-sm-6 col-md-6">
                                 
                                     <div  style="padding-top:10px; margin-top:10px; border:1px solid #CCC; padding-bottom:10px; padding-left:20px; ">
                                    <label class="form-label">Upload Professional Regulatory Body certificate</label>
                                        <input class="form-control" type="file" id="flRegBody" name="flRegBody" >
                                    </div>
                                    
                                     <?php if ($row['pres_regulatory_cert']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_regulatory_cert']!="") { ?> <i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_regulatory_cert']?>" style="color:#69C; text-decoration:underline" download>Regulatory Body Certificate</a><?php } ?></span>
                                <?php } ?>
                                  </div>
                             
                             
                             </div>
                       
                      
                                        
                                        
                                        
                     <div style="height:20px"></div>
                     
                    <div class="form-group ">
                    
                    
						<div class="form-label">Prescribing qualification certificate</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoQC" id="rdoQC" value="1" <?php if($row['pres_qualification_check']==1 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoQC" id="rdoQC" value="0" <?php if($row['pres_qualification_check']==0 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
                            
                           
                            
                            							 <?php 
														 $arrUnSerMes=array();
														 if ($row['pres_qualification_cert']!="") 
														 		{
																$arrUnSerMes=unserialize(fnUpdateHTML($row['pres_qualification_cert']));
																
																}
																
																  ?>
                                                        		
															<span class="font-weight-semibold"><span class="font-weight-semibold">
															
															 <?php for ($j=0;$j<@count($arrUnSerMes);$j++) {
																		
																		
															$fileExtension = pathinfo($arrUnSerMes[$j], PATHINFO_EXTENSION);
															
															// Check if the file extension is PDF
															if (strtolower($fileExtension) === 'pdf') {
																// The file is a PDF
																$type="pdf";
															} elseif (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) {
																// The file is an image
																$type="image";
															} 
																		
																		 ?>
                                                                        <div class="col-lg-4 col-md-3" >
                                                                            <a  href="<?php echo URL?>clinician/documents/<?php echo $arrUnSerMes[$j]; ?>" download class="">
                                                                                
                                                                                <?php if ($type=="image") { ?>
                                                                                
                                                                                <span style="color:#69C; text-decoration:underline"><i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> Uploaded Certificate <?php echo $j+1?></span>
                                                                                <?php } else { ?>
                                                                                
                                                                                <span style="color:#69C; text-decoration:underline"><i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> Uploaded Certificate <?php echo $j+1?></span>
                                                                                <?php } ?>
                                                                                
                                                                            </a>
                                                                        </div>
                                                                        <br />
                                                                      <?php } ?>
                                                                      
                          
                                                                      
                                                                      
                           <div class="row">
                                    <div class="col-lg-6 col-md-6">  
                           <div >
                           
                          
                           			<input type="hidden" name="hdExistingCert" value="<?php echo $row['pres_qualification_cert']?>" />
                                    
                                    <input type="hidden" name="hdExistingCPD" value="<?php echo $row['pres_cpd_cert']?>" />
                            		<input class="form-control" type="file" id="flCert" accept=".pdf,.jpg,.png" name="flCert[]">
                               
                                 </div>
                                 
                                 
                                 <div id="cont_addmore_1"></div>
                                 <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onclick="addMoreFile(1)">+ Add More Qualification Certificate</a></div>
                           </div></div>                                           
					
						</div>
					</div> 
                    
                    		 <div style="height:20px"></div>
                           <div class="row">
                               <div class="col-lg-6 col-md-6"> 
								<label class="form-label">Upload CPD Certificates</label>
								<input class="form-control" type="file" id="flCPD" name="flCPD[]" accept=".pdf,.jpg,.png" >
                                
                      
                                 
                             
                             
                             
                            				  <?php 
											  $arrUnSerMes=array();
											  if ($row['pres_cpd_cert']!="") 
														 		{
																$arrUnSerMes=unserialize(fnUpdateHTML($row['pres_cpd_cert']));
																
																}
																
																  ?>
                                                        		
															<span class="font-weight-semibold"><span class="font-weight-semibold">
															
															 <?php for ($j=0;$j<count($arrUnSerMes);$j++) {
																		
																		
															$fileExtension = pathinfo($arrUnSerMes[$j], PATHINFO_EXTENSION);
															
															// Check if the file extension is PDF
															if (strtolower($fileExtension) === 'pdf') {
																// The file is a PDF
																$type="pdf";
															} elseif (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) {
																// The file is an image
																$type="image";
															} 
																		
																		 ?>
                                                                        <div class="col-lg-6 col-md-6" >
                                                                            <a  href="<?php echo URL?>clinician/documents/<?php echo $arrUnSerMes[$j]; ?>" download class="">
                                                                                <div style="height:10px"></div>
                                                                                <?php if ($type=="image") { ?>
                                                                                
                                                                                <span style="color:#69C; text-decoration:underline"><i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> Uploaded Certificate <?php echo $j+1?></span>
                                                                                <div style="height:15px"></div>
                                                                                <?php } else { ?>
                                                                                
                                                                                <span style="color:#69C; text-decoration:underline"><i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> Uploaded Certificate <?php echo $j+1?></span>
                                                                                <div style="height:15px"></div>
                                                                                <?php } ?>
                                                                                
                                                                            </a>
                                                                        </div>
                                                                        
                                                                      <?php } ?>
                                 
                                 
                                  <div id="cpd_addmore_2"></div>
                                             <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onclick="addMoreFile(2)" style="font-weight:500">+ Add More CPD Certificate</a></div>
                                 
                                 </div>
                                         
                          </div> 
                            
                            <div style="height:20px"></div>  
                            
                            <div class="form-group ">
						<div class="form-label">Indeminity cover Check (if applicable)</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoInd" id="rdoInd" value="1" onChange="showInd()" <?php if($row['pres_indemnity']==1 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoInd" id="rdoInd" value="2" onChange="showInd()" <?php if($row['pres_indemnity']==2 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
                            
                           
                            	
					
						</div>
					</div>
                     <div style="height:20px"></div>
                     
                     <div id="cont_ind">
                    <div class="form-group ">
						<div class="form-label">Upload Certificate</div>
						<div class="custom-controls-stacked">
							
                           <input class="" type="file" id="flIndCert" name="flIndCert" >
                           <br /> <br />
                           <div class="form-label">Expiry Date of Indeminity Cover Check</div>
                           <input type="date" class="form-control col-md-3"  name="txtExpDate" value="<?php echo $row['pres_expiry_date'] ?>" />
                            
                              <?php if ($row['pres_indemnity_doc']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_indemnity_doc']!="") { ?> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_indemnity_doc']?>" style="color:#69C; text-decoration:underline" download>View Uploaded file</a><?php } ?></span>
                                <?php } ?>
					
						</div>
                        
                        <div style="height:20px"></div>
					</div>   
                                        
                      </div>                  
                                	 </div>
							</div>
                            
                            <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Reference Check 1</h3>
									</div>
									<div class="card-body pb-2">
                                    
										<div class="form-group">
											<div class="col-lg-6">
                                            	<label class="form-label">Name</label>
												<input type="text" class="form-control" placeholder="Name" value="<?php echo $row['pres_rf1_name']?>" name="rf1_name" >
											</div>											
										</div>
                                        
                                        <div class="form-group">
											<div class="col-lg-6">
                                            	<label class="form-label">Job Title</label>
												<input type="text" class="form-control" placeholder="Job title" value="<?php echo $row['pres_rf1_job_title']?>" name="rf1_job_title" >
											</div>											
										</div>
                                        
                                        <div class="form-group">
											<div class="col-lg-6">
                                            	<label class="form-label">Organisation</label>
												<input type="text" class="form-control" placeholder="Organisation" value="<?php echo $row['pres_rf1_org']?>" name="rf1_org" >
											</div>											
										</div>
                                        
                                        <div class="form-group">
											<div class="col-lg-6">
                                            	<label class="form-label">Email Address</label>
												<input type="text" class="form-control" placeholder="Email Address" value="<?php echo $row['pres_rf1_email']?>" name="rf1_email" >
											</div>											
										</div>
                                        <div style="height:20px"></div>
                                        
                                       
		</div>
                                
                                </div>
                                
                                <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Reference Check 2</h3>
									</div>
									<div class="card-body pb-2">
                                    
										<div class="form-group">
											<div class="col-lg-6">
                                            	<label class="form-label">Name</label>
												<input type="text" class="form-control" placeholder="Name" value="<?php echo $row['pres_rf2_name']?>" name="rf2_name" >
											</div>											
										</div>
                                        
                                        <div class="form-group">
											<div class="col-lg-6">
                                            	<label class="form-label">Job Title</label>
												<input type="text" class="form-control" placeholder="Job title" value="<?php echo $row['pres_rf2_job_title']?>" name="rf2_job_title" >
											</div>											
										</div>
                                        
                                        <div class="form-group">
											<div class="col-lg-6">
                                            	<label class="form-label">Organisation</label>
												<input type="text" class="form-control" placeholder="Organisation" value="<?php echo $row['pres_rf2_org']?>" name="rf2_org" >
											</div>											
										</div>
                                        
                                        <div class="form-group">
											<div class="col-lg-6">
                                            	<label class="form-label">Email Address</label>
												<input type="text" class="form-control" placeholder="Email Address" value="<?php echo $row['pres_rf2_email']?>" name="rf2_email" >
											</div>											
										</div>
                                        
                                       
		</div>
        
        <div style="height:20px"></div>
                                
                                </div>
                                
                                <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Contact Details</h3>
									</div>
									<div class="card-body pb-2">
                                    
										<div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Home Telephone</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $row['pres_home_phone']?>" name="txtHomeTelephone">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Mobile Telephone</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $row['pres_mobile']?>" name="txtMobile">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Email Address</label>
												<input class="form-control mb-4" placeholder="" type="email" value="<?php echo $row['pres_email']?>" name="txtEmail">
											</div>											
										</div>
                                        
                                       
		</div>
                                
                                </div>
                                
                                <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Job Information</h3>
									</div>
									<div class="card-body pb-2">
                                    
										<div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Employment Status</label>
												<input class="form-control mb-4" name="txtEmpStatus" placeholder="PAYE/Umbrella/Self Employed/Limited Company" type="text" value="<?php echo $row['pres_employment_status'] ?>">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">If limited company, IR35 Status:</label>
												<input class="form-control mb-4" name="txtIR35" placeholder="" type="text" value="<?php echo $row['pres_ir35'] ?>">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">If limited company, please provide company name number:</label>
												<input class="form-control mb-4" name="txtCompanyName" placeholder="" type="text" value="<?php echo $row['pres_ltd_company'] ?>">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">If Self Employed, UTR Number</label>
												<input class="form-control mb-4" name="txtUTR" placeholder="" value="<?php echo $row['pres_utr'] ?>" type="text">
											</div>											
										</div>
                                        
                                        <div class="form-group ">
						<div class="form-label">Work Location</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoWorkLocation" id="rdoWorkLocation" value="Office" <?php if($row['pres_work_location']=="Office" ) echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Office</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoWorkLocation" id="rdoWorkLocation" value="Remote" <?php if($row['pres_work_location']=="Remote" ) echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Remote</span>
							</label>
                            
                            If working remote, please confirm you are located within the UK and will undertake all the work while in the UK (YES/NO) &nbsp;&nbsp;
                            	
                            
                          <div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRemote" id="rdoRemote" value="1" <?php if($row['pres_work_in_uk']==1 && $row['page_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRemote" id="rdoRemote" value="0" <?php if($row['pres_work_in_uk']==0 && $row['page_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
                          </div>
					
						</div>
					</div>
		</div>
                                
                                </div>
                                
                                <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Emergency Contact</h3>
									</div>
									<div class="card-body pb-2">
                                    
										<div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Forename/s</label>
												<input class="form-control mb-4" placeholder="" type="text" name="txt_e_Forename" value="<?php echo $row['pres_e_name'] ?>">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Surname</label>
												<input class="form-control mb-4" placeholder="" type="text" name="txt_e_Surname" value="<?php echo $row['pres_e_surname'] ?>">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Home Telephone</label>
												<input class="form-control mb-4" placeholder="" type="text" name="txt_e_Telephone" value="<?php echo $row['pres_e_phone'] ?>">
											</div>											
										</div>
                                        
                                         <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Mobile Telephone</label>
												<input class="form-control mb-4" placeholder="" type="text" name="txt_e_Mobile" value="<?php echo $row['pres_e_mobile'] ?>">
											</div>											
										</div>
                                        
                                         <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Address</label>
												<input class="form-control mb-4" placeholder="" type="text" name="txt_e_Address" value="<?php echo $row['pres_e_address'] ?>">
											</div>											
										</div>
                                        
                                        
                                         <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Address 2</label>
												<input class="form-control mb-4" placeholder="" type="text" name="txt_e_Address2" value="<?php echo $row['pres_e_address2'] ?>">
											</div>											
										</div>
                                        
                                          <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">City</label>
												<input class="form-control mb-4" placeholder="" type="text" name="txt_e_city" value="<?php echo $row['pres_e_city'] ?>">
											</div>											
										</div>
                                        
                                         <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Country</label>
												<select class="form-control custom-select select2" name="cmb_e_Country" id="cmb_e_Country" data-validation="required" data-validation-error-msg="Please select emergency country" >
														<option value="">Select Country</option>
                                                        <option value="1" selected="selected">United Kingdom</option>
                                                    </select>
											</div>											
										</div>
                                        
                                         <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Postcode</label>
												<input class="form-control mb-4" placeholder="" type="text" name="txt_e_Postcode" value="<?php echo $row['pres_e_postcode'] ?>">
											</div>											
										</div>
                                        
                                        <div class="card-footer">
												<button type="submit" class="btn btn-primary">Save Changes</button>
												
											</div>
                                        
                                       
					</div>
                                       
		</div>
                                
                                
                                
                                   </form>  
                                        
                                        
									</div>-->
									<div class="tab-pane fade show active" id="tab-2" role="tabpanel">
                                    
                                    <form action="" method="post" id="frmChange" >
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
								
													 //alert (msg);
													 
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
									
								</div>
							</div>
						</div>
                        
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
									<div class="btn-list">
                                    
                                    
                                    <a href="?c=<?php echo $_GET['c']?>&mode=edit" class="btn btn-primary">Change Password</a>
									
                                    <div style="height:20px"></div>
										
									</div>
								</div>
							</div>
							
							<div class="col-xl-12 col-md-12 col-lg-12">
								<!--<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										
										<ul class="nav panel-tabs">
                                        <li><a href="#tab6" data-toggle="tab"  class="active" >Basic Details</a></li>
											<li ><a href="#tab5" data-toggle="tab">Medical Background</a></li>
											
											
										</ul>
									</div>
								</div>-->
                                
                                
                                
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane" id="tab5">
											<div class="card-body">
												<div class="table-responsive">
										No data found!
									</div>
											</div>
										</div>
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
													<tr><td colspan="3"><h5><u>Personal Details</u></h5></td></tr>
                                                    
                                                    <tr>
														<td width="26%">
															<span class="w-50">Employee Number</span>
														</td>
														<td width="1%">:</td>
														<td width="73%">
															<span class="font-weight-semibold"><?php echo $row['pres_emp_number'] ?>
                                                            
                                                            </span>
														</td>
													</tr>
                                                    
													<tr>
														<td width="26%">
															<span class="w-50">Name</span>
														</td>
														<td width="1%">:</td>
														<td width="73%">
															<span class="font-weight-semibold"><?php echo getTitleName($row['pres_title'])." ".$row['pres_forename']." ".$row['pres_surname'] ?>
                                                            
                                                            </span>
														</td>
													</tr>
													
													 <tr>
														<td>
															<span class="w-50">Profession</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getProfName($row['pres_profession']); ?> </span>
														</td>
													</tr>
													
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Address</span>
														</td>
														<td>:</td>
														<td>
                                                        <?php
														$address=$row['pres_address1'];
														if ($row['pres_address2']!="")
														$address.=" ".$row['pres_address2'];
														$address.=", ".$row['pres_city'];
														$address.=", United Kingdom";
														
														
														?>
															<span class="font-weight-semibold"><?php echo $address; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Postcode</span>
														</td>
														<td>:</td>
														<td>
                                                      
															<span class="font-weight-semibold"><?php echo $row['pres_postcode']; ?></span>
														</td>
													</tr>
                                                    
													
                                                    
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Date of Birth</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo fn_GiveMeDateInDisplayFormat($row['pres_dob']); ?> </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">National Insurance Number</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_insurance_number']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Elibility to Work in UK</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if ($row['pres_work_permit']==1) echo "Yes"; else echo "No"; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Photo ID</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if ($row['pres_photo_id']!="") { ?> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_photo_id']?>" style="color:#69C; text-decoration:underline" download>Download</a><?php } ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Address Proof 1</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><span class="font-weight-semibold"><?php if ($row['pres_proof_address1']!="") { ?> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_proof_address1']?>" style="color:#69C; text-decoration:underline" download>Download</a><?php } ?></span></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Address Proof 2</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><span class="font-weight-semibold"><?php if ($row['pres_proof_address2']!="") { ?> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_proof_address2']?>" style="color:#69C; text-decoration:underline" download>Download</a><?php } ?></span></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>DBS Certificate</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><span class="font-weight-semibold"><span class="font-weight-semibold"><?php if ($row['pres_dbs']!="") { ?> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_dbs']?>" style="color:#69C; text-decoration:underline" download>Download</a><?php } ?></span></span></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>CV</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><span class="font-weight-semibold"><span class="font-weight-semibold"><?php if ($row['pres_cv']!="") { ?> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_cv']?>" style="color:#69C; text-decoration:underline" download>Download</a><?php } ?></span></span></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Regulatory Body</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if ($row['pres_regulatory_body']==1) echo $regBody="GPhc"; else if ($row['pres_regulatory_body']==2) echo $regBody="GMC"; else if ($row['pres_regulatory_body']==3) echo $regBody="NMC"; else if ($row['pres_regulatory_body']==4) echo $regBody="Not applicable"; ?></span>
                                                           
													   </td>
													</tr>
                                                    
                                                    <?php if ($row['pres_regulatory_body']==1 || $row['pres_regulatory_body']==2 || $row['pres_regulatory_body']==3) {
														
														$fieldName="pres_".strtolower($regBody)."_"."reg_number";
														 ?>
                                                    <tr>
														<td>
															<span class="w-50"><?php echo $regBody ?> Registration Number</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row[$fieldName]; ?></span>
                                                           
														</td>
													</tr>
                                                    
                                                    <?php } ?>
                                                    
                                                     
                                                    
                                                    <tr>
														<td  valign="top">
															<span class="w-50">Professional Regulatory Body certificate</span>
														</td>
														<td>:</td>
														<td><span class="font-weight-semibold"><span class="font-weight-semibold"><span class="font-weight-semibold"><?php if ($row['pres_regulatory_cert']!="") { ?> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_regulatory_cert']?>" style="color:#69C; text-decoration:underline" download>Download</a><?php } ?></span></span></span></td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Have Prescribing Qualification Certificate </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if ($row['pres_qualification_check']==1) echo "Yes"; else echo "No"; ?></span>
														</td>
													</tr>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Qualitification Certificates</span>
														</td>
														<td>:</td>
														<td>
														
                                                            
                                                            
                            							 <?php 
														 $arrUnSerMes=array();
														 
														
														
														 if ($row['pres_qualification_cert']!="") 
														 		{
																	
																$arrUnSerMes=unserialize(fnUpdateHTML($row['pres_qualification_cert']));
																
																}
																
																
																
																  ?>
                                                        		<br /><br />
															
															
															 <?php 
															 
															 
															 
															 for ($j=0;$j<@count($arrUnSerMes);$j++) {
																		
																		
															$fileExtension = pathinfo($arrUnSerMes[$j], PATHINFO_EXTENSION);
															
															// Check if the file extension is PDF
															if (strtolower($fileExtension) === 'pdf') {
																// The file is a PDF
																$type="pdf";
															} elseif (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) {
																// The file is an image
																$type="image";
															} 
																		
																		 ?>
                                                                        
                                                                            <a style="color:#69C; text-decoration:underline; font-weight:bold" href="<?php echo URL?>clinician/documents/<?php echo $arrUnSerMes[$j]; ?>" download >
                                                                                
                                                                                <?php if ($type=="image") { ?>
                                                                                
                                                                                Download Certificate <?php echo $j+1?>
                                                                                <?php } else { ?>
                                                                                
                                                                                Download Certificate <?php echo $j+1?>
                                                                                <?php } ?>
                                                                                
                                                                            </a>
                                                                        
                                                                        <br /><br />
                                                                      <?php } ?>
                                                            
                                                            
                                                           
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>CPD Certificates</td>
														<td>:</td>
														<td>
															
                                                             <?php 
															
															
															 $arrUnSerCPD=array();
															 if ($row['pres_cpd_cert']!="") 
														 		{
																$arrUnSerCPD=unserialize(fnUpdateHTML($row['pres_cpd_cert']));
																
																}
																
																//print_r ($arrUnSerCPD);
																
																  ?>
                                                        		<br /><br />
															
															
															 <?php for ($j=0;$j<count($arrUnSerCPD);$j++) {
																		
																		
															$fileExtension = pathinfo($arrUnSerCPD[$j], PATHINFO_EXTENSION);
															
															// Check if the file extension is PDF
															if (strtolower($fileExtension) === 'pdf') {
																// The file is a PDF
																$type="pdf";
															} elseif (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) {
																// The file is an image
																$type="image";
															} 
																		
																		 ?>
                                                                        
                                                                            <a style="color:#69C; text-decoration:underline; font-weight:bold" href="<?php echo URL?>clinician/documents/<?php echo $arrUnSerCPD[$j]; ?>" download >
                                                                                
                                                                                <?php if ($type=="image") { ?>
                                                                                
                                                                                Download Certificate <?php echo $j+1?>
                                                                                <?php } else { ?>
                                                                                
                                                                                Download Certificate <?php echo $j+1?>
                                                                                <?php } ?>
                                                                                
                                                                            </a>
                                                                        
                                                                        <br /><br />
                                                                      <?php } ?>
                                                            
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>Professional Indemnity Cover</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if ($row['pres_indemnity']==1) echo "Yes"; else echo "No"; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td  valign="top">
															<span class="w-50">Professional Indemnity Cover certificate</span>
														</td>
														<td>:</td>
														<td><span class="font-weight-semibold"><span class="font-weight-semibold"><span class="font-weight-semibold"><?php if ($row['pres_indemnity_doc']!="") { ?> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_indemnity_doc']?>" style="color:#69C; text-decoration:underline" download>Download</a><?php } ?></span></span></span></td>
													</tr>
                                                    
                                                    <tr>
														<td  valign="top">
															<span class="w-50">Expiry Date of Indeminity Cover Check</span>
														</td>
														<td>:</td>
														<td><?php echo fn_GiveMeDateInDisplayFormat($row['pres_expiry_date']) ?> </td>
													</tr>
                                                    
                                                    
                                                     <tr><td height="22" colspan="3"><h5><u>Professional reference check 1</u></h5></td></tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_rf1_name']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Job Title</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_rf1_job_title']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Organisation</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_rf1_org']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Email Address</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_rf1_email']; ?></span>
														</td>
												  </tr>
                                                  
                                                  
                                                    <tr><td height="22" colspan="3"><h5><u>Professional reference check 2</u></h5></td></tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_rf2_name']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Job Title</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_rf2_job_title']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Organisation</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_rf2_org']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Email Address</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_rf2_email']; ?></span>
														</td>
												  </tr>
                                                    
                                                    <tr><td colspan="3"><h5><u>Contact Details</u></h5></td></tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Home Telephone</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_home_phone']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Mobile Telephone</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_mobile']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Email Address</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_email']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr><td colspan="3"><h5><u>Job Information</u></h5></td></tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Employment Status</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_employment_status']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">If limited company, IR35 Status:</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_ir35']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">If Self Employed, UTR Number</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_utr']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Work Location</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_work_location']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">If working remote, please confirm you are located within the UK and will undertake all the work while in the UK </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if ($row['pres_work_in_uk']==1) echo "Yes"; else echo "No"; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr><td colspan="3"><h5><u>Emergency Contact</u></h5></td></tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Forename/s</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_e_name']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Surname</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_e_surname']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Home Telephone</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_e_phone']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Mobile Telephone</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_e_mobile']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Address</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_e_address']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Address 2</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_e_address2']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">City</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_e_city']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Country</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if ($row['pres_e_country']==1) echo "United Kingdom"; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Postcode</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_e_postcode']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr><td colspan="3"><h5><u>Employement Information</u></h5></td></tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Employement Status</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_employment_status']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">If limited company, IR35 Status:</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_ir35']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">If limited company, please provide company name number:</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_ltd_company']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">If Self Employed, UTR Number</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_utr']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Work Location</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pres_work_location']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">If working remote, please confirm you are located within the UK and will undertake all the work while in the UK   </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if($row['pres_work_in_uk']==1) echo "Yes"; else echo "No"; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr><td colspan="3"><h5><u>Staff Pension Scheme, PAYE Staff only:</u></h5></td></tr>
                                                    <tr><td colspan="3">All PAYE staff are automatically included in our work place pension scheme  </td></tr>
                                                    <tr>
														<td>
                                                        
															<span class="w-50">Do you wish to opt out of our workplace pension scheme</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if($row['pres_pension_opt_out']==1) echo "Yes"; else echo "No"; ?></span>
														</td>
													</tr>
                                                    
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Registered on</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo fn_GiveMeDateInDisplayFormat($row['pres_registered_on']); ?> </span>
														</td>
													</tr>
                                                   
                                                   <!-- <tr>
														<td>
															<span class="w-50">Status</span>
														</td>
														<td>:</td>
														<td>
                                                        <?php if ($row['patient_status']==1) $status="Active"; else $status="Blocked"; ?>
															<span class="badge badge-primary"><?php echo $status; ?></span>
														</td>
													</tr>-->
												</tbody>
											</table>
										</div>
                                            
										</div>
													
													<!--<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="task-list">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center">No</th>
																<th class="border-bottom-0">Task</th>
																<th class="border-bottom-0">Client</th>
																<th class="border-bottom-0">Assign To</th>
																<th class="border-bottom-0">Priority</th>
																<th class="border-bottom-0">Start Date</th>
																<th class="border-bottom-0">Deadline</th>
																<th class="border-bottom-0">Project Status</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">1</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Design Updated</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Julia Walker</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/4.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Melanie Coleman</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-danger-light">High</span></td>
																<td>12-02-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">62%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-60"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">2</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Code Updated</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Diane Short</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/15.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Justin Parr</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-success-light">Low</span></td>
																<td>01-01-2021</td>
																<td>22-04-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">45%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-45"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">3</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Issues fixed </span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Pippa Welch</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/5.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Amelia Russell</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-warning-light">Medium</span></td>
																<td>11-04-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">53%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-50"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">4</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Testing</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Lisa Vance</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/14.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Ryan Young</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-success-light">Low</span></td>
																<td>11-04-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">67%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-65"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>-->
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
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Prescription detail</h4>
	</div>
	<div class="page-rightheader ml-md-auto">
		<div class=" btn-list">
		<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
															</a>
		</div>
	</div>
</div>
<!--End Page header-->	 

				
<div class="row">
		<div class="col-lg-12 col-md-12">
        
        <div class="main-content">
					<div class="container">

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-4 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Prescription Status: <span class="tag tag-green">Approved by Prescriber</span></div>
									</div>
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table">
												<tbody>
													
													<tr>
														<td>
															<span class="w-50">Order Number</span>
														</td>
														<td>:</td>
														<td>
															PH-23432
														</td>
													</tr>
													
													
													<tr>
														<td>
															<span class="w-50">Condition</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">Nausea, Vomit</span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Address</span>
														</td>
														<td>:</td>
														<td>
                                                        
															<span class="font-weight-semibold">Tedlafil - 10 mg</span>
														</td>
													</tr>
                                                    
													
													
													<tr>
														<td>
															<span class="w-50">Prescription Status</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<span class="badge badge-primary">Active</span>
                                                            
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Prescription Expires</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	15 Jan, 2023
															
														</td>
													</tr>
                                                    
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
								
							</div>
							<div class="col-xl-8 col-md-12 col-lg-12">
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
											<li class="ml-4"><a href="#tab5" class="active"  data-toggle="tab">Order Details</a></li>
											<li><a href="#tab6" data-toggle="tab">Completed Medical Assessment</a></li>
											<li><a href="#tab7"  data-toggle="tab">Messages</a></li>
											
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane active" id="tab5">
											<div class="card-body">
												<div class="table-responsive">
										<table class="table card-table table-vcenter text-nowrap mb-0">
											<thead >
												<tr>
													
													<th>Medicine Name</th>
													<th>Quantity</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													
													<td>Metroprolol (Lopressor) 12 mg</td>
													<td>20 Tabs (2 months)</td>
													<td><?php echo CURRENCY?>25</td>
												</tr>
												<tr>
													
													<td>Montair LC 12 mg</td>
													<td>20 Tabs (2 months)</td>
													<td><?php echo CURRENCY?>25</td>
												</tr>
												
											</tbody>
										</table>
									</div>
											</div>
										</div>
										<div class="tab-pane" id="tab6">
											<div class="card-body">
												<div class="table-responsive">
                                                
                                                Not available yet!
													
													<!--<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="task-list">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center">No</th>
																<th class="border-bottom-0">Task</th>
																<th class="border-bottom-0">Client</th>
																<th class="border-bottom-0">Assign To</th>
																<th class="border-bottom-0">Priority</th>
																<th class="border-bottom-0">Start Date</th>
																<th class="border-bottom-0">Deadline</th>
																<th class="border-bottom-0">Project Status</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">1</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Design Updated</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Julia Walker</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/4.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Melanie Coleman</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-danger-light">High</span></td>
																<td>12-02-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">62%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-60"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">2</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Code Updated</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Diane Short</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/15.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Justin Parr</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-success-light">Low</span></td>
																<td>01-01-2021</td>
																<td>22-04-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">45%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-45"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">3</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Issues fixed </span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Pippa Welch</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/5.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Amelia Russell</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-warning-light">Medium</span></td>
																<td>11-04-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">53%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-50"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">4</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Testing</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Lisa Vance</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/14.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Ryan Young</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-success-light">Low</span></td>
																<td>11-04-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">67%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-65"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>-->
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab7">
											<div class="card-body">
                                            
                                            No messages yet!
                                            
												<!--<div class="table-responsive">
													<a href="#" class="btn btn-primary btn-tableview">Upload Files</a>
													<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="files-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0">File Name</th>
																<th class="border-bottom-0">Upload By</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">1</td>
																<td>
																	<a href="#" class="font-weight-semibold fs-14 mt-5">document.pdf<span class="text-muted ml-2">(23 KB)</span></a>
																	<div class="clearfix"></div>
																	<small class="text-muted">2 hours ago</small>
																</td>
																<td>Client</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">2</td>
																<td>
																	<a href="#" class="font-weight-semibold fs-14 mt-5">image.jpg<span class="text-muted ml-2">(2.67 KB)</span></a>
																	<div class="clearfix"></div>
																	<small class="text-muted">1 day ago</small>
																</td>
																<td>Admin</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">3</td>
																<td>
																	<a href="#" class="font-weight-semibold fs-14 mt-5">Project<span class="text-muted ml-2">(578.6MB)</span></a>
																	<div class="clearfix"></div>
																	<small class="text-muted">1 day ago</small>
																</td>
																<td>Team Lead</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>-->
											</div>
										</div>
										
										
										<div class="tab-pane" id="tab10">
											<div class="card-body">
                                            
                                            No Payments found!
												<!--<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="invoice-tables">
														<thead>
															<tr>
																<th class="border-bottom-0">InvoiceID</th>
																<th class="border-bottom-0">Amount</th>
																<th class="border-bottom-0">Invoice Date</th>
																<th class="border-bottom-0">Due Date</th>
																<th class="border-bottom-0">Payment</th>
																<th class="border-bottom-0">Status</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<a href="#">INV-0478</a>
																</td>
																<td>$345.00</td>
																<td>12-01-2021</td>
																<td>14-02-2021</td>
																<td>
																	<span class="text-primary">$345.000</span>
																</td>
																<td><span class="badge badge-success-light">Paid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-1245</a>
																</td>
																<td>$834.00</td>
																<td>12-01-2021</td>
																<td>14-02-2021</td>
																<td>
																	<span class="text-primary">$834.000</span>
																</td>
																<td><span class="badge badge-danger-light">UnPaid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-5280</a>
																</td>
																<td>$16,753.00</td>
																<td>21-01-2021</td>
																<td>15-01-2021</td>
																<td>
																	<span class="text-primary">$16,753.000</span>
																</td>
																<td><span class="badge badge-success-light">Paid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-2876</a>
																</td>
																<td>$297.00</td>
																<td>05-02-2021</td>
																<td>21-02-2021</td>
																<td>
																	<span class="text-primary">$297.000</span>
																</td>
																<td><span class="badge badge-success-light">Paid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-1986</a>
																</td>
																<td>$12,897.00</td>
																<td>01-01-2021</td>
																<td>24-02-2021</td>
																<td>
																	<span class="text-primary">$12,897.00</span>
																</td>
																<td><span class="badge badge-danger-light">UnPaid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>-->
											</div>
										</div>
										<div class="tab-pane" id="tab11">
											<div class="card-body">
												No log history yet!
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
  