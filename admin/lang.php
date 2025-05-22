<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->
<?php
if (isset($_POST['lang_vadd'])) {
    $admin_id = mysqli_real_escape_string($con, $_POST['token_id']);
    $language_name = mysqli_real_escape_string($con, $_POST['language_name']);
    $language_code = mysqli_real_escape_string($con, $_POST['language_code']);
    
    $lang_file = 'flag_en.png';
    
    // heck if record with same name exists
    $check = $con->query("SELECT id FROM lang WHERE language_name = '$language_name'");

    if ($check->num_rows > 0) {
        // Update
        $row = $check->fetch_assoc();
        $id = $row['id'];

        $sql = "UPDATE lang SET language_code = '$language_code' WHERE id = '$id'";
        } else {
            // Insert
            $sql = "INSERT INTO lang (admin_id, language_name, language_code, lang_file) VALUES ('$admin_id', '$language_name', '$language_code', '$lang_file')";
        }

    $con->query($sql);
    header('Location: lang.php');
    exit();
}

if (isset($_POST['lang_del'])) {
    $admin_id = get_safe_value($con, $_POST['token_id']);
    $id=get_safe_value($con,$_POST['id']);
	$delete_sql="delete from lang where id='$id'";
	mysqli_query($con,$delete_sql);
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
                    <div class="col-12">
                        
                         <form class="card" method="post">
                             <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                            <div class="card-header">
                                <span class="card-title">Add a language</span>
                            </div>
                            <div class="card-body row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text">Language name:</span>
                                            <input type="text" class="form-control" name="language_name"
                                                placeholder="English">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text">Language code:</span>
                                            <input type="text" class="form-control" name="language_code"
                                                placeholder="en">
                                        </div>
                                    </div>
                                </div>
                                
                                 <?php if (has_module_access_insert($con, 'languages')): ?>
                                <div class="col-lg-2 col-md-3 col-sm-12">
                                    <button type="submit" name="lang_vadd" class="btn btn-block btn-dark">Add</button>
                                </div>
                                <?php endif; ?>
                            </div>
                        </form>
                        
                    </div>
                      <?php
                            $query = "SELECT * FROM lang ORDER BY id ASC";
                            $cat_res = mysqli_query($con, $query);
                            $cat_arr = [];
                            while ($row = mysqli_fetch_assoc($cat_res)) {
                                $cat_arr[] = $row;
                            }

                            foreach ($cat_arr as $list) {
                        ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card card-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="float-left mr-3 stamp">
                                    <span class="avatar rounded" style="background-image: url(assets/img/flag_<?php echo $list['language_code'];?>.png)"></span>
                                </div>
                                <div class="mr-3 lh-sm">
                                    <div class="strong">
                                        <?php echo $list['language_name'];?>
                                    </div>
                                    <div class="text-muted">Code: <?php echo $list['language_code'];?></div>
                                </div>
                                
                                <div class="btns">
                                    
                                    <?php if (has_module_access_delete($con, 'languages')): ?>
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
                                    
                                    <?php if (has_module_access_edit($con, 'languages')): ?>
                                    <a href="lang_vedit_manage.php?id=<?php echo $list['language_code'];?>" style="color: #ffffff;padding: 0px 5px;">
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
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                </div>
                <form method="post" class="modal modal-blur fade" id="cat-del" tabindex="-1"
                    role="dialog" aria-hidden="true">
                    <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                    <input type="hidden" name="id" id="cat-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-title">Are you sure?</div>
                                <div>You are about to remove this language localization from your database.</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" name="lang_del" class="btn btn-danger">Yes, delete it</button>
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