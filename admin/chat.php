<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<style>
.chat-message {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 8px 12px;
    background: #f9f9f9;
    max-width: 55%;
}
.text-right .chat-message { background: #d3f4ff; }
</style>
<!-- header url end -->

<?php
$msg='';
$color_class ='';

if (isset($_POST['chat_update'])) {
    $admin_id = $_POST['token_id'];
    $chat_disable = isset($_POST['chat_disable']) ? (int)$_POST['chat_disable'] : 0;
    $attachment_status = isset($_POST['attachment_status']) ? 1 : 0;
    $attachment_size = isset($_POST['attachment_size']) ? (int)$_POST['attachment_size'] : 0;
    $censored_words = isset($_POST['censored_words']) ? trim($_POST['censored_words']) : '';
    $warning_message = isset($_POST['warning_message']) ? trim($_POST['warning_message']) : '';


    $check = $con->query("SELECT id FROM chat_settings WHERE admin_id = $admin_id");
    if ($check->num_rows > 0) {
        // update
        $sql = "UPDATE chat_settings SET chat_disable = $chat_disable, attachment_status = $attachment_status, attachment_size = $attachment_size, 
        censored_words = '" . $con->real_escape_string($censored_words) . "',warning_message = '" . $con->real_escape_string($warning_message) . "'WHERE admin_id = $admin_id";
    } else {
        // insert
        $sql = "INSERT INTO chat_settings (admin_id, chat_disable, attachment_status, attachment_size, censored_words, warning_message)
                VALUES ($admin_id,$chat_disable,$attachment_status,$attachment_size,'" . $con->real_escape_string($censored_words) . "','" . $con->real_escape_string($warning_message) . "')";
    }

    if ($con->query($sql)) {
    	$msg="Chat settings updated successfully.";
		$color_class ='field_success';
    } else {
    	$msg="Error updating settings";
		$color_class ='field_error';
    }
}

// chat setting data get
$chatset = mysqli_query($con, "SELECT * FROM chat_settings WHERE admin_id = '" . $_SESSION['ADMIN_ID'] . "'");
$rowchatset = mysqli_fetch_assoc($chatset);
$chat_disable = $rowchatset['chat_disable'];
$attachment_status = $rowchatset['attachment_status'];
$attachment_size = $rowchatset['attachment_size'];
$censored_words = $rowchatset['censored_words'];
$warning_message = $rowchatset['warning_message'];


  ?>


<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->

        <div class="content">
            <div class="container-xl">
                <div class="row h-100">
                    <div class="col-lg-4 col-md-5 col-sm-12">
    
                        <form class="card" method="post">
                            <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                            <div class="card-header font-weight-bold">Chat settings:</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Want to disabe chat room?</label>
                                    <div class="form-selectgroup">
                                        
                                     <label class="form-selectgroup-item text-no-wrap">
                                        <input type="radio" name="chat_disable" value="<?php if($chat_disable=='0'){ echo $chat_disable;}else{ echo '0';}?>" class="form-selectgroup-input"  <?php if($chat_disable=='0'){ echo 'checked';}else{}?>>
                                        <span class="form-selectgroup-label">No</span>
                                    </label>
                                    
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="chat_disable" value="<?php if($chat_disable=='1'){ echo $chat_disable;}else{ echo '1';}?>" class="form-selectgroup-input"  <?php if($chat_disable=='1'){ echo 'checked';}else{}?>>
                                        <span class="form-selectgroup-label">Yes</span>
                                    </label>

                                        
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Media attachment:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <input class="form-check-input" value="<?php if(!empty($attachment_status)){ echo $attachment_status;}else{}?>" name="attachment_status" type="checkbox"  <?php if(!empty($attachment_status)){ echo 'checked';}else{}?>>
                                        </span>
                                        <input type="text" class="form-control" name="attachment_size" placeholder="1024" value="<?php if(!empty($attachment_size)){ echo $attachment_size;}else{};?>">
                                        <span class="input-group-text">kilobyte</span>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Censored words <small>(comma separated)</small>:</label>
                                    <input type="text" class="form-control" name="censored_words" value="<?php if(!empty($censored_words)){ echo $censored_words;}else{};?>">
                                </div>
                                <div>
                                    <label class="form-label text-yellow font-weight-bold">Chat warning message:</label>
                                    <textarea class="form-control" name="warning_message" data-toggle="autosize" style="height:150px;"> <?php if(!empty($warning_message)){ echo $warning_message;}else{};?></textarea>
                                </div>

                            </div>
                            <?php if (has_module_access_edit($con, 'chat_room')): ?>
                                <div class="card-footer">
                                    <button type="submit" name="chat_update" class="btn btn-dark">Change settings</button>
                                </div>
                            <?php endif; ?>
                        </form>
                        <div class="<?php echo $color_class ?>"><?php echo $msg?></div>
                    </div>


                        <!-- Chat Room UI -->
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <div class="card">
                                <div id="userinfo" class="card-header d-flex">
                                    Global Chat Room
                                    <div class="ml-auto">
                                        <a onclick="getMessage();" class="cursor-pointer text-blue">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -5v5h5"></path>
                                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 5v-5h-5"></path>
                                                </svg>
                                        </a>
                                        <?php if (has_module_access_delete($con, 'chat_room')): ?>
                                            <a onclick="deleteAll();" class="ml-3 cursor-pointer text-red">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                                    <line x1="4" y1="7" x2="20" y2="7"></line>
                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div id="msg-parent" class="card-body cb align-items-end" style="height: 300px; overflow-y: auto;">
                                    <div id='msg' class="w-100">
                                        <div class="cb-child d-flex align-items-center justify-content-center">
                                            Click on a conversation from left to see the messages here.
                                        </div>
                                    </div>
                                </div>
                                <?php if (has_module_access_insert($con, 'chat_room')): ?>
                                    <div class="card-footer d-flex">
                                        <input type="hidden" id="userid" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                                        <input id="msg-input" type="text" class="form-control mr-3" placeholder="Write here...">
                                        <a id='sbtn' class="ml-auto btn btn-dark cb-btn text-white" onclick="sendMessage();">Send</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <!-- Delete confirmation modal (optional, not used in deleteAll() below) -->
                    <form method="post" action="support/df" class="modal modal-blur fade" id="qs-del" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <input type="hidden" name="_token" value="your_token_here">
                        <input type="hidden" name="id" id="qs-id">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="modal-title">Are you sure?</div>
                                    <div>You are about to remove this whole conversation.</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Yes, delete it</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>

    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->