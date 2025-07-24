<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('connection.php');
$msg = '';
$color_class = '';

$request_uri = $_SERVER['REQUEST_URI'];

if (strpos($request_uri, '/userpanel/reset-password/') === 0) {
    $token = basename($request_uri);
    $token = mysqli_real_escape_string($con, $token);
    $query = "SELECT id, reset_token_created_at FROM users WHERE reset_token = '$token'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $users_id = $row['id'];
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
                    $update = "UPDATE users SET password = '$hashed_password', reset_token = NULL, reset_token_created_at = NULL WHERE id = $users_id";
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
<style>
    .field_success{
        color:green;
        font-weight:600px;
    }
    .field_error{
        color:red;
        font-weight:600px;
    }
</style>
<body class="g-sidenav-show  bg-gray-100 ">
    <main class="main-content  mt-0">
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0" style="margin-top: 339px;">
                        <div class="card-header text-center pt-4">
                            <h5>Admin Reset Password</h5>
                        </div>

                        <div class="card-body">
                            <form role="form" class="text-start" method="POST">
                                <div class="mb-3">
                                    <input type="password" name="new_password" class="form-control" placeholder="New password" required tabindex="101" aria-label="New password">
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" required tabindex="102" aria-label="Password">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Reset Password</button>
                                </div>
                               
                                <div class="mt-3 text-center">
                                    <p class="mb-0"><a href="https://reapbucks.com/userpanel/" class="fw-medium text-primary"> Welcome Back! Please Log In </a> </p>
                                </div>
                                <div class="text-center"></div>
                            </form>
                            <div class="<?php echo $color_class ?>"><?php echo $msg ?></div>
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
    <script src="https://reapbucks.com/userpanel/assets/js/soft-ui-dashboard.min.js?v=1.0.4"></script>

</body>
</html>
