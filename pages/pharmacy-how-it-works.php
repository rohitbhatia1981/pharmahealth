<?php include "../private/settings.php";
include PATH."include/headerhtml.php"
 ?>
  <body>
  	<?php include PATH."include/header.php"; ?> 
<section class="breadcrumbs">
	<div class="container">
		<ul class="breadcrumbs_list">
			<li><a href="#">Home</a></li>
			<li><a href="#">How it works</a></li>
			<li>Patient</li> 
		</ul>
	</div>
</section>
  
<section class="simple_video text-center">
	<div class="container">
		<h2 class="title_h2">How it works? - For Pharmacy</h2>
		<div class="video_box pt-3">
			<img src="<?php echo URL?>images/video_img.png">
		</div>
	</div>
</section>

<section class="how_to_works">
	<div class="container">
		<div class="how_to_works_one d-flex">
			<div class="left">
				<h3 class="title_h3">Patient Referral</h3>
			  <p>The  patient visits a partner pharmacy to request a treatment for a medical  condition that usually requires a prescription from their regular GP. The  pharmacist or the pharmacy staff will direct the patient to our clinical  service, which is accessed via our Pharma Health website.</p>
				<p>				  The  pharmacy staff will be required to check that the condition is covered by our  service; then advise the patient of the treatment options available and inform  the patient of the medication price range.<br>
				  The  patient will be required to undergo the following process:</p>
				<p>Sign up as a patient on the Pharma Health website </p>
				<ol style="color:#666">
                  <li>Select a condition and/or treatment</li>
                  <li>Complete online medical  assessment form </li>
                  <li>Make payment online</li>
              </ol>
			</div>
			<div class="center">
				<h5>STEP</h5>
				<h2>1</h2>
			</div>
			<div class="right text-center">	
				<img src="<?php echo URL?>images/patient-pharmacy.png" style="max-height:300px">
			</div>
		</div>
		<div class="how_to_works_one d-flex">
			<div class="left order-3">
				<h3 class="title_h3">Online Medical Assessment Form </h3>
				<p>The  patient will be required to complete an online medical assessment form to  explain their symptoms and provide their medical history. The assessment should  not take longer than 5 minutes to complete; and in some cases, may require the  support of the pharmacy staff to assist with completing the assessment form. </p>
</div>
			<div class="center order-2">
				<h5>STEP</h5>
				<h2>2</h2>
			</div>
			<div class="right text-center order-1">	
				<img src="<?php echo URL?>images/how-it-work-1.png">
			</div>
		</div>
		<div class="how_to_works_one d-flex">
			<div class="left">
				<h3 class="title_h3">Review by Clinical Team & Issuing of Electronic Prescription</h3>
				<p>Our  clinical team, which consists of pharmacist prescribers, will review the  completed online medical assessment form, and action the medication request  based on the clinical suitability and effectiveness of the treatment. This will  either result in approving or rejecting the medication request by the  pharmacist prescriber. In the case of it being approved, the pharmacist  prescriber will sign off the electronic private prescription, which will arrive  at the partner pharmacy portal, ready to be printed and dispensed. </p>
				<p>			    A  prescription request that is rejected outright by the pharmacist prescriber  (not a frequent occurrence) will usually be followed with an email explaining  the clinical reasoning. There will be occasions where the clinical team may  wish to speak to the patient directly (via telephone or our website messaging  system) when further medical information is required before making a clinical  decision. </p>
          </div>
			<div class="center">
				<h5>STEP</h5>
				<h2>3</h2>
			</div>
			<div class="right text-center">	
				<img src="<?php echo URL?>images/how-it-work-2.png">
			</div>
		</div>
        
        <div class="how_to_works_one d-flex">
		  <div class="left order-3">
			<h3 class="title_h3">Medication Dispensed by Pharmacy </h3>
			  <p>The  dispensing staff will print the electronic private prescription from the  pharmacy portal. They will then dispense the medication as per their normal  dispensing protocol. Once the medication is ready for collection, the pharmacy  staff will be required to click the &lsquo;dispensed&rsquo; button on the pharmacy portal.  This will result in an automatic email being sent to the patient informing them  to collect their medication.</p>
</div>
			<div class="center order-2">
				<h5>STEP</h5>
				<h2>4</h2>
			</div>
			<div class="right text-center order-1">	
				<img src="<?php echo URL?>images/how-it-work-3.png">
			</div>
		</div>
        
        
		<div class="w100p text-center">
			<button class="btn btn-danger btn-lg d-inline-flex align-items-center ps-5 pe-5">Sign up with Pharma Health</button>
		</div>
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
