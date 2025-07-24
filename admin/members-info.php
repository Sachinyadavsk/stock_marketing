<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php
if (isset($_GET['userid']) && $_GET['userid'] != '') {
    $uid = get_safe_value($con, $_GET['userid']);
    $res = mysqli_query($con, "SELECT * FROM users WHERE id='$uid'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $ip = $row['ip'];
        $location = $row['location'];
        $device = $row['device'];
        $timestamp = $row['timestamp'];
        $status = $row['status'];
        $is_online = $row['is_online'];
        $password_plain = $row['password_plain'];
        
        $parts = explode(' - ', $location);
        $countryCode = isset($parts[0]) ? strtolower($parts[0]) : '';
        $countryname = '';
        
        // Define mapping
        $countryMap = [
            'in' => 'India',
            'us' => 'United States',
            'uk' => 'United Kingdom',
            'ca' => 'Canada',
            'au' => 'Australia',
            'de' => 'Germany',
            'fr' => 'France',
            // Add more as needed
        ];
        
        if (array_key_exists($countryCode, $countryMap)) {
            $countryname = $countryMap[$countryCode];
        }
        
        // extra fields
        $balance = $row['balance'];
        $avatar = $row['avatar'];
        $refby = $row['refby'];
        $deviceid = $row['deviceid'];
        $googlerefid = $row['googlerefid'];
        $vercode = $row['vercode'];
        $vername = $row['vername'];
        
        
    } else {
        header('location:members.php');
        die();
    }
}


// add the rewards
if(isset($_POST['rewards'])){
    $userid = get_safe_value($con, $_POST['userid']);
    $points = get_safe_value($con, $_POST['points']);
    $method = 'manually';
    $date = date("Y-m-d H:i:s");

    $check = mysqli_query($con, "SELECT points FROM reward WHERE userid='$userid'");

    if(mysqli_num_rows($check) > 0){
        $row = mysqli_fetch_assoc($check);
        $old_points = $row['points'];
        $new_points = $old_points + $points;

        // Update by adding new points to old points
        mysqli_query($con, "UPDATE reward SET points='$new_points', method='$method', date='$date' WHERE userid='$userid'");
        logActivity($con, $userid, $role_type_is, $new_points, 'update points');
    } else {
        // First time: insert new record
        mysqli_query($con, "INSERT INTO reward (userid, points, method, date) VALUES ('$userid', '$points', '$method', '$date')");
        logActivity($con, $userid, $role_type_is, $points, 'insert new record');
    }
    
    header("Location: members-info.php?userid=" . urlencode($userid));
    die();
}

// deduct the rewards
if(isset($_POST['deduct'])){
    $userid = get_safe_value($con, $_POST['userid']);
    $points = get_safe_value($con, $_POST['points']);
    $method = 'deduct';
    $date = date("Y-m-d H:i:s");

    $check = mysqli_query($con, "SELECT points FROM reward WHERE userid='$userid'");

    if(mysqli_num_rows($check) > 0){
        $row = mysqli_fetch_assoc($check);
        $old_points = $row['points'];
        $new_points = $old_points - $points;

        // Update by deduct new points to old points
        mysqli_query($con, "UPDATE reward SET points='$new_points', method='$method', date='$date' WHERE userid='$userid'");
        logActivity($con, $userid, $role_type_is, $new_points, 'Update by deduct record');
    } else {
        header("Location: members-info.php?userid=" . urlencode($userid));
    }
    
    header("Location: members-info.php?userid=" . urlencode($userid));
    die();
}

// bannow user
if(isset($_POST['bannow'])){
    $userid = get_safe_value($con, $_POST['userid']);
    $reason = get_safe_value($con, $_POST['reason']);
  
    $check = mysqli_query($con, "SELECT reason FROM users WHERE id='$userid'");
    if(mysqli_num_rows($check) > 0){
        mysqli_query($con, "UPDATE users SET reason='$reason', banstatus='1' WHERE id='$userid'");
        logActivity($con, $userid, $role_type_is, $reason, 'reason by deduct record');
    } else {
        header("Location: members-info.php?userid=" . urlencode($userid));
    }
    
    header("Location: members-info.php?userid=" . urlencode($userid));
    die();
}

// update the member user records
$msg = '';
$color_class = '';

