<?php

if ($_GET['c']!="")

{
	
	

	$sqlCid="select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

	$resCid=$database->get_results($sqlCid);

	if (count($resCid)>0)

	{

		$rowCid=$resCid[0];

		$cidVal=$rowCid['component_headingid'];

		

	

	}

}

?>

<style>
.alert-number {
  background-color: red; /* Red background color */
  color: white; /* Text color on the alert number */
  padding: 2px 4px; /* Adjust padding as needed */
  border-radius: 50%; /* Makes it a circular shape */
  font-weight: bold; /* Bold text for the number */
  font-size:12px;
}

</style>

<!--aside open-->

<aside class="app-sidebar">

	<div class="app-sidebar__logo">

		<a class="header-brand" href="#">

			

			<img src="<?php echo URL?>images/Pharmacy-health-final-logo.svg" class="header-brand-img dark-logo" alt="">

			<img src="<?php echo URL?>images/heart-logo.png" class="header-brand-img mobile-logo" alt="">

			

		</a>

	</div>

	<div style="height:50px"></div>
	<div class="app-sidebar3">

		<div class="app-sidebar__user">

			<div class="dropdown user-pro-body text-center">

				<!--<div class="user-pic">

					<img src="<?php echo URL?>images/how-it-work-2.png" style="max-width:70%" alt="" >

                    

				</div>-->

                <div style="height:60px"></div>

				<div class="user-info">

                	<span style="color:#42559F; font-weight:bold; font-size:16px"><?php echo ucfirst($_SESSION['sess_pharmacy_name']) ?></span> <br />

					<span style="color:#000; font-size:13px">Pharmacy Account</span>

					

				</div>

			</div>

		</div>





		<ul class="side-menu">

        

        <?php

		if($_GET['c'] == ""){

					$class = 'is-expanded';

					}else{

					$class = '';

					}

		?>



			<!--<li class="slide <?php echo $class?>">

			<a class="side-menu__item"  data-toggle="slide" href="<?php echo URL?><?php echo PHARMACY_ADMIN?>">

					<i class="feather  feather-star sidemenu_icon"></i>

					<span class="side-menu__label ">Overview</span>

				</a>

            </li>-->

            

            <?php

			$sqlDirect="SELECT * FROM tbl_components,tbl_rights_groups where tbl_rights_groups.rights_menu_id = tbl_components.component_id and tbl_rights_groups.rights_group_id = '".$_SESSION['sess_pharmacy_groupid']."' and component_parentid=0 and tbl_rights_groups.rights_menu_id != 1 order by tbl_components.component_ordering ASC";
		

			$resultsDirect = $database->get_results($sqlDirect);

			$totalDirect = count($resultsDirect);

			

			?>

            

            <?php

				

				foreach ($resultsDirect as $valueDirect ) {

				

				

					if($_GET['c'] == $valueDirect['component_option']){

					$class = 'is-expanded';

					}else{

					$class = '';

					}



					?>

					<li  class="slide <?php echo $class; ?> "><a href="<?php echo URL?><?php echo PHARMACY_ADMIN?>index.php?c=<?php echo $valueDirect['component_option']?>" class="side-menu__item">

					
<!--<i class="feather feather-clipboard sidemenu_icon"></i>-->
                    <i class="<?php echo $valueDirect['component_small_image']?> sidemenu_icon"></i>

					<span class="side-menu__label">

					<?php echo $valueDirect['component_title'];
					
					?>
                    
                   
                    
                    <?php if ($valueDirect['component_id']==247) {
						
						$sqlCtr="select count(message_id) as ctrTicket from tbl_tickets where message_sender_id='".$database->filter($_SESSION['sess_pharmacy_id'])."' and message_parent=0 and message_sender_type='Pharmacy' and message_replier_status=1"; 
						$resCtr=$database->get_results($sqlCtr);
						$ctrTicket=$resCtr[0]['ctrTicket'];
						
							if ($ctrTicket>0)
					{	
					
					?>
                    
                    
                     <span class="alert-number">
                   	<?php echo $ctrTicket; ?>
                    </span> 
                    
                    <?php }
					}
                    
                   if ($valueDirect['component_id']==245) { ?>
                     <?php 
						$sqlCtr="select count(message_id) as ctrTicket from tbl_messages where message_sent_to='Pharmacy' and message_read_status=0"; 
						$resCtr=$database->get_results($sqlCtr);
						$ctrTicket=$resCtr[0]['ctrTicket'];
						
					if ($ctrTicket>0)
					{	
					
					?>
                    <span class="alert-number">
                   	<?php echo $ctrTicket; ?>
                    </span> 
					<?php } 
					} ?>
                    </span>

					</a>

				

				</li>



			<?php } ?>		

            

            

            

                    

			

		

	</div>

	

</div>

<!-- End Sidemenu -->