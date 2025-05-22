<?php
    $cat_res=mysqli_query($con,"select sum(points) as total_points from my_earnings where user_id='$admin_id'");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
      $cat_arr[]=$row;    
    }
     foreach($cat_arr as $list){
      $total_points=$list['total_points']; 
     } 
     $total_dollar=$total_points/100;
?>

<nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky"
            id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
               
                <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">


                    <ul class="navbar-nav  justify-content-end">
                          <li class="nav-item d-flex align-items-center mobileviews"><img src="assets/img/favicon.png" class="navbar-brand-img h-100" alt="main_logo"></li>
                          <li class="nav-item d-flex align-items-center"><?php echo $_SESSION['ADMIN_NAME'];?></li>
                          <li class="nav-item d-flex align-items-center"><span class="badge badge-label-light fs-6" style="color: #cb0c9f;">$ <?php echo $total_dollar;?></span></li>
                          <li class="nav-item d-flex align-items-center">
                            <a href="https://reapbucks.com/userpanel/auth-false"
                                class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Sign Out</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>