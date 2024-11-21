<?php include "../../private/settings.php";
include PATH."patient/checksession.php";
include PATH."include/headerhtml.php";
 ?>
  <body style="padding-top:0px;">  
    <div class="header_2">
       <a href="#"><img src="<?php echo URL?>images/logo.png"></a>
   </div>
 <section class="medication-questionaire">
     <div class="container">
         <h1>Medical Assessment</h1>
        
        
        <?php include "include/step-navigation.php"; ?>
        
        <?php //print_r ($_SESSION['sessCart']); ?>
        
        
         <h3 class="title_3 mt-5 mb-4">Disclaimer</h3>
         </div>
         <div class="setup_white_box">
         
         
         <?php
		 $sqlPage="select * from tbl_pages where page_id='206'";
		 $resPage=$database->get_results($sqlPage);
		 $rowPages=$resPage[0];
		 $strDisclaimer=fnUpdateHTML($rowPages['page_description']);
?>
         
         
            <?php /*$strDisclaimer='<table><tr><td><p>Please ensure you read and understand the following information prior to completing the medical 
assessment. The consultation should not take longer than 3-5 minutes to complete.</p>
<p>It is important that you answer all the questions correctly and honestly to allow the Pharma Health 
clinical team to assess your needs and ensure the treatment is safe and effective for you. </p>
<p>The information you provide us is treated with the utmost confidentiality & will be reviewed by a UK 
registered pharmacist prescriber. The questions listed in this medical assessment will help provide 
the pharmacist prescriber with an appropriate level of information to make an informed decision on 
whether the treatment is suitable for your condition.</p>
<p>&nbsp;</p></td></tr></table>'; */
?>
<?php /*$strDisclaimer.='<table><tr><td><p><strong>Confirmation</strong> <br>
  <strong>By clicking &ldquo;Continue&rdquo;, you are confirming that you:</strong> </p>
<p><br>
  <strong>General</strong></p>
<ul>
  <li>Are 18 years old or above. </li>
  <li>Are completing this questionnaire for yourself and to the best of  your knowledge.</li>
  <li>Understand that any treatment prescribed for you is for your  personal use only.</li>
  <li>Will disclose any serious illnesses or operations you have had.<br>
 
  <li>Will disclose any medications (including prescription and  non-prescription medications) you currently take.<br>
  </li>
  <li>Are happy for us to contact you if we have any queries about your  condition.<br>
  </li>
  <li>Agree to follow any additional advice given by the Pharma Health  clinical team.<br>
  </li>
  <li>Have read, understood and agreed to our Terms &amp; Conditions,  Privacy Notice and Terms of Sale.&nbsp; </li>
</ul>
<p><strong>&nbsp;</strong></p></td></tr></table>'; */?>

<?php 
		 $sqlCondition="select * from tbl_conditions where condition_id='".$database->filter($_SESSION['sessCondition'])."'";
		$resCondition=$database->get_results($sqlCondition);
		
		$rowCondition=$resCondition[0];
		$disclaimer=str_replace("\n","</li>",$rowCondition['condition_disclaimer_content']);
		$disclaimer=str_replace("-","<li>",$disclaimer);

echo $strDisclaimer;


 ?>

<?php if ($disclaimer!="")
{
	?>

<p><strong> Specific</strong></p>

<?php 
echo $disclaimer="<ul>".$disclaimer."</ul>";
$strDisclaimer.=$disclaimer; ?>


<?php }

$_SESSION['sessDisclaimer']=$strDisclaimer;
 ?>
<div class="w100p text-center">
  <button class="btn btn-danger btn-lg d-inline-flex align-items-center mt-4 mb-4" onClick="window.location='step2'">Continue</button>
</div> 
<p class="w100p text-center">By clicking “Continue”, you are confirming that you have read and understood the disclaimer </p>
         </div>
     </div>
 </section>

<?php include PATH."include/footer-simple.php"; ?>
