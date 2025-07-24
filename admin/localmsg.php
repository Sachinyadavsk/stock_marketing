<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php 
// Global message
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require 'vendor/autoload.php';

if (isset($_POST['localmsg_user'])) {

    $title = trim($_POST['title'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // Sanitize inputs (basic)
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $message = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
    
    logActivity($con, '1', $role_type_is, $email, 'Global Message Reapbucks');

    // Email HTML Template
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
                <h2>{$title}</h2>
            </div>
            <div class='content'>
                <p>{$message}</p>
            </div>
            <div class='footer'>
                <p>This is an automated message from YourDomain. Please do not reply.</p>
            </div>
        </div>
    </body>
    </html>";

           $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.titan.email';
                $mail->Port = 465;
                $mail->Username = 'info@reapbucks.com';
                $mail->Password = 'Zettamobi@676';
        
                $mail->setFrom('info@reapbucks.com', 'Global Message Reapbucks');
                $mail->addAddress($email);
                $mail->SMTPOptions=array('ssl'=>array(
        		'verify_peer'=>false,
        		'verify_peer_name'=>false,
        		'allow_self_signed'=>false
             	));
        
                $mail->isHTML(true);
                $mail->Subject = $title;
                $mail->Body = $htmlTemplate;
                $mail->send();
                // echo "OTP sent successfully to your email.";
            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
}


if(isset($_POST['localmsg_global'])){
    $token_id = get_safe_value($con, $_POST['token_id']);
    $title = get_safe_value($con, $_POST['title']);
    $description = get_safe_value($con, $_POST['description']);
    $date = date("Y-m-d H:i:s");
    
    $check = mysqli_query($con, "SELECT * FROM global_sms WHERE token_id='$token_id'");
    if(mysqli_num_rows($check) > 0){
        
        mysqli_query($con, "UPDATE global_sms SET title='$title', description='$description', date='$date' WHERE token_id='$token_id'");
    } else {
        // First time: insert new record
        mysqli_query($con, "INSERT INTO global_sms (token_id, title, description, date) VALUES ('$token_id', '$title', '$description', '$date')");
    }
    header("Location: localmsg.php");
    die();
}

$gsms = mysqli_query($con, "SELECT * FROM global_sms WHERE token_id = '" . $_SESSION['ADMIN_ID'] . "'");
$rowgsms = mysqli_fetch_assoc($gsms);
$gsmstitle =  $rowgsms['title'];
$gsmsdesc =  $rowgsms['description'];
?>

<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->

        <div class="content">
            <div class="container-xl">
                <h3 style="color:red;font-weight:600px"> No Copy Right Content Only Writting </h3>
                <!--Global message start-->
                <form method="post" class="row">
                   <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">Global message</div>
                            <div class="card-body row pt-3 pb-0">
                                <div class="col-md-4 col-12 mb-3">
                                    <input type="text" class="form-control" name="title" value="<?php if(!empty($gsmstitle)){ echo $gsmstitle; }else{ };?>" placeholder="Enter a title...">
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <input type="text" class="form-control" name="description" value="<?php if(!empty($gsmsdesc)){ echo $gsmsdesc; }else{ };?>" placeholder="Enter yout message...">
                                </div>
                                <?php if (has_module_access_edit($con, 'send_local_message')): ?>
                                    <div class="col-md-2 col-12 mb-3">
                                        <button type="submit" name="localmsg_global" class="btn btn-block btn-primary">Update</button>
                                    </div>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                </form>
                  <!--Global message end-->
                  
                   <!--Send local message start-->
                <form method="post" class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header h3">Send local message</div>
                            <div class="card-body row pt-3 pb-0">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Title:</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter a message headline..." required>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Send to <small>(Email or User ID)</small>:</label>
                                    <input type="email" class="form-control" name="email" placeholder="someone@email.tld" required>
                                </div>
                               
                                <div class="mb-3">
                                    <label class="form-label">Message body</label>
                                    <textarea class="form-control" name="message" rows="3" placeholder="Enter some message here..." required></textarea>
                                </div>
                                 <?php if (has_module_access_insert($con, 'send_local_message')): ?>
                                    <div class="col-md-2 col-12 mb-3">
                                        <button type="submit" name="localmsg_user" class="btn btn-block btn-primary">Send local message</button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </form>
                 <!--Send local message End-->
            </div>
           
        
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>

    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->