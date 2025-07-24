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
                                    <h5 class="mb-0">Hot Offer</h5>
                                </div>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">

                                </div>
                            </div>
                        </div>
                        <!-- Card header -->
                        
                        <?php
                          if(isset($_REQUEST['offer_id'])&&$_REQUEST['offer_id']!=''){
                            $ii=$_REQUEST['offer_id'];
                            $cat_res=mysqli_query($con,"select * from offers where id='$ii' ");
                            $cat_arr=array();
                            while($row=mysqli_fetch_assoc($cat_res)){
                              $cat_arr[]=$row;    
                            }
                            mysqli_next_result($con);
                            foreach($cat_arr as $list){
                            ?>
                        <div class="modal fade" id="flow<?php echo $list['id'];?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><img src="<?php echo $list['icon_url'];?>">
                                            <?php echo $list['name'];?>
                                        </h5><button type="button" class="btn btn-sm btn-label-danger btn-icon"
                                            data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
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
                                                        <input type="hidden" name="ofrid"
                                                            value="<?php echo $list['id'];?>">
                                                        <button class="btn btn-success" name="pending_submit"
                                                            type="submit">Start</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                $("#flow<?php echo $ii; ?>").modal("show");
                            });
                        </script>
                        <?php }}?>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th style="padding-left:50px;">Offer</th>
                                            <th>Earn</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            <?php

                                                $cat_res=mysqli_query($con,"SELECT * FROM offers WHERE FIND_IN_SET('$os',os) AND FIND_IN_SET('$country',geo) AND status='1' AND hot='true'");
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
                                        <tr id="<?php echo $list['id']; ?>">
                                            <td class="text-sm">
                                                <?php echo $list['id']; ?>
                                            </td>
                                            <td class="text-sm">
                                                <span class="my-2 text-xs">
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#flow<?php echo $list['id']; ?>">
                                                        <img src="https://reapbucks.com/rb-admin/images/offers/<?php echo $list['icon_url']; ?>"
                                                            style="width:100px;height:50px;">
                                                        <h6>
                                                            <?php echo $list['name']; ?>
                                                        </h6>
                                                        <?php echo $list['quick_desc']; ?>
                                                    </a>
                                                </span>
                                            </td>
                                            <td class="text-sm">$
                                                <?php echo $list['points']; ?>
                                            </td>
                                            <td class="text-sm">
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#flow<?php echo $list['id']; ?>">Flow</button>
                                            </td>
                                        </tr>

                                        <!-- Modal for Each Offer -->
                                        <div class="modal fade" id="flow<?php echo $list['id']; ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <img src="https://reapbucks.com/rb-admin/images/offers/<?php echo $list['icon_url']; ?>"
                                                                style="height: 20px;">
                                                            <?php echo $list['name']; ?>
                                                        </h5>
                                                        <button type="button"
                                                            class="btn btn-sm btn-label-danger btn-icon"
                                                            data-bs-dismiss="modal">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <h5>Description:</h5>
                                                                            <p>
                                                                                <?php echo $list['description']; ?>
                                                                            </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <h5>Flow:</h5>
                                                                            <?php
                                                                                $flow2 = explode(',', $list['flow']);
                                                                                $i = 1;
                                                                                foreach ($flow2 as $f) {
                                                                                    echo $i . ' - ' . htmlspecialchars(trim($f)) . '<br>';
                                                                                    $i++;
                                                                                }
                                                                                ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" name="ofrid"
                                                                            value="<?php echo $list['id']; ?>">
                                                                        <button class="btn btn-primary"
                                                                            name="pending_submit"
                                                                            type="submit">Start</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                         $clickid=rand(0000000001,9999999999);
                        mysqli_query($con,"insert into offer_clicks(user_id,offer_id,click_id,sub_id,user_ip,user_country,user_state,user_city,user_device,user_os,timestamp)values('$admin_id','$ofrid','$clickid','','$ipaddress','$country','$region','$cityy','$device','$os','$date_time')");
                        $urll = $trl;
                        $user_id = $admin_id;
                        $offer_id = $ofrid;
                        $clickid = $clickid;
                        // $url = str_replace('{user_id}', $user_id, $url);
                        // $url = str_replace('{offer_id}', $offer_id, $url);
                        // $url = str_replace('{click_id}', $clickid, $url);
                        $final_id="$user_id".'_'."$offer_id".'_'."$clickid";
                        $url = str_replace('{click_id}', $final_id, $urll);
                        ?>
            <script>
                var newWindow = window.open("");
                newWindow.location.href = "<?php echo $url;?>";
            </script>
            <?php
                    }
                ?>

            <?php
     if(isset($_REQUEST['oid'])){
        $id=mysqli_real_escape_string($con,$_REQUEST['oid']);
        //$sql="select * from my_offers where user_id='$admin_id' && offer_id='$id'";
     	$res=mysqli_query($con,$sql);
	    $count=mysqli_num_rows($res);
	      if($count>0){
        ?>
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Offer Already Avilable',
                    showConfirmButton: false,
                    timer: 2500
                })
                setTimeout(() => {
                    // window.location.href="https://rkelectrocare.com/";
                }, "2600")
            </script>
            <?php  }else{
  
        //mysqli_query($con,"insert into my_offers(user_id,offer_id,time_stamp)values('$admin_id','$id','$date_time')");
    ?>

            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Offer Picked',
                    showConfirmButton: false,
                    timer: 2500
                })
                setTimeout(() => {
                    // window.location.href="https://rkelectrocare.com/";
                }, "2600")
            </script>
            <?php  }
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