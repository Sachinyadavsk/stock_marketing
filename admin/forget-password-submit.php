<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require 'vendor/autoload.php';

include('confige.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM admin WHERE email = '$email'";
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set("Asia/Kolkata");
            $created_at = date("Y-m-d H:i:s");
            $update_query = "UPDATE admin SET reset_token = '$reset_token', reset_token_created_at = '$created_at' WHERE email = '$email'";

            if ($con->query($update_query)) {
                $reset_link = "https://reapbucks.com/admin/reset-password/" . urlencode($reset_token);
                $subject = "Password Reset Request";
                $message = "To reset your password, click the following link:\n\n$reset_link";

                // Send email using PHPMailer
                $mail = new PHPMailer(true);
                
                try {
                    $mail->isSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = 'smtp.titan.email';
                    $mail->Port = 465;
                    $mail->Username = 'info@reapbucks.com';
                    $mail->Password = 'Zettamobi@676';
            
                    $mail->setFrom('info@reapbucks.com', 'Reset Password');
                    $mail->addAddress($email);
                    $mail->SMTPOptions=array('ssl'=>array(
            		'verify_peer'=>false,
            		'verify_peer_name'=>false,
            		'allow_self_signed'=>false
                 	));
            
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body = $message;
            
                    $mail->send();
                    echo "<script>
                            alert('A password reset link has been sent to your email');
                            window.location.href = 'https://reapbucks.com/admin/forget-password';
                          </script>";
                } catch (Exception $e) {
                    echo "<script>
                            alert('Mailer Error: {$mail->ErrorInfo}');
                            window.location.href = 'https://reapbucks.com/admin/forget-password';
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Failed to update reset token. Please try again');
                        window.location.href = 'https://reapbucks.com/admin/forget-password';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Email address not found');
                    window.location.href = 'https://reapbucks.com/admin/forget-password';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Invalid email address');
                window.location.href = 'https://reapbucks.com/admin/forget-password';
              </script>";
    }
} else {
    echo "<script>
            alert('Email is required');
            window.location.href = 'https://reapbucks.com/admin/forget-password';
          </script>";
}
?>

