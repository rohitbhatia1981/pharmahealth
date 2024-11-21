<nav class="navbar navbar-expand-lg navbar-light top-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo URL?>"><img src="<?php echo URL?>images/Pharmacy-health-final-logo.svg"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?php if ($frontPageName=="index.php") echo 'active'; ?>" aria-current="page" href="<?php echo URL?>">Patients</a>
        </li>
        <li class="nav-item"><a class="nav-link <?php if ($frontPageName=="pharmacy.php") echo 'active'; ?>" href="<?php echo URL?>pharmacy-be-our-partner">Pharmacy</a></li>
      
        <li class="nav-item"><a href="#" class="nav-link dropdown-toggle">Treatments</a>
            <ul class="dropdown-menu dropdown-menu-1">
            
             <?php 
					$sqlTreatCat="select * from tbl_condition_categories where condition_categories_status=1 order by condition_categories_order desc ";
					$resTreatCat=$database->get_results($sqlTreatCat);
					
					if (count($resTreatCat)>0)
					{
						for ($j=0;$j<count($resTreatCat);$j++)
						{
							
							$rowTreatCat=$resTreatCat[$j];			
				 ?>
             <li>
                 <a href="#" class="dropdown-item"><?php echo $rowTreatCat['condition_categories_name']?></a>
                 <ul class="dropdown-menu">
                 
                 <?php 
								$sqlTreatMenu="select * from tbl_conditions where FIND_IN_SET('".$rowTreatCat['condition_categories_id']."',condition_category) and condition_status=1 order by condition_id asc ";
								$resTreatMenu=$database->get_results($sqlTreatMenu);
								if (count($resTreatMenu)>0)
								{
									
									//if (count($resTreatMenu)>5)
									//$countToLoop=5;
									//else
									$countToLoop=count($resTreatMenu);
									
									for ($k=0;$k<$countToLoop;$k++)
									{
										$rowTreatMenu=$resTreatMenu[$k];
							
							 ?>
                        <li><a class="dropdown-item" href="<?php echo URL?>treatments/tdetail?c=<?php echo $rowTreatMenu['condition_id']?>"><?php echo $rowTreatMenu['condition_title']?></a></li>
                     <?php }
								}
								?>
                        
                </ul>
             </li>
             
             <?php }
					}?>
             

            </ul>

        </li>
        <li class="nav-item dropdown how_it_dropdown">
        	<a class="nav-link dropdown-toggle <?php if ($frontPageName=="patient-how-it-works.php" || $frontPageName=="pharmacy-how-it-works.php") echo 'active'; ?>" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">How it works</a>
        	<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    			<li><a class="dropdown-item" href="<?php echo URL?>patient-how-it-works">For Patient</a></li>
    			<li><a class="dropdown-item" href="<?php echo URL?>pharmacies-how-it-works">For Pharmacy</a></li>
			</ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="<?php echo URL?>about-us">About Us</a></li>
         <li class="nav-item dropdown how_it_dropdown">
        	<a class="nav-link dropdown-toggle <?php if ($frontPageName=="faqs-for-patients.php" || $frontPageName=="faqs-for-pharmacies.php") echo 'active'; ?>" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">FAQs</a>
        	<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    			<li><a class="dropdown-item" href="<?php echo URL?>faqs-for-patients">For Patient</a></li>
    			<li><a class="dropdown-item" href="<?php echo URL?>faqs-for-pharmacies">For Pharmacy</a></li>
			</ul>
        </li>
        <li class="nav-item"><a class="nav-link <?php if ($frontPageName=="contact-us.php") echo "active"; ?>" href="<?php echo URL?>contact-us">Contact Us</a></li>
      
      
      <?php 
	  
	  if ($_SESSION['sess_patient_id']!="" && $_SESSION['sess_patient_groupid']==4) { ?>
       
        <li class="nav-item login_btn2"><a class="nav-link" href="<?php echo URL?>patient/account">My Account</a></li>        
       <?php } else { ?>
       
       <?php if ($frontPageName=="pharmacy.php") { ?>
       
        <li class="nav-item login_link ms-5"><a class="nav-link" href="<?php echo URL?>pharmacy/account/">Login</a></li>
        <li class="nav-item login_btn"><a class="nav-link" href="<?php echo URL?>pharmacy/signup">Sign Up </a></li>        
       
       <?php } else { ?>
        <li class="nav-item login_link ms-5"><a class="nav-link" href="<?php echo URL?>patient/login">Login</a></li>
        <li class="nav-item login_btn"><a class="nav-link" href="<?php echo URL?>patient/signup">Sign Up </a></li>        
       <?php }
	   }
	    ?>
        
      </ul>
       
    </div>
  </div>
</nav>