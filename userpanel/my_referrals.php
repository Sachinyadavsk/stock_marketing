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
                                    <h5 class="mb-1 font-weight-bolder">My Referrals &nbsp; 
                                    <?php 
                                       $usd = mysqli_query($con, "SELECT * FROM users WHERE id='$admin_id'");
                                       $ro = mysqli_fetch_assoc($usd);
                                       $referral_link = "https://reapbucks.com/userpanel/auth-login/?referrelcode=" . $ro['my_ref_code'];
                                    ?>
                                    <div class="reflayot">
                                        <p id="referralLink" style="margin: 0;"><?php echo $referral_link; ?></p>
                                        <i class="fa fa-clone" aria-hidden="true" onclick="copyReferral()" style="cursor: pointer;"></i>
                                    </div>
                                    </h5>
                                    
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
                                                $cat_re=mysqli_query($con,"SELECT * FROM my_earnings WHERE user_id='$admin_id' AND referral_status='1'");
                                                $cat_ar=array();
                                                while($ro=mysqli_fetch_assoc($cat_re)){
                                                  $cat_ar[]=$ro;    
                                                }
                                                mysqli_next_result($con);
                                                
                                                 foreach($cat_ar as $lis){
                                                     $offer_id=$lis['my_offer_id'];
                                                  
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
                                            <td class="text-sm">
                                                <?php 
                                                     $date_string = $list['timestamp'];
                                                     $date = DateTime::createFromFormat("d/m/Y H:i:s a", $date_string);
                                                     $formatted_date = $date->format("F d Y a h:i");
                                                     echo $formatted_date;
                                                 ?>
                                                </td>
                                            <td class="text-sm">
                                                 <?php 
                                                if($list['status']=='1'){?>
                                                    <span class="text text-success">Active</span>
                                                <?php }else{ ?>
                                                   <span class="text text-warning">Inctive</span>
                                                <?php } ?>
                                            </td>
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

            <script>
                function copyReferral() {
                    var text = document.getElementById("referralLink").innerText;
                    // Create temporary input to copy from
                    var tempInput = document.createElement("input");
                    tempInput.value = text;
                    document.body.appendChild(tempInput);
                    tempInput.select();
                    tempInput.setSelectionRange(0, 99999); // for mobile
                    document.execCommand("copy");
                    document.body.removeChild(tempInput);
                    alert("Referral link copied: " + text);
                }
            </script>
            
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