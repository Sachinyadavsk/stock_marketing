<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<!-- header url end -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script>
    jQuery(document).ready(function ($) {
        $.noConflict();
        var start = moment().subtract(365, 'days');
        var end = moment().add(1, 'days');

        function cb(start, end) {
            $('#reportrange').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment().add(1, 'days')],
                'Yesterday': [moment().subtract(1, 'days'), moment()],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });

</script>

<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->

        <div class="content">
            <div class="container-xl">
                <div class="">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h2 class="page-title">All Paid History</h2>
                            </div>
                        </div>
                        <div class="download_button_record">
                            <button class="btn btn-success btn-sm" id="download_button" style="float: right;"> <i
                                    class="mdi mdi-home"></i>Download</button>
                        </div>
                    </div>
                </div>
                
                <?php
                        // Handle bulk status update and filters
                        $limit = isset($_GET['e']) ? (int)$_GET['e'] : 10;
                        $search = isset($_GET['s']) ? trim($_GET['s']) : '';
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $start_from = ($page - 1) * $limit;
                        
                        $conditions = ["withdrawal.status = 'success'"];
                        
                        if ($search !== '') {
                            $search_esc = mysqli_real_escape_string($con, $search);
                            $conditions[] = "(users.id LIKE '%$search_esc%' 
                                             OR withdrawal.username LIKE '%$search_esc%' 
                                             OR withdrawal.upi_id LIKE '%$search_esc%' 
                                             OR withdrawal.ip LIKE '%$search_esc%')";
                        }
                        
                        // Date range filter
                        $date_filter_value = '';
                        if (isset($_POST['filter-submit']) && !empty($_POST['datetime'])) {
                            $date_filter_value = $_POST['datetime'];
                            $date_range = explode(' - ', $_POST['datetime']);
                            if (count($date_range) === 2) {
                                $start_date = date('Y-m-d 00:00:00', strtotime(trim($date_range[0])));
                                $end_date = date('Y-m-d 23:59:59', strtotime(trim($date_range[1])));
                                $conditions[] = "(withdrawal.created_at BETWEEN '$start_date' AND '$end_date')";
                            }
                        }
                        
                        $where = 'WHERE ' . implode(' AND ', $conditions);
                        
                        $sql = "
                            SELECT withdrawal.*, users.id AS external_user_id
                            FROM withdrawal
                            JOIN users ON withdrawal.user_id = users.id
                            $where
                            ORDER BY withdrawal.id DESC
                            LIMIT $start_from, $limit
                        ";
                        $result = mysqli_query($con, $sql);
                        
                        $count_sql = "
                            SELECT COUNT(*) as total 
                            FROM withdrawal
                            JOIN users ON users.id = withdrawal.user_id
                            $where
                        ";
                        $count_result = mysqli_query($con, $count_sql);
                        $total_row = mysqli_fetch_assoc($count_result);
                        $total_records = $total_row['total'];
                        $total_pages = ceil($total_records / $limit);
                        $start_record = $total_records > 0 ? $start_from + 1 : 0;
                        $end_record = min($start_from + $limit, $total_records);
                        
                        function buildQuery($overrides = []) {
                            $params = $_GET;
                            foreach ($overrides as $key => $value) {
                                $params[$key] = $value;
                            }
                            return '?' . http_build_query($params);
                        }
                        ?>
                        
                        <!-- Filter Form -->
                        <div class="row">
                            <div class="box">
                                <div class="card">
                                    <div class="card-header" id="head" onclick="myFunction()">
                                        <div class="card-icon text-muted"><i class="fas fa-sync-alt fs-14"></i></div>
                                        <h3 class="card-title">Filter</h3>
                                    </div>
                                    <div class="card-body" id="report_data" style="display: none;">
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Date</label>
                                                        <input type="text" id="reportrange" class="form-control" name="datetime" readonly
                                                            value="<?= htmlspecialchars($date_filter_value) ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="mb-3">
                                                        <label class="form-label">&nbsp;</label>
                                                        <input type="submit" class="form-control btn btn-success" name="filter-submit" value="Filter">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="mb-3">
                                                        <label class="form-label">&nbsp;</label>
                                                        <a href=""><button type="button" class="form-control btn btn-danger">Clear</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Withdraw Table -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header"><h3 class="card-title">Paid History</h3></div>
                                    <div class="card-body border-bottom py-3">
                                        <div class="d-flex">
                                            <div class="text-muted">
                                                Show
                                                <div class="mx-2 d-inline-block">
                                                    <form method="get" action="">
                                                        <?php if ($search !== ''): ?>
                                                            <input type="hidden" name="s" value="<?= htmlspecialchars($search) ?>">
                                                        <?php endif; ?>
                                                        <input name="e" type="text" class="form-control form-control-sm" value="<?= $limit ?>" size="2" onchange="this.form.submit()">
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
                                                            value="<?= htmlspecialchars($search) ?>" placeholder="Search..."
                                                            onchange="this.form.submit()">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <form method="post" action="">
                                        <div class="table-responsive">
                                            <table class="table card-table table-vcenter text-nowrap datatable">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="selectAll"></th>
                                                        <th class="w-1">#</th>
                                                        <th>User ID</th>
                                                        <th>User Name</th>
                                                        <th>Transaction ID</th>
                                                        <th>UPI ID</th>
                                                        <th>IP Address</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (mysqli_num_rows($result) > 0): ?>
                                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                            <tr>
                                                                <td><input type="checkbox" class="all" name="ids[]" value="<?= $row['id'] ?>"></td>
                                                                <td><?= $row['id'] ?></td>
                                                                <td><?= htmlspecialchars($row['user_id']) ?></td>
                                                                <td><?= htmlspecialchars($row['username']) ?></td>
                                                                <td><?= htmlspecialchars($row['transaction_id']) ?></td>
                                                                <td><?= htmlspecialchars($row['upi_id']) ?></td>
                                                                <td><?= htmlspecialchars($row['ip']) ?></td>
                                                                <td><?= htmlspecialchars($row['amount']) ?></td>
                                                                <td class="text-success"><?= htmlspecialchars($row['status']) ?></td>
                                                                <td><?= htmlspecialchars($row['created_at']) ?></td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="10" class="text-center text-muted">No records found.</td>
                                                        </tr>
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
                        
                                    </form>
                                </div>
                            </div>
                        </div>


                <script>
                    document.getElementById('selectAll').addEventListener('click', function () {
                        document.querySelectorAll('.all').forEach(cb => cb.checked = this.checked);
                    });

                    function myFunction() {
                        var x = document.getElementById("report_data");
                        x.style.display = (x.style.display === "none" || x.style.display === "") ? "block" : "none";
                    }

                    $('#download_button').on('click', function () {
                        if ($('.all:checked').length === 0) {
                            alert("Please select at least one row.");
                            return false;
                        }

                        var data = [["ID", "User ID", "User Name", "Transaction ID", "UPI ID", "IP", "Amount", "Status", "Date"]];
                        $('.all:checked').each(function () {
                            var row = $(this).closest('tr');
                            data.push([
                                row.find('td:eq(1)').text().trim(),
                                row.find('td:eq(2)').text().trim(),
                                row.find('td:eq(3)').text().trim(),
                                row.find('td:eq(4)').text().trim(),
                                row.find('td:eq(5)').text().trim(),
                                row.find('td:eq(6)').text().trim(),
                                row.find('td:eq(7)').text().trim(),
                                row.find('td:eq(8)').text().trim(),
                                row.find('td:eq(9)').text().trim()
                            ]);
                        });

                        const wb = XLSX.utils.book_new();
                        const ws = XLSX.utils.aoa_to_sheet(data);
                        XLSX.utils.book_append_sheet(wb, ws, "paidamounts");
                        XLSX.writeFile(wb, "paidamounts.xlsx");
                    });
                </script>
            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>

    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->