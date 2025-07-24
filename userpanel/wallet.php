<!-- header top url start -->
<?php include("header_top.php");?>
<!-- header top url end -->
<style>
    .chat-container {
     height: 300px;
    overflow-y: auto;
    padding-right: 5px;
}
.chat-message {
    display: flex;
    margin: 10px 0;
}
.chat-left {
    justify-content: flex-start;
}
.chat-right {
    justify-content: flex-end;
}
.chat-bubble-user {
    background-color: #cce5ff;
    color: #000;
    padding: 10px 15px;
    border-radius: 10px;
    max-width: 60%;
    box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
}
.chat-bubble-admin {
    background-color: #d4edda;
    color: #000;
    padding: 10px 15px;
    border-radius: 10px;
    max-width: 60%;
    box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
    text-align: right;
}
button {
    padding: 5px 10px;
    font-size: 14px;
    cursor: pointer;
}

.unread-badge {
    background-color: red;
    color: white;
    padding: 2px 8px;
    font-size: 12px;
    border-radius: 12px;
    margin-left: 5px;
}

.reply-box {
    margin-top: 15px;
}
.reply-box textarea {
    width: 100%;
    height: 60px;
    padding: 8px;
}
.reply-box button {
    margin-top: 5px;
    padding: 6px 12px;
}
</style>

<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1); 
    //   total balanace user start
        $use_bal=mysqli_query($con,"select sum(balance) as total_points from users where id='$admin_id'");
        $bal_arr=array();
        while($row=mysqli_fetch_assoc($use_bal)){
          $bal_arr[]=$row;    
        }
         foreach($bal_arr as $listbal){
          $total_bal=$listbal['total_points']; 
         } 
        $total_use_bal=$total_bal;
         //   total balanace user end
         
        $balance_user = $total_use_bal;
        $color_bg = "";
        $message = "";
        $show_withdraw_div = false;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_withdrawal'])) {
            $amount = (float)$_POST['amount'];
        
            if ($amount < 200) {
                $color_bg = 'red';
                $message = "Withdrawal amount must be ₹200 or more.";
                $show_withdraw_div = true;
            } elseif ($amount > $balance_user) {
                $color_bg = 'red';
                $message = "Insufficient balance for this withdrawal.";
                $show_withdraw_div = true;
            } else {
                // Get name
                $user_result = mysqli_query($con, "SELECT name FROM users WHERE id = '$admin_id'");
                if (!$user_result || mysqli_num_rows($user_result) == 0) {
                    $color_bg = 'red';
                    $message = "User not found.";
                    $show_withdraw_div = true;
                } else {
                    $user_row = mysqli_fetch_assoc($user_result);
                    $username = $user_row['name'];
        
                    // Get method_id and upi_id from my_account
                    $acc_result = mysqli_query($con, "SELECT method_id, upi_id FROM my_account WHERE user_id = '$admin_id'");
                    if (!$acc_result || mysqli_num_rows($acc_result) == 0) {
                        $color_bg = 'red';
                        $message = "Account details not found.";
                        $show_withdraw_div = true;
                    } else {
                        $acc_row = mysqli_fetch_assoc($acc_result);
                        $method_id = $acc_row['method_id'];
                        $upi_id = $acc_row['upi_id'];
        
                        $transaction_id = "TXN" . strtoupper(uniqid());
                        $ip = $_SERVER['REMOTE_ADDR'];
        
                        // Insert withdrawal
                        $insert_query = "INSERT INTO withdrawal (user_id, transaction_id, method_id, upi_id, amount, status, username, ip)
                                        VALUES ('$admin_id', '$transaction_id', '$method_id', '$upi_id', '$amount', 'pending', '$username', '$ip')";
                        $result = mysqli_query($con, $insert_query);
        
                        if ($result) {
                            // Deduct balance
                            mysqli_query($con, "UPDATE users SET balance = balance - $amount WHERE id = '$admin_id'");
                            $color_bg = 'green';
                            $message = "Withdrawal request for ₹$amount submitted successfully.";
                            $show_withdraw_div = true;
                        } else {
                            $color_bg = 'red';
                            $message = "Failed to process withdrawal.";
                            $show_withdraw_div = true;
                        }
                    }
                }
            }
        }
        ?>


    
