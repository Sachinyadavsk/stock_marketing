<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->


<?php 

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from blogs where id='$id'";
		mysqli_query($con,$delete_sql);
		?>
    <script>
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'IP Deleted',
          showConfirmButton: false,
          timer: 2500
        })
        setTimeout(() => {
          window.location.href="";
        }, "2600")
    </script>
    <?php
	}
	
	if($type=='active'){
	$id=get_safe_value($con,$_GET['id']);
	 mysqli_query($con,"update blogs set status='0' where id='$id'");
	}
	
	if($type=='deactive'){
	$id=get_safe_value($con,$_GET['id']);
	 mysqli_query($con,"update blogs set status='1' where id='$id'");
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
                            <h2 class="page-title">Blogs</h2>
                        </div>
                    </div>
                    
                     <?php if (has_module_access_insert($con, 'blogs')): ?>
                        <div class="add_button">
                            <a style="float:right;color:white" class="btn btn-primary" href="https://reapbucks.com/admin/manage_blog.php">Add Blog</a>
                        </div>
                    <?php endif; ?>
                    
                </div>

                <div class="row">
                    <div class="box">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-mobile-sm card-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Headline</th>
                                            <th>Image</th>
                                            <th>Added On</th>
                                            <th>Status</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                                $cat_res=mysqli_query($con,"select * from blogs order by id desc");
                                                $cat_arr=array();
                                                $i =1;
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
                                                ?>
                                        <tr>
                                            <td class="text-muted text-nowrap" data-label="ID">
                                                <?php echo $i++;?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Title">
                                                <?php echo $list['title']?>
                                            </td>
                                            <td data-label="Image">
                                                <div class="text-muted text-h5"><img src="<?php echo 'https://reapbucks.com/admin/images/blogs/'.$list['image1'];?>" alt="" width="20%"></div>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Date / Time">
                                               <?php echo $list['datee']?>
                                            </td>
                                            <td>
                                                <?php if (has_module_access_edit($con, 'blogs')): ?>
                                                    <div class="btn-list flex-nowrap">
                                                         <?php if($list['status']=='1'){?>
                                                         <a class="btn btn-success" href="?type=active&id=<?php echo $list['id'];?>">Active</a>
                                                         <?php }else{?>
                                                         <a class="btn btn-danger" href="?type=deactive&id=<?php echo $list['id'];?>">Deactive</a>
                                                          <?php }?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <?php if (has_module_access_edit($con, 'blogs')): ?>
                                                    <a class="btn btn-white" href="https://reapbucks.com/admin/manage_blog.php?id=<?php echo $list['id'];?>">Edit</a>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (has_module_access_delete($con, 'blogs')): ?>
                                                    <a class="btn btn-dark" href="?type=delete&id=<?php echo $list['id'];?>">Delete</a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="float-right text-nowrap flex-nowrap">
                        </div>
                    </div>
                    
                    <!--model-->
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