<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->


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
                            <h2 class="page-title">Banned Users</h2>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="box">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-mobile-sm card-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Reason</th>
                                            <th>Date / Time</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM users WHERE banstatus='1' ORDER BY id DESC";
                                            $cat_res = mysqli_query($con, $query);
                                            $cat_arr = [];
                                            while ($row = mysqli_fetch_assoc($cat_res)) {
                                                $cat_arr[] = $row;
                                            }
            
                                            foreach ($cat_arr as $list) {
                                                $location = $list['location']; // Example: "IN - Delhi - Delhi"
                                                $parts = explode(' - ', $location);
                                                $countryCode = isset($parts[0]) ? strtolower($parts[0]) : '';
                                            ?>
                                        <tr>
                                            <td data-label="Name">
                                                <div class="d-flex lh-sm py-1 align-items-center">
                                                    <span class="avatar mr-2 avatar-md flag-country-<?php echo $countryCode;?>"></span>
                                                    <div class="flex-fill">
                                                        <div class="strong"><?php echo $list['name'];?></div>
                                                        <div class="text-muted text-h5"><a href="#"
                                                                class="text-reset"><?php echo $list['email'];?></a></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Reason">
                                                <div class="text-muted text-h5"><?php echo $list['reason'];?></div>
                                            </td>
                                            <td class="text-muted text-nowrap" data-label="Date / Time">
                                                <?php echo timeAgo($list['timestamp']);;?>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <?php if (has_module_access_edit($con, 'banned_users')): ?>
                                                       <a class="btn btn-white modalbtn" data-keyboard="false"
                                                        data-backdrop="static" data-toggle="modal"
                                                        data-target="#edit-reason" data-userid="<?php echo $list['id'];?>"
                                                        data-reason="<?php echo $list['reason'];?>">Edit</a>
                                                    <?php endif; ?>
                                                     <?php if (has_module_access_delete($con, 'banned_users')): ?>
                                                        <a class="btn btn-dark" href="members-unban.php?uid=<?php echo $list['id'];?>">Unban</a>
                                                     <?php endif; ?>
                                                </div>
                                                
                                                
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="float-right text-nowrap flex-nowrap">

                        </div>
                    </div>
                    <!--model-->
                       <form method="POST" class="modal modal-blur fade" id="edit-reason" tabindex="-1" role="dialog" aria-hidden="true">
                            <input type="hidden" name="userid" id="userid" value="">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update banning reason:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <line x1="18" y1="6" x2="6" y2="18" />
                                                <line x1="6" y1="6" x2="18" y2="18" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea id="reasoning" name="reason" class="form-control" data-toggle="autosize"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                                        <button type="submit" name="banedirupdate" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    
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