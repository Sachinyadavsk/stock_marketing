<?php
$con=mysqli_connect("localhost","nwoowcom_offerwall","AwJkj3&v]yEK","nwoowcom_offerwall") or die('DATABASE connection failed');
$ipaddress_crm = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
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