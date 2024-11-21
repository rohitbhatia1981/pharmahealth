<?php include "../../private/settings.php";

include PATH."patient/checksession.php";
include PATH."include/headerhtml.php";
//print_r ($_SESSION['sessCart']);

if (!isset($_SESSION['sessCart'])) {
    // If it doesn't exist, initialize it as an empty array
    $_SESSION['sessCart'] = array();
}

if (count($_SESSION['sessCart'])==0)
{
	print "<script>window.location='".URL."treatments/a-z-conditions'</script>";
}


?>

  <!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
 <style>
    .modal {   
      z-index: 1000;    
    }
   
	.modal-content {
		margin:6% auto;
	}
	
  </style>

 <style>

.ui-menu .ui-menu-item {
	font-size:15px;
	color:#666;
	z-index:99999;
}


/* Dull appearance */
.disabled-row {
    background-color: #f0f0f0; /* Light grey */
    opacity: 0.5; /* Make the row appear faded */
}

/* Disable click events for the entire row */
.disabled-row * {
    pointer-events: none; /* Disable any user interaction */
    cursor: not-allowed; /* Show not-allowed cursor */
}

</style>
  <body style="padding-top:0px;"> 
   <div class="header_2">
       <a href="#"><img src="<?php echo URL?>images/logo.png"></a>
   </div>  
   <section class="patient-order-checkout">
       <div class="container">
           <ul class="checkout_link">
               <li class="active">
                <a href="#">
                   <span><i class="fa-regular fa-cart-shopping"></i></span>
                   <h6>Your Basket </h6>
                </a>
               </li>
               <li>
                <a href="#">
                   <span><i class="fa-regular fa-credit-card"></i></span>
                   <h6>Payment</h6>
                </a>
               </li>
           </ul>
           <h3 class="title_3 mt-4">Your Basket</h3>
           <div class="white_card mt-2">
               <div class="row">
                   <div class="col-sm-7 left">
                       <!--<h4 class="title_4">Premature Ejaculation</h4>-->
                       <p class="mt-4">Your Order</p>
                       <ul class="card_list mb-5 mt-4">
                       <?php 
					   $totalPrice=0;
					   $medString="";
					   for ($k=0;$k<count($_SESSION['sessCart']);$k++)
					   {
						   //$price=getMedicinePrice($_SESSION['sessCart'][$k]['med_id']);
						   
						   $price=$_SESSION['sessCart'][$k]['med_price'];
						   
						   if ($medString=="")
						   $medString=$_SESSION['sessCart'][$k]['med_id'];
						   else
						   $medString.=",".$_SESSION['sessCart'][$k]['med_id'];
						   
						   ?>
                           <li><?php echo getMedicineName($_SESSION['sessCart'][$k]['med_id']) ?> <span><?php echo CURRENCY ?><?php echo $price; ?></span>
                           <font style="color:#666; font-weight:400"><br>(Strength: <?php echo $_SESSION['sessCart'][$k]['med_strength']; ?>, Pack size: <?php echo $_SESSION['sessCart'][$k]['med_pack']; ?>, <br>Pack Quantity: <?php echo $_SESSION['sessCart'][$k]['med_qty']; ?>)</font>
                           </li>
                           <?php $stengthArr=explode(" ",$_SESSION['sessCart'][$k]['med_strength']);
						   $packSize=explode(" ",$_SESSION['sessCart'][$k]['med_pack']); ?>
                           <li><a href="javascript:;"  class="openModalBtn" data-modal-id="myModal2" data-medicine-id="<?php echo $_SESSION['sessCart'][$k]['med_id']?>" data-index-id="<?php echo $k?>" style="text-decoration:underline">Edit</a>
                           <!--<li>Pack Quantity: 
                           
                           <?php
						 
						    $loopSize=1;
						   
						   if ($_SESSION['sessCart'][$k]['med_strength']!="")
						   {
						   $arrStrength=explode(" ",$_SESSION['sessCart'][$k]['med_strength']);
						   $strength=$arrStrength[0];
						   
						   $sqlMaxQty="select mp_condition1_max_qty,mp_pack_size from tbl_medication_pricing where mp_medicine='".$database->filter($_SESSION['sessCart'][$k]['med_id'])."' and mp_strength='".$database->filter($strength)."' and mp_pack_size='".$database->filter($_SESSION['sessCart'][$k]['med_pack'])."'";
						   $resMaxQty=$database->get_results($sqlMaxQty);
						   $rowMaxQty=$resMaxQty[0];
			
						   $loopSize=ceil($rowMaxQty['mp_condition1_max_qty']/$rowMaxQty['mp_pack_size']);
						   }
						   
						  
						   
						   ?>
                           
                           		<select name="cmbCkQty" style="padding: 5px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; font-family: Arial, sans-serif; background-color: #fff; color: #333; width: auto;" onChange="getPrice(<?php echo $_SESSION['sessCart'][$k]['med_id'];?>,<?php echo $strength;?>,<?php echo $_SESSION['sessCart'][$k]['med_pack']; ?>,this.value)">
                                	<?php for ($j=1;$j<$loopSize;$j++) { ?>
                                    <option value="<?php echo $j;?>" <?php if ($_SESSION['sessCart'][$k]['med_qty']==$j) echo "selected"; ?>><?php echo $j;?></option>
                                    <?php } ?>
                                    
                                </select>
                            </li>-->
                       <?php 
					   
					    $totalPrice=$totalPrice+$price;
						
						
						
						
						
					   } 
					   
					   //print_r ($_SESSION['sessCart_common']);
					   
					   if (isset($_SESSION['sessCart_common'])) 
						{ 
						
							for ($k=0;$k<count($_SESSION['sessCart_common']);$k++)
					   		{
								
						  	 $price=getMedicinePrice_common($_SESSION['sessCart_common'][$k]['med_id']);
							 $price=$price*$_SESSION['sessCart_common'][$k]['med_qty'];
							
						?>
						
                         <li style="border-top:1px solid #CCC;margin-top:30px"><?php echo getMedicineName_common($_SESSION['sessCart_common'][$k]['med_id']) ?>  <span><?php echo CURRENCY ?> <?php echo $price; ?>
                         </span>
                        <font style="color:#666; font-weight:400"> <br>Quantity: &nbsp;&nbsp;
                         <?php $qtyVal=$_SESSION['sessCart_common'][$k]['med_qty'];?>
						 <select name="cmbComQty" id="cmbComQty" style="width:40px; font-size:13px; padding:4px" onChange="addCommon(<?php echo $_SESSION['sessCart_common'][$k]['med_id']?>,this.value)" >
                         <option value="1" <?php if ($qtyVal==1) echo "selected"; ?>>1</option>
                         <option value="2" <?php if ($qtyVal==2) echo "selected"; ?>>2</option>
                         <option value="3" <?php if ($qtyVal==3) echo "selected"; ?>>3</option>
                         <option value="4" <?php if ($qtyVal==4) echo "selected"; ?>>4</option>
                         <option value="5" <?php if ($qtyVal==5) echo "selected"; ?>>5</option>
                         
                         </select>
                         </font>
                         <br>
                         <a href="javascript:;" onClick="removefromcart(<?php echo $_SESSION['sessCart_common'][$k]['med_id']?>)" style='color:#09F; font-size:12px'>x Remove</a>
						 
                         </li>
                         
                         
						<?php
						 $totalPrice=round($totalPrice+$price,2);
							 }
						}
						
						
					   $_SESSION['sessTotal']=$totalPrice;
					   
					   ?>
                       
                       
                       
                       
                       
                           <li class="mt-4">Total Medication Cost <span><?php echo CURRENCY?><?php echo $totalPrice;?></span></li>
                       
                       </ul>
                       
                    
                       	<?php 
						
					 //print_r ($_SESSION);
					 
						
					 $sqlCommon="select * from tbl_link_commonly_bought where find_in_set(".$_SESSION['sessCart'][0]['med_id'].",lcb_medication) and lcb_condition='".$database->filter($_SESSION['sessCondition'])."'";
					
					
					
					$resCommon=$database->get_results($sqlCommon);
					
					$strCommon="";
					
					if (count($resCommon)>0)
					{
						for ($k=0;$k<count($resCommon);$k++)
						{
							$rowCommon=$resCommon[$k];
							
							if ($rowCommon['lcb_common_or_option']!="")
							{
								
								$strOr=$rowCommon['lcb_common_or_option'];
							}
							
							if ($rowCommon['lcb_common_and_option']!="")
							{
								
								$strAnd=$rowCommon['lcb_common_and_option'];
							}
						}
						
						/*echo $strOr;
						echo "<br>";
						echo $strAnd;*/
						
						
						
						
						
					}
					
					/*if (count($uniqueCommon)>0)
					{
						$strUniqueCommon=implode(",",$uniqueCommon);
						print $sqlGetUnique="select * from tbl_commonly_bought where med_c_id in (".$database->filter($strUniqueCommon).")";
						$resGetUnique=$database->get_results($sqlGetUnique);
					}*/
					
					
					//print_r ($uniqueCommon);
					
						
						
					if (!isset($_SESSION['sessCart_common']))
					$_SESSION['sessCart_common']=array();
				
					
					
					
					$sqlCommon = "SELECT * FROM tbl_commonly_bought where med_c_id in (".$database->filter($strAnd).") order by med_c_title";					
					$resCommon=$database->get_results($sqlCommon);
					
					$sqlCommon2 = "SELECT * FROM tbl_commonly_bought where med_c_id in (".$database->filter($strOr).") order by med_c_title";					
					$resCommon2=$database->get_results($sqlCommon2);
					
					
					//---------check any or values exists---
					if (isset($_SESSION['sessCart_common']))
					if (count($_SESSION['sessCart_common'])>0)
					{
					$valuesToCheck = explode(",", $strOr);
					
					//print_r ($_SESSION['sessCart_common']);
					
					// Initialize an array to store matching values
						$commonValues = array();
						
						// Loop through the session array and check for matching med_id values
						foreach ($_SESSION['sessCart_common'] as $item) {
							if (in_array($item['med_id'], $valuesToCheck)) {
								// If med_id exists in $valuesToCheck, add it to commonValues array
								$commonValues[] = $item['med_id'];
							}
						}
					
					
					}
					//-------end check any or values exists---
					
					
					
					if (count($resCommon)>0)
					{
						
						print_r ($commonValues);
						
						
				 ?>
                     <div class="commonly_section" style="margin-top:10px; padding:0px !important">
                       <h5 style="font-size:16px;font-weight:bold;color:#333">Commonly bought with...</h5>
                       	<table width="100%"  cellpadding="10">
                        
                        <?php for ($j=0;$j<count($resCommon);$j++)					
						{
							$rowCom=$resCommon[$j];
							
							
							
							 ?>
                        	<tr>
                            <!--<td width="6%"><img src="<?php echo URL?>classes/timthumb.php?src=<?php echo URL?>images/medication/common/<?php echo $rowCom['med_c_image']; ?>&w=50&h=50&zc=2"></td>-->
                            	<td width="67%"  style="font-size:15px">
                                <?php echo $rowCom['med_c_title']?></td>
                               	<td width="2%"><?php echo CURRENCY.$rowCom['med_c_price']?></td>
                                <td width="35%" >
                                
                                 <?php 
								 //print_r ($_SESSION['sessCart_common']);
								 if (!in_array($rowCom['med_c_id'], array_column($_SESSION['sessCart_common'], 'med_id'))) 
									{ ?>
                                <button class="btn btn-primary" style="font-size:11px; min-width:100px" onClick="addCommon(<?php echo $rowCom['med_c_id']?>,1)" >Add to Cart</button>
                                 <?php } else {
							echo "<font style='font-size:14px'>Added in cart</font> <br>";
							echo "<a href='javascript:;' onClick='removefromcart(".$rowCom['med_c_id'].")' style='color:#09F; font-size:12px'>x Remove</a>";	
								?></td>
                            <?php } ?>
                            
                            </tr>
                        <?php } ?>  
                        
                        
                         <?php 
						 
						 
						 
						 for ($j=0;$j<count($resCommon2);$j++)					
						{
							$rowCom2=$resCommon2[$j];
							//echo $strOr;
							$attribute="";
							
							if (isset($commonValues))
							if (count($commonValues)>0) 
							{
								if (in_array($rowCom2['med_c_id'],$commonValues))
								$attribute="";
								else
								$attribute='class="disabled-row"';
								
							}
							
							 ?>
                        	<tr <?php echo $attribute ?>>
                            <!--<td><img src="<?php echo URL?>classes/timthumb.php?src=<?php echo URL?>images/medication/common/<?php echo $rowCom2['med_c_image']; ?>&w=50&h=50&zc=2"></td>-->
                            	<td width="67%" style="font-size:15px">
                                <?php echo $rowCom2['med_c_title']?></td>
                               	<td><?php echo CURRENCY.$rowCom2['med_c_price']?></td>
                                <td width="30%">
                                
                                 <?php 
								 //print_r ($_SESSION['sessCart_common']);
								 if (!in_array($rowCom2['med_c_id'], array_column($_SESSION['sessCart_common'], 'med_id'))) 
									{ ?>
                                <button class="btn btn-primary" style="font-size:11px;min-width:100px" onClick="addCommon(<?php echo $rowCom2['med_c_id']?>,1)" >Add to Cart</button>
                                 <?php } else {
							echo "<font style='font-size:14px'>Added in cart</font> <br>";
							echo "<a href='javascript:;' onClick='removefromcart(".$rowCom2['med_c_id'].")' style='color:#09F; font-size:12px'>x Remove</a>";	
								?></td>
                            <?php } ?>
                            
                            </tr>
                        <?php } ?>   
                            
                           
                        </table>
                      </div> 
                       
                     
                     <?php 
					}?>
                    <p>&nbsp;</p>
                    <div style="clear:both"></div>
                    <div>
                       <p style="font-size:15px">
