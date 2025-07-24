<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>


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
                            <h2 class="page-title">User's Report</h2>
                        </div>
                    </div>
                   <div class="download_button_record">
                        <button class="btn btn-success btn-sm" id="download_button" style="float: right;"> <i class="mdi mdi-home"></i>Download</button>
                    </div>
                </div>


                <div class="row">
                    <div class="box">
                        <?php
                        // Handle filters
                        $users_filter = $_GET['users'] ?? '';
                        $offers_filter = $_GET['offers'] ?? '';
                        $offers_cate_filter = $_GET['offers_cate'] ?? '';
                        $from_date = $_GET['from_date'] ?? '';
                        $to_date = $_GET['to_date'] ?? '';
                        
                        // Pagination setup
                        $limit = 10;
                        $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
                        $offset = ($page - 1) * $limit;
                        
                        // Dynamic where clause
                        $where = "WHERE 1";
                        if (!empty($users_filter)) {
                            $where .= " AND user_id = '$users_filter'";
                        }
                        if (!empty($offers_filter)) {
                            $where .= " AND offer_id = '$offers_filter'";
                        }
                        if (!empty($offers_cate_filter)) {
                            $where .= " AND offer_category = '$offers_cate_filter'";
                        }
                        if (!empty($from_date) && !empty($to_date)) {
                            $where .= " AND DATE(timestamp) BETWEEN '$from_date' AND '$to_date'";
                        }
                        
                        // Get total unique users count
                        $total_sql = "SELECT COUNT(DISTINCT user_id) as total FROM final_report $where";
                        $total_res = mysqli_query($con, $total_sql);
                        $total_users = mysqli_fetch_assoc($total_res)['total'];
                        $total_pages = ceil($total_users / $limit);
                        
                        // Fetch paginated user data
                        $user_sql = "SELECT * FROM final_report $where GROUP BY user_id ORDER BY id DESC LIMIT $limit OFFSET $offset";
                        $user_result = mysqli_query($con, $user_sql);
                        
                        // Load dropdown data (do it before HTML output)
                        $users_result = mysqli_query($con, "SELECT * FROM users");
                        $offers_result = mysqli_query($con, "SELECT * FROM offers");
                        $offers_cat = mysqli_query($con, "SELECT DISTINCT category FROM offer_categories");
                        
                        ?>

                        <!-- HTML Starts -->

                       <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All User's Report</h4>
                            </div>
                        
                            <!-- Filter Toggle -->
                           <div style="padding-right: 10px;font-weight: 700;"><p style="float: right;" onclick="myFunction()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <circle cx="10" cy="10" r="7"></circle>
                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                        </svg> Filter Data</p></div>
                        
                            <!-- FILTER FORM -->
                            <form method="GET" class="mb-4" id="report_data" style="display: none;">
                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <select name="users" class="form-control">
                                            <option value="">All Users</option>
                                            <?php while($rows = mysqli_fetch_assoc($users_result)): ?>
                                                <option value="<?= $rows['id']; ?>" <?= $users_filter == $rows['id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($rows['name']) ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="offers" class="form-control">
                                            <option value="">All Offers</option>
                                            <?php while($row = mysqli_fetch_assoc($offers_result)): ?>
                                                <option value="<?= $row['id'] ?>" <?= $offers_filter == $row['id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($row['name']) ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="offers_cate" class="form-control">
                                            <option value="">All Offers Category</option>
                                            <?php while($row = mysqli_fetch_assoc($offers_cat)): ?>
                                                <option value="<?= $row['category'] ?>" <?= $offers_cate_filter == $row['category'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($row['category']) ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" name="from_date" value="<?= $from_date ?>" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" name="to_date" value="<?= $to_date ?>" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                                    </div>
                                </div>
                            </form>
                        
                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-vcenter table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
                                            <th>Total Offers</th><th>Total Clicks</th><th>Total Conversions</th>
                                            <th>Proxy Used</th><th>Duplicate IP</th><th>Added On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($list = mysqli_fetch_assoc($user_result)): 
                                            $user_id = $list['user_id'];
                        
                                            $total_offers = mysqli_num_rows(mysqli_query($con, "SELECT id FROM final_report WHERE user_id='$user_id'"));
                                            $total_clicks = $total_offers; // Assuming 1 click per offer
                                            $total_valid_conversion = mysqli_num_rows(mysqli_query($con, "SELECT id FROM postback WHERE user_id='$user_id' AND status='1'"));
                                            $total_proxy = mysqli_num_rows(mysqli_query($con, "SELECT id FROM postback WHERE user_id='$user_id' AND status='0'"));
                                            $total_same_ip = mysqli_num_rows(mysqli_query($con, "SELECT id FROM postback WHERE user_id='$user_id' AND status='2'"));
                                        ?>
                                        <tr>
                                            <td><?= $list['id'] ?></td>
                                            <td><a href="https://reapbucks.com/admin/report-user/<?= $user_id ?>"><?= $list['user_name'] ?></a></td>
                                            <td><a href="mailto:<?= $list['user_email'] ?>"><?= $list['user_email'] ?></a></td>
                                            <td><a href="#"><?= $list['user_phone_number'] ?></a></td>
                                            <td><?= $total_offers ?></td>
                                            <td><?= $total_clicks ?></td>
                                            <td><?= $total_valid_conversion ?></td>
                                            <td><?= $total_proxy ?></td>
                                            <td><?= $total_same_ip ?></td>
                                            <td><?= $list['timestamp'] ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        
                            <!-- Pagination Links -->
                            <div class="text-center my-3">
                                <ul class="pagination justify-content-center">
                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <li class="page-item <?= ($i == $page ? 'active' : '') ?>">
                                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="float-right text-nowrap flex-nowrap">

                        </div>
                    </div>
                    <!--model-->
                        <script>
                                document.getElementById("download_button").addEventListener("click", function () {
                                var table = document.querySelector("table");
                                var rows = table.querySelectorAll("tr");
                                var yourArray = [];
                            
                                rows.forEach((row, rowIndex) => {
                                    let rowData = [];
                                    let cells = row.querySelectorAll("th, td");
                            
                                    cells.forEach(cell => {
                                        rowData.push(cell.innerText.trim());
                                    });
                            
                                    yourArray.push(rowData);
                                });
                            
                                // Create a new workbook
                                const wb = XLSX.utils.book_new();
                            
                                // Add a worksheet with the array data
                                const ws = XLSX.utils.aoa_to_sheet(yourArray);
                                XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
                            
                                // Save the workbook to a file
                                XLSX.writeFile(wb, "output.xlsx");
                            });
                        </script>
                        <script>
                          function myFunction() {
                            var x = document.getElementById("report_data");
                            if (x.style.display === "none" || x.style.display === "") {
                              x.style.display = "block";
                            } else {
                              x.style.display = "none";
                            }
                          }
                        </script>
                    
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