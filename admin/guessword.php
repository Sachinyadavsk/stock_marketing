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
                            <h2 class="page-title">Word Guessing</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-md-6 col-sm-12">
                        <form action="game/guessword/add" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                            <div class="card">
                                <div class="card-header bg-gray-lt pt-3 pb-2">
                                    <h4 class="text-dark">Add a word</h4>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="mb-3">
                                        <label class="form-label">Word name:</label>
                                        <input type="text" class="form-control" name="word_name" placeholder="Apple"
                                            value="">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-label">Image hint:</div>
                                        <div class="form-file">
                                            <input type="file" name="item_image" class="form-file-input add-file-input"
                                                id="addFile">
                                            <label class="form-file-label" for="addFile">
                                                <span class="form-file-text add-file-choose">Choose an image...</span>
                                                <span class="form-file-button">Browse</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Additional info:</label>
                                        <input type="text" class="form-control" name="word_info"
                                            placeholder="Guess the name of this fruit." value="">
                                    </div>
                                    <div>
                                        <label class="form-label">Allowed countries:</label>
                                        <input type="text" class="form-control" name="country" placeholder="US,UK,CA"
                                            value="">
                                    </div>
                                    <div>
                                        <label class="form-label">Time up:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="time" placeholder="30"
                                                value="">
                                            <span class="input-group-text">seconds</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-dark">Add this item</button>
                                </div>
                            </div>
                        </form>
                        <div class="card card-body">
                            <a href="#" data-toggle="modal" data-target="#gw-set" data-backdrop="static"
                                data-keyboard="false" class="btn btn-block btn-secondary">Game settings</a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Info</th>
                                            <th>Word</th>
                                            <th colspan=2></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img class="avatar avatar-md mr-3 rounded" src="none" /></td>
                                            <td>What is the name of the fictional borough of Melbourne where Australian
                                                soap Neighbours is set?</td>
                                            <td>
                                                <span class="btn btn-sm btn-primary mr-1 mb-1">E</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">R</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">I</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">N</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">S</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">B</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">O</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">R</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">O</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">U</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">G</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">H</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-close" data-id="9" data-toggle="modal"
                                                    data-target="#gw-del" data-backdrop="static" data-keyboard="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <line x1="4" y1="7" x2="20" y2="7" />
                                                        <line x1="10" y1="11" x2="10" y2="17" />
                                                        <line x1="14" y1="11" x2="14" y2="17" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-edit" data-id="9" data-word="ERINSBOROUGH"
                                                    data-infos="What is the name of the fictional borough of Melbourne where Australian soap Neighbours is set?"
                                                    data-country="" data-time="80" data-toggle="modal"
                                                    data-target="#gw-edit" data-backdrop="static" data-keyboard="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19" y2="8" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img class="avatar avatar-md mr-3 rounded" src="none" /></td>
                                            <td>At which venue is the British Grand Prix held?</td>
                                            <td>
                                                <span class="btn btn-sm btn-primary mr-1 mb-1">S</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">I</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">L</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">V</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">E</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">R</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">S</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">T</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">O</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">N</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">E</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-close" data-id="8" data-toggle="modal"
                                                    data-target="#gw-del" data-backdrop="static" data-keyboard="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <line x1="4" y1="7" x2="20" y2="7" />
                                                        <line x1="10" y1="11" x2="10" y2="17" />
                                                        <line x1="14" y1="11" x2="14" y2="17" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-edit" data-id="8" data-word="SILVERSTONE"
                                                    data-infos="At which venue is the British Grand Prix held?"
                                                    data-country="" data-time="60" data-toggle="modal"
                                                    data-target="#gw-edit" data-backdrop="static" data-keyboard="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19" y2="8" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img class="avatar avatar-md mr-3 rounded" src="none" /></td>
                                            <td>In what US State is the city Nashville?</td>
                                            <td>
                                                <span class="btn btn-sm btn-primary mr-1 mb-1">T</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">E</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">N</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">N</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">E</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">S</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">S</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">E</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">E</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-close" data-id="7" data-toggle="modal"
                                                    data-target="#gw-del" data-backdrop="static" data-keyboard="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <line x1="4" y1="7" x2="20" y2="7" />
                                                        <line x1="10" y1="11" x2="10" y2="17" />
                                                        <line x1="14" y1="11" x2="14" y2="17" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-edit" data-id="7" data-word="TENNESSEE"
                                                    data-infos="In what US State is the city Nashville?" data-country=""
                                                    data-time="50" data-toggle="modal" data-target="#gw-edit"
                                                    data-backdrop="static" data-keyboard="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19" y2="8" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img class="avatar avatar-md mr-3 rounded" src="none" /></td>
                                            <td>In what part of the body would you find the fibula?</td>
                                            <td>
                                                <span class="btn btn-sm btn-primary mr-1 mb-1">L</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">E</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">G</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">S</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-close" data-id="6" data-toggle="modal"
                                                    data-target="#gw-del" data-backdrop="static" data-keyboard="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <line x1="4" y1="7" x2="20" y2="7" />
                                                        <line x1="10" y1="11" x2="10" y2="17" />
                                                        <line x1="14" y1="11" x2="14" y2="17" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-edit" data-id="6" data-word="LEGS"
                                                    data-infos="In what part of the body would you find the fibula?"
                                                    data-country="" data-time="50" data-toggle="modal"
                                                    data-target="#gw-edit" data-backdrop="static" data-keyboard="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19" y2="8" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img class="avatar avatar-md mr-3 rounded"
                                                    src="uploads/1601880722.png" /></td>
                                            <td>Name of the app?</td>
                                            <td>
                                                <span class="btn btn-sm btn-primary mr-1 mb-1">M</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">I</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">N</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">T</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">L</span><span
                                                    class="btn btn-sm btn-primary mr-1 mb-1">Y</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-close" data-id="5" data-toggle="modal"
                                                    data-target="#gw-del" data-backdrop="static" data-keyboard="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <line x1="4" y1="7" x2="20" y2="7" />
                                                        <line x1="10" y1="11" x2="10" y2="17" />
                                                        <line x1="14" y1="11" x2="14" y2="17" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-edit" data-id="5" data-word="MINTLY"
                                                    data-infos="Name of the app?" data-country="" data-time="50"
                                                    data-toggle="modal" data-target="#gw-edit" data-backdrop="static"
                                                    data-keyboard="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19" y2="8" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                                <p class="m-0 text-muted">Showing <span>1</span> to <span>5</span> of <span>5</span>
                                    entries</p>
                                <ul class="pagination m-0 ml-auto">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="post" action="game/guessword/sett"
                    class="modal modal-blur fade" id="gw-set" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Reward amount:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="reward_amount" value="35">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Retry chance per day:</label>
                                    <input type="text" class="form-control" name="retry_chance" value="15">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Extra retry cost:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="retry_cost" value="50">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Free letter help per day:</label>
                                    <input type="text" class="form-control" name="hint_chance" value="5">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Extra letter help cost:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hint_cost" value="15">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Solving cost:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="solve_cost" value="12">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">Time offset:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="offset" value="4">
                                        <span class="input-group-text">seconds</span>
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
                <form method="post" action="game/guessword/del"
                    class="modal modal-blur fade" id="gw-del" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ"> <input
                        type="hidden" name="id" id="gw-id">
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
                <form method="post" action="game/guessword/edit"
                    class="modal modal-blur fade" id="gw-edit" tabindex="-1" role="dialog" aria-hidden="true"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ"> <input
                        type="hidden" name="id" id="mod-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Word name:</label>
                                    <input type="text" class="form-control" name="word_name" id="mod-word">
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Image hint:</div>
                                    <div class="form-file">
                                        <input type="file" name="item_image" class="form-file-input add-file-input"
                                            id="addFile">
                                        <label class="form-file-label" for="addFile">
                                            <span class="form-file-text add-file-choose">Choose an image...</span>
                                            <span class="form-file-button">Browse</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Additional info:</label>
                                    <input type="text" class="form-control" name="word_info" id="mod-info">
                                </div>
                                <div>
                                    <label class="form-label">Allowed countries:</label>
                                    <input type="text" class="form-control" name="country" id="mod-country">
                                </div>
                                <div>
                                    <label class="form-label">Time up:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="time" id="mod-time">
                                        <span class="input-group-text">seconds</span>
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
            </div>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->