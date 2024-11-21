<?php include "../private/settings.php";
include PATH."include/headerhtml.php"
 ?>
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

 <style>

.ui-menu .ui-menu-item {
	font-size:15px;
	color:#666;
}



</style>
  <body>
  	<?php include PATH."include/header.php"; ?> 
    
    
<section class="banner pharmacy_banner" style="padding-top:80px">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<div class="left wow fadeInLeft">
					
					<h3>Supporting Independent 
Community Pharmacies to 
Deliver Private Clinical Services</h3>
					<h6>Providing minor ailment prescription medications directly to <br>
patients without the need to see a GP.</h6>
<div class="custom_tab">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
    Medication / Condition
  </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
    	Partner Pharmacies
    </button>
  </li>
 </ul>
 <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  	<div class="serch_box">
			<input type="text" id="searchkey" name="searchkey" class="form-control" placeholder="Search Medication or Condition">
			<button><i class="fa-regular fa-chevron-right"></i></button>
		</div>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  	<div class="serch_box">
			<input type="text" id="searchpharmacy" name="searchpharmacy" class="form-control" placeholder="Search Partner Pharmacies (Postcode or Name)">
			<button><i class="fa-regular fa-chevron-right"></i></button>
		</div>
  </div>
  <input type="hidden" id="hdKeyword" value="">
  <input type="hidden" id="hdKeyword2" value="">
  
</div>
</div>
					 
					
					<a href="#" class="care_logo"><img src="<?php echo URL?>images/care_logo.png"></a>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="right wow fadeInRight">
					<img src="<?php echo URL?>images/banner_img.png">
				</div>
			</div>
		</div>
	</div>
</section>
<section class="our_partner wow fadeInUp" data-wow-delay="0.2s">
	<div class="container">
		<ul class="our_partner_logos">
			<li><h4 class="title_h4">Our Partner Pharmacies</h4>
            <br>
            <a href="<?php echo URL?>partner-pharmacy">View all Partner Pharmacies</a>
            
            </li>
			<li class="item"><img src="<?php echo URL?>images/well_logo.png"></li>
			<li class="item"><img src="<?php echo URL?>images/rowlands_logo.png"></li>
			<li class="item"><img src="<?php echo URL?>images/oliving_logo.png"></li>
			<li class="item"><img src="<?php echo URL?>images/marin_logo.png"></li> 
		</ul>
	</div>
</section>
<section class="simply_collect ">
	<div class="container">
		<div class="row">
			<div class="col-sm-6  wow fadeInLeft">
				<h3 class="title_h3">Enabling pharmacies to provide <br>	
a wide range of prescription only <br>
medications using our clinical 
prescribing service.</h3>
	<h5 class="title_h5">Provide a faster service to your patients than NHS GP <br>
or online pharmacies</h5>


	<a href="<?php echo URL?>contact-us?contact=pharmacy" class="btn btn-danger btn-lg d-inline-flex align-items-center " style="background-color:#0D6EFD; color:#FFF;font-size:15px;border-color:#0D6EFD">Register your interest with Pharma Health</a> <br>
	
			</div>
			<div class="col-sm-6  wow fadeInRight">
				<ul class="list_item">
					<li>Fight back against online pharmacies with a faster clinical service</li>
					<li>Boost private prescription sales</li>
					<li>No need to book NHS GP appointments</li>
					<li>Electronic private prescriptions issued same or next day</li>
				  <li>UK qualified pharmacist prescribers and doctors</li>
				  <li>Regulated by the Care Quality Commission (CQC)</li>
				  <li><a href="#">View full medication list</a></li>
				</ul>
				<div class="btn_group">
					<a href="#" class="d-inline-flex align-items-center btn btn-outline-primary">Read More 
						<i class="fa-regular fa-arrow-right"></i>
					</a>
					<a href="#" class="d-inline-flex align-items-center btn btn-outline-primary">Pharmacy FAQ</a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="simple_video text-center wow fadeInUp" data-wow-delay="0.2s">
	<div class="container">
		<h2 class="title_h2 mb-4">How it works<span>?</span></h2>
