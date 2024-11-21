<?php include "../private/settings.php";

unset ($_SESSION['sessCart_common']);

$sqlMedicine="select * from tbl_medication where med_id='".$database->filter($_GET['m'])."' and med_status=1";
$resMedicine=$database->get_results($sqlMedicine);
if (count($resMedicine)>0)
$rowMedicine=$resMedicine[0];
else
exit;
/*$sqlTreatments="select * from tbl_conditions where condition_status=1 and condition_id='".$database->filter($_GET['c'])."'";
$resTreatments=$database->get_results($sqlTreatments);

$rowTreatments=$resTreatments[0];*/

include PATH."include/headerhtml.php";
 ?>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
 <style>
    .modal {   
      z-index: 1000;    
    }
    .ui-autocomplete {
      position: absolute;
      z-index: 1050; /* Higher than the modal's z-index */
    }
	.modal-content {
		margin:6% auto;
	}
  </style>
  <body>
  	<?php include PATH."include/header.php"; ?> 
<div class="product_detail">
	<div class="product_detail_top">
<section class="breadcrumbs">
	<div class="container">
    <?php
	
	if ($_GET['cid']!="")
	$conditionId=$_GET['cid'];
	else
	$conditionId=$rowMedicine['med_conditions'];
	
	?>
		<ul class="breadcrumbs_list">
			<li><a href="<?php echo URL?>">Home</a></li>
			<li><a href="<?php echo URL?>treatments/tdetail?c=<?php echo $conditionId; ?>"><?php echo getConditionName($conditionId) ?></a></li>
			<li><?php echo $rowMedicine['med_title']; ?></li>  
            <?php //print_r ($_SESSION['sessPricing']); ?> 
		</ul>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
        <?php //print_r ($_SESSION['sessCart_common']); ?>
			<div class="product_img">
				<img src="<?php echo URL?>images/medication/<?php echo $rowMedicine['med_image']; ?>">
			</div>
			<div class="product_note">
				<p>*  Images for illustrative purposes only</p>
				<p>*  Brand supplied may vary depending on stock availability</p>
				<!--<ul class="list_item">
					<li>Proven hair loss treatment</li>
					<li>Reduces hair loss</li>
					<li>New hair growth</li>
				</ul>-->
                
                <?php
				
				$data = str_replace("-","",$rowMedicine['med_highlights']);

// Split the string into an array using the newline character as the delimiter
$items = explode("\n", $data);

