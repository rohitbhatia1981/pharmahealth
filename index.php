<?php include "private/settings.php";
include PATH."include/headerhtml.php";

 ?>
 
 <!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

 <style>

.ui-menu .ui-menu-item {
	font-size:15px;
	color:#666;
}



</style>

  <body>
 <?php include PATH."include/header.php"; ?> 
 
 <?php 
 $bannerExists=0;
 
 if ($_COOKIE['ckPharmacy']!="" || $_SESSION['sess_patient_pharmacy']!="")
 {
	if ($_SESSION['sess_patient_id']!="")
	$pharmacy=$_SESSION['sess_patient_pharmacy'];
	else 
	$pharmacy=$_COOKIE['ckPharmacy'];
	
	 
	$sqlPharmacy="select * from tbl_pharmacies where pharmacy_id='".$database->filter($pharmacy)."'";
	
	
	 $resPharmacy=$database->get_results($sqlPharmacy);
	 $rowPharmacy=$resPharmacy[0];
 
  ?>
 	
 <div class="container-fluid pink-bg" style="margin-top:60px;margin-bottom:10px">
 	<div class="row">
    	<div class="col-sm-7" style="margin-top:20px; margin-left:20px">
        	<h3>In Partnership With</h3>
            <p><strong><?php echo $rowPharmacy['pharmacy_name'] ?></strong>, 
           <?php $address=fnPharmacyAddressStr($rowPharmacy['pharmacy_address'],$rowPharmacy['pharmacy_address2'],$rowPharmacy['pharmacy_city'],$rowPharmacy['pharmacy_postcode']);
		   
		   echo $address=str_replace("<br>","",$address);
		   
		    ?></p>
        </div>
        <?php if ($rowPharmacy['pharmacy_logo']!="") {
			
			$pharmacyLogo=$rowPharmacy['pharmacy_logo'];
			
			 ?>
        <div class="col-sm-4">
        	<img src="<?php echo URL?>images/pharmacies/<?php echo $rowPharmacy['pharmacy_logo']; ?>" style="padding-top:5%" align="right" width="25%">
        </div>
        <?php } ?>
    </div>
 </div>
 
<?php 
$bannerExists=1;
} ?>
 
<section class="banner" <?php if ($bannerExists==0) { ?> style="padding-top:80px;" <?php } ?>>
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<div class="left wow fadeInLeft">
					<h6>UK Qualified Doctors & Pharmacists</h6>
					<h3>Delivering Healthcare in <br>
						Partnership with your Local <br>	
						Independent Pharmacy <br>
					</h3>
					<p>We have partnered with your Local Independent Pharmacy to <br>
					provide a wide range of prescription-only medications for adults <br>
					and children.
					</p>
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

<section class="our_partner">
	<div class="container">
		<ul class="our_partner_logos wow fadeInUp" data-wow-delay="0.2s">
			<li><h4 class="title_h4">Our Partner Pharmacies</h4></li>
			<li class="item wow fadeInUp" data-wow-delay="0.2s"><img src="<?php echo URL?>images/well_logo.png"></li>
			<li class="item wow fadeInUp" data-wow-delay="0.3s"><img src="<?php echo URL?>images/rowlands_logo.png"></li>
			<li class="item wow fadeInUp" data-wow-delay="0.4s"><img src="<?php echo URL?>images/oliving_logo.png"></li>
			<li class="item wow fadeInUp" data-wow-delay="0.5s"><img src="<?php echo URL?>images/marin_logo.png"></li> 
		</ul>
	</div>
</section>


<section class="simply_collect">
	<div class="container">
		<div class="row">
			<div class="col-sm-6  wow fadeInLeft">
				<h3 class="title_h3">Wide range of Prescription-only <br>
