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
                <div class="card">
                    <div class="card-header space-between">
                        <h3 class="card-title">Users Directory</h3>
                        <?php if (has_module_access_insert($con, 'users_directory')): ?>
                            <?php
                                $onlineStatus = $_GET['online'];
                                if($onlineStatus=='1'){?>
                                 <a href="members" class="btn btn-outline-primary small-btn">Active users first</a>
                                    <?php
                                }else{?>
                               <a href="members.php?online=1" class="btn btn-outline-primary small-btn">Active users first</a>
                             <?php  } ?>
                        <?php endif; ?>
                       
                    </div>
                    <div class="card-body">
                            <div class="row mb-n6">
                                <?php
                                $limit = 24;
                                $page = isset($_GET['page']) ? max(intval($_GET['page']), 1) : 1;
                                $offset = ($page - 1) * $limit;
                                $search = isset($_POST['search']) ? trim($_POST['search']) : '';
                                $sortByOnline = isset($_GET['online']) && $_GET['online'] == 1;
                        
                                $query = "SELECT * FROM users WHERE 1";
                                if (!empty($search)) {
                                    $query .= " AND name LIKE '%" . mysqli_real_escape_string($con, $search) . "%'";
                                }
                                if ($sortByOnline) {
                                    $query .= " AND is_online = '1'";
                                }
                                $query .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";
                        
                                $cat_res = mysqli_query($con, $query);
                        
                                if ($cat_res) {
                                    $cat_arr = [];
                                    while ($row = mysqli_fetch_assoc($cat_res)) {
                                        $cat_arr[] = $row;
                                    }
                        
                                    $countQuery = "SELECT COUNT(*) as total FROM users WHERE 1";
                                    if (!empty($search)) {
                                        $countQuery .= " AND name LIKE '%" . mysqli_real_escape_string($con, $search) . "%'";
                                    }
                                    if ($sortByOnline) {
                                        $countQuery .= " AND is_online = '1'";
                                    }
                        
                                    $countResult = mysqli_query($con, $countQuery);
                                    $totalRows = 0;
                                    $totalPages = 1;
                                    if ($countResult) {
                                        $totalRows = mysqli_fetch_assoc($countResult)['total'];
                                        $totalPages = ceil($totalRows / $limit);
                                    }
                        
                                    if (count($cat_arr) > 0) {
                                        foreach ($cat_arr as $list):
                                            $location = $list['location'];
                                            $parts = explode(' - ', $location);
                                            $countryCode = isset($parts[0]) ? strtolower($parts[0]) : '';
                                ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <a class="card card-link" href="members-info.php?userid=<?php echo $list['id']; ?>">
                                        <div class="card-body align-items-center d-flex">
                                            <div class="float-left mr-3">
                                                <span class="avatar rounded avatar-md flag-country-<?php echo $countryCode; ?>">
                                                    <span class="badge <?php echo $list['is_online'] == '1' ? 'bg-green' : 'bg-secondary'; ?>"></span>
                                                </span>
                                            </div>
                                            <div class="lh-sm">
                                                <div class="strong text-truncate"><?php echo htmlspecialchars($list['name']); ?></div>
                                                <div class="text-muted text-truncate">
                                                    <h5 class="my-0 line-height-small"><?php echo htmlspecialchars($list['email']); ?></h5>
                                                    <h5 class="my-0 line-height-small"><?php echo $list['is_online'] == '1' ? 'Online now' : 'Offline'; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php 
                                        endforeach;
                                    } else {
                                        // No users found message
                                        echo '<div class="col-12"><div class="alert alert-warning text-center">No users found matching your criteria.</div></div>';
                                    }
                                } else {
                                    // Query failed
                                    echo '<div class="col-12"><div class="alert alert-danger text-center">Something went wrong. Unable to fetch users.</div></div>';
                                }
                                ?>
                            </div>
                        </div>
                        
                        <?php if (!empty($totalPages) && $totalPages > 1): ?>
                        <div class="card-footer d-flex align-items-center">
                            <ul class="pagination m-0 ml-auto">
                                <?php
                                $queryString = [];
                                if (!empty($search)) $queryString[] = "search=" . urlencode($search);
                                if ($sortByOnline) $queryString[] = "online=1";
                                $baseUrl = '?' . implode('&', $queryString);
                                ?>
                                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                    <a class="page-link" href="<?php echo $page > 1 ? $baseUrl . "&page=" . ($page - 1) : '#'; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"><polyline points="15 6 9 12 15 18"></polyline></svg>
                                        prev
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                        <a class="page-link" href="<?php echo $baseUrl . "&page=" . $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                                    <a class="page-link" href="<?php echo $page < $totalPages ? $baseUrl . "&page=" . ($page + 1) : '#'; ?>">
                                        next
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"><polyline points="9 6 15 12 9 18"></polyline></svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>


                </div>
            </div>
        </div>
    </div>
    <!-- footer Start -->
    <?php include('footer.php'); ?>
    <!-- footer end -->
</div>

    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->