// Output the items as an unordered list
echo '<ul class="list_item">';
foreach ($items as $item) {
    // Trim any leading or trailing whitespace
    $item = trim($item);
    // Skip empty items
    if (!empty($item)) {
        echo '<li>' . $item . '</li>';
    }
}
?>
                
                
			</div>	
		</div>
		<div class="col-md-5">
			<div class="right">
             <form action="add-to-cart" method="POST">
				<h2 class="title_h2"><?php echo $rowMedicine['med_title'] ?></h2>
				<p><?php echo fnUpdateHTML($rowMedicine['med_small_description']); ?></p>
                
                <?php
				$sqlStrength="select mp_strength,mp_unit from tbl_medication_pricing where mp_medicine='".$database->filter($rowMedicine['med_id'])."' and mp_in_stock=1 ";
				$resStrength=$database->get_results($sqlStrength);
				if (count($resStrength)>0)
				{
				?>				
				
				<div class="strength_box" >
					<h6>Strength:</h6>
					<ul>
                    
                    <?php
					for ($k=0;$k<count($resStrength);$k++)
					{
						$rowStrength=$resStrength[$k];
					?>
						<li>
							<label>
								<input  value="<?php echo $rowStrength['mp_strength']; ?>" <?php if ($k==0) echo "checked"; ?> type="radio" id="rdStrength" name="rdStrength" onChange="fnGetStrength()" required>
								<span><small><?php echo $rowStrength['mp_strength'].' '.$rowStrength['mp_unit']; ?></small></span>
							</label>
						</li> 
                    <?php } ?>
					</ul>
                    
				</div>
               <?php } ?>
               
               <div id="spanPack" style="display:none">
                    
                </div>
                
                <div id="spanQty" style="display:none"></div>
                 <div id="spanPeriod" style="color:#00C" ></div>
                
               
                
                
                
                </div>
           </div>     
               <div class="col-md-3">
				<div style="height:10px"></div>
                <div class="product_price_box">
                
					<h3 style="margin:10px 0px"><span id="showPricing" ></span></h3>
                    <?php if ($_SESSION['sess_patient_id']=="" && $_COOKIE['ckPharmacy']=="") { ?>
                      <div style="clear:both; padding-top:10px;margin-bottom:10px" >
                      
                        <a href="javascript:;"  class="openModalBtn" data-modal-id="myModal2" style="text-decoration:none;font-size:14px">Confirm your local pharmacy for accurate pricing</a>
                       </div>
                     <?php 
					 $getAccuracy=1;
					 } else if ($_SESSION['sess_patient_id']=="" && $_COOKIE['ckPharmacy']!="" && $_SESSION['sess_tier']=="" ) 
					 {
					 $sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$database->filter($_COOKIE['ckPharmacy'])."' and pharmacy_status=1";
					 $resPharmacy=$database->get_results($sqlPharmacy);
					 $rowPharmacy=$resPharmacy[0];
					$_SESSION['sess_tier']=$rowPharmacy['pharmacy_tier'];
					 }
					 
					  ?>
                    
                    <div style="clear:both; font-size:14px; background:#fff; border:1px solid #3A99CC;  padding:12px 20px">
						<h6 style="color:#3A99CC;font-family: Arial, sans-serif; font-weight: bold;">  <i class="fa-regular fa-check" style="color:#f63aa9; font-weight:bold"></i> Same-day Service Available</h6>
                   		<p style="padding-left:20px;margin-top:0px;margin-bottom:0px">Same-day service available for additional £10,  <a href="javascript:;"  class="openModalBtn" data-modal-id="myModal1" style="text-decoration:underline"> conditions apply.</a></p>
             
                   	</div>
                   	<div class="info_note" style="margin-top:8px;margin-bottom:8px;padding-top:10px;padding-bottom:10px">
                         <i class="fa-regular fa-circle-info"></i>
							You are required to complete a brief medical assessment to ensure the medication is suitable.
                         </div>  
					
				</div>
                <div style="clear:both">
                <?php if ($getAccuracy==1) { ?>
                <button type="button" class="btn btn-danger btn-lg openModalBtn"  data-modal-id="myModal2" style="width:100%" onClick="updateModal()">Start Consultation</button>
                <?php } else { ?>
                <button class="btn btn-danger btn-lg" style="width:100%">Start Consultation</button>
                <?php } ?>
                <input type="hidden" name="hdMedicine" value="<?php echo $rowMedicine['med_id'] ?>">
                <input type="hidden" name="hdQty" value="1">
   				</div>             
                
               
				
             </div>
          </div>
          
          <div class="row">    
             
                <div class="col-md-12">
                <?php 
					if (!isset($_SESSION['sessCart_common']))
					$_SESSION['sessCart_common']=array();
					
					//print ">>".$key = array_search(3, array_column($_SESSION['sessCart_common'], 'med_id'));
					
					$uniqueCommon=array();
					
				   $sqlCommon="select * from tbl_link_commonly_bought where find_in_set(".$rowMedicine['med_id'].",lcb_medication) and lcb_condition IN (".$database->filter($conditionId).")";
					$resCommon=$database->get_results($sqlCommon);
					$strCommon="";
					
					if (count($resCommon)>0)
					{
						for ($k=0;$k<count($resCommon);$k++)
						{
							$rowCommon=$resCommon[$k];
							
							if ($rowCommon['lcb_common_or_option']!="")
							{
								if ($strCommon!="")
								$strCommon.=",";
								$strCommon.=$rowCommon['lcb_common_or_option'];
							}
							
							if ($rowCommon['lcb_common_and_option']!="")
							{
								if ($strCommon!="")
								$strCommon.=",";
								$strCommon.=$rowCommon['lcb_common_and_option'];
							}
						}
						
						if ($strCommon!="")
						$arrCommon=explode(",",$strCommon);
						$uniqueCommon = array_unique($arrCommon);
						
						
						
					}
					
					if (count($uniqueCommon)>0)
					{
						$strUniqueCommon=implode(",",$uniqueCommon);
						$sqlGetUnique="select * from tbl_commonly_bought where med_c_id in (".$database->filter($strUniqueCommon).") order by med_c_title";
						$resGetUnique=$database->get_results($sqlGetUnique);
						
					
					
					
					if (count($resGetUnique)>0)
					{
				 ?>
                
				<div class="commonly_section" style="width:100%">
					<h5>Commonly bought with...(select at checkout)</h5>
                    <div class="clearfix"></div>
					<div class="commonly_product col-md-12" >
                    
                    <?php for ($j=0;$j<count($resGetUnique);$j++)
					
					{
						
						$rowCom=$resGetUnique[$j];
						
						//print_r ($_SESSION['sessCart_common']);
						
						 ?>
                    
						<div class="col-md-2">
							<div class="commonly_item" style="min-height:230px"  >
                            <img src="<?php echo URL?>classes/timthumb.php?src=<?php echo URL?>images/medication/common/<?php echo $rowCom['med_c_image']; ?>&w=340&h=331&zc=2" style="max-height:120px">
							<p style="padding-top:12px;font-size:14px"><?php echo $rowCom['med_c_title']?></p>
                            
                           <p style="font-size:14px">Only <b><?php echo CURRENCY.$rowCom['med_c_price']?></b> !</p>
                            <div id="cartInner_<?php echo $rowCom['med_c_id']?>" style="color:#F00; font-size:14px">
                             <?php if (!in_array($rowCom['med_c_id'], array_column($_SESSION['sessCart_common'], 'med_id'))) 
							{ ?>
							<!--<button class="btn btn-primary" id="submitBtn_<?php echo $rowCom['med_c_id']?>" onClick="addCommon(<?php echo $rowCom['med_c_id']?>)" style="width:100px"> Add to Cart</button>-->
                            <?php } else {
							echo "Product added in cart <br>";
							echo "<a href='javascript:;' onClick='removefromcart(".$rowCom['med_c_id'].")' style='color:#09F; font-size:12px'>x Remove from cart</a>";	
								?>
                            <?php } ?>
                            </div>
                            </div>
						</div>
					<?php } ?>	
						
					</div>
				</div>
                
                <?php }
					}?>
                
                 </form>
                
			</div>
		</div>
          
        
        
	</div>
