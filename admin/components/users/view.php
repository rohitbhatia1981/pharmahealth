		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$totalRecords = count($rows);

		if ($page != 1)    

			$srno = (PAGELIMIT * $page) - PAGELIMIT;

		else

			$srno = 0;

		

		$sqlmenuid = "select * from tbl_components where component_option='".$_GET['c']."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>		

<form name="adminForm" action="?c=<?php echo $component?>" method="get">
				<!-- App-content opened -->
				<div class="main-content">
					<div class="container">

						<!--Page header-->
						<div class="page-header d-lg-flex d-block">
							<div class="page-leftheader">
								<h4 class="page-title"><?php echo pageheading(); ?></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class=" btn-list">

								<?php if($permission['rights_add'] == 1) { ?>

<a href="index.php?c=<?php echo $component?>&task=add&Cid=<?php echo $menuid['component_headingid']; ?>" title="Add" class="btn btn-light"><i class="feather feather-plus"></i></a>

<?php } ?>							
								
					<a href="" class="btn btn-light" data-toggle="dropdown" role="button" title="Actions" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
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
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											
											<div class="col col-auto mb-4">
												<div class="form-group w-100">
									

													<div class="ml-auto">
											<div class="input-group">
												<input type="text" class="form-control" name="txtSearchByTitle" placeholder="Search by keyword" value="<?php echo $_GET['txtSearchByTitle'];?>">
												<span class="input-group-btn">
													<button class="btn btn-light br-tl-0 br-bl-0" >
														<i class="fa fa-search"></i>
													</button>
												</span>
											</div>
										</div>			
												</div>
											</div>
											<div class="col mb-4">
											</div>
											<div class="col col-auto mb-4">
											<div class="input-group">
											<div class="input-group-append">
											
										
													
												</div>
											</div>
											</div>
											</div>
										</div>
										<div class="e-table">
											<div class="table-responsive table-lg">
												<table class="table card-table table-vcenter text-nowrap border" id="example1">
													<thead>
														<tr>
															<th>
															<label class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input"  name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
															<span class="custom-control-label"></span>
															</label>
															</th>
															<th>User Name</th>
															<th>User Email</th>
															<th>User Group</th>
															<th>Register Date</th>
															<th width="7%">Status</th>
															
														</tr>
													</thead>
													<tbody>
													<?php
													for ($i = 0; $i < $totalRecords; $i++) 
														{
															$srno++;
															$row = &$rows[$i];
													?>
														<tr>
															<td class="align-middle w-5">
																<label class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);"  value="<?php echo $row['user_id']; ?>">
																	<span class="custom-control-label"></span>
																</label>
															</td>
															<td class="align-middle">

															<?php if($permission['rights_edit'] == 1) { ?>

														<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['user_id']; ?>&Gid=<?php echo $row['groupid']; ?>">

														<?php echo $row['username']; ?></a>

														<?php 

														}else 

														{

															echo $row['username'];

														}

														?>

																
															</td>
															<td class="align-middle">

													<?php echo $row['email']; ?></td>

													<?php $sql = "SELECT * FROM tbl_groups where group_id='".$row['groupid']."'";

													$Groups = $database->get_results( $sql );

													$Group = &$Groups[0];

													?>



													<td><?php echo $Group['group_name']; ?>

																
															</td>

															<td class="align-middle">
															<?php echo date('d F, Y', strtotime($row['registered_date'])); ?>
															</td>

															
															
															<td class="align-middle">
																<div class="d-flex">
																	
																	<div class="mt-1">
																		<?php if($row['user_status'] == 1){ ?>

																		<span class="tag tag-green">Enabled</span>

																		<?php }else if($row['user_status'] == 2){ ?>

																		<span class="tag tag-red">Disabled</span>

																		<?php } ?>
																	</div>
																</div>
															</td>
															
															
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
						<!-- End Row -->

					</div>
				</div><!-- end app-content-->
			</div>

				<input type="hidden" name="task" value="" />

				<input type="hidden" name="c" value="<?php echo $component?>" />

				<input type="hidden" name="hidCheckedBoxes" value="0" />

			</form>

             <?php } ?>

	<!-----------End Listing function------------------>

    

    

    <?php function createFormForPagesHtml(&$rows) {

	$row=array();

	global $component,$database;

	$row = &$rows[0];

	/* echo $row['company']; */

	$allcompany = explode(",",$row['company']);

	/* print_r ($allcompany); */

	

	$sqlmenuid = "select * from tbl_components where component_option='".$_GET['c']."'";

	$getmenuid = $database->get_results( $sqlmenuid );

	//print_r($getmenuid);

	$menuid = $getmenuid[0]; 

			

	/*Get all Groups*/

	$sqlGroup = "SELECT * FROM tbl_groups where group_published=1 and group_type='Admin'";

	$Groups = $database->get_results( $sqlGroup );

	$TotalGroups = @count($Groups);

	

	

	 ?>		

<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">User : <?php if (@count($row)>0) echo 'Edit'; else echo 'Add'; ?></h4>
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
   <form name="user-form" id="user-form" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" />
   <div class="card-body pb-2">
						

							<div class="form-group">
							<label class="form-label">User Group</label>
							<div class="row ">
								
									<select class="form-control" name="txtGroup" id="txtGroup" required  >
										<option label="Select Group"></option>
										<?php

							for ($i = 0; $i < $TotalGroups; $i++) 

								{

									$Group = $Groups[$i];

									

									?>

								<option value="<?php echo $Group['group_id']; ?>" <?php if($Group['group_id'] == $row['groupid'] || $Group['group_id'] == $_GET['Gid']){ echo 'selected';} ?>><?php echo $Group['group_name']; ?></option>

							<?php	

								}

							?> 

									
									</select>
							</div>
	</div>
					

							<div class="form-group">
								<label class="form-label">User Name</label>
								<input type="text" value="<?php echo $row['username']?>" name="txtUsername" id="txtUsername" class="form-control  mb-4" />
							</div>


							<div class="form-group">
								<label class="form-label">Name</label>
								<input type="text" value="<?php echo $row['name']?>" name="txtName" id="txtName" class="form-control  mb-4" />
							</div>

							<div class="form-group">
								<label class="form-label">Password</label>
								<input type="password" value="" name="txtPassword" id="txtPassword" required class="form-control  mb-4" />
							</div>
					
							<div class="form-group">
								<label class="form-label">Confirm Password</label>
								<input type="password" value="" name="txtCpassword" id="txtCpassword" required class="form-control  mb-4" />
							</div>


							<div class="form-group">
								<label class="form-label">User Email</label>
								<input type="email" value="<?php echo $row['email']?>" name="txtEmail" id="txtEmail" class="form-control  mb-4" />
							</div>


							<div class="form-group">
								<label class="form-label">Alternate Email</label>
								<input  type="email" value="<?php echo $row['alt_email']?>" name="txtAltemail" id="txtAltemail" class="form-control  mb-4" />
							</div>


							<div class="form-group">
								<label class="form-label">User Photo</label>
								<input  type="file" name="txtImage" id="txtImage" class="form-control  mb-4" />
							</div>


							<?php if($row['user_image'] != ''){ ?>
							<div class="form-group">
								<label class="form-label">Uploaded Photo</label>
								<img src="<?php echo URL; ?>classes/timthumb.php?src=<?php echo URL ?>images/userpic/<?php echo $row['user_image']; ?>&w=100&h=100&zc=0"><br/><br/><a href="?c=<?php echo $component?>&task=removeImg&ImageName=<?php echo $row['user_image']; ?>&lmageId=<?php echo $row['user_id']; ?>" class="btn red">Delete Photo</a>
							</div>
							<?php } ?>


							
							<div class="form-group">
								<label class="form-label">User Phone</label>
								<input type="number" value="<?php echo $row['telephone1']?>" name="txtPhone" id="txtPhone" class="form-control  mb-4" />
							</div>


							<div class="form-group">
								<label class="form-label">Address</label>
								<textarea type="text" name="txtAddress" id="txtAddress" class="form-control  mb-4" /><?php echo $row['address']?></textarea>
							</div>

							
						

							<div class="form-group ">
						<div class="form-label">Enabled</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['user_status']=="1" || $row['user_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="0" <?php if($row['user_status']==0 && $row['user_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>
				
						
					<div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					

<input type="hidden" name="pageId" value="<?php echo $row['page_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />
<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />
<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>					
								</div>
</div>
		

             <?php } ?>

			 

 <script>

	function Fieldforuser(val){

		alert(val);

	}

 </script>

    <script>

	

		$(document).ready(function(){

	 

	// user form validation

	

		$("#user-form").validate({

			// Rules for form validation

			rules: {

				txtGroup: {

						required: true

				},

				txtName: {

						required: true

				},

				txtUsername: {

						required: true,

						remote: {

						url: "<?php echo URL.FOLDER_ADMIN; ?>components/<?php echo $component; ?>/checkusername.php",

						data: {'user_id':'<?php echo $_GET['id']; ?>'},

						async:false,

						type: "post"

					 }

				},

				txtEmail: {

					email: true,

					required: true,

					remote: {

                    url: "<?php echo URL.FOLDER_ADMIN; ?>components/<?php echo $component; ?>/checkemail.php",

					data: {'user_id':'<?php echo $_GET['id']; ?>'},

                    async:false,

                    type: "post"

                 }

				},

				

				txtCpassword: {

					required: true,

					equalTo: "#txtPassword"

				},

				

				

			},

			// Messages for form validation

			messages: {

				txtGroup: {

						required: 'Please select user group '						

					},

				txtName: {

						required: 'Please enter full name'						

					},

				txtUsername: {

						required: 'Please enter username',

						remote: "Username already in use!"

					},

				txtEmail: {

					required: 'Please enter the email address',

					txtEmail: 'Please enter a VALID email address',

					remote: "Email already in use!"

				},

				

				txtCpassword: {

					required: 'Please confirm password',

					equalTo: 'Password does not match!'

				},

				txtPhone: {

						required: 'Please enter the phone number'						

				},

				

			}

		});

	

	});

	

	</script>