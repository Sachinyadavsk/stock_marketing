<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

 <?php

if(isset($_POST['addips'])){
    date_default_timezone_set("Asia/Calcutta"); 
    $date_time=date('d/m/Y H:i:s a');
    $ip=mysqli_real_escape_string($con,$_POST['ip']);
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $check_user=mysqli_num_rows(mysqli_query($con,"select * from accepted_ip where ip='$ip'"));
    if($check_user>0){ ?>
   <script>Swal.fire({
          position: 'top-end',
          icon: 'error',
          title: 'IP already exist',
          showConfirmButton: false,
          timer: 2500
        })
        setTimeout(() => {
          window.location.href="";
        }, "2600")
   </script>
    
<?php
}else{
	mysqli_query($con,"INSERT INTO `accepted_ip`(`company_name`, `ip`, `added_on`) VALUES ('$name','$ip','$date_time')");
	$last_id = mysqli_insert_id($con);
	logActivity($con, $last_id, $role_type_is, $name, 'Add new accepted ip');
     ?>
    <script>
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'IP Added Successfully',
      showConfirmButton: false,
      timer: 2500
    })
    setTimeout(() => {
      window.location.href="";
    }, "2600")
    </script>

  <?php } } ?>

<?php 

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from accepted_ip where id='$id'";
		mysqli_query($con,$delete_sql);
		logActivity($con, $id, $role_type_is, $type, 'Delete accepted ip');
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

