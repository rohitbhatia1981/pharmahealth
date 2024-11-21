<?php include "../private/settings.php";

$sqlPage="select * from tbl_pages where page_id='196'";
$resPage=$database->get_results($sqlPage);
$rowPages=$resPage[0];



include PATH."include/headerhtml.php"
 ?>
  <body>
  	<?php include PATH."include/header.php"; ?> 
<div class="about_screen">
<section class="breadcrumbs">
	<div class="container">
		<ul class="breadcrumbs_list">
			<li><a href="<?php echo URL?>">Home</a></li>
			<li><a href="#">Complaints & Feedback</a></li> 
		</ul>
	</div>
</section>
<section class="useful_screen">
	<div class="container">
		<div class="d-flex">
			<div class="left">
			  <h3 class="title_h3">Complaints &amp; Feedback</h3>
              <div style="height:20px"></div>
				<?php print $content=fnUpdateHTML($rowPages['page_description']); ?>
                
               <div style="height:20px"></div>
</div>
			
		</div>
	</div>
</section>

 


 

</div>



<?php include PATH."include/footer.php"; ?> 