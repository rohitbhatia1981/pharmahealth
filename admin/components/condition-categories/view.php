		

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
							<div class="form-group w-200">
									

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
								<div class="table-responsive table-lg mt-3">

								

									<table class="table table-bordered border-top text-nowrap" id="example1">
										<thead>
											<tr>
												<th class="border-bottom-0 wd-5">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th class="border-bottom-0 w-70">Title</th>
												
												<th class="border-bottom-0 w-20">Actions</th>
												<th class="border-bottom-0 w-20">Status</th>
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
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['condition_categories_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									<td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['condition_categories_id']; ?>"><?php echo $row['condition_categories_name']; ?></a>
											</div>
										</div>
									</td>
									<td class="align-middle">
										<div class="btn-group align-top">
											<button class="btn btn-sm btn-white"  ><a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['condition_categories_id']; ?>">Edit</a></button>
											



											

											
										</div>
									</td>

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['condition_categories_status'] == 1){ ?>

										<span class="tag tag-green">Enabled</span>

										<?php }else if($row['condition_categories_status'] == 0){ ?>

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

		<th colspan="4" class="border-bottom-0 w-10" style="text-align:center;"> - No Record found - </th>
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

				<input type="hidden" name="hidCheckedBoxes" value="0" />

			</form>


             <?php } ?>

	<!-----------End Listing function------------------>

    

    

    <?php function createFormForPagesHtml(&$rows) {

	$row=array();

	global $component, $database;

	$row = &$rows[0];

	

	$sqlmenuid = "select * from tbl_components where component_option='".$_GET['c']."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>
	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Condition Category : <?php if (@count($row)>0) echo 'Edit'; else echo 'Add'; ?></h4>
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
								<label class="form-label">Categories Title</label>
								<input class="form-control mb-4" type="text" name="conditioncat_title" id="conditioncat_title" value="<?php echo $row['condition_categories_name']?>" required>
							</div>
				

							<div class="form-group ">
						<div class="form-label">Enabled</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['condition_categories_status']=="1" || $row['condition_categories_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="0" <?php if($row['condition_categories_status']==0 && $row['condition_categories_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>
				
						
					<div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

<input type="hidden" name="conditionCat_id" value="<?php echo $row['condition_categories_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>					
								</div>


             <?php } ?>

      <script>


	$(document).ready(function(){

	

		

		// City form validation

	

		$("#pages").validate({

			// Rules for form validation

			rules: {

				page_title: {

						required: true

				}				

			},

			// Messages for form validation

			messages: {

				page_title: {

						required: 'Please enter page title'

						

					}				

			}

		});

	

	

	});

	

	</script>  