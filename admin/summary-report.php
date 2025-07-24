<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script>
jQuery(document).ready(function($) {
$.noConflict();
    var start = moment().subtract(365, 'days');
    var end = moment().add(1,'days');

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
                    <div class="box">
                        <div class="card">
                        <div class="card-header" id="head" onclick="myFunction()">
                            <div class="card-icon text-muted"><i class="fas fa-sync-alt fs-14"></i></div>
                            <h3 class="card-title">Filter</h3>&nbsp&nbsp<h3 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <circle cx="10" cy="10" r="7"></circle>
                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                        </svg></h3>
                        </div>
                        <div class="card-body" id="report_data" style="display: none;">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Click ID</label>
                                        <input type="text" name="clickid" class="form-control" value="<?= $_POST['clickid'] ?? '' ?>" placeholder="Click ID">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Client Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= $_POST['name'] ?? '' ?>" placeholder="Client Name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Geo</label>
                                        <input type="text" name="geo" class="form-control" value="<?= $_POST['geo'] ?? '' ?>" placeholder="Geo">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Device</label>
                                        <input type="text" name="device" class="form-control" value="<?= $_POST['device'] ?? '' ?>" placeholder="Device">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Postback IP</label>
                                        <input type="text" name="postbackip" class="form-control" value="<?= $_POST['postbackip'] ?? '' ?>" placeholder="Postback IP">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">User IP</label>
                                        <input type="text" name="userip" class="form-control" value="<?= $_POST['userip'] ?? '' ?>" placeholder="User IP">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Date Range</label>
                                        <input type="text" id="reportrange" class="form-control" name="datetime" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label d-block">&nbsp;</label>
                                        <button type="submit" name="filter-submit" class="btn btn-success">Filter</button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <label class="form-label d-block">&nbsp;</label>
                                        <a href=""><button type="button" class="btn btn-danger">Clear</button></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h2 class="page-title">Summary Report</h2>
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
                                <h4 class="card-title">All Time Report — <h4>

                            </div>
                          
                            <div class="card-body card-block text-center p-3">
                                <!-- TABLE-->
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-bordered table-mobile-sm card-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S.N</th>
                                            <th>Client Name</th>
                                            <th>Total Offers</th>
                                            <th>Total Clicks</th>
                                            <th>Total Conversion</th>
                                            <th>Added On</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(isset($_POST['filter-submit'])){
                                                $clickid = $_POST['clickid'];
                                                $name = $_POST['name'];
                                                $geo = $_POST['geo'];
                                                $device=$_POST['device'];
                                                $postbackip = $_POST['postbackip'];
                                                $userip=$_POST['userip'];
                                                $dateRange = $_POST['datetime'];
                                                $dateArray = explode(' - ', $dateRange);
                                                $startdate = $dateArray[0];
                                                $enddate = $dateArray[1];
                                                $dateTime1 = DateTime::createFromFormat('m/d/Y', $startdate);
                                                $dateTime2 = DateTime::createFromFormat('m/d/Y', $enddate);
                                                $start_date = $dateTime1->format('d/m/Y');
                                                $end_date = $dateTime2->format('d/m/Y');
                                                $offer_data = array(
                                                    'user_click_id' => $clickid,
                                                    'offer_name' => $name,
                                                    'offer_geo' => $geo,
                                                    'offer_device' => $device,
                                                    'user_ip' => $userip,
                                                    'postback_ip' => $postbackip,
                                                    'timestamp' => "timestamp BETWEEN '$start_date' AND '$end_date'"
                                                );

                                                        
                                                $conditions = array();
                                                foreach ($offer_data as $key => $value) {
                                                    if (!empty($value)) {
                                                        if($key=='timestamp')
                                                        {
                                                          $conditions[] = "$value";  
                                                        }else{
                                                        $conditions[] = "$key = '$value'";
                                                        }
                                                    }
                                                }
                                                        
                                                $cat_ress = "SELECT * FROM final_report";
                                                if (!empty($conditions)) {
                                                    $cat_ress .= " WHERE " . implode(" AND ", $conditions). " ORDER BY id DESC";
                                                        $cat_res=mysqli_query($con,$cat_ress);
                                                }
                                                }else{
                                                  $cat_res=mysqli_query($con,"SELECT * FROM final_report ORDER BY id DESC");
                                                }
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
                                                     $aa=$list['offer_id'];
                                                  $cat_res=mysqli_query($con,"SELECT * FROM accepted_ip WHERE offer_id IN ($aa)");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list1){
                                            ?>
                                                    
                                            <?php
                                                $total_offers=0;
                                                $cat_res=mysqli_query($con,"SELECT * FROM final_report WHERE offer_id='$aa'");
                                                     
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $lista){
                                                  $total_offers++;   
                                                 }
                                            ?>
                                                
                                            <?php
                                                $total_clicks=0;
                                                $cat_res=mysqli_query($con,"SELECT * FROM final_report WHERE offer_id='$aa'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $listb){
                                                  $total_clicks++;   
                                                 }
                                            ?>
                                                
                                            <?php
                                                $total_valid_conversion=0;
                                                $cat_res=mysqli_query($con,"SELECT * FROM postback WHERE offer_id='$aa' AND status='1'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $listc){
                                                  $total_valid_conversion++;   
                                                 }
                                            ?>
                                        <tr>
                                            
                                            <td class="text-muted text-nowrap" data-label="S.N">
                                                <?php echo $list['id'];?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Company Name">
                                                <?php echo $list1['company_name'];?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Total Offers">
                                                <?php echo $total_offers;?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Total Clicks">
                                                <?php echo $total_clicks;?>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="total Conversion">
                                                <?php echo $total_valid_conversion;?>
                                            </td>

                                            <td class="text-muted text-nowrap" data-label="Added On">
                                                <?php echo $list1['added_on'];?>
                                            </td>

                                        </tr>
                                        <?php }}?>
                                    </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="float-right text-nowrap flex-nowrap">

                        </div>
                    </div>
                    
                    <!--model-->
                     <script type="text/javascript">
                        $(document).ready(function () {
                            
                            $('#download_button').on('click', function () {
                                // Check if at least one row is selected
                                if ($('.all:checked').length === 0) {
                                    alert("Please select at least one row.");
                                    return false;
                                }
                    
                                // Process your selected rows data
                                var yourArray = [];
                                $("input:checkbox[name=chk]:checked").each(function () {
                                    yourArray.push($(this).val().split('*'));
                                });
                    
                                // Add header to the Excel sheet
                                var headerRow = ["ID", "Client Name", "Total Offers", "Total Clicks", "Total Conversion", "Added On"]; // Replace with your actual column names
                                yourArray.unshift(headerRow);
                    
                                // Create a new workbook
                                const wb = XLSX.utils.book_new();
                    
                                // Add a worksheet with the array data
                                const ws = XLSX.utils.aoa_to_sheet(yourArray);
                                XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
                    
                                // Save the workbook to a file
                                XLSX.writeFile(wb, "output.xlsx");
                            });
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