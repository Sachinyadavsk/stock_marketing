<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('confige.php');
$msg = '';
$color_class = '';

$request_uri = $_SERVER['REQUEST_URI'];

if (strpos($request_uri, '/admin/reset-password/') === 0) {
    $token = basename($request_uri);
    $token = mysqli_real_escape_string($con, $token);
    $query = "SELECT id, reset_token_created_at FROM admin WHERE reset_token = '$token'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $admin_id = $row['id'];
        $created_at = strtotime($row['reset_token_created_at']);
        $now = time();

        if (($now - $created_at) <= 120) {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];

                if ($new_password !== $confirm_password) {
                    $msg = "Passwords do not match.";
                    $color_class = 'field_error';
                } else {
                    $hashed_password = mysqli_real_escape_string($con, password_hash($new_password, PASSWORD_BCRYPT));
                    $update = "UPDATE admin SET password = '$hashed_password', reset_token = NULL, reset_token_created_at = NULL WHERE id = $admin_id";
                    mysqli_query($con, $update);

                    $msg = "Password reset successfully!";
                    $color_class = 'field_success';
                }
            }
        } else {
            $msg = "Token has expired. Please request a new password reset.";
            $color_class = 'field_error';
        }
    } else {
        $msg = "Invalid or expired token.";
        $color_class = 'field_error';
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
    <link href="https://reapbucks.com/admin/assets/css/tabler.min.css" rel="stylesheet" />
    <link href="https://reapbucks.com/admin/assets/css/demo.min.css" rel="stylesheet" />
    <link href="https://reapbucks.com/admin/assets/css/extra.css" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://reapbucks.com/admin/assets/libs/sweetalert2/sweetalert2.min.css">
</head>
<style>
    .field_success{
        color:green;
        font-weight:600px;
    }
</style>
<body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center">
       <div class="container-tight py-6">
            <form class="card card-md" method="post">
                <div class="card-body">
                    <h2 class="mb-5 text-center" style="margin-bottom:20px !important">Admin Reset Password</h2>
                    <div class="mb-2">
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
                            <input type="password" name="new_password" class="form-control" placeholder="New password" required tabindex="101">
                        </div>
                    </div>
                    <div class="mb-2">
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
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" required tabindex="102">
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block" tabindex="103">Reset Password</button>
                    </div>
                    <label class="form-label">
                        <span class="form-label-description">
                            <a style="font-size:15px" href="https://reapbucks.com/admin/" tabindex="104">Welcome Back! Please Log In</a>
                        </span>
                    </label>
                </div>
            </form>
            <div class="<?php echo $color_class ?>"><?php echo $msg ?></div>
       </div>
    </div>
    <!-- Libs JS -->
    <script src="https://reapbucks.com/admin/assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://reapbucks.com/admin/assets/libs/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>
