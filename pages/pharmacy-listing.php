<?php include "../private/settings.php";
include PATH."include/headerhtml.php";

if ($_GET['postcode']!="")
{
$postcode = $_GET['postcode'];   //AB10 1XG


$coordinates = getCoordinates($postcode);

if ($coordinates) {
    $latitude=$coordinates['latitude'];
    $longitude=$coordinates['longitude'];

$radius = 1; // Radius in miles


$nearbyPostcodes = findNearbyPostcodes($latitude,$longitude, $radius);

// Output nearby postcodes

if (count($nearbyPostcodes)>0)
$strPostcodes=implode(", ",$nearbyPostcodes);


}

}
if ($strPostcodes=="")
$strPostcodes=$_GET['postcode'];




 ?>
  <body>
  	<?php include PATH."include/header.php"; ?> 


<section class="list_banner" style="background-image: url(<?php echo URL?>/images/banner_0098.jpg);">
    <div class="container">
        <div class="search_box_top">
            <h3>Search Your Pharmacy</h3>
            <div class="form_box_1">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text"  class="form-control" name="pharmacy" placeholder="Search by Pharmacy Name" value="<?php echo $_GET['pharmacy']; ?>">
                    </div>   
                    <div class="col-sm-6">
                       <input type="text"  class="form-control" name="postcode" placeholder="Search by Postcode" value="<?php echo $_GET['postcode']; ?>">
                    </div> 
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="list_item_box">
    <div class="container">
        <div class="list_item_box_in">
        <h2 class="title_h2">List of Pharmacies</h2>
        
         <?php
		 
		/* if ($strPostcodes!="")
		 echo "Searched in Postcodes: ".$strPostcodes. "<br><br>";*/
		 
				$pagelimit = 12;
				$sqlPhar="select * from tbl_pharmacies where pharmacy_status=1";
				
				if ($_GET['pharmacy']!="")
				$sqlPhar.=" and pharmacy_name like '%".$database->filter($_GET['pharmacy'])."%'";
				
				if ($_GET['postcode']!="")
				{
				//$postcodeWithoutSpaces = str_replace(' ', '', $_GET['postcode']);
				//$sqlPhar.=" and REPLACE(pharmacy_postcode, ' ', '') = '".$postcodeWithoutSpaces."'";
				$sqlPhar.=" and FIND_IN_SET(REPLACE(pharmacy_postcode, ' ', ''), REPLACE('$strPostcodes', ' ', ''))";
				}
				
				
				
				$sqlPhar.=" order by pharmacy_name asc";
		   		$pagingObject->setMaxRecords($pagelimit); 
				$sqlPhar = $pagingObject->setQuery($sqlPhar);
				$resPhar = $database->get_results( $sqlPhar );
				$totalRecords = count($resPhar);
				if ($page != 1)    
				$srno = ($pagelimit * $page) - $pagelimit;
				else
				$srno = 0;
				
				if($totalRecords > 0)
				{
						for ($i = 0; $i < $totalRecords; $i++) 
							{
								$srno++;
								$rowPhar = $resPhar[$i];
					   

					   ?>
        
        <div class="list_item_grid">
            <h3><?php echo $rowPhar['pharmacy_name'] ?></h3>
            
            
           
            <?php if ($rowPhar['pharmacy_logo']!="") { ?>
						<div><img style="padding-top:20px; padding-bottom:20px" src="<?php echo URL; ?>classes/timthumb.php?src=<?php echo URL ?>images/pharmacies/<?php echo $rowPhar['pharmacy_logo']; ?>&w=120&zc=2"></div>
           			 <?php } ?>
                     
            <div class="row">
                <div class="col-sm-5">                    
                    <h5>
                    <?php
					$address=$rowPhar['pharmacy_address'];
					if ($rowPhar['pharmacy_address2']!="")
					$address.=", ".$rowPhar['pharmacy_address2'];
					$address.=", ".$rowPhar['pharmacy_postcode'];
					
					print $address;
					
					?>
                    
                    </h5>
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
                     
                </div>
                <div class="col-sm-4">
                   <!-- <h4 data-bs-toggle="collapse" data-bs-target="#multiCollapseExample<?php echo $rowPhar['pharmacy_id']?>" aria-expanded="false" aria-controls="multiCollapseExample2">Opening Timings: <i class="fa-regular fa-angle-down"></i></h4>
                  <ul class="timings_list collapse multi-collapse" id="multiCollapseExample<?php echo $rowPhar['pharmacy_id']?>">-->
                  
                  <?php
				  if ($rowPhar['pharmacy_p_opening']!="")
				  {
				  $arrWeek=unserialize(fnUpdateHTML($rowPhar['pharmacy_p_opening']));
				  ?>
															
                  <h4 >Opening Timings: </h4>
                  <ul style="color:rgb(136, 135, 135)">
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
                  <?php } ?>                    
                </div>
                <div class="col-sm-3">
                    <a href="<?php echo URL?>pages/pharmacy-detail?pid=<?php echo $rowPhar['pharmacy_id'] ?>" class="btn btn-primary btn-lg float-end d-inline-flex align-items-center" style="font-size:17px !important">View Detail</a>
                </div>
            </div>
        </div>
       
       <?php } 
				} else echo "No Pharmacies found";
				?>
        
        
        
        <div class="w100p text-center">
            <nav aria-label="Page navigation example">
            
            <?php $pagingObject->displayLinks_Front(); ?>
            
  <!--<ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>-->
</nav>
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