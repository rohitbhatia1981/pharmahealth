		

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

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['sess_pharmacy_groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];
			
			

		?>	
	
    <style>
.circle-red {
  width: 40px;
  height: 40px;
  background: red;
  border-radius: 50%
}
</style>	
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
<div class="row">




							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
                                   
                                    
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left" style="cursor:pointer" onclick="window.location='?c=pha-prescriptions&cmbCategory=1'">
														<span class="fs-14 font-weight-semibold">To Process</span>
														<h3 class="mb-0 mt-1 text-primary  fs-25">
                                                        
                                                        <?php
													 $statsSql = "SELECT count(pres_id) as ctr from tbl_prescriptions where pres_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
													$stats = $database->get_results( $statsSql );
													echo $statsCount=$stats[0]['ctr'];
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-primary-transparent my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left" style="cursor:pointer" onclick="window.location='?c=pha-prescriptions&cmbCategory=2'">
														<span class="fs-14 font-weight-semibold">Query</span>
														<h3 class="mb-0 mt-1 text-orange  fs-25"> <?php
													$statsSql = "SELECT count(pres_id) as ctr from tbl_prescriptions,tbl_payments where payment_pres_id=pres_id and pres_pharmacy_stage=2 and payment_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
													$stats = $database->get_results( $statsSql );
													echo $statsCount=$stats[0]['ctr'];
									
													?></h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-primary-transparent my-auto  float-right"> <i class="feather feather-clipboard"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left" style="cursor:pointer" onclick="window.location='?c=pha-prescriptions&cmbCategory=4'">
														<span class="fs-14 font-weight-semibold">Cancelled</span>
														<h3 class="mb-0 mt-1 text-warning  fs-25">
                                                        
                                                         <?php
													$statsSql = "SELECT count(pres_id) as ctr from tbl_prescriptions,tbl_payments where payment_pres_id=pres_id and pres_pharmacy_stage=4 and payment_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
													$stats = $database->get_results( $statsSql );
													echo $statsCount=$stats[0]['ctr'];
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-secondary-transparent my-auto  float-right"> <i class="feather feather-info"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left" style="cursor:pointer" onclick="window.location='?c=pha-prescriptions&cmbCategory=3'">
														<span class="fs-14 font-weight-semibold">Ready for Collection</span>
														<h3 class="mb-0 mt-1 text-pink fs-25">
                                                        
                                                         <?php
													$statsSql = "SELECT count(pres_id) as ctr from tbl_prescriptions,tbl_payments where payment_pres_id=pres_id and pres_pharmacy_stage=3 and payment_pharmacy_id='".$_SESSION['sess_pharmacy_id']."'";
													$stats = $database->get_results( $statsSql );
													echo $statsCount=$stats[0]['ctr'];
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-pink-transparent my-auto  float-right"> <i class="feather feather-check"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
                            
                            
                            
                            
						</div>
			<!-- Row -->
           
	<div class="row flex-lg-nowrap">
		<div class="col-12">
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
                        
							<div class="e-table">
                            
                            
                          <?php if ($_GET['ty']!="s") { ?>  
                            
							<div class="row">
                            
                            
           
                           
                           					<div class="col-md-12 col-lg-12 col-xl-4">
                                            
                                            
														<div class="form-group">
															<label class="form-label">Search</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>" placeholder="Search by Order No., Full Name, Date of Birth">
															</div>
														</div>
													</div>
                                                 
                                                 
                                            <div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Period:</label>
                                                    
                                                  
                                                    
													<select name="cmbPeriod"  class="form-control custom-select select2" data-placeholder="All">
														<option value="" >All Orders</option>
                                                        <option value="1" <?php if ($_GET['cmbPeriod']==1) echo "selected"; ?>>Last 14 days</option>
                                                        <option value="2" <?php if ($_GET['cmbPeriod']==2) echo "selected"; ?>>Last 30 days</option>
                                                        <option value="3" <?php if ($_GET['cmbPeriod']==3) echo "selected"; ?>>Last 90 days</option>
                                                        <option value="4" <?php if ($_GET['cmbPeriod']==4) echo "selected"; ?>>Last 180 days</option>
                                                         <option value="6" <?php if ($_GET['cmbPeriod']==6) echo "selected"; ?>>Last 365 days</option>
                                                        
                                                       
                                                        
														
													</select>
												</div>
											</div>     
                           
                           
											
											
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter by Status:</label>
                                                    
                                                  
                                                    
													<select name="cmbCategory"  class="form-control custom-select select2" data-placeholder="All">
														
                                                        <option value="1" <?php if ($_GET['cmbCategory']==1 || $_GET['cmbCategory']=="") echo "selected"; ?>>To Process</option>
                                                        <option value="2" <?php if ($_GET['cmbCategory']==2) echo "selected"; ?>>Query</option>
                                                        <option value="4" <?php if ($_GET['cmbCategory']==4) echo "selected"; ?>>Cancelled</option>
                                                        <option value="3" <?php if ($_GET['cmbCategory']==3) echo "selected"; ?>>Ready for Collection</option>
                                                        <option value="5" <?php if ($_GET['cmbCategory']==5) echo "selected"; ?>>Collected</option>
                                                        <option value="11" <?php if ($_GET['cmbCategory']==11) echo "selected"; ?>>All</option>
                                                        
                                                        
														
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
                                                   <?php }
												   
												    ?>
												</div>
											</div>
										</div>
                                        
                                 <?php } ?>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												
                                                <th width="19%" class="border-bottom-0">Order No.</th>
                                                <th width="14%" class="border-bottom-0">Date</th>
                                               
                                                <th width="14%" class="border-bottom-0">Patient Name</th>
                                                <th width="14%" class="border-bottom-0">DOB</th>
                                                <th width="14%" class="border-bottom-0">Address</th>
                                                
                                                 
                                                <th width="27%" class="border-bottom-0">Medical <br /> Condition</th>                                                
                                                <th width="25%" class="border-bottom-0">Medication</th>
                                                <th width="15%" class="border-bottom-0 w-20">Status</th>
                                               
                                                <th width="15%" class="border-bottom-0 w-20">Query Log</th>
                                                
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
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    <a href="?c=<?php echo $component?>&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a>
										
												
											
									</td>
                                    
                                    <td class="align-middle">
										
										<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
											
									</td>
                                    
                                    <td><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></td>
                                     <td><?php 
									
									//$from = new DateTime($rowPres['patient_dob']);
									//$to   = new DateTime('today');
									//echo $from->diff($to)->y;
									
									$dateFromMySQL=$rowPres['patient_dob'];
									echo $formattedDate = date('d/m/y', strtotime($dateFromMySQL));

									 ?></td>
                                     <td><?php echo $rowPres['patient_address1']." <br>".$rowPres['patient_address2'].", <br>".$rowPres['patient_city']." ".$rowPres['patient_postcode'] ?></td>
                                   
                                    
                                    <td class="align-middle">
										
												<?php echo getConditionName($rowPres['pres_condition']); ?>
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle" >
                                    
                                    
                                    <div class="row" style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													
                                                    
                                                    	<?php echo getMedicationStringWithInfo($rowPres['pres_id']); ?>
                                                   
														   
														
													</div>
                                </div>
										
												 <?php 
																/*$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           }*/
														   
														  // echo getMedicationStringWithInfo($rowPres['pres_id']);
														   
														   ?>
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<?php 
															if ($rowPres['pres_stage']==5) echo "<span class='tag tag-red'>Cancelled</span>" ;
															else
															echo getPrescriptionStatus_pharmacy($rowPres['pres_pharmacy_stage']); ?>
                                                            
                                                            
                                                           
                                                            
                                                           
											</div>
										</div>
									</td>
                                    
                                   
                                    <td>-</td>
                                    
									

									
								</tr>
                                
                                

								<?php 

}

}

