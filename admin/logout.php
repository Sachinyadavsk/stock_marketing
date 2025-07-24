<?php
require('confige.php');
require('functions.inc.php');
session_start();
logActivity($con, 0, $role_type_is, '', 'admin Logged In');
unset($_SESSION['ADMIN_LOGIN']);
unset($_SESSION['ADMIN_USERNAME']);
header('location:https://reapbucks.com/admin/');
die();
?>