<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php

if (isset($_POST['settings_update'])) {
    $token_id            = $_POST['token_id'];
    $backend_name        = $_POST['backend_name'];
    $backend_url         = $_POST['backend_url'];
    $enc_key             = $_POST['enc_key'];
    $package             = $_POST['package'];
    $debug               = $_POST['debug'];
    $currency_name       = $_POST['currency_name'];
    $usd_eq              = $_POST['usd_eq'];
    $cash_to_points      = $_POST['cash_to_points'];
    $pay_percent         = $_POST['pay_percent'];
    $pay_referral        = $_POST['pay_referral'];
    $pay_referred        = $_POST['pay_referred'];
    $earning_notification= $_POST['earning_notification'];
    $balance_interval    = $_POST['balance_interval'];
    $follow_us           = $_POST['follow_us'];
    $leaderboard_reward  = $_POST['leaderboard_reward'];
    $ranked_users        = $_POST['ranked_users'];

    // Check if record exists
    $check = mysqli_query($con, "SELECT * FROM system_settings WHERE token_id = '$token_id'");
    
    if (mysqli_num_rows($check) > 0) {
        // Update existing record
        $query = "UPDATE system_settings SET 
            backend_name='$backend_name',
            backend_url='$backend_url',
            enc_key='$enc_key',
            package='$package',
            debug='$debug',
            currency_name='$currency_name',
            usd_eq='$usd_eq',
            cash_to_points='$cash_to_points',
            pay_percent='$pay_percent',
            pay_referral='$pay_referral',
            pay_referred='$pay_referred',
            earning_notification='$earning_notification',
            balance_interval='$balance_interval',
            follow_us='$follow_us',
            leaderboard_reward='$leaderboard_reward',
            ranked_users='$ranked_users'
            WHERE token_id='$token_id'";
    } else {
        // Insert new record
        $query = "INSERT INTO system_settings (token_id, backend_name, backend_url, enc_key, package, debug, currency_name, usd_eq, cash_to_points, pay_percent, pay_referral, pay_referred, earning_notification, balance_interval, follow_us, leaderboard_reward, ranked_users
        ) VALUES ('$token_id', '$backend_name', '$backend_url', '$enc_key', '$package', '$debug','$currency_name', '$usd_eq', '$cash_to_points', '$pay_percent', '$pay_referral', '$pay_referred', '$earning_notification', '$balance_interval', '$follow_us', '$leaderboard_reward', '$ranked_users'
        )";
    }
    
    mysqli_query($con, $query);
    $last_id = mysqli_insert_id($con);
    logActivity($con, $last_id, $role_type_is, $backend_name, 'add new system settings');
    header('location:settings.php');
    die();
}

 $s_query = "SELECT * FROM system_settings WHERE id='1'";
 $s_res = mysqli_query($con, $s_query);
 $s_row = mysqli_fetch_assoc($s_res);
 
 
 // Handle form submission
