<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->

        <div class="content">
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            // Get parameters
                            $limit = isset($_GET['e']) ? (int)$_GET['e'] : 10;
                            $search = isset($_GET['s']) ? trim($_GET['s']) : '';
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $start_from = ($page - 1) * $limit;
                            
                            // Search condition
                            $where = "";
                            if ($search !== '') {
                                $search_esc = mysqli_real_escape_string($con, $search);
                                $where = "WHERE users.id LIKE '%$search_esc%' 
                                          OR activity_history.method LIKE '%$search_esc%'
                                          OR activity_history.point_name LIKE '%$search_esc%'
                                          OR activity_history.ip_address LIKE '%$search_esc%'";
                            }
                            
                            // Main data query with JOIN
                           
                            
                            $sql = "
                                    SELECT activity_history.*, users.id AS external_user_id
                                    FROM activity_history
                                    JOIN users ON activity_history.user_id = users.id
                                     $where
                                                                ORDER BY activity_history.id DESC
                                                                LIMIT $start_from, $limit
                                ";

                            $result = mysqli_query($con, $sql);
                            
                            // Total records for pagination
                            $count_sql = "
                                SELECT COUNT(*) as total 
                                FROM activity_history
                                JOIN users ON users.id = activity_history.user_id
                                $where
                            ";
                            $count_result = mysqli_query($con, $count_sql);
                            $total_row = mysqli_fetch_assoc($count_result);
                            $total_records = $total_row['total'];
                            $total_pages = ceil($total_records / $limit);
                            $start_record = $total_records > 0 ? $start_from + 1 : 0;
                            $end_record = min($start_from + $limit, $total_records);
                            
                            // Preserve GET values in pagination
                            function buildQuery($overrides = []) {
                                $params = $_GET;
                                foreach ($overrides as $key => $value) {
                                    $params[$key] = $value;
                                }
                                return '?' . http_build_query($params);
                            }
                            
                            
                            ?>

                       
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Activities History</h3>
                            </div>
                        
                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-muted">
                                        Show
                                        <div class="mx-2 d-inline-block">
                                            <form method="get" action="">
                                                <?php if ($search !== ''): ?>
                                                    <input type="hidden" name="s" value="<?= htmlspecialchars($search) ?>">
                                                <?php endif; ?>
                                                <input name="e" type="text" class="form-control form-control-sm"
                                                    value="<?= $limit ?>" size="2" onchange="this.form.submit()">
                                            </form>
                                        </div>
                                        entries
                                    </div>
                                    <div class="ml-auto text-muted">
                                        Search:
                                        <div class="ml-2 d-inline-block">
                                            <form method="get" action="">
                                                <input type="hidden" name="e" value="<?= $limit ?>">
                                                <input name="s" type="text" class="form-control form-control-sm"
                                                    value="<?= htmlspecialchars($search) ?>" placeholder="Search..." onchange="this.form.submit()">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">#</th>
                                            <th>User ID</th>
                                            <th>Network</th>
                                             <th>Offer ID</th>
                                            <th>IP Address</th>
                                            <th>Coins</th>
                                            <th>Date</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($result) > 0): ?>
                                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td><span class="text-muted"><?= $row['id'] ?></span></td>
                                                    <td><?= htmlspecialchars($row['user_id']) ?></td>
                                                    
                                                    <td>
                                                        <?php 
                                                        $sql = "SELECT name FROM offers WHERE id='".$row['point_name']."'";
                                                        $results = mysqli_query($con, $sql);
                                                        if ($rows = mysqli_fetch_assoc($results)) {
                                                            echo $rows['name'];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($row['point_name']) ?></td>
                                                    <td><?= htmlspecialchars($row['ip_address']) ?></td>
                                                    <td><span class="text-green"><?= $row['price'] ?></span></td>
                                                    <td><?= $row['created_at'] ?></td>
                                                    <td class="text-right">
                                                        <span class="dropdown ml-1">
                                                            <button class="btn btn-white btn-sm dropdown-toggle align-text-top"
                                                                    data-boundary="viewport" data-toggle="dropdown">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="members-info.php?userid=<?= urlencode($row['user_id']) ?>">Find this user info</a>
                                                                <a class="dropdown-item text-blue" href="history/del?id=<?= $row['id'] ?>">Delete this history only</a>
                                                                <a class="dropdown-item text-red" href="history/del?id=<?= $row['id'] ?>&deduct=1">Delete and adjust balance</a>
                                                            </div>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr><td colspan="8" class="text-center text-muted">No records found.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        
                            <div class="card-footer d-flex align-items-center">
                                <p class="m-0 text-muted">
                                    Showing <span><?= $start_record ?></span> to <span><?= $end_record ?></span> of <span><?= $total_records ?></span> entries
                                </p>
                                <ul class="pagination m-0 ml-auto">
                                    <?php if ($page > 1): ?>
                                        <li class="page-item"><a class="page-link" href="<?= buildQuery(['page' => $page - 1]) ?>">&laquo; Prev</a></li>
                                    <?php endif; ?>
                        
                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="<?= buildQuery(['page' => $i]) ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                        
                                    <?php if ($page < $total_pages): ?>
                                        <li class="page-item"><a class="page-link" href="<?= buildQuery(['page' => $page + 1]) ?>">Next &raquo;</a></li>
                                    <?php endif; ?>
                                </ul>
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