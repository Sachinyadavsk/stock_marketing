<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php

// App update notification type start:
if (isset($_POST['app_userupdate'])) {
    $admin_id = $_POST['token_id'];
    $update_type = $_POST['update_type'];
    $version_code = $_POST['version_code'];
    $lbv = '1.39';
    $bv = '1.39';
    $av = '1.73';
   
    // Check if record exists
    $check = $con->query("SELECT admin_id FROM maintain WHERE admin_id = '$admin_id'");
    if ($check->num_rows > 0) {
        // Update
        $sql = "UPDATE maintain SET update_type = '$update_type', version_code = '$version_code', lbv = '$lbv', bv = '$bv', av = '$av' WHERE admin_id = '$admin_id'";
        $last_id = mysqli_insert_id($con);
        logActivity($con, $admin_id, $role_type_is, $update_type, 'Update maintain');
    } else {
        // Insert
        $sql = "INSERT INTO maintain (admin_id, update_type, version_code, lbv, bv, av) VALUES ('$admin_id', '$update_type', '$version_code', '$lbv', '$bv', '$av')";
        $last_id = mysqli_insert_id($con);
        logActivity($con, $last_id, $role_type_is, $update_type, 'Add New Maintain');
    }
     $con->query($sql);
     header('location:maintain.php');
     die();
}

// Database cleanup
if (isset($_POST['app_cleanup'])) {
    $admin_id = $_POST['token_id'];
    $cleanup_type = $_POST['cleanup_type'];
    $cleanup_days = $_POST['cleanup_days'];
    
    // Check if record exists
    $check = $con->query("SELECT admin_id FROM maintain WHERE admin_id = '$admin_id'");
    if ($check->num_rows > 0) {
        // Update
        $sql = "UPDATE maintain SET cleanup_type = '$cleanup_type', cleanup_days = '$cleanup_days' WHERE admin_id = '$admin_id'";
        logActivity($con, $admin_id, $role_type_is, $cleanup_type, 'Update Maintain');
    } else {
        // Insert
        $sql = "INSERT INTO maintain (admin_id, cleanup_type, cleanup_days) VALUES ('$admin_id', '$cleanup_type', '$cleanup_days')";
        $last_id = mysqli_insert_id($con);
        logActivity($con, $last_id, $role_type_is, $cleanup_type, 'Add New Maintain');
    }
     $con->query($sql);
     header('location:maintain.php');
     die();
}

// Terms of Services
if (isset($_POST['tos_update'])) {
    $admin_id = $_POST['token_id'];
    $tos = $_POST['tos'];
  
    // Check if record exists
    $check = $con->query("SELECT admin_id FROM maintain WHERE admin_id = '$admin_id'");
    if ($check->num_rows > 0) {
        // Update
        $sql = "UPDATE maintain SET tos = '$tos' WHERE admin_id = '$admin_id'";
        logActivity($con, $admin_id, $role_type_is, $tos, 'Update team of service');
    } else {
        // Insert
        $sql = "INSERT INTO maintain (admin_id, tos) VALUES ('$admin_id', '$tos')";
        $last_id = mysqli_insert_id($con);
        logActivity($con, $last_id, $role_type_is, '', 'Add New team of service');
    }
     $con->query($sql);
     header('location:maintain.php');
     die();
}


// privacy_update
if (isset($_POST['privacy_update'])) {
    $admin_id = $_POST['token_id'];
    $privacy = $_POST['privacy'];
  
    // Check if record exists
    $check = $con->query("SELECT admin_id FROM maintain WHERE admin_id = '$admin_id'");
    if ($check->num_rows > 0) {
        // Update
        $sql = "UPDATE maintain SET privacy = '$privacy' WHERE admin_id = '$admin_id'";
        logActivity($con, $admin_id, $role_type_is, $privacy, 'Update privacy');
    } else {
        // Insert
        $sql = "INSERT INTO maintain (admin_id, privacy) VALUES ('$admin_id', '$privacy')";
        $last_id = mysqli_insert_id($con);
        logActivity($con, $last_id, $role_type_is, $privacy, 'Add new privacy');
    }
     $con->query($sql);
     header('location:maintain.php');
     die();
}

// app_ads
if (isset($_POST['app_ads'])) {
    $admin_id = $_POST['token_id'];
    $ads_data = $_POST['ads_data'];
  
    // Check if record exists
    $check = $con->query("SELECT admin_id FROM maintain WHERE admin_id = '$admin_id'");
    if ($check->num_rows > 0) {
        // Update
        $sql = "UPDATE maintain SET ads_data = '$ads_data' WHERE admin_id = '$admin_id'";
        logActivity($con, $admin_id, $role_type_is, 'Ads data', 'Update Ads data');
    } else {
        // Insert
        $sql = "INSERT INTO maintain (admin_id, ads_data) VALUES ('$admin_id', '$ads_data')";
        $last_id = mysqli_insert_id($con);
        logActivity($con, $last_id, $role_type_is, 'Ads data', 'Add new Ads data');
    }
     $con->query($sql);
     header('location:maintain.php');
     die();
}