Medications available without <br>
requiring a GP appointment.</h3>
	<h5 class="title_h5">Simply, collect from your Local Pharmacy</h5>
	<a href="<?php echo URL?>patient/signup" class="btn btn-danger btn-lg d-inline-flex align-items-center ps-5 pe-5">Sign up with Pharma Health</a>
			</div>
			<div class="col-sm-6  wow fadeInRight">
				<ul class="list_item">
					<li>No need to book NHS GP appointments</li>
					<li>Collect same or next day from your Local Independent Pharmacy</li>
					<li>UK Qualified Doctors & Pharmacists</li>
					<li>Private consultation service available with Our Doctors 
	& Pharmacists.</li>
				    <li>Regulated by the Care Quality Commission (CQC)</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="simple_video text-center wow fadeInUp">
	<div class="container">
		<h2 class="title_h2">It just works. <span>Simple.</span></h2>
		<div class="video_box">
			<img class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/Jfrjeg26Cwk" data-bs-target="#myModal" src="<?php echo URL?>images/video_img.png">
		</div>
	</div>
</section>
<section class="treatment wow fadeInUp">
	<div class="container">
		<div class="row">
		<div class="col-sm-4">
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-1.png">
				<h4><span>1.</span> Select <br> Treatment</h4>
				<p>We have partnered with your Local  <br>
Independent Pharmacy</p>
			</div>
			</div>	
			<div class="col-sm-4">
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-2.png">
				<h4><span>2.</span> Complete Medical <br> Questionnaire</h4>
				<p>We have partnered with your Local <br>
Independent Pharmacy</p>
			</div>
			</div>
			<div class="col-sm-4">
			<div class="treatment_box text-center">
				<img src="<?php echo URL?>images/treatment-icon-3.png">
				<h4><span>3.</span> Collect Medication from <br>Local Pharmacy</h4>
				<p>We have partnered with your Local <br> 
Independent Pharmacy</p>
			</div>
			</div>
		</div>
	</div>
