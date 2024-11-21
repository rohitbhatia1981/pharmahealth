<?php include "../private/settings.php";
include PATH."include/headerhtml.php";


function generateEmployeeCode() {
    $prefix = 'PHCL';
    $length = 6; // Adjust the length of the random part as needed
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomPart = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = mt_rand(0, strlen($characters) - 1);
        $randomPart .= $characters[$randomIndex];
    }

    return $prefix . $randomPart;
}

$employeeCode = generateEmployeeCode();

$_SESSION['sessEmpcode']=$employeeCode;


 ?>
  <body style="padding-top:0px;">  
<section class="register_screen">
    <div class="container">
        <div class="logo_box">
        <a href="<?php echo URL?>" class="logo"><img src="<?php echo URL?>images/logo.png"></a>
        </div>
        <div class="register_box">
        <form id="frmApp" name="frmApp" action="" method="POST" class="grid spacer-24" enctype="multipart/form-data">
            <div class="top">
            <h2 class="title_h2" style="text-align:center">Clinician Sign up</h2>
             <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="label-control" style="text-align:left">Employee Number:</label>
                        <input class="form-control" type="text" id="txtEmpNumber" name="txtEmpNumber" value="<?php echo $employeeCode;?>" readonly data-validation="required" data-validation-error-msg="Please enter employee number" maxlength="70">
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
													<select class="form-control" name="cmbTitle" id="cmbTitle"  data-validation="required" data-validation-error-msg="Please select title" onChange="showOther()">
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
                            
                            
							<option value="other">Other</option>
									
									</select>
												</div>
											</div>
                                            
                                            <div class="col-sm-6 col-md-6">
												<div class="form-group" style="display:none" id="spanOther">
													<label class="form-label">Other </label>
													<input type="text" class="form-control" placeholder="Other title" value="" name="txtOtherTitle" data-validation="required" data-validation-error-msg="Please enter other title" maxlength="70">
												</div>
											</div>
                                            
                                            
                                        </div>
                                        
                                        <div class="row">
                                            
											<div class="col-sm-6 col-md-6">
												<div class="form-group">
													<label class="form-label">Forename/s <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="" value="<?php echo $row['pres_forename'] ?>" name="txtForename" data-validation="required" data-validation-error-msg="Please enter your forename" maxlength="70">
												</div>
											</div>
											<div class="col-sm-6 col-md-6">
												<div class="form-group">
													<label class="form-label">Surname <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="" value="<?php echo $row['pres_surname'] ?>" name="txtSurname" data-validation="required" data-validation-error-msg="Please enter your Surname">
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
									<div class="col-lg-3 col-md-3">
									<select class="form-control custom-select select2" name="cmbDate" id="cmbDate" data-validation="required" data-validation-error-msg="Please select date">
										<option value="">Date</option>
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
                                    <div class="col-lg-3 col-md-3">
									<select class="form-control custom-select select2" name="cmbMonth" id="cmbMonth" data-validation="required" data-validation-error-msg="Please select month" >
										<option value="">Month</option>
                                       
										<?php for ($r = 1; $r <= 12; $r++){
                                            $month_name = date('F', mktime(0, 0, 0, $r, 1, date("Y")));
                                            ?> <option value="<?php echo $r ?>" <?php if ($arrDob[1]==$r) echo "selected"; ?>><?php echo $month_name ?></option> <?php 
                                        }?>				
									</select>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
									<select class="form-control custom-select select2" name="cmbYear" id="cmbYear"  data-validation="required" data-validation-error-msg="Please select year">
										<option value="">Year</option>
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
							</label>&nbsp;&nbsp;
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoWorkUk" id="rdoWorkUk" value="0" <?php if($row['pres_work_permit']==0 && $row['pres_id']!='') echo 'checked="checked"'; ?>  >
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>
                    
                    
                     <div class="form-group">
								<label class="form-label">Photo ID (Upload Passport or Driving License)</label>
								<input class="form-control" type="file" id="flPhotoId" name="flPhotoId" >
                                
                                 <?php if ($row['pres_photo_id']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_photo_id']!="") { ?> <a href="<?php echo URL?>prescriber/documents/<?php echo $row['pres_photo_id']?>" style="color:#06F; text-decoration:underline" download>View Uploaded file</a><?php } ?></span>
                                <?php } ?>
					</div>
                    
                    <div class="form-group">
								<label class="form-label">Upload Proof of Address 1</label>
								<input class="form-control" type="file" id="flProof1" name="flProof1" >
                                
                                <?php if ($row['pres_proof_address1']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_proof_address1']!="") { ?> <a href="<?php echo URL?>prescriber/documents/<?php echo $row['pres_proof_address1']?>" style="color:#06F; text-decoration:underline" download>View Uploaded file</a><?php } ?></span>
                                <?php } ?>
					</div>
                    
                     <div class="form-group">
								<label class="form-label">Upload Proof of Address 2</label>
								<input class="form-control" type="file" id="flProof2" name="flProof2" >
                                
                                <?php if ($row['pres_proof_address2']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_proof_address2']!="") { ?> <a href="<?php echo URL?>prescriber/documents/<?php echo $row['pres_proof_address2']?>" style="color:#06F; text-decoration:underline" download>View Uploaded file</a><?php } ?></span>
                                <?php } ?>
					</div>
                    
                     <div class="form-group">
								<label class="form-label">Upload DBS Certificate</label>
								<input class="form-control" type="file" id="flDBS" name="flDBS" >
							</div>
                      
                      <div class="form-group">
								<label class="form-label">Upload CV</label>
								<input class="form-control" type="file" id="flCV" name="flCV" >
							</div>
                            
                      <div class="form-group ">
						<div class="form-label">Professional Regulatory Body</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" onChange="showRegNo(1)" name="rdoRegBody" id="rdoRegBody" value="1" <?php if($row['pres_regulatory_body']==1 && $row['pres_id']!='') echo 'checked="checked"'; ?> >
								<span class="custom-control-label">GPhC</span>
							</label>&nbsp;&nbsp;
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" onChange="showRegNo(2)" id="rdoRegBody" value="2" <?php if($row['pres_regulatory_body']==2 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">GMC </span>
							</label>&nbsp;&nbsp;
                            <label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" onChange="showRegNo(3)" id="rdoRegBody" value="3" <?php if($row['pres_regulatory_body']==3 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">NMC </span>
							</label>&nbsp;&nbsp;
                             <label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoRegBody" onChange="showRegNo(4)" id="rdoRegBody" value="4" <?php if($row['pres_regulatory_body']==4 && $row['pres_id']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Not Applicable </span>
							</label>
                            
                            <div  style="padding-top:10px; margin-top:10px; border:1px solid #CCC; padding-bottom:10px; padding-left:20px; ">
                            <label class="form-label">Upload Professional Regulatory Body certificate</label>
								<input class="form-control" type="file" id="flRegBody" name="flRegBody" >
                            </div>
					
						</div>
					</div> 
                    
                    
                    <div class="row" style="display:none" id="IdRegisterNo">
                    <div class="form-label">Please enter Registration Numbers</div>
                                            
											<div class="col-sm-4 col-md-4" style="display:none" id="regGphc">
												<div class="form-group">
													<label class="form-label">GPhC </label>
													<input type="text" class="form-control" placeholder="" value="" name="txtGPHCReg" data-validation="required" data-validation-error-msg="Please enter GPhC registration number" maxlength="30">
												</div>
											</div>
											<div class="col-sm-4 col-md-4" style="display:none" id="regGmc">
												<div class="form-group">
													<label class="form-label">GMC </label>
													<input type="text" class="form-control" placeholder="" value="" name="txtGMCReg" data-validation="required" data-validation-error-msg="Please enter GMC registration number" maxlength="30">
												</div>
											</div>
                                            
                                            <div class="col-sm-4 col-md-4" style="display:none" id="regNmc">
												<div class="form-group">
													<label class="form-label">NMC </label>
													<input type="text" class="form-control" placeholder="" value="" name="txtNMCReg" data-validation="required" data-validation-error-msg="Please enter NMC registration number" maxlength="30">
												</div>
											</div>
										
										</div>    
                    
                    <div class="form-group ">
						<div class="form-label">Prescribing qualification certificate</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoQC" id="rdoQC" onChange="showQuali()" value="1" >
								<span class="custom-control-label">Yes</span>
							</label>
                            &nbsp;&nbsp;
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoQC" id="rdoQC" onChange="showQuali()" value="0" >
								<span class="custom-control-label">No</span>
							</label>
                             &nbsp;&nbsp;
                            <label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoQC" id="rdoQC" onChange="showQuali()" value="2" >
								<span class="custom-control-label">Not Applicable</span>
							</label>
                            
                            <div id="cont_quali" style="padding-top:10px; border:1px solid #CCC; padding-bottom:10px; padding-left:20px; display:none">
                            Upload Certificate &nbsp;&nbsp;
                            
                            	<div >
                            		<input class="form-control" type="file" id="flCert" accept=".pdf,.jpg,.png" name="flCert[]">
                                 </div>
                                 
                                 
                                 <div id="cont_addmore_1"></div>
                                 <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onClick="addMoreFile(1)">+ Add More Certificate</a></div>
                                 
                            </div>
                            
					
						</div>
					</div> 
                    
                    <div class="form-group">
								<label class="form-label">Upload CPD Certificates</label>
								<input class="form-control" type="file" id="flCPD" name="flCPD[]" accept=".pdf,.jpg,.png" >
                                
                      
                      <div id="cpd_addmore_2"></div>
                                 <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onClick="addMoreFile(2)">+ Add More Certificate</a></div>
                             
					</div>
                    
                    
                    <div class="form-group ">
						<div class="form-label">Professional Indemnity Cover</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoInd" id="rdoInd" onChange="showInd()" value="1" >
								<span class="custom-control-label">Yes</span>
							</label>
                            &nbsp;&nbsp;
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoInd" id="rdoInd" onChange="showInd()" value="2" >
								<span class="custom-control-label">No</span>
							</label>
                            
                           
                            	
					
						</div>
					</div>
                    
                    <div class="form-group " id="cont_ind" style="padding-top:10px; border:1px solid #CCC; padding-bottom:10px; padding-left:20px; display:none">
						<div class="form-label">Upload Professional Indemnity Cover certificate</div>
						<div class="custom-controls-stacked">
							
                           <input class="form-control" type="file" id="flIndCert" name="flIndCert" value="">
                           <br /> <br />
                           <div class="form-label">Expiry Date of Indeminity Cover Check</div>
                           <input type="date" class="form-control col-md-3"  name="txtExpDate" value="<?php echo $row['pres_expiry_date'] ?>" />
                            
                           
                             
                            <!-- <div id="cont_addmore_2"></div>
                              <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onclick="addMoreFile(2)">+ Add More</a></div>
					-->
						</div>
					</div>
                    
                    		<div class="form-group">
								<label class="form-label">Professional reference check 1</label>
								<!--<textarea class="form-control mb-4" type="text" id="txtProRefChk1" placeholder="Provide Details" name="txtProRefChk1" ><?php echo $row['pres_ref_check1']; ?></textarea>-->
                                
                                
                                 <div  style="padding-top:10px; margin-top:10px; border:1px solid #CCC; padding-bottom:10px; padding-left:20px; ">
                            		
									<input type="text" class="form-control" placeholder="Name" value="" name="rf1_name" >
                                    <br>
                                    <input type="text" class="form-control" placeholder="Job title" value="" name="rf1_job_title" >
                                     <br>
                                    <input type="text" class="form-control" placeholder="Organisation" value="" name="rf1_org" >
                                     <br>
                                    <input type="text" class="form-control" placeholder="Email Address" value="" name="rf1_email" >
                            	</div>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Professional reference check 2</label>
								
                                <div  style="padding-top:10px; margin-top:10px; border:1px solid #CCC; padding-bottom:10px; padding-left:20px; ">
                            		
									<input type="text" class="form-control" placeholder="Name" value="" name="rf2_name" >
                                    <br>
                                    <input type="text" class="form-control" placeholder="Job title" value="" name="rf2_job_title" >
                                     <br>
                                    <input type="text" class="form-control" placeholder="Organisation" value="" name="rf2_org" >
                                     <br>
                                    <input type="text" class="form-control" placeholder="Email Address" value="" name="rf2_email" >
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
                                        
                           <div style="height:20px"></div>      
                                 
                                  <div class="row" style="background:#015280; padding:10px 15px 7px 15px; color:#fff; margin-bottom:15px">
            	<h6>Emergency Contact Details</h6>
            </div>
            
            <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Forename/s *</label>
												<input class="form-control mb-4" placeholder="" type="text" value="" name="txt_e_Forename" data-validation="required" data-validation-error-msg="Please enter emergency name">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Surname *</label>
												<input class="form-control mb-4" placeholder="" type="text" value="" name="txt_e_Surname" data-validation="required" data-validation-error-msg="Please enter emergency surname">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Home Telephone</label>
												<input class="form-control mb-4" placeholder="" type="text" value="" name="txt_e_Telephone"  >
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Mobile Telephone *</label>
												<input class="form-control mb-4" placeholder="" type="text" value="" name="txt_e_Mobile" data-validation="required" data-validation-error-msg="Please enter your mobile number">
											</div>											
										</div>
                                        
                                        
                                         <div class="row">
                            
                            
                            				
											<div class="col-sm-12 col-md-12">
												<div class="form-group">
													<label class="form-label">Address <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="" value="" name="txt_e_address" data-validation="required" data-validation-error-msg="Please enter emergency address">
												</div>
											</div>
											<div class="col-sm-12 col-md-12">
												<div class="form-group">
													<label class="form-label">Address 2</label>
													<input type="text" class="form-control" placeholder="" name="txt_e_address2" value="">
												</div>
											</div>
										
										</div>
                            
                           
                            <div class="row">
                            
                            
                            				
											<div class="col-sm-6 col-md-6">
												<div class="form-group">
													<label class="form-label">City <span class="text-red">*</span></label>
													<input type="text" class="form-control" placeholder="" name="txt_e_city" value="" data-validation="required" data-validation-error-msg="Please enter emergency city name">
												</div>
											</div>
											<div class="col-sm-6 col-md-6">
												<div class="form-group">
												  <label class="form-label">Country <span class="text-red">*</span></label>
													<select class="form-control custom-select select2" name="cmb_e_Country" id="cmb_e_Country" data-validation="required" data-validation-error-msg="Please select emergency country" >
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
													<input type="text" class="form-control" placeholder="" name="txt_e_Postcode" id="txt_e_Postcode" value="" maxlength="7" data-validation="required" data-validation-error-msg="Please enter emergency contact postcode">
												</div>
											</div>
											
										
										</div>
                                        
                                        <!--<div class="row row-sm">
											<div class="col-lg-8">
                                            	<div class="form-group password-strength">
                        <label class="label-control" for="password">Password</label>
                        <input class="form-control" type="text" id="password" name="txtPassword" value="" data-validation="strength" data-validation-strength="3">
                    </div>
											</div>											
										</div>-->
            
            <div style="height:20px"></div>
             <div class="row" style="background:#015280; padding:10px 15px 7px 15px; color:#fff; margin-bottom:15px">
            	<h6>Employment Information</h6>
            </div>
            <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Employment Status</label>
												<select class="form-control mb-4" name="txtEmpStatus" >
                                                <option value="">Select</option>
                                                <option value="PAYE">PAYE</option>
                                                <option value="Umbrella">Umbrella</option>
                                                <option value="Self Employed">Self Employed</option>
                                                <option value="Limited Company">Limited Company</option>
                                                </select>
                                                
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">If limited company, IR35 Status:</label>
												
                                                <select name="txtIR35" class="form-control mb-4">
                                                     <option value="">Select</option>
                                                	<option value="I don't know">I don't know </option>
                                                    <option value="Outside IR35">Outside IR35</option>
                                                    <option value="Inside IR35">Inside IR35</option>
                                                
                                                </select>
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">If limited company, please provide company name number:</label>
												<input class="form-control mb-4" name="txtCompanyName" placeholder="" type="text" value="">
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
							</label>&nbsp;&nbsp;
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
            	<h6>Staff Pension Scheme, PAYE Staff only:</h6>
            </div>
            
            
             
                <div class="row">
            				<div class="col-sm-12">
                    			<div class="form-group ">     	
                            
                            <div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
                            All PAYE staff are automatically included in our work place pension scheme  &nbsp;&nbsp;<br><br>
                            
                            Do you wish to opt out of our workplace pension scheme <br>
								<input type="radio" class="custom-control-input" name="rdoPension" id="rdoPension" value="1" >
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPension" id="rdoPension" value="0" >
								<span class="custom-control-label">No</span>
							</label>
                          </div>
                       
                       </div>
                     </div>
                   </div>
                   
                   <div class="row" style="background:#015280; padding:10px 15px 7px 15px; color:#fff; margin-bottom:15px">
            	<h6>Your Signature *</h6>
            </div>

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
<div class="button_box">
<div><input class="g-recaptcha" data-validation="recaptcha" data-validation-recaptcha-sitekey="6Lc38CkUAAAAAGSzBr9awm5tAfiMLHitD5f21vI4"></div>

                         <div id="error-container" align="left" style="padding-top:20px; padding-bottom:20px; color:#F00"></div>
                              <button id="submitBtn" type="submit" class="btn btn-danger btn-lg align-items-center w100p">Submit</button></div>
                        
                        
                        <div class="signup_box">                           
                            <h6>Already registered? <a href="<?php echo URL?>patient/login">Sign in</a></h6>
                        
                       </div>


          
            </form>
        </div>
    </div>
