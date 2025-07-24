<?php
require('connection.php');
date_default_timezone_set("Asia/Calcutta");
$date_time = date('d/m/Y H:i:s a');

$logFile = __DIR__ . "/cron_log.txt";

// Step 1: Join leads, postback, users — no LIMIT
$sql = "
    SELECT 
        leads.user_click_id,
        leads.user_id,
        leads.offer_id,
        leads.user_click_ip,
        leads.user_click_time,
        postback.ip AS postback_ip,
        postback.timestamp AS postback_time,
        postback.click_id,
        users.name,
        users.email,
        users.phone,
        users.ip,
        users.device,
        users.location
    FROM leads
    INNER JOIN postback 
        ON leads.user_click_id = postback.click_id 
        AND leads.user_id = postback.user_id 
        AND leads.offer_id = postback.offer_id
    INNER JOIN users 
        ON leads.user_id = users.id
";

$res = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $user_click_id = $row['user_click_id'];
    $user_id = $row['user_id'];
    $offer_id = $row['offer_id'];
    $user_click_ip = $row['user_click_ip'];
    $user_click_timing = $row['user_click_time'];
    $postback_ip = $row['postback_ip'];
    $postback_time = $row['postback_time'];
    $click_id = $row['click_id'];

    // Detect proxy using external API
    // $ip_json = @file_get_contents("http://ip-api.com/json/$user_click_ip?fields=780287");
    // $ip_json = @file_get_contents("https://proxycheck.io/v2/$user_click_ip?vpn=1&asn=1");
    // $ip_json = json_decode($ip_json, true);
    // if (isset($ip_json[$user_click_ip])) {
    //     $user_proxy = $ip_json[$user_click_ip]['proxy'] ?? '';
    //     $status = ($user_proxy === 'no') ? 1 : 0;
    // } else {
    //     $user_proxy = '';
    //     $status = 0;
    // }
    
    
    $api_key = 'fg8678-s4y536-1840l5-783p75';
    $api_url = "https://proxycheck.io/v2/{$user_click_ip}?key={$api_key}&vpn=1&asn=1";
    $ip_json = @file_get_contents($api_url);
    $ip_json = json_decode($ip_json, true);
    // Check response and set proxy status
    if (isset($ip_json[$user_click_ip])) {
        $user_proxy = $ip_json[$user_click_ip]['proxy'] ?? '';
        $status = ($user_proxy === 'no') ? 1 : 0;
    } else {
        $user_proxy = '';
        $status = 0;
    }
    
    // Get offer data
    $offer_query = mysqli_query($con, "SELECT * FROM offers WHERE id='$offer_id'");
    $offer = mysqli_fetch_assoc($offer_query);
    if (!$offer) {
        file_put_contents($logFile, "[$date_time] [ERROR] Offer not found: ID=$offer_id\n", FILE_APPEND);
        continue;
    }

    $points = $offer['points'];
    $point_status = $offer['point_status'];

    // Get user details
    $user_query = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'");
    $user = mysqli_fetch_assoc($user_query);

    // Get postback details
    $postback_query = mysqli_query($con, "SELECT * FROM postback WHERE user_id='$user_id' AND offer_id='$offer_id'");
    $postback = mysqli_fetch_assoc($postback_query);

    // Check if already in final report
    $final_check = mysqli_query($con, "SELECT 1 FROM final_report WHERE offer_id='$offer_id' AND user_click_ip='$user_click_ip'");
    $is_final_logged = mysqli_num_rows($final_check) > 0;

    if ($is_final_logged) {
        // Update existing record
        mysqli_query($con, "
            UPDATE final_report 
            SET 
                user_name = '{$user['name']}',
                user_email = '{$user['email']}',
                user_phone_number = '{$user['phone']}',
                user_ip = '{$user['ip']}',
                user_device = '{$user['device']}',
                user_location = '{$user['location']}',
                user_proxy = '$status',
                user_click_time = '$user_click_timing',
                postback_ip = '{$postback['ip']}',
                postback_time = '{$postback['timestamp']}',
                offer_category = '{$offer['category']}',
                offer_name = '{$offer['name']}',
                offer_tracking_link = '{$offer['tracking_link']}',
                offer_device = '{$offer['os']}',
                offer_geo = '{$offer['geo']}',
                offer_points = '{$offer['points']}',
                offer_cap = '{$offer['cap']}',
                timestamp = '$date_time'
            WHERE offer_id = '$offer_id' AND user_click_ip = '$user_click_ip'
        ");

        mysqli_query($con, "UPDATE postback SET status='2' WHERE user_id='$user_id' AND offer_id='$offer_id' AND click_id='$click_id'");

        file_put_contents($logFile, "[$date_time] [INFO] Final report updated for existing entry\n", FILE_APPEND);
    } else {
        
        if ($user_proxy=='yes') {
            mysqli_query($con, "INSERT INTO final_report(user_id, user_click_id, user_click_ip, user_name, user_email, user_phone_number, user_ip, user_device, user_location, user_proxy, user_click_time, postback_ip, postback_time, offer_id, offer_category, offer_name, offer_tracking_link, offer_device, offer_geo, offer_points, offer_cap, timestamp) 
            VALUES ('$user_id', '{$postback['click_id']}', '$user_click_ip', '{$user['name']}', '{$user['email']}', '{$user['phone']}', '{$user['ip']}', '{$user['device']}', '{$user['location']}', '$status', '$user_click_timing', '{$postback['ip']}', '{$postback['timestamp']}', '$offer_id', '{$offer['category']}', '{$offer['name']}', '{$offer['tracking_link']}', '{$offer['os']}', '{$offer['geo']}', '{$offer['points']}', '{$offer['cap']}', '$date_time')");
        
        file_put_contents($logFile, "[$date_time] [INFO] Proxy user inserted into final_report\n", FILE_APPEND);
        } elseif($user_proxy=='no') {
            
            // referal code point
             $rfc_query = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'");
             $rfc_dl = mysqli_fetch_assoc($rfc_query);
             $referrel_user =$rfc_dl['referrel_code'];
             if(!empty($referrel_user)){
                   $rfc_user = mysqli_query($con, "SELECT * FROM users WHERE my_ref_code='$referrel_user'");
                   $rfc_dlf = mysqli_fetch_assoc($rfc_user);
                   $ref_codeuser = $rfc_dlf['id'];
                   if(!empty($ref_codeuser)){
                        mysqli_query($con, "INSERT INTO my_earnings(user_id, my_offer_id, points, timestamp, referral_status) 
                        VALUES('$ref_codeuser', '$offer_id', '5', '$date_time', '1')");
                        
                            $method ='Referral Point';
                            $parts = explode(' - ', $rfc_dlf['location']);
                            // Assign values with fallback
                            $country = isset($parts[0]) ? $parts[0] : '';
                            $region   = isset($parts[1]) ? $parts[1] : '';
                            $city    = isset($parts[2]) ? $parts[2] : '';
                        
                         mysqli_query($con, "INSERT INTO activity_history(user_id, method, point_name, price, ip_address, country, region, city, device, os) 
                        VALUES('$ref_codeuser', ' $method', '{$offer['name']}','5', '{$rfc_dlf['ip']}', '$country', '$region', '$city', '{$rfc_dlf['device']}', '{$offer['os']}')");
                        mysqli_query($con, "UPDATE users SET referrel_code='' WHERE id='$user_id'");
                        
                             $amp_query = mysqli_query($con, "SELECT * FROM users WHERE id='$ref_codeuser'");
                             $amp_ul = mysqli_fetch_assoc($amp_query);
                             $balance_user =$amp_ul['balance']+5;
                             mysqli_query($con, "UPDATE users SET balance='$balance_user' WHERE id='$ref_codeuser'");
                   }
             }
    
            $earned_points = ($point_status === 'hold') ? 0 : $points;
            mysqli_query($con, "INSERT INTO my_earnings(user_id, my_offer_id, points, timestamp) 
            VALUES('$user_id', '$offer_id', '$earned_points', '$date_time')");
        
            $method ='My Earning';
            $parts = explode(' - ', $user['location']);
            // Assign values with fallback
            $country = isset($parts[0]) ? $parts[0] : '';
            $region   = isset($parts[1]) ? $parts[1] : '';
            $city    = isset($parts[2]) ? $parts[2] : '';
        
         mysqli_query($con, "INSERT INTO activity_history(user_id, method, point_name, price, ip_address, country, region, city, device, os) 
        VALUES('$user_id', ' $method', '{$offer['name']}','$earned_points', '{$user['ip']}', '$country', '$region', '$city', '{$user['device']}', '{$offer['os']}')");
        
        // amount deitails
         $amp_query = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'");
         $amp_ul = mysqli_fetch_assoc($amp_query);
         $balance_user =$amp_ul['balance']+$earned_points;
         mysqli_query($con, "UPDATE users SET balance='$balance_user' WHERE id='$user_id'");

        mysqli_query($con, "INSERT INTO final_report(user_id, user_click_id, user_click_ip, user_name, user_email, user_phone_number, user_ip, user_device, user_location, user_proxy, user_click_time, postback_ip, postback_time, offer_id, offer_category, offer_name, offer_tracking_link, offer_device, offer_geo, offer_points, offer_cap, timestamp) 
        VALUES ('$user_id', '{$postback['click_id']}', '$user_click_ip', '{$user['name']}', '{$user['email']}', '{$user['phone']}', '{$user['ip']}', '{$user['device']}', '{$user['location']}', '$status', '$user_click_timing', '{$postback['ip']}', '{$postback['timestamp']}', '$offer_id', '{$offer['category']}', '{$offer['name']}', '{$offer['tracking_link']}', '{$offer['os']}', '{$offer['geo']}', '{$offer['points']}', '{$offer['cap']}', '$date_time')");
        
        file_put_contents($logFile, "[$date_time] [SUCCESS] Postback processed and earnings updated\n", FILE_APPEND);
        }
    }
}
?>
