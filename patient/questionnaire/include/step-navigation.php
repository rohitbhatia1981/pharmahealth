
 <div class="text-center">
         <ul class="setup_nav">
             <li <?php if ($frontPageName=="step1.php") { ?>class="active" <?php } ?>><a href="#">Disclaimer</a></li>
             <li <?php if ($frontPageName=="step2.php") { ?>class="active" <?php } ?>><a href="#">About You</a></li>
             <li <?php if ($frontPageName=="step3.php") { ?>class="active" <?php } ?>><a href="#">Symptoms</a></li>
             <li <?php if ($frontPageName=="step4.php") { ?>class="active" <?php } ?>><a href="#">Your Medical History</a></li>
             <li <?php if ($frontPageName=="step5.php") { ?>class="active" <?php } ?>><a href="#">Your Medication History </a></li>
             <li <?php if ($frontPageName=="step6.php") { ?>class="active" <?php } ?>><a href="#">Agreement</a></li>
         </ul></div>
         <div class="text-center w100p">
         <div class="progress_bar">
             <span>Progress</span>
             
             <?php
			 if ($frontPageName=="step1.php")
			 $progress="10";
			 else if ($frontPageName=="step2.php")
			 $progress="25";
			  else if ($frontPageName=="step3.php")
			 $progress="55";
			  else if ($frontPageName=="step4.php")
			 $progress="65";
			   else if ($frontPageName=="step5.php")
			 $progress="80";
			   else if ($frontPageName=="step6.php")
			 $progress="100";
			 
			 
			 ?>
             
             <div class="progress_box">
                 <div style="width: <?php echo $progress; ?>%;"></div>
             </div>
             <span><?php echo $progress; ?>%</span>
         </div>