<div class="custom_tab_2">		
<ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">For Pharmacy</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">For Patients</button>
  </li>
</ul>
<div class="tab-content">
  
  <div class="tab-pane active" id="messages" role="tabpanel" aria-labelledby="messages-tab">

		<div class="video_box">
			<img src="<?php echo URL?>images/video_img_1.png">
		</div>
	 
<section class="treatment">
	<div class="container">
		<div class="row">
		<div class="col-sm-3 wow fadeInUp" data-wow-delay="0.2s" >
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-4.png">
				<h4><span>1.</span>Refer <br>Patients</h4>
				<p> Refer patients to Pharma Health</p>
			</div>
			</div>	
			<div class="col-sm-3 wow fadeInUp" data-wow-delay="0.3s">
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-5.png">
				<h4><span>2.</span> Medical Questionnaire <br>Reviewed</h4>
				<p>Pharma Health clinical team will 
review questionnaire and approve 
accordingly</p>
			</div>
			</div>
			<div class="col-sm-3 wow fadeInUp" data-wow-delay="0.4s">
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-6.png">
				<h4><span>3.</span> Private <br>
Prescription Issued</h4>
				<p>Receive private prescription from
Pharma Health via dedicated
online pharmacy portal</p>
			</div>
			</div>
			<div class="col-sm-3 wow fadeInUp" data-wow-delay="0.5s">
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-7.png">
				<h4><span>4.</span> Dispense <br>
Medication</h4>
				<p>Dispense medication to 
patients
</p>
			</div>
			</div>
		</div>
	</div>
</section>
</div>
<div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

		<div class="video_box">
			<img src="<?php echo URL?>images/video_img.png">
		</div>
	 
<section class="treatment">
	<div class="container">
		<div class="row">
		<div class="col-sm-3">
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-4.png">
				<h4><span>1.</span>Refer <br>Patients</h4>
				<p> Refer patients to Pharma Health</p>
			</div>
			</div>	
			<div class="col-sm-3">
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-5.png">
				<h4><span>2.</span> Medical Questionnaire <br>Reviewed</h4>
				<p>Pharma Health clinical team will 
review questionnaire and approve 
accordingly</p>
			</div>
			</div>
			<div class="col-sm-3">
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-6.png">
				<h4><span>3.</span> Private <br>
Prescription Issued</h4>
				<p>Receive private prescription from
Pharma Health via dedicated
online pharmacy portal</p>
			</div>
			</div>
			<div class="col-sm-3">
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-7.png">
				<h4><span>4.</span> Dispense <br>
Medication</h4>
				<p>Dispense medication to 
patients
</p>
			</div>
			</div>
		</div>
	</div>
