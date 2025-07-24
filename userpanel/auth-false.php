<?php
require('connection.php');
session_start();

if (isset($_SESSION['ADMIN_ID'])) {
    // Update is_online status
    $adminId = $_SESSION['ADMIN_ID'];
    $adminName = $_SESSION['ADMIN_NAME'] ?? 'Unknown';
    $roleType = $role_type_is ?? 'Unknown';

    mysqli_query($con, "UPDATE users SET is_online = '0' WHERE id = '$adminId'");
    logActivity($con, $adminId, $roleType, $adminName, 'logout User');
}

session_destroy();
header('Location: https://reapbucks.com/userpanel/auth-login');
exit;
?>
