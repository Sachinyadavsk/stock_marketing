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
                                <div class="card-header">
                                 <h4 class="card-title">Earnings List —  <h4>
                                </div>
                           <div class="card-body card-block text-center p-3">
                                <?php
                                // Get filters from GET
                                $offers_filter = $_GET['offers'] ?? '';
                                $from_date = $_GET['from_date'] ?? '';
                                $to_date = $_GET['to_date'] ?? '';
                               $users_filter = $_GET['users'] ?? '';
                                
                                // Pagination setup
                                $limit = 10;
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $start_from = ($page - 1) * $limit;
                                
                                // Filter WHERE clause
                                $where = "WHERE 1";
                               if (!empty($offers_filter)) {
                                    $where .= " AND my_offer_id = '" . mysqli_real_escape_string($con, $offers_filter) . "'";
                                }
                                
                                if (!empty($from_date)) {
                                    $where .= " AND STR_TO_DATE(timestamp, '%d/%m/%Y %H:%i:%s') >= STR_TO_DATE('" . mysqli_real_escape_string($con, $from_date) . "', '%Y-%m-%d')";
                                }
                                if (!empty($to_date)) {
                                    $where .= " AND STR_TO_DATE(timestamp, '%d/%m/%Y %H:%i:%s') <= STR_TO_DATE('" . mysqli_real_escape_string($con, $to_date) . "', '%Y-%m-%d')";
                                }
                                
                                if (!empty($users_filter)) {
                                    $where .= " AND user_id = '" . mysqli_real_escape_string($con, $users_filter) . "'";
                                }
                                
                                
                               $users_result = mysqli_query($con, "SELECT id, name FROM users ORDER BY name ASC");
                               $offers_result = mysqli_query($con, "SELECT id, name FROM offers ORDER BY name ASC");
                                
                                // Fetch filtered data
                                $query = "SELECT my_earnings.*, offers.name AS offer_name, offers.category AS offer_category, offers.aid AS offer_aid FROM my_earnings 
                                LEFT JOIN offers ON my_earnings.my_offer_id = offers.id $where ORDER BY my_earnings.id DESC LIMIT $start_from, $limit";

                                // $query = "SELECT * FROM my_earnings $where ORDER BY id DESC LIMIT $start_from, $limit";
                                $cat_res = mysqli_query($con, $query);
                                
                                // Count total for pagination
                                $count_query = "SELECT COUNT(*) AS total FROM my_earnings $where";
                                $result = mysqli_query($con, $count_query);
                                $row = mysqli_fetch_assoc($result);
                                $total_records = $row['total'];
                                $total_pages = ceil($total_records / $limit);
                                ?>
                                
                                <?php
                                if (isset($_POST['bulk_update_status']) && isset($_POST['erg_ids']) && !empty($_POST['new_status'])) {
                                        $selected_ergs = $_POST['erg_ids'];
                                        $new_status = $_POST['new_status'];
                                    
                                        foreach ($selected_ergs as $erg_id) {
                                            
                                            $lead_query = mysqli_query($con, "SELECT my_offer_id FROM my_earnings WHERE id = '$erg_id'");
                                            if ($lead_data = mysqli_fetch_assoc($lead_query)) {
                                                $offer_id = $lead_data['my_offer_id'];
                                                // print_r($offer_id);
                                                //   exit();
                                                $offer_query = mysqli_query($con, "SELECT points FROM offers WHERE id = '$offer_id'");
                                                if ($offer_data = mysqli_fetch_assoc($offer_query)) {
                                                    $offer_point = $offer_data['points'];
                                                    if ($new_status == "hold") {
                                                        $updated_points = 0;
                                                    } elseif ($new_status == "proccessing") {
                                                        $updated_points = $offer_point;
                                                    }
                                                    mysqli_query($con, "UPDATE my_earnings SET points = '$updated_points' WHERE id = '$erg_id'");
                                                }
                                            }
                                        }
                                    
                                        echo "<script>alert('Selected my_earnings updated successfully.'); location.href='".$_SERVER['REQUEST_URI']."';</script>";
                                    }
                                    ?>
                                
                                <!-- FILTER FORM -->
                                <form method="GET" class="mb-4">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <select name="users" class="form-control">
                                                <option value="">All Users</option>
                                                <?php while($rows = mysqli_fetch_assoc($users_result)): ?>
                                                    <option value="<?= $rows['id']; ?>" <?= $users_filter == $rows['id'] ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($rows['name']) ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="offers" class="form-control">
                                                <option value="">All Offers</option>
                                                <?php while($row = mysqli_fetch_assoc($offers_result)): ?>
                                                    <option value="<?= $row['id'] ?>" <?= $offers_filter == $row['id'] ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($row['name']) ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="date" name="from_date" value="<?= $from_date ?>" class="form-control" placeholder="From Date">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="date" name="to_date" value="<?= $to_date ?>" class="form-control" placeholder="To Date">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                                        </div>
                                    </div>
                                </form>
                                
                                <hr>
                                <form method="POST" class="mb-3" id="bulkActionsForm">
                                        <div class="row align-items-center justify-content-end g-2">
                                            <div class="col-auto">
                                                <label for="bulk_status_select" class="form-label mb-0">Update Point Status:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="new_status" id="bulk_status_select" class="form-control">
                                                    <option value="">-- Point Status --</option>
                                                    <option value="hold">Hold</option>
                                                    <option value="proccessing">Proccessing</option>
                                                </select>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" name="bulk_update_status" class="btn btn-info">Update Selected</button>
                                            </div>
                                        </div>
                                        <br>
                                <div class="table table-responsive">
                                <!-- TABLE -->
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><input type="checkbox" id="selectAllRrg"></th> 
                                            <th>S.N</th>
                                             <th>User ID</th>
                                            <th>User Name</th>
                                            <th>Offer Name</th>
                                            <th>Offer Category</th>
                                            <th>Advertiser Name</th>
                                            <th>Advertiser ID</th>
                                            <th>Points</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = $start_from + 1;
                                        while ($list = mysqli_fetch_assoc($cat_res)) {
                                            $offer_id = $list['my_offer_id'];
                                            $offer_aid = $list['offer_aid'];
                                            $user_id = $list['user_id'];
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="erg_ids[]" value="<?= $list['id']; ?>" class="erg-checkbox"></td>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $list['user_id'];?></td>
                                            <td>
                                                <?php 
                                                $sql = "SELECT name FROM users WHERE id = '$user_id'";
                                                $result = mysqli_query($con, $sql);
                                                if ($row = mysqli_fetch_assoc($result)) {
                                                    echo $row['name'];
                                                }
                                                ?>
                                            </td>
                                            
                                            <td><?php echo $list['offer_name']; ?></td>
                                            <td><?php echo $list['offer_category']; ?></td>
                                            <td>
                                                <?php 
                                                    $sql = "SELECT company_name FROM accepted_ip WHERE id = '$offer_aid'";
                                                    $result = mysqli_query($con, $sql);
                                                    if ($row = mysqli_fetch_assoc($result)) {
                                                        echo $row['company_name'];
                                                    }
                                                    ?>
                                            </td>
                                            <td><?php echo $list['offer_aid']; ?></td>
                                            
                                            <td>
                                                <?php
                                                if($list['points']=='0'){ ?>
                                                   <span style="color:green;font-weight:600px">Hold</span>
                                               <?php }else{ echo $list['points']; } ?>
                                            </td>
                                            <td><?php echo $list['timestamp']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                                 </form>
                                <!-- PAGINATION -->
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <?php
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            $active = ($i == $page) ? 'active' : '';
                                            $queryParams = http_build_query(array_merge($_GET, ['page' => $i]));
                                            echo "<li class='page-item $active'><a class='page-link' href='?$queryParams'>$i</a></li>";
                                        }
                                        ?>
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
              
               <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const selectAllCheckbox = document.getElementById('selectAllRrg');
                        const ergCheckboxes = document.querySelectorAll('.erg-checkbox');
                
                        selectAllCheckbox.addEventListener('change', function() {
                            ergCheckboxes.forEach(checkbox => {
                                checkbox.checked = selectAllCheckbox.checked;
                            });
                        });
                
                        ergCheckboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', function() {
                                if (!this.checked) {
                                    selectAllCheckbox.checked = false;
                                } else {
                                    const allChecked = Array.from(ergCheckboxes).every(cb => cb.checked);
                                    selectAllCheckbox.checked = allChecked;
                                }
                            });
                        });
                    });
                </script>
                
             <!-- footer Start -->
             <?php include('footer.php');?>
             <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->