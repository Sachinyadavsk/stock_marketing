<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php 
// Global message

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

// localmsg_user

if(isset($_POST['localmsg_user'])){
    $token_id = get_safe_value($con, $_POST['token_id']);
    $title = get_safe_value($con, $_POST['title']);
    $message_body = get_safe_value($con, $_POST['message_body']);
    $smsto = get_safe_value($con, $_POST['smsto']);
    $date = date("Y-m-d H:i:s");
    mysqli_query($con, "INSERT INTO local_sms (token_id, title, message_body, smsto, date) VALUES ('$token_id', '$title', '$message_body', '$smsto', '$date')");
    header("Location: localmsg.php");
    die();
}

// approved the sms
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	if($type=='status'){
	    $id=get_safe_value($con,$_GET['id']);
		$s=get_safe_value($con,$_GET['status']);
		$s_sql="update local_sms set status='$s' where id='$id'";
		mysqli_query($con,$s_sql);
	}
}


// delete
if (isset($_POST['send_local_del'])) {
    $id=get_safe_value($con,$_POST['id']);
	$delete_sql="delete from local_sms where id='$id'";
	mysqli_query($con,$delete_sql);
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
                    <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header h3">Send local message</div>
                            <div class="card-body row pt-3 pb-0">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Title:</label>
                                    <input type="text" class="form-control" name="title" value="" placeholder="Enter a message headline...">
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Send to <small>(Email or User ID)</small>:</label>
                                    <input type="text" class="form-control" name="smsto" value="" placeholder="someone@email.tld">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message body</label>
                                    <textarea class="form-control" name="message_body" rows="3" placeholder="Enter some message here..."></textarea>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">Pending messages</div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-6">ID</th>
                                                <th>User ID</th>
                                                <th>Message title</th>
                                                <th>Pending since</th>
                                                <th class="w-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $lsms = mysqli_query($con, "SELECT * FROM local_sms WHERE status='0' AND token_id = '" . $_SESSION['ADMIN_ID'] . "'");
                                            $l=1;
                                            while($rowlsms = mysqli_fetch_assoc($lsms)){ ?>
                                               <tr>
                                                   <td><?php echo $l++;?></td>
                                                   <td><?php echo $rowlsms['smsto'];?></td>
                                                   <td><?php echo $rowlsms['title'];?></td>
                                                   <td><?php echo timeAgo($rowlsms['timestamp']);;?></td>
                                                  <td>
                    								<?php
                    								    if($_SESSION['ROLE']=='admin' || $_SESSION['ROLE']=='superadmin'){
                								        if($rowlsms['status']=='0'){
                								             if (has_module_access_insert($con, 'send_local_message')):
                								             echo "<span class='btn btn-success'style='margin-right:5px;'><a style='color:#eee' href='?type=status&id=".$rowlsms['id']."&status=1'>Send</a></span>";
                								             endif;
                							             }
                    							           ?>
                    							            <?php if (has_module_access_delete($con, 'send_local_message')): ?>
                            							          <a href="#" class="open-send-local-del" data-id="<?php echo $rowlsms['id'];?>" data-toggle="modal"
                                                                        data-target="#cat-del" data-backdrop="static" data-keyboard="false">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" />
                                                                            <line x1="4" y1="7" x2="20" y2="7" />
                                                                            <line x1="10" y1="11" x2="10" y2="17" />
                                                                            <line x1="14" y1="11" x2="14" y2="17" />
                                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                        </svg>
                                                                    </a>
                                                            <?php endif; ?>
                    							           <?php
                    
                    							        }else{
                							        	if($rowlsms['status']=='0'){
                								           echo "<span class='btn btn-success'style='margin-right:5px;color:#eee'><a>Pending</a></span>";
                							            }
                							            }
                    								?>   
                    							   </td>
                                               </tr>
                                               <?php } ?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <!--dynmically gateway setup del start-->
                                        <form method="post" class="modal modal-blur fade" id="cat-del" tabindex="-1" role="dialog" aria-hidden="true">
                                              <input type="hidden" name="id" id="send-local-id">
                                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="modal-title">Are you sure?</div>
                                                        <div>You are about to remove this Send local message from your database.
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary mr-auto"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="send_local_del" class="btn btn-danger">Yes, delete it</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--dynmically gateway setup del end-->
                                </div>
                            </div>
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