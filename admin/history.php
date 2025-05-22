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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Activities History</h3>
                            </div>
                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-muted">
                                        Show
                                        <div class="mx-2 d-inline-block">
                                            <form method="get" action="history">
                                                <input name="e" type="text" class="form-control form-control-sm"
                                                    value="10" size="2">
                                            </form>
                                        </div>
                                        entries
                                    </div>
                                    <div class="ml-auto text-muted">
                                        Search:
                                        <div class="ml-2 d-inline-block">
                                            <form method="get" action="history/search">
                                                <input name="e" type="hidden" value="10">
                                                <input name="s" type="text" class="form-control form-control-sm">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">#</th>
                                            <th>User ID</th>
                                            <th>Network</th>
                                            <th>Offer ID</th>
                                            <th>IP Address</th>
                                            <th>Coins</th>
                                            <th>Date</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="text-muted">4502<span></td>
                                            <td>G503789173778</td>
                                            <td>ppv</td>
                                            <td>ppv_15</td>
                                            <td>***.***.***</td>
                                            <td><span class="text-green">10</span></td>
                                            <td>2025-04-03 22:44:46</td>
                                            <td class="text-right">
                                                <span class="dropdown ml-1">
                                                    <button class="btn btn-white btn-sm dropdown-toggle align-text-top"
                                                        data-boundary="viewport" data-toggle="dropdown">Actions</button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="members/info?userid=G503789173778">Find this user info</a>
                                                        <a class="dropdown-item text-blue" href="history/del?id=4502">Delete this history only</a>
                                                        <a class="dropdown-item text-red" href="history/del?id=4502&amp;deduct=1">Delete and adjust balance</a>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                                <p class="m-0 text-muted">Showing <span>1</span> to <span>9</span> of <span>9</span>
                                    entries</p>
                                <ul class="pagination m-0 ml-auto">

                                </ul>
                            </div>
                        </div>
                    </div>
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