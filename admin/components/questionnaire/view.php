		

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
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter by Conditions:</label>
                                                    
                                                    <?php
														$sqlCategory="select * from tbl_conditions where condition_status=1 order by condition_title asc";
														$resCategory=$database->get_results($sqlCategory);
														
													
													?>
                                                    
													<select name="cmbCategory"  class="form-control custom-select select2" data-placeholder="All Conditions">
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
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter by Category:</label>
                                                    
                                                    <?php
														$sqlCategory="select * from tbl_questionnaire_categories where qc_status=1 order by qc_name asc";
														$resCategory=$database->get_results($sqlCategory);
														
													
													?>
                                                    
													<select name="cmbCat"  class="form-control custom-select select2" data-placeholder="All Category">
														<option label="All Category"></option>
                                                       
                                                        <?php for ($c=0;$c<count($resCategory);$c++)
														{
															$rowCategory=$resCategory[$c];
															?>
														<option value="<?php echo $rowCategory['qc_id']?>" <?php if ($rowCategory['qc_id']==$_GET['cmbCat']) echo "selected"; ?>><?php echo $rowCategory['qc_name']?></option>
														<?php } ?>
													</select>
												</div>
											</div>
                                            <div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group mt-5">
                                            
                                            <select class="form-control custom-select select2" name="cmbAnsType" id="cmbAnsType" data-placeholder="All Types" >
                                                <option label="Answer Type"></option>
                                                <option label="All Types"></option>
                                                <option value="1" <?php if ($_GET['cmbAnsType']==1) echo "selected"; ?>>Single Selection</option>
                                                <option value="2" <?php if ($_GET['cmbAnsType']==2) echo "selected"; ?>>Multiple Selection</option>
                                                <option value="3" <?php if ($_GET['cmbAnsType']==3) echo "selected"; ?>>Free Text</option>
                                                <option value="4" <?php if ($_GET['cmbAnsType']==4) echo "selected"; ?>>Upload Patient Image</option>
                                        
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
                                
                                
                                <?php
								  if ($_GET['cmbCategory']!="")
									{
										?>
                                        	<div style="padding-bottom:20px">
                                        	<a href="<?php echo URL?>patient/questionnaire/preview-questions?c=<?php echo $_GET['cmbCategory']?>" style="font-size:14px; color:#03C" target="_blank">View Questionnaire Preview of <?php getConditionName($_GET['cmbCategory'])?></a>
                                            </div>
                                            
                                <?php } ?>
                                
									<table class="table table-bordered border-top text-nowrap" id="example1">
										<thead>
											<tr>
												<th class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th class="border-bottom-0 w-60">Question</th>
                                                
                                                <th class="border-bottom-0 w-60">Condition</th>
                                                
                                                <th class="border-bottom-0 w-60">Category</th>
                                                
                                                <th class="border-bottom-0 w-60">Question Order</th>
												
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
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['mq_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									<td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												<a title="<?php echo $row['mq_questions']; ?>" href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['mq_id']; ?>"><?php echo substr($row['mq_questions'],0,50); ?>..</a>
											</div>
										</div>
									</td>
                                    
                                    <td class="align-middle">
										<?php echo getConditionName_multi($row['mq_conditions']); ?>
											
									</td>
                                    
                                    <td><?php 
									if ($row['qc_name']=="Symptoms") { echo '<span class="tag tag-blue">'.$row['qc_name'].'</span>'; } 
									else if ($row['qc_name']=="Your Medical History") { echo '<span class="tag tag-orange">'.$row['qc_name'].'</span>'; } 
									else if ($row['qc_name']=="Your Medication History") { echo '<span class="tag tag-pink">'.$row['qc_name'].'</span>'; } 
									
									else echo $row['qc_name']; ?></td>
                                    
                                    <td><?php echo round($row['mq_order']); ?></td>
                                    
									<td class="align-middle">
										<div class="btn-group align-top">
											<button class="btn btn-sm btn-white"  ><a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['mq_id']; ?>">Edit</a></button>
											



											

											
										</div>
									</td>

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['mq_status'] == 1){ ?>

										<span class="tag tag-green">Enabled</span>

										<?php }else if($row['mq_status'] == 0){ ?>

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
	<h4 class="page-title">Medical Assessment: <?php if (@count($row)>0) echo 'Edit'; else echo 'Add'; ?></h4>
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
						{
						$task="saveedit";
						$modeval=2;
						}

						else
						{
						$task="save";
						$modeval=1;
						}

				?>
   <form name="pages" id="pages" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" enctype="multipart/form-data" />
   <div class="card-body pb-2">
   
   							<div class="form-group">
	<label class="form-label">Select Conditions *</label>
	<select  name="cmbConditions" id="cmbConditions" onchange="getPosition(<?php echo $modeval; ?>)" class="form-control" required>
    <option value="">Select Condition</option>
    
     <?php
								$query = "SELECT * FROM tbl_conditions order by condition_title";
								$results = $database->get_results( $query );
											
										foreach ($results as $value)
										 {
											 
											
											?>
										<option value="<?php echo $value['condition_id']; ?>" <?php  if ($value['condition_id']==$row['mq_conditions']) echo 'selected';  ?>><?php echo $value['condition_title']; ?></option>
										 <?php
                                        }
                                        ?>
		
	</select>
</div>


<div class="form-group">
	<label class="form-label">Select Category *</label>
    
    <select class="form-control" name="cmbCategory" id="cmbCategory" onchange="getPosition(<?php echo $modeval; ?>)" required >
										<option label="Select Category"></option>
										<?php
				$query = "SELECT * FROM tbl_questionnaire_categories where qc_status=1";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {

									?>

								<option value="<?php echo $value['qc_id']; ?>"  <?php if($row['mq_category'] == $value['qc_id']) {	echo 'selected="selected"';}?>  ><?php echo $value['qc_name']; ?></option>

							<?php	

							}

							?> 

									
									</select>
	
</div>


<div class="form-group">
	<label class="form-label">Select Position *</label>
    
    <select class="form-control" name="cmbPosition" id="cmbPosition" required >
	<option value="">Select Position</option>							

									
									</select>
	
</div>


					

							<div class="form-group">
								<label class="form-label">Question *</label>
								<textarea class="form-control mb-4" name="txtQuestion" id="txtQuestion" required="required"><?php echo $row['mq_questions']; ?></textarea>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Information Tooltip (i) Content</label>
                                <input type="checkbox" name="ckTooltip" <?php if ($row['mq_tooltip_status']==1) echo "checked"; ?> value="1"  />&nbsp;Enable Tooltip</label> 
								<textarea class="form-control mb-4" placeholder="Tooltip content" name="txtInformation" id="txtInformation"><?php echo $row['mq_tooltip_text']; ?></textarea>
                                
                                
							</div>

												

							<div class="form-group">
								<label class="form-label">Answer Selection Type *</label>
                                
                                <select class="form-control" name="cmbAnsType" id="cmbAnsType" required  >
										<option label="Select Answer Type"></option>
                                        
                                        <option value="1" <?php if ($row['mq_answer_type']==1) echo "selected"; ?>>Single Selection</option>
                                        <option value="2" <?php if ($row['mq_answer_type']==2) echo "selected"; ?>>Multiple Selection</option>
                                        <option value="3" <?php if ($row['mq_answer_type']==3) echo "selected"; ?>>Free Text</option>
                                        <option value="4" <?php if ($row['mq_answer_type']==4) echo "selected"; ?>>Upload Patient Image</option>
                                        
                                 </select>
								
							</div>
                            
                            <?php $arrOptions=array();
								$arrOptions=unserialize(fnUpdateHTML($row['mq_multiple_options']));
								$arrRisk=unserialize(fnUpdateHTML($row['mq_risk_level']));
								
								if (is_array($arrOptions))
								$optCount=count($arrOptions);
								
								if ($optCount<2)
								$optCount=2;
								
							 ?>

							<div class="form-group">
								<label class="form-label">Add Options</label>
								
								
                               <?php 
							   $arrAskOptions=array();
							   if ($row['mq_ask_for_information']!="")
							   $arrAskOptions=explode(",",$row['mq_ask_for_information']);
								
							   
							   for ($j=0;$j<$optCount;$j++)
							   {
								   ?> 
                                
                                <div class="row">
                                	<div class="col-3">	
										<input class="form-control mb-4" type="text" name="txtOptions[]" value="<?php echo $arrOptions[$j]?>">	
                                	</div>
                                    
                                    <div class="col-3">	
										 <select class="form-control" name="cmbRisk[]" id="cmbRisk"  >
                                         	<option value="">Select Risk Level</option>
                                         	<option value="3" <?php if ($arrRisk[$j]==3) echo "selected" ?>>High</option>
                                            <option value="2" <?php if ($arrRisk[$j]==2) echo "selected" ?>>Moderate</option>
                                            <option value="1" <?php if ($arrRisk[$j]==1) echo "selected" ?>>Low</option>
                                         </select>
                                	</div>
                                    
                                    <div class="col-3">
                                    
                                   		<?php $k=$j+1;?>
                                    		
                                            <label class="custom-control custom-checkbox"> <input type="checkbox" name="ckMoreInfo[]" value="<?php echo $k?>" <?php if (in_array($k,$arrAskOptions)) echo "checked"; ?> />&nbsp;Ask for more information</label> 
                                            
                                           
                                    
                                    </div>
                                    <?php if ($_GET['task']=="edit") {
										$imageOpt="";
										$sqlCheck="select * from tbl_question_images where qi_question='".$database->filter($_GET['id'])."' and qi_option='".$database->filter($j)."'"; 
										$resCheck=$database->get_results($sqlCheck);
										if (count($resCheck)>0)
										{
											$rowCheck=$resCheck[0];
											$imageOpt=$rowCheck['qi_image'];
										}
										 ?>
                                    <div class="col-3">	
                                    <?php if ($imageOpt=="") { ?>
										<span id="sp_<?php echo $j?>"><button onclick="AddImage(<?php echo $j?>)" type="button">Add Image</button></span>	
                                        <?php } else { ?>
                                        <a href="<?php echo URL?>uploads/questionnaire/<?php echo $imageOpt ?>" target="_blank"><img src="<?php print URL;?>classes/timthumb.php?src=<?php echo URL?>uploads/questionnaire/<?php echo $imageOpt ?>&w=100&h=100&zc=2" style="vertical-align: middle;padding:30px"></a>
                                        <a href="?c=<?php echo $_GET['c']?>&task=delimg&id=<?php echo $rowCheck['qi_id'];?>&qid=<?php echo $_GET['id'];?>&image=<?php echo $imageOpt ?>">X Remove</a>
                                        <?php } ?>
                                	</div>
                                    <?php } ?>
                                    
                                  </div>
                                  
                                 <?php } ?> 
                                 
                                 <div id='addmore_cont'>
                                 
                                 </div>
                                 
                                    
                                    <div class="row row-sm">
					<div class="col-lg">
					<button type="button" onclick="addRow()"  class="btn btn-secondary">Add more</button>	
					</div>
					</div>	
                                    
                                    
									
							
							
							</div>
			
					

<div class="form-group">
	<label class="form-label">Link to Medical Background Category</label>
    
    				<select class="form-control" name="cmbBackground" id="cmbBackground"  >
                                         	<option value="">Select</option>
                                         	<option value="1" <?php if ($row['mq_medical_background_link']==1) echo "selected" ?>>Allergy</option>
                                            <option value="2" <?php if ($row['mq_medical_background_link']==2) echo "selected" ?>>Medical Condition</option>
                                            <option value="3" <?php if ($row['mq_medical_background_link']==3) echo "selected" ?>>Medication</option>
                                         </select>
	
</div>

							<div class="form-group ">
						<div class="form-label">Enabled</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								
                                <input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['mq_status']=="1" || $row['mq_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="0" <?php if($row['mq_status']==0 && $row['mq_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>
				
						
					<div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	
                   </div>

<input type="hidden" name="pageId" value="<?php echo $row['mq_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />
<input type="hidden" id="hdPosition" value="<?php echo $row['mq_order']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>		
    
    
    <div class="modal fade"  id="uploadImg">
                 
                 <form action="?c=<?php echo $_GET['c']?>&task=saveimage" method="POST" enctype="multipart/form-data">
                 
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Image with option</h5>
							<button  class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							
							
							
							
							<div class="form-group">
								<label class="form-label">Select Image</label>
								<input type="file" required class="form-control" name="txtImage">
                                <input type="hidden" name="hdOptId" id="hdOptId" value="" />
                                <input type="hidden" name="hdQue" id="hdQue" value="<?php echo $_GET['id']?>" />
							</div>
							
							
						</div>
						<div class="modal-footer">
							<button  class="btn btn-outline-primary" data-dismiss="modal">Close</button>
							<button  class="btn btn-success">Submit</button>
						</div>
					</div>
				</div>
                
                </form>
			</div>			
								</div>
                                
                                <script language="javascript">
								function AddImage(id)
								{
									 $('#uploadImg').modal('show');
									 $("#hdOptId").val(id)
								}
								
								function addRow()
								{
									
									$("#addmore_cont").append('<div class="row"><div class="col-3"><input class="form-control mb-4" type="text" name="txtOptions[]" value=""></div><div class="col-3"><select class="form-control" name="cmbRisk[]" id="cmbRisk"  ><option value="">Select Risk Level</option><option value="3">High</option><option value="2">Moderate</option><option value="1">Low</option></select></div><div class="col-3"><label class="custom-control custom-checkbox"> <input type="checkbox" name="ckMoreInfo[]" value="" />&nbsp;Ask for more information</label></div><div class="col-3"><input type="file" class="form-control mb-4" name="flImage[]" /></div></div>');
								}
								
								function getPosition(mode)
								{
									var condition;
									var category;
									
									
									condition=$("#cmbConditions").val();
									category=$("#cmbCategory").val();
									position=$("#hdPosition").val();
									
									
									
									
									if (condition!="" && category!="")
									{
										$("#cmbPosition").load("<?php echo URL.FOLDER_ADMIN?>components/questionnaire/ajax/getposition.php?cat="+category+"&cond="+condition+"&position="+position+"&mode="+mode+"&mid=<?php echo $_GET['id']?>");
									}
									
								}
								<?php if ($_GET['task']=="edit") { ?>
								getPosition(2);
								<?php } ?>
								
								
								</script>


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