		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$totalRecords = count($rows);

		if ($page != 1)    

			$srno = (1 * $page) - 1;

		else

			$srno = 0;

		

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>	
		
<form name="adminForm" action="?c=<?php echo $component?>" method="get">


<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title"><?php echo pageheading(); ?></h4>
			</div>
			<div class="page-rightheader ml-md-auto">
				<div class=" btn-list">

								<?php if($permission['rights_add'] == 1) { ?>

<!--<a href="index.php?c=<?php echo $component?>&task=add&Cid=<?php echo $menuid['component_headingid']; ?>" title="Add" class="btn btn-light"><i class="feather feather-plus"></i></a>-->

<a href="index.php?c=<?php echo $component?>&task=add&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addawardmodal">Add New</a>

<?php } ?>							
								
					<a href="" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" role="button" title="Actions" aria-haspopup="true" aria-expanded="false">
									Action
								</a>
                                
                  
                  
                                
				<ul class="dropdown-menu dropdown-menu-right" role="menu">


				<?php if($permission['rights_delete'] == 1) { ?>

				<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to delete'); } else if (confirm('Are you sure you want to delete selected items?')){ submitbutton('remove');}"><i class="feather feather-trash-2 mr-2"></i> Delete</a></li>

				<?php } ?>

				<?php if($permission['rights_enable'] == 1) { ?>

				<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to enable'); } else {submitbutton('publishList', '');}"><i class="fa fa-check-circle mr-2"></i> Enable</a></li>

				<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to disable'); } else {submitbutton('unpublishList', '');}"><i class="fa fa-ban mr-2"></i> Disable</a></li>

				<?php } ?>
					

				</ul>
	
	

	
	
									<!-- <button  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
									<button  class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
									<button  class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> -->
								</div>
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
							<div class="e-table">
							<div class="row">
                           
											
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Search by Keyword:</label>
													<input type="text" class="form-control" name="txtSearchByTitle" placeholder="Search by keyword" value="<?php echo $_GET['txtSearchByTitle'];?>">
                                                   
                                                  
												</div>
											</div>
											
											<div class="col-md-12 col-lg-12 col-xl-1">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSearchByTitle"))
												   {
												    ?>
                                                    <a href="?c=<?php echo $_GET['c']?>" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php } ?>
												</div>
											</div>
										</div>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1">
										<thead>
											<tr>
												<th width="10%" class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												
                                                <th width="12%" class="border-bottom-0">Employee Number</th>
                                                <th width="19%" class="border-bottom-0">Clinician Name</th>
                                                <th width="19%" class="border-bottom-0">Profession</th>
                                                <th width="13%" class="border-bottom-0">Email</th>
                                                
                                                <th width="13%" class="border-bottom-0">Phone</th>
                                               
                                                
                                                                                             
                                                
                                               
												
												<th width="13%" class="border-bottom-0 w-20">Actions</th>
												<th width="9%" class="border-bottom-0 w-20">Status</th>
											</tr>
										</thead>
							<?php

							if($totalRecords > 0) 

							{

							for ($i = 0; $i < $totalRecords; $i++) 

							{

							$srno++;

							$row = &$rows[$i];



							?>				
							<tbody>
								<tr>
									<td class="align-middle">
										<label class="custom-control custom-checkbox">
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['pres_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									
                                    <td class="align-middle">
										
												<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['pres_id']; ?>"><?php echo $row['pres_emp_number']; ?></a>
                                                
                                                <br /><br />
                                                <a href="login-account.php?t=clinician&id=<?php echo encryptId($row['pres_id']); ?>" target="_blank" class="tag tag-green" >Login</a>
											
									</td>
                                    <td class="align-middle">
										
												<?php echo getTitleName($row['pres_title'])." ".ucfirst($row['pres_forename'])." ".ucfirst($row['pres_surname']); ?> 
											
									</td>
                                    
                                    <td class="align-middle">
										
												<?php echo getProfName($row['pres_profession']); ?>
											
									</td>
                                    
                                    <td class="align-middle">
										
												<?php echo $row['pres_email']; ?>
											
									</td>
                                    
                                    <td class="align-middle">
										
												<?php echo $row['pres_mobile']; ?>
											
									</td>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                   
                                    
                                   
                                    
                                   
                                    
                                    
									<td class="align-middle">
										<div class="btn-group align-top">
											<button class="btn btn-sm btn-white"  ><a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['pres_id']; ?>">View full record</a></button>
											
											<br />
                                           


											

											
										</div>
									</td>

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['pres_status'] == 1){ ?>

										<span class="tag tag-green">Enabled</span>

										<?php }else if($row['pres_status'] == 0){ ?>

										<span class="tag tag-red">Disabled</span>

										<?php } ?>
                                        
                                        
                                        
                                        
                                         &nbsp;<br /><?php if ($row['pres_approve']==0) echo "<font style='color:#F00'>Inactive Account</font>"; else echo "<font style='color:#090'>Active Account</font>"; ?>


											
										</div>
									</td>
								</tr>

								<?php

}

}

