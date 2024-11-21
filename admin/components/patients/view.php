		

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
													<input type="text" class="form-control" name="txtSearchByTitle" placeholder="Patient ID, Name, DOB, Email" value="<?php echo $_GET['txtSearchByTitle'];?>">
                                                   
                                                  
												</div>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter by ID Verification Status:</label>
                                                    
                                                  
                                                    
													<select name="cmbCategory"  class="form-control custom-select select2" data-placeholder="All">
														<option label="All"></option>
                                                        <option value="0" <?php if ($_GET['cmbCategory']==1) echo "selected"; ?>>Pending</option>
                                                        <option value="1" <?php if ($_GET['cmbCategory']==2) echo "selected"; ?>>Completed</option>
                                                        <option value="2" <?php if ($_GET['cmbCategory']==3) echo "selected"; ?>>Rejected</option>
														
													</select>
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
												<th width="4%" class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th width="3%" class="border-bottom-0">ID</th>
                                                <th width="6%" class="border-bottom-0">Patient Name</th>
                                                <th width="13%" class="border-bottom-0">Gender</th>
                                                <th width="11%" class="border-bottom-0">DOB</th>
                                                
                                                <th width="11%" class="border-bottom-0">Email</th>
                                                
                                                <th width="11%" class="border-bottom-0">Phone</th>
                                                <th width="8%" class="border-bottom-0">Nominated Pharmacy</th>
                                                
                                               
                                                
                                                
                                                <th width="11%" class="border-bottom-0">ID Verification</th>
												
												<th width="8%" class="border-bottom-0 w-20">Actions</th>
												<th width="14%" class="border-bottom-0 w-20">Status</th>
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
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['page_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									<td class="align-middle">
										
												<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>
                                                <br /><br />
                                                <a href="login-account.php?t=patient&id=<?php echo encryptId($row['patient_id']); ?>" target="_blank" class="tag tag-green" >Login</a>
											
									</td>
                                    <td class="align-middle">
										
												<?php echo $row['patient_title']." ".$row['patient_first_name']." ".$row['patient_middle_name']." ".$row['patient_last_name']; ?> 
											
									</td>
                                      <td class="align-middle">
										
												<?php echo getGenderName($row['patient_gender']); ?>
											
									</td>
                                    
                                     <td class="align-middle">
										
												<?php echo fn_GiveMeDateInDisplayFormat($row['patient_dob']); ?> 
											
									</td>
                                    
                                    <td class="align-middle">
										
												<?php echo $row['patient_email']; ?>
											
									</td>
                                    
                                    <td class="align-middle">
										
												<?php echo $row['patient_phone']; ?>
											
									</td>
                                    
                                     <td class="align-middle">
										
												<?php echo getPharmacyName($row['patient_pharmacy']); ?>
											
									</td>
                                    
                                  
                                    
                                    
                                    
                                   
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												<?php if ($row['patient_kyc']==0) { ?>
															<span class="badge badge-danger-light">Pending</span>
                                                            <?php } else if ($row['patient_kyc']==1) { ?>
                                                            <span class="badge badge-danger-light">Verified</span>
                                                            <?php } else if ($row['patient_kyc']==2) { ?>
                                                            <span class="badge badge-danger-light">Rejected</span>
                                                            <?php } ?>
											</div>
										</div>
									</td>
									<td class="align-middle">
										<div class="btn-group align-top">
											<button class="btn btn-sm btn-white"  ><a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>">View full record</a></button>
                                          
											



											

											
										</div>
									</td>

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['patient_status'] == 1){ ?>

										<span class="tag tag-green">Enabled</span>

										<?php }else if($row['patient_status'] == 0){ ?>

										<span class="tag tag-red">Disabled</span>

										<?php } ?>


											
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
	<h4 class="page-title">Patient : <?php if ($_GET['task']=="edit") echo 'Edit'; else if ($_GET['task']=="add") echo 'Add'; else if ($_GET['task']=="detail") echo 'Detail'; ?></h4>
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
								<div class="card">

				<?php

						if ($_GET['task']=="edit")

						$task="saveedit";

						else

						$task="save";

				?>
   <form name="pages" id="pages" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" />
   <div class="card-body pb-2">
						

					<div class="form-group">
								<label class="form-label">Title *</label>
								<select class="form-control" name="txtTitle" id="txtTitle" required >
										<option label="Select Title"></option>
										<?php
				$query = "SELECT * FROM tbl_titles where title_status=1";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {

									?>

								<option value="<?php echo $value['title_name']; ?>"  <?php if($row['patient_title'] == $value['title_name']) {	echo 'selected="selected"';}?>  ><?php echo $value['title_name']; ?></option>

							<?php	

							}

							?> 

									
									</select>
							</div>
                            
                           <div class="form-group">
								<label class="form-label">First Name *</label>
								<input class="form-control mb-4" type="text" id="txtFirstName" name="txtFirstName" value="<?php echo $row['patient_first_name']?>" required>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Middle Name</label>
								<input class="form-control mb-4" type="text" id="txtMiddleName" name="txtMiddleName" value="<?php echo $row['patient_middle_name']?>">
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Last Name *</label>
								<input class="form-control mb-4" type="text" id="txtLastName" name="txtLastName" value="<?php echo $row['patient_last_name']?>" required>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Pharmacy *</label>
								<select class="form-control" name="cmbPharmacy" id="cmbPharmacy" required >
										<option label="Select Pharmacy"></option>
										<?php
				$query = "SELECT * FROM tbl_pharmacies where pharmacy_status=1";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {

									?>

								<option value="<?php echo $value['pharmacy_id']; ?>"  <?php if($row['patient_pharmacy'] == $value['pharmacy_id']) {	echo 'selected="selected"';}?>  ><?php echo $value['pharmacy_name']; ?></option>

							<?php	

							}

							?> 

									
									</select>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Email *</label>
								<input class="form-control mb-4" type="email" id="txtEmail" name="txtEmail" value="<?php echo $row['patient_email']?>" required>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Password  <?php if ($_GET['task']=="edit") echo '(Enter new password if you want to change it)'; ?></label>
								<input class="form-control mb-4" type="text" id="txtPassword" name="txtPassword" value="" <?php if ($_GET['task']=="add") echo 'required'; ?>>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Phone *</label>
								<input class="form-control mb-4" type="text" id="txtPhone" name="txtPhone" value="<?php echo $row['patient_phone']?>" required>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Gender *</label>
								<select class="form-control" name="cmbGender" id="cmbGender" required >
										<option label="Select Gender"></option>
										<?php
				$query = "SELECT * FROM tbl_gender where gender_status=1";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {

									?>

								<option value="<?php echo $value['gender_id']; ?>"  <?php if($row['patient_gender'] == $value['gender_id']) {	echo 'selected="selected"';}?>  ><?php echo $value['gender_name']; ?></option>

							<?php	

							}

							?> 

									
									</select>
							</div>
                            
                           <?php
						    
							if ($row['patient_dob']!="")
							{
						    $pDob=$row['patient_dob']; 
							$arDob=explode("-",$pDob);
							}
							?>
					
                    		<div class="form-group">
								<label class="form-label">Date of Birth *</label>
                                
                                <div class="row">
									<div class="col-lg-2 col-md-2">
									<select class="form-control custom-select select2" name="cmbDate" id="cmbDate" required >
										<option value="">Select Date</option>
                                       <?php for ($k=1;$k<=31;$k++) 
									   {
										   if ($k<10)
										   $prefix="0";
										   else
										   $prefix="";
										   ?>
                                        <option value="<?php echo $prefix.$k; ?>" <?php if ($prefix.$k==$arDob[2]) echo "selected"; ?>><?php echo $prefix.$k; ?></option>				
                                       <?php } ?>
									</select>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
									<select class="form-control custom-select select2" name="cmbMonth" id="cmbMonth" required >
										<option value="">Select Month</option>
                                       
										<?php for ($r = 1; $r <= 12; $r++){
                                            $month_name = date('F', mktime(0, 0, 0, $r, 1, 2023));
											if ($r==$arDob[1]) $selected="selected"; else $selected="";
                                            echo '<option value="'.$r.'" '.$selected.'>'.$month_name.'</option>';
                                        }?>				
									</select>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
									<select class="form-control custom-select select2" name="cmbYear" id="cmbYear" required >
										<option value="">Select Year</option>
                                        <?php
										$year=date("Y");
										 for ($y=$year-18;$y>=$year-118;$y--) { ?>
                                        <option value="<?php echo $y; ?>" <?php if ($y==$arDob[0]) echo "selected"; ?>><?php echo $y; ?></option>							
                                        <?php } ?>
									</select>
                                    </div>
                                </div>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Address 1</label>
								<input class="form-control mb-4" type="text" id="txtAddress1" name="txtAddress1" value="<?php echo $row['patient_address1']?>">
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Address 2</label>
								<input class="form-control mb-4" type="text" id="txtAddress2" name="txtAddress2" value="<?php echo $row['patient_address2']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Postcode *</label>
								<input class="form-control mb-4" type="text" id="txtPostCode" name="txtPostCode" value="<?php echo $row['patient_postcode']?>" required>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">City *</label>
								<input class="form-control mb-4" type="text" id="txtCity" name="txtCity" value="<?php echo $row['patient_city']?>" required>
							</div>
                            
                            

						<div class="form-group ">
						<div class="form-label">KYC Status</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoKYC" id="rdoKYC" value="1" <?php if($row['patient_kyc']=="1" || $row['patient_kyc']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoKYC" id="rdoKYC" value="0" <?php if($row['patient_kyc']==0 && $row['patient_kyc']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>	

							
			
					



						<div class="form-group ">
						<div class="form-label">Enabled</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['patient_status']=="1" || $row['patient_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="0" <?php if($row['patient_status']==0 && $row['patient_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>
				
						
					<div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

<input type="hidden" name="pageId" value="<?php echo $row['patient_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>					
								</div>
                                
                                
        <script language="javascript">

$("#adminForm").validate({
			rules: {
				txtFirstName: "required"
				
			},
			messages: {
				txtFirstName: "Please enter patient first name",
				
				
				}			
		});

</script>      
                                


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
<style>
.circle-red {
  width: 40px;
  height: 40px;
  background: red;
  border-radius: 50%
}
</style>
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Patient Record</h4>
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
								<h4 class="page-title"><span class="font-weight-normal text-muted mr-2">Patient ID #<?php echo $row['patient_id'] ?></span></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
										
										<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['patient_id']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Edit Patient"> <i class="feather feather-edit"></i> </a>
										<!--<a href="#" class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </a>
										<a href="#" class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </a>-->
									</div>
								</div>
							</div>
						</div>
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-3 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Patient Details</div>
									</div>
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table">
												<tbody>
													<tr>
														<td>
															<span class="w-50">Patient ID</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['patient_id'] ?></span>
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php $name=$row['patient_first_name'] ?>
                                                            <?php 
															if ($row['patient_middle_name']!="")
															$name=$name." ".$row['patient_middle_name'];
															
															if ($row['patient_last_name']!="")
															$name=$name." ".$row['patient_last_name'];
															
															echo $name;
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">DOB</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo fn_GiveMeDateInDisplayFormat($row['patient_dob']); ?> </span>
														</td>
													</tr>
													
													
													<tr>
														<td>
															<span class="w-50">Gender</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getGenderName($row['patient_gender']); ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Address</span>
														</td>
														<td>:</td>
														<td>
                                                        <?php
														$address=$row['patient_address1'];
														if ($row['patient_address2']!="")
														$address.=" ".$row['patient_address2'];
														$address.=", ".$row['patient_city'];
														$address.=", ".$row['patient_postcode'];
														
														
														?>
															<span class="font-weight-semibold"><?php echo $address; ?></span>
														</td>
													</tr>
                                                    
													
                                                    <tr>
														<td>
															<span class="w-50">Email</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['patient_email']; ?></span>
														</td>
													</tr>
                                                    <tr>
														<td>
															<span class="w-50">Phone </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['patient_phone']; ?></span>
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Nominated Pharmacy</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getPharmacyName($row['patient_pharmacy']); ?></span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span class="w-50">KYC Status</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<?php if ($row['patient_kyc']==0) { ?>
															<span class="badge badge-danger-light">Pending</span>
                                                            <?php } else if ($row['patient_kyc']==2) { ?>
                                                            <span class="badge badge-danger-light">Verified</span>
                                                            <?php } else if ($row['patient_kyc']==3) { ?>
                                                            <span class="badge badge-danger-light">Rejected</span>
                                                            <?php } ?>
                                                            
														</td>
													</tr>
                                                    <tr>
														<td>
															<span class="w-50">Status</span>
														</td>
														<td>:</td>
														<td>
                                                        <?php if ($row['patient_status']==1) $status="Active"; else $status="Blocked"; ?>
															<span class="badge badge-primary"><?php echo $status; ?></span>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
								
							</div>
							<div class="col-xl-9 col-md-12 col-lg-12">
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
											<li class="ml-4"><a href="#tab5" class="active"  data-toggle="tab">Orders</a></li>
											<li><a href="#tab6" data-toggle="tab">Messages</a></li>
											<li><a href="#tab7"  data-toggle="tab">Medical Background</a></li>
											<li><a href="#tab8" data-toggle="tab">GP Details</a></li>
											
											<li><a href="#tab10" data-toggle="tab">Payments</a></li>
											<li><a href="#tab11" data-toggle="tab">Logs</a></li>
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane active" id="tab5">
											<div class="card-body">
												<!--<h5 class="mb-4 font-weight-semibold"></h5>-->
												<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												<th width="19%" class="border-bottom-0">Order No.</th>
												<th width="14%" class="border-bottom-0">Date</th>
                                                
                                               <!-- <th width="14%" class="border-bottom-0">Patient Name</th>  
                                                <th width="14%" class="border-bottom-0">Age</th> 
                                                <th width="14%" class="border-bottom-0">Biological Sex</th>  -->                                           
                                                <th width="27%" class="border-bottom-0">Medical Condition</th>                                                
                                                <th width="25%" class="border-bottom-0">Medication</th>
                                                <th width="15%" class="border-bottom-0 w-20">Status</th>
                                                <th width="15%" class="border-bottom-0 w-20">Risk Level</th>
											</tr>
										</thead>
							<?php

							
					
						
						$sqlPres="select * from tbl_prescriptions where pres_patient_id='".$database->filter($_GET['id'])."' and pres_stage>0 ";
						$resPres=$database->get_results($sqlPres);
						$totalRecords=count($resPres);
						
						if($totalRecords > 0) 

							{

						
						for ($k=0;$k<$totalRecords;$k++)
						{
							
							$rowPres=$resPres[$k];
						
						?>



									
							<tbody>
								<tr>
									
									
                                    <td class="align-middle">
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    <a href="?c=prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a>
										
												
											
									</td>
                                    
                                    
                                    <td class="align-middle">
										
										<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
											
									</td>
                                    
                                    
                                    
                                    
                                   <!-- <td><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></td>
                                    <td><?php 
									
									$from = new DateTime($rowPres['patient_dob']);
									$to   = new DateTime('today');
									echo $from->diff($to)->y;
									
									$rowPres['patient_dob'] ?></td>
                                    <td><?php echo getGenderName($rowPres['patient_gender']) ?></td>-->
                                   
                                    <td class="align-middle">
										
												<?php echo getConditionName($rowPres['pres_condition']); ?>
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle">
										
												 <?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           } ?>
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<?php echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?>
                                                            
                                                            <?php //echo $val; ?>
                                                            
                                                           
											</div>
										</div>
									</td>
                                     <td><div class="circle-red"></div></td>
									

									
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
										<div class="tab-pane" id="tab6">
											<div class="card-body">
							
                            
                            <?php 
							$sqlMes = "SELECT * FROM tbl_messages,tbl_prescriptions WHERE pres_id=message_pres_id and pres_patient_id='".$_GET['id']."' and message_sender_type='Patient' order by message_id desc";
							$resMes=$database->get_results($sqlMes);
							$totalRecordsM=count($resMes);
							
							?>
                            
                            
							
								<div class="table-responsive table-lg mt-3">
                                
                                 <!--<h4><?php echo getUserNameByType('patient',$_GET['id']); ?> has sent following messages</h4>-->
                                
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												
                                                <th width="22%" class="border-bottom-0">Subject</th>
                                               
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
                                    
                                    
                                    
                                    
                                    
                                     <td><?php 
									 
									 $sqlP="select * from tbl_prescriptions where pres_id='".$row['message_pres_id']."'";
									 $resP=$database->get_results($sqlP);
									 $rowP=$resP[0];
									 
									 
									 echo getUserNameByType("clinician",$rowP['pres_prescriber']); ?></td>
                                    
                                    <td class="align-middle">
										
												<?php echo fn_formatDateTime($row['message_date']); ?>
											
									</td>
                                   
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<span class="tag tag-pink"><a href="?c=prescriptions&task=detail&id=<?php echo $_GET['id']?>&message=1" class="tag tag-pink">View Message</a></span>
                                                            
                                                           <!-- <br /><br />
                                                            <a href="#" style="color:#06F">Response Required</a>-->
                                                          
                                                           
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
										<div class="tab-pane" id="tab7">
											<div class="card-body">
                                            
                                            <?php
											$sqlData="select * from tbl_medical_background where mb_patient_id='".$database->filter($_GET['id'])."'";
											$resData=$database->get_results($sqlData);
											if (count($resData)>0)
											{
												$rowData=$resData[0];
												$alergyToggle=$rowData['mb_allergies_toggle'];
												$alergy=$rowData['mb_allergies'];
												$conditionToggle=$rowData['mb_condition_toggle'];
												$condition=$rowData['mb_conditions'];
												$medicationToggle=$rowData['mb_medication_toggle'];
												$medication=$rowData['mb_medications'];
												$mb_other_info=$rowData['mb_other_info'];
											}
										?>
                                            
                                            <div class="table-responsive">
											<table class="table row table-borderless w-100 m-0 text-nowrap">
												<tbody class="col-lg-12 col-xl-12 pb-2 mb-4" style="border-bottom:1px solid #d7d7d7">
												<tr>
													<td colspan="2"><h5 class="font-weight-semibold mb-0">Known Allergies</h5></td>
												</tr>
                                                <?php if ($alergyToggle!="") { ?>
												<tr>
													<td>Do you have any known allergies?</td>
                                                    <td><span class="font-weight-semibold"><?php if ($alergyToggle==1) echo "Yes"; else echo "No"; ?></span></td>
												</tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="2"> <span class="font-weight-semibold" style="color:#03C; font-size:15px"><?php if ($alergy!="") echo $alergy; else echo "-"; ?></span> </td>
                                                 </tr>
                                            </tbody>
                                                    
                                                    <tbody class="col-lg-12 col-xl-12 pb-2 mb-4" style="border-bottom:1px solid #d7d7d7">
												<tr>
													<td colspan="2"><h5 class="font-weight-semibold mb-0">Medical Conditions</h5></td>
												</tr>
                                                 <?php if ($conditionToggle!="") { ?>
												<tr>
													<td>Have you been diagnosed with any medical conditions?</td>
                                                    <td><span class="font-weight-semibold"><?php if ($conditionToggle==1) echo "Yes"; else echo "No"; ?></span></td>
												</tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="2"> <span class="font-weight-semibold" style="color:#03C; font-size:15px"><?php if ($condition!="") echo $condition; else echo "-"; ?></span> </td>
                                                 </tr>
                                            </tbody>
                                                
                                                <tbody class="col-lg-12 col-xl-12 pb-2 mb-4" style="border-bottom:1px solid #d7d7d7">
												<tr>
													<td colspan="2"><h5 class="font-weight-semibold mb-0">Current Medications</h5></td>
												</tr>
                                                 <?php if ($medicationToggle!="") { ?>
												<tr>
													<td>Are you currently taking any medicines?</td>
                                                    <td><span class="font-weight-semibold"><?php if ($medicationToggle==1) echo "Yes"; else echo "No"; ?></span></td>
												</tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="2"> <span class="font-weight-semibold" style="color:#03C; font-size:15px"><?php if ($medication!="") echo $medication; else echo "-"; ?></span> </td>
                                                 </tr>
                                            </tbody>
                                                
                                                <tbody class="col-lg-12 col-xl-12 pb-2 mb-4">
												<tr>
													<td><h5 class="font-weight-semibold mb-0">Other Relevant Information</h5></td>
												</tr>
												
                                                <tr>
                                                    <td> <span class="font-weight-semibold" style="color:#03C; font-size:15px"><?php if ($mb_other_info!="") echo $mb_other_info; else echo "-"; ?></span> </td>
                                                 </tr>
                                            </tbody>
												
											</table>
										</div>
                                            
												
											</div>
										</div>
                                        
                                        <?php
										$sqlGp="select * from tbl_patient_gps where pg_patient_id='".$database->filter($_GET['id'])."'";
										$resGp=$database->get_results($sqlGp);
										$row=$resGp[0];
										?>
                                        
										<div class="tab-pane" id="tab8">
											<div class="card-body">
												<div class="table-responsive">
													
                                                     <?php if ($row['pg_option']==1) { ?>  
                                             
                                            	<div class="table-responsive">
											<table class="table" style="font-size:16px">
												<tbody>
													
													<tr>
														<td >
															<span class="w-50">GP Practice</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php 
															$arrGP=array();
															$arrGP=explode(",",$row['pg_gp']);
															
															echo $gp_name=$arrGP[0]; ?>
                                                           
                                                            </span>
														</td>
													</tr>
                                                    
                                                   <?php
												    $sqlGp="select * from tbl_gps where gp_name like '%".$database->filter($gp_name)."%'";
												   $resGp=$database->get_results($sqlGp);
												   $rowGp=$resGp[0];
												   ?>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Address</span>
														</td>
														<td>:</td>
														<td>
                                                       
															<span class="font-weight-semibold"><?php echo $rowGp['gp_address']; ?></span>
														</td>
													</tr>
                                                    <tr>
														<td>Telephone</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowGp['gp_phone']; ?></span>
														</td>
													</tr>
													
                                                    <tr>
														<td>
															<span class="w-50">Email</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowGp['gp_email']; ?></span>
														</td>
													</tr>
                                                    
                                                   
                                                    
													
                                                    
												</tbody>
											</table>
										</div>
                                        
                                        <?php } else if ($row['pg_option']==2) { ?>
                                        
                                        <div class="table-responsive">
											<table class="table" style="font-size:16px">
												<tbody>
													
													<tr>
														<td >
															<span class="w-50">GP Practice</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php 
															echo $row['pg_gp_name'];
															 ?>
                                                           
                                                            </span>
														</td>
													</tr>
                                                    
                                                 
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Address</span>
														</td>
														<td>:</td>
														<td>
                                                       
															<span class="font-weight-semibold"><?php echo $row['pg_gp_address']; ?></span>
														</td>
													</tr>
                                                    <tr>
														<td>Telephone</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pg_gp_phone']; ?></span>
														</td>
													</tr>
													
                                                    <tr>
														<td>
															<span class="w-50">Email</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['pg_gp_email']; ?></span>
														</td>
													</tr>
                                                    
                                                  
                                                    
													
                                                    
												</tbody>
											</table>
										</div>
                                        
                                        <?php }  else if ($row['pg_option']==3) { ?>
                                         <div>
                                        	
                                             <h5>I do not have a registered GP in the UK</h5>
                                         </div>
                                         <?php }  else if ($row['pg_option']==5) { ?>
                                         <div>
                                        	
                                             <h5> I will take responsibility to inform my GP</h5>
                                         </div>
                                         <?php } ?>
                                         
                                         <table>
                                         
                                         </table>
                                            
										</div>
													
												</div>
											</div>
										
										
										<div class="tab-pane" id="tab10">
											<div class="card-body">
                                            
                                            <div class="table-responsive table-lg mt-3">
                                  <?php 
							   	$sql = "SELECT payment_id, payment_date, payment_amount,payment_pres_id,payment_status FROM tbl_prescriptions,tbl_payments WHERE pres_id=payment_pres_id and pres_patient_id='".$database->filter($_GET['id'])."' order by payment_id desc  ";
								$res=$database->get_results($sql);
								$totalRecordsP=count($res);
								
								
							   
							   
							    ?>
                               
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												
                                                <th width="19%" class="border-bottom-0">Invoice Id</th>
                                                <th width="27%" class="border-bottom-0">Amount Paid</th>                                                
                                                <th width="25%" class="border-bottom-0">Payment Date</th>
                                                <th width="25%" class="border-bottom-0">Order Id</th>
                                                <th width="15%" class="border-bottom-0 w-20">Status</th>
                                                <th width="14%" class="border-bottom-0"></th>
                                              
											</tr>
										</thead>
					
									
							<tbody>
                            
                            <?php
							if($totalRecordsP > 0) 
							{

						
									for ($k=0;$k<$totalRecordsP;$k++)
									{
										
										$rowPres=$res[$k];
							?>
								<tr>
									
									<td class="align-middle">
                                    
                                   
                                    <a href="#" style="color:#06F; text-decoration:underline">#<?php echo $rowPres['payment_id']?></a>
										
												
											
									</td>
                                    <td class="align-middle">
                                    
                                   <?php echo CURRENCY.$rowPres['payment_amount']?>
										
												
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle">
										
												<?php echo  date("d/m/Y",strtotime($rowPres['payment_date'])); ?>
											
									</td>
                                    
                                     <td class="align-middle">
										
										<a href="?c=patient-prescriptions&task=detail&id=<?php echo $rowPres['payment_pres_id']?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['payment_pres_id']?></a>		
											
									</td>
                                    
                                    <td class="align-middle">
										<?php if ($rowPres['payment_status']==1) { ?>
										<span class="tag tag-green">Paid</span>
                                        <?php } ?>		 
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
														<a href="#" class="action-btns" data-toggle="modal" data-target="#viewsalarymodal">
																<i class="feather feather-file text-primary" data-toggle="tooltip" data-placement="top" title="View"></i>
															</a>
															
															<a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="Download">
																<i class="feather feather-download  text-secondary"></i>
															</a>
															
															
															
                                                            
                                                           
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
										<div class="tab-pane" id="tab11">
											<div class="card-body">
												<div class="table-responsive">
                                                
                                                <div style="height:22px"></div>
                             
													
													<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="miles-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0">Log Details</th>
																<th class="border-bottom-0">Date</th>
                                                               
															
																
															</tr>
														</thead>
														<tbody>
                                                        
                                                        <?php $sqlLogs="select * from tbl_logs where log_user_id='".$database->filter($_GET['id'])."' and log_user_type='patient' order by log_id desc";
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
  