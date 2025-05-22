       <?php 
session_start();
if(isset($_SESSION['ADMIN_LOGIN'])&&$_SESSION['ADMIN_LOGIN']=='yes'){
        $company_name=$_SESSION['COMPANY_NAME'];
    $role=$_SESSION['ROLE'];
    $new_admin_name=$_SESSION['SLUG_ADMIN_NAME'];?>
    <script>
  window.location.href="https://reapbucks.com/offers";
  </script>
      <?php  }else{?>
<?php   
require('connection.php');
if(isset($_POST['forgot-submit'])){
  $email= mysqli_real_escape_string($con,$_POST['email']);
  $cat_res=mysqli_query($con,"select * from users where email='$email' order by id desc");
  $count=mysqli_num_rows($cat_res);
  if($count>0){
 $rpw=substr(sha1(mt_rand()),17,6);
 $rpw2=password_hash($rpw, PASSWORD_DEFAULT);
  include('smtp/PHPMailerAutoload.php');
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.zettamobi.com";
	$mail->Port = 25; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "info2@zettamobi.com";
	$mail->Password = "^DxnYeH9";
	$mail->SetFrom("info2@zettamobi.com");
	$mail->Subject = "Reset-Password";
	$mail->Body ="Your password has been reset. New password is : ".$rpw;
	$mail->AddAddress($email);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}
  mysqli_query($con,"update users set password='$rpw2',password_plain='$rpw' where email='$email'");
  header("location:https://reapbucks.com/auth-login");
  }
}
if(isset($_REQUEST['emailotp'])){
$email=$_REQUEST['emailotp'];
$otp1=rand(111111,999999);
 $_SESSION['otp1']=$otp1;
  include('smtp/PHPMailerAutoload.php');
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.zettamobi.com";
	$mail->Port = 25; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "info2@zettamobi.com";
	$mail->Password = "^DxnYeH9";
	$mail->SetFrom("info2@zettamobi.com");
	$mail->Subject = "Verification-OTP";
	$mail->Body ="Hi,<br>One Time Password for your account is : ".$otp1;
	$mail->AddAddress($email);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}
}
?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="https://reapbucks.com/assets/images/favicon.ico">

    
    <!-- dark layout js -->
    <script src="https://reapbucks.com/assets/js/pages/layout.js"></script>

    <!-- Bootstrap Css -->
    <link href="https://reapbucks.com/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="https://reapbucks.com/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- simplebar css -->
    <link href="https://reapbucks.com/assets/libs/simplebar/simplebar.min.css" rel="stylesheet">
    <!-- App Css-->
    <link href="https://reapbucks.com/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://reapbucks.com/assets/libs/sweetalert2/sweetalert2.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<body>

    <div class="container-fluid authentication-b overflow-hidden">
        <div class="bg-overlay"></div>
        <div class="row align-items-center justify-content-center min-vh-100">
            <div class="col-10 col-md-6 col-lg-4 col-xxl-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center">
                            <a href="" class="logo-dark">
                                <img src="https://reapbucks.com/assets/images/reapbucks.png" alt="logo here" width="40%" class="auth-logo logo-dark mx-auto">
                            </a>
                            <a href="https://reapbucks.com">
                                <i class="fa fa-times" style="position:absolute;right:20px; font-size:20px;color:red"></i>
                            </a>
                            <h4 class="mt-4">Welcome Back !</h4>
                            <p class="text-muted">Sign in to continue</p>
                        </div>
                    <div class="p-2 mt-5">
                            <form class="needs-validation" action="" method="post" novalidate>
                                <div class="input-group auth-form-group-custom mb-3">
                                    <span class="input-group-text bg-primary bg-opacity-10 fs-16 " id="basic-addon1"><i class="mdi mdi-account-outline auti-custom-input-icon"></i></span>
                                    <input type="email" class="form-control" placeholder="Enter email" aria-label="Username" name="email" aria-describedby="basic-addon1" required>
                                    <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                </div>

                                <div class="input-group auth-form-group-custom mb-3">
                                    <span class="input-group-text bg-primary bg-opacity-10 fs-16" id="basic-addon2"><i class="mdi mdi-lock-outline auti-custom-input-icon"></i></span>
                                    <input type="password" class="form-control" id="userpassword" placeholder="Enter password" aria-label="Username" name="password" aria-describedby="basic-addon1" required>
                                    <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                </div>

                                <div class="mb-sm-5">
                                    <div class="form-check float-sm-start">
                                        <!--<input type="checkbox" class="form-check-input" id="customControlInline">-->
                                        <!--<label class="form-check-label" for="customControlInline">Remember me</label>-->
                                    </div>
                                  <!--<div class="float-sm-end">
                                        <a href="javascript:void();" data-bs-toggle="modal" data-bs-target="#modal-forgot" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                    </div>-->
                                </div>

                                <div class="pt-3 text-center">
                                    <input class="btn btn-primary w-xl waves-effect waves-light" type="submit" name="login-submit">
                                </div>
                                <div class="mt-3 text-center">
                                    <p class="mb-0">Don't have an account ? <a href="javascript:void();" data-bs-toggle="modal" data-bs-target="#modal11" class="fw-medium text-primary"> Register </a> </p>
                                </div>
                                <div class="mt-3 text-center">
                                    <p class="mb-0">Forgot password ? <a href="javascript:void();" data-bs-toggle="modal" data-bs-target="#modal-forgot" class="fw-medium text-primary"> Reset </a> </p>
                                </div>
                               <!-- <div class="mt-4 text-center">
                                    <div class="signin-other-title position-relative">
                                        <h5 class="mb-0 title">or</h5>
                                    </div>
                                    <div class="mt-4 pt-1 hstack gap-3">
                                        <div class="vstack gap-2">
                                            <button type="button" class="btn btn-label-info d-block"><i class="ri-facebook-fill fs-18 align-middle me-2"></i>Sign in with facebook</button>
                                            <button type="button" class="btn btn-label-danger d-block"><i class="ri-google-fill fs-18 align-middle me-2"></i>Sign in with google</button>
                                        </div>
                                        <div class="vstack gap-2">
                                            <button type="button" class="btn btn-label-dark d-block"><i class="ri-github-fill fs-18 align-middle me-2"></i>Sign in with github</button>
                                            <button type="button" class="btn btn-label-success d-block"><i class="ri-twitter-fill fs-18 align-middle me-2"></i>Sign in with twitter</button>
                                        </div>

                                    </div>
                                </div>-->
                            </form>
                        </div>

                        <div class="mt-5 text-center">
                            <p>©
                                2017 Designed & Developed By Reabucks.com <!--<i class="mdi mdi-heart text-danger"></i>-->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <div class="modal fade" id="modal11">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">User Registration</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
                            </div>
                           
                            <div class="modal-body">
                                <div class="card">
                            <div class="card-body">
                                <form class="needs-validation" action="" method="post" novalidate>
                                    <div class="row">
                                        <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label"> Name</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Name" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="validationCustom02" class="form-label"> Email</label>
                                                <input type="email" class="form-control" id="em" name="email" placeholder="Enter a valid email" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="validationCustom02" class="form-label"> &nbsp </label>
                                              <button type="button" onclick="send();" id="otp-btn"class="btn btn-success form-control">Get OTP</button>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                         <div class="col-md-2 otp-box">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label"> Enter OTP</label>
                                                <input type="text" data-parsley-type="number" class="form-control"  name="otp" id="validationCustom" maxlength="6" minlength="6" placeholder="OTP" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label"> Mobile</label>
                                                <input type="text" data-parsley-type="number" class="form-control" pattern="[6789][0-9]{9}"  name="phone" id="validationCustom" maxlength="10" minlength="10" placeholder="Phone number" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                             <div class="mb-3">
                                                <label for="validationCustom02" class="form-label">Create Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="create your password" required/>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
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
                </div>
  
  <div class="modal fade" id="modal-forgot">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Forgot Password</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                            <div class="card-body">
                                <form class="needs-validation" action="" method="post" novalidate>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Enter Registered Email</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="email" placeholder="Enter email" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
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
    <script>
        $(document).ready(function() {
            $('.otp-box').hide();
            $('#otp-btn').click(function() {
                $('.otp-box').show();
            });
        });
    </script>
    <!-- JAVASCRIPT -->
    <?php require('connection.php');?>
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
    <script>Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Logged In Successfully',
  showConfirmButton: false,
  timer: 2500
})
setTimeout(() => {
  window.location.href="https://reapbucks.com/offers/<?= $offer_id?>";
}, "2600")</script>
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
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.zettamobi.com";
	$mail->Port = 25; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "info2@zettamobi.com";
	$mail->Password = "^DxnYeH9";
	$mail->SetFrom("info2@zettamobi.com");
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
    <script>Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'User registered successfully',
  showConfirmButton: false,
  timer: 2500
})
setTimeout(() => {
  window.location.href="https://reapbucks.com/offers/<?= $offer_id?>";
}, "2600")</script>

