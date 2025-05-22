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
                    <div class="col-lg-5 col-md-6">
                        <form class="card" role="form" method="post" action="game/lotto/update">
                            <div class="card-header font-weight-bold bg-dark-lt">Lotto Game settings</div>
                            <div class="card-body">
                                <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label class="form-label">Round cost:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cost" value="10">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label class="form-label">Daily chances:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="daily" value="10">
                                            <span class="input-group-text">times</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-text my-4 text-primary font-weight-bold">Reward for</div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text">1 set:</span>
                                    <input type="text" class="form-control" name="m_1" value="6">
                                    <span class="input-group-text">coins</span>
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text">2 sets:</span>
                                    <input type="text" class="form-control" name="m_2" value="11">
                                    <span class="input-group-text">coins</span>
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text">3 sets:</span>
                                    <input type="text" class="form-control" name="m_3" value="41">
                                    <span class="input-group-text">coins</span>
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text">4 sets:</span>
                                    <input type="text" class="form-control" name="m_4" value="101">
                                    <span class="input-group-text">coins</span>
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text">5 sets:</span>
                                    <input type="text" class="form-control" name="m_5" value="1001">
                                    <span class="input-group-text">coins</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update settings</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <form class="card" method="post" action="game/lotto/addwinner">
                            <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                            <div class="card-header font-weight-bold">Add a <span class="text-info mx-2">5 sets</span>
                                winner</div>
                            <div class="card-body row">
                                <div class="col-9">
                                    <input type="text" class="form-control" name="s"
                                        placeholder='Enter "Email Address" or "User ID"' value="">
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary">Add this</button>
                                </div>
                            </div>
                        </form>
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