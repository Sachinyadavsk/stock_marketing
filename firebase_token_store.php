<?php require('connection.php');?>
<?php 
if(isset($_POST['token'])&&$_POST['token']!=''){
$token=$_POST['token'];
$res=mysqli_query($con,"select * from tokens where token='$token'");
$check_user=mysqli_num_rows($res);
if($check_user>0){
}else{
      
          $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

$json     = file_get_contents("http://ipinfo.io/$ipaddress/geo");
$json     = json_decode($json, true);
 $country  = $json['country'];
 $region   = $json['region'];
 $city     = $json['city'];
 $postal     = $json['postal'];
 $loc     = $json['loc'];
  $isp     = $json['org'];     
       	$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
 $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows")); 
 $isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android")); 
 $isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone")); 
 $isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad")); 
 $isIOS = $isIPhone || $isIPad; 
  
 if($isMob){ 
		 $device="mobile"; 
 }else{ 
	 $device="desktop"; 
 } 
  
 if($isIOS){ 
	 $os="ios"; 
 }elseif($isAndroid){ 
	 $os="android"; 
 }elseif($isWin){ 
	 $os="windows"; 
 } 
mysqli_query($con,"insert into tokens(token,ip,device,country,state,city,pincode,loc,isp)values('$token','$ipaddress','$device - $os','$country','$region','$city','$postal','$loc','$isp')");
}
}
?>