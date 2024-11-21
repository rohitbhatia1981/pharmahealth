<?php include "../private/settings.php";





include PATH."include/headerhtml.php"
 ?>
  <body>
  	<?php include PATH."include/header.php"; ?> 
<div class="treatment_page regulations_page">
<section class="breadcrumbs pb-0">
	<div class="container">
		<ul class="breadcrumbs_list">
			<li><a href="#">Home</a></li> 
			<li>Regulations</li>   
		</ul>
	</div>
</section> 
<section class="banner_01">
	<div class="container ">
		<div class="row align-items-center"> 
			<div class="col-sm-8 right">
				<h2 class="title_h2">Regulations</h2> 
				<p>Promoting access to safe and effective digital healthcare is our primary aim at The Independent Pharmacy.</p>
				<p>We want to ensure we are offering the highest standards of care and UK-approved and licensed treatments 
to our patients. To ensure this, we comply with the highest possible standards in the regulation of online 
pharmacy in the UK.</p> 
			</div>
			<div class="col-sm-4">
			 
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
 						<a href="#" class="nav-link active" id="description-tab" data-bs-toggle="pill" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">	CQC
 						</a>
 					</li>
 					<li>
 						<a href="#" class="nav-link" id="directions-tab" data-bs-toggle="pill" data-bs-target="#directions" type="button" role="tab" aria-controls="directions" aria-selected="false">GMC</a>
 					</li>
 					<li>
 						<a href="#" class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#gphc" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">GPhC</a>
 					</li>
 					
 					 
 				</ul>
 				 
 			</div>
 			<div class="col-sm-8">
 				 <div class="tab-content" id="v-pills-tabContent">
				  <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab"> 
				  	<img src="images/care_logo1.png" class="mb-4">
				  	
                    
                    <?php 
					$sqlPage="select * from tbl_pages where page_id='201'";
					$resPage=$database->get_results($sqlPage);
					$rowPages=$resPage[0];
					
					print $content=fnUpdateHTML($rowPages['page_description']); ?>
                    
				  </div>
				  <div class="tab-pane fade" id="directions" role="tabpanel" aria-labelledby="directions-tab">
				  	
                    <?php
					$sqlPage="select * from tbl_pages where page_id='207'";
					$resPage=$database->get_results($sqlPage);
					$rowPages=$resPage[0];
					print $content=fnUpdateHTML($rowPages['page_description']);
					?>
				  	
				  </div>
                  
                  
                  <div class="tab-pane fade" id="gphc" role="tabpanel" aria-labelledby="directions-tab">
				  	
                     <?php
					$sqlPage="select * from tbl_pages where page_id='208'";
					$resPage=$database->get_results($sqlPage);
					$rowPages=$resPage[0];
					print $content=fnUpdateHTML($rowPages['page_description']);
					?>
				  	
                  </div>
                  
                  
 			</div>
 		</div>
 	</div>
 </section> 
 
 </div>



<?php include PATH."include/footer.php"; ?> 