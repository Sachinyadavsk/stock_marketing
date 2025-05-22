<!-- header top url start -->
<?php include("header_top.php");?>
<!-- header top url end -->
<?php 
session_start();
if(isset($_SESSION['ADMIN_LOGIN'])&&$_SESSION['ADMIN_LOGIN']=='yes'){
$admin_id=$_SESSION['ADMIN_ID'];
?>
<body class="g-sidenav-show  bg-gray-100 ">
    <!-- side nemu bar start -->
    <?php include("side_menu.php");?>
    <!-- side menu bar end -->

    <main class="main-content max-height-vh-100 h-100 position-relative border-radius-lg">
        <!-- Navbar -->
        <?php include("header.php");?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header pb-0">
                            <div class="d-lg-flex">
                                <div>
                                    <h5 class="mb-0">My Payments</h5>
                                </div>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">

                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table table-flush" id="data-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Points</th>
                                            <th>Payment Status</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $limit = 10;
                                            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
                                            $offset = ($page - 1) * $limit;
                        
                                            $total_res = mysqli_query($con, "SELECT COUNT(*) AS total FROM my_payments WHERE user_id='$admin_id'");
                                            $total_row = mysqli_fetch_assoc($total_res);
                                            $total_records = $total_row['total'];
                                            $total_pages = ceil($total_records / $limit);
                        
                                            $cat_re = mysqli_query($con, "SELECT * FROM my_payments WHERE user_id='$admin_id' LIMIT $limit OFFSET $offset");
                                            $cat_ar = array();
                                            while($ro = mysqli_fetch_assoc($cat_re)){
                                                $cat_ar[] = $ro;
                                            }
                                            mysqli_next_result($con);
                        
                                            foreach($cat_ar as $lis){
                                                $offer_id = $lis['offer_id'];
                        
                                                $cat_res = mysqli_query($con, "SELECT * FROM offers WHERE id='$offer_id'");
                                                $cat_arr = array();
                                                while($row = mysqli_fetch_assoc($cat_res)){
                                                    $cat_arr[] = $row;
                                                }
                                                foreach($cat_arr as $list){
                                        ?>
                                        <tr id="<?php echo $list['id'];?>">
                                            <td class="text-sm"><?php echo $list['id'];?></td>
                                            <td class="text-sm"><?php echo $list['category'];?></td>
                                            <td class="text-sm"><?php echo $list['name'];?></td>
                                            <td class="text-sm"><?php echo $list['points'];?></td>
                                            <td class="text-sm"><span class="badge bg-dark"><?php echo $lis['payment'];?></span></td>
                                            <td class="text-sm"><?php echo $list['timestamp'];?></td>
                                        </tr>
                                        <?php }
                                            mysqli_free_result($cat_res);
                                            }
                                            mysqli_free_result($cat_re);
                                        ?>
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-info justify-content-center">
                                        <?php if($page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                                            </li>
                                        <?php endif; ?>
                                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <?php if($page < $total_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
<?php
    if(isset($_POST['lead-delete'])){
        $ldid=mysqli_real_escape_string($con,$_POST['deleteid']);
        mysqli_query($con,"update leads set status='0' where id='$ldid'");?>
    <script>
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Lead Deleted Successfully',
          showConfirmButton: false,
          timer: 2500
        })
        setTimeout(() => {
          window.location.href="https://reapbucks.com/userpanel/leads";
        }, "2600")
    </script>
  <?php  }
?>
            <!-- footer start -->
            <?php include("footer.php");?>
            <!-- footer start -->

        </div>
    </main>
    <div>
    </div>

    <!-- footer url start -->
    <?php include("footer_url.php");?>
    <!-- footer url end -->
    <?php }else{
        header('location:https://reapbucks.com/userpanel/auth-login');
        }
        ?>