<body class="g-sidenav-show  bg-gray-100 ">
    <!-- side nemu bar start -->
    <?php include("side_menu.php");?>
    <!-- side menu bar end -->

    <main class="main-content max-height-vh-100 h-100 position-relative border-radius-lg">
        <!-- Navbar -->
        <?php include("header.php");?>
        <!-- End Navbar -->

        <div class="container-fluid my-3 py-3">
            <div class="row mb-5">
                <div class="col-lg-3">
                    <div class="card position-sticky top-1">
                        <ul class="nav flex-column bg-white border-radius-lg p-3">
                            <li class="nav-item">
                                <a class="nav-link text-body" data-scroll="" href="#profile">
                                    <div class="icon me-2">
                                        <span class="text-dark fw-bold" style="font-size:16px;">₹</span>
                                    </div>
                                    <span class="text-sm">Wallet</span>
                                </a>
                            </li>
                           
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body" data-scroll="" href="#redeem">
                                    <div class="icon me-2">
                                        <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 42 42"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>box-3d-50</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(603.000000, 0.000000)">
                                                            <path class="color-background"
                                                                d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                                            </path>
                                                            <path class="color-background"
                                                                d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"
                                                                opacity="0.7"></path>
                                                            <path class="color-background"
                                                                d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"
                                                                opacity="0.7"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="text-sm">Transaction History</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 mt-lg-0 mt-4">
                    <!-- Card Profile -->
                    <div class="card card-body" id="profile">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4 text-center">
                                <div class="card" style="margin:10px">
                                    <h6>Total Balance</h6>
                                    <h4>₹<?php echo $total_dollar;?></h4>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 text-center">
                                <div class="card" style="margin:10px">
                                    <div class="row-withdraw" style="display:flex;justify-content: space-around;">
                                         <span>
                                               <h6>Winnings </h6>
                                               <h4>₹<?php echo $total_dollar;?></h4>
                                        </span>
                                         <span>
                                             <h6></h6>
                                             <a href="#withdraw-cash" onclick="toggleWithdraw()" style="padding:6px 15px 7px 15px;background: yellow;border-radius: 28px;font-weight: 600;"><i class="fa fa-arrow-down" aria-hidden="true">&nbsp;</i>Withdraw</a>
                                         </span>
                                    </div>
                               </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                 <div class="card" style="margin:10px">
                                     <h6>Cashback Reward</h6>
                                     <h4>₹<?php if(!empty($total_rewards)){ echo $total_rewards;}else{ echo '0.00';}?></h4>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Basic Info -->
                    
                     <!-- Card Basic Info -->
                    <div class="card mt-4" id="withdraw-cash" style="display: <?= $show_withdraw_div || !empty($message) ? 'block' : 'none' ?>;">
                        <div class="card-header">
                            <h5>Withdraw Cash</h5>
                        </div>
                        <div class="card-body pt-0">
                             <form method="post" action="">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label class="form-label">Winning balance ₹<?php echo $total_dollar; ?></label>
                                        <div class="input-group">
                                            <input type="number" id="amount" class="form-control" name="amount" placeholder="₹ Enter Amount" required>
                                        </div>
                                        <span id="message" style="color:<?php echo $color_bg;?>"><?= htmlspecialchars($message) ?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label class="form-label">&nbsp;</label>
                                        <button id="submitBtn" name="add_withdrawal" class="form-control btn btn-primary" type="submit" disabled>Continue</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    

                    <div class="card mt-4" id="redeem">
                        <div class="card-header">
                            <h5>Transaction History</h5>
                        </div>
                        <div class="card-body pt-0">
                             <?php
                                    $limit = 10;
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $start_from = ($page - 1) * $limit;
                                    
                                    // Fetch data from activity_history
                                    $query = "SELECT * FROM withdrawal WHERE user_id='$admin_id' ORDER BY id DESC LIMIT $start_from, $limit";
                                    $result = mysqli_query($con, $query);
                                    
                                    // Count total records
                                    $count_query = "SELECT COUNT(*) as total FROM withdrawal";
                                    $count_result = mysqli_query($con, $count_query);
                                    $count_row = mysqli_fetch_assoc($count_result);
                                    $total_records = $count_row['total'];
                                    $total_pages = ceil($total_records / $limit);
                                    
                                    $start_record = $start_from + 1;
                                    $end_record = min($start_from + $limit, $total_records);
                                    ?>
                            <div class="table-responsive">
                                <table class="table table-flush" id="data-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Mtehod</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                <?php if (mysqli_num_rows($result) > 0): ?>
                                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                        <tr>
                                                            <td><?= $row['id'] ?></td>
                                                            <td><?= htmlspecialchars($row['upi_id']) ?></td>
                                                            <td><?= htmlspecialchars($row['amount']) ?></td>
                                                            <td>
                                                               <?php if($row['status']=='pending'){ ?>
                                                                    <span class="text-warning"><?= $row['status'] ?></span>
                                                                <?php }else{ ?>
                                                                    <span class="text-success"><?= $row['status'] ?></span>
                                                               <?php } ?>
                                                            </td>
                                                            <td><?= $row['created_at'] ?></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr><td colspan="6" class="text-center">No data found.</td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

          <script>
            function toggleWithdraw() {
                var div = document.getElementById("withdraw-cash");
                if (div.style.display === "none" || div.style.display === "") {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
            </script>
          <script>
                const balance_user = <?php echo (float)$total_dollar; ?>;
                const amountInput = document.getElementById('amount');
                const submitBtn = document.getElementById('submitBtn');
                const messageSpan = document.getElementById('message');
            
                amountInput.addEventListener('input', function () {
                    const value = parseFloat(this.value);
            
                    if (value < 200) {
                        messageSpan.textContent = "Amount must be ₹200 or more.";
                        messageSpan.style.color = "red";
                        submitBtn.disabled = true;
                    } else if (value > balance_user) {
                        messageSpan.textContent = "Insufficient balance.";
                        messageSpan.style.color = "red";
                        submitBtn.disabled = true;
                    } else {
                        messageSpan.textContent = "";
                        submitBtn.disabled = false;
                    }
                });
            </script>



            <!-- footer start -->
            <?php include("footer.php");?>
            <!-- footer start -->

        </div>
    </main>
    <div>
    </div>
  
    <!-- footer url start -->
    <?php include("footer_url.php");?>
    <!-- footer url end -->