else

{

	?>

	<tr>

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="11"> - No Record found - </th>
	</tr>

	<?php

}



?>				
							
							</tbody>
											</table>

												<?php

												$pagingObject->displayLinks_Front(); 

												?>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Row -->

		</div>
	</div><!-- end app-content-->
</div>
				<input type="hidden" name="task" value="" />

				<input type="hidden" name="c" value="<?php echo $component?>" />
                
                <input type="hidden" name="Cid" value="<?php echo $_GET['Cid']?>" />

				<input type="hidden" name="hidCheckedBoxes" value="0" />

			</form>


             <?php } ?>

	<!-----------End Listing function------------------>

    

    

    <?php function createFormForPagesHtml(&$rows) {

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
	<h4 class="page-title">Clincians : <?php if ($_GET['task']=="edit") echo 'Edit'; else if ($_GET['task']=="add") echo 'Add'; else if ($_GET['task']=="detail") echo 'Detail'; ?></h4>
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
								

				<?php

						if ($_GET['task']=="edit")

						$task="saveedit";

						else

						$task="save";

				?>
   <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" enctype="multipart/form-data">
   
   <?php
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




if ($_GET['task']=="edit")
$employeeCode=$row['pres_emp_number'];
else
$employeeCode = generateEmployeeCode();

?>
   
   
   						<div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Employee Number </h3>
									</div>
									<div class="card-body pb-2">
										<div class="row row-sm">
											<div class="col-lg-6">
												<input class="form-control mb-4" placeholder="Enter Employee Number" name="txtEmpNumber" value="<?php echo $employeeCode ?>" id="txtEmpNumber" readonly="readonly" type="text">
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


<!------Professiona detail box------->

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
                            
                            
                            	 <?php if ($row['pres_regulatory_cert']!="") { ?>
                                <div style="height:5px"></div>
                                <span class="font-weight-semibold"><?php if ($row['pres_regulatory_cert']!="") { ?> <i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> <a href="<?php echo URL?>clinician/documents/<?php echo $row['pres_regulatory_cert']?>" style="color:#69C; text-decoration:underline" download>Regulatory Body Certificate</a><?php } ?></span>
                                <?php } ?>
					
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
                                                                        <div class="col-lg-2 col-md-3" >
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
                           <div class="form-group">
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
                                                                        <div class="col-lg-2 col-md-3" >
                                                                            <a  href="<?php echo URL?>clinician/documents/<?php echo $arrUnSerMes[$j]; ?>" download class="">
                                                                                
                                                                                <?php if ($type=="image") { ?>
                                                                                
                                                                                <span style="color:#69C; text-decoration:underline"><i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> Uploaded Certificate <?php echo $j+1?></span>
                                                                                <?php } else { ?>
                                                                                
                                                                                <span style="color:#69C; text-decoration:underline"><i class="fe fe-file-text sidemenu_icon" style="color:#F00"></i> Uploaded Certificate <?php echo $j+1?></span>
                                                                                <?php } ?>
                                                                                
                                                                            </a>
                                                                        </div>
                                                                        
                                                                      <?php } ?>
                                 
                                 
                                  <div id="cpd_addmore_2"></div>
                                             <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onclick="addMoreFile(2)" style="font-weight:500">+ Add More CPD Certificate</a></div>
                                 
                                         
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