<?php
if (isset($_POST['editads'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $ip_raw = $_POST['ip'];

    // Get existing IPs from DB
    $result = mysqli_query($con, "SELECT ip FROM accepted_ip WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
    $existing_ips = isset($row['ip']) ? explode(',', $row['ip']) : [];

    // Clean and validate new IPs
    $new_ip_array = array_map('trim', explode(',', $ip_raw));
    $new_valid_ips = array_filter($new_ip_array, function ($ip) {
        return filter_var($ip, FILTER_VALIDATE_IP);
    });

    // Merge and remove duplicates
    $all_ips = array_unique(array_merge(array_map('trim', $existing_ips), $new_valid_ips));
    $final_ip = implode(', ', $all_ips);

    // Update query
    $query = "UPDATE accepted_ip SET company_name='$name', ip='$final_ip' WHERE id=$id";

    if (mysqli_query($con, $query)) {
        logActivity($con, $id, $role_type_is, $name, 'Advertisers IPs updated successfully');
        echo "<script>alert('Advertisers IPs updated successfully'); window.location.href='https://reapbucks.com/admin/accepted-ip/';</script>";
    } else {
        echo "<script>alert('Error updating Advertisers IPs');</script>";
    }
}

// ips multiple update

if (isset($_POST['update_ip'])) {
    $id = $_POST['id'];
    $old_ip = trim($_POST['old_ip']);
    $new_ip = trim($_POST['ip']);

    $res = mysqli_query($con, "SELECT ip FROM accepted_ip WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);

    $ip_list = explode(',', $row['ip']);
    foreach ($ip_list as &$ip) {
        if (trim($ip) === $old_ip) {
            $ip = $new_ip;
        }
    }
    $updated_ip_string = implode(',', array_map('trim', $ip_list));

    mysqli_query($con, "UPDATE accepted_ip SET ip='$updated_ip_string' WHERE id='$id'");
     echo "<script>alert('IPs multiple updated successfully'); window.location.href='https://reapbucks.com/admin/accepted-ip/';</script>";
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
                            <h2 class="page-title">Advertisers IPs</h2>
                        </div>
                    </div>
                    
                     <?php if (has_module_access_insert($con, 'accepted_ip')): ?>
                        <div class="add_button">
                            <a style="float:right;color:white" class="btn btn-primary modalbtn" data-keyboard="false"
                            data-backdrop="static" data-toggle="modal" data-target="#ip-add">Add</a>
                        </div>
                    <?php endif; ?>
                    
                </div>

                <div class="row">
                    <div class="box">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-mobile-sm card-table">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>ADS ID</th>
                                            <th>Company Name</th>
                                            <th>IP</th>
                                            <th>Added On</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                <?php
                                $cat_res = mysqli_query($con, "SELECT * FROM accepted_ip ORDER BY id DESC");
                                $i = 1;
                                
                                while ($row = mysqli_fetch_assoc($cat_res)) {
                                    $company_id = $row['id'];
                                    $company_name = htmlspecialchars($row['company_name']);
                                    $ips = explode(',', $row['ip']);
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $company_id; ?></td>
                                    <td><?php echo $company_name; ?></td>
                                    <td>
                                        <?php foreach ($ips as $ip): ?>
                                            <span class="badge bg-secondary mb-1 d-block"><?php echo trim($ip); ?></span>
                                        <?php endforeach; ?>
                                    </td>
                                    <td><?php echo $row['added_on']; ?></td>
                                    <td>
                                        <?php if (has_module_access_delete($con, 'accepted_ip')): ?>
                                            <div class="btn-list flex-nowrap">
                                                <a class="btn btn-dark" href="?type=delete&id=<?php echo $row['id'];?>">Delete</a>
                                                <button class='btn btn-sm btn-success editBtn' data-id='<?php echo $row['id'];?>' data-company_name='<?php echo $row['company_name'];?>'>Edit</button>
                                            </div>
                                        <?php endif; ?>
                                
                                        <!-- Toggle IP Accordion -->
                                        <button class="btn btn-sm btn-primary mt-1" data-toggle="collapse" data-target="#ip-edit-<?php echo $company_id; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <circle cx="10" cy="10" r="7"></circle>
                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                        </svg>&nbsp; IPs 
                                        </button>
                                    </td>
                                </tr>
                                
                                <!-- Accordion Row -->
                                <tr class="collapse bg-light" id="ip-edit-<?php echo $company_id; ?>">
                                    <td colspan="6">
                                        <div class="p-3 border rounded">
                                            <h6>Edit IPs for: <?php echo $company_name; ?></h6>
                                            <?php foreach ($ips as $index => $ip): 
                                                $trimmed_ip = trim($ip);
                                            ?>
                                            <form method="POST" class="d-flex align-items-center gap-2 mb-2">
                                                <input type="hidden" name="id" value="<?php echo $company_id; ?>">
                                                <input type="hidden" name="old_ip" value="<?php echo $trimmed_ip; ?>">
                                                <input type="text" name="ip" value="<?php echo $trimmed_ip; ?>" class="form-control" style="max-width:300px;" required>
                                                <button type="submit" name="update_ip" class="btn btn-success btn-sm">Update IP</button>
                                            </form>
                                            <?php endforeach; ?>
                                            <button type="button" class="btn btn-secondary btn-sm mt-2" data-toggle="collapse" data-target="#ip-edit-<?php echo $company_id; ?>">Close</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                
                                </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="float-right text-nowrap flex-nowrap">
                        </div>
                    </div>
                    
                    <!--model-->
                       <form method="POST" class="modal modal-blur fade" id="ip-add" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Advertisers IPs</h5>
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
                                           <label for="validationCustom03" class="form-label">Company Name</label>
                                           <input type="text" name="name" placeholder="Company Name" class="form-control" required>
                                           <div class="invalid-feedback"> Please select a valid option.</div>
                                           
                                           <label for="validationCustom03" class="form-label">IP</label>
                                           <input type="text" name="ip" placeholder="IP" class="form-control" required>
                                           <div class="invalid-feedback">Please select a valid option.</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addips" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        
                           <form method="POST" class="modal fade" id="manage-edit" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Advertisers IPs</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span>&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <input type="hidden" name="id" id="edit-id">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="name" id="edit-company_name" required>
                                    
                                    <label class="form-label">IP</label>
                                    <input type="text" class="form-control" name="ip">
                                    
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="editads" class="btn btn-primary">Update</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                    
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                  document.querySelectorAll('.editBtn').forEach(function (button) {
                    button.addEventListener('click', function () {
                      // Populate modal fields
                      document.getElementById('edit-id').value = this.dataset.id;
                      document.getElementById('edit-company_name').value = this.dataset.company_name;
                    //   document.getElementById('edit-ip').value = this.dataset.ip;
                      // Show the modal (Bootstrap 4)
                      $('#manage-edit').modal('show');
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