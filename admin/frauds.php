<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<style>
    .btn-close {
        position: absolute;
        top: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
        color: #ffffff;
        padding: 0px 5px;
    }
</style>

<?php

if (isset($_POST['update_fp'])) {
    $admin_id = $_POST['token_id'];

    // Define all checkboxes with default values
    $fields = [
        'single_account', 'vpn_block', 'vpn_monitor', 'root_block',
        'auto_ban_multi', 'auto_ban_vpn', 'auto_ban_root', 'ban_cc_change', 'prv_acc_del'
    ];

    $values = [];
    foreach ($fields as $field) {
        // If checkbox is ticked, its value is 1, otherwise set to 0
        $values[$field] = isset($_POST[$field]) ? 1 : 0;
    }

    // Check if record exists for this admin
    $check = mysqli_query($con, "SELECT id FROM fraud_prevention_settings WHERE admin_id = '$admin_id'");
    if (mysqli_num_rows($check) > 0) {
        // Update existing record
        $update = [];
        foreach ($values as $key => $val) {
            $update[] = "$key = '$val'";
        }
        $update_str = implode(", ", $update);
        mysqli_query($con, "UPDATE fraud_prevention_settings SET $update_str WHERE admin_id = '$admin_id'");
    } else {
        // Insert new record
        $columns = implode(", ", array_merge(['admin_id'], array_keys($values)));
        $data = implode(", ", array_merge(["'$admin_id'"], array_map(fn($v) => "'$v'", $values)));
        mysqli_query($con, "INSERT INTO fraud_prevention_settings ($columns) VALUES ($data)");
    }

     header('location:frauds.php');
     die();
}



if (isset($_POST['frauds_update'])) {
    $admin_id = $_POST['token_id'];
    $registration_disable = $_POST['registration_disable'];
    $registration_validation = $_POST['registration_validation'];
    $disposable_email = $_POST['disposable_email'];
    $invitation_only = $_POST['invitation_only'];
    $block_emu = $_POST['block_emu'];
    $registration_limit_per_hour = $con->real_escape_string(trim($_POST['registration_limit_per_hour']));

    // Check if record exists
    $check = $con->query("SELECT admin_id FROM spam_protection_settings WHERE admin_id = '$admin_id'");
    if ($check->num_rows > 0) {
        // Update
        $sql = "UPDATE spam_protection_settings SET 
            registration_disable = '$registration_disable',
            registration_validation = '$registration_validation',
            disposable_email = '$disposable_email',
            invitation_only = '$invitation_only',
            block_emu = '$block_emu',
            registration_limit_per_hour = '$registration_limit_per_hour'
            WHERE admin_id = '$admin_id'";
    } else {
        // Insert
        $sql = "INSERT INTO spam_protection_settings 
            (admin_id, registration_disable, registration_validation, disposable_email, invitation_only, block_emu, registration_limit_per_hour) 
            VALUES 
            ('$admin_id', '$registration_disable', '$registration_validation', '$disposable_email', '$invitation_only', '$block_emu', '$registration_limit_per_hour')";
    }
     $con->query($sql);
     header('location:frauds.php');
     die();
}

 $fp_query = "SELECT * FROM fraud_prevention_settings WHERE id='1'";
 $fp_res = mysqli_query($con, $fp_query);
 $fp_row = mysqli_fetch_assoc($fp_res);
 