</section>
<section class="our_treatments">
	<div class="container wow fadeInUp" data-wow-delay="0.5s">
		<h2 class="title_h2 text-center">Our Treatments</h2>
		<div class="row">
			<div class="col-sm-4">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/mens_health_icon.png">
					<h3>Men’s Health</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=1"><span>Hair loss</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=10"><span>Erectile dysfunction</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=11"><span>Premature ejaculation</span></a></li>
					</ul>
					<div class="mt-auto">
					<a href="<?php echo URL?>treatments/a-z-conditions?c=3" class="btn btn-danger btn-sm float-end">View All</a>
				</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/womenshealth-icon.png">
					<h3>Women’s Health</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=28"><span>Contraception</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=26"><span>Period delay</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=62"><span>Cystisis</span></a></li>
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions?c=2" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<!--<div class="col-sm-3">
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
			</div>-->
			<div class="col-sm-4">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/ChildrensHealth.png">
					<h3>General Health</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=33"><span>Acid reflux</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=39"><span>Hay fever</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=41"><span>Pain relief</span></a></li>
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions?c=6" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/SkinHealth.png">
					<h3>Skin Health</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=49"><span>Eczema</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=51"><span>Acne</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=53"><span>Skin infection</span></a></li>
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions?c=11" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<!--<div class="col-sm-3">
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
			</div>-->
			<div class="col-sm-4">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/ChronicHealth.png">
					<h3>Long Term Conditions</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=20"><span>Migraine</span></a></li>
                        <li><a href="<?php echo URL?>treatments/tdetail?c=70"><span>Irritable Bowel Syndrome</span></a></li>
					
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions?c=12" class="btn btn-danger btn-sm float-end">View All</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="treatments_box">
					<img class="icon_img" src="<?php echo URL?>images/TravelHealth.png">
					<h3>Travel Health</h3>
					<ul class="list_item_1">
						<li><a href="<?php echo URL?>treatments/tdetail?c=57"><span>Traveller's Diarrhoea</span></a></li>
						<li><a href="<?php echo URL?>treatments/tdetail?c=58"><span>Jet Lag</span></a></li> 
						
					</ul>
					<div class="mt-auto">
						<a href="<?php echo URL?>treatments/a-z-conditions?c=9" class="btn btn-danger btn-sm float-end">View All</a>
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
			  		$sqlFaqs="select * from tbl_faq where faq_status=1 and faq_display_on_home=1";
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
		<h2 class="title_h2 text-center">What our patients say<span>...</span></h2>
		<div class="owl-carousel-1 owl-carousel">
        
        <?php
			  		$sqlTesti="select * from tbl_testimonials where testimonial_status=1 order by testimonial_id desc";
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
<section class="our_latest">
	<div class="container wow fadeInUp" data-wow-delay="0.5s">
		<h2 class="title_h2 text-center">Check our latest blogs</h2>
		<div class="owl-carousel-3 owl-carousel">
        
      <?php 
						$sqlBlog="select * from tbl_blogs,tbl_blog_categories where categories_id=blog_categories and blog_status=1";
						if ($_GET['cat']!="")
						$sqlBlog.=" and blog_categories='".$database->filter($_GET['cat'])."'";
						$sqlBlog.=" order by id desc limit 0,6";
						$resBlog=$database->get_results($sqlBlog);
						if (count($resBlog)>0)
						{
							
							for ($j=0;$j<count($resBlog);$j++)
							{
								$rowBlog=$resBlog[$j];
								
									 ?>   
			<div class="item">
				<div class="article-list"> 
					<div class="at-thumbnail">
						<a href="<?php echo URL?>blogs/detail?bid=<?php echo $rowBlog['id']; ?>"><img src="<?php print URL;?>classes/timthumb.php?src=<?php echo URL?>images/blogs/<?php echo $rowBlog['blog_image']?>&w=380&h=220&zc=2"></a>
						<span class="blog-tag"> <?php echo $rowBlog['categories_name']; ?> </span>
					</div>
					<div class="article-content">
						<!--<img src="<?php echo URL?>images/user-4.jpg">-->
						<div class="artl-detail">
<h3><a href="#"><?php echo $rowBlog['blog_title']; ?></a></h3>
<p><?php echo fnUpdateHTML($rowBlog['short_description']); ?></p>
</div>
					</div>
					<div class="article-footer pb-0">
<ul>
<!--<li class="cl-lgrey2 pe-3">June 12, 2021</li>
<li><a href="#" class="cl-lgrey2">2 Comments</a></li>-->
</ul>
</div>
				</div>
			</div>
			
			<?php			 }
					}
			?>
	
			
			

		</div>
	</div>
</section>
<section class="our-company">
	<div class="container wow fadeInUp">
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


<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-center">
    <div class="modal-content">
       
      <div class="modal-body modal_body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       <iframe width="100%" height="450px" src="https://www.youtube.com/embed/DxIDKZHW3-E?start=1&autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>



      </div>
       
    </div>
  </div>
</div> -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">

      
      <div class="modal-body">
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
        </button>        
        <!-- 16:9 aspect ratio -->
<div class="ratio ratio-16x9" style="float: left;width: 100%">
  <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
</div>
        
        
      </div>

    </div>
  </div>
</div> 



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

// Declare a variable to store the video source
let videoSrc;

// Add click event listener to all elements with class "video-btn"
document.querySelectorAll('.video-btn').forEach(button => {
  button.addEventListener('click', () => {
    // Get the video source from the data-src attribute
    videoSrc = button.dataset.src;
    console.log(videoSrc);
  });
});

// Add event listener for when the modal is opened
document.getElementById('myModal').addEventListener('shown.bs.modal', () => {
  // Update the video source with autoplay and other options
  document.getElementById('video').src = videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0";
});

// Add event listener for when the modal is closed
document.getElementById('myModal').addEventListener('hide.bs.modal', () => {
  // Stop the video by resetting the source
  document.getElementById('video').src = videoSrc;
});
    
</script>
  
 