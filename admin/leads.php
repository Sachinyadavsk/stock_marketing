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
                            <h2 class="page-title">All Time Report</h2>
                        </div>
                    </div>
                   <div class="download_button_record">
                        <button class="btn btn-success btn-sm" id="download_button" style="float: right;"> <i class="mdi mdi-home"></i>Download</button>
                    </div>
                </div>


                <div class="row">
                    <div class="box">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-bordered table-mobile-sm card-table">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Offer ID</th>
                                            <th>User ID</th>
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
                                            <th>Postback IP</th>
                                            <th>Click Timing</th>
                                            <th>Postback Timing</th>
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
                                                    
                                                    $cat_ress = "select * from final_report";
                                                    if (!empty($conditions)) {
                                                        $cat_ress .= " where " . implode(" and ", $conditions). " order by id desc";
                                                            $cat_res=mysqli_query($con,$cat_ress);
                                                    }
                                                }else{
                                                  $cat_res=mysqli_query($con,"select * from final_report order by id desc");
                                                }
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
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
                                                <td class="text-muted text-nowrap" data-label="Postback IP">
                                                    <?php echo $list['postback_ip'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="User Click Time">
                                                   <?php echo $list['user_click_time'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Postback Time">
                                                    <?php echo $list['postback_time'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Date / Time">
                                                    <?php echo $list['timestamp'];?>
                                                </td>
                                                
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                                
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