<!-- header top url start -->
<?php include("header_top.php");?>
<!-- header top url end -->
<?php 
session_start();
if(isset($_SESSION['ADMIN_LOGIN'])&&$_SESSION['ADMIN_LOGIN']=='yes'){
    $admin_id=$_SESSION['ADMIN_ID'];
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Card header -->

                        <div class="card-header pb-0">
                            <div class="d-lg-flex">
                                <div>
                                    <h5 class="mb-1 font-weight-bolder">My Referrals</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table table-flush" id="data-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                           
                                            <th>Points</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <?php
                                                $cat_re=mysqli_query($con,"SELECT * FROM my_referrals WHERE user_id='$admin_id'");
                                                $cat_ar=array();
                                                while($ro=mysqli_fetch_assoc($cat_re)){
                                                  $cat_ar[]=$ro;    
                                                }
                                                mysqli_next_result($con);
                                                
                                                 foreach($cat_ar as $lis){
                                                     $offer_id=$lis['offer_id'];
                                                  
                                                $cat_res=mysqli_query($con,"SELECT * FROM offers WHERE id='$offer_id'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
                                                ?>
                                               
                                        <tr>
                                            <td class="text-sm"><?php echo $list['id'];?></td>
                                            <td class="text-sm"><?php echo $list['category'];?></td>
                                            <td class="text-sm"><?php echo $list['name'];?></td>
                                            <td class="text-sm"> <span class="badge bg-primary"><?php echo $list['points'];?></span></td>
                                            <td class="text-sm"><?php echo $list['timestamp'];?></td>
                                            <td class="text-sm"><?php echo $list['status'];?></td>
                                        </tr>
                                         <?php }
                                            mysqli_free_result($cat_re);
                                            }?>
                                    </tbody>
                                </table>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
      <?php
            if(isset($_POST['lead-delete'])){
                $ldid=mysqli_real_escape_string($con,$_POST['deleteid']);
                mysqli_query($con,"update leads set status='0' where id='$ldid'");?>
                
                    <script>
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Lead Deleted Successfully',
                          showConfirmButton: false,
                          timer: 2500
                        })
                        setTimeout(() => {
                          window.location.href="https://reapbucks.com/userpanel/leads";
                        }, "2600")
                    </script>
            <?php  }
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