
<?php
    // view condition
    function has_module_access($con, $module_name) {
       if ($_SESSION['ROLE'] == 'superadmin') {
         return true;
       }
    
        $admin_id = $_SESSION['ADMIN_ID'];
        $module_query = mysqli_query($con, "SELECT id FROM access_module WHERE module_name = '$module_name' AND status = 1");
        if (mysqli_num_rows($module_query) > 0) {
            $module = mysqli_fetch_assoc($module_query);
            $module_id = $module['id'];
            $access_query = mysqli_query($con, "SELECT can_view FROM access_control WHERE user_id = '$admin_id' AND module_id = '$module_id'");
            if (mysqli_num_rows($access_query) > 0) {
                $access = mysqli_fetch_assoc($access_query);
                return $access['can_view'] == 1;
            }
        }
        return false; 
    }
    
    // insert condition
    function has_module_access_insert($con, $module_name) {
        if ($_SESSION['ROLE'] == 'superadmin') {
            return true;
        }
        $admin_id = $_SESSION['ADMIN_ID'];
        $module_query = mysqli_query($con, "SELECT id FROM access_module WHERE module_name = '$module_name' AND status = 1");
        if (mysqli_num_rows($module_query) > 0) {
            $module = mysqli_fetch_assoc($module_query);
            $module_id = $module['id'];
            $access_query = mysqli_query($con, "SELECT can_insert FROM access_control WHERE user_id = '$admin_id' AND module_id = '$module_id'");
            if (mysqli_num_rows($access_query) > 0) {
                $access = mysqli_fetch_assoc($access_query);
                return $access['can_insert'] == 1;
            }
        }
        return false; 
    }
    
    // delete condition
    function has_module_access_delete($con, $module_name) {
        if ($_SESSION['ROLE'] == 'superadmin') {
            return true;
        }
        $admin_id = $_SESSION['ADMIN_ID'];
        $module_query = mysqli_query($con, "SELECT id FROM access_module WHERE module_name = '$module_name' AND status = 1");
        if (mysqli_num_rows($module_query) > 0) {
            $module = mysqli_fetch_assoc($module_query);
            $module_id = $module['id'];
            $access_query = mysqli_query($con, "SELECT can_delete FROM access_control WHERE user_id = '$admin_id' AND module_id = '$module_id'");
            if (mysqli_num_rows($access_query) > 0) {
                $access = mysqli_fetch_assoc($access_query);
                return $access['can_delete'] == 1;
            }
        }
        return false; 
    }
    
    
    // edit condition
    function has_module_access_edit($con, $module_name) {
        if ($_SESSION['ROLE'] == 'superadmin') {
            return true;
        }
        $admin_id = $_SESSION['ADMIN_ID'];
        $module_query = mysqli_query($con, "SELECT id FROM access_module WHERE module_name = '$module_name' AND status = 1");
        if (mysqli_num_rows($module_query) > 0) {
            $module = mysqli_fetch_assoc($module_query);
            $module_id = $module['id'];
            $access_query = mysqli_query($con, "SELECT can_edit FROM access_control WHERE user_id = '$admin_id' AND module_id = '$module_id'");
            if (mysqli_num_rows($access_query) > 0) {
                $access = mysqli_fetch_assoc($access_query);
                return $access['can_edit'] == 1;
            }
        }
        return false; 
    }

?>







