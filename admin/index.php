<?php 
    session_start();
    if(isset($_SESSION['ADMIN_LOGIN'])&&$_SESSION['ADMIN_LOGIN']=='yes'){
    $admin_name=$_SESSION['ADMIN_USERNAME'];?>
    <script>
    window.location.href="https://reapbucks.com/admin/dashboard";
    </script>
      <?php  }else{?>
    <?php session_start();
    require('confige.php');
    require('functions.inc.php');
    ?>

<?php


$msg='';
$color_class ='';

if(isset($_POST['submit'])){
	$email=get_safe_value($con,$_POST['email']);
	$password=get_safe_value($con,$_POST['password']);
	$sql="select * from admin where email='$email'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$row=mysqli_fetch_assoc($res);
			$verify=password_verify($password,$row['password']);
			if($verify==1){
			  if($row['role']=='superadmin'){
    			$_SESSION['ADMIN_LOGIN']='yes';
    			$_SESSION['ADMIN_ID']=$row['id'];
    			$_SESSION['ADMIN_USERNAME']=$email;
                $_SESSION['ROLE']=$row['role'];
                $_SESSION['EMP_ACCESS']='multiple_access';
		     	header('location:https://reapbucks.com/admin/dashboard');
		     	die();
			  }elseif ($row['role']=='admin') {
			    $_SESSION['ADMIN_LOGIN']='yes';
    			$_SESSION['ADMIN_ID']=$row['id'];
    			$_SESSION['ADMIN_USERNAME']=$email;
                $_SESSION['ROLE']=$row['role'];
                $_SESSION['EMP_ACCESS']='single';
		     	header('location:https://reapbucks.com/admin/dashboard');
		     	die();
			  }
			}
			else{
			$msg="Please enter correct login details";
			$color_class ='field_error';
			}
	}else{
		$msg="Please enter correct login details";	
		$color_class ='field_error';
	}
	
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Reap - Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <meta name="msapplication-TileColor" content="#206bc4" />
    <meta name="theme-color" content="#206bc4" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="msapplication-config" content="img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#0a5c17">
    <!-- CSS files -->
    <link href="assets/css/tabler.min.css" rel="stylesheet" />
    <link href="assets/css/demo.min.css" rel="stylesheet" />
    <link href="assets/css/extra.css" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/libs/sweetalert2/sweetalert2.min.css">
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center">
        <div class="container-tight py-6">
            <div class="text-center mb-4">
                <img src="./static/logo.svg" height="36" alt="">
            </div>
            <form class="card card-md" method="post">
                <div class="card-body">
                    <h2 class="mb-5 text-center" style="margin-bottom:20px !important">Admin Panel Login</h2>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <circle cx="12" cy="12" r="4"></circle>
                                    <path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28"></path>
                                </svg>
                            </span>
                            <input type="email" name="email" class="form-control" placeholder="Enter email..." required
                                autofocus tabindex="100">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Password <span class="form-label-description"><a
                                    href="login/forget" tabindex="104">I forgot
                                    password</a></span> </label>
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <circle cx="8" cy="15" r="4"></circle>
                                    <line x1="10.85" y1="12.15" x2="19" y2="4"></line>
                                    <line x1="18" y1="5" x2="20" y2="7"></line>
                                    <line x1="15" y1="8" x2="17" y2="10"></line>
                                </svg>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="password" required
                                tabindex="101">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input" required tabindex="102" />
                            <span class="form-check-label">Remember me on this device</span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" name="submit" class="btn btn-primary btn-block" tabindex="103">Sign in</button>
                    </div>
                </div>
                
            </form>
            <div class="<?php echo $color_class ?>"><?php echo $msg?></div>
        </div>
    </div>
    <!-- Libs JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>

<?php }?>