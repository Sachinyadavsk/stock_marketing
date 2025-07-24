<?php
session_start();
$con=mysqli_connect("localhost","nwoowcom_offerwall","AwJkj3&v]yEK","nwoowcom_offerwall") or die('DATABASE connection failed');
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/php/ecommerce/');
define('SITE_PATH','http://127.0.0.1/php/ecommerce/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');

define('PRODUCT_MULTIPLE_IMAGE_SERVER_PATH',SERVER_PATH.'media/product_images/');
define('PRODUCT_MULTIPLE_IMAGE_SITE_PATH',SITE_PATH.'media/product_images/');

define('BANNER_SERVER_PATH',SERVER_PATH.'media/banner/');
define('BANNER_SITE_PATH',SITE_PATH.'media/banner/');

define('SHIPROCKET_TOKEN_EMAIL','gmail');
define('SHIPROCKET_TOKEN_PASSWORD','password');

?>


<?php
$role_type_is =$_SESSION['ROLE'];
function getUserInfo() {
    $ipaddress = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';

    $json = @file_get_contents("http://ipinfo.io/$ipaddress/geo");
    $json = json_decode($json, true);

    return [
        'ip' => $ipaddress,
        'country' => $json['country'] ?? '',
        'region' => $json['region'] ?? '',
        'city' => $json['city'] ?? '',
        'postal' => $json['postal'] ?? '',
        'loc' => $json['loc'] ?? '',
        'org' => $json['org'] ?? '',
        'device' => (stripos($_SERVER['HTTP_USER_AGENT'], 'mobile') !== false) ? 'mobile' : 'desktop',
        'os' => (stripos($_SERVER['HTTP_USER_AGENT'], 'iphone') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'ipad') !== false) ? 'ios' :
               (stripos($_SERVER['HTTP_USER_AGENT'], 'android') !== false ? 'android' :
               (stripos($_SERVER['HTTP_USER_AGENT'], 'windows') !== false ? 'windows' : 'unknown')),
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
    ];
}

function logActivity($con, $curl_id, $curl_name, $type, $description) {
    $info = getUserInfo();
    $type = $con->real_escape_string($type);
    $description = $con->real_escape_string($description);
    $sql = "INSERT INTO activity_logs 
            (curl_id, curl_name, activity_type, activity_description, ip_address, user_agent, country, region, city, postal, loc, org, device, os) 
            VALUES 
            ('$curl_id', '$curl_name', '$type', '$description', '{$info['ip']}', '{$info['user_agent']}', 
             '{$info['country']}', '{$info['region']}', '{$info['city']}', '{$info['postal']}', 
             '{$info['loc']}', '{$info['org']}', '{$info['device']}', '{$info['os']}')";

    $con->query($sql);
}

function hisActivity($con, $user_id, $method, $point_name, $price) {
    $info = getUserInfo();
    $method = $con->real_escape_string($method);
    $point_name = $con->real_escape_string($point_name);
    $sql = "INSERT INTO activity_logs 
            (user_id, method, point_name, price, ip_address, user_agent, country, region, city, postal, loc, org, device, os) 
            VALUES 
            ('$user_id', '$method', '$point_name', '$price', '{$info['ip']}', '{$info['user_agent']}', 
             '{$info['country']}', '{$info['region']}', '{$info['city']}', '{$info['postal']}', 
             '{$info['loc']}', '{$info['org']}', '{$info['device']}', '{$info['os']}')";

    $con->query($sql);
}
?>