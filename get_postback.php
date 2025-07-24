<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require 'vendor/autoload.php';
require('connection.php');
date_default_timezone_set("Asia/Calcutta");
$date_time = date('d/m/Y H:i:s a');
header('Content-Type: application/json');

    // // Fetch parameters
    // $current_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    // parse_str(parse_url($current_url, PHP_URL_QUERY), $params);
    
    // // Display aid and cid
    // $aid = isset($params['aid']) ? trim($params['aid'], '{}') : 'Not provided';
    // $cid = isset($params['clickid']) ? trim($params['clickid'], '{}') : 'Not provided';
    
    // $click_id = $cid ?? null;
    // $avts_id = $aid ?? null;
    
    // Fetch parameters
    $click_id = $_GET['clickid'] ?? null;
    $avts_id = $_GET['aid'] ?? null;
    
    if (!$click_id || !$avts_id) {
        echo json_encode(["status" => "error", "message" => "Missing required parameters: clickid or aid"]);
        exit;
    }
    
    // Step 1 - Fetch accepted IP record
    $res = mysqli_query($con, "SELECT id as avd_id, offer_id, ip FROM accepted_ip WHERE id='$avts_id'");
    $accepted_ip_data = mysqli_fetch_assoc($res);
    if (!$accepted_ip_data) {
        echo json_encode(["status" => "error", "message" => "No accepted_ip record found"]);
        exit;
    }
    $adv_offer_id = $accepted_ip_data['offer_id'];
    $accepted_ip = $accepted_ip_data['ip'];
    $avd_id = $accepted_ip_data['avd_id'];
    
    $accepted_ip_list = explode(',', $accepted_ip);
    // print_r($accepted_ip_list);
    // exit();
    
    // Step 2 - Detect current user IP
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

    // Step 3 - Check IP mismatch
   if (!in_array(trim($ipaddress), array_map('trim', $accepted_ip_list))) {
        $res = mysqli_query($con, "SELECT offer_id, user_id, timestamp, click_id, user_ip FROM offer_clicks WHERE aid='$avts_id' AND click_id='$click_id'");
        $click_data_reject = mysqli_fetch_assoc($res); 
        $user_id_reject = $click_data_reject['user_id'];
        if (!$click_data_reject) {
            $res = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id_reject'");
            $detail_users = mysqli_fetch_assoc($res);
            $email_users = $detail_users['email'];
             sendemailuser($email_users, 'Click data not found for rejection');
             echo json_encode(["status" => "error", "message" => "Click data not found for rejection"]);
             exit;
        }
        
        $offer_id_reject = $click_data_reject['offer_id'];
        $click_id_reject = $click_data_reject['click_id'];
        $user_ip_reject = $click_data_reject['user_ip'];
        $user_click_timing_reject = $click_data_reject['timestamp'];
        $reason ='IP mismatch for advertiser';
        // Get user details
        $res = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id_reject'");
        $user_reject = mysqli_fetch_assoc($res);
        // Get offer details
        $res = mysqli_query($con, "SELECT * FROM offers WHERE id='$offer_id_reject'");
        $offer_reject = mysqli_fetch_assoc($res);
        
         mysqli_query($con, "INSERT INTO reject(user_id, user_proxy, reason, user_click_id, user_click_ip, user_name, user_email, user_phone_number, user_ip, user_device, user_location, user_click_time, offer_id, offer_category, offer_name, offer_tracking_link, offer_device, offer_geo, offer_points, offer_cap, timestamp) 
         VALUES ('$user_id_reject', '', '$reason', '$click_id_reject', '$user_ip_reject', '{$user_reject['name']}', '{$user_reject['email']}', '{$user_reject['phone']}', '{$user_reject['ip']}', '{$user_reject['device']}', '{$user_reject['location']}', '$user_click_timing_reject', '$offer_id_reject', '{$offer_reject['category']}', '{$offer_reject['name']}', '{$offer_reject['tracking_link']}', '{$offer_reject['os']}', '{$offer_reject['geo']}', '{$offer_reject['points']}', '{$offer_reject['cap']}', '$date_time')");
         echo json_encode(["status" => "error", "message" => "IP mismatch for advertiser"]);
         exit;
    }
    
    // Step 4 - Check advertiser mismatch
    if ($avts_id !== $avd_id) {
        $res = mysqli_query($con, "SELECT offer_id, user_id, timestamp, click_id, user_ip FROM offer_clicks WHERE aid='$avts_id' AND click_id='$click_id'");
        $click_data_reject = mysqli_fetch_assoc($res); 
        $user_id_reject = $click_data_reject['user_id'];
        if (!$click_data_reject) {
            $res = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id_reject'");
            $detail_users = mysqli_fetch_assoc($res);
            $email_users = $detail_users['email'];
             sendemailuser($email_users, 'advertiser id and offer advertiser not mismatch for advertiser');
             echo json_encode(["status" => "error", "message" => "advertiser id and offer advertiser not mismatch for advertiser"]);
             exit;
        }
        
        $offer_id_reject = $click_data_reject['offer_id'];
        $click_id_reject = $click_data_reject['click_id'];
        $user_ip_reject = $click_data_reject['user_ip'];
        $user_click_timing_reject = $click_data_reject['timestamp'];
        $reason ='advertiser id and offer advertiser not mismatch for advertiser';
        // Get user details
        $res = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id_reject'");
        $user_reject = mysqli_fetch_assoc($res);
        // Get offer details
        $res = mysqli_query($con, "SELECT * FROM offers WHERE id='$offer_id_reject'");
        $offer_reject = mysqli_fetch_assoc($res);
        
         mysqli_query($con, "INSERT INTO reject(user_id, user_proxy, reason, user_click_id, user_click_ip, user_name, user_email, user_phone_number, user_ip, user_device, user_location, user_click_time, offer_id, offer_category, offer_name, offer_tracking_link, offer_device, offer_geo, offer_points, offer_cap, timestamp) 
         VALUES ('$user_id_reject', '', '$reason', '$click_id_reject', '$user_ip_reject', '{$user_reject['name']}', '{$user_reject['email']}', '{$user_reject['phone']}', '{$user_reject['ip']}', '{$user_reject['device']}', '{$user_reject['location']}', '$user_click_timing_reject', '$offer_id_reject', '{$offer_reject['category']}', '{$offer_reject['name']}', '{$offer_reject['tracking_link']}', '{$offer_reject['os']}', '{$offer_reject['geo']}', '{$offer_reject['points']}', '{$offer_reject['cap']}', '$date_time')");
         echo json_encode(["status" => "error", "message" => "advertiser id and offer advertiser not mismatch for advertiser"]);
         exit;
    }

    // step 5
    // Get click info
    $res = mysqli_query($con, "SELECT user_ip, timestamp, offer_id, user_id FROM offer_clicks WHERE aid='$avts_id' AND click_id='$click_id'");
    $click_data = mysqli_fetch_assoc($res);
    $user_id = $click_data['user_id'];
    if (!$click_data) {
        $res = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'");
        $detail_users = mysqli_fetch_assoc($res);
        $email_users = $detail_users['email'];
        sendemailuser($email_users, 'No click found for advertiser');
        echo json_encode(["status" => "error", "message" => "No click found for advertiser"]);
        exit;
    }
    $user_click_ip = $click_data['user_ip'];
    $offer_id = $click_data['offer_id'];
    $user_click_timing = $click_data['timestamp'];


    // step 7
    // Detect proxy
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
    
    //  echo json_encode(["status" => "error", "message" => "[$status]"]);

    // Step 7 - Insert postback
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    $current_page_url = $protocol . "://" . $host . $uri;
    mysqli_query($con, "INSERT INTO postback(user_id,offer_id,click_id,aid,ip,url,p1,p2,p3,p4,status,timestamp)
    VALUES('$user_id','$offer_id','$click_id','$avd_id','$ipaddress','$current_page_url','','','','','$status','$date_time')");
    
    // step 8
    // Get user details
    $res = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'");
    $user = mysqli_fetch_assoc($res);
    
    // Get offer details
    $res = mysqli_query($con, "SELECT * FROM offers WHERE id='$offer_id'");
    $offer = mysqli_fetch_assoc($res);
    
    // Get postback info
    $res = mysqli_query($con, "SELECT * FROM postback WHERE user_id='$user_id' AND offer_id='$offer_id'");
    $postback = mysqli_fetch_assoc($res);

    
    $final_check = mysqli_query($con, "SELECT * FROM leads WHERE offer_id='$offer_id' AND user_click_id='$click_id'");
    $is_leads_logged = mysqli_num_rows($final_check) > 0;
   if ($is_leads_logged) {
       // Get reject data insert with click id according
        $res = mysqli_query($con, "SELECT offer_id, user_id, timestamp, click_id, user_ip FROM offer_clicks WHERE aid='$avts_id' AND click_id='$click_id'");
        $click_data_reject = mysqli_fetch_assoc($res); 
        if (!$click_data_reject) {
          echo json_encode(["status" => "error", "message" => "A lead has already been recorded for click ID [$click_id]. Duplicate submissions are not allowed"]);
          exit;
        }
        
        $offer_id_reject = $click_data_reject['offer_id'];
        $click_id_reject = $click_data_reject['click_id'];
        $user_ip_reject = $click_data_reject['user_ip'];
        $user_id_reject = $click_data_reject['user_id'];
        $user_click_timing_reject = $click_data_reject['timestamp'];
        $reason ='aid click_id already data dublicate the lead data';
        // Get user details
        $res = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id_reject'");
        $user_reject = mysqli_fetch_assoc($res);
        // Get offer details
        $res = mysqli_query($con, "SELECT * FROM offers WHERE id='$offer_id_reject'");
        $offer_reject = mysqli_fetch_assoc($res);
        
         mysqli_query($con, "INSERT INTO reject(user_id, user_proxy, reason, user_click_id, user_click_ip, user_name, user_email, user_phone_number, user_ip, user_device, user_location, user_click_time, offer_id, offer_category, offer_name, offer_tracking_link, offer_device, offer_geo, offer_points, offer_cap, timestamp) 
                VALUES ('$user_id_reject', '$user_proxy', '$reason', '$click_id_reject', '$user_ip_reject', '{$user_reject['name']}', '{$user_reject['email']}', '{$user_reject['phone']}', '{$user_reject['ip']}', '{$user_reject['device']}', '{$user_reject['location']}', '$user_click_timing_reject', '$offer_id_reject', '{$offer_reject['category']}', '{$offer_reject['name']}', '{$offer_reject['tracking_link']}', '{$offer_reject['os']}', '{$offer_reject['geo']}', '{$offer_reject['points']}', '{$offer_reject['cap']}', '$date_time')");
         $email_users = $user_reject['email'];
         sendemailuser($email_users, 'Duplicate lead for this click User Account temporary blocked contact the admin');
         mysqli_query($con, "UPDATE users SET status='0' WHERE id='$user_id_reject'");
         echo json_encode(["status" => "error", "message" => "Duplicate lead for this click"]);
         exit;
   }else{
       if($user_proxy=='no'){
            mysqli_query($con, "INSERT INTO leads(user_id, user_click_id, user_click_ip, user_name, user_email, user_phone_number, user_ip, user_device, user_location, user_proxy, user_click_time, postback_ip, postback_time, offer_id, offer_category, offer_name, offer_tracking_link, offer_device, offer_geo, offer_points, offer_cap, timestamp) 
            VALUES ('$user_id', '{$postback['click_id']}', '$user_click_ip', '{$user['name']}', '{$user['email']}', '{$user['phone']}', '{$user['ip']}', '{$user['device']}', '{$user['location']}', '$status', '$user_click_timing', '{$postback['ip']}', '{$postback['timestamp']}', '$offer_id', '{$offer['category']}', '{$offer['name']}', '{$offer['tracking_link']}', '{$offer['os']}', '{$offer['geo']}', '{$offer['points']}', '{$offer['cap']}', '$date_time')");
            echo json_encode(["status" => "success", "message" => "Lead inserted successfully"]);
            exit;
       }elseif($user_proxy=='yes'){
           $email_users = $user['email'];
           sendemailuser($email_users, 'VPN Proxy detected User Account temporary blocked contact the admin');
           mysqli_query($con, "UPDATE users SET status='0' WHERE id='$user_id'");
           echo json_encode(["status" => "success", "message" => "Proxy detected"]);
           exit;
       } else {
            $email_users = $user['email'];
            sendemailuser($email_users, 'Proxy status unknown User Account temporary blocked contact the admin');
            mysqli_query($con, "UPDATE users SET status='0' WHERE id='$user_id'");
            echo json_encode(["status" => "error", "message" => "Proxy status unknown"]);
      }
       
   }


   // email send user
   function sendemailuser($email_users){
    $email = $email_users;
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.titan.email';
        $mail->Port = 465;
        $mail->Username = 'info@reapbucks.com';
        $mail->Password = 'Zettamobi@676';

        $mail->setFrom('info@reapbucks.com', 'ReapBucks OTP');
        $mail->addAddress($email);
        $mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
     	));

        $mail->isHTML(true);
        $mail->Subject = 'lead has already been recorded for click ID';
        $mail->Body = "
            <p>Hi,</p>
            <p>A lead has already been recorded for click ID . Duplicate submissions are not allowed</p>
            <p>Regards,<br>ReapBucks</p>
        ";

        $mail->send();
        // echo "lead sent successfully to your email.";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
   
    // ---------- Reusable function ----------
    
?>
