		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database;

		

		$totalRecords = count($rows);

		

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
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											
											<div class="col col-auto mb-4">
												<div class="form-group w-100">
												<!-- <div class="input-icon">
														<span class="input-icon-addon">
															<i class="fe fe-search"></i>
														</span>
														 <input type="text" class="form-control" name="txtSearchByTitle" placeholder="Search by keyword" value="<?php echo $_GET['txtSearchByTitle'];?>">
													</div>  -->

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
															<th>Group Name</th>
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
																	<input type="checkbox" class="custom-control-input" name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);"  value="<?php echo $row['group_id']; ?>">
																	<span class="custom-control-label"></span>
																</label>
															</td>
															<td class="align-middle">
																<div class="d-flex">
																	
																	<div class="mt-1">
																		<?php if($permission['rights_edit'] == 1) { ?>

																			<a href="?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>&task=edit&id=<?php echo $row['group_id']; ?>">

																		<?php echo $row['group_name']; ?></a>

																		<?php 

																			}else 

																			{

																				echo $row['group_name'];

																			}

																		?>
																	</div>
																</div>
															</td>
															
															<td class="align-middle">
																<div class="d-flex">
																	
																	<div class="mt-1">
																		<?php if($row['group_published'] == 1){ ?>

																		<span class="tag tag-green">Enabled</span>

																		<?php }else if($row['group_published'] == 2){ ?>

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

	$sqlmenuid = "select * from tbl_components where component_option='".$_GET['c']."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

	$sectionsGiven = array();

		$sqlBringSectionsGiven = "select * from tbl_rights_groups where rights_group_id='".$row['group_id']."'";

		$resultBringSectionGiven = $database->get_results( $sqlBringSectionsGiven );



		foreach($resultBringSectionGiven as $rowBringSectionsGiven )



			{

				$sectionsGiven[] = $rowBringSectionsGiven['rights_menu_id'];

			}



	 ?>		

  <!-- App-content opened -->
  <div class="main-content">
					<div class="container">

						<!--Page header-->
						<div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<h4 class="page-title">Group : <?php if (@count($row)>0) echo 'Edit'; else echo 'Add'; ?></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class=" btn-list">

								<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Close" data-original-title="Back">
																<i class="fa fa-close"></i>
															</a>	
									<!-- <button  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
									<button  class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
									<button  class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> -->

									
								</div>
							</div>		
							
						</div>
						<!--End Page header-->
						
						<!-- Row -->
						<div class="row">
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-body">
										<!-- BEGIN FORM-->

                        <?php
						if (@count($row)>0)
						$task="saveedit";
						else
						$task="save";
						?>
									<form action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" name="adminForm" />
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label">Group Name</label>
													<input type="text" value="<?php echo $row['group_name']?>" name="txtGroupName" id="txtGroupName" class="form-control" required />
												</div>
											</div>
											
										</div>
										
										<div class="row">
											<div class="col-md-12">
											 <table border="0" cellpadding="10" cellspacing="4" class="class4text" width="100%">

									<?php

										$sqlForSections="select * from tbl_components where component_title<>'Dashboard' order by component_for, component_title ASC";

										$resultForSections = $database->get_results( $sqlForSections );

										$totalMenus= $database->num_rows($sqlForSections);

										

										//exit;

											$i = 0;

											foreach($resultForSections as $rowForSections )

											{

												//echo $rowForSections['component_title'];

												$permissionForAddHTML = 0;

												$permissionForEditHTML = 0;

												$permissionForDeleteHTML = 0;

												$permissionForEnableHTML = 0;

												//$permissionForDisable = 0;

												

												$sqlPermissions = "select * from tbl_rights_groups where rights_menu_id='".$rowForSections['component_id']."' and rights_group_id='".$row['group_id']."'";

												$resultPermissions = $database->get_results( $sqlPermissions );

													

												

													//$rowPermissions = mysql_fetch_object($resultPermissions);

													foreach($resultPermissions as $rowPermissions ){

														

													$permissionForAddHTML = $rowPermissions['rights_add'];

													$permissionForEditHTML = $rowPermissions['rights_edit'];

													$permissionForDeleteHTML = $rowPermissions['rights_delete'];

													$permissionForEnableHTML = $rowPermissions['rights_enable'];

													//$permissionForDisable = $rowPermissions->rights_disable;

													}

												//echo $rowForSections->component_title;

												$i++;

												echo "<tr style='border-bottom:1px solid;border-color:#ccc'><td width='30%' align='left'>";

												echo "<input type='checkbox' name='chkSection{$i}' id='chkSection{$i}' onClick=\"uncheckMyBoxes('".$i."');\" value='{$rowForSections['component_id']}'";

												if($row['group_id'] != "") { if(in_array($rowForSections['component_id'],$sectionsGiven)) echo " checked "; } 

												echo "> ".$rowForSections['component_title']." ";

												echo "</td>";
												echo "<td width='10%'>".ucfirst($rowForSections['component_for'])." </td>";

												if($rowForSections['component_title'] == "Contact Info")

												{
													
													
													

													echo "<td width='10%'>";

													echo "<input type='checkbox' name='chkPermitEdit{$i}' id='chkPermitEdit{$i}' onClick=\"uncheckMyAllBox('".$i."');\" value='Edit'";

													if($permissionForEditHTML == 1) echo " checked ";

													echo "><small>  Edit</small>";

													echo "</td><td width='10%'>";

													echo "<input type='checkbox' name='chkPermitAll{$i}' id='chkPermitAll{$i}' onClick=\"checkAllBoxes('".$i."');\"  value='All' ";

													if(($permissionForAddHTML == 1 ) && ($permissionForEditHTML == 1) && ($permissionForDeleteHTML == 1)  && ($permissionForEnableHTML == 1) ) { echo " checked "; }

													echo "><small>  All</small>";

													echo "</td><td width='20%' style='display:none;'>";

													echo "<input type='checkbox' name='chkPermitAdd{$i}' id='chkPermitAdd{$i}' onClick=\"uncheckMyAllBox('".$i."');\" value='Add' ";

													if($permissionForAddHTML == 1) echo " checked ";

													echo "><small>  Add</small>";

													echo "</td><td width='10%' style='display:none;'>";

													echo "<input type='checkbox' name='chkPermitDelete{$i}' id='chkPermitDelete{$i}' onClick=\"uncheckMyAllBox('".$i."');\" value='Delete'";

													if($permissionForDeleteHTML == 1) echo " checked ";

													echo "><small>  Delete</small>";

													echo "</td><td width='10%' style='display:none;'>";

													echo "<input type='checkbox' name='chkPermitEnable{$i}' id='chkPermitEnable{$i}' onClick=\"uncheckMyAllBox('".$i."');\" value='Enable'";

													if($permissionForEnableHTML == 1) echo " checked ";

													echo "><small>  Enable/Disable</small>";

													echo "</td>";

												}

												else

												{

													echo "<td width='10%'>";

													echo "<input type='checkbox' name='chkPermitAdd{$i}' id='chkPermitAdd{$i}' onClick=\"uncheckMyAllBox('".$i."');\" value='Add' ";

													if($permissionForAddHTML == 1) echo " checked ";

													echo "><small>   Add</small>";

													echo "</td><td width='10%'>";

													echo "<input type='checkbox' name='chkPermitEdit{$i}' id='chkPermitEdit{$i}' onClick=\"uncheckMyAllBox('".$i."');\" value='Edit'";

													if($permissionForEditHTML == 1) echo " checked ";

													echo "><small>   Edit</small>";

													echo "</td><td width='10%'>";

													echo "<input type='checkbox' name='chkPermitDelete{$i}' id='chkPermitDelete{$i}' onClick=\"uncheckMyAllBox('".$i."');\" value='Delete'";

													if($permissionForDeleteHTML == 1) echo " checked ";

													echo "><small>   Delete</small>";

													echo "</td><td width='20%'>";

													echo "<input type='checkbox' name='chkPermitEnable{$i}' id='chkPermitEnable{$i}' onClick=\"uncheckMyAllBox('".$i."');\" value='Enable'";

													if($permissionForEnableHTML == 1) echo " checked ";

													echo "><small>   Enable/Disable</small>";

													echo "</td><td width='10%'>";

													echo "<input type='checkbox' name='chkPermitAll{$i}' id='chkPermitAll{$i}' onClick=\"checkAllBoxes('".$i."');\"  value='All' ";

													if(($permissionForAddHTML == 1 ) && ($permissionForEditHTML == 1) && ($permissionForDeleteHTML == 1)  && ($permissionForEnableHTML == 1) ) { echo " checked "; }

													echo "><small>   All</small>";

													echo "</td>";

												}

												echo "</tr>";

												

											}

										

									?>

								</table>

								<input type="hidden" name="hidTotalMenus" id="hidTotalMenus" value="<?php echo $totalMenus ; ?>" />
											
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
								  <label class="form-label">Enabled&nbsp;</label>
								  <div class="custom-controls-stacked">
									 <label class="custom-control custom-radio">
									 <input class="" type="radio" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['group_published']=="1" || $row['group_published']=='') echo 'checked="checked"'; ?>/>Yes &nbsp; &nbsp; <input class="" type="radio" name="rdoPublished" id="rdoPublished" value="2" <?php if($row['group_published']=="2" && $row['group_published']!='') echo 'checked="checked"'; ?> />No</label>  
									</div>
									</div>
									
									</div>
								</div>
								
								
							   <div class="card-footer text-right">
							    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
								<button type="button" class="btn btn-lg btn-danger" onclick="window.location='?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>'">Cancel</button>
										
									</div>

                           <input type="hidden" name="groupId" value="<?php echo $row['group_id']?>" />
										
									</form>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
             <?php } ?>

    <script language="JavaScript">

		function checkAllBoxes(code)

		{

			var name = "chkPermitAll"+code;

			if(document.getElementById(name).checked == true)

			{

				var nameAdd = "chkPermitAdd"+code;

				var nameEdit = "chkPermitEdit"+code;

				var nameDelete = "chkPermitDelete"+code;

				var nameEnable = "chkPermitEnable"+code;

				//var nameDisable = "chkPermitDisable"+code;

				document.getElementById(nameAdd).checked = true;

				document.getElementById(nameEdit).checked = true;

				document.getElementById(nameDelete).checked = true;

				document.getElementById(nameEnable).checked = true;

				//document.getElementById(nameDisable).checked = true;

			}

		}

		function uncheckMyAllBox(idpart)

		{

			var nameAdd = "chkPermitAdd"+idpart;

			var nameEdit = "chkPermitEdit"+idpart;

			var nameDelete = "chkPermitDelete"+idpart;

			var nameEnable = "chkPermitEnable"+idpart;

			//var nameDisable = "chkPermitDisable"+idpart;

			if((document.getElementById(nameAdd).checked == false) || (document.getElementById(nameEdit).checked == false) || (document.getElementById(nameDelete).checked == false) || (document.getElementById(nameEnable).checked == false))

			{

				var name = "chkPermitAll"+idpart;

				document.getElementById(name).checked = false;

			}

			if((document.getElementById(nameAdd).checked == true) && (document.getElementById(nameEdit).checked == true) && (document.getElementById(nameDelete).checked == true) && (document.getElementById(nameEnable).checked == true))

			{

				var name = "chkPermitAll"+idpart;

				document.getElementById(name).checked = true;

			}

		}

		function uncheckMyBoxes(code)

		{

			var name = "chkSection"+code;

			if(document.getElementById(name).checked == false)

			{

				var nameAdd = "chkPermitAdd"+code;

				var nameEdit = "chkPermitEdit"+code;

				var nameDelete = "chkPermitDelete"+code;

				var nameEnable = "chkPermitEnable"+code;

				var nameAll = "chkPermitAll"+code

				document.getElementById(nameAdd).checked = false;

				document.getElementById(nameEdit).checked = false;

				document.getElementById(nameDelete).checked = false;

				document.getElementById(nameEnable).checked = false;

				document.getElementById(nameAll).checked = false;

			}

		}

		

	</script>