<?php require('connection.php');
if (isset($_GET['uid']) && isset($_GET['cid']) && isset($_GET['aid'])) {
 date_default_timezone_set("Asia/Calcutta");
 $date_time=date('d/m/Y H:i:s a');

 $user_id = $_GET['uid'];
//  $offer_id = $_GET['oid'];
 $click_id = $_GET['cid'];
 $avts_id = $_GET['aid'];
    $cat_res=mysqli_query($con,"select offer_id from accepted_ip where id='$avts_id'");
     $cat_arr=array();
     while($row=mysqli_fetch_assoc($cat_res)){
       $cat_arr[]=$row;    
     }
     foreach($cat_arr as $list){
         $offer_id=$list['offer_id'];
     }

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
    

    $sql="select * from postback where user_id='$user_id' and offer_id='$offer_id' and click_id='$click_id'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
	    error_log("postback url Already Using. Please Others Post back try again!");
	    exit;
	}else{
                                                        
        $cat_res=mysqli_query($con,"select points,point_status from offers where id='$offer_id'");
        $cat_arr=array();
        while($row=mysqli_fetch_assoc($cat_res)){
          $cat_arr[]=$row;    
        }
         foreach($cat_arr as $list){
             $points=$list['points'];
             $point_status=$list['point_status'];
         }
                                                 
            $sql="select * from accepted_ip where id='$avts_id' and ip='$ipaddress'";
        	$res=mysqli_query($con,$sql);
        	$count=mysqli_num_rows($res);
        	if($count>0){
        	    
        	$sq="select * from postback where user_id='$user_id' and offer_id='$offer_id'";
        	$re=mysqli_query($con,$sq);
        	$coun=mysqli_num_rows($re);
        	if($coun==0){
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $uri = $_SERVER['REQUEST_URI'];

             $current_page_url = $protocol . "://" . $host . $uri;
             $cat_res=mysqli_query($con,"select user_ip from offer_clicks where user_id='$user_id' and offer_id='$offer_id' and click_id='$click_id'");
             $cat_arr=array();
             while($row=mysqli_fetch_assoc($cat_res)){
               $cat_arr[]=$row;    
             }
             foreach($cat_arr as $list){
                 $user_click_ip=$list['user_ip'];
                 $user_click_timing = isset($list['timestamp']) ? $list['timestamp'] : null;
                 $json = file_get_contents("http://ip-api.com/json/$user_click_ip?fields=780287");
                 $json = json_decode($json, true);
                 $user_proxy=$json['proxy'];
             }
             
            //  insert the postback url start code    
	          mysqli_query($con,"insert into postback(user_id,offer_id,click_id,ip,url,p1,p2,p3,p4,status,timestamp)values('$user_id','$offer_id','$click_id','$ipaddress','$current_page_url','','','','','$status','$date_time')");
	          $cat_res=mysqli_query($con,"select * from users where id='$user_id'");
              $cat_arr=array();
              while($row=mysqli_fetch_assoc($cat_res)){
                 $cat_arr[]=$row;    
              }
             foreach($cat_arr as $list){
                 $user_name=$list['name'];
                 $user_email=$list['email'];
                 $user_mobile_number=$list['phone'];
                 $user_ip=$list['ip'];
                 $user_location=$list['location'];
                 $user_device=$list['device'];
             }
              //  insert the postback url end code    
             
              //  select offers start
                $cat_res=mysqli_query($con,"select * from offers where id='$offer_id'");
                $cat_arr=array();
                while($row=mysqli_fetch_assoc($cat_res)){
                  $cat_arr[]=$row;    
                }
                 foreach($cat_arr as $list){
                     $offer_name=$list['name'];
                     $offer_category=$list['category'];
                     $offer_tracking_link=$list['tracking_link'];
                     $offer_device=$list['os'];
                     $offer_geo=$list['geo'];
                     $offer_points=$list['points'];
                     $offer_cap=$list['cap'];
                 }
                 
                $cat_res=mysqli_query($con,"select * from postback where user_id='$user_id' and offer_id='$offer_id'");
                $cat_arr=array();
                while($row=mysqli_fetch_assoc($cat_res)){
                  $cat_arr[]=$row;    
                }
                 foreach($cat_arr as $list){
                     $postback_ip=$list['ip'];
                     $postback_time=$list['timestamp'];
                    $user_click_id=$list['click_id'];
                 }
              //  select offers end
                 
                //  check the final value and insert data start code
                $sql="select * from final_report where offer_id='$offer_id' and user_click_ip='$user_click_ip'";
            	$res=mysqli_query($con,$sql);
            	$count=mysqli_num_rows($res);
            
            	if($count>0){
            	  mysqli_query($con,"insert into final_report(user_id,user_click_id,user_click_ip,user_name,user_email,user_phone_number,user_ip,user_device,user_location,user_proxy,user_click_time,postback_ip,postback_time,offer_id,offer_category,offer_name,offer_tracking_link,offer_device,offer_geo,offer_points,offer_cap,timestamp)values('$user_id','$user_click_id','$user_click_ip','$user_name','$user_email','$user_mobile_number','$user_ip','$user_device','$user_location','$status','$user_click_timing','$postback_ip','$postback_time','$offer_id','$offer_category','$offer_name','$offer_tracking_link','$offer_device','$offer_geo','$offer_points','$offer_cap','$date_time')"); 
            	  mysqli_query($con,"update postback set status='2' where user_id='$user_id'and offer_id='$offer_id' and click_id='$click_id'");
            	}else{
            	    if($user_proxy==true){
                        mysqli_query($con,"insert into final_report(user_id,user_click_id,user_click_ip,user_name,user_email,user_phone_number,user_ip,user_device,user_location,user_proxy,user_click_time,postback_ip,postback_time,offer_id,offer_category,offer_name,offer_tracking_link,offer_device,offer_geo,offer_points,offer_cap,timestamp)values('$user_id','$user_click_id','$user_click_ip','$user_name','$user_email','$user_mobile_number','$user_ip','$user_device','$user_location','$status','$user_click_timing','$postback_ip','$postback_time','$offer_id','$offer_category','$offer_name','$offer_tracking_link','$offer_device','$offer_geo','$offer_points','$offer_cap','$date_time')"); 
                      }else{
                          
                          if($point_status=='hold'){
                                 mysqli_query($con,"insert into my_earnings(user_id,my_offer_id,points,timestamp)values('$user_id','$offer_id','0','$date_time')");
                            }elseif($point_status=='proccessing'){
                                  mysqli_query($con,"insert into my_earnings(user_id,my_offer_id,points,timestamp)values('$user_id','$offer_id','$points','$date_time')");
                            }else{
                                 mysqli_query($con,"insert into my_earnings(user_id,my_offer_id,points,timestamp)values('$user_id','$offer_id','$points','$date_time')");
                            }
                          
                        mysqli_query($con,"insert into final_report(user_id,user_click_id,user_click_ip,user_name,user_email,user_phone_number,user_ip,user_device,user_location,user_proxy,user_click_time,postback_ip,postback_time,offer_id,offer_category,offer_name,offer_tracking_link,offer_device,offer_geo,offer_points,offer_cap,timestamp)values('$user_id','$user_click_id','$user_click_ip','$user_name','$user_email','$user_mobile_number','$user_ip','$user_device','$user_location','$status','$user_click_timing','$postback_ip','$postback_time','$offer_id','$offer_category','$offer_name','$offer_tracking_link','$offer_device','$offer_geo','$offer_points','$offer_cap','$date_time')"); 
                      }
            	}
            	//  check the final value and insert data end code
                error_log("Your process completed. Thank you!");
                exit;
        	}else{
                error_log("Your process Fraud Report");
                exit;
        	}
        	
        	}else{
                    mysqli_query($con,"update users set status='0' where id='$user_id'");
                    error_log("offer id click IP and Advertisers IP not match ! Please try again");
                    exit;
                }
        	}
        
        
        }else{
                error_log("Your process handing error please try again");
                exit;
        }

?>