<!-- header top url start -->
<?php include("header_top.php");?>
<!-- header top url end -->
<?php 
session_start();
if(isset($_SESSION['ADMIN_LOGIN'])&&$_SESSION['ADMIN_LOGIN']=='yes'){?>
<?php $comp_id=$_SESSION['COMPANY_ID'];
$admin_id=$_SESSION['ADMIN_ID'];
$role=$_SESSION['ROLE'];
$company_name=$_SESSION['COMPANY_NAME'];
$new_admin_name=$_SESSION['SLUG_ADMIN_NAME'];

    $won_leads=0;
    $a='';
    $pending_leads=0;
    $cat_res=mysqli_query($con,"select * from offer_clicks where user_id='$admin_id'");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
       $cat_arr[]=$row;    
    }
    foreach($cat_arr as $list){
    $won_leads++;
        $a=$list['id'];
    }
     
    $cat_res=mysqli_query($con,"select * from offer_clicks where user_id='$admin_id' group by offer_id");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
        $cat_arr[]=$row;    
    }
    foreach($cat_arr as $list){
      $pending_leads++;
    }
         
        ?>
<body class="g-sidenav-show  bg-gray-100 ">
    <!-- side nemu bar start -->
    <?php include("side_menu.php");?>
    <!-- side menu bar end -->
    <main class="main-content max-height-vh-100 h-100 position-relative border-radius-lg">
        <!-- Navbar -->
        <?php include("header.php");?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">

            <div class="row">
        <!-- BEGIN col-6 -->
        <div class="col-xl-6">
          <!-- BEGIN card -->
          <div class="card text-white-transparent-7 mb-3 overflow-hidden">
            <!-- BEGIN card-img-overlay -->
            <div class="card-img-overlay d-block d-lg-none bg-blue rounded"></div>
            <!-- END card-img-overlay -->
            
            <!-- BEGIN card-img-overlay -->
            <div class="card-img-overlay d-none d-md-block bg-blue rounded" style="background-image: url(https://reapbucks.com/userpanel/assets/img/wave-bg.png); background-position: right bottom; background-repeat: no-repeat; background-size: 100%;"></div>
            <!-- END card-img-overlay -->
            
            <!-- BEGIN card-img-overlay -->
            <div class="card-img-overlay d-none d-md-block bottom-0 top-auto">
              <div class="row">
                <div class="col-md-8 col-xl-6"></div>
                <div class="col-md-4 col-xl-6 mb-n2">
                  <img src="https://reapbucks.com/userpanel/assets/img/dashboard.svg" alt="" class="d-block ml-n3 mb-5" style="max-height: 310px">
                </div>
              </div>
            </div>
            <!-- END card-img-overlay -->
            
            <!-- BEGIN card-body -->
            <div class="card-body position-relative">
              <!-- BEGIN row -->
              <div class="row">
                <!-- BEGIN col-8 -->
                <div class="col-md-8">
                  <!-- stat-top -->
                  <div class="d-flex">
                    <div class="mr-auto">
                      <h5 class="text-white-transparent-8 mb-3">Total Earnings</h5>
                      <h3 class="text-white mt-n1 mb-1">0</h3>
                      <p class="mb-1 text-white-transparent-6 text-truncate">
                        <i class="fa fa-caret-up"></i> <b>₹ <?php echo $total_dollar;?></b>
                      </p>
                    </div>
                  </div>
                  
                  <hr class="hr-transparent bg-white-transparent-2 mt-3 mb-3">
                  
                  <!-- stat-bottom -->
                  <div class="row">
                    <div class="col-6 col-lg-5">
                      <div class="mt-1">
                        <i class="fa fa-fw fa-shopping-bag fs-28px text-black-transparent-5"></i>
                      </div>
                      <div class="mt-1">
                        <div>Store Earnings</div>
                        <div class="font-weight-600 text-white">₹ <?php echo $total_dollar;?></div>
                      </div>
                    </div>
                    
                  </div>
                  
                  <hr class="hr-transparent bg-white-transparent-2 mt-3 mb-3">
                  
                  <div class="mt-3 mb-2">
                    <a href="https://reapbucks.com/userpanel/my_earnings" class="btn btn-yellow btn-rounded btn-sm pl-5 pr-5 pt-2 pb-2 fs-14px font-weight-600"><i class="fa fa-wallet mr-2 ml-n2"></i>Go To Store Earnings</a>
                  </div>
                  <p class="fs-12px">
                    It Takes You To The Store Earnings Section.
                  </p>
                </div>
                <!-- END col-8 -->
                
                <!-- BEGIN col-4 -->
                <div class="col-md-4 d-none d-md-block" style="min-height: 380px;"></div>
                <!-- END col-4 -->
              </div>
              <!-- END row -->
            </div>
            <!-- END card-body -->
          </div>
          <!-- END card -->
        </div>
        <!-- END col-6 -->
        
        <!-- BEGIN col-6 -->
        <div class="col-xl-6">
          <!-- BEGIN row -->
          <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-sm-6">
              <!-- BEGIN card -->
              <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-orange" style="min-height: 202px;">
                <!-- BEGIN card-img-overlay -->
                <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
                  <img src="https://reapbucks.com/userpanel/assets/img/order.svg" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px">
                </div>
                <!-- END card-img-overlay -->
                
                <!-- BEGIN card-body -->
                <div class="card-body position-relative">
                  <h5 class="text-white-transparent-8 mb-3 fs-16px">Total Offers</h5>
                  <h3 class="text-white mt-n1"><?php echo $pending_leads;?></h3>
                  <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
                        <div class="progrss-bar progress-bar-striped bg-white" style="width:<?php echo $pending_leads;?>%"></div>
                    </div>
                  <div><div class="text-white-transparent-8 mb-4">   <i class="fa fa-caret-up"></i><?php echo $pending_leads;?> %   increase</div>
                      </div>
                </div>
                <!-- BEGIN card-body -->
              </div>
              <!-- END card -->
              
              <!-- BEGIN card -->
              <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-teal" style="min-height: 202px;">
                <!-- BEGIN card-img-overlay -->
                <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
                  <img src="https://reapbucks.com/userpanel/assets/img/visitor.svg" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px">
                </div>
                <!-- END card-img-overlay -->
                
                <!-- BEGIN card-body -->
                <div class="card-body position-relative">
                  <h5 class="text-white-transparent-8 mb-3 fs-16px">Cancelled Payment</h5>
                  <h3 class="text-white mt-n1">0</h3>
                  <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
                                       <div class="progrss-bar progress-bar-striped bg-white" style="width:0%"></div>
                                      </div>
                  <div><div class="text-white-transparent-8 mb-4">   <i class="fa fa-caret-up"></i>0 %   increase<br>compare to last week</div></div>
                </div>
                <!-- END card-body -->
              </div>
              <!-- END card -->
            </div>
            <!-- END col-6 -->
            
            <!-- BEGIN col-6 -->
            <div class="col-sm-6">
              <!-- BEGIN card -->
              <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-pink" style="min-height: 202px;">
                <!-- BEGIN card-img-overlay -->
                <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
                  <img src="https://reapbucks.com/userpanel/assets/img/email.svg" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px">
                </div>
                <!-- END card-img-overlay -->
                
                <!-- BEGIN card-body -->
                <div class="card-body position-relative">
                  <h5 class="text-white-transparent-8 mb-3 fs-16px">Pending Payment</h5>
                  <h3 class="text-white mt-n1">0</h3>
                  <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
                                       <div class="progrss-bar progress-bar-striped bg-white" style="width:0%"></div>
                                      </div>
                
                  <div><div class="text-white-transparent-8 mb-4">   <i class="fa fa-caret-up"></i>0 %   increase<br>compare to last week</div></div>
                </div>
                <!-- END card-body -->
              </div>
              <!-- END card -->
              
              <!-- BEGIN card -->
              <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-indigo" style="min-height: 202px;">
                <!-- BEGIN card-img-overlay -->
                <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
                  <img src="https://reapbucks.com/userpanel/assets/img/browser.svg" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px">
                </div>
                <!-- end card-img-overlay -->
                
                <!-- BEGIN card-body -->
                <div class="card-body position-relative">
                  <h5 class="text-white-transparent-8 mb-3 fs-16px">Completed Payment</h5>
                  <h3 class="text-white mt-n1">0</h3>
                  <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
                                         <div class="progrss-bar progress-bar-striped bg-red" style="width:-30.77%"></div>
                                       </div>
                  <div><div class="text-white-transparent-8 mb-4">  <i class="fa fa-caret-down"></i>-30.77 %   decrease <br>compare to last week</div></div>
                </div>
                <!-- END card-body -->
              </div>
              <!-- END card -->
            </div>
            <!-- BEGIN col-6 -->
          </div>
          <!-- END row -->
        </div>
        <!-- END col-6 -->

          
         
      </div>
             <!-- footer start -->
                 <?php include("footer.php");?>
              <!-- footer start -->
        </div>
    </main>
    <div>
    </div>

    <!-- footer url start -->
    <?php include("footer_url.php");?>
    <!-- footer url end -->
    
     <?php }else{
        header('location:https://reapbucks.com/userpanel/auth-login');
        }
        ?>