<?php
}
}

?>
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
                	      <script>	      Swal.fire({
  position: 'center',
  icon: 'error',
  title: 'Proxy Detected',
  showConfirmButton: false,
  timer: 2500
})
setTimeout(() => {
  window.location.href="https://reapbucks.com/auth-login";
}, "2600")</script>
           <?php }else{
		$row=mysqli_fetch_assoc($res);
			$verify=password_verify($password,$row['password']);
			if($verify==1){
			    $_SESSION['ADMIN_LOGIN']='yes';
			    $_SESSION['ADMIN_ID']=$row['id'];
	            $_SESSION['ADMIN_NAME']=$row['name'];
	            ?>
	      <script>	      Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Logged In',
  showConfirmButton: false,
  timer: 2500
})
setTimeout(() => {
  window.location.href="https://reapbucks.com/offers";
}, "2600")</script>  
<?php
			}
			else{
			    
		    ?>
    <script>Swal.fire({
  position: 'center',
  icon: 'error',
  title: 'Something went wrong',
  showConfirmButton: false,
  timer: 2500
})
setTimeout(() => {
  window.location.href="https://reapbucks.com/auth-login";
}, "2600")</script>
    
<?php
		}}
	}else{?>
	      <script>Swal.fire({
  position: 'center',
  icon: 'error',
  title: 'Something went wrong',
  showConfirmButton: false,
  timer: 2500
})
setTimeout(() => {
  window.location.href="https://reapbucks.com/auth-login";
}, "2600")</script>  
<?php	}
	}?>

