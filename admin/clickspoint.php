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
    	}
    	
	if($type=='deactive'){
	$id=get_safe_value($con,$_GET['id']);
	 mysqli_query($con,"update offers set status='1' where id='$id'");
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header space-between">
                                <h3 class="card-title">Clicks Offers</h3>
                            </div>
                            <div class="table-responsive">
                                
                                <?php
                                    $limit = 10;
                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $offset = ($page - 1) * $limit;
                                    
                                    $total_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM offer_clicks");
                                    $total_row = mysqli_fetch_assoc($total_query);
                                    $total_records = $total_row['total'];
                                    $total_pages = ceil($total_records / $limit);
                                    
                                    $cat_res = mysqli_query($con, "SELECT * FROM offer_clicks ORDER BY id DESC LIMIT $offset, $limit");
                                    $cat_arr = array();
                                    while ($row = mysqli_fetch_assoc($cat_res)) {
                                        $cat_arr[] = $row;
                                    }
                                    ?>
                                    
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Offer Name</th>
                                                <th class="text-center">Click Id</th>
                                                <th class="text-center">IP</th>
                                                <th class="text-center">country</th>
                                                <th class="text-center">device</th>
                                                <th class="text-center">os</th>
                                                <th class="text-center">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($cat_arr as $list){ ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php 
                                                        
                                                        $uids = $list['user_id'];
                                                        $sql = "SELECT id, name FROM users WHERE id ='$uids'";
                                                        $result = $con->query($sql);
                                                        if ($rows = $result->fetch_assoc()) {
                                                            echo $rows['name'];
                                                        }
                                                   ?>
                                                   
                                                </td>
                                                <td class="text-center">
                                                    <?php 
                                                        
                                                        $ofids = $list['offer_id'];
                                                        $sql = "SELECT id, name FROM offers WHERE id ='$ofids'";
                                                        $result = $con->query($sql);
                                                        if ($rows = $result->fetch_assoc()) {
                                                            echo $rows['name'];
                                                        }
                                                   ?>
                                                <td class="text-center"><?php echo $list['click_id']; ?></td>
                                                <td class="text-center"><?php echo $list['user_ip']; ?></td>
                                                <td class="text-center"><?php echo $list['user_country']; ?></td>
                                                <td class="text-center"><?php echo $list['user_device']; ?></td>
                                                <td class="text-center"><?php echo $list['user_os']; ?></td>
                                                <td class="text-center"><?php echo $list['timestamp']; ?></td>
                                                
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