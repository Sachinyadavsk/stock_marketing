<!-- header top url start -->
<?php include("header_top.php");?>
<!-- header top url end -->
<style>
    .chat-container {
     height: 300px;
    overflow-y: auto;
    padding-right: 5px;
}
.chat-message {
    display: flex;
    margin: 10px 0;
}
.chat-left {
    justify-content: flex-start;
}
.chat-right {
    justify-content: flex-end;
}
.chat-bubble-user {
    background-color: #cce5ff;
    color: #000;
    padding: 10px 15px;
    border-radius: 10px;
    max-width: 60%;
    box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
}
.chat-bubble-admin {
    background-color: #d4edda;
    color: #000;
    padding: 10px 15px;
    border-radius: 10px;
    max-width: 60%;
    box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
    text-align: right;
}
button {
    padding: 5px 10px;
    font-size: 14px;
    cursor: pointer;
}

.unread-badge {
    background-color: red;
    color: white;
    padding: 2px 8px;
    font-size: 12px;
    border-radius: 12px;
    margin-left: 5px;
}

.reply-box {
    margin-top: 15px;
}
.reply-box textarea {
    width: 100%;
    height: 60px;
    padding: 8px;
}
.reply-box button {
    margin-top: 5px;
    padding: 6px 12px;
}
</style>

<?php
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$date_time=date('d/m/Y H:i:s a');
if(isset($_POST['update'])){	
 $newpass=mysqli_real_escape_string($con,$_POST['newpass']);
 $password_hash=password_hash($newpass, PASSWORD_DEFAULT);
 mysqli_query($con,"update users set password='$password_hash',password_plain='$newpass' where id='$admin_id'");
 logActivity($con, $admin_id, $user_id_u, $user_id_n, 'Password Updated &nbsp;' . $admin_id);
 ?>
 <script>
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Password Updated',
      showConfirmButton: false,
      timer: 2500
    })
    setTimeout(() => {
      window.location.href="";
    }, "2600")
</script>
 <?php
}

?>

<?php
if (isset($_POST['send'])) {
    $replyid = $_POST['replyid'];
    $message = $_POST['message'];
     $insert_query = "INSERT INTO messages (user_id, message, sender_type) VALUES ('$replyid', '$message', 'user')";
    mysqli_query($con, $insert_query);
    $last_id = mysqli_insert_id($con);
    logActivity($con, $last_id, $user_id_u, $user_id_n, 'Access updated &nbsp;' . $last_id);
      echo "<script>alert('Access updated successfully'); window.location='https://reapbucks.com/userpanel/settings';</script>";
}
?>



<?php
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$date_time=date('d/m/Y H:i:s a');
if(isset($_POST['update_profile'])){	
 $email=mysqli_real_escape_string($con,$_POST['email']);
 $name=mysqli_real_escape_string($con,$_POST['name']);
 $phone=mysqli_real_escape_string($con,$_POST['phone']);
 $city=mysqli_real_escape_string($con,$_POST['city']);
 $state=mysqli_real_escape_string($con,$_POST['state']);
mysqli_query($con,"update users set name='$name', email='$email',phone='$phone' where id='$admin_id'");
logActivity($con, $admin_id, $user_id_u, $user_id_n, 'Update profile &nbsp;' . $admin_id);
  $_SESSION['ADMIN_NAME'] = $name;
?>

 <script>
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Profile Updated',
      showConfirmButton: false,
      timer: 2500
    })
    setTimeout(() => {
      window.location.href="";
    }, "2600")
</script>
 <?php
}
?>
    <?php
                                                        
        $cat_res=mysqli_query($con,"select * from users where id='$admin_id'");
        $cat_arr=array();
        while($row=mysqli_fetch_assoc($cat_res)){
          $cat_arr[]=$row;    
        }
        mysqli_next_result($con);
         foreach($cat_arr as $list){
             $name=$list['name'];
            $email=$list['email'];
            $phone=$list['phone'];
            $city=$list['city'];
            $state=$list['state'];
            $timestamp=$list['timestamp'];
            $uid=$list['id'];
            $uip=$list['ip'];
         }
          mysqli_free_result($cat_res);?>
    
