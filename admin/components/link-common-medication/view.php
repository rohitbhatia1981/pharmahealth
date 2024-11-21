		

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
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter by Conditions:</label>
                                                    
                                                    <?php
														$sqlCategory="select * from tbl_conditions where condition_status=1 order by condition_title asc";
														$resCategory=$database->get_results($sqlCategory);
														
													
													?>
                                                    
													<select name="cmbCategory"  class="form-control" data-placeholder="All Conditions">
														<option label="All Conditions"></option>
                                                       
                                                        <?php for ($c=0;$c<count($resCategory);$c++)
														{
															$rowCategory=$resCategory[$c];
															?>
														<option value="<?php echo $rowCategory['condition_id']?>" <?php if ($rowCategory['condition_id']==$_GET['cmbCategory']) echo "selected"; ?>><?php echo $rowCategory['condition_title']?></option>
														<?php } ?>
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
												<th class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th class="border-bottom-0">Conditions</th>
                                                <th class="border-bottom-0">Treatment</th>
                                                <th class="border-bottom-0">Commonly bought with (link sale)</th>
                                                
												
												<th class="border-bottom-0">Actions</th>
												
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
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['lcb_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									<td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['lcb_id']; ?>"><?php echo $row['condition_title']; ?></a>
											</div>
										</div>
									</td>
                                    <td>
                                    		<?php echo $row['med_title']; ?>
                                    </td>
                                    <td>
                                     <?php if ($row['lcb_common_or_option']!="") { ?>
                                    <strong><u>OR Options</u></strong><br />
                                    <?php echo getMedicineName_common_multi($row['lcb_common_or_option'],2); ?> <br /><br />
                                    <?php } ?>
                                    
                                    
                                    <?php if ($row['lcb_common_and_option']!="") { ?>
                                    <strong><u>AND Options</u></strong><br />
                                    <?php echo getMedicineName_common_multi($row['lcb_common_and_option'],2); ?>
                                    <?php } ?>
                                    
                                    </td>
                                     
									<td class="align-middle">
										<div class="btn-group align-top">
											<button class="btn btn-sm btn-white"  ><a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['lcb_id']; ?>">Edit</a></button>
											



											

											
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
	<h4 class="page-title">Link Commonly Bought Medication Management : <?php if (@count($row)>0) echo 'Edit'; else echo 'Add'; ?></h4>
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
								<label class="form-label">Select Condition *</label>
								<select  name="ckConditions" class="form-control">
                                <option value=""></option>
    
     <?php
								$query = "SELECT * FROM tbl_conditions where condition_status=1 order by condition_title";
								$results = $database->get_results( $query );
											
										foreach ($results as $value)
										 {
											 
											
											?>
										<option value="<?php echo $value['condition_id']; ?>" <?php if ($value['condition_id']==$row['lcb_condition']) echo 'selected'; ?>><?php echo $value['condition_title']; ?></option>
										 <?php
                                        }
                                        ?>
		
	</select>
							</div>
                            
                            
                            <div class="form-group">
								<label class="form-label">Select Medication *</label>
								<select  name="cmbMedication" class="form-control">
                                <option value=""></option>
    
     <?php
								$query = "SELECT * FROM tbl_medication where med_status=1 order by med_title";
								$results = $database->get_results( $query );
											
										foreach ($results as $value)
										 {
											 
											
											?>
										<option value="<?php echo $value['med_id']; ?>" <?php if ($value['med_id']==$row['lcb_medication']) echo "selected"; ?>><?php echo $value['med_title']; ?></option>
										 <?php
                                        }
                                        ?>
		
	</select>
							</div>
                            
                            
                            <div class="form-group">
								<label class="form-label">Select Common Medication (OR options) *</label>
							  <select multiple="multiple" name="cmbCommon1[]" class="multi-select">
    
     <?php
								$query = "SELECT * FROM tbl_commonly_bought where med_c_status=1 order by med_c_title";
								$results = $database->get_results( $query );
											
										foreach ($results as $value)
										 {
											 
											 if ($row['lcb_common_or_option']!="")
											{
												$strCategory=explode(",",$row['lcb_common_or_option']);
											}
											?>
												<option value="<?php echo $value['med_c_id']; ?>" <?php if ($_GET['task']=="edit") { if (@in_array($value['med_c_id'],$strCategory)) echo 'selected'; }  ?>><?php echo $value['med_c_title']; ?></option>
										 <?php
                                        }
                                        ?>
		
	</select>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Select Common Medication (AND options) *</label>
								<select multiple="multiple" name="cmbCommon2[]" class="multi-select">
    
     <?php
								$query = "SELECT * FROM tbl_commonly_bought where med_c_status=1 order by med_c_title";
								$results = $database->get_results( $query );
											
										foreach ($results as $value)
										 {
											 
											 if ($row['lcb_common_and_option']!="")
											{
												$strCategory2=explode(",",$row['lcb_common_and_option']);
											}
											?>
												<option value="<?php echo $value['med_c_id']; ?>" <?php if ($_GET['task']=="edit") { if (@in_array($value['med_c_id'],$strCategory2)) echo 'selected'; }  ?>><?php echo $value['med_c_title']; ?></option>
										 <?php
                                        }
                                        ?>
		
	</select>
							</div>
                        
							<!--<div class="form-group">
								<label class="form-label">Description</label>
								<textarea class="content" name="page_description" required><?php echo $row['condition_long_description']?></textarea>
							</div>-->
                            
                            <!-- Image Upload -->

                        
                            
                            
                            
                            
                            
                           


					   <!-- Image Upload -->
                            
                            
                      
						
					<div class="row row-sm">
					<div class="col-lg">
					<button id="submitBtn"  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

<input type="hidden" name="pageId" value="<?php echo $row['lcb_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>					
								</div>
                                
<?php if ($row['med_c_image']!="")
	  $pImageStr="'".$row['med_c_image']."'";	
	  
	  
	
	  	 
			  ?>

 <script language="javascript">
$(document).ready(function(){
	$('#images4ex').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../images/medication/common',
		orakuploader_thumbnail_path : '../images/medication/common',
		
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
	
	
	
	
	
});
</script>	
 		


             <?php } ?>

