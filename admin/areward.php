<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php 
if (isset($_POST['submit'])) {
    $token_id = $_POST['token_id'];
    $re_days = 'Day';
    $min_point = isset($_POST['min_point']) ? $_POST['min_point'] : '';
    $max_point = isset($_POST['max_point']) ? $_POST['max_point'] : '';
    $lay_color = isset($_POST['lay_color']) ? $_POST['lay_color'] : '';
       
    $res = mysqli_query($con, "SELECT * FROM areward WHERE min_point='$min_point'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
                // Allowed to proceed for update
            } else {
                $msg = "Areward already exists";
                $color_class = "alert-danger";
            }
        } else {
            $msg = "Areward already exists";
            $color_class = "alert-danger";
        }
    }

      if ($msg == '') {
          
          // Count how many records already exist for this token_id
            $count_res = mysqli_query($con, "SELECT COUNT(*) as total FROM areward WHERE token_id = '$token_id'");
            $count_row = mysqli_fetch_assoc($count_res);
            $day_number = $count_row['total'] + 1;
            $re_days = 'Day ' . $day_number;
          
        mysqli_query($con, "INSERT INTO areward (token_id, min_point, max_point, lay_color, re_days) VALUES ('$token_id', '$min_point', '$max_point', '$lay_color', '$re_days')");
        header('location:areward.php');
        die();
            
      }
}


if (isset($_POST['areward_edit'])) {
     $id=get_safe_value($con,$_POST['id']);
     $re_days = isset($_POST['re_days']) ? $_POST['re_days'] : '';
     $min_point = isset($_POST['min_point']) ? $_POST['min_point'] : '';
     $max_point = isset($_POST['max_point']) ? $_POST['max_point'] : '';
    
     $update_sql = "UPDATE areward SET re_days='$re_days', min_point='$min_point', max_point='$max_point', status='0' WHERE id='$id'";
     mysqli_query($con, $update_sql);
}


// delete cps

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from areward where id='$id'";
		mysqli_query($con,$delete_sql);
	}
	
	if($type=='approved'){
		$id=get_safe_value($con,$_GET['id']);
		$approved_sql="UPDATE areward SET status='1' WHERE id='$id'";
		mysqli_query($con, $approved_sql);
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
                <div class="row">
                    <div class="card">
                         <?php if (has_module_access_insert($con, 'activity_reward_setup')): ?>
                              <div class=""><span class="add-rewards_button" data-toggle="modal" data-target="#cat-rewards">Add Rewards</span></div>
                         <?php endif; ?>
                        <div class="card-header">
                            <span class="card-title">10 Days Activity Reward</span>
                        </div>
                        <div class="row card-body">
                            <?php
                                $query = "SELECT * FROM areward WHERE status='1'";
                                $cat_res = mysqli_query($con, $query);
                                $cat_arr = [];
                                while ($row = mysqli_fetch_assoc($cat_res)) {
                                    $cat_arr[] = $row;
                                }
    
                                foreach ($cat_arr as $list) {
                            ?>
                            <form class="col-md-6 col-xl-3" method="post">
                                <input type="hidden" name="id" value="<?php echo $list['id'];?>">
                                <div class="card" style="background-color:<?php echo $list['lay_color'];?>">
                                    
                                    <?php if (has_module_access_delete($con, 'activity_reward_setup')): ?>
                                    <a href="?type=delete&id=<?php echo $list['id'];?>" class="clos_e">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </a>
                                    <?php endif; ?>
                                    
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label text-white">Title for <?php echo $list['re_days'];?>:</label>
                                            <input type="text" class="form-control" name="re_days" value="<?php echo $list['re_days'];?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label text-white">Min:</label>
                                                <input type="text" class="form-control" name="min_point" value="<?php echo $list['min_point'];?>">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label text-white">Max:</label>
                                                <input type="text" class="form-control" name="max_point" value="<?php echo $list['max_point'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (has_module_access_edit($con, 'activity_reward_setup')): ?>
                                        <div class="card-footer">
                                            <button type="submit" name="areward_edit" class="btn btn-block btn-trans">Update</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </form>
                            <?php } ?>
                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Inactive Activity Rewards</div>
                        <div class="card-header row">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-mobile-sm card-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Day Name</th>
                                            <th>Min</th>
                                            <th>Max</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM areward WHERE status='0'";
                                            $cat_res = mysqli_query($con, $query);
                                            $cat_arr = [];
                                            $i=1;
                                            while ($row = mysqli_fetch_assoc($cat_res)) {
                                                $cat_arr[] = $row;
                                            }
                
                                            foreach ($cat_arr as $list) {
                                        ?>
                                        <tr>
                                            <td class="text-muted text-nowrap" data-label="ID"><?php echo $i++;?></td>
                                            <td data-label="Days Name">
                                                <div class="text-muted text-h5 text-center"><span style="background:<?php echo $list['lay_color'];?>;color:#eee;padding:7px;"><?php echo $list['re_days'];?></span></div>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Min Point"> <?php echo $list['min_point'];?> </td>
                                             <td class="text-muted text-nowrap" data-label="Max Point"><?php echo $list['max_point'];?></td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <a class="btn btn-dark" href="?type=approved&id=<?php echo $list['id'];?>">Approved</a>
                                                </div>
                                                
                                                
                                            </td>
                                        </tr>
                                        <?php } ?>
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
             <!--dynmically rewards setup add start-->
                <form method="post" enctype="multipart/form-data"
                    class="modal modal-blur fade" id="cat-rewards" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-body">
                                
                                <div class="mb-3">
                                    <label class="form-label">Min Point</label>
                                    <input type="number" class="form-control" name="min_point">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Max Point</label>
                                    <input type="number" class="form-control" name="max_point">
                                </div>
                                
                                <div>
                                    <label class="form-label" name="country">Layout Color</label>
                                    <input type="color" class="colorpicker form-control asColorPicker-input" name="lay_color">
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submit" class="btn btn-primary">Add Rewards</button>
                            </div>
                        </div>
                    </div>
                </form>
             <!--dynmically rewards setup add end-->
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
     <!-- footer url start -->
     <?php include('footer_url.php');?>
     <!-- footer url end -->