<?php
require('confige.php');
require('functions.inc.php');

// Unban user
if (isset($_GET['uid']) && $_GET['uid'] != '') {
      $uid = get_safe_value($con, $_GET['uid']);
        $check = mysqli_query($con, "SELECT * FROM users WHERE id='$uid'");
        if(mysqli_num_rows($check) > 0){
            mysqli_query($con, "UPDATE users SET banstatus='0' WHERE id='$uid'");
            logActivity($con, $uid, $role_type_is, '', 'user ban status');
        } else {
            header("Location:banned.php");
        }
        
        header("Location:banned.php");
        die();
}

?>