</div>
</div>
<div class="quick_easy_section">
	<div class="container">
		<div class="d-flex w100p">
		<div class="quick_easy"> 
			<h3>Quick & Easy</h3>
			<p>No appointment or long <br>waiting times</p>
		</div>
		<div class="quick_easy"> 
			<h3>Confidential Service</h3>
			<p>Your information always <br> remains private</p>
		</div>
		<div class="quick_easy"> 
			<h3>Trusted Clinicians</h3>
			<p>All our doctors & pharmacists  <br>are qualified & based in the UK</p>
		</div>	
		<div class="quick_easy"> 
			<h3>Registered Pharmacies</h3>
			<p>Dispensed by our UK <br>partner pharmacies </p>
		</div> 
	</div> 
	</div>
</div>

<section class="simple_video text-center">
	<div class="container">
		<h2 class="title_h2">How to Order ? <span>Simple.</span></h2>	
		<div class="row">
			<div class="col-sm-6">
				<div class="video_box">
					<img src="<?php echo URL?>images/video_img.png">
				</div>
			</div>
			<div class="col-sm-6">
				<ul class="how_to_order_list">
					<li>
						<div class="img_box">
							<img src="<?php echo URL?>images/how-it-work-1.png">
							<h3>1.</h3>
						</div>
						<h4>Select Treatment</h4>
						<p>We have partnered with your Local Independent Pharmacy</p>
					</li>
					<li>
						<div class="img_box">
							<img src="<?php echo URL?>images/how-it-work-2.png">
							<h3>2.</h3>
						</div>
						<h4>Complete Medical Questionnaire</h4>
						<p>We have partnered with your Local Independent Pharmacy</p>
					</li>
					<li>
						<div class="img_box">
							<img src="<?php echo URL?>images/how-it-work-3.png">
							<h3>3.</h3>
						</div>
						<h4>Collect Medication from Local Pharmacy</h4>
						<p>We have partnered with your Local Independent Pharmacy</p>
					</li>
				</ul>	
			</div>
		</div>
	</div>