<!----Professional detail box end----->

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
                                                
                                                (<?php if ($row['pres_email_verify']==1) echo '<font style="color:#090">(Verified)</font>'; else echo '<font style="color:#F00">(Un-Verified)</font>'; ?>
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
												
                                                
                                                <select class="form-control mb-4" name="txtEmpStatus" >
                                                <option value="">Select</option>
                                                <option value="PAYE" <?php if ($row['pres_employment_status']=="PAYE") echo "selected"; ?>>PAYE</option>
                                                <option value="Umbrella" <?php if ($row['pres_employment_status']=="Umbrella") echo "selected"; ?>>Umbrella</option>
                                                <option value="Self Employed" <?php if ($row['pres_employment_status']=="Self Employed") echo "selected"; ?>>Self Employed</option>
                                                <option value="Limited Company" <?php if ($row['pres_employment_status']=="Limited Company") echo "selected"; ?>>Limited Company</option>
                                                </select>
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
                                        
                                       
					</div>
                                       
		</div>
                                
                              
                                
                                
                                <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Enable/disable Clinicians account</h3>
									</div>
									<div class="card-body pb-2">
                                    
										
                                        
                                        <div class="form-group ">
						<div class="form-label">Enabled</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['pres_status']=="1" || $row['pres_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="0" <?php if($row['pres_status']==0 && $row['pres_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
                            </div>
                                  </div>	
                   				</div>
                                
                             </div>   
                                
                                
                             
                                
                                <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Activate registration and send email to Clinician</h3>
									</div>
									<div class="card-body pb-2">
                                    
										
                                        
                                        <div class="form-group ">
						
                        				 <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Current Status</label>
												<?php if ($row['pres_approve']==0) echo "<font style='color:#F00'>Inactive</font>"; else echo "<font style='color:#090'>Active</font>"; ?>
											</div>											
										</div>
                                        
                                        <div style="height:20px"></div>
                        
                        
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-radio">
                                                <input type="checkbox"  class="" name="ckEmail" id="ckEmail" value="1" >
                                                &nbsp;
                                                Send Welcome Email and Password to Clinician</label></div>
                                     </div>
                                  </div>	
                   				</div>
                                
                            
                <div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

<input type="hidden" name="pageId" value="<?php echo $row['pres_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>			            
                            	
            
            <script language="javascript">
			
			
			function showInd()
				{
					
					
				
					if ($("#rdoInd:checked").val() === "1")
					$("#cont_ind").show();
					else
					$("#cont_ind").hide();
					
				}
			
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
				txtEmpNumber: "required",
				cmbTitle: "required",
				txtForename: "required",
				txtSurname: "required",
				cmbProf: "required",
				txtAddress: "required",
				txtPostcode: "required",
				txtCity: "required"
				
							
			},
			messages: {
				txtEmpNumber: "Please enter employee number"
				
				
				}			
		});
		
		<?php if ($row['pres_id']!="") { ?>
		showInd();
		<?php } ?>             
            

