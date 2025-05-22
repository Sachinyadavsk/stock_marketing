<?php
require('confige.php');
require('functions.inc.php');
$con->query("DELETE FROM chats");
include 'chatquick.php';
?>
