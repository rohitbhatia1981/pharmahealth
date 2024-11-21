		

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




							<div class="col-xl-2 col-lg-6 col-md-12">
								<div class="card">
									
                                   
                                    
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Pending</span>
														<h3 class="mb-0 mt-1 text-danger  fs-25">
                                                        
                                                        <?php
													$statsSql = "SELECT * FROM tbl_prescriptions where pres_stage=1";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger-transparent my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-2 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Query</span>
														<h3 class="mb-0 mt-1 text-primary  fs-25"><?php
													$statsSql = "SELECT * FROM tbl_prescriptions where pres_stage=2";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
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
							<div class="col-xl-2 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Rejected</span>
														<h3 class="mb-0 mt-1 text-warning  fs-25">
                                                        
                                                        <?php
													$statsSql = "SELECT * FROM tbl_prescriptions where pres_stage=4";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
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
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Approved</span>
														<h3 class="mb-0 mt-1 text-success fs-25">
                                                        
                                                         <?php
													$statsSql = "SELECT * FROM tbl_prescriptions where (pres_stage=6 || pres_stage=3)";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-success-transparent my-auto  float-right"> <i class="feather feather-check"></i> </div>
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
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Cancelled</span>
														<h3 class="mb-0 mt-1 text-danger fs-25">
                                                        
                                                         <?php
													$statsSql = "SELECT * FROM tbl_prescriptions where pres_stage=5";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger-transparent my-auto  float-right"> <i class="feather feather-x"></i> </div>
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
														<option value="1" <?php if ($_GET['cmbPeriod']==1) echo "selected"; ?>>Current Month</option>
                                                        <option value="2" <?php if ($_GET['cmbPeriod']==2) echo "selected"; ?>>Previous Month</option>
                                                        <option value="3" <?php if ($_GET['cmbPeriod']==3) echo "selected"; ?>>Previous 3 Months</option>
                                                        <option value="4" <?php if ($_GET['cmbPeriod']==4) echo "selected"; ?>>Previous 6 Months</option>
                                                        <option value="5" <?php if ($_GET['cmbPeriod']==5) echo "selected"; ?>>All Orders</option>
                                                       
                                                        
														
													</select>
												</div>
											</div>     
                           
                           
											
											
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter by Status:</label>
                                                    
                                                  
                                                    
													<select name="cmbCategory"  class="form-control custom-select select2" data-placeholder="All">
														<option label="All"></option>
                                                        <option value="1" <?php if ($_GET['cmbCategory']==1) echo "selected"; ?>>Pending</option>
                                                        <option value="2" <?php if ($_GET['cmbCategory']==2) echo "selected"; ?>>Query</option>
                                                        <option value="4" <?php if ($_GET['cmbCategory']==4) echo "selected"; ?>>Rejected</option>
                                                        <option value="6" <?php if ($_GET['cmbCategory']==6) echo "selected"; ?>>Approved</option>
                                                        <option value="5" <?php if ($_GET['cmbCategory']==5) echo "selected"; ?>>Cancelled</option>
                                                        
														
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
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												
                                                <th width="19%" class="border-bottom-0">Order No.</th>
                                                <th width="14%" class="border-bottom-0">Date</th>
                                                <th width="14%" class="border-bottom-0">Pharmacy</th>
                                                <th width="14%" class="border-bottom-0">Patient Name</th>
                                                <th width="14%" class="border-bottom-0">Age</th>
                                                <th width="14%" class="border-bottom-0">Biological <br /> Sex</th>
                                                 
                                                <th width="27%" class="border-bottom-0">Medical <br /> Condition</th>                                                
                                                <th width="25%" class="border-bottom-0">Medication</th>
                                                <th width="15%" class="border-bottom-0 w-20">Status</th>
                                                <th width="15%" class="border-bottom-0 w-20">Patient<br /> Query Log</th>
                                                <th width="15%" class="border-bottom-0 w-20">Pharmacy <br /> Query Log</th>
                                                <th width="15%" class="border-bottom-0 w-20">Risk Level</th>
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
                                    <td><?php echo getPharmacyName($rowPres['patient_pharmacy']); ?></td>
                                    <td><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></td>
                                     <td><?php 
									
									$from = new DateTime($rowPres['patient_dob']);
									$to   = new DateTime('today');
									echo $from->diff($to)->y;
									
									$rowPres['patient_dob'] ?></td>
                                    <td><?php echo getGenderName($rowPres['patient_gender']) ?></td>
                                    
                                    <td class="align-middle">
										
												<?php echo getConditionName($rowPres['pres_condition']); ?>
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle" >
										
												 <?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           }
														   
														   ?>
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<?php echo getPrescriptionStatus_clinician($rowPres['pres_stage']);  ?>
                                                            
                                                            <?php echo $val;  ?>
                                                            
                                                           
											</div>
										</div>
									</td>
                                    
                                     <td>-</td>
                                    <td>-</td>
                                    <td><div class="circle-red"></div></td>
									

									
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
	<h4 class="page-title">Prescription detail</h4>
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
							<div class="col-xl-4 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Prescription Status: <?php echo getPrescriptionStatus($rowPres['pres_stage']); ?></div>
									</div>
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table">
												<tbody>
                                                
                                               		 <tr>
														<td>
															<span class="w-50">Patient Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Patient Age</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php 
									
									$from = new DateTime($rowPres['patient_dob']);
									$to   = new DateTime('today');
									echo $from->diff($to)->y;
									
									$rowPres['patient_dob'] ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Patient Biological Sex</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getGenderName($rowPres['patient_gender']) ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Patient Phone</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_phone'] ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Patient Email</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_email'] ?></span>
														</td>
													</tr>
													
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
															<span class="w-50">Condition</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getConditionName($rowPres['pres_condition']) ?></span>
														</td>
													</tr>
                                                    
                                                    
                                                    
													
													
													<tr>
														<td>
															<span class="w-50">Submitted Date</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
                                                            
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Prescription Expires</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	-
															
														</td>
													</tr>
                                                    
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
                                        <li><a href="#tab6" data-toggle="tab"  <?php if ($_GET['tab']=="") { ?> class="active" <?php } ?>>Completed Medical Assessment</a></li>
											<li ><a href="#tab5" data-toggle="tab">Order Details</a></li>
											
											<li><a href="#tab7"  data-toggle="tab" <?php if ($_GET['tab']=="message") { ?> class="active" <?php } ?>>Messages</a></li>
											
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane" id="tab5">
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
											 
											
											  ?>
                                             
                                             
											<table class="table">
												<tbody>
                                                
                                                <?php 
												if (is_array($symptoms))
												for($a=0;$a<count($symptoms);$a++) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
														<td>
															<?php echo base64_decode($symptoms[$a]['question']); //echo base64_decode($symptoms[$a]['question']) ?> :
														</td>
														
														<td width="50%" style="color:#03C">
                                                        
                                                        <?php echo base64_decode($symptoms[$a]['answer']) ?> <br /><br />
                                                        
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
                                             
                                             
											<table class="table">
												<tbody>
                                                
                                                <?php 
												//print_r ($medicalHistory);
												if (is_array($medicalHistory))
												for($a=0;$a<count($medicalHistory);$a++) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
														<td>
															<?php echo base64_decode($medicalHistory[$a]['question']); //echo base64_decode($symptoms[$a]['question']) ?> :
														</td>
														
														<td width="50%" style="color:#03C">
                                                        
                                                        <?php echo base64_decode($medicalHistory[$a]['answer']) ?> <br /><br />
                                                        
                                                        <?php
														if ($medicalHistory[$a]['more']!="")
														 echo "<font style='color:#999'>Additional information:</font> ".base64_decode($medicalHistory[$a]['more']) ?>
															
														</td>
													</tr>
                                                    
                                            <?php } ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                             <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">Your Medication History</h4>  
                                             
                                             <?php 
											 $medication=unserialize(fnUpdateHTML($rowPres['pres_medication']));
											
											
											  ?>
                                             
                                             
											<table class="table">
												<tbody>
                                                
                                                <?php 
												if (is_array($medication))
												for($a=0;$a<count($medication);$a++) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
														<td>
															<?php echo base64_decode($medication[$a]['question']);  ?> :
														</td>
														
														<td width="50%" style="color:#03C">
                                                        
                                                        <?php echo  base64_decode($medication[$a]['answer']) ?> <br /><br />
                                                        
                                                        <?php
														if ($medication[$a]['more']!="")
														 echo "<font style='color:#999'>Additional information:</font> ".base64_decode($medication[$a]['more']) ?>
															
														</td>
													</tr>
                                                    
                                            <?php } ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                              <br />
                                             <h4 style="background-color:#f9e8e8; color:#000; padding:8px">GP Details</h4>  
                                            
                                            	<table class="table">
												<tbody>
                                                <?php  
													 $sqlGP="select * from tbl_patient_gps where pg_patient_id='".$rowPres['pres_patient_id']."'";
													$resGP=$database->get_results($sqlGP);
													$rowGP=$resGP[0];
													
													if ($rowGP['pg_option']==1)
													{									
												 ?>
                                                	<tr><td>GP Name</td><td><?php echo $rowGP['pg_gp'] ?></td></tr>
                                                    
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
													<tr><td>Disclaimer</td><td><a href="<?php echo URL?>uploads/patients/agreement/<?php echo $rowPres['pres_disclaimer_file']?>" target="_blank">View</a></td></tr>
                                                    <?php } ?>
                                                    <?php if ($rowPres['pres_agreement_file']!="") { ?>
                                                    <tr><td>Agreement</td><td><a href="<?php echo URL?>uploads/patients/agreement/<?php echo $rowPres['pres_agreement_file']?>" target="_blank">View</a></td></tr>
                                                     <?php } ?>
                                                </table>
                                            
										</div>
													
													<!--<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="task-list">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center">No</th>
																<th class="border-bottom-0">Task</th>
																<th class="border-bottom-0">Client</th>
																<th class="border-bottom-0">Assign To</th>
																<th class="border-bottom-0">Priority</th>
																<th class="border-bottom-0">Start Date</th>
																<th class="border-bottom-0">Deadline</th>
																<th class="border-bottom-0">Project Status</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">1</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Design Updated</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Julia Walker</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/4.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Melanie Coleman</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-danger-light">High</span></td>
																<td>12-02-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">62%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-60"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">2</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Code Updated</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Diane Short</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/15.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Justin Parr</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-success-light">Low</span></td>
																<td>01-01-2021</td>
																<td>22-04-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">45%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-45"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">3</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Issues fixed </span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Pippa Welch</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/5.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Amelia Russell</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-warning-light">Medium</span></td>
																<td>11-04-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">53%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-50"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">4</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Testing</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Lisa Vance</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/14.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Ryan Young</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-success-light">Low</span></td>
																<td>11-04-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">67%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-65"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>-->
												</div>
											</div>
										</div>
										<div class="tab-pane <?php if ($_GET['tab']=="message") { ?> active <?php } ?>" id="tab7">
											<div class="card-body">
												<div class="pt-4 pb-4 text-end" align="right">
													<a  href="javascript:void(0);" onclick="showMessagebox()" class="btn btn-primary">Send Message</a>
												</div>
                                                
                                                <div class="card" id="contSendMessage" style="display:none" >
								<div class="card-header border-0">
									<h4 class="card-title">Send Message</h4>
								</div>
								<div class="card-body" >
                                <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=sendmessage" method="post" class="form-horizontal">
                                <div>
                                    <label class="form-label">User Type *</label>
                                    <select class="form-control" name="rdUser">
                                    	<option value="">Select</option>
                                        <option value="Patient">Send to Patient</option>
                                        <option value="Pharmacy">Send to Pharmacy</option>
                                    </select>
                                     <div style="height:20px"></div>
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
										<label class="form-label">Upload Document</label>
										<div class="form-group">
										<label for="form-label" class="form-label"></label>
										<input class="form-control" type="file">
										</div>
									</div>
                                    
                                  <div class="card-footer">
									<button type="submit" class="btn btn-primary">Send</button>
									<a  href="javascript:void(0);" onclick="showMessagebox()" class="btn btn-danger">Cancel</a>
								</div>  
                                <input type="hidden" name="hid" value="<?php echo $_GET['id']?>" />
								</form>	
								</div>
								
							</div>
                            </div>
                            </div>
                                                
                                                
												<div class="card shadow-none border">
                                                
                                                 <?php 
														$sqlMessage="select * from tbl_messages where  message_parent_reply=0 and message_pres_id='".$database->filter($_GET['id'])."' order by message_id desc";
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
																
																			if ($rowMessage['message_sender_type']=="Patient")
																				{
																				$sqlSender="select * from tbl_patients where patient_id='".$rowMessage['message_sender_id']."'";
																				//else if ($rowMessage['message_sender_type']=="Clinician")
																				//$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['patient_first_name']." ".$rowSender['patient_middle_name']." ".$rowSender['patient_last_name']." (".$rowMessage['message_sender_type'].")";
																				$colorCss="danger";
																				}
																				else if ($rowMessage['message_sender_type']=="Clinician")
																				{
																					$replierName="Me (Clinicians)";
																					$colorCss="primary";
																				}



														
													?>
													<div class="d-sm-flex p-5">
													
                                                    
                                                    
                                                    
                                                    	
														<div class="media-body">
															<h5 class="mt-1 mb-1 font-weight-semibold"><?php echo $rowMessage['message_subject']?> <span class="badge badge-<?php echo $colorCss; ?>-light badge-md ms-2"><?php echo $replierName; ?></span></h5>
															<small class="text-muted"><i class="fa fa-calendar"></i> <?php echo $formattedDate; ?> <i class=" ms-3 fa fa-clock-o"></i> <?php echo $formattedTime; ?></small>
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
                                                                
                                                                
                                                                <?php if ($rowMessage['message_sender_type']=="Patient" || $rowSub['message_sender_type']=="Patient" ) { ?>
                                                                <br />
																	<a  href="javascript:void(0);" onclick="sendReply('<?php echo $rowMessage['message_id']; ?>')" class="me-2 mt-1"><span class="badge badge-light"><i class="fa fa-reply"></i> Reply</span></a>
                                                                    
                                                                  
                                                                  <div class="card" id="contReplyMessage_<?php echo $rowMessage['message_id']; ?>" style="display:none">
								<div class="card-header border-0">
									<h4 class="card-title">Send Reply</h4>
								</div>
								<div class="card-body" >
                                <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=sendmessage" method="post" class="form-horizontal">
                                
                                    
                                   
                                    
									
                                    <div style="height:20px"></div>
                                    <div>
                                    
                                    <input type="text" class="form-control" name="txtSubject" placeholder="Please enter subject of your message *" maxlength="200"></div>
                                     <div style="height:20px"></div>
									<div>
                                   
                                    <textarea rows="5" class="form-control" cols="50" name="txtMessage" placeholder="Please enter the message *"></textarea></div>
                                    <div style="height:20px"></div>
									<div class="form-group">
										<label class="form-label">Upload Document (If any)</label>
										<div class="form-group">
										<label for="form-label" class="form-label"></label>
										<input class="form-control" type="file">
										</div>
									</div>
                                    
                                  <div class="card-footer">
									<button type="submit" class="btn btn-primary">Send</button>
									<a  href="javascript:void(0);" onclick="showMessagebox()" class="btn btn-danger">Cancel</a>
								</div>  
                                <input type="hidden" name="hid" value="<?php echo $_GET['id']?>" />
                                 <input type="hidden" name="pid" value="<?php echo $rowMessage['message_id']?>" />
								</form>	
								</div>
								
							</div>
                            
                                                                    
                                                            	<?php } ?>
                                                            
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
							</div>
						</div>
						<!-- End Row-->

					</div><!-- end app-content-->
				</div>
		</div>

<script language="javascript">

function showMessagebox()
{
	$("#contSendMessage").toggle(500);
}
function sendReply(id)
{
	
	$("#contReplyMessage_"+id).toggle(500);
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
				txtSubject: "Subject cannot be blank",
				rdUser: "Please select user type",
				txtMessage: "Please enter message"
				
				
				}			
		});

</script>


             <?php } ?>
  