Your card will be authorized for the full amount, but no charges will be made until your prescription is approved by our clinical team.
<br>
If your prescription request is rejected by our clinical team, the authorization will be canceled and no charges will be made. If an alternative treatment is available, our clinical team will contact you.</p>
</div>
                   </div>
                   
                   <div class="col-sm-5">
                       <div class="gray_box">
                           <h4 class="title_4">Order Summary</h4>
                           <ul class="card_list mb-5 mt-4">
                               <li>Total Medication Cost:  <span><?php echo CURRENCY?><?php echo $totalPrice; ?></span></li>
                               
                                <?php if ($_SESSION['sessSameDay']==1) { ?>
                                
                                
                                <li id="dispSameDay" >Same-day Service:  <span><?php echo CURRENCY?>10</span></li>
                              
                             	 <?php 
								 $totalPrice=$totalPrice+10;
								 } ?>
                              
                               <li class="pt-4">Total: <span id="showNetTotal"> <?php echo CURRENCY?><?php echo $totalPrice; ?></span></li>
                               
                              
                           </ul>
                           <?php 
						   
						   // Get the current day of the week (1 for Monday, 7 for Sunday)
				$currentDayOfWeek = date('N');
				
				// Get the current time in hours and minutes (24-hour format)
				$currentTime = date('H:i');
				
				// Check if the current day is between Monday (1) and Friday (5)
				if ($currentDayOfWeek >= 1 && $currentDayOfWeek <= 5) {
					// Check if the current time is before 4 PM (16:00)
					if ($currentTime < '16:00') {
						$onTime=1;
					} else {
						$onTime=0;
					}
				} else {
					$onTime=0;
				}
						   
						   
						    ?>
                           
                            <input type="checkbox" value="1" <?php if ($_SESSION['sessSameDay']==1) echo "checked" ?>  name="ckSameDay" id="ckSameDay" onChange="showTermOption(<?php echo $onTime?>)">
                            &nbsp;<strong>Same-day Service</strong>: For an additional £10, we offer a same-day service, aiming to have your order ready for collection within 2 hours <a href="javascript:;"  class="openModalBtn" data-modal-id="myModal1" style="text-decoration:underline">conditions apply.</a>
                          
                           <br><br>
                           
                           <!--<span id="spanTerm" style="display:none">
                           <input type="checkbox" value="1" name="ckSameDay_condition" id="ckSameDay_condition">
                           &nbsp; Accept <a href="javascript:;"  class="openModalBtn" data-modal-id="myModal1" style="text-decoration:underline">same-day service terms and conditions</a>
                            <br>
                            <span id="termError" style="color:#F00;clear:both; font-size:13px; width:100%; margin-bottom:40px"></span>
                            <br><br>
                            </span>-->
                            
                           <button class="btn btn-primary w100p" onClick="fnContinue()">Continue</button>
                       </div>
                   </div>
                   
                   
                   
                   <div class="col-sm-12">
                       <h5 class="title_5 mt-4 mb-4 pb-2">Your medication will be ready for collection from your nominated pharmacy</h5>
                       <ul class="list_3">
                       
                       <?php 
					   
					   $sqlPatient="select patient_pharmacy from tbl_patients where patient_id='".$_SESSION['sess_patient_id']."'"; 
					   $resPatient=$database->get_results($sqlPatient);
					   $rowPatient=$resPatient[0];
					   
					   $sqlPh="select * from tbl_pharmacies where pharmacy_id='".$rowPatient['patient_pharmacy']."'"; 
					   $resPh=$database->get_results($sqlPh);
					   $rowPh=$resPh[0];
					   
					   
					    ?>
                       
                           <li><span>Pharmacy Name:</span><?php echo $rowPh['pharmacy_name']; ?></li>
                           <li><span>Address:</span><?php echo $rowPh['pharmacy_address']." ".$rowPh['pharmacy_address2']." ".$rowPh['pharmacy_postcode']?></li>
                           <li><span>Telephone No.:</span><?php echo $rowPh['pharmacy_primary_mobile']?></li>
                           <!--<li><span>Opening Time:</span>9:00AM - 5:00PM</li>-->
                       </ul>
                   </div>
               </div>
           </div>
       </div>
       
       <div id="myModal1" class="modal" >
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Same-day Service Terms and Conditions</h2>
          <div style="height:5px"></div>
            <p>Orders must be placed by 4 PM, Monday to Friday (excluding bank holidays). If the medication is out of stock at the pharmacy, if additional clinical information is required, or if we cannot process your order within the specified timeframe, the additional £10 fee will be refunded. We recommend checking the medication's availability at the pharmacy in advance. If your order cannot be processed in time and you prefer not to receive it the next day, please log into your account and cancel the order before processing begins.</p>
