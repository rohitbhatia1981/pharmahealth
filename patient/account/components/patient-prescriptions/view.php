		

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
				
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
        
        <div class="tab-menu-heading hremp-tabs p-0 ">
        <div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
                                        <li><a href="?c=<?php echo $_GET['c']?>"  <?php if ($_GET['ty']=="") { ?> class="active" <?php } ?> >My Orders</a></li>
										<li ><a href="?c=<?php echo $_GET['c']?>&ty=in" <?php if ($_GET['ty']=="in") { ?> class="active" <?php } ?>>Incomplete Orders</a></li>
											
											
											
										</ul>
									</div>
             </div>
        
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
							<div class="e-table">
                            
                            
                            
                            
							<div class="row">
                            
                            <?php if ($_GET['ty']!="in") { ?>
                           
                           					<div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Search by Order No.:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>">
															</div>
														</div>
													</div>
                                                 
                                                 
                                                 
                           
                           
											
											
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter by Status:</label>
                                                    
                                                  
                                                    
													<select name="cmbCategory"  class="form-control custom-select select2" data-placeholder="All">
														<option label="All"></option>
                                                        <option value="1" <?php if ($_GET['cmbCategory']==1) echo "selected"; ?>>Pending</option>
                                                        <option value="2" <?php if ($_GET['cmbCategory']==2) echo "selected"; ?>>Query</option>
                                                        <option value="3" <?php if ($_GET['cmbCategory']==3) echo "selected"; ?>>Ready for collection</option>
                                                        <option value="4" <?php if ($_GET['cmbCategory']==4) echo "selected"; ?>>Rejected</option>
                                                        <option value="5" <?php if ($_GET['cmbCategory']==5) echo "selected"; ?>>Cancelled</option>
                                                        <option value="6" <?php if ($_GET['cmbCategory']==6) echo "selected"; ?>>Approved by Clinician</option>
														
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
                                        <?php } ?>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												<th width="14%" class="border-bottom-0">Date</th>
                                                <th width="19%" class="border-bottom-0">Order No.</th>
                                                <th width="27%" class="border-bottom-0">Medical Condition</th>                                                
                                                <th width="25%" class="border-bottom-0">Medication</th>
                                                <th width="25%" class="border-bottom-0">Price</th>
                                                <th width="15%" class="border-bottom-0 w-20">Order Status</th>
                                                <th width="15%" class="border-bottom-0 w-20"><?php if ($_GET['ty']!="in") { ?> Re-order Status <?php } ?></th>
											</tr>
										</thead>
							<?php

							
					
						
						/*$sqlPres="select * from tbl_prescriptions where pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' order by pres_id desc";
						$resPres=$database->get_results($sqlPres);
						$totalRecords=count($resPres);*/
						
						if($totalRecords > 0) 

							{

						
						for ($k=0;$k<$totalRecords;$k++)
						{
							
							$rowPres=&$rows[$k];
						
						?>



									
							<tbody>
								<tr>
									
									<td class="align-middle">
										
										<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
                                        
                                        <?php 
									if ($rowPres['pres_same_day']==1) { ?>
                                    <br />	
                                    <span class="badge badge-danger mt-2">Same-day</span>
                                    <?php } ?>	
											
									</td>
                                    <td class="align-middle">
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    <a href="?c=patient-prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a>
										
												
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle">
										
												<?php echo getConditionName($rowPres['pres_condition']); ?>
											
									</td>
                                    
                                     <td class="align-middle">
										
												<?php 
																echo getMedicationStringWithInfo($rowPres['pres_id']);
															
                                                            
                                                            
                                                            ?>
                                                           
                                                           <?php if ($rowPres['pres_medicine_change_status']==2)
														   {
														   echo "<br><a href='?c=patient-prescriptions&task=detail&tab=order&id=".$rowPres['pres_id']."' style='font-size:13px; color:#F00; font-weight:500;'><i class='feather-alert-circle'></i> &nbsp;Clinician suggested medication change</a>";
														   ?>
                                                           <br />
                                                           <a href="?c=patient-prescriptions&task=detail&tab=order&id=<?php echo $rowPres['pres_id']; ?>" style="font-size:12px; text-decoration:underline; color:#06F">Review Change</a>
                                                           
                                                           <?php }
														   ?>
                                                           
                                                           
											
									</td>
                                    
                                    <td class="align-middle">
										
										<?php $totalPriceCharged=getOrderPrice($rowPres['pres_id']);
										if ($totalPriceCharged!="") echo CURRENCY.$totalPriceCharged; ?>		 
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<?php 
															
															print getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']);
															
															if ($rowPres['pres_stage']==1)
															{ ?>
                                                            <br />
                                                            	<a href="?c=<?php echo $_GET['c']?>&task=cancel&id=<?php echo $rowPres['pres_id']; ?>" style="font-size:12px; color:#06F">Cancel your order</a>
                                                            <?php } ?>
															
															
															
															
                                                            <?php echo $val; ?>
                                                            
                                                           
											</div>
										</div>
									</td>
                                    <?php if ($_GET['ty']!="in") { ?>
									<td>
                                    
                                    		<?php 
											if ($rowPres['pres_stage']==3 || $rowPres['pres_stage']==7 ) { 
											
											$dateFromDatabase = $rowPres['pres_expiry_date']; 
											$reorder_activate = date('Y-m-d', strtotime($dateFromDatabase . ' -28 days'));
																					
											$currentDate = date('Y-m-d');
											
											$reorder_expiry = date('Y-m-d', strtotime($dateFromDatabase . ' +12 months'));
											
											// Compare the two dates
																				
											
											
												
												if ($reorder_activate<=$currentDate)
												{
											?>
                                            
                                            
                                            
                                                    <a href="?c=patient-prescriptions&task=reorder&id=<?php echo $rowPres['pres_id']?>" class="btn btn-red">Re-Order Medicine</a>
                                                    <?php
													
													 $reorder_expiry = date('Y-m-d', strtotime($dateFromDatabase . ' +12 months'));
												}
												else
												{ ?>
													Not Due Yet <img title="Re-0rder option will be available 28 days prior to your current supply ending." src="<?php echo URL?>images/i-icon.png" style="max-width:24px" />
												<?php }
												
													 
													
											 
                                            
                                             } else { 
											
											echo "<font style='color:#ff0000'>-</font>"; 
											 } 
											 
											?>
                                    
                                    </td>
                                    <?php } else { ?>
                                    <td><a href="?c=patient-prescriptions&task=incomplete&id=<?php echo $rowPres['pres_id']?>" class="btn btn-green">Click to complete</a> <br />
                                    
                                    <a href="javascript:void(0)" style="font-size:13px; color:#06F" onclick="deleteInOrder(<?php echo $rowPres['pres_id']?>)">Delete order</a>
                                    </td>
                                    <?php } ?>
                                    

									
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
            
            <script language="javascript">
			function deleteInOrder(pid)
				{
					ans=confirm("Are you sure you want to delete this incomplete order?");
					if (ans==true)					
					window.location='?c=<?php echo $_GET['c']?>&task=deleted&id='+pid;
				}
			</script>
			


             <?php } ?>

	<!-----------End Listing function------------------>

    

    

     <?php 
	 
	 //--------- cancellation page----
	 
	 function createFormForPagesHtml_cancel(&$rows) {
		 
	$row=array();
	global $component, $database;
	$row = &$rows[0];	

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";
		$getmenuid = $database->get_results( $sqlmenuid );
		$menuid = $getmenuid[0]; ?>
        
        <div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Order Cancellation</h4>
	</div>
	<div class="page-rightheader ml-md-auto">
		<div class=" btn-list">
		<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
															</a>
		</div>
	</div>
</div>


<div class="row">
		<div class="col-lg-12 col-md-12">

<div class="main-content">
					<div class="container">
                    
                    
                    <?php
					
						$sqlPres="select * from tbl_prescriptions where pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' and pres_id='".$database->filter($_GET['id'])."'  order by pres_id desc ";
						$resPres=$database->get_results($sqlPres);
						$rowPres=$resPres[0];
						
						if ($rowPres['pres_stage']!="1")
						{
							print "<script>window.location='?c=patient-prescriptions'</script>";
						}
							
					?>

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-4 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Order Status: <?php echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?></div>
									</div>
                                    
                                    
                                    
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table">
												<tbody>
													
													<tr>
														<td>
															<span class="w-50">Order Number</span>
														</td>
														<td>:</td>
														<td>
															PH-<?php echo $rowPres['pres_id'] ?>
														</td>
													</tr>
													
													<tr>
														<td>
															<span class="w-50">Order Date</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
                                                            
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Condition</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getConditionName($rowPres['pres_condition']) ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td valign="top">
															<span class="w-50">Medication</span>
														</td>
														<td>:</td>
														<td>
															<?php 
																
																	
																	echo getMedicationStringWithInfo($rowPres['pres_id']);
															
                                                            
                                                            
                                                            ?>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50"> Price</span>
														</td>
														<td>:</td>
														<td>
															<?php $totalPriceCharged=getOrderPrice($rowPres['pres_id']);
																if ($totalPriceCharged!="") echo CURRENCY.$totalPriceCharged; ?>	
														</td>
													</tr>
                                                    
                                                   
                                                    
                                                    
                                                    
													
													
													
                                                    
                                                    
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Valid Till</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        <?php 
														
														
														
														if ($rowPres['pres_expiry_date']!="")
															  echo fn_GiveMeDateInDisplayFormat($rowPres['pres_expiry_date']);
															  else
															  echo "-";
														?>
															  
															
														</td>
													</tr>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    <?php if ($rowPres['pres_stage']==3 || $rowPres['pres_stage']==7) { ?>
                                                    <tr><td colspan="3" align="center"><a href="javascript:void(0);" class="btn btn-pink">Re-Order Medicine</a></td>
                                                    <?php } ?>
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
								
							</div>
							<div class="col-xl-8 col-md-12 col-lg-12">
                            
                            
								
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										
										
										<div class="tab-pane active" id="tab7">
											<div class="card-body">
												
                                                
                                                <div class="card" id="contSendMessage">
								<div class="card-header border-0">
									<h4 class="card-title">Are you sure you want to cancel the order?</h4>
								</div>
								<div class="card-body" >
                                <!----------form of new message-------->
                                <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=cancelorder" method="post" class="form-horizontal" enctype="multipart/form-data">
                                
                                    
                                    <select class="form-control" name="cmdReason" id="cmdReason" onchange="showMessage()" required>
                                    	<option value="" style="display:none">Select a reason</option>
                                        <option value="I no longer require the medication">I no longer require the medication</option>
                                        <option value="I did not complete the medical assessment correctly">I did not complete the medical assessment correctly</option>
                                        <option value="Other">Other</option>
                                        
                                    </select>
                                    
									
                                    <div style="padding-top:20px;display:none" id="cont_message">
                                   
                                    <textarea rows="5" class="form-control" cols="50" name="txtReason"  placeholder="Please enter the reason *"></textarea></div>
                                    
                                    
                                    
                                    <div style="height:20px"></div>
									
                                    
                                  <div class="card-footer">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a  href="?c=<?php echo $_GET['c']?>" class="btn btn-danger">Cancel</a>
								</div>  
                                <input type="hidden" name="hid" value="<?php echo $_GET['id']?>" />
								</form>	
                                
                                <!----------End form of new message-------->
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
<script language="javascript">
function showMessage()
{
	if ($("#cmdReason").val()=="Other")
	{
		$("#cont_message").show();
	}
	else
	$("#cont_message").hide();
	
}



</script>
        
        
		 
	<?php }
	 
	 //----------end cancellation page----
	 
	 
	 
	  //--------- cancellation page----
	 
	 function createFormForPagesHtml_reorder(&$rows) {
		 
	$row=array();
	global $component, $database;
	$row = &$rows[0];	

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";
		$getmenuid = $database->get_results( $sqlmenuid );
		$menuid = $getmenuid[0]; ?>
        
        <div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Reorder Confirmation</h4>
	</div>
	<div class="page-rightheader ml-md-auto">
		<div class=" btn-list">
		<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
															</a>
		</div>
	</div>
</div>


<div class="row">
		<div class="col-lg-12 col-md-12">

<div class="main-content">
					<div class="container">
                    
                    
                    <?php
					
						$sqlPres="select * from tbl_prescriptions,tbl_patients where pres_patient_id=patient_id and pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' and pres_id='".$database->filter($_GET['id'])."'  order by pres_id desc ";
						$resPres=$database->get_results($sqlPres);
						$rowPres=$resPres[0];
						
						/*if ($rowPres['pres_stage']!="3" || $rowPres['pres_stage']!="7")
						{
							print "<script>window.location='?c=patient-prescriptions'</script>";
						}*/
							
					?>

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-4 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Order Status: <?php echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?></div>
									</div>
                                    
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table">
												<tbody>
													
													<tr>
														<td>
															<span class="w-50">Order Number</span>
														</td>
														<td>:</td>
														<td>
															PH-<?php echo $rowPres['pres_id'] ?>
														</td>
													</tr>
													
													<tr>
														<td>
															<span class="w-50">Order Date</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
                                                            
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Condition</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getConditionName($rowPres['pres_condition']) ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td valign="top">
															<span class="w-50">Medication</span>
														</td>
														<td>:</td>
														<td>
															<?php 
																
																	
																	echo getMedicationStringWithInfo($rowPres['pres_id']);
															
                                                            
                                                            
                                                            ?>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50"> Price</span>
														</td>
														<td>:</td>
														<td>
															<?php $totalPriceCharged=getOrderPrice($rowPres['pres_id']);
																if ($totalPriceCharged!="") echo CURRENCY.$totalPriceCharged; ?>	
														</td>
													</tr>
                                                    
                                                    
                                                    
													
													
													
                                                    
                                                    
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Valid Till</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        <?php 
														
														
														
														if ($rowPres['pres_expiry_date']!="")
															  echo fn_GiveMeDateInDisplayFormat($rowPres['pres_expiry_date']);
															  else
															  echo "-";
														?>
															  
															
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Nominated Pharmacy</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        <?php 
														
														getPharmacyName($rowPres['patient_pharmacy']);
														
														
														?>
															  
															
														</td>
													</tr>
                                                    
                                                    
                                                    
                                                    
                                                    
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
								
							</div>
							<div class="col-xl-8 col-md-12 col-lg-12">
                            
                            
								
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										
										
										<div class="tab-pane active" id="tab7">
											<div class="card-body">
											
                                            <?php
											
											$dateFromDatabase = $rowPres['pres_expiry_date']; 
											$currentDate = date('Y-m-d');											
											$reorder_expiry = date('Y-m-d', strtotime($dateFromDatabase . ' +12 months'));
											
											// Compare the two dates
																				
											
											if ($reorder_expiry>$currentDate)
											{
											?>
                                                
                                                <div class="card" id="contSendMessage">
								<div class="card-header border-0">
									<h4>Has your medical circumstances changed (current medications or conditions) since your last order of this medication?</h4>
								</div>
								<div class="card-body" >
                                <!----------form of new message-------->
                                <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=savereorder" method="post" class="form-horizontal" enctype="multipart/form-data">
                                
                                    
                                    <select class="form-control" name="cmbReorder" id="cmbReorder" onchange="showReorder()" required>
                                    	<option value="">Select Answer</option>
                                        <option value="No">No, there is no change to my medical circumstance</option>
                                        <option value="Yes">Yes, there is a change to my medical circumstance</option>
                                        
                                        
                                    </select>
                                    
									
                                    <div style="padding-top:20px;color:#ff0000" id="cont_reorder">
                                   
                                   
                                    </div>
                                    
                                    
                                    
                                    <div style="height:20px"></div>
									
                                    
                                  <div class="card-footer">
									<button type="submit" id="btnSubmit_re" class="btn btn-primary">Submit</button>
									<a  href="?c=<?php echo $_GET['c']?>" class="btn btn-danger">Cancel</a>
								</div>  
                                <input type="hidden" name="hid" value="<?php echo $_GET['id']?>" />
								</form>	
                                
                                <!----------End form of new message-------->
								</div>
								
							</div>
                            <?php } else {?>
                            
                             <div class="card" id="contSendMessage">
                             
                             	<div class="card-header border-0">
									<h4>Your prescription is no longer active.</h4>
								</div>
								<div class="card-body" >
                                To insure this medication is still clinically suitable for you, you must complete a new medical assessment.
                                </div>
                                 <div class="card-footer" style="border-top:0px ">
                                  <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=savereorder" method="post" class="form-horizontal" enctype="multipart/form-data">
									<button type="submit" id="btnSubmit_re" class="btn btn-primary">Complete medical assessment</button>
                                    <input type="hidden" name="hid" value="<?php echo $_GET['id']?>" />
                                    </form>
									
								</div>  
                             </div>
                           
                            <?php } ?>
                          
                                                
                                                
												
                                              
												
												
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

       <script language="javascript">
	   
	   function showReorder()
	   {
		   
		   if ($("#cmbReorder").val()=="No")
		{
			$("#cont_reorder").html("By clicking the submit button, you are confirming that there have been no changes in your health circumstances, and you wish to proceed with reordering your medication");
			$("#btnSubmit_re").html("Submit");
		}
		else
		{
			$("#cont_reorder").html("You will have to re-complete the medical assessment form because you have told us your medical circumstances have changed");
			$("#btnSubmit_re").html("Start Questionnaire");
		}
	   }
		
		   
	   </script> 
        
		 
	<?php }
	 
	 //----------end reorder page----
	 
	 
	 
	 function createFormForPagesHtml_details(&$rows) {

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
	<h4 class="page-title">Order Details</h4>
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
                    
                    
                    <?php
					
						$sqlPres="select * from tbl_prescriptions,tbl_patients where pres_patient_id=patient_id and pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' and pres_id='".$database->filter($_GET['id'])."'  order by pres_id desc ";
						$resPres=$database->get_results($sqlPres);
						$rowPres=$resPres[0];
							
					?>

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-4 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Order Status: <?php echo  getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?></div>
                                        
									</div>
                                    <?php if ($rowPres['pres_stage']==4) { ?>
                                    <div style="clear:both "></div>
                                        <div style="padding-left:23px; color:#F00"><?php echo $rowPres['pres_rejection_reason']; ?></div>
                                    <?php } ?>
                                    
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table">
												<tbody>
													
													<tr>
														<td>
															<span class="w-50">Order Number</span>
														</td>
														<td>:</td>
														<td>
															PH-<?php echo $rowPres['pres_id'] ?>
														</td>
													</tr>
													
													<tr>
														<td>
															<span class="w-50">Order Date</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
                                                            
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Condition</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getConditionName($rowPres['pres_condition']) ?></span>
														</td>
													</tr>
                                                    
                                                   <tr>
														<td valign="top">
															<span class="w-50">Medication</span>
														</td>
														<td>:</td>
														<td>
															<?php 
																
																	
																	echo getMedicationStringWithInfo($rowPres['pres_id']);
															
                                                            
                                                            
                                                            ?>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50"> Price</span>
														</td>
														<td>:</td>
														<td>
															<?php $totalPriceCharged=getOrderPrice($rowPres['pres_id']);
																if ($totalPriceCharged!="") echo CURRENCY.$totalPriceCharged; ?>	
														</td>
													</tr>
                                                   
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Valid Till</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        <?php 
														
														
														
														if ($rowPres['pres_expiry_date']!="")
															  echo fn_GiveMeDateInDisplayFormat($rowPres['pres_expiry_date']);
															  else
															  echo "-";
														?>
															  
															
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Nominated Pharmacy</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        <?php 
														
														getPharmacyName($rowPres['patient_pharmacy']);
														
														
														?>
															  
															
														</td>
													</tr>
                                                    
                                                    <?php if ($rowPres['pres_stage']==3 || $rowPres['pres_stage']==7) { ?>
                                                    <tr><td colspan="3" align="center"><a href="javascript:void(0);" class="btn btn-pink">Re-Order Medicine</a></td>
                                                    <?php } ?>
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
								
							</div>
							<div class="col-xl-8 col-md-12 col-lg-12">
                            
                            
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
                                    
                                    
										<!-- Tabs -->
										<ul class="nav panel-tabs">
                                        <li><a href="#tab6" data-toggle="tab"  <?php if ($_GET['tab']=="") { ?> class="active" <?php } ?> >Completed Medical Assessment</a></li>
											<li ><a href="#tab5" data-toggle="tab" <?php if ($_GET['tab']=="order") { ?> class="active" <?php } ?>>Order Details</a></li>
											
											<li><a href="#tab7" <?php if ($_GET['tab']=="message") { ?> class="active" <?php } ?>  data-toggle="tab">Messages</a></li>
											
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane <?php if ($_GET['tab']=="order") { ?> active <?php } ?>" id="tab5">
											<div class="card-body">
												<div class="table-responsive">
										<table class="table card-table table-vcenter text-nowrap mb-0">
											<thead >
												<tr>
													
													<th>Medication</th>
                                                   
													<th>Pack Quantity</th>                                                    
													<th>Total Price</th>
                                                    <th>Dosage</th>
												</tr>
											</thead>
											<tbody>
                                            
                                            
                                            <?php
											$c=0;
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
											?>
                                            
                                            <?php if ($rowMedicine['pm_med_common']==1 && $c==0) { ?>
                                            <tr><td colspan="4" style="font-weight:bold">Commonly Bought Medications</td></tr>
                                            <?php
											$c=1; 
											} ?>
												<tr>
													<td><?php echo $rowMedicine['pm_med']; ?><br />
                                                    <?php if ($rowMedicine['pm_med_common']==0) { ?>
                                                    <?php echo "Strength: ".$rowMedicine['pm_med_strength']; ?> , <?php echo "Packsize: ". $rowMedicine['pm_med_packsize']; ?>
                                                    <?php } ?>
                                                    </td>
                                                    
													<td><?php echo $rowMedicine['pm_med_qty']; ?></td>
                                                    
													<td><?php echo CURRENCY?><?php echo $rowMedicine['pm_med_total']; ?></td>
                                                    <td><?php if ($rowMedicine['pm_med_dosage']!="") echo $rowMedicine['pm_med_dosage']; else echo "-"; ?></td>
												</tr>
                                             
                                             <?php } ?>
                                             
                                             <?php 
											  $sqlPayment="select * from tbl_payments where payment_pres_id='".$database->filter($rowPres['pres_id'])."'";
											  $resPayment=$database->get_results($sqlPayment);
											  $rowPayment=$resPayment[0];
											 
											 if ($rowPres['pres_same_day']==1) {
												 
												
												  ?>
                                             <tr><td></td><td>Same-day Service</td><td><?php echo CURRENCY.$rowPayment['payment_sameday']?></td><td></td></tr>
                                            
                                             <?php } ?>
                                             <?php $totalAmount=$rowPayment['payment_amount']; ?>
                                              <tr><td></td><td>Total Amount</td><td><?php echo CURRENCY.$totalAmount?></td><td></td></tr>
                                            
											</tbody>
										</table>
                                        
                                        	
                                         <?php
										 if ($rowPres['pres_medicine_change_status']==3) { ?> <br /><font style="color:#090">* Your medication has been updated based on the clinician's suggestions.</font><?php } 
                                         
										 
										  if ($rowPres['pres_medicine_change_status']==2 || $rowPres['pres_medicine_change_status']==4)
											 {	 
												 ?>
                                                  <br /><br />
                                                 <div style="border:1px solid #F60; padding:20px">
                                               
                                                
                                                 <h4 style="padding-left:20px">Change of medication suggested by Clinician </h4>
                                                 
                                                <table class="table card-table table-vcenter text-nowrap mb-0">
											<thead >
												<tr>
													
													<th>Medication</th>
													<th>Quantity</th>
													<th>Price</th>
                                                    
												</tr>
											</thead>
											<tbody>
                                            
                                            
                                            <?php
												$sqlMedicine="select * from tbl_prescription_medicine_change_requests where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
												$resMedicine=$database->get_results($sqlMedicine);
												
												$totalPriceNew=0;
												
													for ($m=0;$m<count($resMedicine);$m++)
														{
															$rowMedicine=$resMedicine[$m];
															
															
												?>
                                            
                                                            <tr>
                                                                <td><?php echo $rowMedicine['pm_med']; ?> <br />
                                                                (Strength: <?php echo $rowMedicine['pm_med_strength']; ?>, Packsize: <?php echo $rowMedicine['pm_med_packsize']; ?>) 
                                                                </td>
                                                                <td><?php echo $rowMedicine['pm_med_qty']; ?></td>
                                                                <td><?php echo CURRENCY?><?php echo $rowMedicine['pm_med_total']; ?></td>
                                                                
                                                            </tr>
                                             
                                           	  <?php 
											  		$totalPriceNew=$totalPriceNew+$rowMedicine['pm_med_total'];
											  } ?>
                                              
                                               <?php if ($rowPres['pres_same_day']==1) {
												 
												$totalPriceNew=$totalPriceNew+$rowPayment['payment_sameday'];
												  ?>
                                             <tr><td></td><td>Same day service</td><td><?php echo CURRENCY.$rowPayment['payment_sameday']?></td></tr>
                                            
                                             <?php }
											 
											  $_SESSION['sessNewPrice']=$totalPriceNew;
											 
											  ?>
                                              <tr><td></td><td>Total Amount</td><td><?php echo CURRENCY.$totalPriceNew?></td></tr>
                                             
                                            
											</tbody>
										</table>
                                        <br />
                                        <div style="padding-left:20px"><strong>Reason for Change:</strong> <?php echo $rowPres['pres_med_change_reason']; ?></div>
                                        
                                        
                                        
                                        <div style="height:20px"></div>
                                        <div class="ml-auto" align="right">
												<!--<a href="#" class="btn btn-outline-primary">Reject</a>-->
                                                
                                                <input type="checkbox" name="ckApprove" id="ckApprove" value="1" /> I accept the updated medication and pricing <br />
                                                <div id="showTermError" style="color:#F00;padding-bottom:10px"></div>
												<a href="javascript:;" class="btn btn-primary" onclick="fnAcceptMedicine()">Approve New Medication</a>
											</div>
                                        
										</div>	
                                        
                                        <script language="javascript">
										function fnAcceptMedicine()
										{
											tm=$('#ckApprove').is(':checked');
											
											if (tm==false)
											{
												$("#showTermError").html("Please accept the updated medication and pricing");
												return false;
											}
											
											
											
											
											ans=confirm ("This will replace your selected medication with the one recommended by the clinician. Are you sure you want to proceed?");
											if (ans==true)
											{
												$.post('ajax/update-med.php', { prId: <?php echo $_GET['id']?> }, function(response) {
													// Handle the response from the PHP page
												
												  //alert (response);
												  if (response==1)
												  {
													 location.reload();
												  }
												  else
												  {
													  alert ("Something went wrong! Please check your login session or contact admin");
												  }
       											 });
											}
										}
										</script>
                                        
                                        	
											<?php } ?>
									</div>
											</div>
										</div>
										<div class="tab-pane <?php if ($_GET['tab']=="") { ?> active <?php } ?>" id="tab6">
											<div class="card-body">
												<div class="table-responsive">
                                                
                                               <div class="table-responsive">
                                              
                                              <p style="font-size:18px; font-weight:bold">Following information you have filled for medical questionnaire
                                              </p> 
                                              
                                              <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">About You</h4>  
                                             
                                             <?php 
											 $aboutYou=unserialize(fnUpdateHTML($rowPres['pres_about_you']));
											 
											
											  ?>
                                             
                                             
											<table class="table">
												<tbody>
                                                
                                                <?php foreach($aboutYou as $que => $val) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
														<td>
															<?php echo base64_decode($que) ?> :
														</td>
														
														<td width="50%" style="color:#03C">
                                                        
                                                        <?php echo base64_decode($val) ?>
															
														</td>
													</tr>
                                                    
                                            <?php } ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                             <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">Your Symptoms</h4>  
                                             
                                             <?php 
											 
											 $symptoms=unserialize(fnUpdateHTML($rowPres['pres_symptoms']));
											// $symptoms_more=unserialize(fnUpdateHTML($rowPres['pres_symptoms_more']));
											
											
											
											  ?>
                                             
                                             
											<table class="table" cellpadding="0" cellspacing="0">
												<tbody>
                                                
                                                <?php 
												if (is_array($symptoms))
												for($a=0;$a<count($symptoms);$a++) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
                                                    
                                                    	
                                                    
														<td width="50%">
															<?php echo base64_decode($symptoms[$a]['question']); //echo base64_decode($symptoms[$a]['question']) ?> :
														</td>
														<!--<td width="5%" style="vertical-align:top !important">
                                                        
                                                        <?php
														
														$riskVal="";
														$riskVal=base64_decode($symptoms[$a]['risk']);
														
														$imageType=base64_decode($symptoms[$a]['image']);
														
														$answer=base64_decode($symptoms[$a]['answer']);
														
														
														
														/*	if ($riskVal==1 && strpos($answer, "~~~") == false)
															echo '<div class="circle-green"></div>';
															else if ($riskVal==2)
															echo '<div class="circle-orange"></div>';
															else if ($riskVal==3)
															echo '<div class="circle-red"></div>';*/
														
														
														?>
                                                        
                                                        </td>-->
														<td width="50%" style="color:#03C; vertical-align:top !important" valign="top">
                                                        
                                                        	
                                                                
                                                        
                                                        
                                                        <?php 
														
														
														
														
														if (strpos($answer, "~~~") !== false)
														 {
															echo '<table width="100%" border="1px" style="border-color:#CCC">
                                                            	<tr>';
															$arrAnswer=explode("|",$answer);
															
															for ($k=0;$k<count($arrAnswer);$k++)
															{
																$arrAnsB=explode("~~~",$arrAnswer[$k]);
																
																$riskVal=$arrAnsB[1];
																
																	/*if ($riskVal==1)
																	echo '<td><div class="circle-green"></div></td>';
																	else if ($riskVal==2)
																	echo '<td><div class="circle-orange"></div></td>';
																	else if ($riskVal==3)
																	echo '<td><div class="circle-red"></div></td>'; */
																
																echo "<td>".$arrAnsB[0]."</td>";
																echo "</tr>";
																
															}
															
															echo "</tr></table>";
															
														}
														else
														{
														if ($imageType==1)
														{
														
															if ($answer!="")
															{
																$arrImage=array();
																$arrImage=explode(",",$answer);
																$strImages="<div class='row'>";
																for ($j=0;$j<count($arrImage);$j++)
																{
																$imageRep=$arrImage[$j];																
																$strImages.="<div class='col-md-6'><img src='".URL."patient/questionnaire/images/replies/".$imageRep."' style='max-height:200px'>";
																$strImages.="</div>";
																}
																$strImages.="</div>";
																print $strImages;
															}
														}
														else
														echo $answer;
														}
														
														 ?>
                                                         
                                                         
                                                         
                                                          <br /><br />
                                                        
                                                        <?php
														if ($symptoms[$a]['more']!="")
														 echo "<font style='color:#999'>Additional information:</font> ".base64_decode($symptoms[$a]['more']) ?>
															
														</td>
													</tr>
                                                    
                                            <?php }
											
											
											
											
											 ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                             <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">Your Medical History</h4>  
                                             
                                             <?php 
											
											 $medicalHistory=unserialize(fnUpdateHTML($rowPres['pres_medical_history']));
											 
											
											  ?>
                                             
                                             
											<table class="table" cellpadding="0" cellspacing="0">
												<tbody>
                                                
                                                <?php 
												if (is_array($medicalHistory))
												for($a=0;$a<count($medicalHistory);$a++) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
                                                    
                                                    	
                                                    
														<td width="50%">
															<?php echo base64_decode($medicalHistory[$a]['question']); //echo base64_decode($medicalHistory[$a]['question']) ?> :
														</td>
														<!--<td width="5%" style="vertical-align:top !important">
                                                        
                                                        <?php
														
														$riskVal="";
														$riskVal=base64_decode($medicalHistory[$a]['risk']);
														
														$imageType=base64_decode($medicalHistory[$a]['image']);
														
														
														$answer=base64_decode($medicalHistory[$a]['answer']);
														
															if ($riskVal==1 && strpos($answer, "~~~") == false)
															echo '<div class="circle-green"></div>';
															else if ($riskVal==2)
															echo '<div class="circle-orange"></div>';
															else if ($riskVal==3)
															echo '<div class="circle-red"></div>';
														
														
														?>
                                                        
                                                        </td>-->
														<td width="50%" style="color:#03C; vertical-align:top !important">
                                                        
                                                        	
                                                                
                                                        
                                                        
                                                        <?php 
														
														
														
														
														if (strpos($answer, "~~~") !== false)
														 {
															echo '<table width="100%" border="1px" style="border-color:#CCC">
                                                            	<tr>';
															$arrAnswer=explode("|",$answer);
															
															for ($k=0;$k<count($arrAnswer);$k++)
															{
																$arrAnsB=explode("~~~",$arrAnswer[$k]);
																
																$riskVal=$arrAnsB[1];
																
																	/*if ($riskVal==1)
																	echo '<td><div class="circle-green"></div></td>';
																	else if ($riskVal==2)
																	echo '<td><div class="circle-orange"></div></td>';
																	else if ($riskVal==3)
																	echo '<td><div class="circle-red"></div></td>'; */
																
																echo "<td>".$arrAnsB[0]."</td>";
																echo "</tr>";
																
															}
															
															echo "</tr></table>";
															
														}
														else if ($imageType==1)
														{
															if ($answer!="")
															{
																$arrImage=array();
																$arrImage=explode(",",$answer);
																$strImages="<div class='row'>";
																for ($j=0;$j<count($arrImage);$j++)
																{
																$imageRep=$arrImage[$j];																
																$strImages.="<div class='col-md-6'><img src='".URL."patient/questionnaire/images/replies/".$imageRep."' style='max-height:200px'>";
																$strImages.="</div>";
																}
																$strImages.="</div>";
																print $strImages;
															}
														}
														else
														echo $answer;
														
														 ?>
                                                         
                                                         
                                                         
                                                          <br /><br />
                                                        
                                                        <?php
														if ($medicalHistory[$a]['more']!="")
														 echo "<font style='color:#999'>Additional information:</font> ".base64_decode($medicalHistory[$a]['more']) ?>
															
														</td>
													</tr>
                                                    
                                            <?php }
											
											
											
											
											 ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                             <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">Your Medication History</h4>  
                                             
                                             <?php 
											 $medication=unserialize(fnUpdateHTML($rowPres['pres_medication']));
											
											//print_r ($medication);
											
											  ?>
                                             
                                             
											<table class="table" cellpadding="0" cellspacing="0">
												<tbody>
                                                
                                                <?php 
												if (is_array($medication))
												for($a=0;$a<count($medication);$a++) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
                                                    
                                                    	
                                                    
														<td width="50%">
															<?php echo base64_decode($medication[$a]['question']); //echo base64_decode($medication[$a]['question']) ?> :
														</td>
														<!--<td width="5%" style="vertical-align:top !important">
                                                        
                                                        <?php
														
														$riskVal="";
														$riskVal=base64_decode($medication[$a]['risk']);
														
														$imageType=base64_decode($medication[$a]['image']);
														
														
														$answer=base64_decode($medication[$a]['answer']);
														
															if ($riskVal==1 && strpos($answer, "~~~") == false)
															echo '<div class="circle-green"></div>';
															else if ($riskVal==2)
															echo '<div class="circle-orange"></div>';
															else if ($riskVal==3)
															echo '<div class="circle-red"></div>';
														
														
														?>
                                                        
                                                        </td>-->
														<td width="50%" style="color:#03C; vertical-align:top !important">
                                                        
                                                        	
                                                                
                                                        
                                                        
                                                        <?php 
														
														
														
														
														if (strpos($answer, "~~~") !== false)
														 {
															echo '<table width="100%" border="1px" style="border-color:#CCC">
                                                            	<tr>';
															$arrAnswer=explode("|",$answer);
															
															for ($k=0;$k<count($arrAnswer);$k++)
															{
																$arrAnsB=explode("~~~",$arrAnswer[$k]);
																
																$riskVal=$arrAnsB[1];
																
																	/*if ($riskVal==1)
																	echo '<td><div class="circle-green"></div></td>';
																	else if ($riskVal==2)
																	echo '<td><div class="circle-orange"></div></td>';
																	else if ($riskVal==3)
																	echo '<td><div class="circle-red"></div></td>'; */
																
																echo "<td>".$arrAnsB[0]."</td>";
																echo "</tr>";
																
															}
															
															echo "</tr></table>";
															
														}
														else if ($imageType==1)
														{
															if ($answer!="")
															{
																$arrImage=array();
																$arrImage=explode(",",$answer);
																$strImages="<div class='row'>";
																for ($j=0;$j<count($arrImage);$j++)
																{
																$imageRep=$arrImage[$j];																
																$strImages.="<div class='col-md-6'><img src='".URL."patient/questionnaire/images/replies/".$imageRep."' style='max-height:200px'>";
																$strImages.="</div>";
																}
																$strImages.="</div>";
																print $strImages;
															}
														}
														else
														echo $answer;
														
														 ?>
                                                         
                                                         
                                                         
                                                          <br /><br />
                                                        
                                                        <?php
														if ($medication[$a]['more']!="")
														 echo "<font style='color:#999'>Additional information:</font> ".base64_decode($medication[$a]['more']) ?>
															
														</td>
													</tr>
                                                    
                                            <?php }
											
											
											
											
											 ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                              <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">GP Details</h4>  
                                            
                                            	<table class="table">
												<tbody>
                                                <?php  
													 $sqlGP="select * from tbl_patient_gps where pg_patient_id='".$_SESSION['sess_patient_id']."'";
													$resGP=$database->get_results($sqlGP);
													$rowGP=$resGP[0];
													
													if ($rowGP['pg_option']==1)
													{									
												 ?>
                                                	<tr><td width="50%">GP Name</td><td><?php echo $rowGP['pg_gp'] ?></td></tr>
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==2)
													{									
												 ?>
                                                	<tr><td>GP Practise</td><td><?php echo $rowGP['pg_gp_name'] ?></td></tr>
                                                    <tr><td>Address</td><td><?php echo $rowGP['pg_gp_address'] ?></td></tr>
                                                    <tr><td>Email</td><td><?php echo $rowGP['pg_gp_email'] ?></td></tr>
                                                    <tr><td>Telephone</td><td><?php echo $rowGP['pg_gp_phone'] ?></td></tr>
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==3)
													{									
												 ?>
                                                	<tr><td colspan=2>I don’t know my GP Practice details</td></tr>
                                                    
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==4)
													{									
												 ?>
                                                	<tr><td colspan=2> I do not have a registered GP in the UK</td></tr>
                                                    
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==5)
													{									
												 ?>
                                                	<tr><td colspan=2> I will take responsibility to inform my GP</td></tr>
                                                    
                                                    
                                                    <?php }
													
													
													 ?>
                                                    
                                                    
                                                </tbody>
                                                </table>
                                                
                                                <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">Accepted Disclaimer and Agreement</h4>  
                                            
                                            	<table class="table">
                                                <?php if ($rowPres['pres_disclaimer_file']!="") { ?>
													<tr><td width="50%">Disclaimer</td><td><a href="<?php echo URL?>uploads/patients/agreement/<?php echo $rowPres['pres_disclaimer_file']?>" target="_blank">View</a></td></tr>
                                                    <?php } ?>
                                                    <?php if ($rowPres['pres_agreement_file']!="") { ?>
                                                    <tr><td>Agreement</td><td><a href="<?php echo URL?>uploads/patients/agreement/<?php echo $rowPres['pres_agreement_file']?>" target="_blank">View</a></td></tr>
                                                     <?php } ?>
                                                </table>
                                            
										</div>
													
													
												</div>
											</div>
										</div>
										<div class="tab-pane <?php if ($_GET['tab']=="message") { ?> active <?php } ?>" id="tab7">
											<div class="card-body">
												<div class="pt-4 pb-4 text-end" align="right">
													<a  href="javascript:void(0);" onclick="showMessagebox()" class="btn btn-primary">Compose New Message</a>
												</div>
                                                
                                                <div class="card" id="contSendMessage" style="display:none" >
								<div class="card-header border-0">
									<h4 class="card-title" id="id_headingMsg"></h4>
								</div>
								<div class="card-body" >
                                <!----------form of new message-------->
                                <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=sendmessage" method="post" class="form-horizontal" enctype="multipart/form-data">
                                
                                    
                                    <select class="form-control" name="rdUser" id="rdUser">
                                    	<option value="">Choose the recipient for your message</option>
                                        <option value="Clinician">Send to Clinician</option>
                                        <option value="Admin">Send to Admin</option>
                                        
                                    </select>
                                    
									
                                    <div style="height:20px"></div>
                                    <div>
                                    
                                    <input type="text" class="form-control" name="txtSubject" id="txtSubject" placeholder="Please enter subject of your message *" maxlength="200"></div>
                                     <div style="height:20px"></div>
									<div>
                                   
                                    <textarea rows="5" class="form-control" cols="50" name="txtMessage" placeholder="Please enter the message *"></textarea></div>
                                    <div style="height:20px"></div>
									<div class="form-group">
										<label class="form-label">Upload Document (If any) <span style="color:#999">(file type allowed: pdf,jpg, png)</span></label>
										<div class="form-group">
										
										<input class="form-control" name="flDoc[]" type="file" accept=".pdf,.jpg,.png">
                                        
                                       	<div id="cont_addmore_1"></div>
                                        <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onclick="addMoreFile(1)">+ Add More Attachment</a></div>
                                        
                                        
										</div>
									</div>
                                    
                                  <div class="card-footer">
									<button type="submit" class="btn btn-primary">Send</button>
									<a  href="javascript:void(0);" onclick="showMessagebox_close()" class="btn btn-danger">Cancel</a>
								</div>  
                                <input type="hidden" name="hid" value="<?php echo $_GET['id']?>" />
								</form>	
                                
                                <!----------End form of new message-------->
								</div>
								
							</div>
                          
                                                
                                                
												
                                                
                                                 <?php 
														$sqlMessage="select * from tbl_messages where message_pres_id='".$database->filter($_GET['id'])."' and (message_sent_to='Patient' || message_sender_type='Patient') order by message_id desc";
														$resMessage=$database->get_results($sqlMessage);
														if (count($resMessage)>0)
														{
															
															for ($i=0;$i<count($resMessage);$i++)
															{
																
																$rowMessage=$resMessage[$i];																
																$mysqlDate = $rowMessage['message_date'];
																$timestamp = strtotime($mysqlDate);
																$formattedDate = date("d M Y", $timestamp);
																
																$formattedTime = date("H:i", $timestamp);
																
																//------------update message read---------
																
																if ($rowMessage['message_sent_to']=="Patient")
																changeReadStatus($rowMessage['message_id']);
																
																//-----------end update read---------
																
																
																				if ($rowMessage['message_sender_type']=="Patient")
																				{
																				$sqlSender="select * from tbl_patients where patient_id='".$rowMessage['message_sender_id']."'";
																				//else if ($rowMessage['message_sender_type']=="Clinician")
																				//$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['patient_first_name']." ".$rowSender['patient_middle_name']." ".$rowSender['patient_last_name']." (".$rowMessage['message_sender_type'].")";
																				$colorCss="primary";
																				}
																				else if ($rowMessage['message_sender_type']=="Clinician")
																				{
																					
																					$replierName=getPrescriberName($rowMessage['message_sender_id'])." (Clinicians)";
																					$colorCss="danger";
																				}


														
													?>
                                                    <div class="card shadow-none border">
													<div class="d-sm-flex p-5">
													
                                                    
                                                    
                                                    
                                                    	
														<div class="media-body">
															<h5 class="mt-1 mb-1 font-weight-semibold"><?php echo $rowMessage['message_subject']?> <span class="badge badge-<?php echo $colorCss;?>-light badge-md ms-2">Sent by: <?php echo $replierName; ?></span></h5>
															<small class="text-muted"><i class="fa fa-calendar"></i> <?php echo $formattedDate; ?> <i class=" ms-3 fa fa-clock-o"></i> <?php echo $formattedTime; ?></small>
                                                            
                                                            | <span style="color:#00F;font-size:13px"><strong>
                                                            	<?php if ($rowMessage['message_sent_to']=="Admin") echo 'Sent to Admin';
																if ($rowMessage['message_sent_to']=="Clinician") echo 'Sent to Clinician';
																if ($rowMessage['message_sent_to']=="Pharmacy") echo 'Sent to Pharmacy';
																if ($rowMessage['message_sent_to']=="Patient") echo 'Sent to you';
																 ?>
                                                                 </strong>
                                                                 </span>
															<p class="fs-13 mb-2 mt-1">
															   <?php echo $rowMessage['message_text']?>
															</p>
                                                            
                                                             <!---------Attachment of main message------------>
                                                            
                                                             <?php if ($rowMessage['message_attachment']!="") {
																 
																 $arrUnSerMes=unserialize(fnUpdateHTML($rowMessage['message_attachment']));
																
																  ?>
                                                                    
                                                                    <div class="row">
                                                                    
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
                                                                        <div class="col-lg-2 col-md-3">
                                                                            <a  href="<?php echo URL?>uploads/patients/<?php echo $arrUnSerMes[$j]; ?>" download class="attach-supportfiles">
                                                                                
                                                                                <?php if ($type=="image") { ?>
                                                                                <img src="<?php echo URL?>uploads/patients/<?php echo $arrUnSerMes[$j]; ?>" style="max-height:100px" alt="<?php echo $arrUnSerMes[0]; ?>" title="<?php echo $arrUnSerMes[0]; ?>" class="img-fluid">
                                                                                <div class="attach-title"><?php echo $arrUnSerMes[0]; ?></div>
                                                                                <?php } else { ?>
                                                                                <img src="<?php echo URL?>images/pdf.png" style="max-height:100px" alt="<?php echo $arrUnSerMes[0]; ?>" title="<?php echo $arrUnSerMes[0]; ?>" class="img-fluid">
                                                                                <div class="attach-title"><?php echo $arrUnSerMes[0]; ?></div>
                                                                                <?php } ?>
                                                                                
                                                                            </a>
                                                                        </div>
                                                                      <?php } ?>
												
											</div>
                                            <?php } ?> 
                                            <!-----------end attachment------->
                                            
                                            					<?php if ($rowMessage['message_sender_type']!="Patient") 
																{
																	if ($rowMessage['message_sender_type']=="Clinician")
																	$r=1;
																	if ($rowMessage['message_sender_type']=="Admin")
																	$r=2;
																	
																	?>
                                            
                                            						<br />
                                            
																	<a  href="javascript:void(0);" onclick="showMessagebox(<?php echo $r?>,'<?php echo $rowMessage['message_subject']?>')" class="me-2 mt-1"><span class="badge badge-orange"><i class="fa fa-reply"></i> Reply</span></a>
															   <?php } ?>
                                                            
                                                            <?php
																$sqlSub="select * from tbl_messages where message_parent_reply='".$rowMessage['message_id']."' order by message_id desc";
																$resSub=$database->get_results($sqlSub);
																if (count($resSub)>0)
																{
																	
																	for ($j=0;$j<count($resSub);$j++)
																	{
																		$rowSub=$resSub[$j];
																		
																		//--------Get sender details----
																		
																		//------------update message read---------
																
																		if ($rowSub['message_sender_type']!="Patient")
																		changeReadStatus($rowSub['message_id']);
																	
																		//-----------end update read---------
																		
																		$mysqlDate = $rowSub['message_date'];
																		$timestamp = strtotime($mysqlDate);
																		$formattedDate = date("d M Y", $timestamp);
																
																		$formattedTime = date("H:i", $timestamp);
																		
																			if ($rowSub['message_sender_type']=="Patient")
																				{
																				$sqlSender="select * from tbl_patients where patient_id='".$rowSub['message_sender_id']."'";
																				//else if ($rowMessage['message_sender_type']=="Clinician")
																				//$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['patient_first_name']." ".$rowSender['patient_middle_name']." ".$rowSender['patient_last_name']." (".$rowSub['message_sender_type'].")";
																				$colorCss="primary";
																				}
																				else if ($rowSub['message_sender_type']=="Clinician")
																				{
																					$replierName=getPrescriberName($row['message_sender_id'])." (Clinicians)";
																					$colorCss="danger";
																				}
																		
																		//--- end getting sender details---
															?>
                                                            
															
                                                            
                                                            <?php }
																}?>
                                                                
                                                               
														</div>
                                                        
                                                        
                                                        
                                                        
													</div>
                                                    </div>
                                                    
                                                    
                                                    <?php }
														} else
														
														echo "<p style='font-size:18px; padding:30px'>No communication yet for this order</p>";
														?>
												
												
											</div>
										
										
										
										
										
									</div>
										
										
										
										<div class="tab-pane" id="tab11">
											<div class="card-body">
												No log history yet!
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row-->

					</div><!-- end app-content-->
				</div>


