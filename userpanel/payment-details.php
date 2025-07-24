
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require 'vendor/autoload.php';
 ?>
<!-- header top url start -->
<?php include("header_top.php");?>
<!-- header top url end -->
<?php 
session_start();
if(isset($_SESSION['ADMIN_LOGIN'])&&$_SESSION['ADMIN_LOGIN']=='yes'){
    $admin_id=$_SESSION['ADMIN_ID'];
    date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$date_time=date('d/m/Y H:i:s a');
$dateOnly = date('d/m/Y');
$timeOnly=date('H:i');
?>
<?php require('connection.php');?>
<?php require('userinfo.php');?>
<body class="g-sidenav-show  bg-gray-100 ">
    <!-- side nemu bar start -->
    <?php include("side_menu.php");?>
    <!-- side menu bar end -->

    <main class="main-content max-height-vh-100 h-100 position-relative border-radius-lg">
        <!-- Navbar -->
        <?php include("header.php");?>
        <!-- End Navbar -->

        <div class="container-fluid py-4">

            <meta name="csrf-token" content="yXjdRIbKmMP1Ae8EcyLoNGtH8SjLz37UMQYcLmpU">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Card header -->

                        <div class="card-header pb-0">
                            <div class="d-lg-flex">
                                <div>
                                    <h5 class="mb-1 font-weight-bolder">Payment Details</h5>
                                </div>
                                   <?php
                                        $check_user=mysqli_num_rows(mysqli_query($con,"select * from my_account where user_id='$admin_id'"));
                                        if($check_user>0){
                                        }else{
                                    ?>
                                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                                        <div class="ms-auto my-auto">
                                            <a href="javascript:void();" data-bs-toggle="modal" data-bs-target="#modal-forgot"  class="btn bg-gradient-info btn-sm mb-0">+&nbsp; ADD Method</a>
                                        </div>
                                    </div>
                                    <?php }?>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table table-flush" id="data-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Pay Method</th>
                                            <th>Pay ID</th>
                                            <th>Added On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <?php
                                                $cat_res=mysqli_query($con,"select * from my_account where user_id='$admin_id'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                mysqli_next_result($con);
                                                 foreach($cat_arr as $list){
                                                     $method_id=$list['method_id'];
                                                 $cat_res=mysqli_query($con,"select * from payment_methods where id='$method_id'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                mysqli_next_result($con);
                                                 foreach($cat_arr as $list1){
                                                     $method_name=$list1['method'];
                                                 }
                                            ?>
                                               
                                        <tr>
                                            <td class="text-sm"><?php echo $method_name;?></td>
                                            <td class="text-sm"> <span class="badge bg-primary"><?php echo $list['upi_id'];?></span></td>
                                            <td class="text-sm">
                                               <?php 
                                                 $date_string = $list['timestamp'];
                                                 $date = DateTime::createFromFormat("d/m/Y H:i:s a", $date_string);
                                                 $formatted_date = $date->format("F d Y a h:i");
                                                 echo $formatted_date;
                                                 ?>
                                                </td>
                                            <td class="text-sm">
                                                <a data-bs-toggle="modal" data-bs-target="#modal-edit<?php echo $list['id'];?>" data-bs-original-title="Edit">
                                                    <i class="fas fa-edit text-success"></i>
                                                </a>
                                            </td>
                                        </tr>
                                         <?php }
                                            mysqli_free_result($cat_res);?>
                                    </tbody>
                                </table>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
                $cat_res=mysqli_query($con,"select * from my_account");
                $cat_arr=array();
                while($row=mysqli_fetch_assoc($cat_res)){
                  $cat_arr[]=$row;    
                }
                 foreach($cat_arr as $list){
            ?>

       <!--Edit Payment ID-->
       
        <div class="modal fade" id="modal-edit<?php echo $list['id'];?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Payment ID</h5>
                        <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">X</button>
                    </div>
                    <?php $method_id=$list['id'];?>
                    <?php
                       $cat_res=mysqli_query($con,"select * from payment_methods where id='$method_id'");
                        $cat_arr=array();
                        while($row=mysqli_fetch_assoc($cat_res)){
                        $cat_arr[]=$row;    
                         }
                        foreach($cat_arr as $listz){
                        $method_name=$listz['method'];
                        }
                    ?>

                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form class="needs-validation" action="" method="post" novalidate>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="validationCustom01" class="form-label"> Payment Method</label>
                                                        <select class="form-select" id="validationCustom01" name="method" required>
                                                                <?php  if ($country == 'IN' && $method_name == 'upid') {?>
                                                                  <option value="<?php echo $list['method_id'];?>">
                                                                    <?php echo $method_name;?>
                                                                 </option>
                                                                <?php } ?>
                                                               <?php  if ($country != 'IN' && $method_name == 'paypal') {?>
                                                                    <option value="<?php echo $list['method_id'];?>">
                                                                       <?php echo $method_name;?>
                                                                    </option>
                                                                <?php } ?>
                                                            <?php
                                                        
                                                                $cat_res=mysqli_query($con,"select * from payment_methods");
                                                                $cat_arr=array();
                                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                                  $cat_arr[]=$row;    
                                                                }
                                                                mysqli_next_result($con);
                                                                 foreach($cat_arr as $list1){
                                                                     $method_name = strtolower($list1['method']);
                                                                    
                                                                ?>
                                                                 <?php  if ($country == 'IN' && $method_name == 'upid') {?>
                                                                      <option value="<?php echo $list1['id'];?>"><?php echo $method_name;?></option>
                                                                <?php } ?>
                                                                   <?php  if ($country != 'IN' && $method_name == 'paypal') {?>
                                                                        <option value="<?php echo $list1['id'];?>"><?php echo $method_name;?></option>
                                                                    <?php } ?>
                                                            <?php }?>
                                                        </select>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="validationCustom02" class="form-label"><?php if ($country == 'IN'){ echo 'UPI'; }else{ echo 'Paypal';}?>
                                                            ID</label>
                                                        <input type="text" class="form-control" id="em" name="upi"
                                                            placeholder="Enter a valid ID"
                                                            value="<?php echo $list['upi_id'];?>" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="editid" value="<?php echo $list['id'];?>">
                                            </div>

                                        </div>

                                        <div>
                                            <input class="btn btn-primary" name="edit-submit" type="submit">
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
        
        <!--payment edit details end-->
        
        <!--payment add details-->
                <div class="modal fade" id="modal-forgot">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Payment ID</h5>
                                <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">X</button>
                            </div>
        
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="needs-validation" action="" method="post" novalidate>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom01" class="form-label"> Payment
                                                                    Method</label>
                                                                <select class="form-select" id="validationCustom01"
                                                                    name="method" required>
                                                                    <option value="">--Select--</option>
                                                                    <?php
                                                                
                                                                        $cat_res=mysqli_query($con,"select * from payment_methods");
                                                                        $cat_arr=array();
                                                                        while($row=mysqli_fetch_assoc($cat_res)){
                                                                          $cat_arr[]=$row;    
                                                                        }
                                                                        mysqli_next_result($con);
                                                                         foreach($cat_arr as $list){
                                                                            $method_name = strtolower($list['method']);
                                                                               if ($country == 'IN' && $method_name == 'upid') {?>
                                                                                  <option value="<?php echo $list['id'];?>"><?php echo $method_name;?></option>
                                                                            <?php } ?>
                                                                               <?php  if ($country != 'IN' && $method_name == 'paypal') {?>
                                                                                    <option value="<?php echo $list['id'];?>"><?php echo $method_name;?></option>
                                                                                <?php } ?>
                                                                      
                                                                       <?php }?>
                                                                </select>
                                                                <div class="valid-feedback">
                                                                    Looks good!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom02" class="form-label"> <?php if ($country == 'IN'){ echo 'UPI'; }else{ echo 'Paypal';}?>
                                                                    ID</label>
                                                                <input type="text" class="form-control" id="em" name="upi"
                                                                    placeholder="Enter a valid ID" required>
                                                                <div class="valid-feedback">
                                                                    Looks good!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                          <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="validationCustom02" class="form-label"><?php if ($country == 'IN'){ echo 'UPI'; }else{ echo 'Paypal';}?>
                                                                        Email ID</label>
                                                                    <input type="text" class="form-control" id="email" name="email"
                                                                        placeholder="Enter a valid <?php if ($country == 'IN'){ echo 'UPI'; }else{ echo 'Paypal';}?> Email ID" required>
                                                                    <div class="valid-feedback">
                                                                        Looks good!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
        
                                                </div>
        
                                                <div>
                                                    <input class="btn btn-primary" name="register-submit" type="submit">
                                                </div>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--payment add details end-->

        <!--register-submit start-->
        <?php
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $date_time=date('d/m/Y H:i:s a');
        if(isset($_POST['register-submit'])){	
            $method=mysqli_real_escape_string($con,$_POST['method']);
            $upi=mysqli_real_escape_string($con,$_POST['upi']);
            $user_email=mysqli_real_escape_string($con,$_POST['email']);
            $check_user=mysqli_num_rows(mysqli_query($con,"select * from my_account where user_id='$admin_id'"));
            if($check_user>0){
                ?>
                <script>
                    Swal.fire({
                      position: 'top-end',
                      icon: 'error',
                      title: 'ID already exists',
                      showConfirmButton: false,
                      timer: 2500
                    })
                    setTimeout(() => {
                      window.location.href="";
                    }, "2600")
                </script>
                
            <?php
            }else{
                date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                $date_time=date('d/m/Y H:i:s a');
            	mysqli_query($con,"insert into my_account(user_id,method_id,upi_id,timestamp) values('$admin_id','$method','$upi','$date_time')");
                $last_id = mysqli_insert_id($con);
                logActivity($con, $last_id, $user_id_u, $user_id_n, 'Add new ayment details &nbsp;' . $ofrid);
                
                    include('smtp/PHPMailerAutoload.php');
                	$mail = new PHPMailer(); 
                	$mail->IsSMTP(); 
                	$mail->SMTPAuth = true; 
                	$mail->SMTPSecure = 'ssl'; 
                	$mail->Host = "smtp.titan.email";
                	$mail->Port = 465; 
                	$mail->IsHTML(true);
                	$mail->CharSet = 'UTF-8';
                	$mail->Username = "info@reapbucks.com";
                	$mail->Password = "Zettamobi@676";
                	$mail->SetFrom("info@reapbucks.com");
                	$mail->Subject = "Add Payment ID";
                	$mail->Body ="Payment ID validated successfully : ".$upi;
                	$mail->AddAddress($user_email);
                	$mail->SMTPOptions=array('ssl'=>array(
                		'verify_peer'=>false,
                		'verify_peer_name'=>false,
                		'allow_self_signed'=>false
                	));
                	if(!$mail->Send()){
                		echo $mail->ErrorInfo;
                	}
            
                    ?>
                <script>
                   Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Add new ayment details successfully',
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
        
        <!--register-submit end-->

        <!--Edit-submit start-->
    <?php
        if(isset($_POST['edit-submit'])){
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $date_time=date('d/m/Y H:i:s a');
        $method=mysqli_real_escape_string($con,$_POST['method']);
        $upi=mysqli_real_escape_string($con,$_POST['upi']);
        $editid=mysqli_real_escape_string($con,$_POST['editid']);
        $check_user=mysqli_num_rows(mysqli_query($con,"update my_account set method_id='$method', upi_id='$upi',timestamp='$date_time' where id='$editid'"));
        logActivity($con, $editid, $user_id_u, $user_id_n, 'Update payment details &nbsp;' . $editid);
        
        ?>
        
        <script>
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Update payment details',
              showConfirmButton: false,
              timer: 2500
            })
            setTimeout(() => {
              window.location.href="";
            }, "2600")
        </script>
   <?php }
  ?>
            <!-- footer start -->
            <?php include("footer.php");?>
            <!-- footer start -->
        </div>
        
        
    </main>
    <div>
    </div>
    
    <?php }else{
        header('location:https://reapbucks.com/userpanel/auth-login');
        }
        ?>

     <!-- footer url start -->
     <?php include("footer_url.php");?>
     <!-- footer url end -->