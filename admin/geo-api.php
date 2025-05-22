<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php 
if (isset($_POST['geo_api_update'])) {
    $admin_id = $_POST['token_id'];
    $urls = $_POST['urls'];
    $deep_link_1 = $_POST['deep_link_1'];
    $deep_link_2 = $_POST['deep_link_2'];
    $key_va = $_POST['key_va'];
    
    // Check if record exists
    $check = $con->query("SELECT admin_id FROM geo_api_settings WHERE admin_id = '$admin_id'");
    if ($check->num_rows > 0) {
        // Update
        $sql = "UPDATE geo_api_settings SET 
            urls = '$urls',
            deep_link_1 = '$deep_link_1',
            deep_link_2 = '$deep_link_2',
            key_va = '$key_va',
            WHERE admin_id = '$admin_id'";
    } else {
        // Insert
        $sql = "INSERT INTO geo_api_settings (admin_id, urls, deep_link_1, deep_link_2, key_va) VALUES ('$admin_id', '$urls', '$deep_link_1', '$deep_link_2', '$key_va')";
    }
     $con->query($sql);
     header('location:geo-api.php');
     die();
}

 $gapi_query = "SELECT * FROM geo_api_settings WHERE id='1'";
 $gapi_res = mysqli_query($con, $gapi_query);
 $gapi_row = mysqli_fetch_assoc($gapi_res);
?>


<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->
        <div class="content">
            <div class="container-xl">

                <div class="row justify-content-center mt-4">
                    <div class="col-lg-5 col-md-7 col-10 px-0">
                        <form method="post" class="card px-0 mt-2">
                          <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                            <div class="card-header bg-blue-lt text-dark">
                                <span class="card-title">Geo API Setup</span>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">JSON data Provider URL:</label>
                                    <input type="text" class="form-control" name="urls" placeholder="https://ipapi.co/json/" value="<?php echo $gapi_row['urls'];?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">First deep JSON object key:</label>
                                    <input type="text" class="form-control" name="deep_link_1" placeholder="leave blank for none" value="<?php echo $gapi_row['deep_link_1'];?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Second deep JSON object key:</label>
                                    <input type="text" class="form-control" name="deep_link_2" placeholder="leave blank for none" value="<?php echo $gapi_row['deep_link_2'];?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Country ISO key:</label>
                                    <input type="text" class="form-control" name="key_va" placeholder="country_code" value="<?php echo $gapi_row['key_va'];?>">
                                </div>
                            </div>
                            
                            <?php if (has_module_access_edit($con, 'geo_api_setup')): ?>
                                <div class="card-footer">
                                    <button type="submit" name="geo_api_update" class="btn btn-primary btn-block">Update API</button>
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