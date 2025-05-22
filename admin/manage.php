<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

 <?php

date_default_timezone_set("Asia/Calcutta");
$date_time=date('d/m/Y H:i:s a');
if(isset($_POST['addmanages'])){	
    $role=mysqli_real_escape_string($con,$_POST['role']);
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $password_hash=password_hash($password, PASSWORD_DEFAULT);
    $check_user=mysqli_num_rows(mysqli_query($con,"select * from admin where email='$name'"));
    if($check_user>0){
        ?>
        <script>
           Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'User already registered',
              showConfirmButton: false,
              timer: 2500
            })
            setTimeout(() => {
              window.location.href="";
            }, "2600")
        </script>
<?php
}else{
	mysqli_query($con,"insert into admin(email,password,role) values('$name','$password_hash','$role')");
?>
    <script>
       Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'User added successfully',
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
		$delete_sql="delete from admin where id='$id'";
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
                            <h2 class="page-title">Manage Admin</h2>
                        </div>
                    </div>
                    <div class="add_button">
                        <a style="float:right;color:white" class="btn btn-primary modalbtn" data-keyboard="false"
                        data-backdrop="static" data-toggle="modal" data-target="#manage-add">Add</a>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="box">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-mobile-sm card-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                                $cat_res=mysqli_query($con,"select * from admin");
                                                $cat_arr=array();
                                                $i=1;
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
                                                ?>
                                        <tr>
                                            <td class="text-muted text-nowrap" data-label="ID">
                                                <?php echo $i++;?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Email">
                                                <?php echo $list['email'];?>
                                            </td>
                                            <td data-label="Role">
                                                <div class="text-muted text-h5"><?php echo $list['role'];?></div>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <a class="btn btn-dark" href="?type=delete&id=<?php echo $list['id'];?>">Delete</a>
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
                       <form method="POST" class="modal modal-blur fade" id="manage-add" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        
                                           <label for="validationCustom01" class="form-label"> Username</label>
                                            <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Username" required>
                                            
                                            <label for="validationCustom02" class="form-label">Create Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="create your password" required/>
                                            
                                            <label for="validationCustom02" class="form-label">Select Role</label>
                                            <select name="role" class="form-select" required>
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                           
                                           <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                            <label class="form-check-label" for="invalidCheck">
                                                Agree to terms and conditions
                                            </label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addmanages" class="btn btn-primary">Submit</button>
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