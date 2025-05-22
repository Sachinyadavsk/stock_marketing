<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php

$network_name ='';
$offerwall_description ='';
$network_slug ='';
$config_file ='';
$enabled ='';
$sdk_key ='';
$placement_name ='';
$postback_method_key ='';
$postback_payload_key ='';
$postback_type_key ='';
$postback_exchange ='';
$postback_url_secret_key ='';
$postback_reward_amount_key ='';
$parameter_user_id ='';
$parameter_offer_id ='';
$parameter_ip_address ='';
$verify ='';
$msg ='';
$color_class ='';

if (isset($_GET['id']) && $_GET['id'] != '') {
    
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM sdk WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $network_name = $row['network_name'];
        $offerwall_description = $row['offerwall_description'];
        $network_slug = $row['network_slug'];
        $config_file = $row['config_file'];
        $enabled = $row['enabled'];
        $sdk_key = $row['sdk_key'];
        $placement_name = $row['placement_name'];
        $postback_method_key = $row['postback_method_key'];
        $postback_payload_key = $row['postback_payload_key'];
        $postback_type_key = $row['postback_type_key'];
        $postback_exchange = $row['postback_exchange'];
        $postback_url_secret_key = $row['postback_url_secret_key'];
        $postback_reward_amount_key = $row['postback_reward_amount_key'];
        $parameter_user_id = $row['parameter_user_id'];
        $parameter_offer_id = $row['parameter_offer_id'];
        $parameter_ip_address = $row['parameter_ip_address'];
        $verify = $row['verify'];
    } else {
        header('location:sdk.php');
        die();
    }
}


