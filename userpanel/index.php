<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require 'vendor/autoload.php';
session_start();
if(isset($_SESSION['ADMIN_LOGIN'])&&$_SESSION['ADMIN_LOGIN']=='yes'){
    $company_name=$_SESSION['COMPANY_NAME'];
    $role=$_SESSION['ROLE'];
    $user_id_u = $_SESSION['ADMIN_ID'];
    $new_admin_name=$_SESSION['SLUG_ADMIN_NAME'];?>
    <script>
        window.location.href = "https://reapbucks.com/userpanel/dashboard";
    </script>
<?php  }else{?>
<?php 
require('connection.php');

// forgot-submit
if(isset($_POST['forgot-submit'])){
  $email= mysqli_real_escape_string($con,$_POST['email']);
//   $cat_res=mysqli_query($con,"select * from users where email='$email' order by id desc");
//   $count=mysqli_num_rows($cat_res);
//   if($count>0){
//  $rpw=substr(sha1(mt_rand()),17,6);
//  $rpw2=password_hash($rpw, PASSWORD_DEFAULT);

// 	$mail = new PHPMailer(); 
// 	$mail->IsSMTP(); 
// 	$mail->SMTPAuth = true; 
// 	$mail->SMTPSecure = 'ssl'; 
// 	$mail->Host = "smtp.titan.email";
// 	$mail->Port = 465; 
// 	$mail->IsHTML(true);
// 	$mail->CharSet = 'UTF-8';
// 	$mail->Username = "info@reapbucks.com";
// 	$mail->Password = "Zettamobi@676";
// 	$mail->SetFrom("info@reapbucks.com");
// 	$mail->Subject = "Reset-Password";
// 	$mail->Body ="Your password has been reset. New password is : ".$rpw;
// 	$mail->AddAddress($email);
// 	$mail->SMTPOptions=array('ssl'=>array(
// 		'verify_peer'=>false,
// 		'verify_peer_name'=>false,
// 		'allow_self_signed'=>false
// 	));
// 	if(!$mail->Send()){
// 		echo $mail->ErrorInfo;
// 	}
//   mysqli_query($con,"update users set password='$rpw2',password_plain='$rpw' where email='$email'");
//   header("location:https://reapbucks.com/userpanel/auth-login");
//   }
   
   if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set("Asia/Kolkata");
            $created_at = date("Y-m-d H:i:s");
            $update_query = "UPDATE users SET reset_token = '$reset_token', reset_token_created_at = '$created_at' WHERE email = '$email'";

            if ($con->query($update_query)) {
                $reset_link = "https://reapbucks.com/userpanel/reset-password/" . urlencode($reset_token);
                $subject = "Password Reset Request";
                $message = "To reset your password, click the following link:\n\n$reset_link";

                // Send email using PHPMailer
                $mail = new PHPMailer(true);
                
                try {
                    $mail->isSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = 'smtp.titan.email';
                    $mail->Port = 465;
                    $mail->Username = 'info@reapbucks.com';
                    $mail->Password = 'Zettamobi@676';
            
                    $mail->setFrom('info@reapbucks.com', 'Reset Password');
                    $mail->addAddress($email);
                    $mail->SMTPOptions=array('ssl'=>array(
            		'verify_peer'=>false,
            		'verify_peer_name'=>false,
            		'allow_self_signed'=>false
                 	));
            
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body = $message;
            
                    $mail->send();
                    logActivity($con, $user_id_u, $role_type_is, $email, 'User Reset Password');
                    echo "<script>
                            alert('A password reset link has been sent to your email');
                            window.location.href = 'https://reapbucks.com/userpanel/auth-login';
                          </script>";
                } catch (Exception $e) {
                    echo "<script>
                            alert('Mailer Error: {$mail->ErrorInfo}');
                            window.location.href = 'https://reapbucks.com/userpanel/auth-login';
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Failed to update reset token. Please try again');
                        window.location.href = 'https://reapbucks.com/userpanel/auth-login';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Email address not found');
                    window.location.href = 'https://reapbucks.com/userpanel/auth-login';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Invalid email address');
                window.location.href = 'https://reapbucks.com/userpanel/auth-login';
              </script>";
    }
}

// emailotp

if (isset($_REQUEST['emailotp'])) {
    session_start(); // Ensure session is started
    $email = $_REQUEST['emailotp'];
    $otp1 = rand(111111, 999999);
    $_SESSION['otp1'] = $otp1;
   
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.titan.email';
        $mail->Port = 465;
        $mail->Username = 'info@reapbucks.com';
        $mail->Password = 'Zettamobi@676';

        $mail->setFrom('info@reapbucks.com', 'ReapBucks OTP');
        $mail->addAddress($email);
        $mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
     	));

        $mail->isHTML(true);
        $mail->Subject = 'Verification OTP';
        $mail->Body = "
            <p>Hi,</p>
            <p>Your OTP is: <strong>$otp1</strong></p>
            <p>Regards,<br>ReapBucks</p>
        ";

        $mail->send();
        echo "OTP sent successfully to your email.";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>Reward Point</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://reapbucks.com/userpanel/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://reapbucks.com/userpanel/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="https://reapbucks.com/userpanel/css/soft-ui-dashboard.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://reapbucks.com/userpanel/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="https://reapbucks.com/userpanel/assets/css/soft-ui-dashboard.css?v=1.0.4" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://reapbucks.com/assets/libs/sweetalert2/sweetalert2.min.css">
</head>

<body class="g-sidenav-show  bg-gray-100 ">
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('https://reapbucks.com/userpanel/assets/img/curved-images/curved9.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row d-flex flex-column justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                        <p class="text-lead text-white">Login to Access User Dashboard.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Sign in</h5>
                        </div>

                        <div class="card-body">
                            <form role="form" class="text-start" method="POST">
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="demo@gmail.com" aria-label="Email" name="email" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="demo@123" aria-label="Password" name="password" id="password" required>
                                </div>
                                <!--<div class="form-check form-switch">-->
                                <!--    <input class="form-check-input" type="checkbox" id="rememberMe" required>-->
                                <!--    <label class="form-check-label" for="rememberMe">Remember me</label>-->
                                <!--</div>-->
                                <div class="text-center">
                                    <button type="submit" name="login-submit" class="btn bg-gradient-info w-100 my-4 mb-2">Sign in</button>
                                </div>
                                <div class="mb-2 position-relative text-center">
                                    <p
                                        class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">Don't have an account ? <a href="javascript:void();"
                                            data-bs-toggle="modal" data-bs-target="#modal11"
                                            class="fw-medium text-primary"> Register </a>
                                    </p>
                                </div>
                                <div class="mt-3 text-center">
                                    <p class="mb-0">Forgot password ? <a href="javascript:void();"
                                            data-bs-toggle="modal" data-bs-target="#modal-forgot"
                                            class="fw-medium text-primary"> Reset </a> </p>
                                </div>
                                <div class="text-center"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row"></div>
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> All Right Reserved by
                        <a style="color: #252f40;" href="#" class="font-weight-bold ml-1" target="_blank"> Reward
                            Point</a>

                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <!--register modal start-->
    <div class="modal fade" id="modal11">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Registration</h5>
                    <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">X</button>
                </div>

                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" action="" method="post" novalidate>
                                <?php 
                                 $referrelcode =$_GET['referrelcode'];
                                 if(!empty($referrelcode)){?>
                                
                                      <label class="form-label">Referrel Code</label>
                                      <input type="text" name="referrelcode" class="form-control" value="<?php echo $referrelcode;?>" readonly>
                                 <?php }else{ ?>
                                     <input type="hidden" name="referrelcode">
                                 <?php }?>
                                 
                               
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"> Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"> Email</label>
                                                    <input type="email" class="form-control" id="em" name="email" placeholder="Enter a valid email" required>
                                                </div>
                                            </div>
                                             <div class="col-md-12">
                                                  <button type="button" onclick="send();" id="otp-btn" class="btn btn-success" style="float: right;">Get OTP</button>
                                            </div>
                                        </div>
                                       
                                        <div class="row">
                                            <div class="col-md-3 otp-box">
                                                <div class="mb-3">
                                                    <label class="form-label"> Enter OTP</label>
                                                    <input type="text" data-parsley-type="number" class="form-control" name="otp" maxlength="6" minlength="6" placeholder="OTP" required>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label class="form-label"> Mobile</label>
                                                    <input type="text" data-parsley-type="number" class="form-control" pattern="[6789][0-9]{9}" name="phone" 
                                                        maxlength="10" minlength="10" placeholder="Phone number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Create Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="create your password" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                                required>
                                            <label class="form-check-label" for="invalidCheck">
                                                Agree to terms and conditions
                                            </label>
                                            <div class="invalid-feedback">
                                                You must agree before submitting.
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
    <!--register modal end-->
    
    <!--forget password start-->
    <div class="modal fade" id="modal-forgot">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password</h5>
                       <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" action="" method="post" novalidate>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Enter Registered Email</label>
                                            <input type="text" class="form-control" name="email" placeholder="Enter email" required>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input class="btn btn-primary" name="forgot-submit" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--forget password end-->
    
    <!--dynmically code start-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const otpBox = document.querySelector('.otp-box');
            const otpBtn = document.getElementById('otp-btn');
    
            if (otpBox && otpBtn) {
                otpBox.style.display = 'none';
    
                otpBtn.addEventListener('click', function () {
                    otpBox.style.display = 'block';
                });
            }
        });
     </script>

    
    <!-- JAVASCRIPT -->
    <?php require('connection.php');?>
    

        <!--// request format start-->
        <?php 
           if(isset($_REQUEST['user_email'])&&($_REQUEST['user_email']!='')&&isset($_REQUEST['offer_id'])&&($_REQUEST['offer_id']!='')){
                $user_email=$_REQUEST['user_email'];
                $offer_id=$_REQUEST['offer_id'];
                $sql="select * from users where email='$user_email'";
            	$res=mysqli_query($con,$sql);
            	$count=mysqli_num_rows($res);
            	if($count>0){
    	    	$row=mysqli_fetch_assoc($res);
    	            $_SESSION['ADMIN_LOGIN']='yes';
    			    $_SESSION['ADMIN_ID']=$row['id'];
    	            $_SESSION['ADMIN_NAME']=$row['name'];
        ?>
            <script>
               Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Logged In Successfully',
                    showConfirmButton: false,
                    timer: 2500
                })
                setTimeout(() => {
                    window.location.href = "https://reapbucks.com/userpanel/offers/<?= $offer_id?>";
                }, "2600")
            </script>
        <?php
    }else{
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $date_time=date('d/m/Y H:i:s a');
         $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
    
    $json     = file_get_contents("http://ipinfo.io/$ipaddress/geo");
    $json     = json_decode($json, true);
     $country  = $json['country'];
     $region   = $json['region'];
     $cityy     = $json['city'];
     $postal     = $json['postal'];
     $locc     = $json['loc'];
      $isp     = $json['org'];     
           	$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
     $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows")); 
     $isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android")); 
     $isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone")); 
     $isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad")); 
     $isIOS = $isIPhone || $isIPad; 
      
     if($isMob){ 
    		 $device="mobile"; 
     }else{ 
    	 $device="desktop"; 
     } 
    
    // Get the user agent string
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    
    // Initialize variables
    $manufacturer = 'Unknown';
    $model = 'Unknown';
    $version = 'Unknown';
    
    // Check for common patterns in user agent to identify manufacturer, model, and version
    if (strpos($userAgent, 'Windows NT') !== false) {
        $manufacturer = 'Microsoft';
        $model = 'Windows';
    
        // Extract Windows version
        if (preg_match('/Windows NT (\d+\.\d+)/', $userAgent, $matches)) {
            $version = $matches[1];
        }
    } elseif (strpos($userAgent, 'Android') !== false) {
        $manufacturer = 'Android';
    
        // Extract Android version and model
        if (preg_match('/Android (\d+\.\d+); ([^;]+)/', $userAgent, $matches)) {
            $version = $matches[1];
            $model = $matches[2];
        }
    } elseif (strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false) {
        $manufacturer = 'Apple';
        $model = 'iOS';
    
        // Extract iOS version
        if (preg_match('/OS (\d+_\d+)/', $userAgent, $matches)) {
            $version = str_replace('_', '.', $matches[1]);
        }
    } elseif (strpos($userAgent, 'Macintosh') !== false) {
        $manufacturer = 'Apple';
        $model = 'Macintosh';
    
        // Extract macOS version
        if (preg_match('/Mac OS X (\d+_\d+)/', $userAgent, $matches)) {
            $version = str_replace('_', '.', $matches[1]);
        }
    } elseif (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Mobi') !== false) {
        $manufacturer = 'Generic';
        $model = 'Mobile';
    
        // Extract generic mobile device information
        if (preg_match('/Mobile\/(\S+)/', $userAgent, $matches)) {
            $version = $matches[1];
        }
    }
    
    
     if($isIOS){ 
    	 $os="ios"; 
     }elseif($isAndroid){ 
    	 $os="android"; 
     }elseif($isWin){ 
    	 $os="windows"; 
     } 
           $password=substr(sha1(mt_rand()),17,6);
           $password_hash=password_hash($password, PASSWORD_DEFAULT);
    	   mysqli_query($con,"insert into users(name,email,phone,password,password_plain,ip,location,device,timestamp,status) values('','$user_email','','$password_hash','$password','$ipaddress','$country - $region - $cityy','$device - $manufacturer - $os - $version','$date_time','1')");
    	   $insid=mysqli_insert_id($con);
           $_SESSION['ADMIN_LOGIN']='yes';
    	   $_SESSION['ADMIN_ID']=$insid;
    	   $_SESSION['ADMIN_NAME']='Guest';
    	            
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
    	$mail->Subject = "Password";
    	$mail->Body ="Your login password is : ".$password;
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
                title: 'User registered successfully',
                showConfirmButton: false,
                timer: 2500
            })
            setTimeout(() => {
                window.location.href = "https://reapbucks.com/userpanel/offers/<?= $offer_id?>";
            }, "2600")
        </script>
    
        <?php
    }
    }
        // request format start
    ?>
    
    
    <!--login submit start-->
    
    <?php
        $msg='';
        if(isset($_POST['login-submit'])){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
    	$username=mysqli_real_escape_string($con,$_POST['email']);
    	$password=mysqli_real_escape_string($con,$_POST['password']);
    	$sql="select * from users where email='$username' && status='1'";
    	$res=mysqli_query($con,$sql);
    	$count=mysqli_num_rows($res);
    	if($count>0){
    	        $json     = file_get_contents("http://ip-api.com/json/$user_click_ip?fields=780287");
                $json     = json_decode($json, true);
                $user_proxy=$json['proxy'];
                if($user_proxy=='true'){?>
            <script>	      
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Proxy Detected',
                    showConfirmButton: false,
                    timer: 2500
                })
                setTimeout(() => {
                    window.location.href = "https://reapbucks.com/userpanel/auth-login";
                }, "2600")
            </script>
        <?php }else{
    		    $row=mysqli_fetch_assoc($res);
    			$verify=password_verify($password,$row['password']);
    			if($verify==1){
    			    $_SESSION['ADMIN_LOGIN']='yes';
    			    $_SESSION['ADMIN_ID']=$row['id'];
    	            $_SESSION['ADMIN_NAME']=$row['name'];
    	            $_SESSION['ADMIN_EMAIL']=$row['email'];
    	            ?>
                <script>	      
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Logged In',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    setTimeout(() => {
                        window.location.href = "https://reapbucks.com/userpanel/dashboard";
                    }, "2600")
                </script>
        <?php
                $d_u =$_SESSION['ADMIN_ID'];
                mysqli_query($con,"update users set is_online='1' where id='$d_u'");
                logActivity($con, $_SESSION['ADMIN_ID'], $role_type_is, $_SESSION['ADMIN_NAME'], 'Logged In');
    			}
    			else{
    			    
    		    ?>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Something went wrong',
                    showConfirmButton: false,
                    timer: 2500
                })
                setTimeout(() => {
                    window.location.href = "https://reapbucks.com/userpanel/auth-login";
                }, "2600")
            </script>
    
        <?php
    		}}
    	}else{?>
           <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Something went wrong',
                    showConfirmButton: false,
                    timer: 2500
                })
                setTimeout(() => {
                    window.location.href = "https://reapbucks.com/userpanel/auth-login";
                }, "2600")
            </script>
        <?php	}
    	}
	?>
	
	 <!--login submit end-->


     <!--register submit start-->
    <?php
    
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $date_time=date('d/m/Y H:i:s a');
        if(isset($_POST['register-submit'])){	
                $email=mysqli_real_escape_string($con,$_POST['email']);
                $otp1=$_SESSION['otp1'];
                $otp2=mysqli_real_escape_string($con,$_POST['otp']);
                $name=mysqli_real_escape_string($con,$_POST['name']);
                $phone=mysqli_real_escape_string($con,$_POST['phone']);
                $referrelcode=mysqli_real_escape_string($con,$_POST['referrelcode']);
                $password=mysqli_real_escape_string($con,$_POST['password']);
                $password_hash=password_hash($password, PASSWORD_DEFAULT);
                $check_user=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));
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
                        window.location.href = "https://reapbucks.com/userpanel/auth-login";
                    }, "2600")
                </script>
        
            <?php
        }else{
            date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
            $date_time=date('d/m/Y H:i:s a');
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            } else if (isset($_SERVER['HTTP_FORWARDED'])) {
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            } else if (isset($_SERVER['REMOTE_ADDR'])) {
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            } else {
                $ipaddress = 'UNKNOWN';
            }
        
         $json     = file_get_contents("http://ipinfo.io/$ipaddress/geo");
         $json     = json_decode($json, true);
         $country  = $json['country'];
         $region   = $json['region'];
         $cityy     = $json['city'];
         $postal     = $json['postal'];
         $locc     = $json['loc'];
         $isp     = $json['org'];     
         $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
         $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows")); 
         $isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android")); 
         $isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone")); 
         $isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad")); 
         $isIOS = $isIPhone || $isIPad; 
          
         if($isMob){ 
        		 $device="mobile"; 
         }else{ 
        	 $device="desktop"; 
         } 
        
        // Get the user agent string
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        
        // Initialize variables
        $manufacturer = 'Unknown';
        $model = 'Unknown';
        $version = 'Unknown';
        
        // Check for common patterns in user agent to identify manufacturer, model, and version
        if (strpos($userAgent, 'Windows NT') !== false) {
            $manufacturer = 'Microsoft';
            $model = 'Windows';
        
            // Extract Windows version
            if (preg_match('/Windows NT (\d+\.\d+)/', $userAgent, $matches)) {
                $version = $matches[1];
            }
        } elseif (strpos($userAgent, 'Android') !== false) {
            $manufacturer = 'Android';
        
            // Extract Android version and model
            if (preg_match('/Android (\d+\.\d+); ([^;]+)/', $userAgent, $matches)) {
                $version = $matches[1];
                $model = $matches[2];
            }
        } elseif (strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false) {
            $manufacturer = 'Apple';
            $model = 'iOS';
        
            // Extract iOS version
            if (preg_match('/OS (\d+_\d+)/', $userAgent, $matches)) {
                $version = str_replace('_', '.', $matches[1]);
            }
        } elseif (strpos($userAgent, 'Macintosh') !== false) {
            $manufacturer = 'Apple';
            $model = 'Macintosh';
        
            // Extract macOS version
            if (preg_match('/Mac OS X (\d+_\d+)/', $userAgent, $matches)) {
                $version = str_replace('_', '.', $matches[1]);
            }
        } elseif (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Mobi') !== false) {
            $manufacturer = 'Generic';
            $model = 'Mobile';
        
            // Extract generic mobile device information
            if (preg_match('/Mobile\/(\S+)/', $userAgent, $matches)) {
                $version = $matches[1];
            }
        }
        
        
         if($isIOS){ 
        	 $os="ios"; 
         }elseif($isAndroid){ 
        	 $os="android"; 
         }elseif($isWin){ 
        	 $os="windows"; 
         } 
         
       
            function generateReferralCode() {
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $randomPart = '';
                for ($i = 0; $i < 8; $i++) {
                    $randomPart .= $characters[rand(0, strlen($characters) - 1)];
                }
                return 'ZTM' . $randomPart;
            }
            $myreferralCode = generateReferralCode();
           
           
           if($otp1==$otp2){        		
        	mysqli_query($con,"insert into users(name,email,phone,password,password_plain,ip,location,device,timestamp,status,my_ref_code,referrel_code) values('$name','$email','$phone','$password_hash','$password','$ipaddress','$country - $region - $cityy','$device - $manufacturer - $os - $version','$date_time','1','$myreferralCode','$referrelcode')");
           $last_id = mysqli_insert_id($con);
                ?>
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'User registered successfully',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    setTimeout(() => {
                        window.location.href = "https://reapbucks.com/userpanel/auth-login";
                    }, "2600")
                </script>
        
            <?php
               logActivity($con, $last_id, $role_type_is, $name, 'Add New User registered');
        }else{?>
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Invalid OTP',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    setTimeout(() => {
                        window.location.href = "https://reapbucks.com/userpanel/auth-login";
                    }, "2600")
                </script>
            <?php }
        }
        }
    ?>
    <!--register submit start-->
    
    
        <script>
            function get_city() {
                var id = jQuery('#validationCustom03a').val();
                jQuery.ajax({
                    type: 'post',
                    url: 'https://reapbucks.com/userpanel/get_data.php',
                    data: 'id=' + id + '&type=city',
                    success: function (result) {
                        jQuery('#validationCustom03b').html(result);
                    }
                });
    
            }
        </script>
        <script>
            function send() {
                $(document).ready(function () {
                    var em = $("#em").val();
                    $.ajax({
                        type: "POST",
                        url: "https://reapbucks.com/userpanel/auth-login",
                        data: 'emailotp=' + em,
                        success: function (result) {
                        }
                    });
                });
            }
       </script>
   
    <!--   Core JS Files   -->
    <script src="https://reapbucks.com/userpanel/assets/js/core/popper.min.js"></script>
    <script src="https://reapbucks.com/userpanel/assets/js/core/bootstrap.min.js"></script>
    <script src="https://reapbucks.com/userpanel/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="https://reapbucks.com/userpanel/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://reapbucks.com/userpanel/assets/js/plugins/sweetalert.min.js"></script>
    <script src="https://reapbucks.com/userpanel/assets/js/plugins/action.js"></script>

    <!-- Kanban scripts -->
    <script src="https://reapbucks.com/userpanel/assets/js/plugins/dragula/dragula.min.js"></script>
    <script src="https://reapbucks.com/userpanel/assets/js/plugins/jkanban/jkanban.js"></script>
    <script src="https://reapbucks.com/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="https://reapbucks.com/userpanel/assets/js/soft-ui-dashboard.min.js?v=1.0.4"></script>

</body>
</html>
<?php }?>