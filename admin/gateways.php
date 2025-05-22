<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php 
$msg ='';
$color_class ='';

if (isset($_POST['submit'])) {
    $token_id = $_POST['token_id'];
   
    // File upload
    $media_file_name = '';
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "images/networks/";
        $media_file_name = time() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $media_file_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $input_desc = isset($_POST['input_desc']) ? $_POST['input_desc'] : '';
    $input_type = isset($_POST['input_type']) ? $_POST['input_type'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
       
    $res = mysqli_query($con, "SELECT * FROM giftcard WHERE name='$name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
                // Allowed to proceed for update
            } else {
                $msg = "gift card already exists";
                $color_class = "alert-danger";
            }
        } else {
            $msg = "gift card already exists";
            $color_class = "alert-danger";
        }
    }

      if ($msg == '') {
          
        mysqli_query($con, "INSERT INTO giftcard (token_id, name, input_desc, input_type, country, image_file) VALUES ('$token_id', '$name', '$input_desc', '$input_type', '$country', '$media_file_name')");
        header('location:gateways.php');
        die();
            
      }
}

// delete
if (isset($_POST['gateways_del'])) {
    $id=get_safe_value($con,$_POST['id']);
	$delete_sql="delete from giftcard where id='$id'";
	mysqli_query($con,$delete_sql);
}

// edit

if (isset($_POST['gateways_edit'])) {
     $id=get_safe_value($con,$_POST['id']);
     $name = isset($_POST['name']) ? $_POST['name'] : '';
     $input_desc = isset($_POST['input_desc']) ? $_POST['input_desc'] : '';
     $input_type = isset($_POST['input_type']) ? $_POST['input_type'] : '';
     $country = isset($_POST['country']) ? $_POST['country'] : '';
    
      if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
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
        
       if ($image != '') {
            $update_sql = "UPDATE giftcard SET name='$name', input_desc='$input_desc', input_type='$input_type', country='$country', image_file='$image', WHERE id='$id'";
        } else {
            $update_sql = "UPDATE giftcard SET name='$name', input_desc='$input_desc', input_type='$input_type', country='$country' WHERE id='$id'";
        }
        mysqli_query($con, $update_sql);
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
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h2 class="page-title">Gateway Setup</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    <!--insert the giftcard start-->
                    <form class="col-xl-4 col-md-5 col-sm-12" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                        <div class="card">
                            <div class="card-header bg-gray-lt pt-3 pb-2">
                                <h4 class="text-dark">Add gift category</h4>
                            </div>
                            <div class="card-body pt-2 row">
                                <div class="mb-3">
                                    <label class="form-label">Gift category name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Amazon Gift Card">
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Item image</div>
                                    <div class="form-file">
                                        <input type="file" name="image" class="form-file-input modal-img-input" id="customFile">
                                        <label class="form-file-label" for="customFile">
                                            <span class="form-file-text modal-img-choose">Choose an image...</span>
                                            <span class="form-file-button">Browse</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirmation dialog text:</label>
                                    <input type="text" class="form-control" name="input_desc" placeholder="Enter your email address to receive the gift card">
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Input box type:</div>
                                    <select class="form-select" name="input_type">
                                        <option value="1">Text</option>
                                        <option value="2" selected>Email</option>
                                        <option value="3">Number</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label" name="country">For countries:</label>
                                    <input type="text" class="form-control" name="country" placeholder="Amazon GC">
                                </div>
                            </div>
                            
                             <?php if (has_module_access_insert($con, 'withdrawal_setup')): ?>
                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn btn-dark">Add this item</button>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                    </form>
                    <!--insert the giftcard end-->
                    
                    <div class="col-lg-8 col-md-7 col-sm-12">
                        <div class="alert alert-info">Click on a category to administer its items.</div>
                        <div class="alert alert-danger">Do not add any real-world currency in this gift category.</div>
                        <div class="row">
                            
                            <!--dynmically gateway setup list start-->
                            <?php
                                $query = "SELECT * FROM giftcard ORDER BY id DESC";
                                $cat_res = mysqli_query($con, $query);
                                $cat_arr = [];
                                while ($row = mysqli_fetch_assoc($cat_res)) {
                                    $cat_arr[] = $row;
                                }
    
                                foreach ($cat_arr as $list) {
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card">
                                    <a href="gateway?id=1" class="d-block bg-gray-lt">
                                        <img src="images/networks/<?php echo $list['image_file'];?>" class="fixed-img-height w-100" style="height:200px !important;display:block;margin: 0 auto;">
                                    </a>
                                    <div class="btns">
                                        <?php if (has_module_access_delete($con, 'withdrawal_setup')): ?>
                                            <a href="#" class="btn-close" data-id="<?php echo $list['id'];?>" data-toggle="modal"
                                                data-target="#cat-del" data-backdrop="static" data-keyboard="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <line x1="4" y1="7" x2="20" y2="7" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <?php if (has_module_access_edit($con, 'withdrawal_setup')): ?>
                                            <a href="#" class="btn-edit" data-id="<?php echo $list['id'];?>" data-name="<?php echo $list['name'];?>"
                                                data-desc="<?php echo $list['input_desc'];?>" data-ty="<?php echo $list['input_type'];?>"
                                                data-ct="<?php echo $list['country'];?>" data-toggle="modal" data-target="#cat-edit"
                                                data-backdrop="static" data-keyboard="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
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
                                    <div class="fixed-img-bottom w-100">
                                        <div class="h4 text-center"><?php echo $list['name'];?></div>
                                    </div>
                                </div>
                            </div>
                              <?php } ?>
                            <!--dynmically gateway setup list end-->
                            
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center mt-3">
                            <ul class="pagination">

                            </ul>
                        </div>
                    </div>
                </div>
                
                <!--dynmically gateway setup del start-->
                <form method="post" class="modal modal-blur fade" id="cat-del" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="id" id="cat-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-title">Are you sure?</div>
                                <div>You are about to remove this category and all of its questions from your database.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" name="gateways_del" class="btn btn-danger">Yes, delete it</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--dynmically gateway setup del end-->
                
                <!--dynmically gateway setup edit start-->
                <form method="post" enctype="multipart/form-data"
                    class="modal modal-blur fade" id="cat-edit" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Gift category name</label>
                                    <input type="text" class="form-control" name="name" id="edit-name">
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Item image</div>
                                    <div class="form-file">
                                        <input type="file" name="image" class="form-file-input modal-img-input" id="customFile">
                                        <label class="form-file-label" for="customFile">
                                            <span class="form-file-text modal-img-choose">Choose an image...</span>
                                            <span class="form-file-button">Browse</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirmation dialog text:</label>
                                    <input type="text" class="form-control" name="input_desc" id="edit-desc">
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Input box type:</div>
                                    <select class="form-select" name="input_type">
                                        <option id="edit-ty" selected></option>
                                        <option value="1">Text</option>
                                        <option value="2">Email</option>
                                        <option value="3">Number</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label" name="country">For countries:</label>
                                    <input type="text" class="form-control" name="country" id="edit-ct">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" name="gateways_edit" class="btn btn-primary">Update category</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--dynmically gateway setup edit end-->
                
            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->