if (isset($_POST['submit'])) {
    $token_id = $_POST['token_id'];
   
    // File upload
    // $media_file_name = '';
    // if (!empty($_FILES['config_file']['name'])) {
    //     $target_dir = "images/networks/";
    //     $media_file_name = time() . '_' . basename($_FILES["config_file"]["name"]);
    //     $target_file = $target_dir . $media_file_name;
    //     move_uploaded_file($_FILES["config_file"]["tmp_name"], $target_file);
    // }


        $network_name = isset($_POST['network_name']) ? $_POST['network_name'] : '';
        $offerwall_description = isset($_POST['offerwall_description']) ? $_POST['offerwall_description'] : '';
        $network_slug = isset($_POST['network_slug']) ? $_POST['network_slug'] : '';
        $enabled = isset($_POST['enabled']) ? $_POST['enabled'] : '';
        $sdk_key = isset($_POST['sdk_key']) ? $_POST['sdk_key'] : '';
        $placement_name = isset($_POST['placement_name']) ? $_POST['placement_name'] : '';
        $postback_method_key = isset($_POST['postback_method_key']) ? $_POST['postback_method_key'] : '';
        $postback_payload_key = isset($_POST['postback_payload_key']) ? $_POST['postback_payload_key'] : '';
        $postback_type_key = isset($_POST['postback_type_key']) ? $_POST['postback_type_key'] : '';
        $postback_exchange = isset($_POST['postback_exchange']) ? $_POST['postback_exchange'] : '';
        $postback_url_secret_key = isset($_POST['postback_url_secret_key']) ? $_POST['postback_url_secret_key'] : '';
        $postback_reward_amount_key = isset($_POST['postback_reward_amount_key']) ? $_POST['postback_reward_amount_key'] : '';
        $parameter_user_id = isset($_POST['parameter_user_id']) ? $_POST['parameter_user_id'] : '';
        $parameter_offer_id = isset($_POST['parameter_offer_id']) ? $_POST['parameter_offer_id'] : '';
        $parameter_ip_address = isset($_POST['parameter_ip_address']) ? $_POST['parameter_ip_address'] : '';
        $verify = isset($_POST['verify']) ? $_POST['verify'] : '';
    
    $res = mysqli_query($con, "SELECT * FROM sdk WHERE network_name='$network_name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
                // Allowed to proceed for update
            } else {
                $msg = "SDK Network already exists";
                $color_class = "alert-danger";
            }
        } else {
            $msg = "SDK Network already exists";
            $color_class = "alert-danger";
        }
    }

      if ($msg == '') {
          
          if (isset($_FILES['config_file']['name']) && $_FILES['config_file']['name'] != '') {
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                $file_name = $_FILES['config_file']['name'];
                $file_tmp = $_FILES['config_file']['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
                if (in_array($file_ext, $allowed_types)) {
                    $new_file_name = time() . '_' . $file_name;
                    $file_path = 'images/networks/' . $new_file_name;
                    move_uploaded_file($file_tmp, $file_path);
                    $image = $new_file_name;
                } else {
                    $msg = "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
                }
            }
            
            
          if (isset($_GET['id']) && $_GET['id'] != '') {
                if ($image != '') {
                    $update_sql = "UPDATE sdk SET token_id='$token_id', network_name='$network_name', offerwall_description='$offerwall_description', network_slug='$network_slug',
                    enabled='$enabled', sdk_key='$sdk_key', placement_name='$placement_name', postback_method_key='$postback_method_key', postback_payload_key='$postback_payload_key',
                    postback_type_key='$postback_type_key', postback_exchange='$postback_exchange', postback_url_secret_key='$postback_url_secret_key',
                    postback_reward_amount_key='$postback_reward_amount_key', parameter_user_id='$parameter_user_id', parameter_offer_id='$parameter_offer_id', 
                    parameter_ip_address='$parameter_ip_address', verify='$verify', config_file='$image' WHERE id='$id'";
                } else {
                     $update_sql = "UPDATE sdk SET token_id='$token_id', network_name='$network_name', offerwall_description='$offerwall_description', network_slug='$network_slug',
                    enabled='$enabled', sdk_key='$sdk_key', placement_name='$placement_name', postback_method_key='$postback_method_key', postback_payload_key='$postback_payload_key',
                    postback_type_key='$postback_type_key', postback_exchange='$postback_exchange', postback_url_secret_key='$postback_url_secret_key',
                    postback_reward_amount_key='$postback_reward_amount_key', parameter_user_id='$parameter_user_id', parameter_offer_id='$parameter_offer_id', 
                    parameter_ip_address='$parameter_ip_address', verify='$verify' WHERE id='$id'";
                }
                mysqli_query($con, $update_sql);
            } else {
                 mysqli_query($con, "INSERT INTO sdk (token_id, network_name, offerwall_description, network_slug, enabled, sdk_key, placement_name, postback_method_key, postback_payload_key,
                    postback_type_key, postback_exchange, postback_url_secret_key, postback_reward_amount_key, parameter_user_id, parameter_offer_id, parameter_ip_address, verify, config_file)
                        VALUES ('$token_id', '$network_name', '$offerwall_description', '$network_slug', '$enabled', '$sdk_key', '$placement_name', '$postback_method_key', '$postback_payload_key',
                    '$postback_type_key', '$postback_exchange', '$postback_url_secret_key', '$postback_reward_amount_key', '$parameter_user_id', '$parameter_offer_id', '$parameter_ip_address', '$verify',
                    '$config_file')");
                  header('location:sdk.php');
                  die();
            }
      }
}

