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
                            <h2 class="page-title">All Time Reject</h2>
                        </div>
                    </div>
                   <div class="download_button_record">
                        <button class="btn btn-success btn-sm" id="download_button" style="float: right;"> <i class="mdi mdi-home"></i>Download</button>
                    </div>
                </div>


                <div class="row">
                    <div class="box">
                        <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Time Reject — <h4>
                                        
                                </div>
                                <div style="padding-right: 10px;font-weight: 700;"><p style="float: right;" onclick="myFunction()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <circle cx="10" cy="10" r="7"></circle>
                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                        </svg> Filter Data</p></div>
                                <div class="card-body card-block text-center p-3">
                                    
                                    <?php
                                                // Get filters from GET
                                                $offers_cate_filter = $_GET['offers_cate'] ?? '';
                                                $offers_filter = $_GET['offers'] ?? '';
                                                $from_date = $_GET['from_date'] ?? '';
                                                $to_date = $_GET['to_date'] ?? '';
                                                $users_filter = $_GET['users'] ?? '';
                                                
                                                // Pagination setup
                                                $limit = 10;
                                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                                $start_from = ($page - 1) * $limit;
                                                
                                                // Filter WHERE clause
                                                $where = "WHERE 1";
                                               if (!empty($offers_filter)) {
                                                    $where .= " AND offer_id = '" . mysqli_real_escape_string($con, $offers_filter) . "'";
                                                }
                                                
                                                if (!empty($offers_cate_filter)) {
                                                    $where .= " AND offer_category = '" . mysqli_real_escape_string($con, $offers_cate_filter) . "'";
                                                }
                                                
                                                if (!empty($from_date)) {
                                                    $where .= " AND STR_TO_DATE(timestamp, '%d/%m/%Y %H:%i:%s') >= STR_TO_DATE('" . mysqli_real_escape_string($con, $from_date) . "', '%Y-%m-%d')";
                                                }
                                                if (!empty($to_date)) {
                                                    $where .= " AND STR_TO_DATE(timestamp, '%d/%m/%Y %H:%i:%s') <= STR_TO_DATE('" . mysqli_real_escape_string($con, $to_date) . "', '%Y-%m-%d')";
                                                }
                                                
                                                if (!empty($users_filter)) {
                                                    $where .= " AND user_id = '" . mysqli_real_escape_string($con, $users_filter) . "'";
                                                }
                                                
                                                
                                               $users_result = mysqli_query($con, "SELECT id, name FROM users ORDER BY name ASC");
                                               $offers_result = mysqli_query($con, "SELECT id, name FROM offers ORDER BY name ASC");
                                               $offers_cat = mysqli_query($con, "SELECT id, category FROM offer_categories ORDER BY id ASC");
                                                
                                                // Fetch filtered data
                                                $query = "SELECT * FROM reject $where ORDER BY id DESC LIMIT $start_from, $limit";
                                                $cat_res = mysqli_query($con, $query);
                                                
                                                // Count total for pagination
                                                $count_query = "SELECT COUNT(*) AS total FROM reject $where";
                                                $result = mysqli_query($con, $count_query);
                                                $row = mysqli_fetch_assoc($result);
                                                $total_records = $row['total'];
                                                $total_pages = ceil($total_records / $limit);
                                                ?>
                            
                                           <!-- FILTER FORM -->
                                            <form method="GET" class="mb-4"  id="report_data" style="display: none;">
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
                                                        <input type="date" name="from_date" value="<?= $from_date ?>" class="form-control" placeholder="From Date">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="date" name="to_date" value="<?= $to_date ?>" class="form-control" placeholder="To Date">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                                                    </div>
                                                </div>
                                            </form>
                            
                                    <!-- TABLE -->
                                     <div class="table-responsive">
                                     <table class="table table-vcenter table-bordered table-mobile-sm card-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>id</th>
                                                <th>Offer ID</th>
                                                <th>User ID</th>
                                                <th>User Proxy</th>
                                                <th>Reason</th>
                                                <th>Offer Category</th>
                                                <th>Offer Name</th>
                                                <th>Tracking Link</th>
                                                <th>Target Device</th>
                                                <th>Target Geo</th>
                                                <th>Points</th>
                                                <th>Daily Cap</th>
                                                <th>User Name</th>
                                                <th>User Email</th>
                                                <th>User Mobile</th>
                                                <th>User's Device</th>
                                                <th>User's Country</th>
                                                <th>User's State</th>
                                                <th>User's City</th>
                                                <th>Proxy</th>
                                                <th>Click ID</th>
                                                <th>Click IP</th>
                                                <th>Click Timing</th>
                                                <th>Added On</th>
                                           </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = $start_from + 1;
                                                while ($list = mysqli_fetch_assoc($cat_res)) {
                                                    $offer_id = $list['offer_id'];
                                                    $user_id = $list['user_id'];
                                                    $inputString=$list['user_location'];
                                                    $components = explode(" - ", $inputString);

                                                    // Store components in separate variables
                                                    $country = $components[0];
                                                    $state = $components[1];
                                                    $city = $components[2];
                                                ?>
                                            <tr>
                                                <td data-label="Id">
                                                     <div class="text-muted text-h5"><?php echo $list['id'];?></div>
                                                </td>
                                                <td data-label="Offer Id">
                                                     <div class="text-muted text-h5"><?php echo $list['offer_id'];?></div>
                                                </td>
                                                <td data-label="User Id">
                                                    <div class="text-muted text-h5"><?php echo $list['user_id'];?></div>
                                                </td>
                                                
                                                <td data-label="User Proxy">
                                                    <div class="text-muted text-h5"><?php echo $list['user_proxy'];?></div>
                                                </td>
                                                
                                                <td data-label="Reason">
                                                    <div class="text-muted text-h5"><?php echo $list['reason'];?></div>
                                                </td>
                                                
                                                
                                                <td class="text-muted text-nowrap" data-label="Offer Category">
                                                   <?php echo $list['offer_category'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Offer Name">
                                                    <?php echo $list['offer_name'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Offer Tracking Link">
                                                    <?php echo $list['offer_tracking_link'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Offer Device">
                                                    <?php echo $list['offer_device'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Offer Geo">
                                                    <?php echo $list['offer_geo'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Offer Points">
                                                    <?php echo $list['offer_points'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Offer Cap">
                                                    <?php echo $list['offer_cap'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="User Name">
                                                    <?php echo $list['user_name'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="User Email">
                                                   <?php echo $list['user_email'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="User Phone Number">
                                                    <?php echo $list['user_phone_number'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="User Device">
                                                    <?php echo $list['user_device'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Country">
                                                   <?php echo $country;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="State">
                                                    <?php echo $state;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="City">
                                                    <?php echo $city;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="User Proxy">
                                                    <?php if($list['user_proxy']==0){
                                                       echo '1';}else{ echo '0';}?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="User Click Id">
                                                    <?php echo $list['user_click_id'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="User IP">
                                                   <?php echo $list['user_ip'];?>
                                                </td>
                                                
                                                <td class="text-muted text-nowrap" data-label="User Click Time">
                                                   <?php echo $list['user_click_time'];?>
                                                </td>
                                               
                                                <td class="text-muted text-nowrap" data-label="Date / Time">
                                                    <?php echo $list['timestamp'];?>
                                                </td>
                                                
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    </div>
                            
                                    <!-- PAGINATION -->
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            <?php
                                                for ($i = 1; $i <= $total_pages; $i++) {
                                                    $active = ($i == $page) ? 'active' : '';
                                                    $queryParams = http_build_query(array_merge($_GET, ['page' => $i]));
                                                    echo "<li class='page-item $active'><a class='page-link' href='?$queryParams'>$i</a></li>";
                                                }
                                                ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        <div class="float-right text-nowrap flex-nowrap">

                        </div>
                    </div>
                    
                    
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