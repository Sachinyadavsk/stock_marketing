<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php 

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from activity_logs where id='$id'";
		mysqli_query($con,$delete_sql);
		logActivity($con, $id, $role_type_is, $type, 'Delete offer types');
		?>
    <script>
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'IP Deleted',
          showConfirmButton: false,
          timer: 2500
        })
        setTimeout(() => {
          window.location.href="";
        }, "2600")
    </script>
    <?php
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
                           <div class="card-header">
                                <h3 class="card-title">Activities Logs</h3>
                            </div>
                            <div class="table-responsive">
                                
                                <?php
                                    $limit = 10;
                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $offset = ($page - 1) * $limit;
                                    
                                    $total_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM activity_logs");
                                    $total_row = mysqli_fetch_assoc($total_query);
                                    $total_records = $total_row['total'];
                                    $total_pages = ceil($total_records / $limit);
                                    
                                    $cat_res = mysqli_query($con, "SELECT * FROM activity_logs ORDER BY id DESC LIMIT $offset, $limit");
                                    $cat_arr = array();
                                    $i=1;
                                    while ($row = mysqli_fetch_assoc($cat_res)) {
                                        $cat_arr[] = $row;
                                    }
                                    ?>
                                    
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr> 
                                                <th class="text-center">S.N</th>
                                                <th class="text-center">curl id</th>
                                                <th class="text-center">curl name</th>
                                                <th class="text-center">activity type</th>
                                                <th class="text-center">activity description</th>
                                                <th class="text-center">ip address</th>
                                                <th class="text-center">country</th>
                                                <th class="text-center">region</th>
                                                <th class="text-center">city</th>
                                                <th class="text-center">postal</th>
                                                <th class="text-center">Local</th>
                                                <th class="text-center">org</th>
                                                <th class="text-center">device</th>
                                                <th class="text-center">os</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($cat_arr as $list){ ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $list['curl_id']; ?></td>
                                                <td><?php echo $list['curl_name']; ?></td>
                                                <td><?php echo $list['activity_type']; ?></td>
                                                <td><?php echo $list['activity_description']; ?></td>
                                                <td><?php echo $list['ip_address']; ?></td>
                                                <td><?php echo $list['country']; ?></td>
                                                <td><?php echo $list['region']; ?></td>
                                                <td><?php echo $list['city']; ?></td>
                                                <td><?php echo $list['postal']; ?></td>
                                                <td><?php echo $list['loc']; ?></td>
                                                <td><?php echo $list['org']; ?></td>
                                                 <td><?php echo $list['device']; ?></td>
                                                 <td><?php echo $list['os']; ?></td>
                                                 <td><?php echo $list['created_at']; ?></td>
                                                <td>
                                                    <div class="btn-list flex-nowrap">
                                                        <a class="btn btn-danger" href="?type=delete&id=<?php echo $list['id']; ?>">Delete</a>
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