<?php
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$date_time=date('d/m/Y H:i:s a');
if(isset($_POST['register-submit'])){	
$email=mysqli_real_escape_string($con,$_POST['email']);
$otp1=$_SESSION['otp1'];
$otp2=mysqli_real_escape_string($con,$_POST['otp']);
$name=mysqli_real_escape_string($con,$_POST['name']);
$phone=mysqli_real_escape_string($con,$_POST['phone']);
$password=mysqli_real_escape_string($con,$_POST['password']);
$password_hash=password_hash($password, PASSWORD_DEFAULT);
$check_user=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));
if($check_user>0){
    ?>
    <script>Swal.fire({
  position: 'top-end',
  icon: 'error',
  title: 'User already registered',
  showConfirmButton: false,
  timer: 2500
})
setTimeout(() => {
  window.location.href="https://reapbucks.com/auth-login";
}, "2600")</script>
    
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
   if($otp1==$otp2){        		
	mysqli_query($con,"insert into users(name,email,phone,password,password_plain,ip,location,device,timestamp,status) values('$name','$email','$phone','$password_hash','$password','$ipaddress','$country - $region - $cityy','$device - $manufacturer - $os - $version','$date_time','0')");

        ?>
    <script>Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'User registered successfully',
  showConfirmButton: false,
  timer: 2500
})
setTimeout(() => {
  window.location.href="https://reapbucks.com/auth-login";
}, "2600")</script>
    
