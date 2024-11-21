<?php include "../private/settings.php";

$sqlPage="select * from tbl_pages where page_id='198'";
$resPage=$database->get_results($sqlPage);
$rowPages=$resPage[0];

include PATH."include/headerhtml.php"
 ?>
  <body>
  	 	<?php include PATH."include/header.php"; ?> 
<section class="breadcrumbs">
	<div class="container">
		<ul class="breadcrumbs_list">
			<li><a href="<?php echo URL?>">Home</a></li>
			<li><a href="#"><?php echo $rowPages['page_title']?></a></li> 
		</ul>
	</div>
</section>
<section class="useful_screen">
	<div class="container">
		<div class="d-flex">
			<div class="left">
				<h3 class="title_h3"><?php echo $rowPages['page_title']?></h3>
				
                
                <?php print $content=fnUpdateHTML($rowPages['page_description']); ?>
			</div>
			<div class="right">
				<img src="<?php echo URL?>images/use_link_img.png">
			</div>
		</div>
	</div>
</section>  

<!--<section class="our-company">
	<div class="container">
		<ul class="owl-carousel-4 our_logos owl-carousel">
			<li class="item"><img src="images/logo_01.png"></li>
			<li class="item"><img src="images/logo_02.png"></li>
			<li class="item"><img src="images/logo_03.png"></li>
			<li class="item"><img src="images/logo_01.png"></li>
			<li class="item"><img src="images/logo_02.png"></li>
			<li class="item"><img src="images/logo_03.png"></li>
		</ul>
	</div>
</section>-->
<?php include PATH."include/footer.php"; ?> 