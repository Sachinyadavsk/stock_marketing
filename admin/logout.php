<?php
session_start();
unset($_SESSION['ADMIN_LOGIN']);
unset($_SESSION['ADMIN_USERNAME']);
header('location:https://reapbucks.com/admin/');
die();
?>