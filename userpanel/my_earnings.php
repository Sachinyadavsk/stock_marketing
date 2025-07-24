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
                                    <h5 class="mb-0">My Earnings</h5>
                                </div>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">

                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <?php
                                // Set pagination variables
                                $limit = 10; // number of records per page
                                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
                                $offset = ($page - 1) * $limit;
                                
                                // Get total number of rows
                                $total_res = mysqli_query($con, "SELECT COUNT(*) AS total FROM my_earnings WHERE user_id='$admin_id'");
                                $total_row = mysqli_fetch_assoc($total_res)['total'];
                                $total_pages = ceil($total_row / $limit);
                                
                                // Fetch paginated results
                                $cat_re = mysqli_query($con, "SELECT * FROM my_earnings WHERE user_id='$admin_id' ORDER BY id DESC LIMIT $offset, $limit");
                                $cat_ar = [];
                                while ($ro = mysqli_fetch_assoc($cat_re)) {
                                    $cat_ar[] = $ro;
                                }
                                mysqli_next_result($con);
                                ?>
                                
                                <div class="table-responsive">
                                    <table class="table table-flush" id="data-list">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Amount</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php foreach ($cat_ar as $list): ?>
                                        <tr id="<?php echo $list['id'];?>">
                                            <td class="text-sm"><?php echo $list['id'];?></td>
                                            <td class="text-sm"><span class="badge bg-dark">₹
                                               <?php
                                                if($list['points']=='0'){ ?>
                                                   <span style="color:white;font-weight:600px">Hold</span>
                                               <?php }else{ echo $list['points']; } ?>
                                            </span></td>
                                            <td class="text-sm">
                                                <?php 
                                                 $date_string = $list['timestamp'];
                                                 $date = DateTime::createFromFormat("d/m/Y H:i:s a", $date_string);
                                                 $formatted_date = $date->format("F d Y a h:i");
                                                 echo $formatted_date;
                                                 ?>
                                                </td>
                                        </tr>
                                         <?php endforeach; ?>
                                    </tbody>
                                </table>
                              
                                <!-- Pagination -->
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-info justify-content-center">
                                            <!-- Previous Page -->
                                            <?php if ($page > 1): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                                                </li>
                                            <?php endif; ?>
                                
                                            <!-- Page Numbers -->
                                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                
                                            <!-- Next Page -->
                                            <?php if ($page < $total_pages): ?>
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