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
	<!-- <div class="app-sidebar__logo">
		<a class="header-brand" href="index.html">
			<img src="../../assets/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="Dayonelogo">
			<img src="../../assets/images/brand/logo-white.png" class="header-brand-img dark-logo" alt="Dayonelogo">
			<img src="../../assets/images/brand/favicon.png" class="header-brand-img mobile-logo" alt="Dayonelogo">
			<img src="../../assets/images/brand/favicon1.png" class="header-brand-img darkmobile-logo" alt="Dayonelogo">
		</a>
	</div> -->
	<div class="app-sidebar3">
		<div class="app-sidebar__user">
			<div class="dropdown user-pro-body text-center">
				<div class="user-pic">
					<img src="<?php echo URL?>images/Pharmacy-health-final-logo.svg" alt="" >
                    
				</div>
                <div style="height:20px"></div>
				<div class="user-info">
					<h5 class=" mb-2" style="color:#000">Admin Dashboard</h5>
					
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

			<li class="slide <?php echo $class?>">
			<a class="side-menu__item"  data-toggle="slide" href="<?php echo URL?><?php echo FOLDER_ADMIN?>">
					<i class="feather  feather-star sidemenu_icon"></i>
					<span class="side-menu__label ">Overview</span>
				</a>
            </li>
            
            <?php
			$sqlDirect="SELECT * FROM tbl_components,tbl_rights_groups where tbl_rights_groups.rights_menu_id = tbl_components.component_id and tbl_rights_groups.rights_group_id = '".$_SESSION['groupid']."' and component_parentid=0 and tbl_rights_groups.rights_menu_id != 1 order by tbl_components.component_ordering ASC";
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
					<li  class="slide <?php echo $class; ?> "><a href="<?php echo URL?>admin/index.php?c=<?php echo $valueDirect['component_option']?>" class="side-menu__item">
					
                    <i class="<?php echo $valueDirect['component_small_image']?> sidemenu_icon"></i>
					<span class="side-menu__label">
					<?php echo $valueDirect['component_title']?> 
					
					<?php 
					
					// Support ticket
					if ($valueDirect['component_id']==248) { ?>
                     <?php 
						$sqlCtr="select count(message_id) as ctrTicket from tbl_tickets where message_parent=0 and message_replier_status=0 and message_close=0"; 
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
					
					
					
					if ($valueDirect['component_id']==198) { ?>
                     <?php 
						$sqlCtr="select count(message_id) as ctrTicket from tbl_messages where message_sent_to='Admin' and message_read_status=0"; 
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
                    
                    if ($valueDirect['component_id']==201) { ?>
                     <?php 
						$sqlCtr="select count(pr_id) as ctrReq from tbl_pharmacy_request where pr_status=0"; 
						$resCtr=$database->get_results($sqlCtr);
						$ctrReq=$resCtr[0]['ctrReq'];
						
					if ($ctrReq>0)
					{	
					
					?>
                    <span class="alert-number">
                   	<?php echo $ctrReq; ?>
                    </span> 
					<?php } 
					} ?>
                    
                    </span>
					</a>
				
				</li>

			<?php } ?>		
            
            
            
                    
			<?php

				

global $component,$database;



$sqlcat = "select * from tbl_component_categories order by category_ordering asc";

$resultscat = $database->get_results($sqlcat);

//$rowcat = $resultscat[0];

//print_r($rowcat);

$resultcat = $database->num_rows($sqlcat);



foreach ($resultscat as $valuecat ) 

{

	

	//echo $valuecat['category_id'];

	if($cidVal == $valuecat['category_id']){

				

			$class1 = 'active';
			$expanded="is-expanded";

			}else{

				$class1 = '';
				$expanded="";

			}



	

		$sql="SELECT * FROM tbl_components,tbl_rights_groups where tbl_rights_groups.rights_menu_id = tbl_components.component_id and tbl_rights_groups.rights_group_id = '".$_SESSION['groupid']."' and tbl_components.component_headingid='".$valuecat['category_id']."' and tbl_rights_groups.rights_menu_id != 1 order by tbl_components.component_title ASC";

		$results = $database->get_results($sql);

		$totalsubmenu = count($results);

?>					
			<li class="slide <?php echo $expanded?>">

	
				<a class="side-menu__item <?php //echo $class1; ?>" <?php if($totalsubmenu == 0 ){ echo 'style="display:none"';} ?>" data-toggle="slide" href="javascript:;">
					<i class="<?php echo $valuecat['category_icon_class']?> sidemenu_icon"></i>
					<span class="side-menu__label <?php //echo $class1; ?>"><?php echo $valuecat['category_name']?></span><i class="angle fa fa-angle-right"></i>
				</a>

	

				<ul class="slide-menu">

				<?php



							foreach ($results as $value ) {

								

								if($_GET['c'] == $value['component_option']){

									

								$class = 'active';

								}else{

									$class = '';

								}

						?>
					<li><a href="<?php echo URL?>admin/index.php?c=<?php echo $value['component_option']?>" class="slide-item <?php echo $class; ?>">
					
					<?php echo $value['component_title']?></a>
				
				
				</li>

			<?php } ?>		
					
			...............
			...............
			
		</ul>
		<?php } ?>		
		
	</div>
	
</div>
<!-- End Sidemenu -->