<?php
}else{?>
       <script>Swal.fire({
  position: 'top-end',
  icon: 'error',
  title: 'Invalid OTP',
  showConfirmButton: false,
  timer: 2500
})
setTimeout(() => {
  window.location.href="https://reapbucks.com/auth-login";
}, "2600")</script> 
<?php }
}
}
?>
<?php 

// if(isset($_POST['forgot-submit'])){
// 	$username=mysqli_real_escape_string($con,$_POST['email']);
// 	$sql="select * from users where email='$username'";
// 	$res=mysqli_query($con,$sql);
// 	$count=mysqli_num_rows($res);
// 	if($count>0){
// 		$row=mysqli_fetch_assoc($res);
// 			$password=$row['plain_password'];
// 			$rolee=$row['role'];
// 			$company_id=$row['company_id'];
// 			if($rolee=='admin'){
// 			   $email="sonu.singh@performship.com";
// 			}else{
// 			    $sqlq="select email from users where company_id='$company_id' && role='admin'";
// 	                $resq=mysqli_query($con,$sqlq);
// 	            	$rowq=mysqli_fetch_assoc($resq);
// 	            	$email=$rowq['email']; 
// 			}
// include('smtp/PHPMailerAutoload.php');
// 	$mail = new PHPMailer(); 
// 	$mail->IsSMTP(); 
// 	$mail->SMTPAuth = true; 
// 	$mail->SMTPSecure = 'tls'; 
// 	$mail->Host = "sg2plzcpnl490052.prod.sin2.secureserver.net";
// 	$mail->Port = 587; 
// 	$mail->IsHTML(true);
// 	$mail->CharSet = 'UTF-8';
// //	$mail->SMTPDebug = 2; 
// 	$mail->Username = "info@rkelectrocare.com";
// 	$mail->Password = "cassata@email12";
// 	$mail->SetFrom("Cassata-CRM@rkelectrocare.com");
// 	$mail->Subject ="Frogot Password";
// 	$mail->Body ="Hi User,<br> Your password is : <b>".$password."</b><br>Thank You";
// 	$mail->AddAddress($email);
// 	$mail->SMTPOptions=array('ssl'=>array(
// 		'verify_peer'=>false,
// 		'verify_peer_name'=>false,
// 		'allow_self_signed'=>false
// 	));
// 	if(!$mail->Send()){
// 		//echo $mail->ErrorInfo;
// 	}else{?>
	    	      <script>//Swal.fire({
//   position: 'center',
//   icon: 'success',
//   title: 'Password sent on email',
//   showConfirmButton: false,
//   timer: 2500
// })
// setTimeout(() => {
//   window.location.href="https://rkelectrocare.com/auth-login";
// }, "2600")</script> 
 	<?php //}
// 	}else{?>
        	    	      <script>//Swal.fire({
//   position: 'center',
//   icon: 'error',
//   title: 'Email not registered',
//   showConfirmButton: false,
//   timer: 2500
// })
// setTimeout(() => {
//   window.location.href="https://rkelectrocare.com/auth-login";
// }, "2600")</script>
 <?php	//}
// }
?> 
	<script>
function get_city(){
			var id=jQuery('#validationCustom03a').val();
				jQuery.ajax({
					type:'post',
					url:'https://reapbucks.com/get_data.php',
					data:'id='+id+'&type=city',
					success:function(result){
						jQuery('#validationCustom03b').html(result);
					}
				});

}
	</script>
<script>
   function send(){
   $(document).ready(function(){
  var em= $("#em").val();
  $.ajax({
        type: "POST",
        url:"https://reapbucks.com/auth-login.php",
        data:'emailotp='+em,
        success: function(result) {
        }
    });
});
   }
</script>
    <script src="https://reapbucks.com/assets/libs/jquery/jquery.min.js"></script>
    <script src="https://reapbucks.com/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://reapbucks.com/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="https://reapbucks.com/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="https://reapbucks.com/assets/libs/node-waves/waves.min.js"></script>
<script src="https://reapbucks.com/assets/js/pages/form-validation.init.js"></script>
<script src="https://reapbucks.com/assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script src="https://reapbucks.com/assets/js/app.js"></script>

</body>
</html>
<?php }?>