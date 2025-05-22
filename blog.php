 <?php 	if($_REQUEST['blog']!=''){
                 $id=$_REQUEST['blog'];
                          

             }	else{
               header("location:https://reapbucks.com/");
             }
?>
            <?php require('connection.php');?>
             <?php                                                                                                               
								
                $cat_res4=mysqli_query($con,"select * from blogs where url='$id' and status='1'");
                $cat_arr4=array();
                while($row4=mysqli_fetch_assoc($cat_res4)){
                  $cat_arr4[]=$row4;    
                }
                 foreach($cat_arr4 as $list){
                  $title=$list['title'];
                  $keywords=$list['keywords'];
                  $descriptions=$list['descriptions'];
                  $img=$list['image1'];
                 }
                ?>
<?php require('header.php');?>

 <?php                                                                                                               
								
                $cat_res4=mysqli_query($con,"select * from blogs where url='$id' and status='1'");
                $cat_arr4=array();
                while($row4=mysqli_fetch_assoc($cat_res4)){
                  $cat_arr4[]=$row4;    
                }
                 foreach($cat_arr4 as $list){
                  $title=$list['title'];
                  $category=$list['category'];
                  $date=$list['datee'];
                  $image1=$list['image1'];
                  $description=$list['description'];
                 }
                ?>
			<!-- SINGLE POST
			============================================= -->
			<section id="single-post" class="pb-90 inner-page-hero blog-page-section">
				<div class="container">
				 	<div class="row justify-content-center">	


				 		<!-- SINGLE POST CONTENT -->
				 		<div class="col-xl-10">
				 			<div class="post-content">


						 		<!--  SINGLE POST TITLE -->
				 				<div class="single-post-title text-center">

				 					<!-- Title -->
					 				<h2 class="s-46 w-700"><?php echo $title;?></h2>

					 				<!-- Post Meta -->
									<div class="blog-post-meta mt-35">
										<ul class="post-meta-list ico-10">
											<li><p class="p-md w-500">By <?php echo $list['added_by'];?></p></li>
											<li class="meta-list-divider"><p><span class="flaticon-minus"></span></p></li>
											<li><p class="p-md"><?php echo $date;?></p></li>
										</ul>
									</div>

								</div>	<!-- END SINGLE POST TITLE -->


								<!-- SINGLE POST IMAGE -->
					 			<div class="blog-post-img py-50">
									<img class="img-fluid r-16" src="<?php echo 'https://reapbucks.com/images/blog/'.$image1;?>" alt="blog-post-image">	
								</div>


								<!-- SINGLE POST TEXT -->
								<div class="single-post-txt">

									<!-- Text -->
									<p><?php echo $description;?>
									</p>

								</div>	<!-- END SINGLE POST TEXT -->

							</div>
						</div>	<!-- END  SINGLE POST CONTENT -->


				 	</div>    <!-- End row -->
				</div>    <!-- End container -->
			</section>	<!-- END SINGLE POST -->




			<!-- BLOG-1
			============================================= -->
			<section id="blog-1" class="bg--white-300 py-10 blog-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row justify-content-center">	
						<div class="col-md-10 col-lg-9">
							<div class="section-title mb-70">	

								<!-- Title -->	
								<h2 class="s-50 w-700">Keep Reading...</h2>	

								<!-- Text -->	
								<p class="s-21 color--grey">Ligula risus auctor tempus magna feugiat lacinia.</p>
									
							</div>	
						</div>
					</div>


					<div class="row">
           <?php                                                                                                               
								
                $cat_res4=mysqli_query($con,"select LEFT(description, 150) AS LongField_First20chars, LEFT(title,150) AS ttl,url,image1,added_by,datee from blogs where status='1' order by id desc limit 3");
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
				 	</div>    <!-- End row -->
				 </div>    <!-- End container -->
			</section>	<!-- END BLOG-1 -->
<?php require('footer2.php');?>