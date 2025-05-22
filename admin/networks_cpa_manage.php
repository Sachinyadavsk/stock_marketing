<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php

$network_name ='';
$offer_api_url ='';
$offer_api_auth ='';
$offerwall_description ='';
$offerwall_type ='';
$json_array_key ='';
$offer_id_key ='';
$offer_title_key ='';
$offer_description_key ='';
$reward_amount_key ='';
$icon_url_key ='';
$offer_url_key ='';
$offer_url_suffix ='';
$enabled = '';
$postback_method_key ='';
$postback_payload_key ='';
$postback_type_key ='';
$postback_exchange ='';
$postback_url_secret_key ='';
$postback_reward_amount_key ='';
$postback_user_id_key ='';
$postback_offer_id_key ='';
$postback_ip_address_key ='';
$verify ='';
$image ='';
$msg ='';
$color_class ='';

if (isset($_GET['id']) && $_GET['id'] != '') {
    
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM cpa WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $network_name  = $row['network_name'];
        $offer_api_url  = $row['offer_api_url'];
        $offer_api_auth  = $row['offer_api_auth'];
        $offerwall_description = $row['offerwall_description'];
        $offerwall_type = $row['offerwall_type'];
        $json_array_key = $row['json_array_key'];
        $offer_id_key  = $row['offer_id_key'];
        $offer_title_key = $row['offer_title_key'];
        $offer_description_key = $row['offer_description_key'];
        $reward_amount_key = $row['reward_amount_key'];
        $icon_url_key = $row['icon_url_key'];
        $offer_url_key = $row['offer_url_key'];
        $offer_url_suffix = $row['offer_url_suffix'];
        $enabled = $row['enabled'];
        $postback_method_key = $row['postback_method_key'];
        $postback_payload_key = $row['postback_payload_key'];
        $postback_type_key = $row['postback_type_key'];
        $postback_exchange = $row['postback_exchange'];
        $postback_url_secret_key  = $row['postback_url_secret_key'];
        $postback_reward_amount_key  = $row['postback_reward_amount_key'];
        $postback_user_id_key = $row['postback_user_id_key'];
        $postback_offer_id_key = $row['postback_offer_id_key'];
        $postback_ip_address_key = $row['postback_ip_address_key'];
        $verify = $row['verify'];
        $image = $row['image_file'];
    } else {
        header('location:create_thema_layout.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $token_id = $_POST['token_id'];
   
    // File upload
    $media_file_name = '';
    if (!empty($_FILES['network_image']['name'])) {
        $target_dir = "images/networks/";
        $media_file_name = time() . '_' . basename($_FILES["network_image"]["name"]);
        $target_file = $target_dir . $media_file_name;
        move_uploaded_file($_FILES["network_image"]["tmp_name"], $target_file);
    }

    $network_name = isset($_POST['network_name']) ? $_POST['network_name'] : '';
    $offer_api_url = isset($_POST['offer_api_url']) ? $_POST['offer_api_url'] : '';
    $offer_api_auth = isset($_POST['offer_api_auth']) ? $_POST['offer_api_auth'] : '';
    $offerwall_description = isset($_POST['offerwall_description']) ? $_POST['offerwall_description'] : '';
    $offerwall_type = isset($_POST['offerwall_type']) ? $_POST['offerwall_type'] : '';
    $json_array_key = isset($_POST['json_array_key']) ? $_POST['json_array_key'] : '';
    $offer_id_key = isset($_POST['offer_id_key']) ? $_POST['offer_id_key'] : '';
    $offer_title_key = isset($_POST['offer_title_key']) ? $_POST['offer_title_key'] : '';
    $offer_description_key = isset($_POST['offer_description_key']) ? $_POST['offer_description_key'] : '';
    $reward_amount_key = isset($_POST['reward_amount_key']) ? $_POST['reward_amount_key'] : '';
    $icon_url_key = isset($_POST['icon_url_key']) ? $_POST['icon_url_key'] : '';
    $offer_url_key = isset($_POST['offer_url_key']) ? $_POST['offer_url_key'] : '';
    $offer_url_suffix = isset($_POST['offer_url_suffix']) ? $_POST['offer_url_suffix'] : '';
    $enabled = isset($_POST['enabled']) ? $_POST['enabled'] : '';
    $postback_method_key = isset($_POST['postback_method_key']) ? $_POST['postback_method_key'] : '';
    $postback_payload_key = isset($_POST['postback_payload_key']) ? $_POST['postback_payload_key'] : '';
    $postback_type_key = isset($_POST['postback_type_key']) ? $_POST['postback_type_key'] : '';
    $postback_exchange = isset($_POST['postback_exchange']) ? $_POST['postback_exchange'] : '';
    $postback_url_secret_key = isset($_POST['postback_url_secret_key']) ? $_POST['postback_url_secret_key'] : '';
    $postback_reward_amount_key = isset($_POST['postback_reward_amount_key']) ? $_POST['postback_reward_amount_key'] : '';
    $postback_user_id_key = isset($_POST['postback_user_id_key']) ? $_POST['postback_user_id_key'] : '';
    $postback_offer_id_key = isset($_POST['postback_offer_id_key']) ? $_POST['postback_offer_id_key'] : '';
    $postback_ip_address_key = isset($_POST['postback_ip_address_key']) ? $_POST['postback_ip_address_key'] : '';
    $verify = isset($_POST['verify']) ? $_POST['verify'] : '';
    
    $res = mysqli_query($con, "SELECT * FROM cpa WHERE network_name='$network_name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
                // Allowed to proceed for update
            } else {
                $msg = "CPA Network already exists";
                $color_class = "alert-danger";
            }
        } else {
            $msg = "CPA Network already exists";
            $color_class = "alert-danger";
        }
    }

      if ($msg == '') {
          
          if (isset($_FILES['network_image']['name']) && $_FILES['network_image']['name'] != '') {
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                $file_name = $_FILES['network_image']['name'];
                $file_tmp = $_FILES['network_image']['tmp_name'];
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
                    $update_sql = "UPDATE cpa SET token_id='$token_id', network_name='$network_name', offer_api_url='$offer_api_url', offer_api_auth='$offer_api_auth',
                    offerwall_description='$offerwall_description', offerwall_type='$offerwall_type', json_array_key='$json_array_key', offer_id_key='$offer_id_key',
                    offer_title_key='$offer_title_key', offer_description_key='$offer_description_key', reward_amount_key='$reward_amount_key', icon_url_key='$icon_url_key',
                    offer_url_key='$offer_url_key', offer_url_suffix='$offer_url_suffix', enabled='$enabled', postback_method_key='$postback_method_key',
                    postback_payload_key='$postback_payload_key', postback_type_key='$postback_type_key', postback_exchange='$postback_exchange', postback_url_secret_key='$postback_url_secret_key',
                    postback_reward_amount_key='$postback_reward_amount_key', postback_user_id_key='$postback_user_id_key', postback_offer_id_key='$postback_offer_id_key',
                    postback_ip_address_key='$postback_ip_address_key', verify='$verify', network_image='$image', WHERE id='$id'";
                } else {
                     $update_sql = "UPDATE cpa SET token_id='$token_id', network_name='$network_name', offer_api_url='$offer_api_url', offer_api_auth='$offer_api_auth',
                    offerwall_description='$offerwall_description', offerwall_type='$offerwall_type', json_array_key='$json_array_key', offer_id_key='$offer_id_key',
                    offer_title_key='$offer_title_key', offer_description_key='$offer_description_key', reward_amount_key='$reward_amount_key', icon_url_key='$icon_url_key',
                    offer_url_key='$offer_url_key', offer_url_suffix='$offer_url_suffix', enabled='$enabled', postback_method_key='$postback_method_key',
                    postback_payload_key='$postback_payload_key', postback_type_key='$postback_type_key', postback_exchange='$postback_exchange', postback_url_secret_key='$postback_url_secret_key',
                    postback_reward_amount_key='$postback_reward_amount_key', postback_user_id_key='$postback_user_id_key', postback_offer_id_key='$postback_offer_id_key',
                    postback_ip_address_key='$postback_ip_address_key', verify='$verify' WHERE id='$id'";
                }
                mysqli_query($con, $update_sql);
            } else {
                 mysqli_query($con, "INSERT INTO cpa (token_id, network_name, offer_api_url, offer_api_auth, offerwall_description, offerwall_type, json_array_key, offer_id_key,
                    offer_title_key, offer_description_key, reward_amount_key, icon_url_key, offer_url_key, offer_url_suffix, network_image, enabled, postback_method_key, postback_payload_key,
                    postback_type_key, postback_exchange, postback_url_secret_key, postback_reward_amount_key, postback_user_id_key, postback_offer_id_key, postback_ip_address_key, 
                    verify, image_file, created_at)
                        VALUES ('$token_id', '$network_name', '$offer_api_url', '$offer_api_auth', '$offerwall_description', '$offerwall_type', '$json_array_key', '$offer_id_key',
                    '$offer_title_key', '$offer_description_key', '$reward_amount_key', '$icon_url_key', '$offer_url_key', '$offer_url_suffix', '$image', '$enabled', '$postback_method_key', 
                    '$postback_payload_key', '$postback_type_key', '$postback_exchange', '$postback_url_secret_key', '$postback_reward_amount_key', '$postback_user_id_key', 
                    '$postback_offer_id_key', '$postback_ip_address_key', '$verify', '$media_file_name', '$created_at')");
                  header('location:cpa.php');
                  die();
            }
      }
}

