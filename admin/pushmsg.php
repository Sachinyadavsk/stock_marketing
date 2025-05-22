<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php
$msg = '';
$color_class = '';

$userid = $_POST['uid'];
if(!empty($userid)){
    
}else{
    if (isset($_POST['submit'])) {
    $token_id = $_POST['token_id'];
    $sendtype = $_POST['sendtype'];
    $title = get_safe_value($con, $_POST['title']);
    $message = get_safe_value($con, $_POST['message']);
    $text_or_multi = $_POST['text_or_multi'];
    $created_at = date('Y-m-d H:i:s');

    // File upload
    $media_file_name = '';
    if (!empty($_FILES['multimedia_image']['name'])) {
        $target_dir = "images/pushsms/";
        $media_file_name = time() . '_' . basename($_FILES["multimedia_image"]["name"]);
        $target_file = $target_dir . $media_file_name;
        move_uploaded_file($_FILES["multimedia_image"]["tmp_name"], $target_file);
    }

    $email_or_userid = isset($_POST['email_or_userid']) ? $_POST['email_or_userid'] : '';
    $email_or_userid_type = isset($_POST['email_or_userid_type']) ? $_POST['email_or_userid_type'] : '';
    $range_from = isset($_POST['sendtype-2-input-from']) ? $_POST['sendtype-2-input-from'] : '';
    $range_to = isset($_POST['sendtype-2-input-to']) ? $_POST['sendtype-2-input-to'] : '';

    $insert = mysqli_query($con, "INSERT INTO sendpush (token_id, sendtype, email_or_userid, email_or_userid_type, range_from, range_to, title, message, text_or_multi, image_file, created_at)
        VALUES ('$token_id', '$sendtype', '$email_or_userid', '$email_or_userid_type', '$range_from', '$range_to', '$title', '$message', '$text_or_multi', '$media_file_name', '$created_at')");

    if ($insert) {
        header('location:index.php');
        die();
    } else {
        $msg = "Error occurred while submitting the form.";
        $color_class = "alert-danger";
    }
} else {
    $msg = "Please submit the form properly.";
    $color_class = "alert-warning";
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
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h2 class="page-title">Send Push Message</h2>
                        </div>
                    </div>
                </div>
                <form method="post" class="row" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                    <div class="col-md-6 col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Who you want to send?</label>
                            <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="radio" id="sendtype-1-radio" name="sendtype" value="1" class="form-selectgroup-input" checked>
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="lh-sm">
                                            <div class="strong mb-2">Send to single user:</div>
                                            <div class="form-check-description">
                                                <div class="input-group">
                                                    <input id="sendtype-1-input" type="text" name="email_or_userid" class="form-control" value="<?php if(!empty($userid)){ echo $userid;}else{ }?>" aria-label="Enter Email or User ID">
                                                    <input class="form-control" id="sendtype-1-val" type="hidden" name="email_or_userid_type" value="1">
                                                    <button type="button" id="sendtype-1-text" class="btn btn-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User ID</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" id="sendtype-1-opt" data-id="1">By User ID</a>
                                                        <a class="dropdown-item" id="sendtype-1-opt" data-id="2">By Email</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label class="form-selectgroup-item flex-fill">
                                    <input id="sendtype-2-radio" type="radio" name="sendtype" value="2" class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="lh-sm">
                                            <div class="strong mb-2">To multiple users:</div>
                                            <div class="form-check-description">
                                                <div class="input-group">
                                                    <span class="input-group-text">From</span>
                                                    <input type="text" id="sendtype-2-input" name="sendtype-2-input-from" class="form-control text-center" value="1">
                                                    <span class="input-group-text">to</span>
                                                    <input type="text" id="sendtype-2-input" name="sendtype-2-input-to" class="form-control text-center" value="50">
                                                    <span class="input-group-text">users</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="radio" name="sendtype" value="3" class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="lh-sm">
                                            <div class="strong">Banned users</div>
                                            <div class="form-check-description">Last 50 banned users who did not delete the app yet.</div>
                                        </div>
                                    </div>
                                </label>
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="radio" name="sendtype" value="4" class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="lh-sm">
                                            <div class="strong">Leaderboard winners</div>
                                            <div class="form-check-description">Send message to the current leaderboard ranked users.</div>
                                        </div>
                                    </div>
                                </label>
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="radio" name="sendtype" value="5" class="form-selectgroup-input">
                                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                                        <div class="mr-3">
                                            <span class="form-selectgroup-check"></span>
                                        </div>
                                        <div class="lh-sm">
                                            <div class="strong">To all users</div>
                                            <div class="form-check-description">Send message to all the subscribed users.</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-8">
                        <label class="form-label">Message title:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                                    <line x1="8" y1="9" x2="16" y2="9"></line>
                                    <line x1="8" y1="13" x2="14" y2="13"></line>
                                </svg>
                            </span>
                            <input type="text" class="form-control" name="title" placeholder="Enter a title...">
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="col-6">
                                <div class="form-label">Message type</div>
                                <div class="form-selectgroup mr-3">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="text_or_multi" value="1" class="form-selectgroup-input" checked>
                                        <span class="form-selectgroup-label">Text</span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="text_or_multi" value="2" class="form-selectgroup-input">
                                        <span class="form-selectgroup-label">Large Image</span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="text_or_multi" value="3" class="form-selectgroup-input">
                                        <span class="form-selectgroup-label">Small Image</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-label">For multimedia message</div>
                                <div class="form-file">
                                    <input type="file" name="multimedia_image" class="form-file-input img-input" id="imagefile">
                                    <label class="form-file-label" for="customFile">
                                        <span class="form-file-text img-choose">Choose image...</span>
                                        <span class="form-file-button">Browse</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-label">Message body</div>
                            <textarea class="form-control" name="message" data-toggle="autosize" placeholder="Typing something…" style="height:150px;"></textarea>
                            <?php if (has_module_access_insert($con, 'send_push_message')): ?>
                                <button id="form-submit" type="submit" name="submit" class="btn btn-dark mt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M21 3L14.5 21a.55 .55 0 0 1 -1 0L10 14L3 10.5a.55 .55 0 0 1 0 -1L21 3">
                                        </path>
                                    </svg>
                                    Send message
                                </button>
                            <?php endif; ?>
                            
                        </div>
                        <div class="pt-3">
                            <ul>
                                <li>You can input a URL in the message body to redirect user to any website.</li>
                                <div class="mb-3">Such as https://reapbucks.com</div>
                                <li>For Geo targeting, append <span class="text-red">cc</span> parameter in your URL.
                                </li>
                                <div class="mb-3">Such as ?cc=de</div>
                                <li>You can also use these macros in the URL:</li>
                                <div>
                                    <span class="text-nowrap mr-2"><span class="text-red">[app_uid]</span> = for User
                                        ID</span>
                                    <span class="text-nowrap mr-2"><span class="text-red">[app_country]</span> = for
                                        country ISO</span>
                                    <span class="text-nowrap mr-2"><span class="text-red">[app_gaid]</span> = for
                                        GAID</span>
                                </div>
                            </ul>
                        </div>
                    </div>
                </form>
                <?php if (!empty($msg)): ?>
                    <div class="alert <?php echo $color_class; ?>">
                        <?php echo $msg; ?>
                    </div>
                <?php endif; ?>

            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->