else

{

	?>

	<tr>

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="12"> - No Record found - </th>
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


             <?php  } ?>

	<!-----------End Listing function------------------>

    

    

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
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Prescription Detail</h4>
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
					
						
						
						$rowPres = &$rows[0];
							
					?>


						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
                                        <li><a href="#tab6" data-toggle="tab"  <?php if ($_GET['tab']=="") { ?> class="active" <?php } ?>>Order Details</a></li>
											<!--<li ><a href="#tab5" data-toggle="tab">Order Details</a></li>-->
											
											<li><a href="#tab7"  data-toggle="tab" <?php if ($_GET['tab']=="message") { ?> class="active" <?php } ?>>Messages</a></li>
											
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<!--<div class="tab-pane" id="tab5">
											<div class="card-body">
												<div class="table-responsive">
										<table class="table card-table table-vcenter text-nowrap mb-0">
											<thead >
												<tr>
													
													<th>Medicine Name</th>
													<th>Quantity</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
                                            
                                            
                                            <?php
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
											?>
                                            
												<tr>
													<td><?php echo $rowMedicine['pm_med']; ?></td>
													<td><?php echo $rowMedicine['pm_med_qty']; ?></td>
													<td><?php echo CURRENCY?><?php echo $rowMedicine['pm_med_price']; ?></td>
												</tr>
                                             
                                             <?php } ?>
												
												
											</tbody>
										</table>
									</div>
											</div>
										</div>-->
										<div class="tab-pane <?php if ($_GET['tab']=="") { ?> active <?php } ?>" id="tab6">
											<div class="row">
							
							<div class="col-xl-12 col-md-12 col-lg-12">
								
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                                
									<div class="tab-content">
                                    
                                  <form action="?c=<?php echo $component?>&task=changestatus" method="POST" enctype="multipart/form-data">
										<div class="tab-pane active" id="tab5">
											<div class="card-body">
                                            
                                            <div class="row" style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													
													</div>
                                </div>
                                
                               			 
                                
                                
                                
                                
                               				 <div class="row"  style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
                                                
                                                <div align="right"><button type="button" onclick="printData()" class="btn btn-primary">Print / Download Prescription</button></div>
                                                <div style="clear:both"></div>
                                                <div style="height:20px"></div>
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8" >
                                                    
                                                   
                                           
                                             <div id="tableToPrint">     
                                            <table class="table" >
												<tbody>
													
													<tr>
														<td>
															<span class="w-50">Order Number</span>
														</td>
														
														<td>
															<span class="font-weight-semibold">PH-<?php echo $rowPres['pres_id'] ?></span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span class="w-50"> Date</span>
														</td>
														
														<td>
                                                        
                                                        	<span class="font-weight-semibold"><?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?></span>
                                                            
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Patient Name</span>
														</td>
														
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">DOB</span>
														</td>
														
														<td>
															<span class="font-weight-semibold">
                                                            
                                                            <?php 
									
									
									$dateFromMySQL=$rowPres['patient_dob'];
									echo $formattedDate = date('d/m/y', strtotime($dateFromMySQL));

									 ?>
                                                            
                                                            </span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Address</span>
														</td>
														
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_address1']." ".$rowPres['patient_address2'].", <br>".$rowPres['patient_city']." ".$rowPres['patient_postcode'] ?></span>
														</td>
													</tr>
                                                    
													<tr>
														<td>
															<span class="w-50">Condition</span>
														</td>
														
														<td>
															<span class="font-weight-semibold"><?php echo getConditionName($rowPres['pres_condition']) ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Medication</span>
														</td>
														
														<td>
                                                        
                                                        	<span class="font-weight-semibold">
															
                                                            <div class="row" style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	 <h4 style="background:#648bff; color:#fff; padding:15px">Medication</h4>
                               			 <?php echo getMedicationStringWithInfo_table($rowPres['pres_id'],1); ?>
                                                   
														   
														</div>
													</div>
                                </div>
                                                            
                                                            
                                                           </span>
														</td>
													</tr>
                                                 
                                                    
												</tbody>
											</table>
                                            
                                            </div>
                                            
                                            <div class="row" style="margin-bottom:30px" id="notes">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Clinician Notes</h4>
                                                        <div class="card-body pt-1">
                                                        
                                                        <?php if ($rowPres['pres_pharmacy_note']!="") { ?>
                                                        <p><?php echo $rowPres['pres_pharmacy_note']; ?></p>
                                            			
                                                       
                                                        
                                                       
														<?php } else { ?> No notes by clinician!<?php } ?>
															
														
                                                        
                                                   </div>
                                                   
                                                   
														
                                            
										</div>   
														</div>
													</div>
                                            
                                            <div class="row" style="margin-bottom:30px" id="notes">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Pharmacy Notes</h4>
                                                        <div class="card-body pt-1">
                                                        
                                                        <?php if ($rowPres['pres_clinician_notes']!="") { ?>
                                                        <p><?php echo $rowPres['pres_clinician_notes']; ?></p>
                                            			<?php } ?>
                                                        <?php //if ($rowPres['pres_stage']==1 || $rowPres['pres_stage']==2) { ?>
                                                        <!--<a class="btn btn-light" href="javascript:void()" onclick="openNotes(1)">Add Notes</a>-->
                                                        
                                                        <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#newNotes"><i class="feather feather-plus fs-15 my-auto mr-2"></i>Add Notes</a>
                                                        
                                                        <?php //} ?>
                                                        <!--<a class="btn btn-light" href="#">Contact by email</a>-->
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <table style="margin-top:50px" class="table  table-vcenter table-bordered border-bottom" id="miles-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0" width="60%">Notes</th>
																<th class="border-bottom-0">Date</th>
                                                                <th class="border-bottom-0">Added by</th>
															
																
															</tr>
														</thead>
														<tbody>
                                                        
                                                        <?php $sqlNotes="select * from tbl_prescriptions_notes where pn_pres_id='".$database->filter($_GET['id'])."' and pn_user_type='pharmacy' order by pn_id desc";
														$resNotes=$database->get_results($sqlNotes);
														if (count($resNotes)>0)
														{
															for ($j=0;$j<count($resNotes);$j++)
															{
																$rowNotes=$resNotes[$j];
														 ?>
															<tr>
																<td class="text-center"><?php echo $j+1; ?></td>
																<td>
																	<?php echo $rowNotes['pn_action_details']?>
																</td>
																<td><?php echo fn_formatDateTime($rowNotes['pn_date_time'])?></td>
																<td>
                                                                
                                                                	<?php
																		
																		echo getUserNameByType($rowNotes['pn_user_type'],$rowNotes['pn_user_id'])
																	
																	?>
                                                                
                                                                </td>
																
															</tr>
														<?php }
														} else {?>
                                                        <tr><td colspan="4">No notes added!</td></tr>
                                                        <?php } ?>	
															
														</tbody>
													</table>
                                                        
                                                   </div>
                                                   
                                                   
														
                                            
										</div>   
														</div>
													</div>
                                            
                                            <div class="row" style="margin-bottom:30px" id="message">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Actions</h4>
                                                        <div class="card-body pt-1">
                                                        
                                                        <span class="w-50">Current Status</span>: <?php 
															if ($rowPres['pres_stage']==5) echo "<span class='tag tag-red'>Cancelled</span>" ;
															else
															echo getPrescriptionStatus_pharmacy($rowPres['pres_pharmacy_stage']); ?>
                                                        <br /><br /><br />
                                                        
                                                         <?php 
														 
														
														 if ($rowPres['pres_pharmacy_stage']!="4") { ?>
                                                         
                                                          
                                                        <a class="btn btn-light"  onclick="changeColors(2,1)"  id="btnQuery" href="javascript:void()" <?php if ($rowPres['pres_pharmacy_stage'] != "1" && $rowPres['pres_pharmacy_stage'] != "2") echo "style='display:none'"; ?>>Query</a>
                                                       
                                                        <a class="btn btn-light" onclick="changeColors(3,1)"  id="btnReady" href="javascript:void()">Ready for Collection</a>
                                                        <a class="btn btn-light"  onclick="changeColors(5,1)"  id="btnCollected" href="javascript:void()">Collected</a>
                                                        
                                                        <a class="btn btn-light"  onclick="changeColors(4,1)"  id="btnCancel" href="javascript:void()" <?php if ($rowPres['pres_pharmacy_stage'] != "1" && $rowPres['pres_pharmacy_stage'] != "2") echo "style='display:none'"; ?>>Cancellation Request</a>
                                                        
                                                        <?php 
														
														
														} 
														
														// if ($rowPres['pres_pharmacy_stage']=="4")
														// {
															 
														
														?>
                                                        
                                                        
                                                        
                                                        <?php if ($rowPres['pres_rejection_reason']!="") { ?>
                                                        <br /><br />
                                                        <p><?php echo $rowPres['pres_rejection_reason']; ?></p>
                                                        <?php } ?>
                                                        <br /><br />
                                                        <div class="col-sm-6 col-md-6">
                                                       <!-- <select name="cmbRejectReason" id="cmbRejectReason" class="form-control" style="display:none" onchange="openFree(this.value)">
                                                        	<option value="" style="display:none">Select Reason</option>
                                                            <option value="Not clinically suitable">Not clinically suitable</option>
                                                            <option value="Unable to reach patient after multiple attempts">Unable to reach patient after multiple attempts</option>
                                                            <option value="Other">Other (free type)</option>
                                                            
                                                        </select>-->
                                                        
                                                        <textarea rows="5" placeholder="Please provide the reason" cols="100" name="txtReject" style="margin-top:20px;display:none" id="txtReject" class="form-control"><?php echo $rowPres['pres_rejection_reason'] ?></textarea>
                                                        </div>
                                                        
                             <div class="card" id="contSendMessage_2" style="display:none" >
								<div class="card-header border-0">
									<h4 class="card-title">Query to Clinician or Admin</h4>
								</div>
								<div class="card-body" >
                                
                               
                                   
									
                                  <div>
                                  
                                   <label class="form-label">Select User Type *</label>
                                    <select class="form-control" name="rdUser" >
                                    	<option value="">Choose the recipient for your message</option>
                                        
                                        <option value="Clinician">Send to Clinician</option>
                                        <option value="Admin">Send to Admin</option>
                                        
                                    </select>
                                  
									<div>
                                    <div style="height:20px"></div>
                                    <div>
                                    <label class="form-label">Subject *</label>
                                    <input type="text" class="form-control" name="txtSubject"></div>
                                     <div style="height:20px"></div>
									<div>
                                    <label class="form-label">Message *</label>
                                    <textarea rows="5" class="form-control" cols="50" name="txtMessage"></textarea></div>
                                    <div style="height:20px"></div>
									<div class="form-group">
										
										<input class="form-control" name="flDoc[]" type="file" accept=".pdf,.jpg,.png">
                                        
                                       	<div id="cont_addmore_1"></div>
                                        <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onclick="addMoreFile(1)">+ Add More Attachment</a></div>
                                        
                                        
										</div>
                                    
                                 
									
								</div>
								
							</div>
                                 
                                
								
								
								
							
                            </div>
                            
                            
                            </div> <!-------end------->
                                                   </div>
                                                   
                                                   
														
                                            
										</div>   
                                        
                                        
                                        
                                        
														</div>
													</div>
                                                    
                                                    
                                                  </div>
                                                     
                                                       
                                                        
                                                        
													</div>
                                                    
                                			</div>
                                            
												 
												
                                                
                                                 
                                            
                                             
                                            
                                            
                                            
                                            
                                             
                                                    
                                                
                                                 
                                                    
                                                  
                                             <input type="hidden" name="rdChange" id="rdChange" value="<?php echo $rowPres['pres_pharmacy_stage']?>" />
                                             <button type="submit" class="btn btn-primary">Submit</button>
                                             
                                                 <?php $sqlRequest="select * from tbl_pres_cancel_request where pr_pres_id='".$database->filter($rowPres['pres_id'])."' order by pr_id desc";
														 $resRequest=$database->get_results($sqlRequest);
														
														if (count($resRequest)>0)
														{	 
														?>
														
                                                    
                                                    <div class="row" style="margin-top:30px">
                                						<div class="col-sm-12 col-md-12">
															<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                            <h4 style="background:#648bff; color:#fff; padding:15px">Cancellation Requests</h4>
                                                            <div class="card-body pt-1">
                                                            	<div class="table-responsive table-lg mt-3">
																<table class="table table-bordered border-top" id="example1" width="100%">
                                                                <tr><th width="168">Request Date</th><th width="195">Request Action</th><th width="327">Your Message</th><th width="243">Clinician Action</th><th width="185">Action Date</th><th width="281">Clinician Message</th><th width="188">Clinician Name</th></tr>
                                                            <?php
															
															 for ($k=0;$k<count($resRequest);$k++)
															 {
																 $rowRequest=$resRequest[$k]; ?>
																 
																<tr><td height="25"><?php echo fn_GiveMeDateInDisplayFormat($rowRequest['pr_date']); ?></td><td>Requested Cancellation</td><td><?php echo $rowRequest['pr_message']; ?></td><td><?php if ($rowRequest['pr_status']==2) echo "Request Cancelled"; else if ($rowRequest['pr_status']==1) echo "Request Accepted"; ?></td><td><?php echo fn_GiveMeDateInDisplayFormat($rowRequest['pr_action_date']); ?></td><td><?php if ($rowRequest['pr_action_message']!="") echo $rowRequest['pr_action_message']; else echo "-"; ?></td><td><?php echo getUserNameByType('clinician',$rowRequest['pr_clinician_id']); ?></td></tr>
															 
															<?php 
															
															
															}
															 
															 ?>
                                                             </table>
                                                             	</div>
                                                            </div>
                                                        </div>
                                                     </div>
														</div>
                                                        
                                                     <?php } ?> 
                                                    
                               				 </div>
                                
                               				 
                                            
                                            
											</div>
                                            <input type="hidden" name="hdId" value="<?php echo $_GET['id']?>" />
                                            </form>
                                            
                                            
                                            <div class="modal fade"  id="newNotes">
                 
                 <form action="?c=pha-prescriptions&task=savenotes" method="POST">
                 
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add New Notes</h5>
							<button  class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							
							
							
							
							<div class="form-group">
								<label class="form-label">Notes:</label>
								<textarea row="4" cols="100%" required class="form-control" placeholder="Type your notes here.." name="txtPNotes"></textarea>
                                <input type="hidden" name="hdPid"   value="<?php echo $_GET['id']?>" />
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
                                        
                                        
										
									</div>
								</div>
                                
                                
                                
                                
							</div>
                            
                            
                            
										</div>
                                        
                                        
                                        
                                        
										<div class="tab-pane <?php if ($_GET['tab']=="message") { ?> active <?php } ?>" id="tab7">
											<div class="card-body">
                                            
                                            <div class="card" id="contSendMessage" style="display:none" >
								<div class="card-header border-0">
									<h4 class="card-title" id="id_headingMsg"></h4>
                                    
                                    
								</div>
								<div class="card-body" >
                                <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=sendmessage" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div>
                                     <label class="form-label">Select User Type *</label>
                                    <select class="form-control" name="rdUser" id="rdUser2" >
                                    	
                                        <option value="Patient">Send to Patient</option>
                                       <option value="Clinician">Send to Clinician</option>
                                        
                                        <option value="Admin">Send to Admin</option>
                                        
                                    </select>
                                   
                                     <div style="height:20px"></div>
									<div>
                                    <div style="height:20px"></div>
                                    <div>
                                    <label class="form-label">Subject *</label>
                                    <input type="text" class="form-control" name="txtSubject" id="txtSubject2"></div>
                                     <div style="height:20px"></div>
									<div>
                                    <label class="form-label">Message *</label>
                                    <textarea rows="5" class="form-control" cols="50" name="txtMessage"></textarea></div>
                                    <div style="height:20px"></div>
									<div class="form-group">
										
										<input class="form-control" name="flDoc[]" type="file" accept=".pdf,.jpg,.png">
                                        
                                       	<div id="cont_addmore_1"></div>
                                        <div style="padding-left:10px; padding-top:10px"><a href="javascript:void()" onclick="addMoreFile(1)">+ Add More Attachment</a></div>
                                        
                                        
										</div>
                                    
                                  <div class="card-footer">
									<button type="submit" class="btn btn-primary">Send</button>
									<a  href="javascript:void(0);" onclick="showMessagebox_close()" class="btn btn-danger">Cancel</a>
								</div>  
                                <input type="hidden" name="hid" value="<?php echo $_GET['id']?>" />
								</form>	
								</div>
								
							</div>
                            </div>
                            </div>
                                            
												<div class="pt-4 pb-4 text-end" align="right">
                                                
                                               
                                                
													<a  href="?c=<?php echo $_GET['c']?>&task=<?php echo $_GET['task']?>&id=<?php echo $_GET['id']?>&message=send"  class="btn btn-primary" <?php if ($rowPres['pres_pharmacy_stage'] != "1" && $rowPres['pres_pharmacy_stage'] != "2") echo "style='display:none'"; ?>>Compose Message</a>
												</div>
                                                
                                                
                                                
                                                
												
                                                
                                                
                                                
                                                 <?php 
														$sqlMessage="select * from tbl_messages where  (message_sender_type='Pharmacy' || message_sent_to='Pharmacy')  and message_pres_id='".$database->filter($_GET['id'])."' order by message_id desc";
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
																
																			if ($rowMessage['message_sender_type']=="Clinician")
																				{
																				$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				//else if ($rowMessage['message_sender_type']=="Clinician")
																				//$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['pres_forename']." ".$rowSender['pres_surname']. " (".$rowMessage['message_sender_type'].")";
																				$colorCss="danger";
																				}
																				else if ($rowMessage['message_sender_type']=="Pharmacy")
																				{
																					$replierName="Me (Pharmacy)";
																					$colorCss="primary";
																				}
																				else if ($rowMessage['message_sender_type']=="Admin")
																				{
																					$replierName="Admin";
																					$colorCss="danger";
																				}
																				
																				
																				if ($rowMessage['message_sender_type']!="Pharmacy")
																				{
																				 $updateReadStatus="update tbl_messages set message_read_status=1 where message_id='".$database->filter($rowMessage['message_id'])."'";
																				$database->query($updateReadStatus);
																				}



														
													?>
                                                    <div class="card shadow-none border">
													<div class="d-sm-flex p-5">
													
                                                    
                                                    
                                                    
                                                    	
														<div class="media-body">
															<h5 class="mt-1 mb-1 font-weight-semibold"><?php echo $rowMessage['message_subject']?> <span class="badge badge-<?php echo $colorCss; ?>-light badge-md ms-2"><?php echo $replierName; ?></span></h5>
															<small class="text-muted"><i class="fa fa-calendar"></i> <?php echo $formattedDate; ?> <i class=" ms-3 fa fa-clock-o"></i> <?php echo $formattedTime; ?></small>
                                                            
                                                            <span style="color:#00F;font-size:13px"><strong> 
                                                            	<?php if ($rowMessage['message_sent_to']=="Admin") echo 'Sent to Admin';
																if ($rowMessage['message_sent_to']=="Clinician") echo 'Sent to Clinician';
																if ($rowMessage['message_sent_to']=="Patient") echo 'Sent to Patient';
																if ($rowMessage['message_sent_to']=="Pharmacy") echo 'Sent to You';
																
																 ?>
                                                                 </strong>
                                                            </span>
                                                            
                                                            
															<p class="fs-13 mb-2 mt-1">
															   <?php echo $rowMessage['message_text']?>
															</p>
															 <!---------Attachment of new message------------>
                                                            
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
                                                            
                                                            <?php
																$sqlSub="select * from tbl_messages where message_parent_reply='".$rowMessage['message_id']."' order by message_id desc";
																$resSub=$database->get_results($sqlSub);
																if (count($resSub)>0)
																{
																	
																	for ($j=0;$j<count($resSub);$j++)
																	{
																		$rowSub=$resSub[$j];
																		
																		//--------Get sender details----
																		
																		
																		
																			if ($rowSub['message_sender_type']=="Patient")
																				{
																				$sqlSender="select * from tbl_patients where patient_id='".$rowSub['message_sender_id']."'";
																				//else if ($rowMessage['message_sender_type']=="Clinician")
																				//$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['patient_first_name']." ".$rowSender['patient_middle_name']." ".$rowSender['patient_last_name']." (".$rowSub['message_sender_type'].")";
																				$colorCss="danger";
																				}
																				else if ($rowSub['message_sender_type']=="Clinician")
																				{
																					$replierName="Me (Clinicians)";
																					$colorCss="primary";
																				}
																		
																		//--- end getting sender details---
															?>
                                                            
															<div class="sub-media d-sm-flex mt-5">
																
																<div class="media-body">
																	<h5 class="mt-1 mb-1 font-weight-semibold"><?php echo $rowSub['message_subject']?> <span class="badge badge-<?php echo $colorCss;?>-light badge-md ms-2"><?php echo $replierName; ?></span></h5>
																	<small class="text-muted"><i class="fa fa-calendar"></i> Jan 22 2021 <i class=" ms-3 fa fa-clock-o"></i> 09:00</small>
																	<p class="fs-13 mb-2 mt-1">
																	   <?php echo $rowSub['message_text']?>
																	</p>
                                                  
                                                    <!---------Attachment of replied message------------>
                                                 
                                                  <?php if ($rowSub['message_attachment']!="") {
																 
  $arrUnSerMes=unserialize(fnUpdateHTML($rowSub['message_attachment']));
																
	?>
                                                                    
          <div class="row">
		  
		  	<?php for ($j=0;$j<count($arrUnSerMes);$j++) {
			
			$fileExtension = pathinfo($arrUnSerMes[$j], PATHINFO_EXTENSION);
			if (strtolower($fileExtension) === 'pdf')
			$type="pdf";
			else if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) 
			$type="image";
			
			 ?>
              <div class="col-lg-2 col-md-3">
                   <a  href="<?php echo URL?>uploads/patients/<?php echo $arrUnSerMes[$j]; ?>" download class="attach-supportfiles">
                      <?php if ($type=="image") { ?>
                      	<img src="<?php echo URL?>uploads/patients/<?php echo $arrUnSerMes[$j]; ?>" style="max-height:100px" alt="<?php echo $arrUnSerMes[0]; ?>" title="<?php echo $arrUnSerMes[0]; ?>" class="img-fluid">
                        <div class="attach-title"><?php echo $arrUnSerMes[0]; ?></div>
                       <?php } else { ?>
                        <img src="<?php echo URL?>images/pdf.png" style="max-height:100px" alt="<?php echo $arrUnSerMes[0]; ?>" title="<?php echo $arrUnSerMes[0]; ?>" class="img-fluid">
                         <div class="attach-title"><?php echo $arrUnSerMes[0]; ?></div>
                       <?php } ?></a>
               </div>
			 <?php }
		 ?>
		 
         </div>
         <?php } ?>
                                                 
                                                 <!---------end attachment-------->
                                                 
                                                 
                                                  
																	
                                                                    
																</div>
                                                               <!-- <br />
																	<a  href="javascript:void(0);" class="me-2 mt-1"><span class="badge badge-light"><i class="fa fa-reply"></i> Reply</span></a>-->
															</div>
                                                            
                                                            <?php }
																}?>
                                                                
                                                                
                                                               
                                                               <?php
														  
														 
														   if ($rowMessage['message_sender_type']!="Pharmacy") 
																{
																	if ($rowMessage['message_sender_type']=="Patient")
																	$r=1;
																	if ($rowMessage['message_sender_type']=="Clinician")
																	$r=2;
																	if ($rowMessage['message_sender_type']=="Admin")
																	$r=3;
																	
																	?>
                                            
                                            						<br />
                                            
																	<a  href="javascript:void(0);" onclick="showMessagebox(<?php echo $r?>,'<?php echo $rowMessage['message_subject']?>')" class="me-2 mt-1"><span class="badge badge-orange"><i class="fa fa-reply"></i> Reply</span></a>
															   
                                                                    
                                                                 
                                                                  
                            
                                                                    
                                                            	<?php } ?>
                                                            
														</div>
                                                        
                                                        
                                                        </div>
                                                        
													</div>
                                                    
                                                    
                                                    <?php }
														}
														else
														
														echo "<p style='font-size:18px; padding:30px'>No communication yet for this order</p>";
														?>
												
												
											
										
										
										
										
										
									</div>
								</div>
							</div>
						</div>
                        
						<!-- End Row-->

					</div><!-- end app-content-->
				</div>
		</div>

