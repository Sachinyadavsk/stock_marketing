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
     
     $total_earnings = 0;
    $cat_res = mysqli_query($con, "SELECT * FROM my_earnings");
    while ($row = mysqli_fetch_assoc($cat_res)) {
        $total_earnings += $row['points']; // or 'points'
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
                            <a href="https://reapbucks.com/admin/earnings.php">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader text-success">Earnings (USD)</div>
                                            <div class="ml-auto lh-1 text-muted">Last 30 days</div>
                                        </div>
                                        <div class="h1 mb-3">$<?php echo $total_earnings;?></div>
                                        <div id="chart-revenue-bg" class="chart-sm"></div>
                                    </div>
                                </div>
                             </a>
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
                                <h4 class="card-title">Latest leads &nbsp;<span style="float:right">(<?php echo $total_lost_leads;?>)</span></h4>
                            </div>
                               <?php
                                  $cat_res = mysqli_query($con, "SELECT * FROM leads ORDER BY id DESC LIMIT 6");
                                    $cat_arr = array();
                                    while ($row = mysqli_fetch_assoc($cat_res)) {
                                        $cat_arr[] = $row;
                                    }
                                ?>
                            <table class="table card-table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Offer Category</th>
                                        <th>Offer Name</th>
                                        <th>Amount</th>
                                        <th>Date / Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cat_arr as $list){ ?>
                                    <tr>
                                        <td><a
                                                href="https://reapbucks.com/admin/members-info.php?userid=<?php echo $list['user_id']; ?>">Rb<?php echo $list['user_id']; ?></a>
                                        </td>
                                        <td><?php echo $list['offer_category']; ?></td>
                                        <td><?php echo $list['offer_name']; ?></td>
                                        <td>
                                           ₹ <?php
                                                if($list['offer_points']=='0'){ ?>
                                                   <span style="color:green;font-weight:600px">Hold</span>
                                               <?php }else{ echo $total_dollar=$list['offer_points']; } ?>
                                        </td>
                                        <td><?php echo $list['timestamp']; ?></td>
                                    </tr>
                                   <?php } ?>
                                </tbody>
                            </table>
                            <span style="color:blue;padding:10px"><a href="https://reapbucks.com/admin/leads">More Leads</a></span>
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
                      <div class="row row-deck row-cards">
                          <div class="col-lg-12">
                               <div class="card">
                                <div class="card-header">
                                 <h4 class="card-title">Click Offer List —  <h4>
                                </div>
                           <div class="card-body card-block text-center p-3">
                            <?php
                            // Get filters from GET
                            $device_filter = $_GET['device'] ?? '';
                            $os_filter = $_GET['os'] ?? '';
                            $from_date = $_GET['from_date'] ?? '';
                            $to_date = $_GET['to_date'] ?? '';
                            
                            $country_filter = $_GET['country'] ?? '';
                            
                            // Pagination setup
                            $limit = 10;
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $start_from = ($page - 1) * $limit;
                            
                            // Filter WHERE clause
                            $where = "WHERE 1";
                            if (!empty($device_filter)) {
                                $where .= " AND user_device = '" . mysqli_real_escape_string($con, $device_filter) . "'";
                            }
                            if (!empty($os_filter)) {
                                $where .= " AND user_os = '" . mysqli_real_escape_string($con, $os_filter) . "'";
                            }
                            if (!empty($from_date)) {
                                $where .= " AND STR_TO_DATE(timestamp, '%d/%m/%Y %H:%i:%s') >= STR_TO_DATE('" . mysqli_real_escape_string($con, $from_date) . "', '%Y-%m-%d')";
                            }
                            if (!empty($to_date)) {
                                $where .= " AND STR_TO_DATE(timestamp, '%d/%m/%Y %H:%i:%s') <= STR_TO_DATE('" . mysqli_real_escape_string($con, $to_date) . "', '%Y-%m-%d')";
                            }
                            
                            if (!empty($country_filter)) {
                                $where .= " AND user_country = '" . mysqli_real_escape_string($con, $country_filter) . "'";
                            }
                            
                            
                           $countries_query = mysqli_query($con, "SELECT sortname, name FROM countries ORDER BY name ASC");
                            
                            // Fetch filtered data
                            $query = "SELECT * FROM offer_clicks $where ORDER BY id DESC LIMIT $start_from, $limit";
                            $cat_res = mysqli_query($con, $query);
                            
                            // Count total for pagination
                            $count_query = "SELECT COUNT(*) AS total FROM offer_clicks $where";
                            $result = mysqli_query($con, $count_query);
                            $row = mysqli_fetch_assoc($result);
                            $total_records = $row['total'];
                            $total_pages = ceil($total_records / $limit);
                            ?>
                            
                            <!-- FILTER FORM -->
                            <form method="GET" class="mb-4">
                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <select name="country" class="form-control">
                                            <option value="">All Countries</option>
                                            <?php while($row = mysqli_fetch_assoc($countries_query)): ?>
                                                <option value="<?= htmlspecialchars($row['sortname']) ?>" <?= $country_filter == $row['sortname'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($row['name']) ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="device" class="form-control">
                                            <option value="">All Devices</option>
                                            <option value="Desktop" <?= $device_filter == 'Desktop' ? 'selected' : '' ?>>Desktop</option>
                                            <option value="Mobile" <?= $device_filter == 'Mobile' ? 'selected' : '' ?>>Mobile</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="os" class="form-control">
                                            <option value="">All OS</option>
                                            <option value="Windows" <?= $os_filter == 'Windows' ? 'selected' : '' ?>>Windows</option>
                                            <option value="Android" <?= $os_filter == 'Android' ? 'selected' : '' ?>>Android</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" name="from_date" value="<?= $from_date ?>" class="form-control" placeholder="From Date">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" name="to_date" value="<?= $to_date ?>" class="form-control" placeholder="To Date">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                                    </div>
                                </div>
                            </form>
                            
                            <!-- TABLE -->
                            <table class="table table-bordered table-striped table-responsive">
                                <thead class="thead-light">
                                    <tr>
                                        <th>S.N</th>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Offer</th>
                                        <th>Click ID</th>
                                        <th>User IP</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Device</th>
                                        <th>OS</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = $start_from + 1;
                                    while ($list = mysqli_fetch_assoc($cat_res)) {
                                        $offer_id = $list['offer_id'];
                                        $user_id = $list['user_id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $list['user_id']; ?></td>
                                        <td>
                                            <?php 
                                            $sql = "SELECT name FROM users WHERE id = '$user_id'";
                                            $result = mysqli_query($con, $sql);
                                            if ($row = mysqli_fetch_assoc($result)) {
                                                echo $row['name'];
                                            }
                                            ?>
                                        </td>
                                        
                                        <td>
                                            <?php 
                                            $sql = "SELECT icon_url FROM offers WHERE id = '$offer_id'";
                                            $result = mysqli_query($con, $sql);
                                            if ($row = mysqli_fetch_assoc($result)) {
                                                echo '<img src="https://reapbucks.com/admin/images/offers/' . $row['icon_url'] . '" style="width:100px;height:50px;">';
                                            }
                                            ?>
                                        </td>
                                        
                                        <td style="background: #354052;color: white;"><?php echo $list['click_id']; ?></td>
                                        <td><?php echo $list['user_ip']; ?></td>
                                        <td><?php echo $list['user_country']; ?></td>
                                        <td><?php echo $list['user_state']; ?></td>
                                        <td><?php echo $list['user_city']; ?></td>
                                        <td><?php echo $list['user_device']; ?></td>
                                        <td><?php echo $list['user_os']; ?></td>
                                        <td><?php echo $list['timestamp']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            
                            <!-- PAGINATION -->
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <?php
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        $active = ($i == $page) ? 'active' : '';
                                        $queryParams = http_build_query(array_merge($_GET, ['page' => $i]));
                                        echo "<li class='page-item $active'><a class='page-link' href='?$queryParams'>$i</a></li>";
                                    }
                                    ?>
                                </ul>
                            </nav>





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