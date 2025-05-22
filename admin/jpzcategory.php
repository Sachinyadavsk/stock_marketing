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
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <form class="card px-0" method="post"
                            action="game/jpz/category/add">
                            <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                            <div class="card-header bg-blue-lt px-3 py-1">
                                <span class="card-title">Add a Category <h5>Jigsaw Puzzle</h5></span>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Category name:</label>
                                    <input type="text" class="form-control" name="jpz_category_name"
                                        placeholder="Basic Puzzle" value="">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Columns:</label>
                                            <input type="text" class="form-control" name="jpz_category_col"
                                                placeholder="4" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Rows:</label>
                                            <input type="text" class="form-control" name="jpz_category_row"
                                                placeholder="3" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Time limit per puzzle:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="jpz_category_time"
                                            placeholder="30" value="">
                                        <span class="input-group-text">secconds</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Cost:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="jpz_category_cost"
                                                placeholder="100" value="">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Reward:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="jpz_category_reward"
                                                placeholder="500" value="">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add this category</button>
                            </div>
                        </form>
                        <div class="card card-body">
                            <a href="#" class="btn btn-block btn-primary" data-toggle="modal" data-target="#cat-update"
                                data-backdrop="static" data-keyboard="false">Update Settings</a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-12">
                        <div class="alert alert-info">Click on a category to administer questions.</div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card fixed-img-height d-flex justify-content-center">
                                    <a href="game/jpz?id=1" class="d-block text-center">
                                        <span class="h1">5 X 7</span><br>
                                        <span class="h4">Basic Jigsaw</span>
                                    </a>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="1" data-toggle="modal"
                                            data-target="#cat-del" data-backdrop="static" data-keyboard="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <line x1="4" y1="7" x2="20" y2="7" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </a>
                                        <a href="#" class="btn-edit" data-id="1" data-title="Basic Jigsaw"
                                            data-cost="100" data-reward="250" data-time="600" data-row="7" data-col="5"
                                            data-toggle="modal" data-target="#cat-edit" data-backdrop="static"
                                            data-keyboard="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                <line x1="16" y1="5" x2="19" y2="8" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center mt-3">
                            <ul class="pagination">

                            </ul>
                        </div>
                    </div>
                </div>
                <form method="post" action="game/jpz/category/del"
                    class="modal modal-blur fade" id="cat-del" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ"> <input
                        type="hidden" name="id" id="cat-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-title">Are you sure?</div>
                                <div>You are about to remove this category and all of its puzzles from your database.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, delete it</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" action="game/jpz/category/edit"
                    class="modal modal-blur fade" id="cat-edit" tabindex="-1" role="dialog" aria-hidden="true"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ"> <input
                        type="hidden" name="id" id="cat-edit-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Category name:</label>
                                    <input type="text" class="form-control" name="update_category_name" id="cat-name">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Columns:</label>
                                            <input type="text" class="form-control" name="update_category_col"
                                                id="cat-col">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Rows:</label>
                                            <input type="text" class="form-control" name="update_category_row"
                                                id="cat-row">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Time limit per puzzle:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="update_category_time"
                                            id="cat-time">
                                        <span class="input-group-text">secconds</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Cost:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="update_category_cost"
                                                id="cat-cost">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Reward:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="update_category_reward"
                                                id="cat-reward">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update category</button>
                            </div>
                        </div>
                    </div>
                </form>

                <form method="post" action="game/jpz/settings" class="modal modal-blur fade"
                    id="cat-update" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Solving time offset:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="time" value="5">
                                        <span class="input-group-text">seconds</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Maximum round per day:</label>
                                    <input type="text" class="form-control" name="round" value="40">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Help cost:</label>
                                    <input type="text" class="form-control" name="piece" value="40">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update settings</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->