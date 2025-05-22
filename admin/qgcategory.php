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
                            action="game/quiz/category/add" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                            <div class="card-header bg-blue-lt text-dark">
                                <span class="card-title">Add a Category</span>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Category name:</label>
                                    <input type="text" class="form-control" name="quiz_category_name"
                                        placeholder="General" value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Card image:</label>
                                    <div class="form-file">
                                        <input type="file" name="quiz_card_image" class="form-file-input img-input"
                                            id="imagefile">
                                        <label class="form-file-label" for="customFile">
                                            <span class="form-file-text img-choose">Choose image...</span>
                                            <span class="form-file-button">Browse</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description:</label>
                                    <textarea class="form-control" name="quiz_category_description" rows="3"
                                        placeholder="Enter a description here..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Time limit per quiz:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="quiz_category_time"
                                            placeholder="30" value="">
                                        <span class="input-group-text">seconds</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add this category</button>
                            </div>
                        </form>
                        <div class="card card-body">
                            <a href="#" class="btn btn-block btn-primary" data-toggle="modal" data-target="#cat-update"
                                data-backdrop="static" data-keyboard="false">Update Quiz Settings</a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-12">
                        <div class="alert alert-info">Click on a category to administer questions.</div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card">
                                    <a href="game/quiz?id=4" class="d-block bg-gray-lt">
                                        <img src="uploads/1626168077.png"
                                            class="fixed-img-height w-100">
                                    </a>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="4" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="4" data-title="Science"
                                            data-desc="Test your knowledge of science facts and applications of scientific principles."
                                            data-time="10" data-toggle="modal" data-target="#cat-edit"
                                            data-backdrop="static" data-keyboard="false">
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2">
                                        <div class="h4 mb-1">Science</div>
                                        <div class="h5">Test your knowledge of science facts and applications of
                                            scientific principles.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card">
                                    <a href="game/quiz?id=3" class="d-block bg-gray-lt">
                                        <img src="uploads/1598714019.jpg"
                                            class="fixed-img-height w-100">
                                    </a>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="3" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="3" data-title="Geography"
                                            data-desc="How much you know about this universe?" data-time="50"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2">
                                        <div class="h4 mb-1">Geography</div>
                                        <div class="h5">How much you know about this universe?</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card">
                                    <a href="game/quiz?id=2" class="d-block bg-gray-lt">
                                        <img src="uploads/1626167280.jpg"
                                            class="fixed-img-height w-100">
                                    </a>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="2" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="2" data-title="General"
                                            data-desc="Multiple Choice Trivia Questions And Answers" data-time="10"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2">
                                        <div class="h4 mb-1">General</div>
                                        <div class="h5">Multiple Choice Trivia Questions And Answers</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card">
                                    <a href="game/quiz?id=1" class="d-block bg-gray-lt">
                                        <img src="uploads/1626167733.jpg"
                                            class="fixed-img-height w-100">
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
                                        <a href="#" class="btn-edit" data-id="1" data-title="Mathmatics"
                                            data-desc="Test your skill with online math quizzes" data-time="30"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2">
                                        <div class="h4 mb-1">Mathmatics</div>
                                        <div class="h5">Test your skill with online math quizzes</div>
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
                <form method="post" action="game/quiz/category/del"
                    class="modal modal-blur fade" id="cat-del" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ"> <input
                        type="hidden" name="id" id="cat-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-title">Are you sure?</div>
                                <div>You are about to remove this category and all of its questions from your database.
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
                <form method="post" action="game/quiz/category/edit"
                    class="modal modal-blur fade" id="cat-edit" tabindex="-1" role="dialog" aria-hidden="true"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ"> <input
                        type="hidden" name="id" id="cat-edit-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Category name:</label>
                                    <input type="text" class="form-control" name="update_category_name" id="cat_name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Card image:</label>
                                    <div class="form-file">
                                        <input type="file" name="update_card_image" class="form-file-input img-input"
                                            id="imagefile">
                                        <label class="form-file-label" for="customFile">
                                            <span class="form-file-text img-choose">Choose image...</span>
                                            <span class="form-file-button">Browse</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description:</label>
                                    <textarea class="form-control" name="update_category_description" rows="3"
                                        id="cat_desc"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Time limit per quiz:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="update_category_time"
                                            id="cat_time">
                                        <span class="input-group-text">sec</span>
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

                <form method="post" action="game/quiz/settings"
                    class="modal modal-blur fade" id="cat-update" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Answer time offset:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="time" value="6">
                                        <span class="input-group-text">seconds</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Disqualify for incorrect answer more than:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="incorrect" value="50">
                                        <span class="input-group-text">times</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Round cost:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cost" value="110">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Skip cost:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="skip" value="150">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">50/50 cost:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="fifty" value="100">
                                        <span class="input-group-text">coins</span>
                                    </div>
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