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

			

			<img src="<?php echo URL?>images/logo.png" class="header-brand-img dark-logo" alt="Pharma Health">

			<img src="<?php echo URL?>images/heart-logo.png" class="header-brand-img mobile-logo" alt="Pharma Health">

			

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

                	<span style="color:#42559F; font-weight:bold; font-size:16px"><?php echo ucfirst($_SESSION['sess_prescriber_name']) ?></span> <br />

					<span style="color:#000; font-size:13px">Clinician Account</span>

					

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

			<a class="side-menu__item"  data-toggle="slide" href="<?php echo URL?><?php echo PRESCRIBER_ADMIN?>">

					<i class="feather  feather-star sidemenu_icon"></i>

					<span class="side-menu__label ">Overview</span>

				</a>

            </li>-->

            

            <?php

			$sqlDirect="SELECT * FROM tbl_components,tbl_rights_groups where tbl_rights_groups.rights_menu_id = tbl_components.component_id and tbl_rights_groups.rights_group_id = '".$_SESSION['sess_prescriber_groupid']."' and component_parentid=0 and tbl_rights_groups.rights_menu_id != 1 and component_id<>266 order by tbl_components.component_ordering ASC";
		

			$resultsDirect = $database->get_results($sqlDirect);

			$totalDirect = count($resultsDirect);

			

			?>

            

            <?php

				

				foreach ($resultsDirect as $valueDirect ) {

				

				

					if($_GET['c'] == $valueDirect['component_option']){
						
					if ($valueDirect['component_option']!="pres-edit-profile" || ($valueDirect['component_option']=="pres-edit-profile" && $_GET['mode']==""))
					$class = 'is-expanded';

					}else{

					$class = '';

					}


					

					?>

					<li  class="slide <?php echo $class; ?> "><a href="<?php echo URL?><?php echo PRESCRIBER_ADMIN?>index.php?c=<?php echo $valueDirect['component_option']?>" class="side-menu__item">

					
<!--<i class="feather feather-clipboard sidemenu_icon"></i>-->
                    <i class="<?php echo $valueDirect['component_small_image']?> sidemenu_icon"></i>

					<span class="side-menu__label">

					<?php echo $valueDirect['component_title']?>
                    
                     <?php if ($valueDirect['component_id']==250) {
						
						$sqlCtr="select count(message_id) as ctrTicket from tbl_tickets where message_sender_id='".$database->filter($_SESSION['sess_prescriber_id'])."' and message_parent=0 and message_sender_type='Clinician' and message_replier_status=1"; 
						$resCtr=$database->get_results($sqlCtr);
						$ctrTicket=$resCtr[0]['ctrTicket'];
						
							if ($ctrTicket>0)
					{	
					
					?>
                    
                    
                     <span class="alert-number">
                   	<?php echo $ctrTicket; ?>
                    </span> 
                    
                    <?php }
					}?>
                    
                    
                   
                    
                     <?php 
					 
					 //--------Cancellation request counter
					 
					 if ($valueDirect['component_id']==251) {
						
						$sqlCtr="select count(pr_id) as ctrTicket from tbl_pres_cancel_request where pr_status='0'"; 
						$resCtr=$database->get_results($sqlCtr);
						$ctrTicket=$resCtr[0]['ctrTicket'];
						
							if ($ctrTicket>0)
					{	
					
					?>
                    
                    
                     <span class="alert-number">
                   	<?php echo $ctrTicket; ?>
                    </span> 
                    
                    <?php }
					}?>
                    
                   
                    
                    
                    <?php 
					//--------order message
					
					
					
					if ($valueDirect['component_id']==235) { ?>
                     <?php 
						 $sqlCtr="select count(message_id) as ctrTicket from tbl_messages,tbl_prescriptions where pres_id=message_pres_id and message_sent_to='Clinician'  and message_read_status=0"; 
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
					
                    
                    <?php 
					//--------order message
					
					
					
					if ($valueDirect['component_id']==266) { ?>
                     <?php 
					 
					
						$sqlCtr="select count(follow_up_id) as ctrFollow from tbl_follow_ups where follow_up_date<='".date("Y-m-d")."' and follow_up_active=1"; 
						$resCtr=$database->get_results($sqlCtr);
						$ctrF=$resCtr[0]['ctrFollow'];
						
					if ($ctrF>0)
					{	
					
					?>
                    <span class="alert-number">
                   	<?php echo $ctrF; ?>
                    </span> 
					<?php } 
					} ?>

                    
                    

                    </span>

					</a>

				

				</li>



			<?php } ?>	
            
            <?php
			if ($valueDirect['component_option']=="pres-edit-profile" && $_GET['mode']=="edit")
			$class = 'is-expanded';
			else
			$class='';
			?>	

   <li  class="slide <?php echo $class; ?> ">        
	<i class="feather feather-lock sidemenu_icon"></i>
      <span class="side-menu__label">Change Password</span>
   </li>      

            

                    

			

		

	</div>

	

</div>

<!-- End Sidemenu -->