<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->
 <?php
 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require 'vendor/autoload.php';
date_default_timezone_set("Asia/Calcutta");
$date_time=date('d/m/Y H:i:s a');
if(isset($_POST['addmember'])){	
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $phone=mysqli_real_escape_string($con,$_POST['phone']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $password_hash=password_hash($password, PASSWORD_DEFAULT);
    $check_user=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));
    if($check_user>0){
        echo "<script>
            alert('It looks like there's already an account registered with this email address');
            window.location.href = 'https://reapbucks.com/admin/members.php'; 
        </script>";
}else{
        $info = getUserInfo();
        // Get the user agent string
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            
            // Initialize variables
            $manufacturer = 'Unknown';
            $model = 'Unknown';
            $version = 'Unknown';
            
            // Check for common patterns in user agent to identify manufacturer, model, and version
            if (strpos($userAgent, 'Windows NT') !== false) {
                $manufacturer = 'Microsoft';
                $model = 'Windows';
            
                // Extract Windows version
                if (preg_match('/Windows NT (\d+\.\d+)/', $userAgent, $matches)) {
                    $version = $matches[1];
                }
            } elseif (strpos($userAgent, 'Android') !== false) {
                $manufacturer = 'Android';
            
                // Extract Android version and model
                if (preg_match('/Android (\d+\.\d+); ([^;]+)/', $userAgent, $matches)) {
                    $version = $matches[1];
                    $model = $matches[2];
                }
            } elseif (strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false) {
                $manufacturer = 'Apple';
                $model = 'iOS';
            
                // Extract iOS version
                if (preg_match('/OS (\d+_\d+)/', $userAgent, $matches)) {
                    $version = str_replace('_', '.', $matches[1]);
                }
            } elseif (strpos($userAgent, 'Macintosh') !== false) {
                $manufacturer = 'Apple';
                $model = 'Macintosh';
            
                // Extract macOS version
                if (preg_match('/Mac OS X (\d+_\d+)/', $userAgent, $matches)) {
                    $version = str_replace('_', '.', $matches[1]);
                }
            } elseif (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Mobi') !== false) {
                $manufacturer = 'Generic';
                $model = 'Mobile';
            
                // Extract generic mobile device information
                if (preg_match('/Mobile\/(\S+)/', $userAgent, $matches)) {
                    $version = $matches[1];
                }
            }
            
		mysqli_query($con,"insert into users(name,email,phone,password,password_plain,ip,location,device,timestamp,status) values 
		('$name','$email','$phone','$password_hash','$password','{$info['ip']}','{$info['country']} - {$info['region']} - {$info['city']}','{$info['device']} - $manufacturer - {$info['os']} - $version','$date_time','1')");
	   $last_id = mysqli_insert_id($con);
	   logActivity($con, $last_id, $role_type_is, $name, 'New member added successfully');
	   
	    $htmlTemplate = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; background-color: #f9f9f9; }
                .header { background-color: #007BFF; color: #fff; padding: 10px; text-align: center; }
                .content { padding: 20px; }
                .footer { font-size: 12px; color: #999; text-align: center; padding: 10px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Welcome to Reapbucks Offerwall</h2>
                </div>
                <div class='content'>
                    <p>Thank you for registering. Here are your login details:</p>
                    <p>Your login Email is : {$email}</p>
                    <p>Your login password is : {$password}</p>
                </div>
                <div class='footer'>
                    <p>This is an automated message from Reapbucks Offerwall. Please do not reply.</p>
                </div>
            </div>
        </body>
        </html>";
    
        //send mail
         include('smtp/PHPMailerAutoload.php');
        	$mail = new PHPMailer(); 
        	$mail->IsSMTP(); 
        	$mail->SMTPAuth = true; 
        	$mail->SMTPSecure = 'ssl'; 
        	$mail->Host = "smtp.titan.email";
        	$mail->Port = 465; 
        	$mail->IsHTML(true);
        	$mail->CharSet = 'UTF-8';
        	$mail->Username = "info@reapbucks.com";
        	$mail->Password = "Zettamobi@676";
        	$mail->SetFrom("info@reapbucks.com");
        	$mail->Subject = "Welcome to Reapbucks Offerwall - Member Account Created";
        	$mail->Body = $htmlTemplate;
        	$mail->AddAddress($email);
        	$mail->SMTPOptions=array('ssl'=>array(
        		'verify_peer'=>false,
        		'verify_peer_name'=>false,
        		'allow_self_signed'=>false
        	));
        	if(!$mail->Send()){
        		echo $mail->ErrorInfo;
        	}
	    
             echo "<script>
                alert('Member Account Created Succssfully!');
                window.location.href = 'https://reapbucks.com/admin/dashboard'; 
            </script>";
        } } ?>

<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->
        <div class="content">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header space-between">
                        <h3 class="card-title">Users Directory</h3>
                        <?php if (has_module_access_insert($con, 'users_directory')): ?>
                            <?php
                                $onlineStatus = $_GET['online'];
                                if($onlineStatus=='1'){?>
                                 <a href="members" class="btn btn-outline-primary small-btn">Active users first</a>
                                    <?php
                                }else{?>
                               <a href="members.php?online=1" class="btn btn-outline-primary small-btn">Active users first</a>
                             <?php  } ?>
                        <?php endif; ?>
                       
                    </div>
                    <div class="card-body">
                         <?php if (has_module_access_insert($con, 'users_directory')): ?>
                            <p><a href="members" class="btn btn-outline-primary small-btn" data-keyboard="false"
                            data-backdrop="static" data-toggle="modal" data-target="#member-add">Add Members</a></p>
                          <?php endif; ?>
                        <div class="row mb-n6">
                            <?php
                               $country_cc = isset($_GET['cc']) ? strtolower(trim($_GET['cc'])) : '';
                                $limit = 24;
                                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                $offset = ($page - 1) * $limit;
                                $sortByOnline = isset($_GET['online']) && $_GET['online'] == 1;

                                $query = "SELECT * FROM users";
                                if ($sortByOnline) {
                                    $query .= " WHERE is_online='1' ORDER BY id DESC";
                                } else {
                                    $query .= " ORDER BY id DESC";
                                }
                                $query .= " LIMIT $limit OFFSET $offset";

                                $cat_res = mysqli_query($con, $query);
                                $cat_arr = [];
                                while ($row = mysqli_fetch_assoc($cat_res)) {
                                   $location = $row['location']; // Example: "IN - Delhi - Delhi"
                                    $parts = explode(' - ', $location);
                                    $countryCode = isset($parts[0]) ? strtolower($parts[0]) : '';
                            
                                    if (empty($country_cc) || $country_cc === $countryCode) {
                                        $cat_arr[] = $row;
                                    }
                                    
                                }

                                $countQuery = "SELECT COUNT(*) as total FROM users";
                                $countResult = mysqli_query($con, $countQuery);
                                $totalRows = mysqli_fetch_assoc($countResult)['total'];
                                $totalPages = ceil($totalRows / $limit);

                                foreach ($cat_arr as $list) {
                                    $location = $list['location']; // Example: "IN - Delhi - Delhi"
                                    $parts = explode(' - ', $location);
                                    $countryCode = isset($parts[0]) ? strtolower($parts[0]) : '';
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <a class="card card-link" href="members-info.php?userid=<?php echo $list['id']; ?>">
                                    <div class="card-body align-items-center d-flex">
                                        <div class="float-left mr-3">
                                            <span class="avatar rounded avatar-md flag-country-<?php echo $countryCode; ?>">
                                                <?php if ($list['is_online']=='1'): ?>
                                                    <span class="badge bg-green"></span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"></span>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <div class="lh-sm">
                                            <div class="strong text-truncate"><?php echo $list['name']; ?></div>
                                            <div class="text-muted text-truncate">
                                                <h5 class="my-0 line-height-small"><?php echo $list['email']; ?></h5>
                                                <h5 class="my-0 line-height-small">
                                                    <?php echo $list['is_online']=='1' ? 'Online now' : 'Offline'; ?>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <ul class="pagination m-0 ml-auto">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                        <a class="page-link" href="<?php if ($page > 1) echo "?page=" . ($page - 1) . ($sortByOnline ? "&online=1" : ""); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="15 6 9 12 15 18"></polyline>
                                            </svg>
                                            prev
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?><?php echo $sortByOnline ? '&online=1' : ''; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                                        <a class="page-link" href="<?php if ($page < $totalPages) echo "?page=" . ($page + 1) . ($sortByOnline ? "&online=1" : ""); ?>">
                                            next
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="9 6 15 12 9 18"></polyline>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
                    <!--add model start -->
                       <form method="POST" class="modal modal-blur fade" id="member-add" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Member</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <line x1="18" y1="6" x2="6" y2="18" />
                                                <line x1="6" y1="6" x2="18" y2="18" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                           <label for="validationCustom01" class="form-label"> Name</label>
                                            <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Name" required>
                                            
                                           <label for="validationCustom01" class="form-label"> Email</label>
                                            <input type="email" class="form-control" id="validationCustom01" name="email" placeholder="Email" required>
                                            
                                            <label for="validationCustom01" class="form-label"> Mobile</label>
                                            <input type="number" class="form-control" id="validationCustom01" name="phone" placeholder="Enter phone number" required>
                                            
                                            <label class="form-label" for="validationCustom01">New Password</label>
                                            <div class="input-group">
                                              <input type="password" class="form-control" name="password" id="add-password" placeholder="New password">
                                              <div class="input-group-append">
                                                <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;height: 35px;">
                                                  <i class="fa fa-eye" id="toggle-icon"></i>
                                                </span>
                                              </div>
                                            </div>
                                            
                                           <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                            <label class="form-check-label" for="invalidCheck">
                                                Agree to terms and conditions
                                            </label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addmember" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <!--model end -->
                    
                    <script>
                        function togglePassword() {
                              const passwordField = document.getElementById('add-password');
                              const toggleIcon = document.getElementById('toggle-icon');
                              
                              if (passwordField.type === 'password') {
                                passwordField.type = 'text';
                                toggleIcon.classList.remove('fa-eye');
                                toggleIcon.classList.add('fa-eye-slash');
                              } else {
                                passwordField.type = 'password';
                                toggleIcon.classList.remove('fa-eye-slash');
                                toggleIcon.classList.add('fa-eye');
                              }
                            }
                    </script>
    <!-- footer Start -->
    <?php include('footer.php'); ?>
    <!-- footer end -->
</div>

    </div>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->