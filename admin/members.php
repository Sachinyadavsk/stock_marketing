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
                                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                $offset = ($page - 1) * $limit;
                                $sortByOnline = isset($_GET['online']) && $_GET['online'] == 1;

                                $query = "SELECT * FROM users";
                                if ($sortByOnline) {
                                    $query .= " WHERE is_online='1' ORDER BY id DESC";
                                } else {
                                    $query .= " ORDER BY id DESC";
                                }
                                $query .= " LIMIT $limit OFFSET $offset";

                                $cat_res = mysqli_query($con, $query);
                                $cat_arr = [];
                                while ($row = mysqli_fetch_assoc($cat_res)) {
                                    $cat_arr[] = $row;
                                }

                                $countQuery = "SELECT COUNT(*) as total FROM users";
                                $countResult = mysqli_query($con, $countQuery);
                                $totalRows = mysqli_fetch_assoc($countResult)['total'];
                                $totalPages = ceil($totalRows / $limit);

                                foreach ($cat_arr as $list) {
                                    $location = $list['location']; // Example: "IN - Delhi - Delhi"
                                    $parts = explode(' - ', $location);
                                    $countryCode = isset($parts[0]) ? strtolower($parts[0]) : '';
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <a class="card card-link" href="members-info.php?userid=<?php echo $list['id']; ?>">
                                    <div class="card-body align-items-center d-flex">
                                        <div class="float-left mr-3">
                                            <span class="avatar rounded avatar-md flag-country-<?php echo $countryCode; ?>">
                                                <?php if ($list['is_online']=='1'): ?>
                                                    <span class="badge bg-green"></span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"></span>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <div class="lh-sm">
                                            <div class="strong text-truncate"><?php echo $list['name']; ?></div>
                                            <div class="text-muted text-truncate">
                                                <h5 class="my-0 line-height-small"><?php echo $list['email']; ?></h5>
                                                <h5 class="my-0 line-height-small">
                                                    <?php echo $list['is_online']=='1' ? 'Online now' : 'Offline'; ?>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <ul class="pagination m-0 ml-auto">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                        <a class="page-link" href="<?php if ($page > 1) echo "?page=" . ($page - 1) . ($sortByOnline ? "&online=1" : ""); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="15 6 9 12 15 18"></polyline>
                                            </svg>
                                            prev
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?><?php echo $sortByOnline ? '&online=1' : ''; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                                        <a class="page-link" href="<?php if ($page < $totalPages) echo "?page=" . ($page + 1) . ($sortByOnline ? "&online=1" : ""); ?>">
                                            next
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="9 6 15 12 9 18"></polyline>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </ul>
                    </div>
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