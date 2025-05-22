<?php
include('connection.php');
$id=$_POST['id'];
$type=$_POST['type'];
$cat_res=mysqli_query($con,"select * from state where name='$id'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list2){
                                                     $idd=$list2['id'];
                                                 }
$cat_res=mysqli_query($con,"select * from city where state_id='$idd'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
	$html.='<option value='.$list['name'].'>'.$list['name'].'</option>';
}
echo $html;
?>