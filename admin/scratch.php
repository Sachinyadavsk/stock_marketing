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
                <span class="page-title text-nowrap">Scratch Cards</span>
                <div class="card mt-3">
                    <div class="card-body">
                        <form class="row" method="post" action="game/scratch/limit">
                            <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                            <div class="col-auto">
                                <label class="form-label font-weight-bold">Daily card purchase limit:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="purchase_limit" placeholder="10"
                                        value="5">
                                    <span class="input-group-text">Cards</span>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label">.</label>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <div class="col-auto mt-3">
                                <a href="game/scratcher"
                                    class="btn btn-success mr-2 my-1">Add a card</a>
                                <a href="game/scratcher/clean"
                                    class="btn btn-danger my-1">Clean up expired cards</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card card-sm">
                            <a href="game/scratcher?id=9" class="d-block text-center"><img
                                    src="uploads/1699448445.jpg"
                                    class="card-img-top fixed-height"></a>
                            <div class="card-body">
                                <div class="font-weight-bold mb-1">Classic Scratch</div>
                                <div class="small">Coins range: <span class="font-italic">20 - 100</span></div>
                                <div class="small font-italic">Card expires after 30 days</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card card-sm">
                            <a href="game/scratcher?id=7" class="d-block text-center"><img
                                    src="uploads/1699449085.jpg"
                                    class="card-img-top fixed-height"></a>
                            <div class="card-body">
                                <div class="font-weight-bold mb-1">Scratch Card</div>
                                <div class="small">Coins range: <span class="font-italic">50 - 150</span></div>
                                <div class="small font-italic">Card expires after 30 days</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card card-sm">
                            <a href="game/scratcher?id=1" class="d-block text-center"><img
                                    src="uploads/1699449695.jpg"
                                    class="card-img-top fixed-height"></a>
                            <div class="card-body">
                                <div class="font-weight-bold mb-1">Fast Scratch</div>
                                <div class="small">Coins range: <span class="font-italic">1 - 100</span></div>
                                <div class="small font-italic">Card expires after 10 days</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-center mt-3">
                    <ul class="pagination">

                    </ul>
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