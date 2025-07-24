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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-lg-flex">
                                <div>
                                    <h5 class="mb-0">All Offer</h5>
                                </div>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">

                                </div>
                            </div>
                        </div>

                        <!--offer list display-->
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table table-flush" id="data-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Offer</th>
                                            <th class="mobile_d">Install Details</th>
                                            <th>Earn</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            <?php

                                                $cat_res=mysqli_query($con,"SELECT * FROM offers WHERE FIND_IN_SET('$os',os) AND FIND_IN_SET('$country',geo) AND status='1'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                mysqli_next_result($con);
                                                 foreach($cat_arr as $list){
                                                $o_id=$list['id'];
                                                $i=0;
                                                $cat_re=mysqli_query($con,"SELECT * FROM postback WHERE offer_id='$o_id' and timestamp LIKE '$dateOnly%'");
                                                $cat_ar=array();
                                                while($ro=mysqli_fetch_assoc($cat_re)){
                                                  $cat_ar[]=$ro;    
                                                }
                                                 foreach($cat_ar as $lis){
                                                     $i++;
                                                 }
                                                 if($i>=$list['cap']){
                                                     
                                                 }else{
                                                    if(time()>=strtotime($list['cap_reset'])){
                                                        $j=0;
                                                        $cat_rez=mysqli_query($con,"SELECT * FROM postback WHERE user_id='$admin_id' and offer_id='$o_id'");
                                                $cat_arz=array();
                                                while($roz=mysqli_fetch_assoc($cat_rez)){
                                                  $cat_arz[]=$roz;    
                                                }
                                                 foreach($cat_arz as $lisz){
                                                     $j++;
                                                 }
                                                 if($j>=1){
                                                     
                                                 }else{
                                                ?>
                                            <tr>
                                                <td class="text-sm">
                                                    <?php echo $list['id']; ?>
                                                </td>
                                                <td class="text-sm">
                                                    <span class="my-2 text-xs">
                                                        <a data-bs-toggle="modal" data-bs-target="#modal-edit<?php echo $list['id'];?>" data-bs-original-title="Edit">
                                                            <img src="https://reapbucks.com/admin/images/offers/<?php echo $list['icon_url']; ?>"
                                                                style="width:100px;height:50px;" class="moimg">
                                                            <h6 class="text_mobile_view">
                                                                <?php echo $list['name'];?>
                                                            </h6>
                                                        </a>
                                                    </span>
                                                </td>
                                                <td class="text-lg text-dark mobile_d">
                                                    <?php echo $list['quick_desc']; ?>
                                                </td>
                                                <td class="text-sm">₹
                                                    <?php echo $list['points']; ?>
                                                </td>
                                                <td class="text-sm">
                                                    <a data-bs-toggle="modal" data-bs-target="#modal-edit<?php echo $list['id'];?>" class="btn btn-primary" data-bs-original-title="Edit">Flow</a>
                                                </td>
                                           </tr>

                                        <?php
                                        } // end j<1
                                      } // end i<cap
                                     } 
                                    }// end foreach
                                mysqli_free_result($cat_res);
                                ?>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
                $cat_res=mysqli_query($con,"select * from offers");
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
                        <h5 class="modal-title">
                            <img src="https://reapbucks.com/admin/images/offers/<?php echo $list['icon_url']; ?>" style="height: 20px;">
                             <?php echo $list['name'];?>
                            </h5>
                        <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">X</button>
                    </div>

                    <div class="modal-body">
                        <div class="card">
                           <div class="card-body">
                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <h5>Earn Point :  <?php echo $list['points'];?></h5>
                                            <br>
                                            <h5 class="modal-title">Description :</h5><br>
                                            <p>
                                                <?php echo $list['description'];?>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <h5 class="modal-title">Flow :</h5><br>
                                            <?php $flow=$list['flow'];
                                               $flow2=explode(',',$flow);
                                               $i=1;
                                               foreach($flow2 as $f){
                                                 echo $i .' - '. $s = $f.'<br>'; 
                                                 $i++;
                                               }
                                               ?>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <form action="" method="post">
                                        <input type="hidden" name="ofrid" value="<?php echo $list['id'];?>">
                                        <button class="btn btn-success" name="pending_submit" type="submit">Start</button>
                                    </form>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>

            <!-- Auto-show Modal if Offer ID is in URL -->
                <?php
                    if (isset($_REQUEST['offer_id']) && $_REQUEST['offer_id'] != '') {
                        $offer_id_safe = intval($_REQUEST['offer_id']);
                        ?>
                <script>
                    $(document).ready(function () {
                        $("#flow<?php echo $offer_id_safe; ?>").modal("show");
                    });
                </script>
                <?php } ?>

            <?php
                     if(isset($_POST['pending_submit'])){
                            $ofrid=$_POST['ofrid'];
                            $cat_res=mysqli_query($con,"select * from offers where id='$ofrid'");
                            $row=mysqli_fetch_assoc($cat_res);
                            $trl=$row['tracking_link'];
                            $points=$row['points'];
                            $point_status=$row['point_status'];
                            $aid=$row['aid'];
                            
                            $clickid = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
                            mysqli_query($con,"insert into offer_clicks(user_id,offer_id,click_id,aid,sub_id,user_ip,user_country,user_state,user_city,user_device,user_os,timestamp)values('$admin_id','$ofrid','$clickid','$aid','','$ipaddress','$country','$region','$cityy','$device','$os','$date_time')");
                            $urll = $trl;
                            $user_id = $admin_id;
                            $offer_id = $ofrid;
                            $clickid = $clickid;
                            $deviceid ='';
                            
                            $url = str_replace('{deviceid}', $deviceid, $urll);
                            $url = str_replace('{uid}', $user_id, $url);
                            $url = str_replace('{oid}', $offer_id, $url);
                            $url = str_replace('{clickid}', $clickid, $url);
                            $url = str_replace('{subid}', $user_id, $url);
                            
                            // print_r($url);
                            // exit();
                            $last_id = mysqli_insert_id($con);
                            mysqli_query($con, "UPDATE offer_clicks SET sub_id='$user_id' WHERE id='$last_id'");
                            logActivity($con, $last_id, $user_id_u, $user_id_n, 'Click link offer Id ' . $ofrid);
                            ?>
            <script>
                var newWindow = window.open("");
                newWindow.location.href = "<?php echo $url;?>";
            </script>
            <?php
                        }
                    ?>

            <!-- footer start -->
            <?php include("footer.php");?>
            <!-- footer start -->
        </div>
    </main>
    <div>
    </div>
    <!-- footer url start -->
    <?php include("footer_url.php");?>
    <!-- footer url end -->

    <?php }else{
        header('location:https://reapbucks.com/userpanel/auth-login');
        }
        ?>