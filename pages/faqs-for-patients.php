 <?php include "../private/settings.php";
include PATH."include/headerhtml.php"
 ?>
  <body>
  	<?php include PATH."include/header.php"; ?> 
    <div style="height:40px"></div>
<section class="banner_1 d-inline-flex align-items-center" style="background-image: url(images/banner-2.jpg);" >
	<div class="container">
		<h3 class="title_h3">FAQs for Patients</h3>
	</div>
</section>

<section class="faqs faqs_screen" >
	<div class="container">
		<h2 class="title_h2 text-center">Frequently Asked <br> Questions <span>?</span></h2>
		<div class="row">
			<div class="col-sm-4">
				<!--<ul class="tabs_navi">
					<li class="active"><a href="#">How it works</a></li>
					<li><a href="#">Medications</a></li>
					<li><a href="#">Ordering</a></li>
					<li><a href="#">Payment</a></li>
					<li><a href="#">Partner Pharmacies</a></li>
					<li><a href="#">Complaints</a></li>
				</ul>-->
                
                
                <ul class="tabs_navi nav ">
                
                <?php 
					$sqlCategory="select * from tbl_faq_categories where faq_categories_status=1";
					$resCategory=$database->get_results($sqlCategory);
					if ($resCategory)
					for ($c=0;$c<count($resCategory);$c++)
					{
						$rowCategory=$resCategory[$c];
				 ?>
                
 					<li>
 						<a href="#" class="nav-link <?php if ($c==0) echo 'active'; ?>" id="description-tab" data-bs-toggle="pill" data-bs-target="#category<?php echo $rowCategory['faq_categories_id']?>" type="button" role="tab" aria-controls="category1" aria-selected="true">	<?php echo $rowCategory['faq_categories_name']?>
 						</a>
 					</li>
                    
                   <?php } ?>
 					
 				</ul>
                
			</div>
			<div class="col-sm-8">
            
             <div class="tab-content" id="v-pills-tabContent">
             
              <?php 
					$sqlFCategory="select * from tbl_faq_categories where faq_categories_status=1";
					$resFCategory=$database->get_results($sqlFCategory);
					if ($resFCategory)
					for ($r=0;$r<count($resFCategory);$r++)
					{
						$rowFCategory=$resFCategory[$r];
				 ?>
             
				  <div class="tab-pane fade show <?php if ($r==0) echo 'active'; ?>" id="category<?php echo $rowFCategory['faq_categories_id']?>" role="tabpanel" aria-labelledby="description-tab"> 
            
				<div class="accordion" id="accordionExample">
                
              
              <?php
			  		$sqlFaqs="select * from tbl_faq where faq_category='".$database->filter($rowFCategory['faq_categories_id'])."' and faq_status=1 ";
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
             
             <?php } 
			 
			 ?>
             
             
             
             
             
             
             
             
             
             
             
             
             
             
           </div>
                
                
                
			</div> 	
		</div>
	</div>
</section>

<section class="our-company">
	<div class="container">
		<ul class="owl-carousel-4 our_logos owl-carousel">
			<li class="item"><img src="images/logo_01.png"></li>
			<li class="item"><img src="images/logo_02.png"></li>
			<li class="item"><img src="images/logo_03.png"></li>
			<li class="item"><img src="images/logo_01.png"></li>
			<li class="item"><img src="images/logo_02.png"></li>
			<li class="item"><img src="images/logo_03.png"></li>
		</ul>
	</div>
</section>
<?php include PATH."include/footer.php"; ?> 