<script language="javascript">

function showMessagebox(r=0,subj='')
{
	if (r==0)
	{
	$("#contSendMessage").show(500);
	
	$("#rdUser option:eq(0)").show();
	$("#rdUser option:eq(1)").show();
	$("#rdUser option:eq(2)").show();
	
	$("#rdUser option:eq(0)").prop('selected', true);
	
	
	//$("#rdUser option:eq(0)").prop('selected', true);
	
	 // Disable the dropdown
	$("#id_headingMsg").html("Send a new message");
	$("#txtSubject").val("");
	}
	else if (r==1)
	{
		
		
		$("#contSendMessage").show(500);
		$("#rdUser option:eq(1)").prop('selected', true);
		$("#rdUser option:eq(2)").hide();
		 // Disable the dropdown
		$("#id_headingMsg").html("Send message to clinician");
		$("#txtSubject").val("Re: "+subj);
		// Scroll to the top of the page
		

		

	}
	else if (r==2)
	{
		 $("#rdUser option:eq(2)").prop('selected', true);
		 $("#rdUser option:eq(1)").hide();
		 // Disable the dropdown
		$("#contSendMessage").show(500);
		$("#id_headingMsg").html("Send message to admin");
		$("#txtSubject").val("Re: "+subj);
	}
	
	$('html, body').animate({ scrollTop: 0 }, 'slow');
}
function showMessagebox_close()
{
	$("#contSendMessage").hide(500);
}
function sendReply(id)
{
	
	$("#contReplyMessage_"+id).toggle(500);
}

function addMoreFile(val)
{
	
	str='<div><input style="margin-top:15px" class="form-control" name="flDoc[]" type="file" accept=".pdf,.jpg,.png"></div>';
	$("#cont_addmore_"+val).append(str);
}
</script>

 <script language="javascript">

$("#adminForm").validate({
			rules: {
				txtSubject: "required",
				rdUser: "required",
				txtMessage: "required"
				
			},
			messages: {
				txtSubject: "Required",
				rdUser: "Please select user type",
				txtMessage: "Required"
				
				
				}			
		});

</script>


             <?php } ?>
  