<?php
require('confige.php');
require('functions.inc.php');

$msg='';
$color_class ='';

if(isset($_POST['submit'])){
	$token_id=get_safe_value($con,$_POST['token_id']);
	$a_note=get_safe_value($con,$_POST['a_note']);
    mysqli_query($con, "INSERT INTO notepanel (token_id, a_note, status) VALUES ('$token_id', '$a_note', '0')");
    header('location:index.php');
    die();
	
}
?>