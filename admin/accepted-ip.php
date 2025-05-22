<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

 <?php

if(isset($_POST['addips'])){
    date_default_timezone_set("Asia/Calcutta"); 
    $date_time=date('d/m/Y H:i:s a');
    $ip=mysqli_real_escape_string($con,$_POST['ip']);
    $oi=mysqli_real_escape_string($con,$_POST['offer_id']);
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
	mysqli_query($con,"INSERT INTO `accepted_ip`(`offer_id`,`company_name`, `ip`, `added_on`) VALUES ('$oi','$name','$ip','$date_time')");
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
                            <h2 class="page-title">Accepted IPs</h2>
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
                                            <th>ID</th>
                                            <th>Offer ID</th>
                                            <th>Company Name</th>
                                            <th>IP</th>
                                            <th>Added On</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                                $cat_res=mysqli_query($con,"select * from accepted_ip order by id desc");
                                                $cat_arr=array();
                                                $i =1;
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
                                                ?>
                                        <tr>
                                            <td class="text-muted text-nowrap" data-label="ID">
                                                <?php echo $i++;?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Offer Id">
                                                <?php echo $list['offer_id'];?>
                                            </td>
                                            <td data-label="Company Name">
                                                <div class="text-muted text-h5"><?php echo $list['company_name'];?></div>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="IP">
                                               <?php echo $list['ip'];?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Date / Time">
                                               <?php echo $list['added_on'];?>
                                            </td>
                                            <td>
                                                <?php if (has_module_access_delete($con, 'accepted_ip')): ?>
                                                    <div class="btn-list flex-nowrap">
                                                        <a class="btn btn-dark" href="?type=delete&id=<?php echo $list['id'];?>">Delete</a>
                                                    </div>
                                                <?php endif; ?>
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
                                        <h5 class="modal-title">Add IP</h5>
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
                                         <label for="validationCustom01" class="form-label">Offer Name</label>
                                         <select class="form-select" id="validationCustom01" name="offer_id" required>
                                            <option value="">--Select--</option>
                                                <?php
                                                $cat_res=mysqli_query($con,"select * from offers group by name");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                mysqli_next_result($con);
                                                 foreach($cat_arr as $list){
                                                    
                                                ?>
                                                    <option value="<?php echo $list['id'];?>"><?php echo $list['name'];?></option>
                                                 <?php }?>
                                            </select>
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