<header class="navbar navbar-expand-md navbar-dark">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="https://reapbucks.com/admin/index.php" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3">
                    <h2>Reap Bucks</h2>
                </a>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                            <span class="avatar" style="background-image: url(https://reapbucks.com/admin/assets/img/admin.png)"></span>
                            <div class="d-none d-xl-block pl-2">
                                <div><?php echo ucwords($_SESSION['ROLE'])?></div>
                                <div class="mt-1 small text-muted">Logged into Admin Panel</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="member-admin-sett.php">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                Profile settings
                            </a>
                            <a class="dropdown-item" onclick="resetTA()" href="#" data-toggle="modal"
                                data-target="#modal-note">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                    <line x1="16" y1="5" x2="19" y2="8" />
                                </svg>
                                Personal Note
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://reapbucks.com/admin/logout.php">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <path d="M7 6a7.75 7.75 0 1 0 10 0"></path>
                                    <line x1="12" y1="4" x2="12" y2="12"></line>
                                </svg>
                                Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <?php if($_SESSION['EMP_ACCESS']=='multiple_access'){ ?>
                                <li class="nav-item active">
                                <a class="nav-link" href="https://reapbucks.com/admin/index.php">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">Dashboard</span>
                                </a>
                            </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown"
                                        role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                                <path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">User Management</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/members.php">Users Directory</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/banned.php">Banned Users</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/history.php">Activities History</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/withdraw.php">Withdrawal History</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/paid.php">Paid History</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/pushmsg.php">Send Push Message</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/localmsg.php">Send Local Message</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a class="dropdown-item text-blue" href="https://reapbucks.com/admin/chat.php">Chat Room</a></li>
                                        <li><a class="dropdown-item font-weight-bold" href="https://reapbucks.com/admin/support.php">User Support</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown"
                                        role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <rect x="2" y="6" width="20" height="12" rx="2" />
                                                <path d="M6 12h4m-2 -2v4" />
                                                <line x1="15" y1="11" x2="15" y2="11.01" />
                                                <line x1="18" y1="13" x2="18" y2="13.01" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">Reports</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/report-summary/">Summary Report</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/report-user/">User Report</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/report-offer/">Offer Report</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/report-frauds/">Fraud Report</a></li>
                                         <li><a class="dropdown-item" href="https://reapbucks.com/admin/report-reject/">Reject Report</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/reports/">All Reports</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/activities-logs/">Activities Logs</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown"
                                        role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                                <path d="M7 15v-4a2 2 0 0 1 4 0v4"></path>
                                                <line x1="7" y1="13" x2="11" y2="13"></line>
                                                <path d="M17 9v6h-1.5a1.5 1.5 0 1 1 1.5 -1.5"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">Offerwalls</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!--<li><a class="dropdown-item" href="https://reapbucks.com/admin/cpa.php">API Offerwalls</a></li>-->
                                        <!--<li><a class="dropdown-item" href="https://reapbucks.com/admin/sdk.php">SDK Offerwalls</a></li>-->
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/custom.php">Custom Offerwall</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown"
                                        role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                                            <path d="M6 12h4m-2 -2v4"></path>
                                            <line x1="15" y1="11" x2="15" y2="11.01"></line>
                                            <line x1="18" y1="13" x2="18" y2="13.01"></line></svg>
                                        </span>
                                        <span class="nav-link-title">Setup</span>
                                    </a>
                                    
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/gateways.php">Withdrawal Setup</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/areward.php">Activity Reward Setup</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/frauds.php">Fraud Prevention</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/geo-api.php">Geo API Setup</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/settings.php">System Settings</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/faq-view.php">FAQ Management</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/maintain.php">Maintenance</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/lang.php">Languages</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/blogs/">Blogs</a></li>
                                    </ul>
                                    
                                </li>
                                  <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown"
                                        role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <path
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">Management</span>
                                    </a>
                                    
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/accepted-ip/">Advertisers IP</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/offer-categories/">Offer Categories</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/offer-types/">Offer Types</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/manage/">Manage Admin</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/module-setting/">Employee Access</a></li>
                                         <div class="dropdown-divider"></div>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/android-types/">Android Version</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/ios-types/">IOS Version</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/desktop-types/">Desktop Version</a></li>
                                    </ul>
                                    
                                </li>
                                
                              <?php  
                            }elseif ($_SESSION['EMP_ACCESS']=='single') {?>
                            
                                <li class="nav-item active">
                                    <a class="nav-link" href="https://reapbucks.com/admin/index.php">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">Dashboard</span>
                                    </a>
                                </li>
                               <?php if (has_module_access($con, 'user_management_menu')): ?>
                                   <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown"
                                        role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                                <path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">User Management</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php if (has_module_access($con, 'users_directory')): ?>
                                            <li><a class="dropdown-item" href="https://reapbucks.com/admin/members.php">Users Directory</a></li>
                                        <?php endif; ?>
                                        <?php if (has_module_access($con, 'banned_users')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/banned.php">Banned Users</a></li>
                                        <div class="dropdown-divider"></div>
                                         <?php endif; ?>
                                        <?php if (has_module_access($con, 'activities_history')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/history.php">Activities History</a></li>
                                         <?php endif; ?>
                                        <?php if (has_module_access($con, 'withdrawal_activity')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/withdraw.php">Withdrawal Activity</a></li>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/paid.php">Paid History</a></li>
                                         <?php endif; ?>
                                        <?php if (has_module_access($con, 'send_push_message')): ?>
                                        <div class="dropdown-divider"></div>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/pushmsg.php">Send Push Message</a></li>
                                         <?php endif; ?>
                                        <?php if (has_module_access($con, 'send_local_message')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/localmsg.php">Send Local Message</a></li>
                                        <div class="dropdown-divider"></div>
                                         <?php endif; ?>
                                        <?php if (has_module_access($con, 'chat_room')): ?>
                                        <li><a class="dropdown-item text-blue" href="https://reapbucks.com/admin/chat.php">Chat Room</a></li>
                                         <?php endif; ?>
                                        <?php if (has_module_access($con, 'user_support')): ?>
                                        <li><a class="dropdown-item font-weight-bold" href="https://reapbucks.com/admin/support.php">User Support</a></li>
                                         <?php endif; ?>
                                    </ul>
                                </li>
                              <?php endif; ?>
                                
                                 <?php if (has_module_access($con, 'reports_menu')): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown"
                                        role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <rect x="2" y="6" width="20" height="12" rx="2" />
                                                <path d="M6 12h4m-2 -2v4" />
                                                <line x1="15" y1="11" x2="15" y2="11.01" />
                                                <line x1="18" y1="13" x2="18" y2="13.01" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">Reports</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php if (has_module_access($con, 'summary_report')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/report-summary/">Summary Report</a></li>
                                         <?php endif; ?>
                                        <?php if (has_module_access($con, 'user_report')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/report-user/">User Report</a></li>
                                         <?php endif; ?>
                                        <?php if (has_module_access($con, 'offer_report')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/report-offer/">Offer Report</a></li>
                                        <div class="dropdown-divider"></div>
                                         <?php endif; ?>
                                        <?php if (has_module_access($con, 'fraud_report')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/report-frauds/">Fraud Report</a></li>
                                         <?php endif; ?>
                                         <?php if (has_module_access($con, 'report_reject')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/report-reject/">Reject Report</a></li>
                                         <?php endif; ?>
                                        <?php if (has_module_access($con, 'all_reports')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/reports/">All Reports</a></li>
                                         <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                
                                 <?php if (has_module_access($con, 'offer_walls_menu')): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown"
                                        role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                                <path d="M7 15v-4a2 2 0 0 1 4 0v4"></path>
                                                <line x1="7" y1="13" x2="11" y2="13"></line>
                                                <path d="M17 9v6h-1.5a1.5 1.5 0 1 1 1.5 -1.5"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">Offerwalls</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- </?php if (has_module_access($con, 'api_offerwalls')): ?>-->
                                        <!--<li><a class="dropdown-item" href="https://reapbucks.com/admin/cpa.php">API Offerwalls</a></li>-->
                                        <!-- </?php endif; ?>-->
                                        <!-- </?php if (has_module_access($con, 'sdk_offerwalls')): ?>-->
                                        <!--<li><a class="dropdown-item" href="https://reapbucks.com/admin/sdk.php">SDK Offerwalls</a></li>-->
                                        <!-- </?php endif; ?>-->
                                         <?php if (has_module_access($con, 'custom_offerwall')): ?>
                                        <li><a class="dropdown-item" href="https://reapbucks.com/admin/custom.php">Custom Offerwall</a></li>
                                         <?php endif; ?>
                                         
                                    </ul>
                                </li>
                                <?php endif; ?>
                                
                                <?php if (has_module_access($con, 'setup_menu')): ?>
                                  <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown"
                                    role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                                            <path d="M6 12h4m-2 -2v4"></path>
                                            <line x1="15" y1="11" x2="15" y2="11.01"></line>
                                            <line x1="18" y1="13" x2="18" y2="13.01"></line></svg>
                                    </span>
                                    <span class="nav-link-title">Setup</span>
                                </a>
                                
                                <ul class="dropdown-menu">
                                     <?php if (has_module_access($con, 'withdrawal_setup')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/gateways.php">Withdrawal Setup</a></li>
                                     <?php endif; ?>
                                     <?php if (has_module_access($con, 'activity_reward_setup')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/areward.php">Activity Reward Setup</a></li>
                                    <div class="dropdown-divider"></div>
                                     <?php endif; ?>
                                     <?php if (has_module_access($con, 'fraud_prevention')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/frauds.php">Fraud Prevention</a></li>
                                     <?php endif; ?>
                                     <?php if (has_module_access($con, 'geo_api_setup')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/geo-api.php">Geo API Setup</a></li>
                                    <div class="dropdown-divider"></div>
                                     <?php endif; ?>
                                     <?php if (has_module_access($con, 'system_settings')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/settings.php">System Settings</a></li>
                                     <?php endif; ?>
                                     <?php if (has_module_access($con, 'faq_management')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/faq-view.php">FAQ Management</a></li>
                                     <?php endif; ?>
                                     <?php if (has_module_access($con, 'maintenance')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/maintain.php">Maintenance</a></li>
                                    <div class="dropdown-divider"></div>
                                     <?php endif; ?>
                                     <?php if (has_module_access($con, 'languages')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/lang.php">Languages</a></li>
                                     <?php endif; ?>
                                     <?php if (has_module_access($con, 'blogs')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/blogs/">Blogs</a></li>
                                    <div class="dropdown-divider"></div>
                                     <?php endif; ?>
                                </ul>
                                
                            </li>
                                <?php endif; ?>
                                
                                <?php if (has_module_access($con, 'management_menu')): ?>
                                  <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown"
                                    role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <path
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                    </span>
                                    <span class="nav-link-title">Management</span>
                                </a>
                                
                                <ul class="dropdown-menu">
                                     <?php if (has_module_access($con, 'accepted_ip')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/accepted-ip/">Advertisers IP</a></li>
                                     <?php endif; ?>
                                     <?php if (has_module_access($con, 'offer_categories')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/offer-categories/">Offer Categories</a></li>
                                     <?php endif; ?>
                                      
                                     <?php if (has_module_access($con, 'offer_types')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/offer-types/">Offer Types</a></li>
                                     <?php endif; ?>
                                     
                                     <?php if (has_module_access($con, 'android_menu')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/android-types/">Android Version</a></li>
                                     <?php endif; ?>
                                     
                                     <?php if (has_module_access($con, 'ios_menu')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/ios-types/">IOS Version</a></li>
                                     <?php endif; ?>
                                     
                                     <?php if (has_module_access($con, 'desktop_menu')): ?>
                                    <li><a class="dropdown-item" href="https://reapbucks.com/admin/desktop-types/">Desktop Version</a></li>
                                     <?php endif; ?>
                                </ul>
                                
                            </li>
                                <?php endif; ?>
                                
                                <?php
                            }
                            ?>
                           
                        </ul>
                        
                        <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                            <form action="https://reapbucks.com/admin/result_search.php" method="post" autocomplete="off">
                                <div style="position: relative;">
                                    <!-- Input field -->
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search users" style="padding-right: 40px;">
                            
                                    <!-- Search button -->
                                    <button type="submit" name="search_data" style="
                                        position: absolute;
                                        right: 10px;
                                        top: 50%;
                                        transform: translateY(-50%);
                                        background: none;
                                        border: none;
                                        cursor: pointer;
                                        padding: 0;
                                    ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <circle cx="10" cy="10" r="7" />
                                            <line x1="21" y1="21" x2="15" y2="15" />
                                        </svg>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>