<?php
require('confige.php');
require('functions.inc.php');

// Unban user
if(isset($_POST['banedirupdate'])){
    $userid = get_safe_value($con, $_POST['userid']);
    $reason = get_safe_value($con, $_POST['reason']);
  
    $check = mysqli_query($con, "SELECT reason FROM users WHERE id='$userid'");
    if(mysqli_num_rows($check) > 0){
        mysqli_query($con, "UPDATE users SET reason='$reason' WHERE id='$userid'");
        logActivity($con, $userid, $role_type_is, $reason, 'User reason update');
    } else {
        header("Location:banned.php");
    }
    
    header("Location:banned.php");
    die();
}

?>