</section>
</div>
</div>
</div>
</div>
</section>
<section class="our_treatments">
	<div class="container wow fadeInUp" data-wow-delay="0.5s">
		<h2 class="title_h2 text-center">Our Treatments</h2>
		<div class="row">
			<div class="col-sm-3">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/mens_health_icon.png">
					<h3>Men’s Health</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=1"><span>Hair loss</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=10"><span>Erectile dysfunction</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=11"><span>Premature ejaculation</span></a></li>
					</ul>
					<div class="mt-auto">
					<a href="<?php echo URL?>treatments/a-z-conditions" class="btn btn-danger btn-sm float-end">View All</a>
				</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/womenshealth-icon.png">
					<h3>Women’s Health</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=28"><span>Contraception</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=26"><span>Period delay</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=62"><span>Cystisis</span></a></li>
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/ChildrensHealth.png">
					<h3>Children’s Health</h3>
					<ul class="list_item_1">
						<li><a href="#"><span>Asthma</span></a></li>
						<li><a href="#"><span>Acne</span></a></li>
						<li><a href="#"><span>Dental Problem</span></a></li>
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/ChildrensHealth.png">
					<h3>General Health</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=33"><span>Acid reflux</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=39"><span>Hay fever</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=41"><span>Pain relief</span></a></li>
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/SkinHealth.png">
					<h3>Skin Health</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=49"><span>Eczema</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=51"><span>Acne</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=53"><span>Skin infection</span></a></li>
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/ChronicHealth.png">
					<h3>Chronic Health</h3>
					<ul class="list_item_1">
						<li><a href="#"><span>Asthma/COPD</span></a></li>
						<li><a href="#"><span>IBS</span></a></li> 
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/ChronicHealth.png">
					<h3>Sexual Health</h3>
					<ul class="list_item_1">
						<li><a href="#"><span>Chlamydia</span></a></li>
						<li><a href="#"><span>Genital Herpes</span></a></li> 
						<li><a href="#"><span>Genital Warts</span></a></li> 
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/TravelHealth.png">
					<h3>Travel Health</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=55"><span>Malaria</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=56"><span>Altitude sickness</span></a></li> 
						<li><a href="<?php echo URL?>treatments/tdetail?c=57"><span>Travelers diarrhea</span></a></li> 
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 text-center mt-3">
			 <a href="<?php echo URL?>treatments/a-z-treatments" class="me-2 btn btn-danger btn-lg d-inline-flex align-items-center ps-5 pe-5">View A-Z Treatments</a>
			 <a href="<?php echo URL?>treatments/a-z-conditions" class="ms-2 btn btn-danger btn-lg d-inline-flex align-items-center ps-5 pe-5">View A-Z Conditions</a>
			</div>
		</div>
	</div>
</section>
<section class="additional_clinical text-center wow fadeInUp" data-wow-delay="0.5s">
	<div class="container">
		<h2 class="title_h2">Additional Clinical Services</h2>
		<div class="row">
			<div class="col-sm-4">
				<div class="additional_clinical_box">
					<div class="img_box">
					<img src="<?php echo URL?>images/additional_icon_1.png">
					</div>
					<h5>Blood Test Service</h5>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="additional_clinical_box">
					<div class="img_box">
					<img src="<?php echo URL?>images/additional_icon_2.png">
					</div>
					<h5>GP Consultation</h5>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="additional_clinical_box">
					<div class="img_box">
					<img src="<?php echo URL?>images/additional_icon_3.png">
					</div> 
					<h5>Travel Vaccination PGDs </h5>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="our_team">
	<div class="container wow fadeInUp" data-wow-delay="0.5s">
		<h2 class="title_h2 text-center">Our Clinical Team</h2>
		<div class="owl-carousel-2 owl-carousel">
        
        
        <?php $sqlCTeam="select * from tbl_clinical_team where team_status=1 order by team_id"; 
		
		$resCTeam=$database->get_results($sqlCTeam);
		for ($r=0;$r<count($resCTeam);$r++)
		{
			$rowCTeam=$resCTeam[$r];
		
		?>
			<div class="item">
				<div class="our_team_box">
					<a href="<?php echo URL?>about-us#team"><img src="<?php echo URL?>classes/timthumb.php?src=<?php echo URL?>images/team/<?php echo $rowCTeam['team_image']?>&w=400&h=300&zc=1"></a>
					<h3><?php echo $rowCTeam['team_name']?></h3>
					<h6><?php echo $rowCTeam['team_designation']?></h6>
				</div>
			</div>
			
		<?php } ?>	
			
			
			
			
			
		</div>
	</div>
