<?php include "../private/settings.php";

$sqlTreatments="select * from tbl_conditions where condition_status=1 and condition_id='".$database->filter($_GET['c'])."'";
$resTreatments=$database->get_results($sqlTreatments);

$rowTreatments=$resTreatments[0];
$_SESSION['sessCondition']=$database->filter($_GET['c']);

include PATH."include/headerhtml.php"
 ?>
  <!-- jQuery UI library -->
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

 <style>

.ui-menu .ui-menu-item {
	font-size:15px;
	color:#666;
	z-index:99999;
}



 .banner_01 {
	background-color: #eceef0;
	background-image: url(<?php echo URL?>images/condition/detail/<?php echo $rowTreatments['condition_detail_banner']?>);
	background-repeat: no-repeat;
	background-size: auto;
	background-position: bottom left;
} 
.banner_01 h3{font-size: 33px;color: #3b3b3b;font-weight: bold;}
.banner_01 h6{font-size: 19px;margin:0 0 25px 0; color:#414040;font-weight: bold;}
.banner_01 p{font-size: 18px;color: #757575;}
.banner_01 .right{padding-top: 42px;padding-bottom: 35px;}




</style>
  <body>
  	<?php include PATH."include/header.php"; ?> 
<div class="treatment_page">
<section class="breadcrumbs pb-0" style="padding-top:6px !important">
	<div class="container">
		<ul class="breadcrumbs_list">
			<li><a href="<?php echo URL?>">Home</a></li>
			<li><a href="#"><?php echo $rowTreatments['condition_title'] ?></a></li>
			<!--<li>Finasteride</li>  --> 
		</ul>
	</div>
</section> 
<section class="banner_01">
	<div class="container ">
		<div class="row align-items-center">
			<div class="col-sm-6">				 
			</div>
			<div class="col-sm-6 right">
				<h3><?php echo $rowTreatments['condition_title'] ?></h3>
				<h6><?php echo $rowTreatments['condition_sub_title'] ?></h6>
				<p><?php echo fnUpdateHTML($rowTreatments['condition_short_desc']); ?>
				</p>
				<a href="#id_details" class="btn btn-danger">Read More</a>
			</div>
		</div>
	</div>
</section>
<section class="treatment_options text-center">
	<div class="container">
		<div class="top">
			<h2 class="title_h2">Treatment Options</h2>
			<!--<p>Male Pattern Baldness is a very common condition affecting 6.5 million men in the UK..</p>-->
		</div>
		<div class="row">
        
        
        <?php
		 $offset="offset-sm-2";
		$sqlMedicine="select * from tbl_medication where find_in_set('".$database->filter($_GET['c'])."',med_conditions) and med_status=1";
		$resMedicine=$database->get_results($sqlMedicine);
		?>
        
        <?php if (count($resMedicine)>1)
		{
			?>
			<div class="col-sm-4">
        
        	<a href="javascript:;" style="text-decoration:none" class="openModalBtn" data-modal-id="myModal1">
				<div class="treatment_options_bx">					
					<!--<input type="radio" name="root-1">-->
					<div class="in "  >
					<h4>Help me choose a treatment</h4>
					<p>Guided by our clinical team</p>
					</div>
				</div>
             </a>
			</div>
         <?php 
		 $offset="";
		 } ?>
			<div class="col-sm-4 <?php echo $offset?>">
           <a href="#medicines" id="id_medicine" style="text-decoration:none">
				<div class="treatment_options_bx" >
				<!--	<input type="radio" name="root-1" onClick="scrollToMedicine()">-->
                   
					<div class="in" >
					<h4>Select a treatment option</h4>
					<p>I know what I need</p>
				</div>
               
                
				</div>
              </a> 
              
                
			</div>
			<div class="col-sm-4">
           <a href="<?php echo URL?>patient/account/index.php?c=patient-prescriptions" id="id_medicine" style="text-decoration:none"> 
				<div class="treatment_options_bx" >
				              
					<div class="in" >
					<h4>Reorder Medication</h4>
					<p>Repeat request</p>
				</div>
               
                
				</div>
          </a>
			</div>
		</div>
	</div>
</section>

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
<section class="hair_products" id="medicines">
	<div class="container"> 
			<!--<h3>Our topical and oral treatments are clinically proven to stop hair loss and promote hair regrowth.</h3> -->
			<div class="row">
            
            <?php   
			
			
			for ($j=0;$j<count($resMedicine);$j++)
			{
				$rowMedicine=$resMedicine[$j];
				
				
				   //$tierField="mp_tier".$tier."_price";
				   if ($_SESSION['sess_tier']!="")
				   $tier=$_SESSION['sess_tier'];
				   else
				   $tier=1;				
									   
					if ($tier==1)
					$baseprice = 20; 
					else if ($tier==2)
					$baseprice = 24; 
					if ($tier==3)
					$baseprice = 28; 
										
										$sqlPricing="select * from tbl_medication_pricing where mp_medicine='".$database->filter($rowMedicine['med_id'])."' and mp_quantity=1 order by mp_strength";
										$resPricing=$database->get_results($sqlPricing);
										$rowPricing=$resPricing[0];
										
										if ($rowPricing['mp_override_active']==0)
										{
										//$baseprice=$row[$tierField];
											$quantity=1;
											$medicationCost=$rowPricing['mp_medication_cost'];
											$costPrice=$rowPricing['mp_cost_price'];
											$totalCostPrice=$costPrice*$quantity;
											
											if ($totalCostPrice>=6.5)
											{
												$medicationCost=$totalCostPrice;
												$tierPrice=calculatePrice_plus($quantity,$medicationCost, $tier,$costPrice);
											}
											else
											$tierPrice=calculatePrice($baseprice, $quantity);
										}
										else
										{
											$medicationCost=$rowPricing['mp_medication_cost'];
											$costPrice=$rowPricing['mp_cost_price'];
											$quantity=1;
											
											if ($rowPricing['mp_override_price']!="")
											{
												
												$arrOR_price=unserialize(fnUpdateHTML($rowPricing['mp_override_price']));
												
												
												$tierPrice=$arrOR_price[$quantity-1];
												if ($tier>1)
												$tierPrice=calculatePriceOveride($priceTocharge,$tier);
												
											}
											
										}
										
									 
				
			
			 ?>
				<div class="col-sm-4">
					<div class="hair_products_box">
						<div class="img_box">
							<a href="<?php echo URL ?>treatments/medicine?m=<?php echo $rowMedicine['med_id']?>&cid=<?php echo $_GET['c']?>"><img src="<?php echo URL?>images/medication/<?php echo $rowMedicine['med_image']; ?>" style="max-height:250px"></a>
						</div>
						<h4><?php echo $rowMedicine['med_title']?> <span>from <b><?php echo CURRENCY.$tierPrice?></b></span></h4>
					</div>
				</div>
				
			<?php } ?>	
				
				
				
			</div>
	</div>
</section>
 <section class="faqs faqs_screen" id="id_details">
 	<div class="container">
 		<h2 class="title_h2">Advice for <?php echo $rowTreatments['condition_title']; ?> </h2>
 		<div class="row">
 			<div class="col-sm-4">
 				<ul class="tabs_navi nav ">
 					<li>
 						<a href="#" class="nav-link active" id="description-tab" data-bs-toggle="pill" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">	Overview
 						</a>
 					</li>
 					<li>
 						<a href="#" class="nav-link" id="symptoms-tab" data-bs-toggle="pill" data-bs-target="#symptoms" type="button" role="tab" aria-controls="symptoms" aria-selected="false">Symptoms</a>
 					</li>
 					<li>
 						<a href="#" class="nav-link" id="causes-tab" data-bs-toggle="pill" data-bs-target="#causes" type="button" role="tab" aria-controls="causes" aria-selected="false">Causes</a>
 					</li>
 					<li>
 						<a href="#" class="nav-link" id="treatments-tab" data-bs-toggle="pill" data-bs-target="#treatments" type="button" role="tab" aria-controls="treatments" aria-selected="false">Our Treatments</a>
 					</li>
 					<li>
 						<a href="#" class="nav-link" id="faqs-tab" data-bs-toggle="pill" data-bs-target="#alt_treatments" type="button" role="tab" aria-controls="alt_treatments" aria-selected="false">Other Treatments</a>
 					</li>
 					<li>
 						<a href="#" class="nav-link" id="faqs-tab" data-bs-toggle="pill" data-bs-target="#faqs" type="button" role="tab" aria-controls="faqs" aria-selected="false">FAQ</a>
 					</li>
 				</ul>
 				 
 			</div>
 			<div class="col-sm-8">
 				 <div class="tab-content" id="v-pills-tabContent">
				  <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab"> 
				   <?php echo fnUpdateHTML($rowTreatments['condition_overview']);?>
                   </div>
				  <div class="tab-pane fade" id="symptoms" role="tabpanel" aria-labelledby="symptoms-tab">
						<?php echo fnUpdateHTML($rowTreatments['condition_symptoms']);?>
				  </div>
                  
                   <div class="tab-pane fade" id="causes" role="tabpanel" aria-labelledby="symptoms-tab">
						<?php echo fnUpdateHTML($rowTreatments['condition_causes']);?>
				  </div>
                  
                  <div class="tab-pane fade" id="treatments" role="tabpanel" aria-labelledby="symptoms-tab">
						<?php echo fnUpdateHTML($rowTreatments['condition_treatments']);?>
				  </div>
                  
                   <div class="tab-pane fade" id="alt_treatments" role="tabpanel" aria-labelledby="alt_symptoms-tab">
						<?php echo fnUpdateHTML($rowTreatments['condition_alt_treatments']);?>
				  </div>
                  
                  <div class="tab-pane fade" id="faqs" role="tabpanel" aria-labelledby="faqs-tab">
						<h4>Frequently Asked Questions</h4>
                        
                        
                        <div class="accordion" id="accordionExample">
                
              
              <?php
			  		$sqlFaqs="select * from tbl_faq_condition where faq_category='".$rowTreatments['condition_id']."' and faq_status=1";
					$resFaqs=$database->get_results($sqlFaqs);
					if ($resFaqs)
					for ($f=0;$f<count($resFaqs);$f++)
					{
						$rowFaqs=$resFaqs[$f];
			   ?>  
                
				  <div class="accordion-item">
				    <h2 class="accordion-header" id="headingOne">
				      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $rowFaqs['faq_id']?>" aria-expanded="true" aria-controls="collapse<?php echo $rowFaqs['faq_id']?>">
				        <?php echo $rowFaqs['faq_question']; ?>
				      </button>
				    </h2>
				    <div id="collapse<?php echo $rowFaqs['faq_id']?>" class="accordion-collapse collapse <?php if ($f==0) echo 'show'; ?>" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
				      <div class="accordion-body">
				        <p> <?php echo $rowFaqs['faq_answer']; ?></p>
				      </div>
				    </div>
				  </div>
			  
              <?php } ?>
				  
				  
				  

				</div>
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


  <!--<button class="openModalBtn"  data-modal-id="myModal1">Open Modal 1</button>-->
   

    <!-- Modal 1 -->
    <div id="myModal1" class="modal" >
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Guidance on Treatment Options and Clinical Suitability</h2>
            <div style="height:5px"></div>
            <p style="font-size:16px">There are typically several treatment options available for your selected condition. If you are currently in the pharmacy, please ask to speak with your in-store pharmacist. </p>
          <p style="font-size:16px">If you are accessing this website remotely, you can call the pharmacy and request to speak with the pharmacist for further advice and guidance on the most suitable treatment option.</p>
           
           
           <?php if ($_SESSION['sess_patient_id']!="") {
			   $pharmacyId=$_SESSION['sess_patient_pharmacy'];
			   
			   $sqlPharmacy="select pharmacy_name, pharmacy_p_landline from tbl_pharmacies where pharmacy_id='".$database->filter($pharmacyId)."'"; 
			   $resPharmacy=$database->get_results($sqlPharmacy);
			   $rowPharmacy=$resPharmacy[0];
			   
			   ?>
			   
			   
            <p style="font-size:16px">
            		<table width="100%" style="color:#393939; background-color:#ffeff9;border:1px solid" cellpadding="10" cellspacing="10">
                    	<tr><td colspan="2" ><h6>Pharmacy Contact Details</h6></td></tr>
                    	<tr><td width="24%">Name</td><td width="76%"><strong><?php echo $rowPharmacy['pharmacy_name']?></strong></td></tr>
                        <tr><td>Phone</td><td><strong><?php echo $rowPharmacy['pharmacy_p_landline']?></strong></td></tr>
                    </table>
                   </p>
             <?php } else { ?>
             
              <p style="font-size:16px;padding-top:8px;">
              
            		<table width="100%" style="color:#393939; background-color:#ffeff9;border:1px solid" cellpadding="10" cellspacing="10">
                    	<tr><td colspan="2" ><h5>Find the closest Partner Pharmacy for contact details</h5></td></tr>
                       
                       <tr><td ><a href="javascript:;" class="tab-link active" onClick="openSearchOpt(1)">Search by Name</a> &nbsp;&nbsp;
<a href="javascript:;" class="tab-link" onClick="openSearchOpt(2)">Search by Postcode</a>
</td></tr>
                       <tr>
                       	<td style="padding-top:20px">
                        	<table width="100%" id="rowSearch1">
                        		
                        
                                <tr><td>
                                <h6 >Pharmacy Name</h6>
                                        <form method="POST">
                                          <input type="text" id="searchpharmacy" name="searchpharmacy"  class="form-control" style="max-width:400px" placeholder="Start Typing to Find Your Pharmacy">
                                          
                                          <input type="hidden" id="hdKeyword2">
                                       </form>
                                   </td></tr>
                              </table>
                         </td>
                     
                        <tr><td colspan="2" style="padding-top:0px">
                        
                        	<div class="row" id="rowSearch2" style="display:none;">
                       					 <div class="col-xl-4 col-md-4">
                                          <h6 >Search  by Postcode</h6>
                                          <input class="form-control d-flex mr-3"  name="postcode" id="postcode" placeholder="" style="text-transform:uppercase">
                                         </div>
                                         <div class="col-xl-4 col-md-4">
                                          <h6 >Within Miles</h6>
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
            <p style="font-size:16px">Your treatment selection will remain pending until our in-house clinician reviews your medical questionnaire to confirm its clinical suitability.</p>
            <p style="font-size:16px">Please be aware that the selected medication may not be appropriate for you based on your individual medical circumstances. If this is the case, our clinician may recommend a more suitable alternative. Any changes to your treatment will only be made with your explicit approval via email or telephone. In such cases, the cost of the medication may differ from your original selection.</p>
            
            <p>
            </p>
        </div>
    </div>

    <!-- Modal 2 -->
    


 <?php include PATH."include/footer.php"; ?> 
 
 
 <script language="javascript">
 
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
				
				$("#showDetails").load("ajax/pharmacy-details.php?code=" + encodedZipcode + "&miles=" + miles + "", function(response, status, xhr) {
					
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
			url: 'ajax/pharmacy-details.php', 
			type: 'POST',
			data: { pid: id},
			success: function(response) {
			$("#showDetails").html(response);
					}
			})
					
					
					
	}
				 

</script>
