<?php
require('connection.php');
date_default_timezone_set("Asia/Calcutta");
$date_time = date('d/m/Y H:i:s a');

// Fetch parameters
$user_id = $_GET['uid'] ?? null;
$click_id = $_GET['cid'] ?? null;
$avts_id = $_GET['aid'] ?? null;

if (!$user_id || !$click_id || !$avts_id) {
    error_log("[ERROR] Missing required parameters: uid, cid, aid");
    exit;
}

// Get offer_id from accepted_ip
$res = mysqli_query($con, "SELECT offer_id, ip FROM accepted_ip WHERE id='$avts_id'");
$accepted_ip_data = mysqli_fetch_assoc($res);
if (!$accepted_ip_data) {
    error_log("[ERROR] No accepted_ip record found for aid=$avts_id");
    exit;
}
$offer_id = $accepted_ip_data['offer_id'];
$accepted_ip = $accepted_ip_data['ip'];

// Get user's IP
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

// Check for existing postback
$res = mysqli_query($con, "SELECT 1 FROM postback WHERE user_id='$user_id' AND offer_id='$offer_id' AND click_id='$click_id'");
if (mysqli_num_rows($res) > 0) {
    error_log("[INFO] Duplicate postback for UID: $user_id, Offer: $offer_id, Click: $click_id");
    header("Location: https://reapbucks.com/");
    exit;
}

// Get offer data
$res = mysqli_query($con, "SELECT points, point_status FROM offers WHERE id='$offer_id'");
$offer_data = mysqli_fetch_assoc($res);
if (!$offer_data) {
    error_log("[ERROR] Offer not found: ID=$offer_id");
    header("Location: https://reapbucks.com/");
    exit;
}
$points = $offer_data['points'];
$point_status = $offer_data['point_status'];

// Validate accepted IP match
if ($ipaddress !== $accepted_ip) {
    mysqli_query($con, "UPDATE users SET status='0' WHERE id='$user_id'");
    error_log("[FRAUD] IP mismatch for UID=$user_id. Expected: $accepted_ip, Got: $ipaddress");
    header("Location: https://reapbucks.com/");
    exit;
}

// Get click info
$res = mysqli_query($con, "SELECT user_ip, timestamp FROM offer_clicks WHERE user_id='$user_id' AND offer_id='$offer_id' AND click_id='$click_id'");
$click_data = mysqli_fetch_assoc($res);
if (!$click_data) {
    error_log("[ERROR] No click found for user_id=$user_id, offer_id=$offer_id");
    header("Location: https://reapbucks.com/");
    exit;
}
$user_click_ip = $click_data['user_ip'];
$user_click_timing = $click_data['timestamp'];

// Detect proxy
$ip_json = @file_get_contents("http://ip-api.com/json/$user_click_ip?fields=780287");
$ip_json = json_decode($ip_json, true);
$user_proxy = $ip_json['proxy'] ?? '';
$status = $user_proxy ? 'proxy' : '';

// Insert postback
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$uri = $_SERVER['REQUEST_URI'];
$current_page_url = $protocol . "://" . $host . $uri;
mysqli_query($con, "INSERT INTO postback(user_id,offer_id,click_id,ip,url,p1,p2,p3,p4,status,timestamp)
VALUES('$user_id','$offer_id','$click_id','$ipaddress','$current_page_url','','','','','$status','$date_time')");

// Get user details
$res = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($res);

// Get offer details
$res = mysqli_query($con, "SELECT * FROM offers WHERE id='$offer_id'");
$offer = mysqli_fetch_assoc($res);

// Get postback info
$res = mysqli_query($con, "SELECT * FROM postback WHERE user_id='$user_id' AND offer_id='$offer_id'");
$postback = mysqli_fetch_assoc($res);

// Check final report
$res = mysqli_query($con, "SELECT 1 FROM final_report WHERE offer_id='$offer_id' AND user_click_ip='$user_click_ip'");
$is_final_logged = mysqli_num_rows($res) > 0;

if ($is_final_logged) {
    mysqli_query($con, "INSERT INTO final_report(user_id, user_click_id, user_click_ip, user_name, user_email, user_phone_number, user_ip, user_device, user_location, user_proxy, user_click_time, postback_ip, postback_time, offer_id, offer_category, offer_name, offer_tracking_link, offer_device, offer_geo, offer_points, offer_cap, timestamp) 
    VALUES ('$user_id', '{$postback['click_id']}', '$user_click_ip', '{$user['name']}', '{$user['email']}', '{$user['phone']}', '{$user['ip']}', '{$user['device']}', '{$user['location']}', '$status', '$user_click_timing', '{$postback['ip']}', '{$postback['timestamp']}', '$offer_id', '{$offer['category']}', '{$offer['name']}', '{$offer['tracking_link']}', '{$offer['os']}', '{$offer['geo']}', '{$offer['points']}', '{$offer['cap']}', '$date_time')");
    
    mysqli_query($con, "UPDATE postback SET status='2' WHERE user_id='$user_id' AND offer_id='$offer_id' AND click_id='$click_id'");
    error_log("[INFO] Final report re-logged due to previous entry");
    header("Location: https://reapbucks.com/");
} else {
    if ($user_proxy) {
        mysqli_query($con, "INSERT INTO final_report(user_id, user_click_id, user_click_ip, user_name, user_email, user_phone_number, user_ip, user_device, user_location, user_proxy, user_click_time, postback_ip, postback_time, offer_id, offer_category, offer_name, offer_tracking_link, offer_device, offer_geo, offer_points, offer_cap, timestamp) 
        VALUES ('$user_id', '{$postback['click_id']}', '$user_click_ip', '{$user['name']}', '{$user['email']}', '{$user['phone']}', '{$user['ip']}', '{$user['device']}', '{$user['location']}', '$status', '$user_click_timing', '{$postback['ip']}', '{$postback['timestamp']}', '$offer_id', '{$offer['category']}', '{$offer['name']}', '{$offer['tracking_link']}', '{$offer['os']}', '{$offer['geo']}', '{$offer['points']}', '{$offer['cap']}', '$date_time')");
        
        error_log("[INFO] Proxy user inserted into final_report");
        header("Location: https://reapbucks.com/");
    } else {
        $earned_points = ($point_status === 'hold') ? 0 : $points;
        mysqli_query($con, "INSERT INTO my_earnings(user_id, my_offer_id, points, timestamp) 
        VALUES('$user_id', '$offer_id', '$earned_points', '$date_time')");

        mysqli_query($con, "INSERT INTO final_report(user_id, user_click_id, user_click_ip, user_name, user_email, user_phone_number, user_ip, user_device, user_location, user_proxy, user_click_time, postback_ip, postback_time, offer_id, offer_category, offer_name, offer_tracking_link, offer_device, offer_geo, offer_points, offer_cap, timestamp) 
        VALUES ('$user_id', '{$postback['click_id']}', '$user_click_ip', '{$user['name']}', '{$user['email']}', '{$user['phone']}', '{$user['ip']}', '{$user['device']}', '{$user['location']}', '$status', '$user_click_timing', '{$postback['ip']}', '{$postback['timestamp']}', '$offer_id', '{$offer['category']}', '{$offer['name']}', '{$offer['tracking_link']}', '{$offer['os']}', '{$offer['geo']}', '{$offer['points']}', '{$offer['cap']}', '$date_time')");
        
        error_log("[SUCCESS] Postback processed and earnings updated");
        header("Location: https://reapbucks.com/");
    }
}
?>
