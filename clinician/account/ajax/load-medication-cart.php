<?php include "../../../private/settings.php";

?>

<table class="table border-top" style="background:#fff; width:95%; margin:auto; border:1px solid #d9d9d9; margin-bottom:15px">
												<thead style="padding-left:20px">
                                                
													<tr>
														<th>Medication</th>
														<th>Strength</th>
														<th>Quantity</th>
														<th>Price</th>
                                                        <th>Dosage Instruction</th>
                                                        <!--<th></th>-->
                                                        <th></th>
                                                        
													</tr>
												</thead>
												<tbody style="padding-left:20px">
                                                
                                                 <?php
												 
												 				 $sqlMedicine_ck="select pres_id,pres_medicine_change_status from tbl_prescriptions where pres_id='".$database->filter($_GET['pres_id'])."' and (pres_medicine_change_status=1 || pres_medicine_change_status=2)";
																$resMedicine_ck=$database->get_results($sqlMedicine_ck);
																$rowMedicine_ck=$resMedicine_ck[0];
																if (count($resMedicine_ck)>0)
																$tableNm="tbl_prescription_medicine_change_requests";
																else
																$tableNm="tbl_prescription_medicine";
																
												 
												 
																$sqlMedicine="select * from ".$tableNm." where pm_pres_id='".$database->filter($_GET['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
												 ?>
													<tr>
														<th scope="row"><?php echo $rowMedicine['pm_med']; ?></th>
														<td><?php echo $rowMedicine['pm_med_strength']; ?></td>
														<td><?php echo $rowMedicine['pm_med_qty']; ?></td>
														<td><?php echo CURRENCY?><?php echo $rowMedicine['pm_med_total']; ?></td>
                                                        <td title="<?php echo $rowMedicine['pm_med_dosage']; ?>"><?php echo substr($rowMedicine['pm_med_dosage'],0,50); ?>..</td>
                                                        <!--<td><a class="btn btn-light" href="javascript:void()">Edit</a></td>-->
                                                        <?php 
														if ($rowMedicine_ck['pres_medicine_change_status']==0 || $rowMedicine_ck['pres_medicine_change_status']==1 || $rowMedicine_ck['pres_medicine_change_status']==4) { ?>
                                                        <td><a class="btn btn-light" onclick="removeMed(<?php echo $rowMedicine['pm_id']?>)" href="javascript:void()">Remove</a></td>
                                                        <?php } ?>
													</tr>
                                               
                                                <?php } ?>
                                               
                                               
												</tbody>
											</table>
                                            
                                            