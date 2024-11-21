<?php include "../private/settings.php";
include PATH."include/headerhtml.php"
 ?>
  <body>
  	<?php include PATH."include/header.php"; ?> 
<section class="top_info">
	<div class="container">
		<div class="d-inline-flex w100p">
			<div>
			<h2 class="title_h2">We provide the following treatments</h2>
			<p>Select from the list below to view all medications</p>
</div>
<div class="ms-auto">
	<a href="<?php echo URL?>treatments/a-z-conditions" class="btn btn-danger btn-lg d-inline-flex align-items-center">View A-Z Conditions</a>
</div>
		</div>
	</div>
</section> 
<section class="a_z_treatment">
	<div class="container">
		<ul class="page_navi d-inline-flex">
        
        <?php
		$arrAlpha=array();
		 foreach (range('A', 'Z') as $alphabet)
	   		{
				
		$sqlMed="select med_id from tbl_medication where med_status=1 and med_title like '".$database->filter($alphabet)."%' order by med_title";
		$resMed=$database->get_results($sqlMed);
		$ctrMed=count($resMed);
		
		if ($ctrMed>0)
		array_push($arrAlpha,$alphabet);
		
		
				
		  ?>
        
			<li><a <?php if ($ctrMed>0) { ?>href="#<?php echo $alphabet; ?>-link" <?php } else { ?> style="background-color:#fff; color:#CCC" <?php } ?>><?php echo $alphabet; ?></a></li>
          <?php } ?>
			
		</ul>
        
         <?php
	  foreach ($arrAlpha as $alphabet)
	   {
		   
		//$sqlCondition="select condition_id from tbl_conditions where condition_status=1 and condition_title like '".$alphabet."%'";
		//$resConditions=$database->get_results($sqlCondition);
		  
		?>  
        
		<div class="title_with_line">
        <div id="<?php echo $alphabet; ?>-link" style="padding:15px"></div>
			<span><?php echo $alphabet; ?></span>
		</div>
		<div class="treatment_listing">
			<div class="row">
            
            <?php
		
		$sqlMed="select * from tbl_medication where med_status=1 and med_title like '".$database->filter($alphabet)."%'  order by med_title";
		$resMed=$database->get_results($sqlMed);
		
		if (count($resMed)>0)
		{
			for ($j=0;$j<count($resMed);$j++)
			{
				$rowMed=$resMed[$j];
				
				
				/*if ($rowConditions['condition_listing_icon']!="")
				$condImg=URL.'classes/timthumb.php?src='.URL.'images/condition/listing/'.$rowConditions['condition_listing_icon'].'&w=280&h=188&zc=2';
				else
				$condImg=URL."images/no-image-found.png";*/
				
		
		?>
            
				<div class="col-sm-4">
					<div class="treatment_listing_box" onClick="window.location='<?php echo URL?>treatments/medicine?m=<?php echo $rowMed['med_id']; ?>'">
						<div class="img_box">
							<img src="<?php echo URL?>images/medication/<?php echo $rowMed['med_image']; ?>" style="max-height:400px">
						</div>
						<h6><?php echo getConditionName($rowMed['med_conditions']) ?></h6>
						<h4><?php echo $rowMed['med_title']; ?></h4>
						<h5>From £<?php echo getMedicineFromPrice($rowMed['med_id']); ?></h5>
						<a href="<?php echo URL?>treatments/medicine?m=<?php echo $rowMed['med_id']; ?>" class="btn btn-primary d-inline-flex align-items-center justify-content-center">View Details</a>
					</div>
				</div>
				
		<?php }
		}?>
				
				
				
				
				
				
				
				
				

			</div>
		</div>	
        
        <?php }
		?>	
</div>
</section>
<section class="treating_section">
	<div class="container">
		<h4>Licensed medications provided by your local partner pharmacy</h4>
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