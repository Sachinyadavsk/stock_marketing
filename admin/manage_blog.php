<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php

$datee ='';
$title ='';
$image1 ='';
$description ='';
$keywords ='';
$descriptions ='';
$url ='';
$added_by ='';
$headline ='';
$msg ='';
$color_class ='';

if (isset($_GET['id']) && $_GET['id'] != '') {
    
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM blogs WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $datee  = $row['datee'];
        $title  = $row['title'];
        $image1  = $row['image1'];
        $description = $row['description'];
        $keywords = $row['keywords'];
        $descriptions = $row['descriptions'];
        $url  = $row['url'];
        $added_by = $row['added_by'];
        $headline = $row['headline'];
    } else {
        header('location:create_thema_layout.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $token_id = $_POST['token_id'];
   
    // File upload
    $media_file_name = '';
    if (!empty($_FILES['image1']['name'])) {
        $target_dir = "images/blogs/";
        $media_file_name = time() . '_' . basename($_FILES["image1"]["name"]);
        $target_file = $target_dir . $media_file_name;
        move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file);
    }

        $datee = isset($_POST['datee']) ? $_POST['datee'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';
        $descriptions = isset($_POST['descriptions']) ? $_POST['descriptions'] : '';
        $url = isset($_POST['url']) ? $_POST['url'] : '';
        $added_by = isset($_POST['added_by']) ? $_POST['added_by'] : '';
        $headline = isset($_POST['headline']) ? $_POST['headline'] : '';
    
    $res = mysqli_query($con, "SELECT * FROM blogs WHERE title='$title'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
                // Allowed to proceed for update
            } else {
                $msg = "Blogs already exists";
                $color_class = "alert-danger";
            }
        } else {
            $msg = "Blogs already exists";
            $color_class = "alert-danger";
        }
    }

      if ($msg == '') {
          
          if (isset($_FILES['image1']['name']) && $_FILES['image1']['name'] != '') {
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                $file_name = $_FILES['image1']['name'];
                $file_tmp = $_FILES['image1']['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
                if (in_array($file_ext, $allowed_types)) {
                    $new_file_name = time() . '_' . $file_name;
                    $file_path = 'images/blogs/' . $new_file_name;
                    move_uploaded_file($file_tmp, $file_path);
                    $image = $new_file_name;
                } else {
                    $msg = "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
                }
            }
            
            
          if (isset($_GET['id']) && $_GET['id'] != '') {
                if ($image != '') {
                    $update_sql = "UPDATE blogs SET datee ='$datee', title ='$title', description ='$description', keywords ='$keywords', descriptions ='$descriptions', url ='$url';
                     added_by ='$added_by', headline ='$headline', image1='$image' WHERE id='$id'";
                } else {
                     $update_sql = "UPDATE blogs SET datee ='$datee', title ='$title', description ='$description', keywords ='$keywords', descriptions ='$descriptions', url ='$url';
                     added_by ='$added_by', headline ='$headline' WHERE id='$id'";
                }
                mysqli_query($con, $update_sql);
            } else {
                 mysqli_query($con, "INSERT INTO blogs (datee, title, description, keywords, descriptions, url, added_by, headline, image1)
                        VALUES ('$datee', '$title', '$description', '$keywords', '$descriptions', '$url', '$added_by', '$headline', '$media_file_name')");
                  header('location:blogs.php');
                  die();
            }
      }
}

// delete cps

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from blogs where id='$id'";
		mysqli_query($con,$delete_sql);
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
                <div class="row card">
                    
                    <form class="p-0" method="post" enctype="multipart/form-data">
                       <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
                       
                          <?php if (!empty($image1)) { ?>
                             <div class="card-header bg-dark-lt h3 text-dark bold pt-2 pb-2">
                                <img src="images/blogs/<?php echo $image1;?>" class="rounded text-truncate img-thumbnail text-small avatar-md mr-2" alt="<?php echo $title;?>">
                               <?php echo $title;?>
                            </div>
                          <?php }else{ ?>
                          <div class="card-header bg-dark-lt h3 text-dark bold">Add a Blog</div>
                          <?php } ?>
                        
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <span class="bold mr-2">add the multiple blog </span>
                                
                            </div>
                            
                            <!--form field-->
                            
                            <div class="row">
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label class="form-label">Headline</label>
                                    <input type="text" class="form-control" name="headline" placeholder="Blog Headline" value="<?php echo $headline;?>">
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <div class="form-label">Image</div>
                                    <div class="form-file">
                                        <input type="file" name="image1" class="form-file-input img-input" id="imagefile">
                                        <label class="form-file-label" for="customFile">
                                            <span class="form-file-text img-choose">Choose image...</span>
                                            <span class="form-file-button">Browse</span>
                                        </label>
                                         <?php if (!empty($image1)) { ?>
                                            <a href="images/blogs/<?php echo $image1; ?>" target="_blank">View Image</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                    <label class="form-label">Content</label>
                                   <textarea name="description" id="descx" rows="3" placeholder="Blog Content" class="form-control des" value="<?php echo $description;?>" ></textarea>
                                </div>
                                
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label class="form-label">Keywords</label>
                                    <textarea name="keywords" rows="3" placeholder="Keywords" required class="form-control"> <?php echo $keywords;?> </textarea>
                                </div>
                                
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="descriptions" rows="3"required  placeholder="Description" class="form-control"><?php echo $descriptions;?></textarea>
                                </div>
                                
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="title" value="<?php echo $title;?>">
                                </div>
                                
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label class="form-label">Url</label>
                                       <input type="text" name="url" placeholder="URL" required value="<?php echo $url;?>" class="form-control">
                                </div>
                                
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Added By</label>
                                    <input type="text" name="added_by" required class="form-control" value="<?php echo $added_by;?>" placeholder="Added By">
                                </div>
                            
                            
                                <div class="col col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    <label class="form-label">Date</label>
                                      <input type="date" name="datee" required class="form-control" value="<?php echo $datee;?>">
                                </div>
                                
                            </div>
                            
                            <?php if (!empty($title)) { ?>
                                <div class="d-flex flex-row-reverse mt-4">
                                    <input type="submit" name="submit" class="btn btn-dark" value="Update Ad Blog">
                                    <a href="manage_blog.php?id=<?php echo $id;?>" class="btn btn-white mr-4">Cancel</a>
                                    <a href="?type=delete&id=<?php echo $id;?>" class="btn btn-outline-danger mr-4">Delete Blog</a>
                                </div>
                                
                            <?php }else{ ?>
                                 <div class="d-flex flex-row-reverse mt-4">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Create Ad Blog" />
                                    <a href="manage_blog.php" class="btn btn-white mr-4">Cancel</a>
                                </div>
                             <?php } ?>
                           
                        </div>
                        
                        
                    </form>
                    <!--    </?php if (!empty($msg)): ?>-->
                    <!--    <div class="alert </?php echo $color_class; ?>">-->
                    <!--        </?php echo $msg; ?>-->
                    <!--    </div>-->
                    <!--</?php endif; ?>-->
                </div>
            </div>
            <script src="https://cdn.ckeditor.com/4.17.0/standard/ckeditor.js"></script>
             <script>
                CKEDITOR.replace('descx', {
                    // Custom configuration options
                    toolbar: 'Basic'
                });
           </script>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
            
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->