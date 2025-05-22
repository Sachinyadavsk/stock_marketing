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
                <div class="px-3 py-1 mb-3 d-flex bg-blue-lt rounded text-dark align-items-center">
                    <span class="h3 mt-1">Quiz Tournament</span>
                    <div class="ml-auto">
                        <a href="#" class="btn-edit btn btn-sm btn-primary">Previous Winners</a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <a href="#" class="btn btn-block btn-primary" data-id="-1" data-qs=""
                                    data-op="" data-ans="" data-time="" data-sc="" data-toggle="modal"
                                    data-target="#qs-edit" data-backdrop="static" data-keyboard="false">Add a
                                    question</a>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <a href="#" class="btn btn-danger btn-block" data-id="-1" data-toggle="modal"
                                    data-target="#qs-del" data-backdrop="static" data-keyboard="false">Delete all
                                    questions</a>
                            </div>
                        </div>
                        <form class="card px-0" method="post" action="game/tournament/sett">
                            <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                            <div class="card-header bg-blue-lt text-dark px-3 py-2 font-weight-bold">Tournament Settings
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Tournament name:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Quiz Tournament"
                                        value="Quiz Tournaments">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tournament will begin on:</label>
                                    <input type="text" class="form-control" name="begin_time" id="begin-date"
                                        placeholder="h:m dd/mm/yyyy" value="hh:mm dd/mm/yyyy">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Result will be published after:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="publish_time" placeholder="30"
                                            value="30">
                                        <span class="input-group-text">minutes</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Result will show until:</label>
                                    <input type="text" class="form-control" name="result_time" id="result-until"
                                        placeholder="h:m dd/mm/yyyy" value="14:20 28/06/2021">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Entry fee:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="fee" placeholder="30"
                                                value="100">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Total reward:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="reward" placeholder="5000"
                                                value="5000">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Schedule tournament</button>
                            </div>
                        </form>
                        <form class="card card-body" method="get"
                            action="game/tournament/winner/form">
                            <div class="d-flex">
                                <div class="w-100">
                                    <label class="form-label">Set total winners:</label>
                                    <input type="text" class="form-control" name="total_winners" value="10">
                                </div>
                                <div>
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn ml-3 px-4 btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="col-lg-8 col-md-7 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card card-body mb-2">
                                    <div class="font-weight-bold">
                                        MOSST is difficult to use
                                    </div>
                                    <a href="#" class="item-btn1 btn-edit" data-id="1"
                                        data-qs="MOSST is difficult to use" data-op="True&#10;False&#10;Don't know"
                                        data-ans="2" data-time="50" data-sc="10" data-toggle="modal"
                                        data-target="#qs-edit" data-backdrop="static" data-keyboard="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>
                                    </a>
                                    <a href="#" class="item-btn2 btn-del" data-id="1" data-toggle="modal"
                                        data-target="#qs-del" data-backdrop="static" data-keyboard="false">
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
                                    <div class="hr-text hr-text-right my-3 font-weight-bold text-blue">50 seconds
                                        &bull;&bull;&bull;&bull; 10 coins</div>
                                    <ul class="list-inline">
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> True</li>
                                        <li class="text-green"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-md" width="24" height="24" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <path d="M7 12l5 5l10 -10"></path>
                                                <path d="M2 12l5 5m5 -5l5 -5"></path>
                                            </svg> False</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> Don't know</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card card-body mb-2">
                                    <div class="font-weight-bold">
                                        What color is an orange?
                                    </div>
                                    <a href="#" class="item-btn1 btn-edit" data-id="2"
                                        data-qs="What color is an orange?"
                                        data-op="Purple&#10;Orange&#10;An orange has no color. It's transparent.&#10;Don't know"
                                        data-ans="2" data-time="30" data-sc="12" data-toggle="modal"
                                        data-target="#qs-edit" data-backdrop="static" data-keyboard="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>
                                    </a>
                                    <a href="#" class="item-btn2 btn-del" data-id="2" data-toggle="modal"
                                        data-target="#qs-del" data-backdrop="static" data-keyboard="false">
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
                                    <div class="hr-text hr-text-right my-3 font-weight-bold text-blue">30 seconds
                                        &bull;&bull;&bull;&bull; 12 coins</div>
                                    <ul class="list-inline">
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> Purple</li>
                                        <li class="text-green"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-md" width="24" height="24" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <path d="M7 12l5 5l10 -10"></path>
                                                <path d="M2 12l5 5m5 -5l5 -5"></path>
                                            </svg> Orange</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> An orange has no color. It's transparent.</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> Don't know</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card card-body mb-2">
                                    <div class="font-weight-bold">
                                        Please, let me ______!
                                    </div>
                                    <a href="#" class="item-btn1 btn-edit" data-id="3" data-qs="Please, let me ______!"
                                        data-op="make&#10;think&#10;want&#10;put&#10;have" data-ans="2" data-time="40"
                                        data-sc="10" data-toggle="modal" data-target="#qs-edit" data-backdrop="static"
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
                                    <a href="#" class="item-btn2 btn-del" data-id="3" data-toggle="modal"
                                        data-target="#qs-del" data-backdrop="static" data-keyboard="false">
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
                                    <div class="hr-text hr-text-right my-3 font-weight-bold text-blue">40 seconds
                                        &bull;&bull;&bull;&bull; 10 coins</div>
                                    <ul class="list-inline">
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> make</li>
                                        <li class="text-green"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-md" width="24" height="24" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <path d="M7 12l5 5l10 -10"></path>
                                                <path d="M2 12l5 5m5 -5l5 -5"></path>
                                            </svg> think</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> want</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> put</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> have</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card card-body mb-2">
                                    <div class="font-weight-bold">
                                        Is that boy Mary&#039;s son?
                                    </div>
                                    <a href="#" class="item-btn1 btn-edit" data-id="4"
                                        data-qs="Is that boy Mary&#039;s son?"
                                        data-op="Yes, name is Robert.&#10;Yes, he is.&#10;No, he is Marys nephew.&#10;Yes, those are Mary's son.&#10;Yes, he are."
                                        data-ans="2" data-time="50" data-sc="10" data-toggle="modal"
                                        data-target="#qs-edit" data-backdrop="static" data-keyboard="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>
                                    </a>
                                    <a href="#" class="item-btn2 btn-del" data-id="4" data-toggle="modal"
                                        data-target="#qs-del" data-backdrop="static" data-keyboard="false">
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
                                    <div class="hr-text hr-text-right my-3 font-weight-bold text-blue">50 seconds
                                        &bull;&bull;&bull;&bull; 10 coins</div>
                                    <ul class="list-inline">
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> Yes, name is Robert.</li>
                                        <li class="text-green"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-md" width="24" height="24" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <path d="M7 12l5 5l10 -10"></path>
                                                <path d="M2 12l5 5m5 -5l5 -5"></path>
                                            </svg> Yes, he is.</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> No, he is Marys nephew.</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> Yes, those are Mary's son.</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> Yes, he are.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card card-body mb-2">
                                    <div class="font-weight-bold">
                                        Where is the post office?
                                    </div>
                                    <a href="#" class="item-btn1 btn-edit" data-id="5"
                                        data-qs="Where is the post office?"
                                        data-op="It is in the corner of Main Street and Washington Avenue.&#10;Is near the bank.&#10;It's between Main Street.&#10;The post office is at 534 Washington Avenue.&#10;They are between the bank and the supermarket."
                                        data-ans="4" data-time="120" data-sc="20" data-toggle="modal"
                                        data-target="#qs-edit" data-backdrop="static" data-keyboard="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>
                                    </a>
                                    <a href="#" class="item-btn2 btn-del" data-id="5" data-toggle="modal"
                                        data-target="#qs-del" data-backdrop="static" data-keyboard="false">
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
                                    <div class="hr-text hr-text-right my-3 font-weight-bold text-blue">120 seconds
                                        &bull;&bull;&bull;&bull; 20 coins</div>
                                    <ul class="list-inline">
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> It is in the corner of Main Street and Washington Avenue.</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> Is near the bank.</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> It's between Main Street.</li>
                                        <li class="text-green"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-md" width="24" height="24" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <path d="M7 12l5 5l10 -10"></path>
                                                <path d="M2 12l5 5m5 -5l5 -5"></path>
                                            </svg> The post office is at 534 Washington Avenue.</li>
                                        <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="7 7 12 12 7 17"></polyline>
                                                <polyline points="13 7 18 12 13 17"></polyline>
                                            </svg> They are between the bank and the supermarket.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center mt-3">
                            <ul class="pagination">

                            </ul>
                        </div>
                    </div>

                </div>
                <form method="post" action="game/tournament/qs/del"
                    class="modal modal-blur fade" id="qs-del" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ"> <input
                        type="hidden" name="id" id="qs-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-title">Are you sure?</div>
                                <div>You are about to remove this questions from your database.</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, delete it</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" action="game/tournament/qs/add"
                    class="modal modal-blur fade" id="qs-edit" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ"> <input
                        type="hidden" name="id" id="qs_id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-header bg-primary text-white">Add / update a question</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Question:</label>
                                    <input type="text" class="form-control"
                                        placeholder="What is the capital of United States?" name="question" id="qs_qs">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Options:</label>
                                    <textarea class="form-control" name="options" rows="4"
                                        placeholder="California&#10;New York&#10;Washington, D.C.&#10;Arizona"
                                        id="qs_op"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Which line is correct answer?</label>
                                    <input type="text" class="form-control" placeholder="3" name="answer" id="qs_ans">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Answer time limit:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="30" name="time"
                                                id="qs_time">
                                            <span class="input-group-text">seconds</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Score:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="10" name="score"
                                                id="qs_sc">
                                            <span class="input-group-text">coins</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mr-auto"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
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