		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$totalRecords = count($rows);

		if ($page != 1)    

			$srno = (1 * $page) - 1;

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
							<div class="col col-auto mb-4">
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
											</div>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1">
										<thead>
											<tr>
												<th class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th class="border-bottom-0 w-60">Title</th>
                                                <th class="border-bottom-0 w-60">Category</th>
												
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
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['condition_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									<td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['condition_id']; ?>"><?php echo $row['condition_title']; ?></a>
											</div>
										</div>
									</td>
                                     <td><?php echo getCategoryName_multi($row['condition_category']); ?></td>
									<td class="align-middle">
										<div class="btn-group align-top">
											<button class="btn btn-sm btn-white"  ><a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['condition_id']; ?>">Edit</a></button>
											



											

											
										</div>
									</td>
                                   

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['condition_status'] == 1){ ?>

										<span class="tag tag-green">Enabled</span>

										<?php }else if($row['condition_status'] == 0){ ?>

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

		<th class="border-bottom-0 w-10" colspan="5" style="text-align:center;"> - No Record found - </th>
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

	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>

	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Conditions : <?php if (@count($row)>0) echo 'Edit'; else echo 'Add'; ?></h4>
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
   <form name="frmApp" id="frmApp" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" />
   <div class="card-body pb-2">
						

							<div class="form-group">
								<label class="form-label">Title *</label>
								<input class="form-control mb-4" type="text" name="txtTitle" value="<?php echo $row['condition_title']?>" required>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Sub Title *</label>
								<input class="form-control mb-4" type="text" name="txtSubTitle" value="<?php echo $row['condition_sub_title']?>" required>
							</div>
                            
                            <div class="form-group">
	<label class="form-label">Select Condition Category</label>
	<select multiple="multiple" name="ckCategory[]" class="multi-select">
    
     <?php
								$query = "SELECT * FROM tbl_condition_categories order by condition_categories_name";
								$results = $database->get_results( $query );
											
										foreach ($results as $value)
										 {
											 
											 if ($row['condition_category']!="")
											{
												$strCategory=explode(",",$row['condition_category']);
											}
											?>
										<option value="<?php echo $value['condition_categories_id']; ?>" <?php if ($_GET['task']=="edit") { if (@in_array($value['condition_categories_id'],$strCategory)) echo 'selected'; } ?>><?php echo $value['condition_categories_name']; ?></option>
										 <?php
                                        }
                                        ?>
		
	</select>
</div>
                            
                            <!--<div class="form-group">
                            
                            	<div class="form-group m-0"> <div class="form-label">Select Category</div> <div class="custom-controls-stacked"> 
                                
                                <?php
								$query = "SELECT * FROM tbl_condition_categories order by condition_categories_name";
								$results = $database->get_results( $query );
											
										foreach ($results as $value) {
											
										if ($row['condition_category']!="")
										{
											$strCategory=explode(",",$row['condition_category']);
										}

								?>

                                
                                <label class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" name="ckCategory[]" value="<?php echo $value['condition_categories_id'] ?>" <?php if ($_GET['task']=="edit") { if (@in_array($value['condition_categories_id'],$strCategory)) echo 'checked="checked"'; } ?>> <span class="custom-control-label"><?php echo $value['condition_categories_name']; ?></span> </label> 

                                <?php 
									}
								?>
                                  </div> </div>
                            
                            </div>-->
                            
                            
                            
                             <div class="form-group">
								<label class="form-label">Short Description</label>
								<textarea class="summernote"  name="txtShortDesc"><?php echo $row['condition_short_desc']?></textarea>
							</div>
					

							<!--<div class="form-group">
								<label class="form-label">Description</label>
								<textarea class="content" name="page_description" required><?php echo $row['condition_long_description']?></textarea>
							</div>-->
                            
                            <!-- Image Upload -->

							<div class="form-group">
								<label class="form-label">Home page Icon</label>
								<div id="images4ex" orakuploader="on"></div>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Listing page Image</label>
								<div id="imgListing" orakuploader="on"></div>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Detail page Image</label>
								<div id="imgDetail" orakuploader="on"></div>
							</div>


					   <!-- Image Upload -->
                            
                            
                            <div class="form-group">
								<label class="form-label">Overview</label>
								<textarea class="summernote"  name="txtOverview" rows="6" cols="150" ><?php echo $row['condition_overview']?></textarea>
							</div>
                           
                            <div class="form-group">
								<label class="form-label">Symptoms</label>
								<textarea class="summernote"  name="txtSymptoms" rows="6" cols="150" ><?php echo $row['condition_symptoms']?></textarea>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Causes</label>
                            </div>
                            
                             <div class="form-group">
								<label class="form-label" rows="6" cols="150">Treatments</label>
								<textarea class="summernote"  name="txtTreatments" rows="6" cols="150" > <?php echo $row['condition_treatments']?></textarea>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Alternate Treatments</label>
								<textarea class="summernote"  name="txtCauses" rows="6" cols="150" ><?php echo $row['condition_causes']?></textarea>
								<textarea class="summernote"  name="txtAltTreatments" rows="6" cols="150" > <?php echo $row['condition_alt_treatments']?></textarea>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Disclaimer Content</label>
								<textarea   name="txtDisclaimer" rows="6" cols="150" > <?php echo $row['condition_disclaimer_content']?></textarea>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Agreement Content</label>
								<textarea   name="txtAgreement" rows="6" cols="150" > <?php echo $row['condition_agreement']?></textarea>
							</div>

						<div class="form-group ">
						<div class="form-label">Follow-up/Review</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoFollowup" id="rdoFollowup" value="1" <?php if($row['condition_followup']=="1" || $row['condition_followup']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoFollowup" id="rdoFollowup" value="0" <?php if($row['condition_followup']==0 && $row['condition_followup']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>


							<div class="form-group ">
						<div class="form-label">Enabled</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['condition_status']=="1" || $row['condition_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="0" <?php if($row['condition_status']==0 && $row['condition_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>
				
						
					<div class="row row-sm">
					<div class="col-lg">
					<button id="submitBtn"  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

<input type="hidden" name="pageId" value="<?php echo $row['condition_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>					
								</div>
                                
<?php if ($row['condition_home_icon']!="")
	  $pImageStr="'".$row['condition_home_icon']."'";	
	  
	  
	  if ($row['condition_listing_icon']!="")
	  $pImageStr2="'".$row['condition_listing_icon']."'";	
	  
	  if ($row['condition_detail_banner']!="")
	  $pImageStr3="'".$row['condition_detail_banner']."'";	
	  	 
			  ?>

 <script language="javascript">
$(document).ready(function(){
	$('#images4ex').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../images/condition/homeicon',
		orakuploader_thumbnail_path : '../images/condition/homeicon',
		
		orakuploader_use_main : true,
		orakuploader_use_sortable : true,
		orakuploader_use_dragndrop : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 600,
		orakuploader_thumbnail_size  : 400,
		orakuploader_maximum_uploads : 1,
		orakuploader_attach_images: [<?php echo $pImageStr?>],
		
		orakuploader_main_changed    : function (filename) {
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
		}

	});
	
	
	$('#imgListing').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../images/condition/listing',
		orakuploader_thumbnail_path : '../images/condition/listing',
		
		orakuploader_use_main : true,
		orakuploader_use_sortable : true,
		orakuploader_use_dragndrop : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 800,
		orakuploader_thumbnail_size  : 500,
		orakuploader_maximum_uploads : 1,
		orakuploader_attach_images: [<?php echo $pImageStr2?>],
		
		orakuploader_main_changed    : function (filename) {
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
		}

	});
	
	
	$('#imgDetail').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../images/condition/detail',
		orakuploader_thumbnail_path : '../images/condition/detail',
		
		orakuploader_use_main : true,
		orakuploader_use_sortable : true,
		orakuploader_use_dragndrop : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 800,
		orakuploader_thumbnail_size  : 500,
		orakuploader_maximum_uploads : 1,
		orakuploader_attach_images: [<?php echo $pImageStr3?>],
		
		orakuploader_main_changed    : function (filename) {
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
		}

	});
	
	
});
</script>	
 		


             <?php } ?>

