<?php
require('confige.php');
require('functions.inc.php');

$msg='';
$color_class ='';

$id = $_GET['id'];
$sql = "DELETE FROM chats WHERE id = $id";
$con->query($sql);

// Return updated chat
include 'chatquick.php';
?>