<script language="javascript">

function openFree(val)
{
	if (val=="Other")
	$("#txtReject").show();
	else
	{
	$("#txtReject").hide();
	}
	
}


function showMessagebox(r,subj)
{
	
	
	
	if (r==1)
	{
		
		
		$("#contSendMessage").show(500);
		
		$("#rdUser2 option:eq(0)").show();
		$("#rdUser2 option:eq(1)").hide();
		$("#rdUser2 option:eq(2)").hide();
		
		 $("#rdUser2 option:eq(0)").prop('selected', true);
		 // Disable the dropdown
		$("#id_headingMsg").html("Send message to Patient");
		$("#txtSubject2").val("Re: "+subj);
		// Scroll to the top of the page
		

		

	}
	else if (r==2)
	{
		$("#rdUser2 option:eq(1)").show();
		$("#rdUser2 option:eq(0)").hide();
		$("#rdUser2 option:eq(2)").hide();
		
		 $("#rdUser2 option:eq(1)").prop('selected', true);
		 // Disable the dropdown
		$("#contSendMessage").show(500);
		$("#id_headingMsg").html("Send message to Clinician");
		$("#txtSubject2").val("Re: "+subj);
	}
	
	else if (r==3)
	{
		 $("#rdUser2 option:eq(2)").show();
		$("#rdUser2 option:eq(0)").hide();
		$("#rdUser2 option:eq(1)").hide();
		
		 $("#rdUser2 option:eq(2)").prop('selected', true);
		 // Disable the dropdown
		$("#contSendMessage").show(500);
		$("#id_headingMsg").html("Send message to Admin");
		$("#txtSubject2").val("Re: "+subj);
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

function printData()
{
	
	
	  var url = '<?php echo URL?>pharmacy/account/components/pha-prescriptions/prescription-print.php?id=<?php echo base64_encode($_GET['id'])?>';

    // Define the properties of the popup window
    var width = 800;
    var height = 1400;
    var left = (window.innerWidth - width) / 2;
    var top = (window.innerHeight - height) / 2;

    // Open the popup window
    var popup = window.open(url, 'PopupWindow', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);

    // Focus the popup window (optional)
    popup.focus();
	   
	   /*
            var tableToPrint = $("#tableToPrint").clone();

           
            var newWindow = window.open('', '_blank');
            newWindow.document.open();

            
            newWindow.document.write('<html><head><title>Print Table</title></head><body>');
            newWindow.document.write('<style>@media print{table{width:100%;border-collapse:collapse;}}table, th, td{border:1px solid black; padding:10px; font-family:"sans-serif;font-size:13px;}</style>');
            
			
			newWindow.document.write('<div style="padding:20px"><img src="<?php echo URL?>images/logo.png"></div>');
			newWindow.document.write(tableToPrint.html());
            newWindow.document.write('</body></html>');
            newWindow.document.close();

            
            newWindow.print();
            newWindow.close();
			*/
}



</script>

 <script language="javascript">
 
  window.onload = function() {
	  
	  
            // Check if the query string parameter 'message' is set to 'send'
            var queryString = window.location.search;
            if (queryString.includes("message=send")) {
                // Scroll to the element with id 'message'
                var element = document.getElementById("message");
                if (element) {
                    element.scrollIntoView();
					 changeColors(2,1); 
					
                }
            }
        };

$("#adminForm").validate({
			rules: {
				txtSubject: "required",
				rdUser: "required",
				txtMessage: "required"
				
			},
			messages: {
				txtSubject: "Subject cannot be blank",
				rdUser: "Please select user type",
				txtMessage: "Please enter message"
				
				
				}			
		});
		
		function openNotes(val)
		{
			if (val==1)
			$("#txtNotes").toggle();
			else if (val==2)
			$("#txtPharmacyMsg").toggle();
		}
		
	function changeColors(val,op) {
		
		
		
		  var element = document.getElementById("btnReady");    
		  element.style.backgroundColor = "#dee5f7";     
		  element.style.color = "#565b95";
		  
		  var element = document.getElementById("btnQuery");    
		  element.style.backgroundColor = "#dee5f7";     
		  element.style.color = "#565b95";
		  
		  var element = document.getElementById("btnCancel");    
		  element.style.backgroundColor = "#dee5f7";     
		  element.style.color = "#565b95";
		  
		  var element = document.getElementById("btnCollected");    
		  element.style.backgroundColor = "#dee5f7";     
		  element.style.color = "#565b95";
		  
		  
		  
		   $("#txtReject").hide();
		  		   
		  // $("#cmbRejectReason").val($("#cmbRejectReason option:first").val());
		 //  $("#cmbRejectReason").hide();
		   $("#contSendMessage_2").hide();
		
	
		if (val==3)
		{
		  var element = document.getElementById("btnReady");    
		  element.style.backgroundColor = "#39AD48";     
		  element.style.color = "#fff";
		  $("#rdChange").val(val);
		  
		  
		  
		} else if (val==4)
		{
		  var element = document.getElementById("btnCancel");    
		  element.style.backgroundColor = "red";     
		  element.style.color = "#fff";
		   $("#rdChange").val(val);
		  if (op==1)
		  $("#txtReject").show();
		  
		  
		} else if (val==2)
		{
		  var element = document.getElementById("btnQuery");    
		  element.style.backgroundColor = "orange";     
		  element.style.color = "#fff";
		   $("#rdChange").val(val);
		  if (op==1)
		  $("#contSendMessage_2").show();
		}
		else if (val==5)
		{
		  var element = document.getElementById("btnCollected");    
		  element.style.backgroundColor = "green";     
		  element.style.color = "#fff";
		  $("#rdChange").val(val);
		  if (op==1)
		  $("#contSendMessage_2").hide();
		}
    }
	
	function submitPres()
	{
		if ($("#hdOutcomes").val()=="")
		{
			alert ("Please select the outcome before submitting");
			return false;
		}
		else
		return true;
	}
	
	 
			 
	changeColors(<?php echo $rowPres['pres_pharmacy_stage']?>,0);            
             
        
			  

</script>


           <?php
				  
			 
			 
			 
			 } ?>
  