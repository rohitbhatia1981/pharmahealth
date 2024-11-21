<?php include "../private/settings.php";

$sqlPhar="select * from tbl_pharmacies where pharmacy_id='".$database->filter($_GET['pid'])."'";
$resPhar=$database->get_results($sqlPhar);
$rowPhar=$resPhar[0];


include PATH."include/headerhtml.php"
 ?>
  <body>
  	<?php include PATH."include/header.php"; ?> 

 
<section class="list_item_box detail_page">
    <div class="container">
        <div class="list_item_box_in">
        <div class="top_heading">
            <h1><?php echo $rowPhar['pharmacy_name']?></h1>
           <!-- <h6>A Pharmadoctor partner clinic</h6>-->
        </div>
        <div class="detail_page_box">
        
         <?php if ($rowPhar['pharmacy_logo']!="") { ?>
				<div><img src="<?php echo URL; ?>classes/timthumb.php?src=<?php echo URL ?>images/pharmacies/<?php echo $rowPhar['pharmacy_logo']; ?>&w=120&zc=2"></div>
            <?php } ?>
        
        <?php if ($rowPhar['pharmacy_about_us']!="") { ?>
             <h3>About <?php echo $rowPhar['pharmacy_name']?></h3>
             <?php } ?>
            <div class="row">
                <div class="col-sm-8">
                   
                    <p style="text-align:justify"><?php echo $rowPhar['pharmacy_about_us']?></p>
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo URL?>patient/signup?p=<?php echo $rowPhar['pharmacy_id'] ?>" class="btn btn-danger btn-lg float-end d-inline-flex align-items-center justify-content-center">Register for Pharmacy Services</a>
                </div>
            </div>
            <div class="row bottom_data">
                <div class="col-sm-7">
                    <h4>Address:</h4>
                    <h6 style="line-height: normal;">
                    
                     <?php
					$address=$rowPhar['pharmacy_address'];
					if ($rowPhar['pharmacy_address2']!="")
					$address.="<br>".$rowPhar['pharmacy_address2'];
					
					print $address;
					
					?>
                    
                    </h6>

<h6>
    GPhC ID: <span><?php echo $rowPhar['pharmacy_p_gphc']; ?></span>
    <br>
    
     <ul class="contact_list">
                    
                    <?php if ($rowPhar['pharmacy_website']!="") { ?>
                        <li>
                            <i class="fa-regular fa-globe"></i>
                            <a href="<?php echo $rowPhar['pharmacy_website']; ?>"><?php echo $rowPhar['pharmacy_website']; ?></a>
                        </li>
                     <?php } ?>
                        <?php if ($rowPhar['pharmacy_p_landline']!="") { ?>
                        <li>
                            <i class="fa-solid fa-phone-volume"></i>
                            <?php echo $rowPhar['pharmacy_p_landline']; ?>
                        </li>
                        <?php } ?>
                    </ul>
</h6>
<div style="clear:both"></div>
<div style="height:27px"></div>
  <h4 >Opening Timings: </h4>
                  <ul class="timings_list" id="multiCollapseExample2">
                       <ul style="color:#666">
                     <?php
															$arrWeek=array();
															$arrTimings=array();
											
															if ($rowPhar['pharmacy_p_opening']!="")
															$arrWeek=unserialize(fnUpdateHTML($rowPhar['pharmacy_p_opening']));
															
															
															
															if ($rowPhar['pharmacy_p_timings']!="")
															$arrTimings=unserialize(fnUpdateHTML($rowPhar['pharmacy_p_timings']));
															//print_r ($arrTimings);
															
															if ($rowPhar['pharmacy_p_timings_closing']!="")
															$arrTimings2=unserialize(fnUpdateHTML($rowPhar['pharmacy_p_timings_closing']));
															//print_r ($arrTimings2);
															
															
															$mydays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday');
															$strDisplay="<table width='100%'>";
															
															foreach ($arrWeek as $val)
															{
																$strDisplay.="<tr><td>".$mydays[$val-1]."</td>";
																$strDisplay.="<td>:</td>";
																//echo $arrTimings[$val];
																
																$strDisplay.="<td>".date('h:i a', strtotime($arrTimings[$val]));
																$strDisplay.=" - ";
																$strDisplay.=date('h:i a', strtotime($arrTimings2[$val]));
																
																
																$strDisplay.="</td></tr>";
																
															}
															print $strDisplay.="</table>";
															
															?>
                  </ul>
                  </ul>
                </div>
                <div class="col-sm-4">
                    <div class="embed-responsive embed-responsive-16by9">
                        <?php if ($rowPhar['pharmacy_map']!="") echo fnUpdateHTML($rowPhar['pharmacy_map']); ?>
                    </div>
                </div>
            </div>
        </div>
        
         
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