$m_query = "SELECT * FROM maintain WHERE admin_id='".$_SESSION['ADMIN_ID']."'";
$m_res = mysqli_query($con, $m_query);
$m_row = mysqli_fetch_assoc($m_res);
?>


<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->
        <div class="content">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card card-body">
                        
                        <form method="post" class="row">
                            <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                            <div class="col-md-6 mb-3 col-sm-12">
                                <div><span class="font-weight-bold">Latest backend version:</span> <?php echo  $m_row['lbv'];?></div>
                                <div><span class="font-weight-bold">Your backend version:</span> <?php echo  $m_row['bv'];?></div>
                            </div>
                            <div class="col-md-6 mb-3 col-sm-12">
                                <div><span class="font-weight-bold">Your app version:</span> <?php echo  $m_row['av'];?></div>

                            </div>
                            <div class="hr-text mt-4 mb-3 text-primary">User app update notification setup</div>
                            <div class="col-md-4">
                                <label class="form-label">App update notification type:</label>
                                <div class="form-selectgroup">
                                    <label class="form-selectgroup-item text-no-wrap">
                                        <input type="radio" name="update_type" value="<?php if($m_row['update_type']=='1'){ echo $m_row['update_type']; }else{ echo '1';} ?>" <?php if($m_row['update_type']=='1'){ echo 'checked';}else{ } ?>  class="form-selectgroup-input">
                                        <span class="form-selectgroup-label">Force update</span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="update_type" value="<?php if($m_row['update_type']=='0'){ echo $m_row['update_type']; }else{ echo '0';} ?>" <?php if($m_row['update_type']=='0'){ echo 'checked';}else{ } ?> class="form-selectgroup-input">
                                        <span class="form-selectgroup-label">Optional</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">To the versionCode:</label>
                                <input type="text" class="form-control" name="version_code" value="<?php if(!empty($m_row['version_code'])){ echo $m_row['version_code'];}else{ echo '';};?>">
                            </div>
                            
                            <?php if (has_module_access_edit($con, 'maintenance')): ?>
                                <div class="col-md-4">
                                    <label class="form-label">.</label>
                                    <button type="submit" name="app_userupdate" class="btn btn-primary">Send update notification</button>
                                </div>
                            <?php endif; ?>
                        </form>
                        
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-red font-weight-bold">Database cleanup</div>
                        
                        <form method="post" class="card-body row">
                            <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                            <div class="col-md-4 col-sm-12 mb-2">
                               <select name="cleanup_type" class="form-select mb-2">
                                    <option value="0" <?php if(isset($m_row['cleanup_type']) && $m_row['cleanup_type'] == '0') echo 'selected'; ?>>-- Disable cleanup --</option>
                                    <option value="1" <?php if(isset($m_row['cleanup_type']) && $m_row['cleanup_type'] == '1') echo 'selected'; ?>>Manually remove users</option>
                                    <option value="2" <?php if(isset($m_row['cleanup_type']) && $m_row['cleanup_type'] == '2') echo 'selected'; ?>>Scheduled remove users</option>
                                </select>
                            </div>
                            <div class="col-md-5 col-sm-12 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">if inactive for</span>
                                    <input type="text" class="form-control" name="cleanup_days" value="<?php if(!empty($m_row['cleanup_days'])){ echo $m_row['cleanup_days'];}else{ echo '';} ?>">
                                    <span class="input-group-text">days</span>
                                </div>
                            </div>
                            
                            <?php if (has_module_access_edit($con, 'maintenance')): ?>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <button type="submit" name="app_cleanup" class="btn btn-primary">Submit</button>
                                </div>
                            <?php endif; ?>
                        </form>
                        
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <form class="card" method="post">
                             <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                            <div class="card-header">Terms of Services</div>
                            <div class="card-body">
                                <textarea class="form-control" name="tos" rows="10"><?php if(!empty($m_row['tos'])){ echo $m_row['tos'];}else{ echo '';} ?></textarea>
                            </div>
                            
                             <?php if (has_module_access_edit($con, 'maintenance')): ?>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit" name="tos_update">Update Terms of Service</button>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <form class="card" method="post">
                            <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                            <div class="card-header">Privacy Policy</div>
                            <div class="card-body">
                                <textarea class="form-control" name="privacy" rows="10"><?php if(!empty($m_row['privacy'])){ echo $m_row['privacy'];}else{ echo '';} ?></textarea>
                            </div>
                            
                            <?php if (has_module_access_edit($con, 'maintenance')): ?>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit" name="privacy_update">Update Privacy Policy</button>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                    <div class="col-12">
                        <form class="card" method="post">
                            <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                            <div class="card-header">Update <span class="font-weight-bold mx-1">app-ads.txt</span>
                                content <a class="text-blue ml-3" href="app-ads.txt" target="_blank">app-ads.txt</a>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="ads_data" rows="6"><?php if(!empty($m_row['ads_data'])){ echo $m_row['ads_data'];}else{ echo '';} ?></textarea>
                            </div>
                            
                            <?php if (has_module_access_edit($con, 'maintenance')): ?>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit" name="app_ads">Update app-ads.txt</button>
                                </div>
                            <?php endif; ?>
                        </form>
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