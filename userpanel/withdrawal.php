<!-- header top url start -->
<?php include("header_top.php");?>
<!-- header top url end -->

<body class="g-sidenav-show  bg-gray-100 ">
    <!-- side nemu bar start -->
    <?php include("side_menu.php");?>
    <!-- side menu bar end -->

    <main class="main-content max-height-vh-100 h-100 position-relative border-radius-lg">
        <!-- Navbar -->
        <?php include("header.php");?>
        <!-- End Navbar -->

        <div class="container-fluid py-4">

            <meta name="csrf-token" content="yXjdRIbKmMP1Ae8EcyLoNGtH8SjLz37UMQYcLmpU">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header pb-0">
                            <div class="d-lg-flex">
                                <div>
                                    <h5 class="mb-0">Withdarwal Category Setup</h5>
                                </div>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="#" class="btn bg-gradient-info addCat btn-sm mb-0">+&nbsp; ADD NEW</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table table-flush" id="data-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>SELECT</th>
                                            <th>THUMBNAIL</th>
                                            <th>TITLE</th>
                                            <th>COIN REQUIRED</th>
                                            <th>Country</th>
                                            <th>STATUS</th>
                                            <th>CREATED AT</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="1">
                                            <td class="text-sm">
                                                <div class="form-check my-auto">
                                                    <input class="form-check-input sub_chk" type="checkbox"
                                                        id="customCheck1" data-id="13" value="13">
                                                </div>
                                            </td>
                                            <td class="text-sm">
                                                <span class="my-2 text-xs">
                                                    <img src="https://rewardpoint.techappinnovation.com/images/unnamed-1_1689098430.png"
                                                        class="avatar avatar-xl shadow">
                                                </span>
                                            </td>
                                            <td class="text-sm ">Paypal</td>
                                            <td class="text-sm"> <span class="badge bg-gradient-info">1000</span></td>
                                            <td class="text-sm">all</td>
                                            <td class="text-sm">
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                            <td class="text-sm">12-Sep-21 10:05:21</td>
                                            <td class="text-sm">

                                                <a href="#" class="mx-3 editCat" id="13" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit">
                                                    <i class="fas fa-edit text-success"></i>
                                                </a>

                                                <a href="#" data-id="redeem" id="13" class="mx-3 delete"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex" style="margin-left: 30px;">
                                    <button class="btn btn-outline-dark sub_chk_all"> Select All </button>
                                    <div class="dropdown d-inline " style="margin-left: 10px;">
                                        <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle "
                                            data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                            Action
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                            aria-labelledby="navbarDropdownMenuLink2"
                                            data-popper-placement="left-start">
                                            <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                                    id="enable" data-id="redeem">Eanble</a></li>
                                            <li><a class="dropdown-item border-radius-md" href="javascript:;"
                                                    id="disable" data-id="redeem">Disable</a></li>
                                        </ul>
                                    </div>
                                    <!-- <button class="btn btn-icon btn-outline-dark ms-2 export" data-type="csv" type="button">
                                        <span class="btn-inner--icon"><i class="ni ni-archive-2"></i></span>
                                        <span class="btn-inner--text">Export CSV</span>
                                    </button> -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

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