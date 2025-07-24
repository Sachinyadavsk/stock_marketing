<?php
    $cat_res=mysqli_query($con,"select sum(balance) as total_points from users where id='$admin_id'");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
      $cat_arr[]=$row;    
    }
     foreach($cat_arr as $list){
      $total_points=$list['total_points']; 
     } 
     $total_dollar=$total_points;
?>

<?php
    $cat_resre=mysqli_query($con,"select sum(points) as total_points from my_earnings where user_id='$admin_id' and referral_status='1'");
    $cat_arrre=array();
    while($rowre=mysqli_fetch_assoc($cat_resre)){
      $cat_arrre[]=$rowre;    
    }
     foreach($cat_arrre as $listre){
      $total_points_rewards=$listre['total_points']; 
     } 
     $total_rewards=$total_points_rewards;
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
                          <li class="nav-item d-flex align-items-center">
                              <a href="https://reapbucks.com/userpanel/wallet"
                              <span class="badge badge-label-light" style="color: #f8f9fa;background: #317871;margin: 3px;">₹<?php echo $total_dollar;?></span>
                               </a>
                              </li>
                          <li class="nav-item d-flex align-items-center">
                            <a href="https://reapbucks.com/userpanel/settings"
                                class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Profile</span>
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
                <span class="text-center" style="color: green !important;display: block;margin-top: 18px;">
                    <?php 
                        date_default_timezone_set('Asia/Kolkata');
                        $today = date('Y-m-d');
                        $posts_s = mysqli_query($con, "SELECT * FROM withdrawal WHERE status = 'success' AND DATE(created_at) = '$today' ORDER BY id DESC LIMIT 1");
                        $row_s = mysqli_fetch_assoc($posts_s);
                        
                        if (!empty($row_s)) {
                            $amount = $row_s['amount'];
                            $method = $row_s['method'];
                            $user_id = $row_s['user_id'];
                            $time = date('h:i A', strtotime($row_s['created_at']));
                            
                            echo "Wihdrawal of <strong>₹{$amount}</strong> via <strong>{$method}</strong> was successfully processed at <strong>{$time}</strong> today.";
                        } 
                    ?>
               </span>