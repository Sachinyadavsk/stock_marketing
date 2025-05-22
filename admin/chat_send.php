<?php
require('confige.php');
require('functions.inc.php');

session_start();
$userid = $_SESSION['ADMIN_ID'];
$name = $_SESSION['ADMIN_USERNAME']; 
$is_staff = $_SESSION['ADMIN_ID'];

$msg = mysqli_real_escape_string($con, $_POST['msg']);
$sql = "INSERT INTO chats (userid, name, message, is_staff) VALUES ('$userid', '$name', '$msg', '$is_staff')";
$con->query($sql);

// Return updated chat
include 'https://reapbucks.com/rb-admin/chatquick.php';
?>
