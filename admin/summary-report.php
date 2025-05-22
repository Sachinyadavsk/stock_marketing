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
                            <div class="table-responsive">
                                <table class="table table-vcenter table-bordered table-mobile-sm card-table">
                                    <thead>
                                        <tr>
                                            <th>id</th>
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
                                                    'timestamp' => "timestamp BETWEEN '$start_date' AND '$end_date'");

                                                    
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
                                                     $aa=$list['offer_id'];
                                                  $cat_res=mysqli_query($con,"select * from accepted_ip where offer_id='$aa'");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list1){
                                                ?>
                                                 <?php
                                                  $total_offers=0;
                                                  $cat_res=mysqli_query($con,"select * from final_report where offer_id='$aa'");
                                                 
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
                                                 $cat_res=mysqli_query($con,"select * from final_report where offer_id='$aa'");
                                                 
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
                                                $cat_res=mysqli_query($con,"select * from postback where offer_id='$aa' and status='1'");
                                                 
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $listc){
                                                  $total_valid_conversion++;   
                                                 }
                                                ?>
                                            <tr>
                                                <td data-label="Id">
                                                     <div class="text-muted text-h5"><?php echo $list['id'];?></div>
                                                </td>
                                                <td data-label="Company Name">
                                                    <div class="text-muted text-h5"><?php echo $list1['company_name'];?></div>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Total Offers">
                                                    <?php echo $total_offers;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Total Clicks">
                                                    <?php echo $total_clicks;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Total Valid Conversion">
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