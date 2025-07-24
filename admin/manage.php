<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

 <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Calcutta");
$date_time=date('d/m/Y H:i:s a');
if(isset($_POST['addmanages'])){	
    $role=mysqli_real_escape_string($con,$_POST['role']);
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
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
	mysqli_query($con,"insert into admin(email,password,pvalue,role) values('$name','$password_hash','$password','$role')");
	$last_id = mysqli_insert_id($con);
	logActivity($con, $last_id, $role_type_is, $name, 'User added successfully');
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
		logActivity($con, $id, $role_type_is, '', 'IP Deleted');
		
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
	
	 if($type=='active'){
    	$id=get_safe_value($con,$_GET['id']);
    	 mysqli_query($con,"update admin set status='0' where id='$id'");
    	 logActivity($con, $id, $role_type_is, '', 'User Admin Inctive');
    	}
    	
	if($type=='deactive'){
	$id=get_safe_value($con,$_GET['id']);
	 mysqli_query($con,"update admin set status='1' where id='$id'");
	 logActivity($con, $id, $role_type_is, '', 'User Admin Active');
	}
}
?>

<?php
    if (isset($_POST['editmanages'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (!empty($password)) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $query = "UPDATE admin SET name='$name', password='$password_hash', pvalue='$password', email='$email' WHERE id=$id";
        } else {
            $query = "UPDATE admin SET name='$name', email='$email' WHERE id=$id";
        }
    
        if (mysqli_query($con, $query)) {
            logActivity($con, $id, $role_type_is, $name, 'Admin updated successfully');
            echo "<script>alert('Admin updated successfully'); window.location.href='https://reapbucks.com/admin/manage/';</script>";
        } else {
            echo "<script>alert('Error updating admin');</script>";
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Password</th>
                                            <th>Date</th>
                                            <th class="w-1 text-center">Action</th>
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
                                                   if($list['role']=='admin'){  
                                                ?>
                                        <tr>
                                            <td class="text-muted text-nowrap" data-label="ID">
                                                <?php echo $i++;?>
                                            </td>
                                             <td class="text-muted text-nowrap" data-label="Name">
                                                <?php echo $list['name'];?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Email">
                                                <?php echo $list['email'];?>
                                            </td>
                                            <td data-label="Role">
                                                <div class="text-muted text-h5"><?php echo $list['role'];?></div>
                                            </td>
                                            <td data-label="Role">
                                                <div class="text-muted text-h5"><?php echo $list['pvalue'];?></div>
                                            </td>
                                            
                                            <td data-label="Date">
                                                <div class="text-muted text-h5"><?php echo $list['created_date'];?></div>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                     <?php if($list['status']=='1'){?>
                                                     <a class="btn btn-success" href="?type=active&id=<?php echo $list['id'];?>">Active</a>
                                                     <?php }else{?>
                                                     <a class="btn btn-danger" href="?type=deactive&id=<?php echo $list['id'];?>">Deactive</a>
                                                      <?php }?>
                                                     <a class="btn btn-dark" href="?type=delete&id=<?php echo $list['id'];?>">Delete</a>
                                                     <button class='btn btn-sm btn-success editBtn' data-id='<?php echo $list['id'];?>' data-password='<?php echo $list['pvalue'];?>' data-email='<?php echo $list['email'];?>' data-name='<?php echo $list['name'];?>'>Edit</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="float-right text-nowrap flex-nowrap">
                        </div>
                    </div>
                    
                    <!--add model start -->
                       <form method="POST" class="modal modal-blur fade" id="manage-add" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Manage Admin</h5>
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
                                           <label for="validationCustom01" class="form-label"> Name</label>
                                            <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="name" required>
                                            
                                           <label for="validationCustom01" class="form-label"> Email</label>
                                            <input type="email" class="form-control" id="validationCustom01" name="email" placeholder="Email" required>
                                            
                                            <label for="validationCustom02" class="form-label">Create Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="create your password" required/>
                                            
                                            <input type="hidden" class="form-control" name="role" value="admin">
                                            
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
                    <!--model end -->
                    
                    <form method="POST" class="modal fade" id="manage-edit" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Manage Admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span>&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                    
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="edit-name" required>
                            
                            <label class="form-label">Username</label>
                            <input type="email" class="form-control" name="email" id="edit-email" required>
                    
                           <label class="form-label">New Password</label>
                            <div class="input-group">
                              <input type="password" class="form-control" name="password" id="edit-password" placeholder="Leave blank to keep current">
                              <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                  <i class="fa fa-eye" id="toggle-icon"></i>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="editmanages" class="btn btn-primary">Update</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
          document.querySelectorAll('.editBtn').forEach(function (button) {
            button.addEventListener('click', function () {
              // Populate modal fields
              document.getElementById('edit-id').value = this.dataset.id;
              document.getElementById('edit-name').value = this.dataset.name;
              document.getElementById('edit-email').value = this.dataset.email;
              document.getElementById('edit-password').value = this.dataset.password;
        
              // Show the modal (Bootstrap 4)
              $('#manage-edit').modal('show');
            });
          });
        });
        
        
        function togglePassword() {
              const passwordField = document.getElementById('edit-password');
              const toggleIcon = document.getElementById('toggle-icon');
              
              if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
              } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
              }
            }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->