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
                            <h2 class="page-title">Offer's Report</h2>
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
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Total Clicks</th>
                                            <th>Total Conversion</th>
                                            <th>Total User</th>
                                            <th>Proxy Used</th>
                                            <th>Duplicate IP</th>
                                            <th>Geo</th>
                                            <th>Device</th>
                                            <th>Added On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                                 if(isset($_POST['filter-submit'])){
                                                 // Collecting data from the form
                                                $category = $_POST['category'];
                                                $name = $_POST['name'];
                                                $geo = $_POST['geo'];
                                                $device=$_POST['device'];
                                                $dateRange = $_POST['datetime'];
                                                $dateArray = explode(' - ', $dateRange);
                                                $startdate = $dateArray[0];
                                                $enddate = $dateArray[1];
                                                $dateTime1 = DateTime::createFromFormat('m/d/Y', $startdate);
                                                $dateTime2 = DateTime::createFromFormat('m/d/Y', $enddate);
                                                $start_date = $dateTime1->format('d/m/Y');
                                                $end_date = $dateTime2->format('d/m/Y');
                                                // Storing data into an array
                                                $offer_data = array(
                                                    'offer_category' => $category,
                                                    'offer_name' => $name,
                                                    'offer_geo' => $geo,
                                                    'offer_device'=>$device,
                                                    'timestamp' => "timestamp BETWEEN '$start_date' AND '$end_date'");
                                                            
                                                // Initializing an empty array to store conditions
                                                $conditions = array();
                                                
                                                // Looping through the user data to build conditions
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
                                                            
                                                // Building the SQL query
                                                $cat_ress = "select * from final_report";
                                                $cat_ress .= " where " . implode(" and ", $conditions). " group by offer_id order by id desc";
                                                $cat_res=mysqli_query($con,$cat_ress);
                                                    }else{
                                                      $cat_res=mysqli_query($con,"select * from final_report group by offer_id order by id desc ");
                                                    }
                                                    $cat_arr=array();
                                                    while($row=mysqli_fetch_assoc($cat_res)){
                                                      $cat_arr[]=$row;    
                                                    }
                                                     foreach($cat_arr as $list){
                                                      $user_id=$list['user_id'];
                                                      $user_click_id=$list['user_click_id'];
                                                      $offer_id=$list['offer_id'];
                                                ?>
                                                
                                                <?php
                                                  $total_users=0;
                                                  $cat_res=mysqli_query($con,"select * from final_report where offer_id='$offer_id'");
                                                  $cat_arr=array();
                                                    while($row=mysqli_fetch_assoc($cat_res)){
                                                        $cat_arr[]=$row;    
                                                    }
                                                     foreach($cat_arr as $lista){
                                                      $total_users++;   
                                                     }
                                                ?>
                                                
                                                <?php
                                                  $total_clicks=0;
                                                  $cat_res=mysqli_query($con,"select * from final_report where offer_id='$offer_id'");
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
                                                    $cat_res=mysqli_query($con,"select * from postback where offer_id='$offer_id' and status='1'");
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
                                                    $cat_res=mysqli_query($con,"select * from postback where offer_id='$offer_id' and status='0'");
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
                                                    $cat_res=mysqli_query($con,"select * from postback where offer_id='$offer_id' and status='2'");
                                                    $cat_arr=array();
                                                    while($row=mysqli_fetch_assoc($cat_res)){
                                                      $cat_arr[]=$row;    
                                                    }
                                                     foreach($cat_arr as $liste){
                                                      $total_same_ip++;   
                                                     }
                                               ?>
                                            <tr>
                                                <td data-label="Offer Id">
                                                     <div class="text-muted text-h5"><?php echo $list['offer_id'];?></div>
                                                </td>
                                                <td data-label="Offer Category">
                                                    <div class="text-muted text-h5"><a href="https://reapbucks.com/admin/report-offer/<?php echo $list['offer_id'];?>"><?php echo $list['offer_category'];?></a></div>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Offer Name">
                                                    <a href="https://reapbucks.com/admin/report-offer/<?php echo $list['offer_id'];?>"><?php echo $list['offer_name'];?></a>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Total Clicks">
                                                    <?php echo $total_clicks;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Total Valid Conversion">
                                                    <?php echo $total_valid_conversion;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Total Users">
                                                    <?php echo $total_users;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Total Proxy">
                                                    <?php echo $total_proxy;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Total Same IP">
                                                    <?php echo $total_same_ip;?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Offer Geo">
                                                    <?php echo $list['offer_geo'];?>
                                                </td>
                                                <td class="text-muted text-nowrap" data-label="Offer Device">
                                                    <?php echo $list['offer_device'];?>
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
                               <?php
                                 $count=0;
                                 $users=array();
                                 $cat_res=mysqli_query($con,"select * from offer_clicks where offer_id='$ofrid'");
                                $cat_arr=array();
                                while($row=mysqli_fetch_assoc($cat_res)){
                                  $cat_arr[]=$row;    
                                }
                                 foreach($cat_arr as $list){
                                  $count++;   
                                  array_push($users,$list['user_id']);
                                 }
                                ?>
                                
                            <?php
                              $counter=0;
                              $cat_res=mysqli_query($con,"select * from postback where offer_id='$ofrid'");
                                $cat_arr=array();
                                while($row=mysqli_fetch_assoc($cat_res)){
                                  $cat_arr[]=$row;    
                                }
                                 foreach($cat_arr as $list){
                                  $counter++;   
                                 }
                            ?>
                            <?php
                                $cat_res=mysqli_query($con,"select * from offers");
                                $cat_arr=array();
                                while($row=mysqli_fetch_assoc($cat_res)){
                                  $cat_arr[]=$row;    
                                }
                                 foreach($cat_arr as $list1){
                                     $oi=$list1['id'];
                            ?>
                                        <div class="modal fade" id="modal-clicks<?php echo $list1['id'];?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <?php echo $list1['name'];?> Report
                                                        </h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i
                                                                class="mdi mdi-close"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <h5 class="modal-title">User :</h5><br>
                                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <h5 class="modal-title">IP :</h5><br>
                                                                        </div>
                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      <?php }?>
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