<body class="g-sidenav-show  bg-gray-100 ">
    <!-- side nemu bar start -->
    <?php include("side_menu.php");?>
    <!-- side menu bar end -->

    <main class="main-content max-height-vh-100 h-100 position-relative border-radius-lg">
        <!-- Navbar -->
        <?php include("header.php");?>
        <!-- End Navbar -->

        <div class="container-fluid my-3 py-3">
            <div class="row mb-5">
                <div class="col-lg-3">
                    <div class="card position-sticky top-1">
                        <ul class="nav flex-column bg-white border-radius-lg p-3">
                            <li class="nav-item">
                                <a class="nav-link text-body" data-scroll="" href="#profile">
                                    <div class="icon me-2">
                                        <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 40"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>spaceship</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(4.000000, 301.000000)">
                                                            <path class="color-background"
                                                                d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z">
                                                            </path>
                                                            <path class="color-background"
                                                                d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z">
                                                            </path>
                                                            <path class="color-background"
                                                                d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"
                                                                opacity="0.598539807"></path>
                                                            <path class="color-background"
                                                                d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"
                                                                opacity="0.598539807"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="text-sm">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body" data-scroll="" href="#basic-info">
                                    <div class="icon me-2">
                                        <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 44"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>document</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(154.000000, 300.000000)">
                                                            <path class="color-background"
                                                                d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                                opacity="0.603585379"></path>
                                                            <path class="color-background"
                                                                d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="text-sm">Basic Info</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body" data-scroll="" href="#change-password">
                                    <div class="icon me-2">
                                        <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 44"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>document</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(154.000000, 300.000000)">
                                                            <path class="color-background"
                                                                d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                                opacity="0.603585379"></path>
                                                            <path class="color-background"
                                                                d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="text-sm">Change Password</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body" data-scroll="" href="#redeem">
                                    <div class="icon me-2">
                                        <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 42 42"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>box-3d-50</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(603.000000, 0.000000)">
                                                            <path class="color-background"
                                                                d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                                            </path>
                                                            <path class="color-background"
                                                                d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"
                                                                opacity="0.7"></path>
                                                            <path class="color-background"
                                                                d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"
                                                                opacity="0.7"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="text-sm">Last 10 Withdrawal</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body" data-scroll="" href="#redeem">
                                    <div class="icon me-2">
                                        <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 44"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>switches</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-1870.000000, -440.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(154.000000, 149.000000)">
                                                            <path class="color-background"
                                                                d="M10,20 L30,20 C35.4545455,20 40,15.4545455 40,10 C40,4.54545455 35.4545455,0 30,0 L10,0 C4.54545455,0 0,4.54545455 0,10 C0,15.4545455 4.54545455,20 10,20 Z M10,3.63636364 C13.4545455,3.63636364 16.3636364,6.54545455 16.3636364,10 C16.3636364,13.4545455 13.4545455,16.3636364 10,16.3636364 C6.54545455,16.3636364 3.63636364,13.4545455 3.63636364,10 C3.63636364,6.54545455 6.54545455,3.63636364 10,3.63636364 Z"
                                                                opacity="0.6"></path>
                                                            <path class="color-background"
                                                                d="M30,23.6363636 L10,23.6363636 C4.54545455,23.6363636 0,28.1818182 0,33.6363636 C0,39.0909091 4.54545455,43.6363636 10,43.6363636 L30,43.6363636 C35.4545455,43.6363636 40,39.0909091 40,33.6363636 C40,28.1818182 35.4545455,23.6363636 30,23.6363636 Z M30,40 C26.5454545,40 23.6363636,37.0909091 23.6363636,33.6363636 C23.6363636,30.1818182 26.5454545,27.2727273 30,27.2727273 C33.4545455,27.2727273 36.3636364,30.1818182 36.3636364,33.6363636 C36.3636364,37.0909091 33.4545455,40 30,40 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="text-sm">User Activity</span>
                                </a>
                            </li>
                            
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body" data-scroll="" href="#notification">
                                    <div class="icon me-2">
                                        <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 44 43"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>megaphone</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2168.000000, -591.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(452.000000, 300.000000)">
                                                            <path class="color-background"
                                                                d="M35.7958333,0.273166667 C35.2558424,-0.0603712374 34.5817509,-0.0908856664 34.0138333,0.1925 L19.734,7.33333333 L9.16666667,7.33333333 C4.10405646,7.33333333 0,11.4373898 0,16.5 C0,21.5626102 4.10405646,25.6666667 9.16666667,25.6666667 L19.734,25.6666667 L34.0138333,32.8166667 C34.5837412,33.1014624 35.2606401,33.0699651 35.8016385,32.7334768 C36.3426368,32.3969885 36.6701539,31.8037627 36.6666942,31.1666667 L36.6666942,1.83333333 C36.6666942,1.19744715 36.3370375,0.607006911 35.7958333,0.273166667 Z">
                                                            </path>
                                                            <path class="color-background"
                                                                d="M38.5,11 L38.5,22 C41.5375661,22 44,19.5375661 44,16.5 C44,13.4624339 41.5375661,11 38.5,11 Z"
                                                                opacity="0.601050967"></path>
                                                            <path class="color-background"
                                                                d="M18.5936667,29.3333333 L10.6571667,29.3333333 L14.9361667,39.864 C15.7423448,41.6604248 17.8234451,42.4993948 19.6501416,41.764381 C21.4768381,41.0293672 22.3968823,38.982817 21.7341667,37.1286667 L18.5936667,29.3333333 Z"
                                                                opacity="0.601050967"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="text-sm">Send Message</span>
                                </a>
                            </li>
                            
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body" href="https://reapbucks.com/userpanel/auth-false">
                                    <div class="icon me-2">
                                        <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>settings</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(304.000000, 151.000000)">
                                                            <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                                            <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                                                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="text-sm">Logout</span>
                                </a>
                            </li>
                           
                           
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 mt-lg-0 mt-4">
                    <!-- Card Profile -->
                    <div class="card card-body" id="profile">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-auto col-4">
                                <div class="avatar avatar-xl position-relative w-100 border-radius-lg shadow-sm" style="background: #d072ba;font-size: 50px;font-weight: 600;">
                                    <?php
                                        $adminName = $_SESSION['ADMIN_NAME'];
                                        $firstChar = strtoupper($adminName[0]);
                                        echo $firstChar;
                                        ?>
                                    
                                </div>
                            </div>
                            <div class="col-sm-auto col-8 my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1 font-weight-bolder">
                                        <?php echo $_SESSION['ADMIN_NAME'];?>
                                    </h5>
                                    <p class="mb-0 font-weight-bold text-sm">
                                        Joined : <?php echo $timestamp?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">

                            </div>
                        </div>
                    </div>
                    <!-- Card Basic Info -->
                    <div class="card mt-4" id="basic-info">
                        <div class="card-header">
                            <h5>Profile</h5>
                        </div>
                        <div class="card-body pt-0">
                              <form class="" method="post" action="">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label class="form-label">User Name</label>
                                            <div class="input-group">
                                                <input id="name" class="form-control" type="text" name="name" value="<?php echo $name;?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label class="form-label">Email</label>
                                            <div class="input-group">
                                                <input id="email" class="form-control" type="email" name="email" value="<?php echo $email;?>" readonly> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="form-label mt-4">USER ID </label>
                                            <input class="form-control" value="RB<?php echo $uid;?>" readonly>
                                        </div>
                                        
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="form-label mt-4">Phone Number</label>
                                            <input id="phone" class="form-control" type="number" name="phone" value="<?php echo $phone;?>" readonly>
                                        </div>
                                        
                                        <div class="col-sm-12 col-md-2 col-lg-4">
                                            <label class="form-label mt-4">Status</label>
                                            <input class="form-control" value="Active" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="form-label mt-4">Country ISO </label>
                                            <input class="form-control" value="<?php echo $country;?>" readonly>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="form-label mt-4">Account IP</label>
                                            <input class="form-control" value="<?php echo $uip;?>"readonly>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="form-label mt-4">Joined On</label>
                                            <input class="form-control" value="<?php echo $timestamp?>"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="pt-3">
                                        <button class="btn btn-primary w-xl waves-effect waves-light" name="update_profile" type="submit" style="float: right;">Save</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                    
                    <!-- Card Basic Info -->
                    <div class="card mt-4" id="change-password">
                        <div class="card-header">
                            <h5>Change Password</h5>
                        </div>
                        <div class="card-body pt-0">
                             <form class="" method="post" action="">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" aria-label="Username" name="newpass" placeholder="New Password Here" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <button class="btn btn-primary w-xl waves-effect waves-light" name="update" type="submit" style="float: right;">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="card mt-4" id="redeem">
                        <div class="card-header">
                            <h5>Last 10 Withdrawal</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>REQUESTED TO</th>
                                            <th>COIN USED</th>
                                            <th>REDEEM TYPE</th>
                                            <th>STATUS</th>
                                            <th>ALIAS</th>
                                            <th>REDEEM SUBMIT</th>
                                            <th>REDEEM UPDATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--<tr id="397">-->
                                        <!--    <td class="text-sm">397</td>-->
                                        <!--    <td class="text-sm">9065642828</td>-->
                                        <!--    <td class="text-sm">100</td>-->
                                        <!--    <td class="text-sm"><span class="badge bg-dark">1 Rs</span></td>-->
                                        <!--    <td class="text-sm">Pending</td>-->
                                        <!--    <td class="text-sm"></td>-->
                                        <!--    <td class="text-sm">10-Aug-23 12:57:36</td>-->
                                        <!--    <td class="text-sm">01-Jan-70 00:00:00</td>-->

                                        <!--</tr>-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4" id="activity">
                        <div class="card-header">
                            <h5>User Activity</h5>

                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>TRANS ID</th>
                                            <th>COIN</th>
                                            <th>TYPE</th>
                                            <th>TASK</th>
                                            <th>ALIAS</th>
                                            <th>IP</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $limit = 10;
                                    $start = ($page - 1) * $limit;
                                    
                                    // Get activity data
                                    $sql = "
                                    SELECT 
                                        ah.id AS trans_id, ah.price AS coin, ah.ip_address, ah.created_at, ah.method AS task, ah.point_name AS alias
                                    FROM activity_history ah
                                    JOIN users u ON ah.user_id = u.id
                                    WHERE ah.user_id = $admin_id
                                    ORDER BY ah.created_at DESC
                                    LIMIT $start, $limit
                                    ";
                                    $result = mysqli_query($con, $sql);
                                    ?>
                                    <tbody>
                                    <?php if (mysqli_num_rows($result) > 0): ?>
                                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                                            <tr>
                                                <td><?php echo $admin_id;?><?= $row['trans_id'] ?></td>
                                                <td><?= $row['coin'] ?></td>
                                                <td class="text-sm">
                                                    <span class="badge bg-gradient-success">Credit</span>
                                                </td>
                                                <td><?= $row['task'] ?></td>
                                                <td><?= $row['coin'] ?> &nbsp; <?= $row['alias'] ?></td>
                                                <td><?= $row['ip_address'] ?></td>
                                                <td><?= $row['created_at'] ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr><td colspan="10">No activity found</td></tr>
                                    <?php endif; ?>
                                    </tbody>
                                    
                                    <?php
                                    // Pagination links
                                    $total_query = "SELECT COUNT(*) as total FROM activity_history WHERE user_id ='$admin_id'";
                                    $total_result = mysqli_query($conn, $total_query);
                                    $total_row = mysqli_fetch_assoc($total_result);
                                    $total_pages = ceil($total_row['total'] / $limit);
                                    ?>
                                    
                                    <nav>
                                      <ul class="pagination">
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                          <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="?user_id=<?= $admin_id ?>&page=<?= $i ?>"><?= $i ?></a>
                                          </li>
                                        <?php endfor; ?>
                                      </ul>
                                    </nav>
                                </table>

                            </div>
                        </div>
                    </div>
                    
                        <?php 
                          
                        $querya = "SELECT * FROM users WHERE id='$admin_id'";
                        $cat_resa = mysqli_query($con, $querya);
                        while ($lista = mysqli_fetch_assoc($cat_resa)) {
                        $user_id = $lista['id'];
                            
                         $unread_query = "SELECT COUNT(*) AS unread_count FROM messages WHERE user_id = '$admin_id' AND sender_type = 'user' AND is_read = 0";
                        $unread_result = mysqli_query($con, $unread_query);
                        $unread_data = mysqli_fetch_assoc($unread_result);
                        $unread_count = $unread_data['unread_count'];
                    
                        // Get all messages
                        $messages_query = "SELECT * FROM messages WHERE user_id = '$admin_id' ORDER BY created_at ASC";
                        $messages_result = mysqli_query($con, $messages_query);
                        ?>
                     <div class="card mt-4" id="notification">
                        <div class="card-header">
                            <h5>User Notification
                            <?php if ($unread_count > 0): ?>
                                <span class="unread-badge" id="badge-<?php echo $admin_id; ?>"><?php echo $unread_count; ?> unread</span>
                            <?php endif; ?>
                            </h5>

                        </div>
                        <div class="card-body pt-0">
                            <div class="chat-container">
                                <?php if (mysqli_num_rows($messages_result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($messages_result)): ?>
                                        <?php
                                            $is_user = $row['sender_type'] === 'user';
                                            $align_class = $is_user ? 'chat-right' : 'chat-left';
                                            $bg_class = $is_user ? 'chat-bubble-admin' : 'chat-bubble-user';
                                        ?>
                                        <div class="chat-message <?php echo $align_class; ?>">
                                            <div class="<?php echo $bg_class; ?>">
                                                <h4><?php echo nl2br(htmlspecialchars($row['title'])); ?></h4>
                                                <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                                                <small><?php echo $row['created_at']; ?></small>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <p>No active messages for this user.</p>
                                <?php endif; ?>
                            </div>
                            <div class="reply-box">
                                <form method="post">
                                <input type="hidden" name="replyid" value="<?php echo $admin_id; ?>">
                                <textarea name="message" placeholder="Type your message..."></textarea>
                                <button type="send" name="send" class="btn btn-success" style="float: right;">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>

                </div>
            </div>

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