</section>
<section class="faqs">
	<div class="container wow fadeInUp" data-wow-delay="0.5s">
		<h2 class="title_h2 text-center">Frequently Asked <br> Questions <span>?</span></h2>
		<div class="row">
			<div class="col-sm-8">
				<div class="accordion" id="accordionExample">
				  <?php
			  		$sqlFaqs="select * from tbl_faq_pharmacy where faq_status=1  and faq_category=3";
					$resFaqs=$database->get_results($sqlFaqs);
					if ($resFaqs)
					for ($f=0;$f<count($resFaqs);$f++)
					{
						$rowFaqs=$resFaqs[$f];
			   ?>  
                
				  <div class="accordion-item">
				    <h2 class="accordion-header" id="headingOne">
				      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $rowFaqs['faq_id']?>" <?php if ($f==0) { ?> aria-expanded="true" <?php } else { echo 'aria-expanded="false"'; }  ?> aria-controls="collapse<?php echo $rowFaqs['faq_id']?>">
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
			<div class="col-sm-4">
				<img src="<?php echo URL?>images/faqs.png">
			</div>
		</div>
	</div>
</section>
<section class="our_patients">
	<div class="container wow fadeInUp" data-wow-delay="0.5s">
		<h2 class="title_h2 text-center">What our Pharmacies says<span>...</span></h2>
		<div class="owl-carousel-1 owl-carousel">
        
        <?php
			  		$sqlTesti="select * from tbl_testimonials_pharmacy where testimonial_status=1 order by testimonial_id desc";
					$resTesti=$database->get_results($sqlTesti);
					if ($resTesti)
					for ($f=0;$f<count($resTesti);$f++)
					{
						$rowTesti=$resTesti[$f];
			   ?>  
        
			<div class="item">
				<div class="review-wrap bg-white">
					<div class="review-user pr-2">
						<img src="<?php echo URL?>classes/timthumb.php?src=<?php echo URL?>images/testimonials/<?php echo $rowTesti['testimonial_image']?>&w=100&h=100&zc=1">
					</div>
					<div class="review-detail fst-italic">
						<p><?php echo fnUpdateHTML($rowTesti['testimonial_text']);?></p>
						<h5><?php echo $rowTesti['testimonial_client']; ?></h5>
						<h6><?php if ($rowTesti['testimonial_designation']!="") echo $rowTesti['testimonial_designation']; ?></h6>
					</div>
				</div>
			</div>
         
         <?php } 
		?>   
            
			
			
			
		</div>
	</div>
</section>
 
<section class="our-company wow fadeInUp" data-wow-delay="0.5s">
	<div class="container">
		<ul class="owl-carousel-4 our_logos owl-carousel">
			<li class="item wow fadeInUp" data-wow-delay="0.2s"><img src="<?php echo URL?>images/logo_01.png"></li>
			<li class="item wow fadeInUp" data-wow-delay="0.3s"><img src="<?php echo URL?>images/logo_02.png"></li>
			<li class="item wow fadeInUp" data-wow-delay="0.4s"><img src="<?php echo URL?>images/logo_03.png"></li>
			<li class="item wow fadeInUp" data-wow-delay="0.5s"><img src="<?php echo URL?>images/logo_01.png"></li>
			<li class="item wow fadeInUp" data-wow-delay="0.6s"><img src="<?php echo URL?>images/logo_02.png"></li>
			<li class="item wow fadeInUp" data-wow-delay="0.7s"><img src="<?php echo URL?>images/logo_03.png"></li>
		</ul>
	</div>
</section>
 <?php include PATH."include/footer.php"; ?> 
 
 <script language="javascript">
$(function() {
    $("#searchkey").autocomplete({
		 minLength: 1,
        source: "<?php echo URL?>ajax/conditions",
       select: function( event, ui ) {
            event.preventDefault();
			$("#searchkey").val(ui.item.value);
            $("#hdKeyword").val(ui.item.id);
			
			
			
			var inputString = ui.item.id;
			
			// Split the string using the tilde (~) as the separator
			var values = inputString.split("~");
			
			// Extract the values
			var idVal = values[0]; // This will be "25"
			var tyVal = values[1]; // This will be "conditions"
			
			if (tyVal=="Condition")
			window.location='treatments/tdetail?c='+idVal;
			else if (tyVal=="Medication")
			window.location='treatments/medicine?m='+idVal;
			
        }
    });
	
	
	 $("#searchpharmacy").autocomplete({
		 minLength: 1,
        source: "<?php echo URL?>ajax/pharmacies",
       select: function( event, ui ) {
            event.preventDefault();
			$("#searchpharmacy").val(ui.item.value);
            $("#hdKeyword2").val(ui.item.id);
			idVal=ui.item.id;
			
			window.location='<?php echo URL?>pages/pharmacy-detail?pid='+idVal;
			
        }
    });
	
});
</script>