<p style="font-size:16px">&nbsp;</p>
    
          
        </div>
    </div>
    
    <div id="myModal2" class="modal">
    <div class="modal-content" style="width:65% !important; padding-top:0px !important">
        <span class="close">&times;</span>
        <iframe id="modalIframe" style="width: 100%; height: 500px; border: none;"></iframe>
    </div>
	</div>
    
    
    <div id="myModal3" class="modal" >
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Same-day Service Alert</h2>
          <div style="height:5px"></div>
            <p>Same-day service is only available for orders placed before 4pm, Monday to Friday (excluding bank holidays).</p>
<p style="font-size:16px">&nbsp;</p>
    
          
        </div>
    </div>
       
 <?php include PATH."include/footer-simple.php"; ?>
 
 <script language="javascript">
 
 $(document).ready(function() {
    // Function to open modal
    function openModal(modalId) {
        $('#' + modalId).css('display', 'block');
    }
	
	 function openModal2(medicineId,indexId) {
		
		
        // Set the src of the iframe to load the PHP page with the medicineId as a query parameter
        $('#modalIframe').attr('src', '<?php echo URL?>treatments/medicine-popup?m=' + medicineId +'&index='+indexId);       
        $('#myModal2').css('display', 'block');
    }

    // Function to close modal
    function closeModal(modalId) {
        $('#' + modalId).css('display', 'none');
    }

    // Event listener for open modal buttons
    $('.openModalBtn').click(function() {
        var modalId = $(this).data('modal-id');
		
		if (modalId=="myModal2")
		{
		var medicineId = $(this).data('medicine-id');
		var indexId=$(this).data('index-id');
		
		 openModal2(medicineId,indexId);
		}
		 else
        openModal(modalId);
    });

    // Event listener for close buttons
    $('.close').click(function() {
        var modalId = $(this).closest('.modal').attr('id');
        closeModal(modalId);
    });

    // Event listener for clicks outside the modal
    $(window).click(function(event) {
        if ($(event.target).hasClass('modal')) {
            closeModal($(event.target).attr('id'));
        }
    });
});


			
 
 function addCommon(id,qty)
 {
	 	
                $.ajax({
                    type: 'POST',
                    url: '<?php echo URL?>treatments/ajax/add-to-cart-common.php',
                    data: { cid: id, qty: qty},
                    success: function(response){
                        window.location.reload();
                    }
                });
	 
 }
 function removefromcart(id)
 {
	 $.ajax({
                    type: 'POST',
                    url: '<?php echo URL?>treatments/ajax/removefromcart-common.php',
                    data: { cid: id },
                    success: function(response){
                       window.location.reload();
                    }
                });
 }
 
 function showTermOption(oTime)
 {
	if (oTime==1)
	{ 
	
		if ($('#ckSameDay').is(':checked'))
		sid=1;
		else
		sid=0;
		
		
		
		$.ajax({
		url: '<?php echo URL?>treatments/ajax/same-day-service.php', 
		type: 'POST',
		data: { sid:sid },
		success: function(response) {
		location.reload();
		}
		})
	
	
	/* var totalPrice=<?php echo $totalPrice; ?>;
	
	
	
	
	 
	 if ($('#ckSameDay').is(':checked')) {
     //$("#spanTerm").show();
	 $("#dispSameDay").show();
	 netTotal=totalPrice+10;
    } else {
		{
      	 //$("#spanTerm").hide();
		 $("#dispSameDay").hide();
		 netTotal=totalPrice;
		}
		
		
		
    }
	
	$("#showNetTotal").html("<?php echo CURRENCY?>"+netTotal);*/
	
	}
	else
	{
	
	 $('#ckSameDay').prop('checked', false);
	  $('#myModal3').css('display', 'block');
	}
	
	 
 }
 
 
 function fnContinue()
 {
	 var r=0;
	 var s=0;
	 
	 if ($('#ckSameDay').is(':checked'))
	 {
		 r=1;
		 s=1;
		/* if ($("#ckSameDay_condition").is(':checked'))
		 {
			r=1; 
			s=1;
		 }
		 else
		 {
			 $("#termError").html("Please accept the terms and conditions");
			 r=0;
		 }*/
	 }
	 else
	 r=1;
	 
	 
	 if (r==1)
	 window.location='pay-now?s='+s;
 }
 
 function getPrice(m,s,p,q)
			{
				var medicine = m;
				var strength = s;
				var pack = p;
				var qty = q;
				
				
				
				 
					
					
				
					
						$.ajax({
						url: '<?php echo URL?>treatments/ajax/get-price-checkout.php', 
						type: 'POST',
						data: { mid: medicine,sid:strength,pid:pack,quantity:qty},
						success: function(response) {
							
							 location.reload();
							
						}
						})
					
					
					
			}
 

 
 </script>