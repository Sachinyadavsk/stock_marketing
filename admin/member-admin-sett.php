<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php
// Fetch login from the database
    $id = $_SESSION['ADMIN_ID'];
    $sql = "SELECT * FROM admin WHERE id =' $id'";
    $result = $con->query($sql);
    $rows = $result->fetch_assoc();
    $msg='';
    $color_class ='';
    
    // update details
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $current_password = $_POST['password'];
        $new_password = $_POST['password_1'];
        $confirm_password = $_POST['password_2'];
    
        $sq_up = "SELECT password FROM admin WHERE id = '$id'";
        $result_up = mysqli_query($con, $sq_up);
        $row_up = mysqli_fetch_assoc($result_up);
    
        if (password_verify($current_password, $row_up['password'])) {
            if (!empty($new_password) && $new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            } else {
                $hashed_password = $row['password'];
            }
            $update_sql = "UPDATE admin SET name = '$name', email = '$email', password = '$hashed_password' WHERE id = '$id'";
            if (mysqli_query($con, $update_sql)) {
                $msg="Profile updated successfully!";
                $color_class ='field_success';
            } else {
                $msg="Update failed";
                $color_class ='field_error';
            }
        } else {
            $msg="Current password is incorrect";
            $color_class ='field_error';
        }
    }
?>

<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->
        <div class="content">
            <div class="container-xl">
                <div class="row justify-content-center mt-4">
                    <div class="col-md-10 row">
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-6">
                            <form method="post" class="card px-0 mb-4">
                                <div class="card-header bg-dark-lt text-dark">
                                    <span class="card-title">Admin Profile Settings</span>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Full name:</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $rows['name'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email address:</label>
                                        <input type="text" class="form-control" name="email" value="<?php echo $rows['email'];?>">
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label class="form-label">New password:</label>
                                            <input type="password" class="form-control" name="password_1" value="">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Confirm new password:</label>
                                            <input type="password" class="form-control" name="password_2" value="">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">Current password:</label>
                                        <input type="password" class="form-control" name="password" value="">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="update" class="btn btn-dark">Update Settings</button>
                                </div>
                            </form>
                            <div class="<?php echo $color_class?>"><?php echo $msg?></div>
                        </div>
                        <div class="col-md-6">
                            <form method="post" class="card px-0" action="member/admin/sett/change">
                                <input type="hidden" name="_token" value="tbn4TQH0Po3e01msassRtRG2JO35W4zEmJJU3Vtg">
                                <div class="card-header bg-secondary text-white">
                                    <span class="card-title">Transfer Admin rights:</span>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Email address of new Admin:</label>
                                        <input type="text" class="form-control" name="a_email" value="">
                                    </div>
                                    <div>
                                        <label class="form-label">Current password:</label>
                                        <input type="password" class="form-control" name="password" value="" >
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="change" class="btn btn-danger">Change Admin</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->