// delete cps

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from sdk where id='$id'";
		mysqli_query($con,$delete_sql);
	}
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
                <div class="row card">
                    <form class="p-0" method="post" enctype="multipart/form-data">
                       <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                           <?php if (!empty($id)) { ?>
                             <div class="card-header bg-dark-lt h3 text-dark bold pt-2 pb-2">
                                <img src="images/networks/<?php echo $config_file;?>" class="rounded text-truncate img-thumbnail text-small avatar-md mr-2" alt="<?php echo $network_name;?>">
                               <?php echo $network_name;?>
                            </div>
                          <?php }else{ ?>
                          <div class="card-header bg-dark-lt h3 text-dark bold">Add a Network - API</div>
                          <?php } ?>
                          
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Network name:</label>
                                    <input type="text" class="form-control" name="network_name" value="<?php echo $network_name;?>" required>
                                </div>
                                <div class="col col-md-8 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Offerwall description:</label>
                                    <input type="text" class="form-control" name="offerwall_description" value="<?php echo $offerwall_description;?>" required>
                                </div>
                                
                                  <?php if (!empty($network_slug)) { ?>
                                    <div class="col col-md-4 col-sm-6 col-12 mb-3">
                                        <label class="form-label">Network slug</small>:</label>
                                        <input type="text" class="form-control" name="network_slug" value="<?php echo $network_slug;?>" readonly>
                                    </div>
                                <?php }else{?>
                                 <div class="col col-md-4 col-sm-6 col-12 mb-3">
                                        <label class="form-label">Network slug</small>:</label>
                                        <input type="text" class="form-control" name="network_slug" value="<?php echo $network_slug;?>" required>
                                    </div>
                                <?php } ?>
                                
                                <div class="col col-md-4 col-sm-6 col-12 mb-3">
                                    <div class="form-label">Network logo:</div>
                                    <div class="form-file">
                                        <input type="file" name="config_file" class="form-file-input img-input" id="configfile">
                                        <label class="form-file-label" for="configFile">
                                            <span class="form-file-text img-choose">Choose image...</span>
                                            <span class="form-file-button">Browse</span>
                                        </label>
                                        <?php if (!empty($config_file)) { ?>
                                            <a href="images/networks/<?php echo $config_file; ?>" target="_blank">View Image</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Offerwall availability</label>
                                    <div class="form-selectgroup">
                                        <label class="form-selectgroup-item text-no-wrap">
                                            <input type="radio" name="enabled" value="<?php if($enabled=='1'){ echo $enabled;}else{ echo '1';}?>" class="form-selectgroup-input" <?php if($enabled=='1'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">Enable</span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="enabled" value="<?php if($enabled=='2'){ echo $enabled;}else{ echo '2';}?>" class="form-selectgroup-input" <?php if($enabled=='2'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">Disable</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <input type="text" class="form-control" value="SDK Key" readonly>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="sdk_key" value="<?php echo $sdk_key;?>">
                                    </div>
                                </div>
                                
                                
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <input type="text" class="form-control" value="Placement name" readonly>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="placement_name" value="<?php echo $placement_name;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="hr-text mt-4 mb-3 text-blue hr-text-left bold">Postback Setup</div>
                            <div class="row">
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Postback method:</label>
                                    <div class="form-selectgroup">
                                        <label class="form-selectgroup-item text-no-wrap">
                                            <input type="radio" name="postback_method_key" value="<?php if($postback_method_key=='2'){ echo $postback_method_key;}else{ echo '2';}?>" class="form-selectgroup-input" <?php if($postback_method_key=='2'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">GET</span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="postback_method_key" value="<?php if($postback_method_key=='1'){ echo $postback_method_key;}else{ echo '1';}?>" class="form-selectgroup-input" <?php if($postback_method_key=='1'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">POST</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Data in payload?</label>
                                    <div class="form-selectgroup">
                                        <label class="form-selectgroup-item text-no-wrap">
                                            <input type="radio" name="postback_payload_key" value="<?php if($postback_payload_key=='1'){ echo $postback_payload_key;}else{ echo '1';}?>" class="form-selectgroup-input" <?php if($postback_payload_key=='1'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">Yes</span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="postback_payload_key" value="<?php if($postback_payload_key=='2'){ echo $postback_payload_key;}else{ echo '2';}?>" class="form-selectgroup-input" <?php if($postback_payload_key=='2'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Parameters visible in URL?</label>
                                    <div class="form-selectgroup">
                                        <label class="form-selectgroup-item text-no-wrap">
                                            <input type="radio" name="postback_type_key" value="<?php if($postback_type_key=='1'){ echo $postback_type_key;}else{ echo '1';}?>" class="form-selectgroup-input" <?php if($postback_type_key=='1'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">Visible</span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="postback_type_key" value="<?php if($postback_type_key=='2'){ echo $postback_type_key;}else{ echo '2';}?>" class="form-selectgroup-input" <?php if($postback_type_key=='2'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">Hidden</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Who will manage exchange rate?</label>
                                    <div class="form-selectgroup">
                                        <label class="form-selectgroup-item text-no-wrap">
                                            <input type="radio" name="postback_exchange" value="<?php if($postback_exchange=='1'){ echo $postback_exchange;}else{ echo '1';}?>" class="form-selectgroup-input" <?php if($postback_exchange=='1'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">Backend</span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="postback_exchange" value="<?php if($postback_exchange=='2'){ echo $postback_exchange;}else{ echo '2';}?>" class="form-selectgroup-input" <?php if($postback_exchange=='2'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">Ad Network</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">URL Secret:</label>
                                    <input type="text" class="form-control" name="postback_url_secret_key" value="<?php echo $postback_url_secret_key;?>" required>
                                </div>
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label text-truncate">Parameter for 
                                    <span class="text-dark bold">Reward Amount:</span></label>
                                    <input type="text" class="form-control" name="postback_reward_amount_key" value="<?php echo $postback_reward_amount_key;?>" required>
                                </div>
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Parameter for <span class="text-dark bold">User ID:</span></label>
                                    <?php if (!empty($parameter_user_id)) { ?>
                                        <input type="text" class="form-control" name="parameter_user_id" value="<?php echo $parameter_user_id;?>" readonly>
                                    <?php }else{ ?>
                                        <input type="text" class="form-control" name="parameter_user_id" value="<?php echo $parameter_user_id;?>">
                                    <?php } ?>
                                </div>
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Parameter for <span class="text-dark bold">Offer ID:</span></label>
                                    
                                     <?php if (!empty($parameter_offer_id)) { ?>
                                           <input type="text" class="form-control" name="parameter_offer_id" value="<?php echo $parameter_offer_id;?>" readonly>
                                     <?php }else{ ?>
                                           <input type="text" class="form-control" name="parameter_offer_id" value="<?php echo $parameter_offer_id;?>">
                                      <?php } ?>
                                    
                                </div>
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Parameter for <span class="text-dark bold">IP address:</span></label>
                                    
                                    <?php if (!empty($parameter_ip_address)) { ?>
                                           <input type="text" class="form-control" name="parameter_ip_address" value="<?php echo $parameter_ip_address;?>" readonly>
                                     <?php }else{ ?>
                                           <input type="text" class="form-control" name="parameter_ip_address" value="<?php echo $parameter_ip_address;?>">
                                      <?php } ?>
                                    
                                </div>
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Parameter for verification <span class="text-danger h5">(if requires)</span>:</label>
                                    <input type="text" class="form-control" name="verify" value="<?php echo $verify;?>" required>
                                </div>
                                
                            </div>
                            <div class="d-flex flex-row-reverse mt-4">
                                 <?php if (has_module_access_edit($con, 'sdk_offerwalls')): ?>
                                    <input type="submit" name="submit" class="btn btn-dark" value="Update Ad Network" />
                                <?php endif; ?>
                                
                                <a href="networks_sdk_manage.php?id=<?php echo $id;?>" class="btn btn-white mr-4">Cancel</a>
                              
                                 <?php if (has_module_access_delete($con, 'sdk_offerwalls')): ?>
                                    <a href="?type=delete&id=<?php echo $id;?>" class="btn btn-outline-danger mr-4">Delete Network</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
    <script>
        function closeMe(element) {
            $(element).parent().remove();
        }

        function addMore() {
            var container = $('#list');
            var item = container.find('.default').clone();
            item.removeClass('default');
            item.appendTo(container).show();
        }
        $('.img-input').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $(this).closest('.form-file').find('.img-choose').addClass("selected").text(fileName);
        });

    </script>

    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->