</script>   

              
					
						</div>
					</div>
		</div>
                                
                                </div>

             <?php } ?>

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
	<h4 class="page-title">Clincians : Full detail</h4>
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

						<!--Page header-->
						<div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<h4 class="page-title"><span class="font-weight-normal text-muted mr-2">Employee Number #<?php echo $row['pres_emp_number']; ?></span></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
										
										<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['pres_id']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Edit Prescriber"> <i class="feather feather-edit"></i> </a>
										<!--<a href="#" class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </a>
										<a href="#" class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </a>-->
									</div>
								</div>
							</div>
						</div>
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
											<li class="ml-4"><a href="#tab5" class="active"  data-toggle="tab">Details</a></li>
											<li><a href="#tab6" data-toggle="tab">Prescriptions</a></li>
											<li><a href="#tab7"  data-toggle="tab">Messages</a></li>
											
											<li><a href="#tab11" data-toggle="tab">Logs</a></li>
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane active" id="tab5">
											<div class="card-body">
												<!--<h5 class="mb-4 font-weight-semibold"></h5>-->
												<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Prescriber Details</div>
									</div>
									<div class="card-body pt-2 pl-3 pr-3">
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
															 
															 
															 if (is_array($arrUnSerMes))
															 for ($j=0;$j<count($arrUnSerMes);$j++) {
																		
																		
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
                                                    
                                                    <tr>
														<td  valign="top">
															<span class="w-50">Signature</span>
														</td>
														<td>:</td>
														<td><?php if ($row['pres_signature']!="") { ?><img src="<?php echo URL?>signature/uploads/<?php echo $row['pres_signature']?>" style="max-width:300px" /> <?php } ?> </td>
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
                                                        
                                                        
                                                        
															<span class="font-weight-semibold"><?php echo $row['pres_email']; ?>
                                                            
                                                            (<?php if ($row['pres_email_verify']==1) echo '<font style="color:#090">Verified</font>'; else echo '<font style="color:#F00">Un-Verified</font>'; ?>)
                                                            
                                                            </span>
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
								</div>
								
							</div>
											</div>
										</div>
										<div class="tab-pane" id="tab6">
											<div class="card-body">
                        
							<div class="e-table">
                            
                            
                          
                            
							<!--<div class="row">
                            
                            
           
                           
                           					<div class="col-md-12 col-lg-12 col-xl-4">
                                            
                                            
														<div class="form-group">
															<label class="form-label">Search</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>" placeholder="Search by Order No.">
															</div>
														</div>
													</div>
                                                 
                                           <?php if ($_GET['ty']!='od') { ?>      
                                                 
                           
                           				
											
											
											
                                            <?php } ?>
											<div class="col-md-12 col-lg-12 col-xl-1">
												<div class="form-group mt-5">
                                                <input type="hidden" name="ty" value="<?php echo $_GET['ty']?>" />
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSearchByTitle"))
												   {
													   
												    ?>
                                                    <a href="?c=<?php echo $_GET['c']?>&ty=<?php echo $_GET['ty']?>" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php }
												   
												    ?>
												</div>
											</div>
										</div>-->
                                        
                               
								<div class="table-responsive table-lg mt-3">
                                <div style="height:22px"></div>
                                <h4><?php echo getUserNameByType('clinician',$_GET['id']); ?> has taken actions on following prescriptions</h4>
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												
                                                <th width="19%" class="border-bottom-0">Order No.</th>
                                                <th width="14%" class="border-bottom-0">Date</th>
                                                <th width="14%" class="border-bottom-0">Nominated Pharmacy</th>
                                                <th width="14%" class="border-bottom-0">Patient Name</th>
                                                <th width="14%" class="border-bottom-0">Age</th>
                                                <th width="14%" class="border-bottom-0">Biological <br /> Sex</th>
                                                 
                                                <th width="27%" class="border-bottom-0">Medical <br /> Condition</th>                                                
                                                <th width="25%" class="border-bottom-0">Medication</th>
                                                <th width="15%" class="border-bottom-0 w-20">Status</th>
                                               
                                                <th width="15%" class="border-bottom-0 w-20">Risk Level</th>
											</tr>
										</thead>
							<?php

							
					
						
						$sqlPres="select * from tbl_prescriptions where FIND_IN_SET(".$database->filter($_GET['id']).",pres_prescriber) order by pres_id desc";
						$resPres=$database->get_results($sqlPres);
						$totalRecords=count($resPres);
						
						if($totalRecords > 0) 

							{

						
						for ($k=0;$k<$totalRecords;$k++)
						{
							
							$rowPres=$resPres[$k];
							
							$sqlPatient="select * from tbl_patients where patient_id='".$rowPres['pres_patient_id']."'";
							$resPatient=$database->get_results($sqlPatient);
							$rowPatient=$resPatient[0];
							
						
						?>



									
							<tbody>
								<tr>
									
									
                                    <td class="align-middle">
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    <a href="?c=prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#69C; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a>
										
												
											
									</td>
                                    
                                    <td class="align-middle">
										
										<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
											
									</td>
                                    <td><?php echo getPharmacyName($rowPatient['patient_pharmacy']); ?></td>
                                    <td><?php echo $rowPatient['patient_first_name']." ".$rowPatient['patient_middle_name']." ".$rowPres['patient_last_name']; ?></td>
                                     <td><?php 
									
									$from = new DateTime($rowPatient['patient_dob']);
									$to   = new DateTime('today');
									echo $from->diff($to)->y;
									
									$rowPatient['patient_dob'] ?></td>
                                    <td><?php echo getGenderName($rowPatient['patient_gender']) ?></td>
                                    
                                    <td class="align-middle">
										
												<?php echo getConditionName($rowPres['pres_condition']); ?>
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle" >
										
												 <?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           }
														   
														   ?>
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<?php 
															
															echo getPrescriptionStatus_clinician($rowPres['pres_stage'],$rowPres['pres_id']); 
															?>
                                                            
                                                            <?php
if ($_GET['ty']=="od") { 															// Your date in the format "Y-m-d" (e.g., "2023-07-25")
$yourDate = $rowPres['pres_date'];

// Create DateTime objects for the current date and your date
$currentDate = new DateTime();
$yourDateTime = new DateTime($yourDate);

// Calculate the difference between the two dates
$interval = $currentDate->diff($yourDateTime);

// Get the difference in days
$daysDifference = $interval->days;

// Check if the difference is more than 3 days
if ($daysDifference > 3) {
    echo "<br><br><font style='color:red'>".$daysDifference. " days older</font>";
} 
}


?>
                                                           
                                                            
                                                           
											</div>
										</div>
									</td>
                                    
                                    <?php
									$overallRisk=$rowPres['pres_overall_risk'];
									if ($overallRisk==1) { $btnClr="green"; }
									else if ($overallRisk==2) { $btnClr="orange";  }
									else if ($overallRisk==3) { $btnClr="red";  }
									?>
                                   
                                    <td><div style="width:40px; height:40px" class="circle-<?php echo $btnClr; ?>"></div></td>
									

									
								</tr>
                                
                                

								<?php 

}

}

