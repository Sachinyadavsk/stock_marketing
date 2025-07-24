<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

 <?php

if(isset($_POST['addtypes'])){
    date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
    $date_time=date('d/m/Y H:i:s a');
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $check_user=mysqli_num_rows(mysqli_query($con,"select * from offer_types where type='$name'"));
    if($check_user>0){
        ?>
        <script>
         Swal.fire({
          position: 'top-end',
          icon: 'error',
          title: 'Type already exist',
          showConfirmButton: false,
          timer: 2500
            })
            setTimeout(() => {
              window.location.href="";
            }, "2600")
        </script>
<?php
}else{
	mysqli_query($con,"INSERT INTO `offer_types`(`type`, `added_on`) VALUES ('$name','$date_time')");
	$last_id = mysqli_insert_id($con);
	logActivity($con, $last_id, $role_type_is, $name, 'Add new offer types');
?>
        <script>
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Type Added Successfully',
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
		$delete_sql="delete from offer_types where id='$id'";
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
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h2 class="page-title">Offer Types</h2>
                        </div>
                    </div>
                    
                     <?php if (has_module_access_insert($con, 'offer_types')): ?>
                        <div class="add_button">
                            <a style="float:right;color:white" class="btn btn-primary modalbtn" data-keyboard="false"
                            data-backdrop="static" data-toggle="modal" data-target="#ip-type">Add</a>
                        </div>
                    <?php endif; ?>
                    
                </div>

                <div class="row">
                    <div class="box">
                        <div class="card">
                           <?php
                            // Pagination setup
                            $limit = 10;
                            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                            if ($page < 1) $page = 1;
                            $offset = ($page - 1) * $limit;
                            
                            // Get total records
                            $total_res = mysqli_query($con, "SELECT COUNT(*) as total FROM offer_types");
                            $total_row = mysqli_fetch_assoc($total_res);
                            $total_records = $total_row['total'];
                            $total_pages = ceil($total_records / $limit);
                            
                            $cat_res = mysqli_query($con, "SELECT * FROM offer_types ORDER BY id DESC LIMIT $offset, $limit");
                            $cat_arr = array();
                            $i = $offset + 1;
                            while ($row = mysqli_fetch_assoc($cat_res)) {
                                $cat_arr[] = $row;
                            }
                            ?>
                            
                            <div class="table-responsive">
                                <table class="table table-vcenter table-mobile-sm card-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Added On</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cat_arr as $list): ?>
                                        <tr>
                                            <td class="text-muted text-nowrap" data-label="ID">
                                                <?php echo $i++; ?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Type">
                                                <?php echo $list['type']; ?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Date / Time">
                                                <?php echo $list['added_on']; ?>
                                            </td>
                                            <td>
                                                <?php if (has_module_access_delete($con, 'offer_types')): ?>
                                                    <div class="btn-list flex-nowrap">
                                                        <a class="btn btn-dark" href="?type=delete&id=<?php echo $list['id']; ?>">Delete</a>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination pages -->
                            <nav>
                                <ul class="pagination">
                                    <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                                        <li class="page-item <?php echo $p == $page ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $p; ?>"><?php echo $p; ?></a>
                                        </li>
                                    <?php endfor; ?>
                            
                                    <?php if ($page < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>

                        </div>
                        <div class="float-right text-nowrap flex-nowrap">
                        </div>
                    </div>
                    
                    
                    <!--model-->
                       <form method="POST" class="modal modal-blur fade" id="ip-type" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Type</h5>
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
                                           <label for="validationCustom03" class="form-label">Type</label>
                                            <input type="text" name="name" class="form-control" required>
                                            <div class="invalid-feedback">Please select a valid option.</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addtypes" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    
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