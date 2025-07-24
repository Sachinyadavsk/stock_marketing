<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php 
$msg ='';
$color_class ='';

if (isset($_POST['submit'])) {
    $token_id = $_POST['token_id'];
    $faq_question = isset($_POST['faq_question']) ? $_POST['faq_question'] : '';
    $faq_answer = isset($_POST['faq_answer']) ? $_POST['faq_answer'] : '';
    
        mysqli_query($con, "INSERT INTO faqs (token_id, faq_question, faq_answer) VALUES ('$token_id', '$faq_question', '$faq_answer')");
        $last_id = mysqli_insert_id($con);
        logActivity($con, $last_id, $role_type_is, $faq_question, 'Add New Faqs');
        header('location:faq-view.php');
        die();
       
    $res = mysqli_query($con, "SELECT * FROM faqs WHERE faq_question='$faq_question'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
                // Allowed to proceed for update
            } else {
                $msg = "Faqs already exists";
                $color_class = "alert-danger";
            }
        } else {
            $msg = "Faqs already exists";
            $color_class = "alert-danger";
        }
    }

      if ($msg == '') {
          
        mysqli_query($con, "INSERT INTO faqs (token_id, faq_question, faq_answer) VALUES ('$token_id', '$faq_question', '$faq_answer')");
        $last_id = mysqli_insert_id($con);
        logActivity($con, $last_id, $role_type_is, $faq_question, 'Add New Faqs');
        header('location:faq-view.php');
        die();
            
      }
}


// delete cps

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from faqs where id='$id'";
		mysqli_query($con,$delete_sql);
		logActivity($con, $id, $role_type_is, $type, 'Delete Faqs');
	}
}

// edit

if (isset($_POST['faq_update'])) {
     $id=get_safe_value($con,$_POST['id']);
     $faq_question = isset($_POST['faq_question']) ? $_POST['faq_question'] : '';
     $faq_answer = isset($_POST['faq_answer']) ? $_POST['faq_answer'] : '';
     
       $update_sql = "UPDATE faqs SET faq_question='$faq_question', faq_answer='$faq_answer' WHERE id='$id'";
        mysqli_query($con, $update_sql);
        logActivity($con, $id, $role_type_is, $faq_question, 'Update Faqs');
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
                <div class="row">
                    <div class="card">
                        <div class="card-header">FAQ Management</div>
                        <div class="card-body">
                            <form class="p-0 m-0" method="post">
                                <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                                <div class="mb-2">
                                    <input type="text" class="form-control" name="faq_question" placeholder="Enter a question" required>
                                </div>
                                
                                 <?php if (has_module_access_insert($con, 'faq_management')): ?>
                                    <div class="mb-3 d-flex">
                                        <input type="text" class="form-control mr-2" name="faq_answer" placeholder="Write an answer of above question" required>
                                        <button type="submit" name="submit" class="btn ml-auto btn-primary text-nowrap">Add FAQ</button>
                                    </div>
                                <?php endif; ?>
                                
                            </form>
                            
                               <?php
                                    $limit = 5;
                                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                    $offset = ($page - 1) * $limit;
                                    
                                
                                    // Get total records
                                    $total_query = "SELECT COUNT(*) as total FROM faqs";
                                    $total_result = mysqli_query($con, $total_query);
                                    $total_row = mysqli_fetch_assoc($total_result);
                                    $total_records = $total_row['total'];
                                    $total_pages = ceil($total_records / $limit);
                                    
                                    // Fetch current page FAQs
                                    $query = "SELECT * FROM faqs ORDER BY id ASC LIMIT $limit OFFSET $offset";
                                    $cat_res = mysqli_query($con, $query);
                                    $cat_arr = [];
                                    while ($row = mysqli_fetch_assoc($cat_res)) {
                                        $cat_arr[] = $row;
                                    }
                                    ?>
                                    
                                <?php if (empty($cat_arr)) { ?>
                                    <div class="alert alert-warning text-center">No FAQs found.</div>
                                <?php } ?>
                        
                                <?php foreach ($cat_arr as $list) { ?>
                                
                                    <div class="bg-gray-lt d-flex rounded p-2 mt-4 text-dark">
                                        <div><?php echo $list['faq_question'];?></div>
                                        <?php if (has_module_access_delete($con, 'faq_management')): ?>
                                            <a class="ml-auto" href="?type=delete&id=<?php echo $list['id'];?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <line x1="4" y1="7" x2="20" y2="7" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a>
                                            
                                         <?php endif; ?>
                                          <?php if (has_module_access_edit($con, 'faq_management')): ?>
                                            <a href="#" class="btn-edit text-blue" data-id="<?php echo $list['id'];?>" data-name="<?php echo $list['faq_question'];?>"
                                                data-desc="<?php echo $list['faq_answer'];?>" data-toggle="modal" data-target="#faq-edit"
                                                data-backdrop="static" data-keyboard="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                    <line x1="16" y1="5" x2="19" y2="8" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                     <div class="p-2"><?php echo $list['faq_answer'];?></div>
                                    
                                <?php } ?>
                        
                                <!-- Pagination -->
                                <?php if ($total_pages > 1) { ?>
                                     <div class="col-lg-12 d-flex justify-content-center mt-3">
                                        <ul class="pagination">
                                            <?php if ($page > 1) { ?>
                                                <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Prev</a></li>
                                            <?php } ?>
                                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($page < $total_pages) { ?>
                                                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                            
                        </div>
                    </div>
                </div>
                 <!--dynmically faq edit start-->
                <form method="post" enctype="multipart/form-data" class="modal modal-blur fade" id="faq-edit" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Enter a Question</label>
                                    <input type="text" class="form-control" name="faq_question" id="edit-name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Write as answer of above qustion</label>
                                    <textarea type="text" class="form-control" name="faq_answer" id="edit-desc"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" name="faq_update" class="btn btn-primary">Update Faq</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--dynmically gateway setup edit end-->
            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->