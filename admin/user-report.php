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
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-bordered table-mobile-sm card-table">
                                    <thead>
                                        <tr>
                                           <th>ID</th>
                                           <th>Name</th>
                                           <th>Email</th>
                                           <th>Phone</th>
                                           <th>Total Offers</th>
                                           <th>Total Clicks</th>
                                           <th>Total Conversions</th>
                                           <th>Proxy Used</th>
                                           <th> Duplicate IP</th>
                                           <th>Added On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                                if(isset($_POST['filter-submit'])){
                                                 // Collecting data from the form
                                                $user_name = $_POST['username'];
                                                $user_email = $_POST['useremail'];
                                                $user_phone_number = $_POST['userphone'];
                                                $dateRange = $_POST['datetime'];
                                                $dateArray = explode(' - ', $dateRange);
                                                $startdate = $dateArray[0];
                                                $enddate = $dateArray[1];
                                                $dateTime1 = DateTime::createFromFormat('m/d/Y', $startdate);
                                                $dateTime2 = DateTime::createFromFormat('m/d/Y', $enddate);
                                                $start_date = $dateTime1->format('d/m/Y');
                                                $end_date = $dateTime2->format('d/m/Y');
                                                // Storing data into an array
                                                $user_data = array(
                                                    'user_name' => $user_name,
                                                    'user_email' => $user_email,
                                                    'user_phone_number' => $user_phone_number,
                                                    'timestamp' => "timestamp BETWEEN '$start_date' AND '$end_date'");
                                                            
                                                // Initializing an empty array to store conditions
                                                $conditions = array();
                                                
                                                // Looping through the user data to build conditions
                                                foreach ($user_data as $key => $value) {
                                                    if (!empty($value)) {
                                                        if($key=='timestamp')
                                                        {
                                                          $conditions[] = "$value";  
                                                        }else{
                                                        $conditions[] = "$key = '$value'";
                                                        }
                                                    }
                                                }
                                                            
                                                // Building the SQL query
                                                $cat_ress = "select * from final_report";
                                                $cat_ress .= " where " . implode(" and ", $conditions). " group by user_id order by id desc";
                                                $cat_res=mysqli_query($con,$cat_ress);
                                                }else{
                                                  $cat_res=mysqli_query($con,"select * from final_report group by user_id order by id desc ");
                                                }
                                                
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
                                                  $user_id=$list['user_id'];
                                                  $user_click_id=['user_click_id'];
                                                  $offer_id=['offer_id'];
                                                ?>
                                                
                                               <?php
                                                 $total_offers=0;
                                                 $cat_res=mysqli_query($con,"select * from final_report where user_id='$user_id'");
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
                                                    $cat_res=mysqli_query($con,"select * from final_report where user_id='$user_id'");
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
                                                  $cat_res=mysqli_query($con,"select * from postback where user_id='$user_id' and status='1'");
                                                    $cat_arr=array();
                                                    while($row=mysqli_fetch_assoc($cat_res)){
                                                      $cat_arr[]=$row;    
                                                    }
                                                     foreach($cat_arr as $listc){
                                                      $total_valid_conversion++;   
                                                     }
                                                ?>
                                                
                                                <?php
                                                    $total_proxy=0;
                                                    $cat_res=mysqli_query($con,"select * from postback where user_id='$user_id' and status='0'");
                                                         
                                                    $cat_arr=array();
                                                    while($row=mysqli_fetch_assoc($cat_res)){
                                                      $cat_arr[]=$row;    
                                                    }
                                                     foreach($cat_arr as $listd){
                                                      $total_proxy++;   
                                                     }
                                                ?>
                                                
                                                <?php
                                                  $total_same_ip=0;
                                                  $cat_res=mysqli_query($con,"select * from postback where user_id='$user_id' and status='2'");
                                                  $cat_arr=array();
                                                    while($row=mysqli_fetch_assoc($cat_res)){
                                                      $cat_arr[]=$row;    
                                                    }
                                                     foreach($cat_arr as $liste){
                                                      $total_same_ip++;   
                                                     }
                                                ?>
                                            <tr>
                                                <td data-label="Id">
                                                     <div class="text-muted text-h5"><?php echo $list['id'];?></div>
                                                </td>
                                                <td data-label="User Name">
                                                    <div class="text-muted text-h5"><a href="https://reapbucks.com/admin/report-user/<?php echo $list['user_id'];?>"><?php echo $list['user_name'];?></a></div>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="User Email">
                                                   <a href="https://reapbucks.com/admin/report-user/<?php echo $list['user_id'];?>"><?php echo $list['user_email'];?></a>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="User Phone Number">
                                                    <a href="https://reapbucks.com/admin/report-user/<?php echo $list['user_id'];?>"><?php echo $list['user_phone_number'];?></a>
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
                                                <td class="text-muted text-nowrap" data-label="Total Proxy">
                                                    <?php echo $total_proxy;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Total Same IP">
                                                   <?php echo $total_same_ip;?>
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