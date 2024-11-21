<div class="e-table">
                            
                            
                        
                            
							<div class="row">
                           
                           					<div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Search by Invoice Id or Order Id.:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>">
															</div>
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
                                
                               
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												
                                                <th width="19%" class="border-bottom-0">Invoice Id</th>
                                                <th width="27%" class="border-bottom-0">Subscription Amount</th>                                                
                                                <th width="25%" class="border-bottom-0">Start Date</th>
                                                <th width="25%" class="border-bottom-0">End Date</th>
                                                <th width="25%" class="border-bottom-0">Order Id</th>
                                                <th width="15%" class="border-bottom-0 w-20">Status</th>
                                                <th width="14%" class="border-bottom-0"></th>
                                              
											</tr>
										</thead>
							<?php

							
					
						
						/*$sqlPres="select * from tbl_prescriptions where pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' order by pres_id desc";
						$resPres=$database->get_results($sqlPres);
						$totalRecords=count($resPres);*/
						
						if($totalRecords > 0) 

							{

						
						//for ($k=0;$k<$totalRecords;$k++)
						//{
							
							//$rowPres=&$rows[$k];
						
						?>



									
							<tbody>
								<tr>
									
									<td class="align-middle">
                                    
                                   
                                    <a href="#" style="color:#06F; text-decoration:underline">#23543</a>
										
												
											
									</td>
                                    <td class="align-middle">
                                    
                                   &pound;12
										
												
											
									per month</td>
                                    
                                    
                                    
                                    <td class="align-middle">
										
												15.10.2022
											
									</td>
                                    <td class="align-middle">
										
												15.01.2023
											
									</td>
                                    
                                     <td class="align-middle">
										
										<a href="#" style="color:#06F; text-decoration:underline">PH-54332</a>		
											
									</td>
                                    
                                    <td class="align-middle">
										
										<span class="tag tag-green">Active</span>		 
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
														<a href="#" class="action-btns" data-toggle="modal" data-target="#viewsalarymodal">
																<i class="feather feather-file text-primary" data-toggle="tooltip" data-placement="top" title="View"></i>
															</a>
															
															<a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="Download">
																<i class="feather feather-download  text-secondary"></i>
															</a>
															
															
															
                                                            
                                                           
											</div>
										</div>
									</td>
                                    
									

									
								</tr>
                                
                                

								<?php

//}

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