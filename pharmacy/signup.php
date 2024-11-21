<?php include "../private/settings.php";
include PATH."include/headerhtml.php"
 ?>
  <body style="padding-top:0px;">  
<section class="register_screen">
    <div class="container">
        <div class="logo_box">
        <a href="<?php echo URL?>" class="logo"><img src="<?php echo URL?>images/logo.png"></a>
        </div>
        <div class="register_box">
        <form id="frmApp" name="frmApp" method="POST" class="grid spacer-24">
            <div class="top">
            <h2 class="title_h2" style="text-align:center">Prescriber Sign up</h2>
             <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="label-control" style="text-align:left">Employee Number:</label>
                        <input class="form-control" type="text" id="txtEmpNum" name="txtEmpNum" value="" data-validation="required" data-validation-error-msg="Please enter employee number" maxlength="70">
                    </div>
                </div>
            </div>    
            </div>
            <div class="row" style="background:#015280; padding:10px 15px 7px 15px; color:#fff; margin-bottom:15px">
            	<h6>Personal Details</h6>
            </div>
           <div class="row">
                            
                            
                            				<div class="col-sm-4 col-md-4">
												<div class="form-group">
													<label class="form-label">Title <span class="text-red">*</span></label>
													<select class="form-control" name="cmbTitle" id="cmbTitle"  data-validation="required" data-validation-error-msg="Please select title">
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
											<div class="col-sm-4 col-md-4">
												<div class="form-group">
													<label class="form-label">Forename/s <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="First name" value="<?php echo $row['pres_forename'] ?>" name="txtForename" data-validation="required" data-validation-error-msg="Please enter your forename" maxlength="70">
												</div>
											</div>
											<div class="col-sm-4 col-md-4">
												<div class="form-group">
													<label class="form-label">Sur Name <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="Last name" value="<?php echo $row['pres_surname'] ?>" name="txtSurname" data-validation="required" data-validation-error-msg="Please enter your Surname">
												</div>
											</div>
										
										</div>
                            
                            <div class="row">
                            
                            
                            				
											<div class="col-sm-12 col-md-12">
												<div class="form-group">
													<label class="form-label">Profession <span class="text-red">*</span></label>
													<select class="form-control" name="cmbProf" id="cmbProf" data-validation="required" data-validation-error-msg="Please select profession" >
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
											<div class="col-sm-12 col-md-12">
												<div class="form-group">
													<label class="form-label">Address 2</label>
													<input type="text" class="form-control" placeholder="" name="txtAddress2" value="<?php echo $row['pres_address2'] ?>">
												</div>
											</div>
										
										</div>
                            <div class="row">
                            
                            
                            				
											<div class="col-sm-12 col-md-12">
												<div class="form-group">
													<label class="form-label">Address <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="" value="<?php echo $row['pres_address1'] ?>" name="txtAddress" data-validation="required" data-validation-error-msg="Please enter your address">
												</div>
											</div>
											<div class="col-sm-12 col-md-12">
												<div class="form-group">
													<label class="form-label">Address 2</label>
													<input type="text" class="form-control" placeholder="" name="txtAddress2" value="<?php echo $row['pres_address2'] ?>">
												</div>
											</div>
										
										</div>
                            
                           
                            <div class="row">
                            
                            
                            				
											<div class="col-sm-6 col-md-6">
												<div class="form-group">
													<label class="form-label">City <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="" name="txtCity" value="<?php echo $row['pres_city'] ?>" data-validation="required" data-validation-error-msg="Please enter city name">
												</div>
											</div>
											<div class="col-sm-6 col-md-6">
												<div class="form-group">
												  <label class="form-label">Country <span class="text-red">*</span></label>
													<select class="form-control custom-select select2" name="cmbCountry" id="cmbCountry" required >
														<option value="">Select Country</option>
                                                        <option value="1" selected="selected">United Kingdom</option>
                                                    </select>
                                        
												</div>
											</div>
										
										</div>
                                   
                                   
                                   <div class="row">
                            
                            
                            				
											<div class="col-sm-6 col-md-6">
												<div class="form-group">
													<label class="form-label">Postcode <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="" name="txtPostcode" value="<?php echo $row['pres_postcode'] ?>" maxlength="6" data-validation="required" data-validation-error-msg="Please enter postcode">
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
									<select class="form-control custom-select select2" name="cmbDate" id="cmbDate" data-validation="required" data-validation-error-msg="Please select date">
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
									<select class="form-control custom-select select2" name="cmbMonth" id="cmbMonth" data-validation="required" data-validation-error-msg="Please select month" >
										<option value="">Select Month</option>
                                       
										<?php for ($r = 1; $r <= 12; $r++){
                                            $month_name = date('F', mktime(0, 0, 0, $r, 1, date("Y")));
                                            ?> <option value="<?php echo $r ?>" <?php if ($arrDob[1]==$r) echo "selected"; ?>><?php echo $month_name ?></option> <?php 
                                        }?>				
									</select>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
									<select class="form-control custom-select select2" name="cmbYear" id="cmbYear"  data-validation="required" data-validation-error-msg="Please select year">
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
                            
                            
                              <div class="form-group">
								<label class="form-label">National Insurance Number *</label>
								<input class="form-control mb-4" type="text" id="txtNIN" name="txtNIN" value="<?php echo $row['pres_insurance_number']?>" data-validation="required" data-validation-error-msg="Please enter national insurance number">
							</div>
                            
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
                    
                    
                     <div class="form-group">
								<label class="form-label">Photo Id (Upload Passport or Driving License)</label>
								<input class="form-control" type="file" id="flPhotoId" name="flPhotoId" >
                                
                                 <?php if ($row['pres_photo_id']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_photo_id']!="") { ?> <a href="<?php echo URL?>prescriber/documents/<?php echo $row['pres_photo_id']?>" style="color:#06F; text-decoration:underline" download>View Uploaded file</a><?php } ?></span>
                                <?php } ?>
					</div>
                    
                    <div class="form-group">
								<label class="form-label">Upload Address Proof 1</label>
								<input class="form-control" type="file" id="flProof1" name="flProof1" >
                                
                                <?php if ($row['pres_proof_address1']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_proof_address1']!="") { ?> <a href="<?php echo URL?>prescriber/documents/<?php echo $row['pres_proof_address1']?>" style="color:#06F; text-decoration:underline" download>View Uploaded file</a><?php } ?></span>
                                <?php } ?>
					</div>
                    
                     <div class="form-group">
								<label class="form-label">Upload Address Proof 2</label>
								<input class="form-control" type="file" id="flProof2" name="flProof2" >
                                
                                <?php if ($row['pres_proof_address2']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_proof_address2']!="") { ?> <a href="<?php echo URL?>prescriber/documents/<?php echo $row['pres_proof_address2']?>" style="color:#06F; text-decoration:underline" download>View Uploaded file</a><?php } ?></span>
                                <?php } ?>
					</div>
                    
                     <div class="form-group">
								<label class="form-label">DBS Number (if required)</label>
								<input class="form-control mb-4" type="text" id="txtDBS" name="txtDBS" value="<?php echo $row['pres_dbs_number']?>">
							</div>
                            
                      <div class="form-group ">
						<div class="form-label">Regulatory body</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" id="rdoRegBody" value="1" <?php if($row['pres_regulatory_body']==1 && $row['pres_id']!='') echo 'checked="checked"'; ?> >
								<span class="custom-control-label">GPhC</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" id="rdoRegBody" value="2" <?php if($row['pres_regulatory_body']==2 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">GMC </span>
							</label>
                            <label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" id="rdoRegBody" value="3" <?php if($row['pres_regulatory_body']==3 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">NMC </span>
							</label>
                             <label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" id="rdoRegBody" value="4" <?php if($row['pres_regulatory_body']==4 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Not Applicable </span>
							</label>
					
						</div>
					</div>     
                    
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
                            
                            Upload Certificate &nbsp;&nbsp;
                            <input class="" type="file" id="flCert" name="flCert">
                            
                             <?php if ($row['pres_indemnity_doc']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_indemnity_doc']!="") { ?> <a href="<?php echo URL?>prescriber/documents/<?php echo $row['pres_indemnity_doc']?>" style="color:#06F; text-decoration:underline" download>View Uploaded file</a><?php } ?></span>
                                <?php } ?>
					
						</div>
					</div> 
                    
                    		<div class="form-group">
								<label class="form-label">Professional reference check 1</label>
								<textarea class="form-control mb-4" type="text" id="txtProRefChk1" placeholder="Provide Details" name="txtProRefChk1" ><?php echo $row['pres_ref_check1']; ?></textarea>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Professional reference check 2</label>
								<textarea class="form-control mb-4" type="text" id="txtProRefChk2" placeholder="Provide Details" name="txtProRefChk2" ><?php echo $row['pres_ref_check2']; ?></textarea>
							</div>
                            
                            
                             
                            
                            <div class="form-group ">
						<div class="form-label">Indeminity cover Check (if applicable)</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoInd" id="rdoInd" value="1" <?php if($row['pres_indemnity']==1 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoInd" id="rdoInd" value="2" <?php if($row['pres_indemnity']==2 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
                            
                           
                            	
					
						</div>
					</div>
                    
                    <div class="form-group ">
						<div class="form-label">Upload Certificate</div>
						<div class="custom-controls-stacked">
							
                           <input class="" type="file" id="flIndCert" name="flIndCert" value="<?php echo $row['blog_title']?>">
                           <br /> <br />
                           <div class="form-label">Expiry Date of Indeminity Cover Check</div>
                           <input type="date" class="form-control col-md-3"  name="txtExpDate" value="<?php echo $row['pres_expiry_date'] ?>" />
                            
                             <?php if ($row['pres_qualification_cert']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_qualification_cert']!="") { ?> <a href="<?php echo URL?>prescriber/documents/<?php echo $row['pres_qualification_cert']?>" style="color:#06F; text-decoration:underline" download>View Uploaded file</a><?php } ?></span>
                                <?php } ?>	
					
						</div>
					</div>
                    
                    <div style="height:20px"></div>
                
                <div class="row" style="background:#015280; padding:10px 15px 7px 15px; color:#fff; margin-bottom:15px">
            	<h6>Contact Details</h6>
            </div>
            
            <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Home Telephone</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $row['pres_home_phone']?>" name="txtHomeTelephone">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Mobile Telephone *</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $row['pres_mobile']?>" name="txtMobile" data-validation="required" data-validation-error-msg="Please enter your mobile number">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Email Address *</label>
												<input class="form-control mb-4" placeholder="" type="email" value="<?php echo $row['pres_email']?>" name="txtEmail" data-validation="email required" data-validation-error-msg="Please enter your email address">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<div class="form-group password-strength">
                        <label class="label-control" for="password">Password</label>
                        <input class="form-control" type="text" id="password" name="txtPassword" value="" data-validation="strength" data-validation-strength="3">
                    </div>
											</div>											
										</div>
            
            <div style="height:20px"></div>
             <div class="row" style="background:#015280; padding:10px 15px 7px 15px; color:#fff; margin-bottom:15px">
            	<h6>Job Information</h6>
            </div>
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
                                            	<label class="form-label">If Self Employed, UTR Number</label>
												<input class="form-control mb-4" name="txtUTR" placeholder="" value="<?php echo $row['pres_utr'] ?>" type="text">
											</div>											
										</div>
             <div class="row">
            	<div class="col-sm-12">
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
                            
                          <div style="height:20px"></div> 
                         <div class="row">
            				<div class="col-sm-12">
                    			<div class="form-group ">     	
                            
                            <div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
                            If working remote, please confirm you are located within the UK and will undertake all the work while in the UK  &nbsp;&nbsp;<br>
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
					</div>
                </div>
            </div>
            
            <div class="row" style="background:#015280; padding:10px 15px 7px 15px; color:#fff; margin-bottom:15px">
            	<h6>Emergency Contact</h6>
            </div>
            
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
            
            <div class="row" style="background:#015280; padding:10px 15px 7px 15px; color:#fff; margin-bottom:15px">
            	<h6>Staff Pension Scheme, PAYE Staff only:</h6>
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
                              <button id="submitBtn" type="submit" class="btn btn-danger btn-lg d-inline-flex align-items-center ps-5 pe-5 w100p">Submit</button></div>
                        
                        
                        <div class="signup_box">                           
                            <h6>Already registered? <a href="<?php echo URL?>patient/login">Sign in</a></h6>
                        
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
					  var phones = [{ "mask": "#### ### ###"}, { "mask": "(###) ###-##############"}];
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
							
							
							var isChecked = $("#CkTerms").is(":checked");
							if (!isChecked) { 
							alert ("Please accept the terms and conditions");
							return false;
							}
							
							
							
			
							 $("#submitBtn").attr('disabled','disabled');
			
							 $("#submitBtn").html("Please wait..</div>");
			
								
			
								var myform = document.getElementById("frmApp");
			
								var fd = new FormData(myform);	
			
								   $.ajax({		
								   type: "POST",			
								   url: "<?php echo URL?>prescriber/ajax/insert-prescriber.php",			
								   data: fd,			
								   cache: false,			
								   processData: false,			
								   contentType: false,						   
			
			
			
								   success: function(msg){	
								  // alert (msg);		
									if (msg==1)			
									  window.location='<?php echo URL?>prescriber/thanks';	
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
			
			
			
			</script>
