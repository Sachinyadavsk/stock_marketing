<?php require('header.php');?>
<?php require('connection.php');?>
			<!-- BLOG POSTS LISTING
			============================================= -->
			<section id="blog-page" class="pb-60 inner-page-hero blog-page-section">
				<div class="container">



				 	<!-- POSTS WRAPPER -->
					<div class="posts-wrapper">
						<div class="row">

           <?php                                                                                                               
								
                $cat_res4=mysqli_query($con,"select LEFT(description, 150) AS LongField_First20chars, LEFT(title,150) AS ttl,url,image1,added_by,datee from blogs where status='1' order by id desc");
                $cat_arr4=array();
                while($row4=mysqli_fetch_assoc($cat_res4)){
                  $cat_arr4[]=$row4;    
                }
                 foreach($cat_arr4 as $list){
                    ?>
							<!-- BLOG POST #1 -->
					 		<div class="col-md-6 col-lg-4">
					 			<div class="blog-post mb-40 wow fadeInUp clearfix">	


					 				<!-- BLOG POST IMAGE -->
					 				<div class="blog-post-img mb-35">
					 				    <a href="single-post.html">
										<img class="img-fluid r-16" src="https://reapbucks.com/images/blog/<?php echo $list['image1'];?>" alt="blog-post-image">
										</a>
									</div>	


									<!-- BLOG POST TEXT -->
									<div class="blog-post-txt">

										<!-- Post Link -->
										<h6 class="s-20 w-700">
											<a href="single-post.html"><?php echo $list['ttl'];?>
											</a>
										</h6>

										<!-- Text -->
										<p><?php echo $list['LongField_First20chars'];?>
										</p>

										<!-- Post Meta -->
										<div class="blog-post-meta mt-20">
											<ul class="post-meta-list ico-10">
												<li><p class="p-sm w-500">By <?php echo $list['added_by'];?></p></li>
												<li class="meta-list-divider"><p><span class="flaticon-minus"></span></p></li>
												<li><p class="p-sm"><?php echo $list['datee'];?></p></li>
											</ul>
										</div>

									</div>	<!-- END BLOG POST TEXT -->


					 			</div>
					 		</div>	<!-- END BLOG POST #1 -->
            <?php }?>
            <h3>Coming Soon</h3>
						</div>
					</div>	<!-- END POSTS WRAPPER -->


					

				</div>	   <!-- End container -->	
			</section>	<!-- END BLOG POSTS LISTING -->




			<!-- PAGE PAGINATION
			============================================= -->
			<!--<div class="pb-100 page-pagination theme-pagination">-->
			<!--	<div class="container">-->
			<!--		<div class="row">	-->
			<!--			<div class="col-md-12">-->
			<!--				<nav aria-label="Page navigation">-->
			<!--					<ul class="pagination ico-20 justify-content-center">-->
			<!--				    	<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span class="flaticon-back"></span></a>-->
			<!--				    	</li>-->
			<!--					    <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>-->
			<!--					    <li class="page-item"><a class="page-link" href="#">2</a></li>-->
			<!--					    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
			<!--					    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span class="flaticon-next"></span></a></li>-->
			<!--					</ul>-->
			<!--				</nav>-->
			<!--			</div>-->
			<!--		</div> 	-->
			<!--	</div> -->
			<!--</div>-->




			<!-- DIVIDER LINE -->
<?php require('footer2.php');?>