// delete cps

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from cpa where id='$id'";
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
                       
                          <?php if (!empty($image)) { ?>
                             <div class="card-header bg-dark-lt h3 text-dark bold pt-2 pb-2">
                                <img src="images/networks/<?php echo $image;?>" class="rounded text-truncate img-thumbnail text-small avatar-md mr-2" alt="<?php echo $network_name;?>">
                               <?php echo $network_name;?>
                            </div>
                          <?php }else{ ?>
                          <div class="card-header bg-dark-lt h3 text-dark bold">Add a Network - API</div>
                          <?php } ?>
                        
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <span class="bold mr-2">Allowed macros from App are:</span>
                                <span class="text-nowrap mr-2"><span class="text-red">[app_uid]</span> = for User ID</span>
                                <span class="text-nowrap mr-2"><span class="text-red">[app_country]</span> = for country ISO</span>
                                <span class="text-nowrap mr-2"><span class="text-red">[app_country_alt]</span> = for country ISO in uppercase</span>
                                <span class="text-nowrap mr-2"><span class="text-red">[app_ip]</span> = for user's IP</span>
                                <span class="text-nowrap mr-2"><span class="text-red">[app_gaid]</span> = for GAID</span>
                                <span class="text-nowrap mr-2"><span class="text-red">_payload_</span> = suffix for URL param to load in payload</span>
                                <span class="text-nowrap"><span class="text-red">apipost=1</span> = add this at the end of the url for POST method</span>
                            </div>
                            
                            <!--form field-->
                            
                            <div class="row">
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Network name:</label>
                                    <input type="text" class="form-control" name="network_name" placeholder="CPALead" value="<?php echo $network_name;?>">
                                </div>
                                
                                <div class="col col-lg-6 col-md-5 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Offer API URL:</label>
                                    <input type="text" class="form-control" name="offer_api_url" placeholder="https://www.cpalead.com/dashboard/reports/campaign_json_load_offers.php?format=json&incentive=y&id=814901&device=android&payout_type=cpi&&country=[app_country]&&aff_sub5=[app_uid]" value="<?php echo $offer_api_url;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Header <small>(if any)</small>:</label>
                                    <input type="text" class="form-control" name="offer_api_auth" placeholder="Authorization:Bearer 123478sad6fas878" value="<?php echo $offer_api_auth;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Offerwall description:</label>
                                    <input type="text" class="form-control" name="offerwall_description" placeholder="Write a description..." value="<?php echo $offerwall_description;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Offers type</label>
                                    <div class="form-selectgroup">
                                        
                                        <label class="form-selectgroup-item text-no-wrap">
                                            <input type="radio" name="offerwall_type" value="<?php if($offerwall_type=='1'){ echo $offerwall_type;}else{ echo '1';}?>" class="form-selectgroup-input"  <?php if($offerwall_type=='1'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">CPI Offer</span>
                                        </label>
                                        
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="offerwall_type" value="<?php if($offerwall_type=='2'){ echo $offerwall_type;}else{ echo '2';}?>" class="form-selectgroup-input" <?php if($offerwall_type=='2'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">CPA Offers</span>
                                        </label>
                                        
                                    </div>
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Name of <span class="text-dark bold">JSON Array</span> key:</label>
                                    <input type="text" class="form-control" name="json_array_key" placeholder="offers" value="<?php echo $json_array_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Name of <span class="text-dark bold">Offer ID</span> key:</label>
                                    <input type="text" class="form-control" name="offer_id_key" placeholder="campid" value="<?php echo $offer_id_key;?>">
                                </div>
                            
                            
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Name of <span class="text-dark bold">Offer Title</span> key:</label>
                                    <input type="text" class="form-control" name="offer_title_key" placeholder="title" value="<?php echo $offer_title_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Name of <span class="text-dark bold">Offer Description</span> key:</label>
                                    <input type="text" class="form-control" name="offer_description_key" placeholder="description" value="<?php echo $offer_description_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Name of <span class="text-dark bold">Reward Amount</span> key:</label>
                                    <input type="text" class="form-control" name="reward_amount_key" placeholder="amount"  value="<?php echo $reward_amount_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Name of <span class="text-dark bold">Icon URL</span> key:</label>
                                    <input type="text" class="form-control" name="icon_url_key" placeholder="mobile_app_icon_url" value="<?php echo $icon_url_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Name of <span class="text-dark bold">Offer URL</span> key:</label>
                                    <input type="text" class="form-control" name="offer_url_key" placeholder="link"  value="<?php echo $offer_url_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Offer URL suffix (if any):</label>
                                    <input type="text" class="form-control" name="offer_url_suffix" placeholder="&sid=[app_uid]" value="<?php echo $offer_url_suffix;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <div class="form-label">Network logo:</div>
                                    <div class="form-file">
                                        <input type="file" name="network_image" class="form-file-input img-input" id="imagefile">
                                        <label class="form-file-label" for="customFile">
                                            <span class="form-file-text img-choose">Choose image...</span>
                                            <span class="form-file-button">Browse</span>
                                        </label>
                                         <?php if (!empty($image)) { ?>
                                            <a href="images/networks/<?php echo $image; ?>" target="_blank">View Image</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Offerwall availability</label>
                                    <div class="form-selectgroup">
                                        <label class="form-selectgroup-item text-no-wrap">
                                            <input type="radio" name="enabled" value="<?php if($enabled=='1'){ echo $enabled;}else{ echo '1';}?>" class="form-selectgroup-input"  <?php if($enabled=='1'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">Enable</span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="enabled" value="<?php if($enabled=='2'){ echo $enabled;}else{ echo '2';}?>" class="form-selectgroup-input"  <?php if($enabled=='2'){ echo 'checked';}else{ }?>>
                                            <span class="form-selectgroup-label">Disable</span>
                                        </label>
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
                                    <input type="text" class="form-control" name="postback_url_secret_key" placeholder="ANY_ALPHANUMERIC_CHARS" value="<?php echo $postback_url_secret_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label text-truncate">Parameter for <span
                                            class="text-dark bold">Reward Amount:</span></label>
                                    <input type="text" class="form-control" name="postback_reward_amount_key" placeholder="payout={payout}" value="<?php echo $postback_reward_amount_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Parameter for <span class="text-dark bold">User ID:</span></label>
                                    <input type="text" class="form-control" name="postback_user_id_key" placeholder="userid={subid}" value="<?php echo $postback_user_id_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Parameter for <span class="text-dark bold">Offer ID:</span></label>
                                    <input type="text" class="form-control" name="postback_offer_id_key" placeholder="offer_id={campaign_id}" value="<?php echo $postback_offer_id_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Parameter for <span class="text-dark bold">IP address:</span></label>
                                    <input type="text" class="form-control" name="postback_ip_address_key" placeholder="ip={ip_address}" value="<?php echo $postback_ip_address_key;?>">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Parameter for verification <span class="text-danger h5">(if requires)</span>:</label>
                                    <input type="text" class="form-control" name="verify" value="<?php echo $verify;?>">
                                </div>
                                
                            </div>
                            
                            <?php if (!empty($network_name)) { ?>
                                <div class="d-flex flex-row-reverse mt-4">
                                     <?php if (has_module_access_edit($con, 'api_offerwalls')): ?>
                                         <input type="submit" name="submit" class="btn btn-dark" value="Update Ad Network">
                                      <?php endif; ?>
                                    <a href="networks_cpa_manage.php?id=<?php echo $id;?>" class="btn btn-white mr-4">Cancel</a>
                                        <?php if (has_module_access_delete($con, 'api_offerwalls')): ?>
                                           <a href="?type=delete&id=<?php echo $id;?>" class="btn btn-outline-danger mr-4">Delete Network</a>
                                        <?php endif; ?>
                                </div>
                                
                            <?php }else{ ?>
                                 <div class="d-flex flex-row-reverse mt-4">
                                        <?php if (has_module_access_insert($con, 'api_offerwalls')): ?>
                                           <input type="submit" name="submit" class="btn btn-primary" value="Create Ad Network" />
                                        <?php endif; ?>
                                    <a href="networks_cpa_manage.php" class="btn btn-white mr-4">Cancel</a>
                                </div>
                             <?php } ?>
                           
                        </div>
                    </form>
                    <!--    </?php if (!empty($msg)): ?>-->
                    <!--    <div class="alert </?php echo $color_class; ?>">-->
                    <!--        </?php echo $msg; ?>-->
                    <!--    </div>-->
                    <!--</?php endif; ?>-->
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