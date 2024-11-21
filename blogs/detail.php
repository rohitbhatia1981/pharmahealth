<?php include "../private/settings.php";

$sqlBlog="select * from tbl_blogs,tbl_blog_categories where categories_id=blog_categories and blog_status=1 and id='".$database->filter($_GET['bid'])."'";
$resBlog=$database->get_results($sqlBlog);
if ($resBlog)
$rowBlog=$resBlog[0];

$SEO_TITLE = $rowBlog['seo_metatitle'];
$SEO_DESCRIPTION = $rowBlog['seo_metadescription'];
$SEO_KEYWORDS = $rowBlog['seo_metakeywords'];



include PATH."include/headerhtml.php"
 ?>
  <body>
  	<?php include PATH."include/header.php"; ?> 
<div class="about_screen">
<section class="breadcrumbs">
	<div class="container">
		<ul class="breadcrumbs_list">
			<li><a href="<?php echo URL?>">Home</a></li>
			<li><a href="<?php echo URL?>blogs/listing">Blogs</a></li> 
            <li><a><?php echo $rowBlog['blog_title']; ?></a></li> 
		</ul>
	</div>
</section>
<section class="blog-section pt-100 lg-pt-80">
			<div class="container">
                <div class="border-bottom pb-160 xl-pb-130 lg-pb-80">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="blog-details-page pe-xxl-5 me-xxl-3">
                                <article class="blog-details-meta">
                                    <!--<div class="blog-pubish-date"><?php echo $rowBlog['categories_name']?> . By <strong><?php echo SITE_NAME ?></strong></div>-->
                                    <h2 class="blog-heading"><?php echo $rowBlog['blog_title']; ?></h2>
                                    <div class="img-meta mb-15"><img src="<?php print URL;?>classes/timthumb.php?src=<?php echo URL?>images/blogs/<?php echo $rowBlog['blog_image']?>&w=800&h=450&zc=1" alt="" ></div>
                                    
                                    <br><br>
                                    
                                    <?php echo fnUpdateHTML($rowBlog['blog_description']); ?>
                                    
                                </article>
                                <!-- /.blog-details-meta -->
                                
                                <!-- /.blog-comment-area -->
                                 <!-- /.blog-comment-form -->
                            </div>
                        </div>
    
                        <div class="col-lg-4">
							<div class="blog-sidebar ps-xl-4 md-mt-60">
								<!--<form action="#" class="search-form position-relative mb-50 lg-mb-40">
									<input type="text" placeholder="Search...">
									<button><i class="bi bi-search"></i></button>
								</form>-->
	
								<div class="category-list mb-60 lg-mb-40">
									<h3 class="sidebar-title">Category</h3>
									<ul class="style-none" >
                                    
                                     <?php
						$sqlCategories="select * from tbl_blog_categories where categories_status=1 ";
						$sqlCategories.=" order by categories_status asc";
						$resCategories=$database->get_results($sqlCategories);
						if (count($resCategories)>0)
						{ 
							
							for ($c=0;$c<count($resCategories);$c++)
							{
								$rowCategories=$resCategories[$c];
								$totalBlogInCat=getCountBlog($rowCategories['categories_id']);
								
								if ($totalBlogInCat>0) {
						?>
                                    
										<li><a style="color:#333; font-size:14px" href="<?php echo URL?>blogs/listing?cat=<?php echo $rowCategories['categories_id'] ?>"><?php echo $rowCategories['categories_name'] ?> (<?php echo $totalBlogInCat; ?>)</a></li>
                            <?php } }
						}
						?>
										
									</ul>
								</div>
                                <div style="height:10px"></div>
								<div class="sidebar-recent-news mb-60 lg-mb-40">
									<h4 class="sidebar-title">Recent Blogs</h4>
                                    
                                   <?php
									$BlogSide = "select * from tbl_blogs where blog_status=1 and id<>'".$database->filter($_GET['bid'])."' order by id desc limit 0,3";
									$resSide=$database->get_results($BlogSide);	
																	
									if (count($resSide)>0)
									{
										
										for ($k=0;$k<count($resSide);$k++)
										{						
										$BlogSide=$resSide[$k];
									?> 
                                    
									<div class="news-block d-flex align-items-center pt-20 pb-20 border-top">
										<div><img src="<?php print URL;?>classes/timthumb.php?src=<?php echo URL?>images/blogs/<?php echo $BlogSide['blog_image']?>&w=73&h=73&zc=1"></div>
										<div class="post ps-4">
											<h4 class="mb-5"><a style="color:#333; font-size:14px" href="<?php echo URL?>blogs/listing?bid=<?php echo $BlogSide['id']; ?>" class="title tran3s"><?php echo $BlogSide['blog_title']; ?></a></h4>
											<!--<div class="date">23 July, 2022</div>-->
										</div>
									</div>
                                    
                                    <?php }
									}?>
									
									
								</div>
								<!--<div class="sidebar-keyword">
									<h4 class="sidebar-title">Keywords</h4>
									<ul class="style-none d-flex flex-wrap">
										<li><a href="#">Ideas</a></li>
										<li><a href="#">Education</a></li>
										<li><a href="#">Design</a></li>
										<li><a href="#">Development</a></li>
										<li><a href="#">Branding</a></li>
									</ul>
								</div>-->
							</div>
							<!-- /.blog-sidebar -->
						</div>
                    </div>
                </div>
            </div>
		</section>

 


 

</div>



<?php include PATH."include/footer.php"; ?> 