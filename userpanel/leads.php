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
                                    <h5 class="mb-1 font-weight-bolder">Leads</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table table-flush" id="data-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><input type="checkbox" id="select_all"/> All</th>
                                            <th>ID</th>
                                            <th>Page</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                           <?php
                                                $cat_res=mysqli_query($con,"select * from leads where page_id='1'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
                                                     $p_id=$list['page_id'];
                                                ?>
                                                 <?php
                                                $cat_res=mysqli_query($con,"select name from pages where id='$p_id'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $lis){
                                                     $p_name=$lis['name'];
                                                 }
                                            ?>
                                               
                                        <tr>
                                            <td class="text-sm"><input type="checkbox" value="<?php echo $list['id'];?>,<?php echo $list['name'];?>,<?php echo $list['email'];?>,<?php echo $list['mobile'];?>,<?php echo $list['city'];?>,<?php echo $list['state'];?>" name="chk" class="all"/></td>
                                            <td class="text-sm"><?php echo $list['id'];?></td>
                                            <td class="text-sm"><?php echo $p_name;?></td>
                                            <td class="text-sm"><?php echo $list['name'];?></td>
                                            <td class="text-sm"><?php echo $list['email'];?></td>
                                            <td class="text-sm"><?php echo $list['mobile'];?></td>
                                            <td class="text-sm"><?php echo $list['city'];?></td>
                                            <td class="text-sm"></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
      
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