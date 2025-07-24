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
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="validationCustom01" class="form-label"> User Name</label>
                                            <input type="text" name="username" class="form-control"
                                                value="<?php echo $_REQUEST['username'];?>" placeholder="User Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="validationCustom01" class="form-label"> User Email</label>
                                            <input type="email" name="useremail" class="form-control"
                                                value="<?php echo $_REQUEST['useremail'];?>" placeholder="User Email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="validationCustom01" class="form-label">User Phone</label>
                                            <input type="text" name="userphone" class="form-control"
                                                value="<?php echo $_REQUEST['userphone'];?>" placeholder="User Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="validationCustom01" class="form-label">Date</label>
                                            <input type="text" id="reportrange" class="form-control" name="datetime"
                                                readonly />

                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-2 col-xs-2">
                                        <div class="mb-3">
                                            <label for="validationCustom01" class="form-label">&nbsp</label>
                                            <input type="submit" class="form-control btn btn-success"
                                                id="validationCustom01" name="filter-submit">
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-2 col-xs-2">
                                        <div class="mb-3">
                                            <label for="validationCustom01" class="form-label">&nbsp</label>
                                            <a href="">
                                                <button type="submit" class="form-control btn btn-danger"
                                                    id="validationCustom01">Clear</button>
                                            </a>
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
                            <h2 class="page-title">All Fraud Report</h2>
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
                                    <h4 class="card-title">All Fraud Report — <h4>
                                </div>
                                <div class="card-body card-block text-center p-3">
                                    
                                    <!-- TABLE -->
                                     <div class="table-responsive">
                                     <table class="table table-vcenter table-bordered table-mobile-sm card-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th><input type="checkbox" id="select_all" /> All</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Proxy Used</th>
                                            <th> Duplicate IP</th>
                                            <th>Added On</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                          $cat_res=mysqli_query($con,"select * from postback where status='0' or status='2'");
                                                         
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list0){
                                                      $user_id=$list0['user_id'];
                                                  $user_click_id=$list0['user_click_id'];
                                                  $offer_id=$list0['offer_id'];?>
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
                                                                'timestamp' => "timestamp BETWEEN '$start_date' AND '$end_date'"
                                                            );
                                                            
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
                                            <td class="align-middle"><input type="checkbox"
                                                    value="<?php echo $list['id'];?>*<?php echo $list['user_id'];?>*<?php echo $list['user_name'];?>*<?php echo $list['user_email'];?>*<?php echo $list['user_phone_number'];?>*<?php echo $total_proxy;?>*<?php echo $total_same_ip;?>*<?php echo $list['timestamp'];?>"
                                                    name="chk" class="all" /></td>
                                            <td class="align-middle">
                                                <?php echo $list['id'];?>
                                            </td>
                                            <td class="align-middle">
                                                <?php echo $list['user_name'];?>
                                            </td>
                                            <td class="align-middle">
                                                <?php echo $list['user_email'];?>
                                            </td>
                                            <td class="align-middle">
                                                <?php echo $list['user_phone_number'];?>
                                            </td>
                                            <td class="align-middle">
                                                <?php echo $total_proxy;?>
                                            </td>
                                            <td class="align-middle">
                                                <?php echo $total_same_ip;?>
                                            </td>
                                            <td class="align-middle">
                                                <?php echo $list['timestamp'];?>
                                            </td>
                                        </tr>
                                        <?php }}?>
                                    </tbody>
                                    </table>
                                    </div>
                            
                                    <!-- PAGINATION -->
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
                                    <?php }?>
                            
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#select_all').on('click', function () {
                                                if (this.checked) {
                                                    $('.all').each(function () {
                                                        this.checked = true;
                                                    });
                                                } else {
                                                    $('.all').each(function () {
                                                        this.checked = false;
                                                    });
                                                }
                                            });
                            
                                            $('.all').on('click', function () {
                                                if ($('.all:checked').length === $('.all').length) {
                                                    $('#select_all').prop('checked', true);
                                                } else {
                                                    $('#select_all').prop('checked', false);
                                                }
                                            });
                            
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
                                                var headerRow = ["ID", "User ID", "User Name", "User Email", "User Phone", "Proxy", "Duplicate IP", "Added On"]; // Replace with your actual column names
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
                                </div>
                            </div>
                        <div class="float-right text-nowrap flex-nowrap">

                        </div>
                    </div>
                
                          
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