if(isset($_POST['update'])) {
    $userid = get_safe_value($con, $_POST['userid']);
    $name = get_safe_value($con, $_POST['name']);
    $email = get_safe_value($con, $_POST['email']);
    $status = get_safe_value($con, $_POST['status']);
    $avatar = get_safe_value($con, $_POST['avatar']);
    $refby = get_safe_value($con, $_POST['refby']);
    $deviceid = get_safe_value($con, $_POST['deviceid']);
    $googlerefid = get_safe_value($con, $_POST['googlerefid']);
    $vercode = get_safe_value($con, $_POST['vercode']);
    $vername = get_safe_value($con, $_POST['vername']);
    $password = get_safe_value($con, $_POST['password']);

    $check = mysqli_query($con, "SELECT * FROM users WHERE id='$userid'");
    
    if(mysqli_num_rows($check) > 0) {
        // Start building the SQL update string
        $update_query = "UPDATE users SET name='$name', email='$email', status='$status', avatar='$avatar', refby='$refby', deviceid='$deviceid', googlerefid='$googlerefid', vercode='$vercode', vername='$vername'";
        
        // Only update password if a new one is provided
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $update_query .= ", password='$hashedPassword'";
        }

        $update_query .= " WHERE id='$userid'";
        mysqli_query($con, $update_query);
        logActivity($con, $userid, $role_type_is, $name, 'Update data successfully');
        $color_class = "alert-success";
        $msg = 'Update data successfully!';
    } else {
        $color_class = "alert-warning";
        $msg = 'Please try again updating data';
    }

    header("Location: members-info.php?userid=" . urlencode($userid));
    die();
}



if (isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == 'superadmin') {
    if (isset($_POST['member_logout'])) {
        $uid = (int) $_POST['uid'];
        $sql = "UPDATE users SET is_logged_in = 0 WHERE id = $uid";
        if ($con->query($sql)) {
            logActivity($con, $uid, $role_type_is, '', 'User logged out successfully');
            header("Location: https://reapbucks.com/admin/members-info.php?userid=$uid");
            exit;
            
            $color_class = "alert-success";
            $msg = 'User logged out successfully!';
        } else {
            $color_class = "alert-warning";
            $msg = 'Please try again updating user';
        }
    }
} else {
     header("Location: https://reapbucks.com/admin/members-info.php?userid=$uid");
    exit;
}





$totalpoint = mysqli_query($con, "SELECT points FROM reward WHERE userid='$uid'");
$rowpoint = mysqli_fetch_assoc($totalpoint);

?>

