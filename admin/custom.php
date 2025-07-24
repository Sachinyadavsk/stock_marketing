<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php 
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
        if($type=='active'){
    	$id=get_safe_value($con,$_GET['id']);
    	 mysqli_query($con,"update offers set status='0' where id='$id'");
    	 logActivity($con, $id, $role_type_is, $type, 'offer active');
    	}
    	
	if($type=='deactive'){
	$id=get_safe_value($con,$_GET['id']);
	 mysqli_query($con,"update offers set status='1' where id='$id'");
	 logActivity($con, $id, $role_type_is, $type, 'offer deactive');
	}
}



if (isset($_POST['update_url'])) {
    $postback_url = mysqli_real_escape_string($con, $_POST['postback_url']);
    mysqli_query($con,"update url_call_log set url='$postback_url' where id='1'");
    $update_query = "UPDATE offers SET postback_url = '$postback_url' WHERE status = '1'";
    if (mysqli_query($con, $update_query)) {
        // echo "<div class='alert alert-success mt-2'>Postback URL updated successfully.</div>";
    } else {
        // echo "<div class='alert alert-danger mt-2'>Error: " . mysqli_error($con) . "</div>";
    }
}



$querypostback = "SELECT * FROM offers ORDER BY id DESC LIMIT 1";
$cat_respostback = mysqli_query($con, $querypostback);
$rowpostback = mysqli_fetch_assoc($cat_respostback);

?>

<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->

        <div class="content">
            <div class="container-xl">
                <form class="row" method="post">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body row">
                                <div class="col-12">
                                    <label class="form-label text-truncate">Letest postback url get deatils your <span class="text-danger">Custom CPA</span></label>
                                </div>
                                <form method="post">
                                    <div class="col-12 mt-3 input-group">
                                        <span class="input-group-text text-blue">Postback URL:</span>
                                        <input type="text" class="form-control" name="postback_url" 
                                               value="<?php echo htmlspecialchars($rowpostback['postback_url']); ?>">
                                                <button type="submit" name="update_url" class="btn btn-primary mt-8">Update</button>
                                    </div>
                                   
                                </form>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header space-between">
                                <h3 class="card-title">Custom Offers</h3>
                                
                                <?php if (has_module_access_insert($con, 'custom_offerwall')): ?>
                                    <a href="manage_custom.php"
                                        class="btn btn-primary small-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add Offer
                                    </a>
                                <?php endif; ?>
                                
                            </div>
                            <div class="table-responsive">
                                
                                <?php
                                    $limit = 10;
                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $offset = ($page - 1) * $limit;
                                    
                                    $total_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM offers");
                                    $total_row = mysqli_fetch_assoc($total_query);
                                    $total_records = $total_row['total'];
                                    $total_pages = ceil($total_records / $limit);
                                    
                                    $cat_res = mysqli_query($con, "SELECT * FROM offers ORDER BY id DESC LIMIT $offset, $limit");
                                    $cat_arr = array();
                                    while ($row = mysqli_fetch_assoc($cat_res)) {
                                        $cat_arr[] = $row;
                                    }
                                    ?>
                                    
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Icon</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Tracking Link</th>
                                                <th class="text-center">Preview Link</th>
                                                <th class="text-center">OS</th>
                                                <th class="text-center">Geo</th>
                                                <th class="text-center">Flow</th>
                                                <th class="text-center">Points</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Point Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($cat_arr as $list){ ?>
                                            <tr>
                                                <td><?php echo $list['category']; ?></td>
                                                <td><img src="images/offers/<?php echo $list['icon_url']; ?>" width="40"><br><?php echo $list['name']; ?></td>
                                                <td><a href="javascript:void();" data-toggle="modal" data-target="#offet-details<?php echo $list['id']; ?>">Description</a></td>
                                                <td><a href="javascript:void();" data-toggle="modal" data-target="#offet-details<?php echo $list['id']; ?>">Tracking Link</a></td>
                                                <td><a href="javascript:void();" data-toggle="modal" data-target="#offet-details<?php echo $list['id']; ?>">Preview Link</a></td>
                                                <td><?php echo $list['os']; ?></td>
                                                <td><?php echo $list['geo']; ?></td>
                                                <td><?php echo $list['flow']; ?></td>
                                                <td><?php echo $list['points']; ?></td>
                                                <td><?php echo $list['timestamp']; ?></td>
                                                <td><?php echo $list['status']; ?></td>
                                                <td><?php echo $list['point_status']; ?></td>
                                                
                                                <td>
                                                        <div class="btn-list flex-nowrap">
                                                            <?php if (has_module_access_delete($con, 'custom_offerwall')): ?>
                                                                 <?php if($list['status']=='1'){?>
                                                                 <a class="btn btn-success" href="?type=active&id=<?php echo $list['id'];?>">Active</a>
                                                                 <?php }else{?>
                                                                 <a class="btn btn-danger" href="?type=deactive&id=<?php echo $list['id'];?>">Deactive</a>
                                                                  <?php }?>
                                                              <?php endif; ?>
                                                              <?php if (has_module_access_edit($con, 'custom_offerwall')): ?>
                                                                  <a class="btn btn-white" href="https://reapbucks.com/admin/manage_custom.php?id=<?php echo $list['id']; ?>">Edit</a>
                                                              <?php endif; ?>
                                                        </div>
                                                    
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                    
                                    <!-- Pagination -->
                                    <nav>
                                        <ul class="pagination justify-content-end">
                                            <?php if ($page > 1) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo ($page - 1); ?>">Previous</a>
                                                </li>
                                            <?php } ?>
                                            
                                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                                <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php } ?>
                                            
                                            <?php if ($page < $total_pages) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo ($page + 1); ?>">Next</a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>

                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
            
            <!--dynmically offer id details start-->
                  <?php 
                       $a='';
                        $cat_res=mysqli_query($con,"select * from offers");
                        $cat_arr=array();
                        while($row=mysqli_fetch_assoc($cat_res)){
                          $cat_arr[]=$row;    
                        }
                         foreach($cat_arr as $list){
                             $llid=$list['id'];
                       $category=$list['category'];
                        $name=$list['name'];
                        $description=$list['description'];
                         $t_link=$list['tracking_link'];
                         $p_link=$list['preview_link'];
                        $os=$list['os'];
                        $geo=$list['geo'];
                        $i_link=$list['icon_url'];
                        $flow=$list['flow'];
                        $points=$list['points'];
                        $cap=$list['cap'];
                        $cap_reset=$list['cap_reset'];
                    
                    ?>
                
                      <form method="POST" class="modal modal-blur fade" id="offet-details<?php echo $list['id'];?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><b><?php echo $list['name'];?></b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <line x1="18" y1="6" x2="6" y2="18" />
                                                <line x1="6" y1="6" x2="18" y2="18" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                           <div class="card">
                                                <div class="card-body">
                                                  <div class="row">
                                                      <div class="col-md-12">
                                                          <h6 style=""><b>Tracking Link :-</b></h6>
                                                          <p><?php echo $list['tracking_link'];?></p>
                                                          <h6><b>Preview Link :-</b></h6>
                                                          <p><?php echo $list['preview_link'];?></p>
                                                          <h6><b>Description :-</b></h6>
                                                          <p><?php echo $list['quick_desc']. '-' .$list['description'];?></p>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </form>
                  <?php }?>
              <!--dynmically offer id details start-->
                
             <!-- footer Start -->
             <?php include('footer.php');?>
             <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->