</section>
 <section class="faqs faqs_screen">
 	<div class="container">
 		<div class="row">
 			<div class="col-sm-4">
 				<ul class="tabs_navi nav ">
 					<li>
 						<a href="#" class="nav-link active" id="description-tab" data-bs-toggle="pill" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">	Description
 						</a>
 					</li>
 					<li>
 						<a href="#" class="nav-link" id="directions-tab" data-bs-toggle="pill" data-bs-target="#directions" type="button" role="tab" aria-controls="directions" aria-selected="false">Directions</a>
 					</li>
 					<li>
 						<a href="#" class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#sideeffects" type="button" role="tab" aria-controls="sideeffects" aria-selected="false">Side Effects</a>
 					</li>
 					<li>
 						<a href="#" class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#warnings" type="button" role="tab" aria-controls="warnings" aria-selected="false">Warnings</a>
 					</li>
 					<!--<li>
 						<a href="#" class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">FAQ</a>
 					</li>-->
 				</ul>
 				 
 			</div>
 			<div class="col-sm-8">
 				 <div class="tab-content" id="v-pills-tabContent">
				  <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
				  	<?php echo fnUpdateHTML(str_replace("\n","<br>",$rowMedicine['med_description'])); ?>
				  </div>
				  <div class="tab-pane fade" id="directions" role="tabpanel" aria-labelledby="directions-tab">
				  	
				  	<?php echo fnUpdateHTML(str_replace("\n","<br>",$rowMedicine['med_directions'])); ?>
				  </div>
                  
                  <div class="tab-pane fade" id="sideeffects" role="tabpanel" aria-labelledby="directions-tab">
				  	
				  	<?php echo fnUpdateHTML(str_replace("\n","<br>",$rowMedicine['med_side_effects'])); ?>
				  </div>
                  
                  <div class="tab-pane fade" id="warnings" role="tabpanel" aria-labelledby="directions-tab">
				  	
				  	<?php echo fnUpdateHTML(str_replace("\n","<br>",$rowMedicine['med_warnings'])); ?>
				  </div>
 			</div>
 		</div>
 	</div>
 </section> 
 
 

</div>

<section class="our-company">
	<div class="container">
		<ul class="owl-carousel-4 our_logos owl-carousel">
			<li class="item"><img src="<?php echo URL?>images/logo_01.png"></li>
			<li class="item"><img src="<?php echo URL?>images/logo_02.png"></li>
			<li class="item"><img src="<?php echo URL?>images/logo_03.png"></li>
			<li class="item"><img src="<?php echo URL?>images/logo_01.png"></li>
			<li class="item"><img src="<?php echo URL?>images/logo_02.png"></li>
			<li class="item"><img src="<?php echo URL?>images/logo_03.png"></li>
		</ul>
	</div>
</section>

<div id="myModal1" class="modal" >
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Same-day Service Terms and Conditions</h2>
          <div style="height:5px"></div>
            <p>Orders must be placed by 4 PM, Monday to Friday (excluding bank holidays). If the medication is out of stock at the pharmacy, if additional clinical information is required, or if we cannot process your order within the specified timeframe, the additional £10 fee will be refunded. We recommend checking the medication's availability at the pharmacy in advance. If your order cannot be processed in time and you prefer not to receive it the next day, please log into your account and cancel the order before processing begins.</p>
