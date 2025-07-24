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
<?php

// Get fraud prevention settings
$sql = "SELECT * FROM fraud_prevention_settings WHERE id = 1 LIMIT 1";
$result = mysqli_query($con, $sql);
if (!$result) {
    die("Error loading settings: " . mysqli_error($con));
}
$settings = mysqli_fetch_assoc($result);
if (!$settings) {
    die("Settings not found.");
}

// Convert all setting values to boolean (except id)
foreach ($settings as $key => $value) {
    if ($key !== 'id') {
        $settings[$key] = ($value == 1) ? true : (($value == 0) ? false : $value);
    }
}

// print_r($settings);
// Get user and device info
$userId = $admin_id;
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$userIP = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$deviceId = hash('sha256', $userAgent . $userIP);

$currentCountry = getCountry($userIP);
$lastCountry = getLastCountry($userId);
$isVPN = isVPN();
$isRooted = isRooted();
$deviceUsers = getDeviceUserCount($con, $deviceId);

print_r($isRooted);
// Fraud prevention checks
if ($settings['single_account'] && $deviceUsers > 1) {
    exit("Blocked: Only one account per device.");
}

if ($settings['vpn_block'] && $isVPN) {
    exit("Blocked: VPN not allowed.");
}

if ($settings['vpn_monitor'] && $isVPN) {
    logVPN($con, $userId);
}

if ($settings['root_block'] && $isRooted) {
    exit("Blocked: Rooted devices are not allowed.");
}

if ($settings['auto_ban_multi'] && $deviceUsers > 1) {
    banUser($con, $userId, "Multiple accounts detected.");
}

if ($settings['auto_ban_vpn'] && $isVPN) {
    banUser($con, $userId, "VPN usage detected.");
}

if ($settings['auto_ban_root'] && $isRooted) {
    banUser($con, $userId, "Rooted device detected.");
}

if ($settings['ban_cc_change'] && $currentCountry !== $lastCountry) {
    banUser($con, $userId, "Country changed from $lastCountry to $currentCountry.");
}

if ($settings['prv_acc_del']) {
    deleteOtherAccounts($con, $deviceId, $userId);
}

// Helper functions

function getCountry($ip) {
    // Placeholder: return fixed country code or implement real GeoIP lookup
    return 'US';
}

function getLastCountry($userId) {
    // Placeholder: return last known country for user
    return 'US';
}

function isVPN() {
    // Placeholder: implement VPN detection here
    return false;
}

function isRooted() {
    // Placeholder: implement root detection here
    return false;
}

function getDeviceUserCount($deviceId) {
    return 1; // 
}

function logVPN($con, $userId) {
    $sql = "INSERT INTO vpn_logs (user_id, timestamp) VALUES (?, NOW())";
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) return;
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
}

function banUser($con, $userId, $reason) {
    $sql = "UPDATE users SET status = '0', banstatus = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        die("Database error: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, "si", $reason, $userId);
    mysqli_stmt_execute($stmt);
    exit("Banned: $reason");
}

function deleteOtherAccounts($con, $deviceId, $currentUserId) {
    $sql = "DELETE FROM users WHERE deviceid = ? AND id != ?";
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        die("Database error: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, "si", $deviceId, $currentUserId);
    mysqli_stmt_execute($stmt);
}
?>


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