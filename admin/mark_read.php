<?php
// get_states.php
require('confige.php');
require('functions.inc.php');

if (isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);
    $query = "UPDATE messages SET is_read = 1 WHERE user_id = '$user_id' AND sender_type = 'user'";
    mysqli_query($con, $query);
}
?>