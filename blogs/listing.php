<?php include "../private/settings.php";




include PATH."include/headerhtml.php"
 ?>
  <body>
  	<?php include PATH."include/header.php"; ?> 
<div class="about_screen">
<section class="breadcrumbs">
	<div class="container">
		<ul class="breadcrumbs_list">
			<li><a href="<?php echo URL?>">Home</a></li>
			<li><a href="#">Blogs</a></li> 
		</ul>
	</div>
</section>
<section class="useful_screen">
	<div class="container">
		<h2 class="title_h2 text-center">Our Blogs</h2>
        <div style="height:20px"></div>
			
		<div class="row">
        
      <?php 
						$sqlBlog="select * from tbl_blogs,tbl_blog_categories where categories_id=blog_categories and blog_status=1";
						if ($_GET['cat']!="")
						$sqlBlog.=" and blog_categories='".$database->filter($_GET['cat'])."'";
						$sqlBlog.=" order by id desc ";
						$resBlog=$database->get_results($sqlBlog);
						if (count($resBlog)>0)
						{
							
							for ($j=0;$j<count($resBlog);$j++)
							{
								$rowBlog=$resBlog[$j];
								
									 ?>   
		
			<div class="col-sm-4">
				<div class="article-list"> 
					<div class="at-thumbnail">
						<a href="<?php echo URL?>blogs/detail?bid=<?php echo $rowBlog['id']; ?>"><img src="<?php print URL;?>classes/timthumb.php?src=<?php echo URL?>images/blogs/<?php echo $rowBlog['blog_image']?>&w=480&h=220&zc=2"></a>
						<span class="blog-tag"> <?php echo $rowBlog['categories_name']; ?> </span>
					</div>
					<div class="article-content">
						<!--<img src="<?php echo URL?>images/user-4.jpg">-->
						<div class="artl-detail">
<h3><a href="<?php echo URL?>blogs/detail?bid=<?php echo $rowBlog['id']; ?>"><?php echo $rowBlog['blog_title']; ?></a></h3>
<p><?php echo fnUpdateHTML($rowBlog['short_description']); ?></p>
</div>
					</div>
					<div class="article-footer pb-0">
<ul>
<!--<li class="cl-lgrey2 pe-3">June 12, 2021</li>
<li><a href="#" class="cl-lgrey2">2 Comments</a></li>-->
</ul>
</div>
				</div>
			</div>
			
			<?php			 }
					}
			?>
	
			
			
		</div>
		
	</div>
</section>

 


 

</div>



<?php include PATH."include/footer.php"; ?> 