if (isset($_POST['games_hide'])) {
    $admin_id = $_POST['token_id'];
    $selected_games = isset($_POST['game']) ? $_POST['game'] : [];

    mysqli_query($con, "DELETE FROM admin_settings WHERE admin_id = '$admin_id'");
    logActivity($con, $admin_id, $role_type_is, $selected_games, 'Delete system settings');
    foreach ($selected_games as $game) {
        mysqli_query($con, "INSERT INTO admin_settings (admin_id, game_code) VALUES ('$admin_id', '$game')");
        $last_id = mysqli_insert_id($con);
        logActivity($con, $admin_id, $role_type_is, $game, 'Add multiple new system settings');
    }
    header('location:settings.php');
    die();
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
                <div class="row">
                    
                    <!--Update system settings start-->
                    <form class="card" method="post">
                        <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                        <div class="card-header d-flex pt-3 pb-1">
                            <div class="h3 font-weight-bold">System Settings</div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Backend name:</label>
                                        <input type="text" class="form-control" name="backend_name" value="<?php echo $s_row['backend_name'];?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Backend URL:</label>
                                        <input type="text" class="form-control" name="backend_url" value="<?php echo $s_row['backend_url'];?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">App-Backend encryption key:</label>
                                        <input type="text" class="form-control" name="enc_key" value="<?php echo $s_row['enc_key'];?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">App package name:</label>
                                        <input type="text" class="form-control" name="package" value="<?php echo $s_row['package'];?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">App Debug :<span class="small text-danger mx-2">[keep it disabled]</span></label>
                                        <div class="form-selectgroup">
                                            <label class="form-selectgroup-item text-no-wrap">
                                                <input type="radio" name="debug" value="<?php if($s_row['debug']=='1'){ echo $s_row['debug'];}else{ echo '1';}?>" <?php if($s_row['debug']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                <span class="form-selectgroup-label">Enabled</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="radio" name="debug" value="<?php if($s_row['debug']=='0'){ echo $s_row['debug'];}else{ echo '0';}?>" <?php if($s_row['debug']=='0'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                <span class="form-selectgroup-label">Disabled</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-text my-4 text-cyan">App interactions</div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">In-app Currency name:</label>
                                        <input type="text" class="form-control" name="currency_name" value="<?php echo $s_row['currency_name'];?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">USD equivalent:</label>
                                        <input type="text" class="form-control" name="usd_eq" value="<?php echo $s_row['usd_eq'];?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">How much is 1 USD ? </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cash_to_points" value="<?php echo $s_row['cash_to_points'];?>">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Profit share from offers:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">you pay the user</span>
                                            <input type="text" class="form-control" name="pay_percent" value="<?php echo $s_row['pay_percent'];?>">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Who referred the user:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">will receieve</span>
                                            <input type="text" class="form-control" name="pay_referral" value="<?php echo $s_row['pay_referral'];?>">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Who entered referral code:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">will receieve</span>
                                            <input type="text" class="form-control" name="pay_referred" value="<?php echo $s_row['pay_referred'];?>">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Earning notification:</label>
                                        <div class="form-selectgroup">
                                            <label class="form-selectgroup-item text-no-wrap">
                                                <input type="radio" name="earning_notification" value="<?php if($s_row['earning_notification']=='1'){ echo $s_row['earning_notification'];}else{ echo '1';}?>" <?php if($s_row['earning_notification']=='1'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                <span class="form-selectgroup-label">Enabled</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="radio" name="earning_notification" value="<?php if($s_row['earning_notification']=='0'){ echo $s_row['earning_notification'];}else{ echo '0';}?>" <?php if($s_row['earning_notification']=='0'){ echo 'checked';}else{ }?> class="form-selectgroup-input">
                                                <span class="form-selectgroup-label">Disabled</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Balance syncing interval:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="balance_interval" value="<?php echo $s_row['balance_interval'];?>">
                                            <span class="input-group-text">seconds</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Follow us URL:</label>
                                        <input type="text" class="form-control" name="follow_us" placeholder="https://" value="<?php echo $s_row['follow_us'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="hr-text my-4 text-primary">Daily Leaderboard ranking system</div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Leaderboard ranking reward:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="leaderboard_reward" value="<?php echo $s_row['leaderboard_reward'];?>">
                                            <span class="input-group-text">coins per day</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">How many users will be ranked?</label>
                                        <div class="input-group">
                                               <?php if (!empty($s_row['ranked_users'])) { ?>
                                               <input id='lbl' type="text" class="form-control" name="ranked_users" value="<?php echo $s_row['ranked_users'];?>" readonly="">
                                               <?php }else{ ?>
                                               <input id='lbl' type="text" class="form-control" name="ranked_users">
                                               <?php } ?>
                                            
                                            <span class="input-group-text">users per day</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php if (has_module_access_edit($con, 'system_settings')): ?>
                            <div class="card-footer text-right">
                                <button type="submit" name="settings_update" class="btn btn-dark">Update system settings</button>
                            </div>
                        <?php endif; ?>
                        
                    </form>
                    <!--Update system settings end-->
                    
                    <!--Which game(s) you want to hide start-->
                    
                    <form class="card mt-3" method="post">
                         <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                        <div class="card-header d-flex pt-3 pb-1">
                            <div class="h3 font-weight-bold">Which game(s) you want to hide?</div>
                        </div>
                        <div class="card-body">
                            <?php
                                $admin_id = 1;
                                $as_query = "SELECT game_code FROM admin_settings WHERE admin_id='$admin_id'";
                                $as_res = mysqli_query($con, $as_query);
                                
                                $enabledGames = [];
                                while ($row = mysqli_fetch_assoc($as_res)) {
                                    $enabledGames[] = $row['game_code'];
                                }
                                
                                $allGames = [
                                    'sc' => 'Scratcher',
                                    'lo' => 'Lotto',
                                    'qz' => 'Quiz',
                                    'ip' => 'Image Puzzle',
                                    'gw' => 'Guess Word',
                                    'jp' => 'Jigsaw Puzzle',
                                    'to' => 'Tournament'
                                ];
                                ?>

                        <div class="row mt-2">
                            <?php foreach ($allGames as $value => $label): ?>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" name="game[]" value="<?= $value ?>" <?= in_array($value, $enabledGames) ? 'checked' : '' ?>>
                                            <span class="form-check-label"><?= $label ?></span>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>



                        </div>
                        <?php if (has_module_access_edit($con, 'system_settings')): ?>
                            <div class="card-footer">
                                <button type="submit" name="games_hide" class="btn btn-dark">Update</button>
                            </div>
                        <?php endif; ?>
                    </form>
                     <!--Which game(s) you want to hide end-->
                     
                </div>
                 
                 
                
                <form method="post" action="clear/system" class="modal modal-blur fade"
                    id="lbl-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">Daily leaderboard ranking</div>
                            <div id='modal-err'></div>
                            <div id="lbl-content" class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button id="modal-submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->