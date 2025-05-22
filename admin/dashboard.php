<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->
 <?php
    $total_offers=0;
    $cat_res=mysqli_query($con,"select * from offers");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
      $cat_arr[]=$row;    
    }
     foreach($cat_arr as $list){
      $total_offers++;
     }
        $total_clicks=0;
    $cat_res=mysqli_query($con,"select * from offer_clicks");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
      $cat_arr[]=$row;    
    }
     foreach($cat_arr as $list){
      $total_clicks++;
     }
       $total_users=0;
    $cat_res=mysqli_query($con,"select * from users");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
      $cat_arr[]=$row;    
    }
     foreach($cat_arr as $list){
      $total_users++;
     }
         $total_lost_leads=0;
    $cat_res=mysqli_query($con,"select * from leads");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
      $cat_arr[]=$row;    
    }
     foreach($cat_arr as $list){
      $total_lost_leads++;
     }
         $total_pending_leads=0;
    $cat_res=mysqli_query($con,"select * from pages");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
      $cat_arr[]=$row;    
    }
     foreach($cat_arr as $list){
      $total_pending_leads++;
     }

?>
<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->
        <div class="content">
            <div class="container-xl">
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   Reap Bucks S Admin According change settings!
                </div>

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Dashboard
                            </h2>
                        </div>
                        <!-- Page title actions -->
                         <?php if (has_module_access_insert($con, 'send_push_message')): ?>
                            <div class="col-auto ml-auto d-print-none">
                                <span class="d-none ml-3 d-sm-inline">
                                    <a href="pushmsg.php" class="btn btn-primary">Send Message</a>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row row-deck row-cards">
                    <?php if($_SESSION['EMP_ACCESS']=='multiple_access'){ ?>
                        <div class="col-sm-6 col-lg-3">
                            <a href="https://reapbucks.com/admin/custom.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader text-primary">Total Offers</div>
                                        <div class="ml-auto lh-1 text-muted">Last 30 days</div>
                                    </div>
                                    <div class="h1 mb-3"><?php echo $total_offers;?></div>
                                    <div id="chart-active-users" class="chart-sm"></div>
                                </div>
                            </div>
                            </a>
                        </div>
                    
                        <div class="col-sm-6 col-lg-3">
                            <a href="https://reapbucks.com/admin/clickspoint.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader text-warning">Total Clicks</div>
                                        <div class="ml-auto lh-1 text-muted">Last 30 days</div>
                                    </div>
                                    <div class="h1 mb-3"><?php echo $total_clicks;?></div>
                                    <div id="chart-leads-bg" class="chart-sm"></div>
                                </div>
                            </div>
                            </a>
                        </div>
                    
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader text-success">Earnings (USD)</div>
                                        <div class="ml-auto lh-1 text-muted">Last 30 days</div>
                                    </div>
                                    <div class="h1 mb-3">$0</div>
                                    <div id="chart-revenue-bg" class="chart-sm"></div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-sm-6 col-lg-3">
                            <a href="https://reapbucks.com/admin/members.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader text-danger">Total Users</div>
                                        <div class="ml-auto lh-1 text-muted">Last 30 days</div>
                                    </div>
                                    <div class="h1 mb-3"><?php echo $total_users;?></div>
                                    <div id="chart-withdrawn-bg" class="chart-sm"></div>
                                </div>
                            </div>
                            </a>
                        </div>
                    <?php
                    }elseif ($_SESSION['EMP_ACCESS']=='single') {?>
                        <?php if (has_module_access($con, 'custom_offerwall')): ?>
                            <div class="col-sm-6 col-lg-4">
                                <a href="https://reapbucks.com/admin/custom.php">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader text-primary">Total Offers</div>
                                            <div class="ml-auto lh-1 text-muted">Last 30 days</div>
                                        </div>
                                        <div class="h1 mb-3"><?php echo $total_offers;?></div>
                                        <div id="chart-active-users" class="chart-sm"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    
                       <?php if (has_module_access($con, 'withdrawal_activity')): ?>
                            <div class="col-sm-6 col-lg-4">
                                <a href="https://reapbucks.com/admin/clickspoint.php">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader text-warning">Total Clicks</div>
                                            <div class="ml-auto lh-1 text-muted">Last 30 days</div>
                                        </div>
                                        <div class="h1 mb-3"><?php echo $total_clicks;?></div>
                                        <div id="chart-leads-bg" class="chart-sm"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                       <?php endif; ?>
                    
                         <?php if (has_module_access($con, 'users_directory')): ?>
                            <div class="col-sm-6 col-lg-4">
                                <a href="https://reapbucks.com/admin/members.php">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader text-danger">Total Users</div>
                                            <div class="ml-auto lh-1 text-muted">Last 30 days</div>
                                        </div>
                                        <div class="h1 mb-3"><?php echo $total_users;?></div>
                                        <div id="chart-withdrawn-bg" class="chart-sm"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                         <?php endif; ?>
                    <?php } ?>
                     
                </div>
                      <div class="row row-deck row-cards">
                          <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Latest leads</h4>
                            </div>
                            <table class="table card-table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Network</th>
                                        <th>Amount</th>
                                        <th>Date / Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a
                                                href="members/info?userid=G273712887787">G273712887787</a>
                                        </td>
                                        <td>Ironsrc</td>
                                        <td>$0.001</td>
                                        <td>2025-02-21 11:34:32</td>
                                    </tr>
                                    <tr>
                                        <td><a
                                                href="members/info?userid=5EC8C27BB275B">5EC8C27BB275B</a>
                                        </td>
                                        <td>video</td>
                                        <td>$0.014</td>
                                        <td>2022-11-08 18:01:09</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                         <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Top countries</h3>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <div class="embed-responsive-item">
                                        <div id="map-world" class="w-100 h-100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     </div>
            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->