<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title">Patient Report</h4>
                <br />
                <a href="javascript:history.back()">Reports</a> > Patient Report
			</div>
			<div class="page-rightheader ml-md-auto">
				<!--<button type="button" class="btn btn-secondary mr-3" data-toggle="modal" data-target="#excelmodal">-->
                
                <?php $queryString=$_SERVER['QUERY_STRING']; ?>
                <button type="button" class="btn btn-secondary mr-3" onclick="window.location='export/patient-report-export.php?<?php echo $queryString?>'">
					<i class="las la-file-excel"></i>  Download Excel
				</button>
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
        <div class="row">


<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Today's Patient Registrations</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getPatientCount(1)?></h1>
									  <!--<div class="text-muted"><i class="si si-arrow-up-circle text-danger"></i> <span class="">15%</span></div>-->
								  </div>
								</div>
							</div>
							<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Last 7 Days Patient Registrations</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getPatientCount(2)?></h1>
									  <!--<div class="text-muted"><i class="si si-arrow-up-circle text-success"></i> <span class="">22%</span></div>-->
									</div>
								</div>
							</div>
							<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Last 30 Days Patient Registrations</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getPatientCount(3)?></h1>
									 <!-- <div class="text-muted"><i class="si si-arrow-up-circle text-success"></i> <span class="">32%</span></div>-->
									</div>
								</div>
							</div>
							<div class="col-md-12 col-xl-3 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Total Patients</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getPatientCount(4)?></h1>
									 
									</div>
								</div>
							</div>

							
							
							
							
                            
                            
                            
                            
                            
                            
						</div>
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
							<div class="e-table">
                            
                            
                              <form action="" method="GET">
                             	<input type="hidden" name="c" value="<?php echo $_GET['c']?>" />
                                <input type="hidden" name="task" value="<?php echo $_GET['task']?>" />
                            
										<div class="row">
                                        	<div class="col-md-12 col-lg-12 col-xl-2">
														<div class="form-group">
															<label class="form-label">Registered Date From:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSDate" type="date" value="<?php echo $_GET['txtSDate']?>">
															</div>
														</div>
													</div> 
                                                    
                                                     <div class="col-md-12 col-lg-12 col-xl-2">
														<div class="form-group">
															<label class="form-label">Registered Date To:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtEDate" type="date" value="<?php echo $_GET['txtEDate']?>">
															</div>
														</div>
													</div>   
                                                 
                           					<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">Gender</label>
                                                  
													<select name="cmbGender"  class="form-control" data-placeholder="All">
                                                    <option value="">All Gender</option>
                                                    <option value="1" <?php if ($_GET['cmbGender']==1) echo "selected"; ?>>Male</option>
                                                    <option value="2" <?php if ($_GET['cmbGender']==2) echo "selected"; ?>>Female</option>
														
													</select>
												</div>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">City</label>
                                                  <input type="text" name="txtCity" value="<?php echo $_GET['txtCity']?>" class="form-control" />
													
												</div>
											</div>
											
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">Nominated Pharmacy</label>
                                                  
													 <?php 
												   	$sqlPharmacy="select pharmacy_id,pharmacy_name from tbl_pharmacies where pharmacy_status=1 order by pharmacy_name";
													$resPharmacy=$database->get_results($sqlPharmacy);
													
													 ?>
                                                  
													<select name="cmbPharmacy"  class="form-control" data-placeholder="All">
													<option value="">All Pharmacies</option>
                                                    <?php if (count($resPharmacy)>0)
													{
														for ($j=0;$j<count($resPharmacy);$j++)
														{
															$rowPharmacy=$resPharmacy[$j];
														?>
                                                   			 <option value="<?php echo $rowPharmacy['pharmacy_id']?>" <?php if ($rowPharmacy['pharmacy_id']==$_GET['cmbPharmacy']) echo "selected"; ?>><?php echo $rowPharmacy['pharmacy_name']; ?></option>
                                                   <?php }
													}	?>
													</select>
												</div>
											</div>
                                            
											<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSDate"))
												   {
												    ?>
                                                    <a href="?c=reports&task=patientreport" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php } ?>
												</div>
											</div>
										</div>
                                    
                                   </form>
                                        
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
													
													<th width="14%" class="border-bottom-0">Patient ID</th>
                                                    <th width="14%" class="border-bottom-0">Patient Name</th>
                                                   <th width="14%" class="border-bottom-0">Gender</th>
                                                   <th width="14%" class="border-bottom-0">DOB</th>  
                                                   <th width="14%" class="border-bottom-0">Email</th>    
                                                   <th width="14%" class="border-bottom-0">Phone</th> 
                                                   <th width="14%" class="border-bottom-0">Nominated Pharmacy</th> 
                                                   <th width="14%" class="border-bottom-0">KYC Status</th> 
                                                  <th width="14%" class="border-bottom-0">Address</th> 
                                                  
                                                   <th width="19%" class="border-bottom-0">Date  of Registration</th>
                                                
                                               
											</tr>
										</thead>
							


									
							<tbody>
                            
                            <?php
						$sql = "SELECT * from tbl_patients where 1 ";
						
						if ($_GET['cmbGender']!="")
						{
							$sql.=" and patient_gender='".$database->filter($_GET['cmbGender'])."'";
						}
						
						if ($_GET['cmbPharmacy']!="")
						{
							$sql.=" and patient_pharmacy='".$database->filter($_GET['cmbPharmacy'])."'";
						}
						
						if ($_GET['txtCity']!="")
						{
							$sql.=" and patient_city like '%".$database->filter($_GET['txtCity'])."%'";
						}
						
						if ($_GET['txtSDate']!="")
						{
							 $startDate = $_GET['txtSDate']." 00:00:00";
							$sql.=" and patient_registered_date>='".$database->filter($startDate)."'";
						}
						if ($_GET['txtEDate']!="")
						{
							$endDate = $database->filter($_GET['txtEDate']) . ' 23:59:59';
							$sql.=" and patient_registered_date<='".$database->filter($endDate)."'";
						}
						
						$sql.=" order by patient_first_name asc";
						$res=$database->get_results($sql);
						if (count($res)>0)
						{
							
							for ($k=0;$k<count($res);$k++)
							{
								$row=$res[$k];
					?>	
								
                 		<tr>
                        	<td style="color:#039;font-weight:bold"><?php echo $row['patient_id'] ?></td>
                            <td><?php echo $row['patient_title']." ".$row['patient_first_name']." ".$row['patient_middle_name']." ".$row['patient_last_name']; ?> </td>
                            <td><?php echo getGenderName($row['patient_gender']); ?></td>
                            <td><?php echo fn_GiveMeDateInDisplayFormat($row['patient_dob']); ?></td>
                            <td><?php echo $row['patient_email']; ?></td>
                            <td><?php echo $row['patient_phone']; ?></td>
                            <td><?php echo getPharmacyName($row['patient_pharmacy']); ?></td>
                            <td><?php if ($row['patient_kyc']==0) { ?>
															<span class="badge badge-danger-light">Pending</span>
                                                            <?php } else if ($row['patient_kyc']==1) { ?>
                                                            <span class="badge badge-danger-light">Verified</span>
                                                            <?php } else if ($row['patient_kyc']==2) { ?>
                                                            <span class="badge badge-danger-light">Rejected</span>
                                                            <?php } ?></td>
                            <td><?php 
							$address=$row['patient_address1'];
							if ($row['patient_address2']!="")
							$address.=", ".$row['patient_address2'];
							if ($row['patient_city']!="")
							$address.=", ".$row['patient_city'];
							
							$address.=", ".$row['patient_postcode'];
							
							
							echo $address; ?></td>
                          
                           
                            <td><?php 
							 $registeredDate=$row['patient_registered_date'];
							echo fn_uk_format_date_time($registeredDate);
							 ?></td>
                           
                        </tr> 
                        
                        <?php }
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
				</div>
			</div>
			<!-- End Row -->

		</div>
	</div><!-- end app-content-->
</div>
				
            
            <!--Excel Modal -->
			<div class="modal fade"  id="excelmodal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Select Month & Year</h5>
							<button  class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="form-label">Month:</label>
								<select name="attendance"  class="form-control custom-select select2" data-placeholder="Select Month">
									<option label="Select Month"></option>
									<option value="1">January</option>
									<option value="2">February</option>
									<option value="3">March</option>
									<option value="4">April</option>
									<option value="5">May</option>
									<option value="6">June</option>
									<option value="7">July</option>
									<option value="8">August</option>
									<option value="9">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
								</select>
							</div>
							<div class="form-group">
								<label class="form-label">Year:</label>
								<select name="attendance"  class="form-control custom-select select2" data-placeholder="Select Year">
									<option label="Select Year"></option>
									<option value="1">2024</option>
									<option value="2">2023</option>
									<option value="3">2022</option>
									<option value="4">2021</option>
									<option value="5">2020</option>
									<option value="6">2019</option>
									<option value="7">2018</option>
									<option value="8">2017</option>
									<option value="9">2016</option>
									<option value="10">2015</option>
									<option value="11">2014</option>
									<option value="12">2013</option>
									<option value="13">2012</option>
									<option value="14">2011</option>
									<option value="15">2019</option>
									<option value="16">2010</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<a href="#" class="btn btn-outline-danger" data-dismiss="modal">Close</a>
							<a href="#" class="btn btn-primary">Download</a>
						</div>
					</div>
				</div>
			</div>
			<!-- End Excel Modal  -->