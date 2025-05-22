<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->
<?php 
if (isset($_POST['submit'])) {
    $token_id = $_POST['token_id'];
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
    
      mysqli_query($con, "INSERT INTO sdk (token_id, config_file) VALUES ('$token_id', '$image')");
      header('location:sdk.php');
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
                <div class="card">
                    <div class="card-header pt-2 pb-0">
                        <span class="h4 nav-link active font-weight-bold">SDK Offerwalls</span>
                    </div>
                    <div class="card-body row mt-2 pb-1">
                        <?php
                            $query = "SELECT * FROM sdk ORDER BY id DESC";
                            $cat_res = mysqli_query($con, $query);
                            $cat_arr = [];
                            while ($row = mysqli_fetch_assoc($cat_res)) {
                                $cat_arr[] = $row;
                            }

                            foreach ($cat_arr as $list) {
                        ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card bg-gray-lt">
                                <div class="card-header py-2">
                                    <img src="images/networks/<?php echo $list['config_file'];?>" class="rounded text-truncate img-thumbnail text-small avatar-md mr-2" alt="<?php echo $list['network_name'];?>">
                                    <h3 class="card-title text-dark"><?php echo $list['network_name'];?></h3>
                                    <div class="card-actions">
                                        <?php if (has_module_access_edit($con, 'sdk_offerwalls')): ?>
                                            <a href="networks_sdk_manage.php?id=<?php echo $list['id'];?>"> Edit configuration
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon ml-1" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                    <line x1="16" y1="5" x2="19" y2="8" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <dl class="row">
                                        <dt class="col-5 text-truncate text-dark h4 my-0">Status:</dt>
                                        <dd class="col-7 text-truncate text-muted h5">
                                            <?php if($list['enabled']==1){ ?>
                                             <span class="text-green">Enabled</span>
                                                <?php
                                            }elseif ($list['disabled']==2) { ?>
                                              <span class="text-red">Disabled</span>   
                                          <?php }?>
                                        </dd>
                                        <dt class="col-5 text-truncate text-dark h4 my-0">Postback URL:</dt>
                                        <dd class="col-7 text-muted h5 d-flex cevent">
                                            <div class="text-truncate cpy mr-1">
                                                https://reapbucks.com/api/pb/<?php echo $list['postback_url_secret_key'];?>/<?php echo $list['network_slug'];?></div>
                                            <span class="copy-event cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md text-dark"
                                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                                    <rect x="8" y="8" width="12" height="12" rx="2"></rect>
                                                    <path
                                                        d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2">
                                                    </path>
                                                </svg>
                                            </span>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                         <?php } ?>
                        
                         <?php if (has_module_access_insert($con, 'sdk_offerwalls')): ?>
                            <div class="col-lg-4 col-md-6 col-12 pb-4">
                                <form class="card bg-gray-lt mb-0" enctype="multipart/form-data" method="post">
                                     <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                                    <div class="card-body m-0 py-2">
                                        <p class="h3 text-black mb-2">Add a Network</p>
                                        <div class="form-file mb-2">
                                            <input type="file" name="config_file" class="form-file-input config-input" id="configfile">
                                            <label class="form-file-label" for="configFile">
                                                <span class="form-file-text config-choose">Upload config file...</span>
                                                <span class="form-file-button">Browse</span>
                                            </label>
                                        </div>
                                        <div class="mb-1">
                                            <input type="submit" name="submit" class="btn btn-dark" value="Upload" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                        
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