<p style="font-size:16px">&nbsp;</p>
           
         
             
          
        </div>
    </div>
    
    
    <div id="myModal2" class="modal" >
        <div class="modal-content" style="margin-top:7% !important">
            <span class="close">&times;</span>
            <h2>Confirm your local pharmacy for accurate medicine pricing</h2>
            <p style="color:#06C" id="msg_start_consultation"></p>
            
            <div style="height:5px"></div>
           
           
           
           <?php if ($_SESSION['sess_patient_id']!="") {
			   $pharmacyId=$_SESSION['sess_patient_pharmacy'];
			   
			   $sqlPharmacy="select pharmacy_name, pharmacy_p_landline from tbl_pharmacies where pharmacy_id='".$database->filter($pharmacyId)."'"; 
			   $resPharmacy=$database->get_results($sqlPharmacy);
			   $rowPharmacy=$resPharmacy[0];
			   
			   ?>
			   
			   
            <p style="font-size:16px">
            		<table width="100%" style="color:#393939; background-color:#ffeff9;border:1px solid" cellpadding="10" cellspacing="10">
                    	<tr><td colspan="2" ><h6>Please select your pharmacy to view medicine accurate pricing</h6></td></tr>
                    	<tr><td width="24%">Name</td><td width="76%"><strong><?php echo $rowPharmacy['pharmacy_name']?></strong></td></tr>
                        <tr><td>Phone</td><td><strong><?php echo $rowPharmacy['pharmacy_p_landline']?></strong></td></tr>
                    </table>
                   </p>
             <?php } else { ?>
           
              <p style="font-size:16px;padding-top:8px;">
              
              
            		<table width="100%" style="color:#393939; background-color:#fff;border:1px solid" cellpadding="10" cellspacing="10">
                    	
                       <tr><td height="20px"></td></tr>
                       <tr><td ><a href="javascript:;" class="tab-link active" onClick="openSearchOpt(1)" style="font-size:15px">Search by Name</a> &nbsp;&nbsp;
<a href="javascript:;" class="tab-link" onClick="openSearchOpt(2)" style="font-size:15px">Search by Postcode</a>
</td></tr>
                       <tr>
                       	<td style="padding-top:20px">
                        	<table width="100%" id="rowSearch1">
                        		
                        
                                <tr><td>
                                <h6 style="font-size:15px">Pharmacy Name</h6>
                                        <form method="POST">
                                          <input type="text" id="searchpharmacy" name="searchpharmacy"  class="form-control" style="max-width:400px;font-size:15px" placeholder="Start Typing to Find Your Pharmacy">
                                          
                                          <input type="hidden" id="hdKeyword2">
                                       </form>
                                   </td></tr>
                              </table>
                         </td>
                     
                        <tr><td colspan="2" style="padding-top:0px">
                        
                        	<div class="row" id="rowSearch2" style="display:none;">
                       					 <div class="col-xl-4 col-md-4">
                                          <h6 style="font-size:15px">Search  by Postcode</h6>
                                          <input class="form-control d-flex mr-3"  name="postcode" id="postcode" placeholder="" style="text-transform:uppercase">
                                         </div>
                                         <div class="col-xl-4 col-md-4">
                                          <h6 style="font-size:15px">Within Miles</h6>
                                          <select class="form-control" name="cmbMiles" id="cmbMiles" style="appearance: auto; -webkit-appearance: menulist; -moz-appearance: menulist; padding-right: 30px; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
                                            <option value="1">1 mile</option>
                                            <option value="3">3 miles</option>
                                            <option value="5">5 miles</option>
                                            <option value="10">10 miles</option>
                                        </select>

                                         </div>
                                         <div class="col-xl-4 col-md-4">
                                        
                                         <button type="button" onClick="loadPharmacy()" style="margin-top:30px;padding:0px 15px !important; min-height:30px " class="ms-2 btn btn-danger btn-lg d-inline-flex align-items-center" >Search</button>
                                         </div>
                                        </div>
                        </td>
                        </tr>
                           <tr><td colspan="2" style="height:5px"><div id="showDetails"></div></td></tr>
                     </table>
           <?php } ?>
             
            <p>&nbsp;</p>
            
            
            
            <p>
            </p>
        </div>
    </div>

 <?php include PATH."include/footer.php"; ?> 
 <script language="javascript">
  var modalOpened = false; 
 $(document).ready(function() {
	
	
    // Function to open modal
    function openModal(modalId) {
        $('#' + modalId).css('display', 'block');
		 modalOpened = true; // Set flag to true when modal is manually opened
		
    }

    // Function to close modal
    function closeModal(modalId) {
        $('#' + modalId).css('display', 'none');
    }

    // Event listener for open modal buttons
    $('.openModalBtn').click(function() {
        var modalId = $(this).data('modal-id');
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

<?php if ($getAccuracy==1) { ?>
window.onload = function() {
    setTimeout(function() {
        if (!modalOpened) { // Only open the modal if it hasn't been manually opened
            var modalId = 'myModal2';
            var modal = document.getElementById(modalId);
            modal.style.display = 'block';

            // Close modal on clicking the 'X' (close button)
            var closeButton = modal.querySelector('.close');
            closeButton.onclick = function() {
                modal.style.display = 'none';
            };

            // Close modal on clicking outside the modal content
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            };
        }
    }, 3000); // 3-second delay
};

<?php } ?>

function updateModal()
{
	$("#msg_start_consultation").html("Please confirm your local pharmacy so we can provide you the accurate medication price before continuing. You will also need to either login (for existing users) or set up an account before proceeding to the consultation.");
}

 
 function addCommon(id)
 {
	// alert (id);
	
	$("#submitBtn_"+id).html("<i class='fa fa-spinner fa-spin'></i>"); 
	 	
                $.ajax({
                    type: 'POST',
                    url: 'ajax/add-to-cart-common.php',
                    data: { cid: id },
                    success: function(response){
                        $("#cartInner_"+id).html("Product added to cart<br><a href='javascript:;' onClick='removefromcart(<?php echo $rowCom['med_c_id']?>)' style='color:#09F; font-size:12px'>x Remove from cart</a>");
                    }
                });
				location.reload();
	 
 }
 function removefromcart(id)
 {
	 //alert (id);
	 
	 $("#cartInner_"+id).html("<i class='fa fa-spinner fa-spin'></i>");
	 
	 $.ajax({
                    type: 'POST',
                    url: 'ajax/removefromcart-common.php',
                    data: { cid: id },
                    success: function(response){
                        $("#cartInner_"+id).html('<button class="btn btn-primary" onClick="addCommon(<?php echo $rowCom['med_c_id']?>)">Add to Cart</button>');
                    }
                });
				
				location.reload();
 }
 
 				function fnGetStrength() {              
           		 				 
				
				 
				 var medId, sId;
					medId=<?php echo $_GET['m']?>;
						
					sId=$('input[name="rdStrength"]:checked').val();	
				 
				
						$.ajax({
						url: 'ajax/get-pack.php', 
						type: 'POST',
						data: { mid: medId,sid:sId},
						success: function(response) {
							$("#spanPack").html(response);
							$("#spanPack").show();
							$("#spanQty").hide();
							$("#showPricing").html("");
							getQuantity();
						}
						})
						
				}
				fnGetStrength();
				
				
				function getQuantity()
				{
					
					var medId, sId, pId;
					
				
								
					
					medId=<?php echo $_GET['m']?>;
					sId = $('input[name="rdStrength"]:checked').val();
					pId=$('input[name="rdPack"]:checked').val();
					
	
					$.ajax({
					url: 'ajax/get-quantity.php', 
					type: 'POST',
					data: { mid: medId,sid:sId,pid:pId},
					success: function(response) {
						$("#spanQty").html(response);
						$("#spanQty").show();
						getPrice();
					}
					})
				
				
				
							
							
						}
						
			function getPrice()
			{
				
				
				 // Get values from the fields
					var medicine = <?php echo $_GET['m']?>;
					var strength = $('input[name="rdStrength"]:checked').val();
					var pack = $('input[name="rdPack"]:checked').val();
					var qty = $('input[name="rdQuantity"]:checked').val();;
					var tier = 1;
					
					
			
					// Check if any of the fields are empty
					//if (!medicine || !strength || !pack || !qty || !tier) {
						//alert("All fields are required.");
						//return false;
					//}
					
					
					
					
						$.ajax({
						url: 'ajax/get-price.php', 
						type: 'POST',
						data: { mid: medicine,sid:strength,pid:pack,quantity:qty,t:tier},
						success: function(response) {
							
							var resultArray = response.split('~');
							
							$("#showPricing").html(resultArray[0]);
							
							if (resultArray[1] && resultArray[1].trim() !== "")
							$("#spanPeriod").html(resultArray[1]);
							
						}
						})
					
					
					
			}
			
			
	function openSearchOpt(val) {
    // Reset all tabs to inactive state
    $("a.tab-link").removeClass("active");

    // Show/hide search options
    if (val == 1) {
        $("#rowSearch1").show();
        $("#rowSearch2").hide();
        // Add active class to 'Search by Name'
        $("a[onClick='openSearchOpt(1)']").addClass("active");
    } else if (val == 2) {
        $("#rowSearch2").show();
        $("#rowSearch1").hide();
        // Add active class to 'Search by Postcode'
        $("a[onClick='openSearchOpt(2)']").addClass("active");
    }
}

function loadPharmacy()
{
		zipcode=$("#postcode").val();		
		miles=$("#cmbMiles").val();		
		
		
				var encodedZipcode = encodeURIComponent(zipcode);
			
				
				$("#showDetails").html("<img src='https://cdnjs.cloudflare.com/ajax/libs/galleriffic/2.0.1/css/loader.gif'>");
				
				$("#showDetails").load("ajax/pharmacy-details-selection.php?code=" + encodedZipcode + "&miles=" + miles + "", function(response, status, xhr) {
					
				if (status == "success") {
				  console.log("Content loaded successfully!");
				} else if (status == "error") {
				  console.log("Error loading content: " + xhr.status + " " + xhr.statusText);
				}
			  });
			  $("#errord").html("");
}

$(function() {
   
	
	 $("#searchpharmacy").autocomplete({
		 minLength: 1,
        source: "<?php echo URL?>ajax/pharmacies",
       select: function( event, ui ) {
            event.preventDefault();
			$("#searchpharmacy").val(ui.item.value);
            $("#hdKeyword2").val(ui.item.id);
			idVal=ui.item.id;
			
			getPharmacyDetails(idVal)
			
			//window.location='<?php echo URL?>pages/pharmacy-detail?pid='+idVal;
			
        }
    });
	
	
});
</script>
<script language="javascript">
function scrollToMedicine()
{
 	
 $("#id_medicine").click();
   	
}


$(document).ready(function() {
    // Function to open modal
    function openModal(modalId) {
        $('#' + modalId).css('display', 'block');
    }

    // Function to close modal
    function closeModal(modalId) {
        $('#' + modalId).css('display', 'none');
    }

    // Event listener for open modal buttons
    $('.openModalBtn').click(function() {
        var modalId = $(this).data('modal-id');
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

function getPharmacyDetails(id)
	{
		$.ajax({
			url: 'ajax/pharmacy-details-selection.php', 
			type: 'POST',
			data: { pid: id},
			success: function(response) {
			$("#showDetails").html(response);
					}
			})
					
					
					
	}		
		
				 
 
 </script>