</section>
<?php include PATH."include/footer-simple.php"; ?>


<script src="<?php echo URL?>js/form-validator/jquery.form-validator.js"></script>
<script src="<?php echo URL?>js/jquery.inputmask.bundle.js"></script>

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
			
				<script>
				
				/*$("#txtPostcode").on("input", function () {
               		 var inputValue = $(this).val().replace(/\s/g, ''); // Remove existing spaces
                var formattedValue = '';

                for (var i = 0; i < inputValue.length; i++) {
                    formattedValue += inputValue[i];
                    if ((i + 1) === 4 && inputValue.length > 4) {
                        formattedValue += ' ';
                    }
                }

              	  $(this).val(formattedValue);
					});
					
					*/
				
				
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
					
					
					
				function showInd()
				{
				
					if ($("#rdoInd:checked").val() === "1")
					$("#cont_ind").show();
					else
					$("#cont_ind").hide();
					
				}
				
				function showQuali()
				{
					if ($("#rdoQC:checked").val() === "1" )
					$("#cont_quali").show();
					else
					$("#cont_quali").hide();
					
				}
				
				$('#password').on('focus', function () {
				   $(this).attr('type', 'password'); 
				});
				
				
				
				 function showOther()
				 {
					 if ($("#cmbTitle").val()=="other")
					 $("#spanOther").show();
					 else
					 $("#spanOther").hide();
					 
					
					 
				 }
			
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
							
							if ($("#signature64").val()=="")
							{ 
							alert ("Please draw your signature");
							return false;
							}
							
							/*var isChecked = $("#CkTerms").is(":checked");
							if (!isChecked) { 
							alert ("Please accept the terms and conditions");
							return false;
							}*/
							
							
							
			
							// $("#submitBtn").attr('disabled','disabled');
			
							 $("#submitBtn").html("Please wait..</div>");
			
							
			
								var myform = document.getElementById("frmApp");
			
								var fd = new FormData(myform);	
			
								   $.ajax({		
								   type: "POST",			
								   url: "<?php echo URL?>clinician/ajax/insert-prescriber.php",			
								   data: fd,			
								   cache: false,			
								   processData: false,			
								   contentType: false,						   
			
			
			
								   success: function(msg){	
								   //alert (msg);		
									if (msg==1)			
									  window.location='<?php echo URL?>clinician/thanks';	
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
