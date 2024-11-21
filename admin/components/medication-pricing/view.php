		

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

<style>
  /* Container for scrollable table */
  .table-container {
    overflow-y: auto;
    max-height: 800px; /* Adjust the height as needed */
  }

  /* Sticky header */
  th {
    position: sticky;
    top: 0;
    background-color: #fff; /* Background color for the header */
    z-index: 10; /* Higher z-index to stay above the table content */
    box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4); /* Optional shadow for better visibility */
  }
</style>
		
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

<a href="index.php?c=<?php echo $component?>&task=add&Cid=<?php echo $menuid['component_headingid']; ?>&cat=<?php echo $_GET['cmbCategory']?>" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addawardmodal">Add New</a>

<?php } ?>							
								
					<a href="" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" role="button" title="Actions" aria-haspopup="true" aria-expanded="false">
									Action
								</a>
                                
                  
                  
                                
				<ul class="dropdown-menu dropdown-menu-right" role="menu">


				<?php if($permission['rights_delete'] == 1) { ?>

				<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to delete'); } else if (confirm('Are you sure you want to delete selected items?')){ submitbutton('remove');}"><i class="feather feather-trash-2 mr-2"></i> Delete</a></li>

				<?php } ?>

				<?php if($permission['rights_enable'] == 1) { ?>

				<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to enable'); } else {submitbutton('publishList', '');}"><i class="fa fa-check-circle mr-2"></i> Mark Available</a></li>

				<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to disable'); } else {submitbutton('unpublishList', '');}"><i class="fa fa-ban mr-2"></i>Mark Unavailable</a></li>

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
                                            
                                            
                                      	      
                                            
                                            
								<div class="table-responsive table-lg mt-3  table-container">
									<table class="table table-bordered border-top" id="example1">
										<thead>
											<tr>
												<th width="8%" class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th width="8%" class="border-bottom-0" style="max-width:200px">Medication</th>
                                                <th width="6%" class="border-bottom-0">Strength</th>
                                                <th width="3%" class="border-bottom-0">Unit</th>
                                                <th width="6%" class="border-bottom-0">Packsize</th>
                                                <th width="4%" class="border-bottom-0">Cost Price</th>
                                                <th width="8%" class="border-bottom-0">Medication Cost</th>
                                                <th width="4%" class="border-bottom-0" style="min-width:130px">Tier 1 Price</th>
                                                <th width="4%" class="border-bottom-0" style="min-width:130px">Tier 2 Price</th>
                                                <th width="17%" class="border-bottom-0" style="min-width:130px">Tier 3 Price</th>
                                               
                                                
												
												<th width="18%" class="border-bottom-0">Actions</th>
												<th width="14%" class="border-bottom-0">Availability</th>
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
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['mp_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									<td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												<a href="?c=<?php echo $component?>&task=edit&id=<?php echo $row['mp_id']; ?>" style="font-size:16px; color:#000; font-weight:500"><?php echo $row['med_title']; ?></a> <br />
                                                <font style="color:#666; font-size:12px"><?php echo getConditionName_multi($row['med_conditions']); ?></font><br />
                                                
                                                <font style="color:#666; font-size:12px"><a href="<?php echo URL?>treatments/medicine?m=<?php echo $row['mp_medicine']; ?>" target="_blank" style="color:#09C">View Live Page</a></font>
                                                
                                               
                                                
                                                
											</div>
										</div>
									</td>
                                    <td>
                                    	<?php echo $row['mp_strength'] ?>
                                    </td>
                                    <td><?php echo $row['mp_unit']; ?></td>
                                     <td><?php echo $row['mp_pack_size']. " ".$row['mp_pack_unit'] ?></td>
                                      <td><?php echo CURRENCY.$row['mp_cost_price'] ?></td>
                                      <td><?php echo CURRENCY.$row['mp_medication_cost'] ?></td>
                                      
                                      
                                    <?php 
									 $mp_id = $row['mp_id'];
        for ($tier=1; $tier<=3; $tier++) { ?>
            <td valign="top">
             <?php if ($row['mp_override_active']==1) { ?>
                                                <span class="badge badge-pill badge-danger mt-2">Price Override</span>
                                                
                                                <div id="pricing-section-<?php echo $mp_id . '-' . $tier; ?>" <?php if ($row['mp_override_active']==1) { ?> style="border:1px solid #F00; padding:10px" <?php } ?>>
                                                
                                                <?php
												 $arrOR_price=unserialize(fnUpdateHTML($row['mp_override_price']));
												 $totalOR_qty=count($arrOR_price);
												 
												 		if ($totalOR_qty>0)
														 {
															 
														for ($k=1;$k<=$totalOR_qty;$k++)
														{
															$priceOR=$arrOR_price[$k-1];
															if ($tier>1)
															$priceOR=calculatePriceOveride($priceOR,$tier);
												?>
												
                                                	<div class='visible-row'>Qty <?php echo $k?>: <strong><?php echo CURRENCY . formatToTens($priceOR)?></strong></div>
                                                    
                                                  <?php } 
												  } ?>
                                                
                                                </div>
                                                
                                                
                                                <?php } else { ?>
            
                <div id="pricing-section-<?php echo $mp_id . '-' . $tier; ?>" >
                    <?php
                    for ($m=1; $m<=8; $m++) { 
                        $quantity = $m;

                        // Set base price for each tier
                        if ($tier == 1)
                            $baseprice = 20; 
                        else if ($tier == 2)
                            $baseprice = 24; 
                        else if ($tier == 3)
                            $baseprice = 28; 

                        $medicationCost = $row['mp_medication_cost'];
                        $costPrice = $row['mp_cost_price'];
                        $totalCostPrice = $costPrice * $quantity;

                        if ($totalCostPrice >= 6.5) {
                            $medicationCost = $totalCostPrice;
                            $tierPrice = calculatePrice_plus($quantity, $medicationCost, $tier,$costPrice);
                        } else {
                            $tierPrice = calculatePrice($baseprice, $quantity);
                        }

                        $arrTierPrice = explode(" ", $tierPrice);

                        // Add class 'hidden-row' for rows 5-8, visible-row for rows 1-4
                        $rowClass = ($m > 3) ? 'hidden-row-'.$mp_id.'-'.$tier : 'visible-row';
                        echo "<div class='$rowClass'>Qty $m: <strong>" . CURRENCY . formatToTens($arrTierPrice[0]) . "</strong></div>";
                    }
                    ?>
                </div>
                 <a id="view-more-btn-<?php echo $mp_id . '-' . $tier; ?>" href="javascript:void(0);" onclick="showMoreRows('<?php echo $mp_id; ?>', <?php echo $tier; ?>)" style="text-decoration:underline; color:#06C; font-size:12px">View More</a>
                <?php } ?>

                <!-- "View More" link for each column -->
               
            </td>
        <?php } ?>
                                     
                                      
									<td class="align-middle">
										<div class="btn-group align-top">
											<button class="btn btn-sm btn-white"  ><a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['mp_id']; ?>">Edit</a></button>
											



											

											
										</div>
									</td>
                                   

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['mp_in_stock'] == 1){ ?>

										<span class="tag tag-green">Available</span>

										<?php }else if($row['mp_in_stock'] == 0){ ?>

										<span class="tag tag-red">Unavailable</span>

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

		<th class="border-bottom-0 w-10" colspan="6" style="text-align:center;"> - No Record found - </th>
	</tr>

	<?php

}



?>				
							
							</tbody>
											</table>

												

										</div>
                                        <div style="height:50px"></div>
                                        
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
			<!-- End Row -->

		</div>
	</div><!-- end app-content-->
</div>
				<input type="hidden" name="task" value="" />

				<input type="hidden" name="c" value="<?php echo $component?>" />

				<input type="hidden" name="hidCheckedBoxes" value="0" />

			</form>
            
           <script>
    function showMoreRows(mp_id, tier) {
        // Show all hidden rows for the respective mp_id and tier
        var hiddenRows = document.getElementsByClassName('hidden-row-' + mp_id + '-' + tier);
        for (var i = 0; i < hiddenRows.length; i++) {
            hiddenRows[i].style.display = 'block';
        }

        // Hide the "View More" button after clicking
        document.getElementById('view-more-btn-' + mp_id + '-' + tier).style.display = 'none';
    }

    // Initially hide the rows with class 'hidden-row' for each mp_id and tier
    window.onload = function() {
        <?php 
        foreach ($rows as $row) {
            $mp_id = $row['mp_id']; 
            for ($tier=1; $tier<=3; $tier++) { ?>
                var hiddenRows = document.getElementsByClassName('hidden-row-<?php echo $mp_id . '-' . $tier; ?>');
                for (var i = 0; i < hiddenRows.length; i++) {
                    hiddenRows[i].style.display = 'none';
                }
        <?php } 
        } ?>
    }
</script>


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
	<h4 class="page-title">Medication Pricing: <?php if (@count($row)>0) echo 'Edit'; else echo 'Add'; ?></h4>
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
    
    
    <div class="row">
		<div class="col-lg-6 col-md-6">
   <form name="frmApp" id="frmApp" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" />
   <div class="card-body pb-2">
						

							<div class="form-group">
								<label class="form-label">Medication Name *</label>
								<select  name="txtMedication" class="form-control">
                                <option value="">Select Medication</option>
    
     <?php
								$query = "SELECT * FROM tbl_medication where med_status=1 order by med_title";
								$results = $database->get_results( $query );
											
										foreach ($results as $value)
										 {
											 
											
											?>
										<option value="<?php echo $value['med_id']; ?>" <?php if ($row['mp_medicine']==$value['med_id']) echo "selected"; ?> ><?php echo $value['med_title']; ?></option>
										 <?php
                                        }
                                        ?>
		
	</select>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Strength *</label>
                                
                                 <div class="row">
									<div class="col-lg-6 col-md-6">
									<input class="form-control mb-4" type="text" name="txtStrength" placeholder="eg. 20"; value="<?php echo $row['mp_strength']?>" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
									<input class="form-control mb-4" type="text" name="txtUnit" placeholder="eg. mg"; value="<?php echo $row['mp_unit']?>" required>
                                    </div>
                                 </div>
							</div>
                            
                            
                            
                            <div class="form-group">
								<label class="form-label">Formulation *</label>
								<input class="form-control mb-4" type="text" name="txtFormulation" value="<?php echo $row['mp_formulation']?>" required>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Pack Size *</label>
								<input class="form-control mb-4" type="text" name="txtPackSize" value="<?php echo $row['mp_pack_size']?>" required>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Pack Unit *</label>
								<input class="form-control mb-4" type="text" name="txtPackUnit" value="<?php echo $row['mp_pack_unit']?>" required>
							</div>
                            
                            
                            
                            <div class="form-group">
								<label class="form-label">Prescription Type *</label>
								<select  name="txtPresType" class="form-control">
                                <option value="">Select Prescription Type</option>
    							<option value="Repeat" <?php if ($row['mp_pres_type']=="Repeat") echo "selected"; ?> >Repeat</option>
                                <option value="Acute" <?php if ($row['mp_pres_type']=="Acute") echo "selected"; ?>>Acute</option>
										
		
								</select>
							</div>
                        
                        <h4 style="padding-top:20px">Medication Max Quantity and Interval Setup based on Condition</h4>    
                            <div class="form-group">
                            
   <?php for ($j=1;$j<=3;$j++) { ?>
                                
     <div class="row">
		<div class="col-lg-6 col-md-6">
            <label class="form-label">Condition <?php echo $j ?></label>
            <select  name="mp_condition<?php echo $j ?>" class="form-control">
            <option value="">Select Condition <?php echo $j ?></option>
            
             <?php
                                        $query = "SELECT * FROM tbl_conditions where condition_status=1 order by condition_title";
                                        $results = $database->get_results( $query );
                                                    
                                                foreach ($results as $value)
                                                 {
                                                     
                                                    
                                                    ?>
                                                <option value="<?php echo $value['condition_id']; ?>" <?php if ($row['mp_condition'.$j]==$value['condition_id']) echo "selected"; ?>><?php echo $value['condition_title']; ?></option>
                                                 <?php
                                                }
                                                ?>
                
            </select>
        </div>
        
        
        <div class="col-lg-3 col-md-3">
            <label class="form-label">Max Quantity</label>
            <input class="form-control mb-4" type="number" name="txtMaxQuantity<?php echo $j ?>" value="<?php echo $row['mp_condition'.$j.'_max_qty']?>" >
        </div>
        
        
        <div class="col-lg-3 col-md-3">
            <label class="form-label">Interval Days</label>
            <input class="form-control mb-4" type="number" name="txtInterval<?php echo $j ?>" value="<?php echo $row['mp_condition'.$j.'_interval_days']?>" >
        </div>
        
     </div>
     
     <?php } ?>
     
     
     
     
     
     
</div> 						<div class="form-group">
								<label class="form-label">Cost Price *</label>
								<input class="form-control mb-4" type="text" name="txtCostPrice" id="txtCostPrice" onkeyup="fnCalMedCost()" value="<?php echo $row['mp_cost_price']?>" required>
							</div>
                          
                          
                           <div class="form-group">
								<label class="form-label">Medication Cost *</label>
								<input class="form-control mb-4" type="text" name="txtMedCost" id="txtMedCost" value="<?php echo $row['mp_medication_cost']?>" readonly="readonly" >
							</div>
                            
                            
                            
                             <div class="form-group">
								<label >Dosage 1</label>
								<textarea   name="txtDosage1" rows="3" cols="80" class="form-control" ><?php echo $row['mp_dosage1']?></textarea>
							</div>
                            
                            <div class="form-group">
								<label >Dosage 2</label>
								<textarea   name="txtDosage2" rows="3" cols="80" class="form-control" ><?php echo $row['mp_dosage2']?></textarea>
							</div>
                            
                             <div class="form-group">
								<label >Approximate length of treatment</label>
								<textarea   name="txtApproxLength" rows="6" cols="80" class="form-control" ><?php echo $row['mp_length_treatment']?></textarea>
							</div>
                            
                           
                           
                            
                            

						


							<div class="form-group ">
						<div class="form-label">Medicine Availability</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoStock" id="rdoStock" value="1" <?php if($row['mp_in_stock']=="1" || $row['mp_in_stock']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Available</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoStock" id="rdoStock" value="0" <?php if($row['mp_in_stock']==0 && $row['mp_in_stock']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Unavailable</span>
							</label>
					
						</div>
					</div>
                    
                    						
                                            <h4 class="mb-5 mt-7 font-weight-bold">Price Override</h4>
                                            <div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label">Enable / Disable</label>
														</div>
														<div class="col-md-9">
															<label class="custom-switch">
																<input type="checkbox" value="1" name="ckOverride" id="ckOverride"  class="custom-switch-input" onchange="togglePriceOverride()" <?php if ($row['mp_override_active']==1) echo "checked"; ?>>
																<span class="custom-switch-indicator"></span>
																<!--<span class="custom-switch-description">Yes/No</span>-->
															</label>
														</div>
													</div>
												</div>
                                                <?php $totalOR_qty=1; ?>
                                                <div id="cont_price_override" <?php if ($row['mp_override_active']!=1) { ?> style="display:none" <?php } ?>>
													
                                                    <h6 style="color:#C30; font-size:16px">Please enter tier 1 price for quantities</h6>
													<div class="form-group">
                                                    
                                                   <?php 
												   if ($row['mp_override_price']!="")
												   {
												    $arrOR_price=unserialize(fnUpdateHTML($row['mp_override_price']));
												  		 // print_r ($arrOR_price);
														 $totalOR_qty=count($arrOR_price);
												   }
														 
														 if ($totalOR_qty>0)
														 {
															 
														for ($k=1;$k<=$totalOR_qty;$k++)
														{
															$priceOR=$arrOR_price[$k-1];
												    ?> 
                                                    
                                                    <div class="row" id="qty_row_<?php echo $k; ?>">
															<div class="col-xl-3">
																<label class="form-label mb-0 mt-2">Price of Quantity <?php echo $k; ?></label>
															</div>
															<div class="col-xl-4">
																<input type="text" class="form-control" name="txtOR[]" id="txtOR_<?php echo $k; ?>" placeholder="" value="<?php echo $priceOR; ?>">
															</div>
														</div>
                                                   <?php }
												   } else { ?>
                                                   
                                                   <div class="row" id="qty_row_1">
															<div class="col-xl-3">
																<label class="form-label mb-0 mt-2">Price of Quantity 1</label>
															</div>
															<div class="col-xl-4">
																<input type="text" class="form-control" name="txtOR[]" id="txtOR_1" placeholder="" value="">
															</div>
														</div>
                                                   
                                                   
                                                   <?php } ?>
                                                        
                                                        
                                                        
                                                        
                                                        <div class="row" style="padding-top:15px">
															<div class="col-xl-3">
                                                            </div>
                                                            <div class="col-xl-4">
                                                            <button class="btn btn-pill btn-secondary" type="button" onclick="addNewRow()">Add More</button>
                                                            </div>
                                                         </div>
                                                        
                                                        
                                                        
													</div>
													
													
												</div>
											
				
						
					<div class="row row-sm">
					<div class="col-lg">
					<button id="submitBtn"  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

<input type="hidden" name="pageId" value="<?php echo $row['mp_id']?>" />	

	</form>	
   </div>
  </div>				
								</div>
                                
<?php if ($row['med_image']!="")
	  $pImageStr="'".$row['med_image']."'";	
	  
	  
	
	  	 
			  ?>

 <script language="javascript">
 
 $(document).ready(function() {
    // Set an initial variable for the row count
    rowCount = <?php echo $totalOR_qty; ?>; // Adjust this if you already have rows populated on the edit page
    
    // Check if rows exist on page load and adjust rowCount accordingly
    while ($('#qty_row_' + rowCount).length > 0) {
        rowCount++;
    }
});
 
  function togglePriceOverride() {
        if ($('#ckOverride').is(':checked')) {
            $('#cont_price_override').show();
        } else {
            $('#cont_price_override').hide();
        }
    }
	
	function addNewRow() {
	
    // Generate HTML for the new row using backticks for template literals
    const newRow = `
        <div class="row" id="qty_row_${rowCount}" style="padding-top: 15px;">
            <div class="col-xl-3">
                <label class="form-label mb-0 mt-2">Price of Quantity ${rowCount}</label>
            </div>
            <div class="col-xl-4">
                <input type="text" class="form-control" name="txtOR[]" id="txtOR_${rowCount}" placeholder="" value="">
            </div>
        </div>`;

    // Append the new row after the last row
    $('#qty_row_' + (rowCount - 1)).after(newRow);
    
    // Increment the row count
    rowCount++;
}

 
 function fnCalMedCost() {
    var costPrice = parseFloat($("#txtCostPrice").val()); // Convert input value to a float

    if (costPrice <= 6.5) {
        $("#txtMedCost").val("4");
    } else if (costPrice > 6.5 && costPrice <= 10) {
        $("#txtMedCost").val("8");
    } else if (costPrice > 10) {
        $("#txtMedCost").val(costPrice); // Assign costPrice value directly
    } else {
        $("#txtMedCost").val("4");
    }
}

 
 
$(document).ready(function(){
	$('#images4ex').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../images/medication',
		orakuploader_thumbnail_path : '../images/medication',
		
		orakuploader_use_main : true,
		orakuploader_use_sortable : true,
		orakuploader_use_dragndrop : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 800,
		orakuploader_thumbnail_size  : 800,
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