else

{

	?>

	<tr>

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="12"> - No Record found - </th>
	</tr>

	<?php

}



?>				
							
							</tbody>
											</table>

											

										</div>
									</div>
								</div>
										</div>
										<div class="tab-pane" id="tab7">
											<div class="card-body">
                                            
                                           
                                            <div class="row flex-lg-nowrap">
		<div class="col-12">
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
							<div class="e-table">
                            
                            <?php 
							$sqlMes = "SELECT * FROM tbl_messages,tbl_prescriptions WHERE pres_id=message_pres_id and pres_prescriber='".$_GET['id']."' and message_sender_type='Clinician' order by message_id desc";
							$resMes=$database->get_results($sqlMes);
							$totalRecordsM=count($resMes);
							
							?>
                            
                            
							
								<div class="table-responsive table-lg mt-3">
                                
                                 <h4><?php echo getUserNameByType('clinician',$_GET['id']); ?> has sent following messages</h4>
                                
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												
                                                <th width="22%" class="border-bottom-0">Subject</th>
                                                <th width="50%" class="border-bottom-0">Sent by</th>
                                                <th width="50%" class="border-bottom-0">Sent To</th>                                                
                                                <th width="12%" class="border-bottom-0">Last replied</th>
                                                <th width="12%" class="border-bottom-0 w-20">Action</th>
											</tr>
										</thead>
                                        <tbody>
							<?php

							if($totalRecordsM > 0) 

							{

							for ($i = 0; $i < $totalRecordsM; $i++) 

							{

							$srno++;

							$row = $resMes[$i];



							?>				
							
								<tr  class="trrow"  >
									
									
                                    <td class="align-middle" >
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    
									<div class="card-body pb-0 pt-3">
										<div>
											<label class="form-label mb-0"><?php echo $row['message_subject']; ?></label>
											<p class="" style="font-weight:<?php echo $readStatus?>">Order id: <?php echo $row['pres_id']; ?>, <?php echo getConditionName($row['pres_condition']); ?>, dt: <?php echo displayDateFormat($row['pres_date']); ?></p>
										</div>
									</div>	
												
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle">
										
												<?php echo getPrescriberName($row['pres_prescriber']); ?> &nbsp;  <span class="tag tag-green"> <?php echo $row['message_sender_type']; ?></span>
											
									</td>
                                    
                                     <td><?php 
									 
									 $sqlP="select * from tbl_prescriptions where pres_id='".$row['message_pres_id']."'";
									 $resP=$database->get_results($sqlP);
									 $rowP=$resP[0];
									 
									 
									 echo getUserNameByType("patient",$rowP['pres_patient_id']); ?></td>
                                    
                                    <td class="align-middle">
										
												<?php echo fn_formatDateTime($row['message_date']); ?>
											
									</td>
                                   
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<span class="tag tag-pink"><a href="?c=prescriptions&task=detail&id=<?php echo $row['message_pres_id']?>&message=1" class="tag tag-pink">View Message</a></span>
                                                            
                                                           <!-- <br /><br />
                                                            <a href="#" style="color:#69C">Response Required</a>-->
                                                          
                                                           
											</div>
										</div>
									</td>
									

									
								</tr>
                                
                                
                                

								<?php

}

}

else

{

	?>

	<tr>

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="11"> - No Record found - </th>
	</tr>

	<?php

}



?>				
							
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
										</div>
										
										
										
										<div class="tab-pane" id="tab11">
											<div class="card-body">
												
                                                
                                                <div class="table-responsive">
                                                
                                                <div style="height:22px"></div>
                                <h4><?php echo getUserNameByType('clinician',$_GET['id']); ?> log activities</h4>
													
													<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="miles-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0">Log Details</th>
																<th class="border-bottom-0">Date</th>
                                                               
															
																
															</tr>
														</thead>
														<tbody>
                                                        
                                                        <?php $sqlLogs="select * from tbl_logs where log_user_id='".$database->filter($_GET['id'])."' and log_user_type='clinician' order by log_id desc";
														$resLogs=$database->get_results($sqlLogs);
														if (count($resLogs)>0)
														{
															for ($j=0;$j<count($resLogs);$j++)
															{
																$rowLogs=$resLogs[$j];
														 ?>
															<tr>
																<td class="text-center"><?php echo $j+1; ?></td>
																<td>
																	<?php echo $rowLogs['log_activity']?>
																</td>
																<td><?php echo fn_formatDateTime($rowLogs['log_date_time'])?></td>
																
																
															</tr>
														<?php }
														}?>	
															
														</tbody>
													</table>
                                                    
                                                    
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
  