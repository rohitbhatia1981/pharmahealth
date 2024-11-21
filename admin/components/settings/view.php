

		

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

                <div class="row-fluid">

					<div class="span12">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

                       

                       <!-- <div style="float:left;width:350px;">

								<span class="inputbox" valign="top"></span>

								<input value="<?php echo $_GET['txtSearchByTitle']; ?>" type="text" name="txtSearchByTitle" id="txtSearchByTitle" class="span10 m-wrap" onsubmit="if(event.keyCode==13) return document.adminForm.submit();" placeholder="Enter Item Name.">	

							</div>

							<div style="float:left;width:350px;">

								<?php

										$sql = "SELECT * FROM tbl_category where category_status=1";

										$countries = $database->get_results( $sql );

										$TotalCountry = count($countries);

										$getcountry = $_GET['selCategory'];

										//echo $getcmpny;

										//print_r($getcmpny);

										?>

										<select name="selCategory" id="selCategory" onsubmit="if(event.keyCode==13) return document.adminForm.submit();" class="span10 m-wrap">

										 <option value="">  Select Category  </option>

										 <?php

											for ($i = 0; $i < $TotalCountry; $i++) 

												{

													$Country = $countries[$i];

													

													?>

												<option value="<?php echo $Country['category_id']; ?>"<?php if ($Country['category_id']==$_GET['selCategory']) echo "selected"; ?>><?php echo $Country['category_name']; ?></option>

											<?php	

												}

											?> 

										</select>

							</div>

							<input type="submit" class="btn purple" value="Search" align="center" style="width:70px;" onclick="javascript:document.adminForm.submit();" />	-->							

							<div class="btn-group" style="float:right;">

										<a class="btn purple" href="#" data-toggle="dropdown">

										<i class="icon-user"></i> Actions

										<i class="icon-angle-down"></i>

										</a>

										<ul class="dropdown-menu">

											<?php if($permission['rights_add'] == 1) { ?>

												<li><a href="index.php?c=<?php echo $component?>&task=add&Cid=<?php echo $menuid['component_headingid']; ?>"><i class="icon-plus"></i> Add</a></li>

											<?php } ?>

											<?php if($permission['rights_delete'] == 1) { ?>

												<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to delete'); } else if (confirm('Are you sure you want to delete selected items?')){ submitbutton('remove');}"><i class="icon-remove"></i> Delete</a></li>

                                            <?php } ?>

											<?php if($permission['rights_enable'] == 1) { ?>

												<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to enable'); } else {submitbutton('publishList', '');}"><i class="icon-check"></i> Enable</a></li>

												<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to disable'); } else {submitbutton('unpublishList', '');}"><i class="icon-ban-circle"></i> Disable</a></li>

											<?php } ?>

											<!--<li class="divider"></li>

											<li><a href="#"><i class="i"></i> Full Settings</a></li>-->

										</ul>

							</div>

                                    <div style="clear:both"></div>

                                    <div style="height:10px"></div>

                                    

						<div class="portlet box light-grey">

                        

                        

                              <div style="clear:both"></div>

                       

							<div class="portlet-title">

								<h4><i class="icon-reorder"></i>Setting </h4>

								<!--<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									

									<a href="javascript:;" class="reload"></a>

								

								</div>-->

							</div>

							<div class="portlet-body">

								<table class="table table-striped table-bordered" id="sample_1">

									<thead>

										<tr>

											<th style="width:8px;">

											<input type="checkbox"  name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />

											</th>

											<th>Restaurant Name</th>

											

										

											<!--<th class="hidden-phone" width="7%" >Status</th>-->

										</tr>

									</thead>

									<tbody>

                                    

                                    <?php

									if($totalRecords > 0) 

									{

									for ($i = 0; $i < $totalRecords; $i++) 

										{

											$srno++;

											$row = &$rows[$i];

											

									?>

                                    

                                    

										<tr class="odd gradeX">

											<td>

											<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);"  value="<?php echo $row['setting_id']; ?>" type="checkbox" class="checkboxes" />

											</td>

											<td>

											<?php if($permission['rights_edit'] == 1) { ?>

												<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['setting_id']; ?>">

											<?php echo $row['setting_resname']; ?></a>

											<?php 

												}else 

												{

													echo $row['setting_resname'];

												}

											?>

											</td>

											<!--<td><a href="?c=<?php echo $component?>&task=edit&id=<?php echo $row['setting_id']; ?>"><?php echo $row['setting_resname']; ?></a></td>-->

											

											<?php

											$sql = "SELECT * FROM tbl_category where category_id='".$row['banner_desc']."'";

											$countries = $database->get_results( $sql );

											$Country = &$countries[0];

											?>

											<!--<td><?php echo $Country['category_name']; ?></td>

											<td><?php echo CURRENCY.$row['product_price']; ?></td>

											

											

											<td class="hidden-phone">

											<?php if($row['banner_status'] == 1){ ?>

											<span class="label label-success">Enabled</span>

											<?php }else if($row['banner_status'] == 0){ ?>

											<span class="label label-inverse">Disabled</span>

											<?php } ?>

											</td>-->

										</tr>

                                        

                                    <?php

										}

									}

										else

										{

											?>

											<tr class="odd gradeX">

												<td colspan="4" style="text-align:center;"> - No Record found - </td>

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

						<!-- END EXAMPLE TABLE PORTLET-->

					</div>

				</div>

				<input type="hidden" name="task" value="" />

				<input type="hidden" name="Cid" value="<?php echo $_GET['Cid']?>" />

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

			

	

	

	 ?>		

                <div class="row-fluid">

               <div class="span12">

                  <!-- BEGIN SAMPLE FORM PORTLET-->   

                  <div class="portlet box blue">

                     <div class="portlet-title">

                        <h4><i class="icon-reorder"></i>Setting : <?php if (count($row)>0) echo 'Edit'; else echo 'Add'; ?></h4>

                        <div class="tools">

                        

                           <a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="remove"></a>

                        </div>

                     </div>

                     <div class="portlet-body form">

                        <!-- BEGIN FORM-->

                        

                        <?php

						if (count($row)>0)

						$task="saveedit";

						else

						$task="save";

						

						

						?>

                        

                        

                        <form name="user-form" id="user-form" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" enctype="multipart/form-data" />

							
                           <div class="control-group">

                              <label class="control-label">From Name</label>

                              <div class="controls">

                                 <input type="text" value="<?php echo $row['setting_resname']?>" name="txtsetting_resname" id="txtsetting_resname" class="span6 m-wrap" />

                                 

                              </div>

                           </div>	

						   

						   <div class="control-group">

                              <label class="control-label">Email</label>

                              <div class="controls">

                                 <input type="text" value="<?php echo $row['setting_email']?>" name="txtsetting_email" id="txtsetting_email" class="span6 m-wrap" />

                                 

                              </div>

                           </div>	

						   

						   <div class="control-group">

                              <label class="control-label">Phone</label>

                              <div class="controls">

                                 <input type="text" value="<?php echo $row['setting_phone']?>" name="txtsetting_phone" id="txtsetting_phone" class="span6 m-wrap" />

                                 

                              </div>

                           </div>	

						   

						   

						    <div class="control-group">

                              <label class="control-label">Address</label>

                              <div class="controls">

                                 <textarea type="text" name="txtAddress" id="txtAddress" class="span6 m-wrap" /><?php echo $row['setting_address']?></textarea>

                                 

                              </div>

                           </div>


                        

                           <div class="form-actions">

                              <button type="submit" class="btn blue">Submit</button>

                              <button type="button" class="btn" onclick="window.location='?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>'">Cancel</button>

                           </div>

                           <input type="hidden" name="CId" value="<?php echo $_GET['Cid']?>" />

                           <input type="hidden" name="userId" value="<?php echo $row['setting_id']?>" />

                           <input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

                           <input type="hidden" name="parentuserId" value="<?php echo $_SESSION['setting_id']?>" />

                        </form>

                        <!-- END FORM-->           

                     </div>

                  </div>

                  <!-- END SAMPLE FORM PORTLET-->

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



				txtsetting_resname: {

						required: true,										 

				},

	

			},

			// Messages for form validation

			messages: {



				txtsetting_resname: {

						required: 'Please enter restaurant name',						

					},

				

			}

		});

	

	});

	

	</script>