//  producations to protected 
$p_query = "SELECT * FROM spam_protection_settings WHERE id='1'";
 $p_res = mysqli_query($con, $p_query);
 $p_row = mysqli_fetch_assoc($p_res);
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
                    <div class="col-12">
                        
                        <form class="card" method="post">
                            <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                            <div class="card-header bg-blue-lt pt-3 pb-2">
                                <h4 class="text-dark">Spam protection</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mt-2">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Anyone can register by mobile app?</label>
                                            <div class="form-selectgroup">
                                                <label class="form-selectgroup-item text-no-wrap">
                                                    <input type="radio" name="registration_disable" value="<?php if($p_row['registration_disable']=='2'){ echo $p_row['registration_disable'];}else{ echo '2';}?>" <?php if($p_row['registration_disable']=='2'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label">Yes</span>
                                                </label>
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="registration_disable" value="<?php if($p_row['registration_disable']=='1'){ echo $p_row['registration_disable'];}else{ echo '1';}?>" <?php if($p_row['registration_disable']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label">No</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Registration requires email verification?</label>
                                            <div class="form-selectgroup">
                                                <label class="form-selectgroup-item text-no-wrap">
                                                    <input type="radio" name="registration_validation" value="<?php if($p_row['registration_validation']=='1'){ echo $p_row['registration_validation'];}else{ echo '1';}?>" <?php if($p_row['registration_validation']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label">Yes</span>
                                                </label>
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="registration_validation" value="<?php if($p_row['registration_validation']=='2'){ echo $p_row['registration_validation'];}else{ echo '2';}?>" <?php if($p_row['registration_validation']=='2'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label">No</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Prevent registration with disposable
                                                email?</label>
                                            <div class="form-selectgroup">
                                                <label class="form-selectgroup-item text-no-wrap">
                                                    <input type="radio" name="disposable_email" value="<?php if($p_row['disposable_email']=='1'){ echo $p_row['disposable_email'];}else{ echo '1';}?>" <?php if($p_row['disposable_email']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label">Yes</span>
                                                </label>
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="disposable_email" value="<?php if($p_row['disposable_email']=='2'){ echo $p_row['disposable_email'];}else{ echo '2';}?>" <?php if($p_row['disposable_email']=='2'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label">No</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Registration is invitation only?</label>
                                            <div class="form-selectgroup">
                                                <label class="form-selectgroup-item text-no-wrap">
                                                    <input type="radio" name="invitation_only" value="<?php if($p_row['invitation_only']=='1'){ echo $p_row['invitation_only'];}else{ echo '1';}?>" <?php if($p_row['invitation_only']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label">Yes</span>
                                                </label>
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="invitation_only" value="<?php if($p_row['invitation_only']=='2'){ echo $p_row['invitation_only'];}else{ echo '2';}?>" <?php if($p_row['invitation_only']=='2'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label">No</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Block emulators <sup
                                                    class="text-red">beta</sup></label>
                                            <div class="form-selectgroup">
                                                <label class="form-selectgroup-item text-no-wrap">
                                                    <input type="radio" name="block_emu" value="<?php if($p_row['block_emu']=='1'){ echo $p_row['block_emu'];}else{ echo '1';}?>" <?php if($p_row['block_emu']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label">Yes</span>
                                                </label>
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="block_emu" value="<?php if($p_row['block_emu']=='2'){ echo $p_row['block_emu'];}else{ echo '2';}?>" <?php if($p_row['block_emu']=='2'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label">No</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">How many registrations will be accepted per hour?</label>
                                            <input type="text" class="form-control" name="registration_limit_per_hour" value="<?php echo $p_row['registration_limit_per_hour'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                             <?php if (has_module_access_edit($con, 'fraud_prevention')): ?>
                                <div class="card-footer text-right">
                                    <button type="submit" name="frauds_update" class="btn btn-primary">Update protection</button>
                                </div>
                            <?php endif; ?>
                            
                        </form>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        
                        <!--Update fraud prevention start-->
                        <form class="card" method="post">
                           <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                            <div class="card-header bg-gray-lt pt-3 pb-2">
                                <h4 class="text-dark">Fraud Prevention</h4>
                            </div>
                            <div class="card-body">
                                
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="checkbox" name="single_account" value="<?php if($fp_row['single_account']=='1'){ echo $fp_row['single_account'];}else{ echo '0';}?>" <?php if($fp_row['single_account']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center pl-3 pr-3 pt-1 pb-1 mb-1">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar rounded mr-3" style="background-image: url(assets/img/single_account.png)"></span>
                                            <div class="lh-sm">
                                                <div class="strong text-left">Single account per device</div>
                                                <div class="h5 text-muted text-left">Don't let users open more than 1 account from a device.</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="checkbox" name="vpn_block" value="<?php if($fp_row['vpn_block']=='1'){ echo $fp_row['vpn_block'];}else{ echo '0';}?>" <?php if($fp_row['vpn_block']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center pl-3 pr-3 pt-1 pb-1 p-3 mb-1">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar rounded mr-3" style="background-image: url(assets/img/block_vpn.png)"></span>
                                            <div class="lh-sm">
                                                <div class="strong text-left">Block VPN access</div>
                                                <div class="h5 text-muted text-left">Don't let the user open offers by using VPN.</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="checkbox" name="vpn_monitor" value="<?php if($fp_row['vpn_monitor']=='1'){ echo $fp_row['vpn_monitor'];}else{ echo '0';}?>" <?php if($fp_row['vpn_monitor']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center pl-3 pr-3 pt-1 pb-1 p-3 mb-1">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar rounded mr-3" style="background-image: url(assets/img/monitor_vpn.png)"></span>
                                            <div class="lh-sm">
                                                <div class="strong text-left">Monitor VPN access</div>
                                                <div class="h5 text-muted text-left">Silently detect how many times users attempted to use VPN.</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="checkbox" name="root_block" value="<?php if($fp_row['root_block']=='1'){ echo $fp_row['root_block'];}else{ echo '0';}?>" <?php if($fp_row['root_block']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center pl-3 pr-3 pt-1 pb-1 p-3 mb-1">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar rounded mr-3" style="background-image: url(assets/img/block_rooted.png)"></span>
                                            <div class="lh-sm">
                                                <div class="strong text-left">Block rooted device</div>
                                                <div class="h5 text-muted text-left">App will not work on rooted device if this option gets activated.</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="checkbox" name="auto_ban_multi" value="<?php if($fp_row['auto_ban_multi']=='1'){ echo $fp_row['auto_ban_multi'];}else{ echo '0';}?>" <?php if($fp_row['auto_ban_multi']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center pl-3 pr-3 pt-1 pb-1 p-3 mb-1">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar rounded mr-3" style="background-image: url(assets/img/auto_ban_multi.png)"></span>
                                            <div class="lh-sm">
                                                <div class="strong text-left">Auto ban multiple accounts</div>
                                                <div class="h5 text-muted text-left">Auto ban who attempts to create multiple accounts.</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="checkbox" name="auto_ban_vpn" value="<?php if($fp_row['auto_ban_vpn']=='1'){ echo $fp_row['auto_ban_vpn'];}else{ echo '0';}?>" <?php if($fp_row['auto_ban_vpn']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center pl-3 pr-3 pt-1 pb-1 p-3 mb-1">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar rounded mr-3" style="background-image: url(assets/img/auto_ban_vpn.png)"></span>
                                            <div class="lh-sm">
                                                <div class="strong text-left">Auto ban VPN user</div>
                                                <div class="h5 text-muted text-left">Auto ban who attempts to use VPN connection on offers</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="checkbox" name="auto_ban_root" value="<?php if($fp_row['auto_ban_root']=='1'){ echo $fp_row['auto_ban_root'];}else{ echo '0';}?>" <?php if($fp_row['auto_ban_root']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center pl-3 pr-3 pt-1 pb-1 p-3 mb-1">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar rounded mr-3" style="background-image: url(assets/img/auto_ban_rooted.png)"></span>
                                            <div class="lh-sm">
                                                <div class="strong text-left">Auto ban rooted device</div>
                                                <div class="h5 text-muted text-left">Auto ban the account who uses rooted device</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="checkbox" name="ban_cc_change" value="<?php if($fp_row['ban_cc_change']=='1'){ echo $fp_row['ban_cc_change'];}else{ echo '0';}?>" <?php if($fp_row['ban_cc_change']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center pl-3 pr-3 pt-1 pb-1 p-3 mb-1">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar rounded mr-3" style="background-image: url(assets/img/cc_change.png)"></span>
                                            <div class="lh-sm">
                                                <div class="strong text-left">Auto ban for country change</div>
                                                <div class="h5 text-muted text-left">Auto ban the account user access the app from different country</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="checkbox" name="prv_acc_del" value="<?php if($fp_row['prv_acc_del']=='1'){ echo $fp_row['prv_acc_del'];}else{ echo '0';}?>" <?php if($fp_row['prv_acc_del']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center pl-3 pr-3 pt-1 pb-1 p-3 mb-1">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="form-selectgroup-label-content d-flex align-items-center">
                                            <span class="avatar rounded mr-3" style="background-image: url(assets/img/user_del.png)"></span>
                                            <div class="lh-sm">
                                                <div class="strong text-left">Auto delete old accounts</div>
                                                <div class="h5 text-muted text-left">Old account will be deleted if user creates new account.</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                            </div>
                            
                            <?php if (has_module_access_edit($con, 'fraud_prevention')): ?>
                            <div class="card-footer">
                                <button type="submit" name="update_fp" class="btn btn-dark">Update fraud prevention</button>
                            </div>
                            <?php endif; ?>
                            
                        </form>
                         <!--Update fraud prevention end-->
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header pt-3 pb-2">
                                <h4>Monitor VPN access</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                                <p class="m-0 text-muted">Showing <span></span> to <span></span> of <span>0</span> entries</p>
                                <ul class="pagination m-0 ml-auto">
                                </ul>
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