<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->
        <div class="content">
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <div class="card">
                            <div class="px-3 py-3 bg-blue-lt relative">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="avatar avatar-xl avatar-thumb text-gray"><?php echo $initials = strtoupper(substr($name, 0, 2));?></span>
                                    </div>
                                    <div class="col">
                                        <div class="h4 mb-0"> ID: <?php echo $uid;?> </div>
                                        <div class="mb-2 small">Member since: <?php echo $timestamp;?></div>
                                        <span class="badge bg-blue">Balance<span class="badge-addon"><?php echo $balance;?> Coins</span>
                                            <a href="#" class="px-1 ml-2 text-white" data-backdrop="static"
                                                data-keyboard="false" data-toggle="modal"
                                                data-target="#modal-balance-p">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                </svg>
                                            </a>
                                            <a href="#" class="ml-1 text-white" data-backdrop="static"
                                                data-keyboard="false" data-toggle="modal"
                                                data-target="#modal-balance-n">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                </svg>
                                            </a>
                                        </span>
                                        <span class="badge bg-gray">Pending<span class="badge-addon "><?php echo $rowpoint['points'];?> Coins</span></span>
                                    </div>
                                </div>
                                
                                   <a href="#" class="btn-close text-red m-2" data-id="<?php echo $uid;?>" data-toggle="modal"
                                        data-target="#cat-del_user" data-backdrop="static" data-keyboard="false">
                                         <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <path
                                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                        <path d="M7 12h14l-3 -3m0 6l3 -3" />
                                    </svg>
                                    </a>
                                    <?php if($status=='1'){?>
                                      <span class="text text-success font-weight-bold">🟢 Active</span>
                                    <?php }elseif($status=='0'){?>
                                     <span class="text text-danger font-weight-bold">🔴 Inctive</span>
                                    <?php }?>
                                    
                                    <p style="background-color: #f1f3f8;padding: 6px;margin-top: 10px;font-weight: 500;"> Member Password &nbsp;<span><?php echo $password_plain;?></span></p>
                                      
                            </div>
                            
                            <form class="card-body" method="post">
                                <input type="hidden" name="userid" value="<?php echo $uid;?>">
                                <div class="mb-2">
                                    <span class="form-label mb-1">Name of user:</span>
                                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                                </div>
                                <div class="mb-2">
                                    <span class="form-label mb-1">Email address:</span>
                                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                                </div>
                                <div class="mb-3">
                                    <span class="form-label mb-1">Avatar URL:</span>
                                    <input type="text" class="form-control" name="avatar" value="<?php echo $avatar;?>">
                                </div>
                                
                               <div class="mb-3">
                                    <span class="form-label mb-1">Status:</span>
                                    <select name="status" class="form-control">
                                        <option value="">Choose the status</option>
                                        <option value="1" <?php if ($status == '1') echo 'selected'; ?>>Active</option>
                                        <option value="0" <?php if ($status == '0') echo 'selected'; ?>>Inactive</option>
                                    </select>
                                </div>

                                
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Referred by:</span>
                                    <input type="text" class="form-control" name="refby" value="<?php if(!empty($refby)){ echo $refby;}else{ echo 'None';}?>">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Device ID:</span>
                                    <input type="text" class="form-control" readonly="" name="deviceid" value="<?php echo $deviceid;?>">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Google Referrer ID:</span>
                                    <input type="text" class="form-control" name="googlerefid" value="<?php echo $googlerefid;?>" readonly="">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">VersionCode using:</span>
                                    <input type="text" class="form-control" name="vercode" value="<?php echo $vercode;?>" readonly="">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">VersionName using:</span>
                                    <input type="text" class="form-control" name="vername" value="<?php echo $vername;?>" readonly="">
                                </div>
                                <div class="mt-3 mb-3">
                                    <span class="form-label mb-1">New password:</span>
                                    <input type="text" class="form-control" name="password">
                                </div>
                                   <?php if (has_module_access_edit($con, 'users_directory')): ?>
                                     <input type="submit" class="btn btn-block btn-primary" name="update" value="Update user data">
                                   <?php endif; ?>
                            </form>
                            
                            <?php if (!empty($msg)): ?>
                                <div class="alert <?php echo $color_class; ?>">
                                    <?php echo $msg; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-footer">
                                <div class="row">
                                    <?php if (has_module_access_insert($con, 'send_push_message')): ?>
                                        <div class="col-6">
                                            <form method="post" action="pushmsg.php">
                                                    <input type="hidden" name="uid" value="<?php echo $uid;?>">
                                                    <input type="submit" class="btn btn-block btn-outline-info" name="submit" value="Send push message">
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (has_module_access_insert($con, 'banned_users')): ?>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-block btn-outline-danger" data-backdrop="static"
                                                data-keyboard="false" data-toggle="modal" data-target="#modal-ban">Ban this user</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-8">
                            <?php if (has_module_access($con, 'withdrawal_activity')): ?>
                               <div class="card">
                                    <div class="card-header">
                                    <h3 class="card-title mr-3 text-nowrap">Withdrawals</h3>
                                    <div class="ml-auto">
                                        <span class="text-nowrap"><kbd>Country: <?php echo $countryname;?></kbd></span>
                                    </div>
                                </div>
                                <?php
                                    $limit = 10;
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $start_from = ($page - 1) * $limit;
                                    
                                    // Fetch data from activity_history
                                    $query = "SELECT * FROM withdrawal WHERE user_id='$uid' ORDER BY id DESC LIMIT $start_from, $limit";
                                    $result = mysqli_query($con, $query);
                                    
                                    // Count total records
                                    $count_query = "SELECT COUNT(*) as total FROM withdrawal";
                                    $count_result = mysqli_query($con, $count_query);
                                    $count_row = mysqli_fetch_assoc($count_result);
                                    $total_records = $count_row['total'];
                                    $total_pages = ceil($total_records / $limit);
                                    
                                    $start_record = $start_from + 1;
                                    $end_record = min($start_from + $limit, $total_records);
                                    ?>
                                    <div class=" table-responsive">
                                    <table class="table table-vcenter card-table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Mtehod</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th style="width:180px">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php if (mysqli_num_rows($result) > 0): ?>
                                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                        <tr>
                                                            <td><?= $row['id'] ?></td>
                                                            <td><?= htmlspecialchars($row['upi_id']) ?></td>
                                                            <td><?= htmlspecialchars($row['amount']) ?></td>
                                                            <td>
                                                               <?php if($row['status']=='pending'){ ?>
                                                                    <span class="text-warning"><?= $row['status'] ?></span>
                                                                <?php }else{ ?>
                                                                    <span class="text-green"><?= $row['status'] ?></span>
                                                               <?php } ?>
                                                            </td>
                                                            <td><?= $row['created_at'] ?></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr><td colspan="6" class="text-center">No data found.</td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                    </table>
                                </div>
                                   <div class="card-footer d-flex align-items-center">
                                        <p class="m-0 text-muted">
                                            Showing <span><?= $start_record ?></span> to <span><?= $end_record ?></span> of <span><?= $total_records ?></span> entries
                                        </p>
                                        <ul class="pagination m-0 ml-auto">
                                            <?php if ($page > 1): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?= $page - 1 ?>">&laquo; Prev</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <?php if ($page < $total_pages): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next &raquo;</a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                               </div>
                            <?php endif; ?>
                            
                            <?php if (has_module_access($con, 'activities_history')): ?>
                                <div class="card">
                                   <div class="card-header">
                                        <h3 class="card-title mr-3 text-nowrap">Activities history</h3>
                                        <div class="ml-auto">
                                            <span class="text-nowrap"><kbd>Signed-up IP:<?php echo $ip;?></kbd></span>
                                        </div>
                                   </div>
                                   <?php
                                    $limit = 10;
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $start_from = ($page - 1) * $limit;
                                    
                                    // Fetch data from activity_history
                                    $query = "SELECT id, method, point_name, price, ip_address, created_at 
                                              FROM activity_history WHERE user_id='$uid'
                                              ORDER BY id DESC 
                                              LIMIT $start_from, $limit";
                                    $result = mysqli_query($con, $query);
                                    
                                    // Count total records
                                    $count_query = "SELECT COUNT(*) as total FROM activity_history";
                                    $count_result = mysqli_query($con, $count_query);
                                    $count_row = mysqli_fetch_assoc($count_result);
                                    $total_records = $count_row['total'];
                                    $total_pages = ceil($total_records / $limit);
                                    
                                    $start_record = $start_from + 1;
                                    $end_record = min($start_from + $limit, $total_records);
                                    ?>

                                   <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap datatable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Type</th>
                                                    <th>From</th>
                                                    <th>IP</th>
                                                    <th>Coins</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (mysqli_num_rows($result) > 0): ?>
                                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                        <tr>
                                                            <td><?= $row['id'] ?></td>
                                                            <td><?= htmlspecialchars($row['method']) ?></td>
                                                            <td><?= htmlspecialchars($row['point_name']) ?></td>
                                                            <td><?= htmlspecialchars($row['ip_address']) ?></td>
                                                            <td><?= $row['price'] ?></td>
                                                            <td><?= $row['created_at'] ?></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr><td colspan="6" class="text-center">No data found.</td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                   <div class="card-footer d-flex align-items-center">
                                        <p class="m-0 text-muted">
                                            Showing <span><?= $start_record ?></span> to <span><?= $end_record ?></span> of <span><?= $total_records ?></span> entries
                                        </p>
                                        <ul class="pagination m-0 ml-auto">
                                            <?php if ($page > 1): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?= $page - 1 ?>">&laquo; Prev</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <?php if ($page < $total_pages): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next &raquo;</a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>

                    </div>
                </div>
                
                <!--modal1-->
                <form method="post" class="modal modal-blur fade" id="modal-ban" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="userid" value="<?php echo $uid;?>">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ban this user</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">What is the reason for banning?</label>
                                <textarea class="form-control" name="reason" placeholder="Write down a reason for your action."></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                                <button type="submit" name="bannow" class="btn btn-danger">Ban now</button>
                            </div>
                        </div>
                    </div>
                </form>
                
                  <!--modal2-->
                <form method="post" class="modal modal-blur fade" id="modal-balance-n" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="userid" value="<?php echo $uid;?>">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-title">How much coins you want to deduct?</div>
                                <div><input type="text" class="form-control" name="points" value="100"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="deduct" class="btn btn-danger">Give panalty</button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!--modal3-->
                <form method="post" class="modal modal-blur fade" id="modal-balance-p" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="userid" value="<?php echo $uid;?>">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-title">How much coins you want to reward?</div>
                                <div><input type="text" class="form-control" name="points" value="100"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="rewards" class="btn btn-success">Give reward</button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!--dynmically user logout start-->
                <form method="post" class="modal modal-blur fade" id="cat-del_user" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="uid" id="cat-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-title">Are you sure?</div>
                                <div>Your session has been logged out due to reason, if applicable, e.g., security measures, inactivity, policy violations, etc. Please log in again to continue your work.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" name="member_logout" class="btn btn-danger">Yes, Logout it</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--dynmically user logout end-->
                
            </div>
            <!-- footer Start -->
            <?php include('footer.php'); ?>
            <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->