<?php include "../private/settings.php";
include PATH."include/headerhtml.php"
 ?>
  <body>
  	<?php include PATH."include/header.php"; ?> 
<section class="top_info">
	<div class="container">
		<div class="d-inline-flex w100p">
			<div>
			<h2 class="title_h2">We treat a variety of common acute & chronic conditions</h2>
			<p>Pharma Health treats a range of conditions through our online prescribing service. The service is safe, discreet and convenient <br>
and all medicines are dispensed by our local partner pharmacies</p>
</div>
<div class="ms-auto">
	<a href="<?php echo URL?>treatments/a-z-treatments" class="btn btn-danger btn-lg d-inline-flex align-items-center">View A-Z Treatments</a>
</div>
		</div>
	</div>
</section> 
<section class="a_z_treatment" >
	<div class="container">
		<ul class="page_navi d-inline-flex">
        
        <?php
		$arrAlpha=array();
		 foreach (range('A', 'Z') as $alphabet)
	   		{
				
		$sqlCondition="select condition_id from tbl_conditions where condition_status=1 and condition_title like '".$database->filter($alphabet)."%'";
		if ($_GET['c']!="")
		$sqlCondition.=" and condition_category='".$database->filter($_GET['c'])."'";
		
		$resConditions=$database->get_results($sqlCondition);
		$ctrCond=count($resConditions);
		
		if ($ctrCond>0)
		array_push($arrAlpha,$alphabet);
		
		
				
		  ?>
        
			<li><a <?php if ($ctrCond>0) { ?>href="#<?php echo $alphabet; ?>-link" <?php } else { ?> style="background-color:#fff; color:#CCC" <?php } ?>><?php echo $alphabet; ?></a></li>
          <?php } ?>
			
		</ul>
        
      
      <?php
	  foreach ($arrAlpha as $alphabet)
	   {
		   
		$sqlCondition="select condition_id from tbl_conditions where condition_status=1 and condition_title like '".$alphabet."%'";
		if ($_GET['c']!="")
		$sqlCondition.=" and condition_category='".$database->filter($_GET['c'])."'";
		
		$resConditions=$database->get_results($sqlCondition);
		  
		?>  
      
      	
		<div class="title_with_line">
        	<div id="<?php echo $alphabet; ?>-link" style="padding:15px"></div>
			<span ><?php echo $alphabet; ?></span>
		</div>
		<div class="figcaption_section">
		<div class="row">
        
        <?php
		
		$sqlCondition="select * from tbl_conditions where condition_status=1 and condition_title like '".$alphabet."%'";
		if ($_GET['c']!="")
		$sqlCondition.=" and condition_category='".$database->filter($_GET['c'])."'";
		
		$resConditions=$database->get_results($sqlCondition);
		
		if (count($resConditions)>0)
		{
			for ($j=0;$j<count($resConditions);$j++)
			{
				$rowConditions=$resConditions[$j];
				
				
				if ($rowConditions['condition_listing_icon']!="")
				$condImg=URL.'classes/timthumb.php?src='.URL.'images/condition/listing/'.$rowConditions['condition_listing_icon'].'&w=280&h=188&zc=2';
				else
				$condImg=URL."images/no-image-found.png";
				
		
		?>
        
        
        
			<div class="col-sm-3"> 
				<a href="<?php echo URL?>treatments/tdetail?c=<?php echo $rowConditions['condition_id']?>"><figure class="caption_treatment">
					<img src="<?php echo $condImg?>">
					<figcaption>
						<i class="fa-light fa-inhaler"></i>
						<h5><?php echo $rowConditions['condition_title']?></h5>
					</figcaption>
                   
				</figure>
                 </a>
			</div>
			
		<?php }
		}?>
		
			
		</div>
	</div>	
    
   <?php } ?> 
   
   
    
    
    
    
    
    
    
</div>
</section>
<section class="treating_section">
	<div class="container">
		<h4>Treating common, low risk medical conditions</h4>
		<p>Haven't bought from an Online Pharmacy yet? Buying medical treatments online with us is completely risk-free; and it's easier and cheaper than going to 
your local pharmacy. If you have trouble getting out of the house, or simply haven't got the time - you can easily buy popular medicines and remedies that 
are dispensed by our UK pharmacists.</p>
<p>Our new Online Pharmacy website stocks hundreds of popular tablets, capsules, creams and ointments to treat more than 60 common medical conditions. 
We sell branded drugs, as well as cheaper generic alternatives. Simply find the medicine you need, fill in a short health questionnaire and checkout; your 
treatment will be delivered to you as soon as the next working day. Alternatively, our qualified pharmacists can talk you through the key information on all 
drugs and medicines we stock by telephone or email . We regularly check our medicine prices against other online clinics to ensure that our customers get 
the best possible value. We're 100% committed to serving our customers with most effective medical treatments supported by the best service, at the right 
price. As well as buying medicines online, using our Online Prescription Service you can get NHS & private repeat prescriptions delivered to your door. We 
help take the hassle out of your regular repeat prescriptions.</p>
	</div>
</section>

 
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
 <?php include PATH."include/footer.php"; ?>