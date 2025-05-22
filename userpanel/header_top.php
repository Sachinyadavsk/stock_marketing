<?php 
    session_start();
    $comp_id=$_SESSION['COMPANY_ID'];
    $admin_id=$_SESSION['ADMIN_ID'];
    $role=$_SESSION['ROLE'];
    $company_name=$_SESSION['COMPANY_NAME'];
    $new_admin_name=$_SESSION['SLUG_ADMIN_NAME'];
?>
<?php require('connection.php');?>
<?php require('userinfo.php');?>
<!DOCTYPE html>
  <html lang="en" >
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>Reward Point</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- <link href="css/soft-ui-dashboard.css" rel="stylesheet" /> -->
  <!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.4" rel="stylesheet" />
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://reapbucks.com/assets/libs/sweetalert2/sweetalert2.min.css">
</head>