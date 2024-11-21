<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title">Clinician Report</h4>
                <br />
                <a href="javascript:history.back()">Reports</a> > Clinician Report
			</div>
			<div class="page-rightheader ml-md-auto">
             <?php $queryString=$_SERVER['QUERY_STRING']; ?>
                <button type="button" class="btn btn-secondary mr-3" onclick="window.location='export/clinician-report-export.php?<?php echo $queryString?>'">
					<i class="las la-file-excel"></i>  Download Excel
				</button>
            
			<!--	<button type="button" class="btn btn-secondary mr-3" data-toggle="modal" data-target="#excelmodal">
					<i class="las la-file-excel"></i>  Download Excel
				</button>-->
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
        <div class="row">


								<div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Total verified clinicians</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getClinicianCount(1); ?></h1>
									 
								  </div>
								</div>
								</div>
                                
                                <div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>Total hours worked by clinicians this month</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getTimeSpent('this_month'); ?></h1>
									 
								  </div>
								</div>
								</div>
                                
                                <div class="col-md-12 col-xl-4 col-lg-6">
								<div class="card text-center">
									<div class="card-body"> <span>New clinician registrations this month</span>
									  <h1 class=" mb-1 mt-1 font-weight-bold"><?php echo getClinicianCount(2); ?></h1>
									  
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
                           
                           						
                                                 
                                             		 <div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Profession:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<select class="form-control" name="cmbProf" id="cmbProf"  >
										<option label="Select"></option>
										<?php
				$query = "SELECT * FROM tbl_professions where prof_status=1";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {

									?>

								<option value="<?php echo $value['prof_id']; ?>" <?php if ($value['prof_id']==$_GET['cmbProf']) echo "selected"; ?>   ><?php echo $value['prof_title']; ?></option>

							<?php	

							}

							?> 

									
									</select>
																</div>
															</div>
														</div>
													</div> 
                                                    
                                                     <div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Active/Inactive:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div>
                                                    <select name="cmbStatus"  class="form-control" data-placeholder="All">
                                                        <option value="">All Status</option>
                                                        <option value="1" <?php if ($_GET['cmbStatus']==1) echo "selected"; ?>>Active</option>
                                                        <option value="0" <?php if ($_GET['cmbStatus']==0 && $_GET['cmbStatus']!="") echo "selected"; ?>>Inactive</option>
														
													</select>
															</div>
														</div>
													</div>   
                                                 
                           
											
											
                                            
                                            
                                            
											<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSearchByTitle"))
												   {
												    ?>
                                                    <a href="" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php } ?>
												</div>
											</div>
										</div>
                                  </form>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
													<th width="14%" class="border-bottom-0">Employee Number</th>
													<th width="14%" class="border-bottom-0">Clinician Name</th>
                                                   
                                                   <th width="14%" class="border-bottom-0">Profession</th> 
                                                   <th width="14%" class="border-bottom-0">Registration No.</th>  
                                                    <th width="14%" class="border-bottom-0">Address</th>
                                                   <th width="14%" class="border-bottom-0">Email</th> 
                                                   
                                                      
                                                   <th width="14%" class="border-bottom-0">Phone</th>   
                                                   
                                                   <th width="19%" class="border-bottom-0">Registration Date</th>
                                                   
                                                   <th width="19%" class="border-bottom-0">Status</th>
                                                
                                               
											</tr>
										</thead>
							


									
							<tbody>
						
                         <?php
						$sql = "SELECT * from tbl_prescribers where 1 ";
						
						if ($_GET['cmbProf']!="")
						{
							$sql.=" and pres_profession='".$database->filter($_GET['cmbProf'])."'";
						}
						
						if ($_GET['cmbStatus']!="")
						{
							$sql.=" and pres_status='".$database->filter($_GET['cmbStatus'])."'";
						}
						
						
						
						$sql.=" order by pres_forename asc";
						$res=$database->get_results($sql);
						if (count($res)>0)
						{
							
							for ($k=0;$k<count($res);$k++)
							{
								$row=$res[$k];
					?>	
                        		
                 		<tr>
                        	<td style="color:#039;font-weight:bold"><?php echo $row['pres_emp_number']?></td>                           
                            <td><?php echo getClincianNameWithTitle($row['pres_id']);?></td>
                            <td><?php echo getProfName($row['pres_profession']); ?></td>
                            <td><?php echo getGhpCRegNo($row['pres_id']); ?></td>
                             <td><?php 
							
							$address=$row['pres_address1'];
							if ($row['pres_address2']!="")
							$address.=", ".$row['pres_address2'];
							if ($row['pres_city']!="")
							$address.=", ".$row['pres_city'];
							
							$address.=", ".$row['pres_postcode'];
							
							
							echo $address; ?>
							 
							</td>
                            <td><?php echo $row['pres_email']?></td>
                            <td><?php echo $row['pres_mobile']?></td>
                           
                         
                           
                            <td><?php 
							 $registeredDate=$row['pres_registered_on'];
							echo fn_uk_format_date_time($registeredDate);
							 ?></td>
                             
                             <td><div class="btn-group align-top">
										<?php if($row['pres_status'] == 1){ ?>

										<span class="tag tag-green">Active</span>

										<?php }else if($row['pres_status'] == 0){ ?>

										<span class="tag tag-red">Inactive</span>

										<?php } ?>


											
										</div></td>
                           
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
			<!--<div class="modal fade"  id="excelmodal">
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
			</div>-->
			<!-- End Excel Modal  -->