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
                            <h2 class="page-title">HTML5 Games</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <form class="card" method="post" action="game/html/add"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                            <div class="card-header bg-blue-lt font-weight-bold">Create new game</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Game Name:</label>
                                    <input type="text" class="form-control" name="name" placeholder="My Awesome Game"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Game URL:</label>
                                    <input type="text" class="form-control" name="game_url" placeholder="https://"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Game banner:</label>
                                    <div class="form-file">
                                        <input type="file" name="game_image" class="form-file-input img-input"
                                            id="imagefile">
                                        <label class="form-file-label" for="customFile">
                                            <span class="form-file-text img-choose">Choose image...</span>
                                            <span class="form-file-button">Browse</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label class="form-label">Orientation:</label>
                                        <select name="orientation" class="form-select">
                                            <option value="0" selected>Portrait</option>
                                            <option value="1">Landscape</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label class="form-label">.</label>
                                        <label class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" name="is_blocked">
                                            <span class="form-check-label">Block hosts</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deduct amount to unlock this game:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="deduct_amount" placeholder="0"
                                            value="">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                </div>
                                <div class="border border-secondary rounded p-3">
                                    <select name="reward_type" class="form-select mb-2">
                                        <option value="1" class="text-red">-- No reward or deduction --</option>
                                        <option value="2" class="text-green">Reward the user</option>
                                        <option value="3" class="text-red">Deduct from user balance</option>
                                    </select>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">by</span>
                                        <input type="text" class="form-control" name="reward_amount" placeholder="2"
                                            value="">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">for playing</span>
                                        <input type="text" class="form-control" name="reward_time" placeholder="60"
                                            value="">
                                        <span class="input-group-text">seconds</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add this game</button>
                            </div>
                        </form>
                        <form class="card" method="post" action="game/html/cache">
                            <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Daily reward limit:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="limit" value="50">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Blocked hosts:</label>
                                    <textarea class="form-control" name="blocked"
                                        rows="2">imasdk.googleapis.com</textarea>
                                </div>
                                <button type="submit" class="btn btn-dark">Update settings</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=ElementBlocks.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="8" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="8" data-name="Element Blocks" data-ori="1"
                                            data-blocked="1" data-unlock="5" data-reward="-1" data-times="60"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Element Blocks</span>
                                            <div class="small mb-1">Orientation: landscape </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=wheelie_8.png"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="12" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="12" data-name="Wheelie 8" data-ori="1"
                                            data-blocked="1" data-unlock="0" data-reward="0" data-times="0"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Wheelie 8</span>
                                            <div class="small mb-1">Orientation: landscape </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=math_search.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="13" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="13" data-name="Math Search" data-ori="1"
                                            data-blocked="1" data-unlock="0" data-reward="0" data-times="0"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Math Search</span>
                                            <div class="small mb-1">Orientation: landscape </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=micro_jewel.jpeg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="14" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="14" data-name="Micro Jewel" data-ori="1"
                                            data-blocked="1" data-unlock="0" data-reward="-1" data-times="40"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Micro Jewel</span>
                                            <div class="small mb-1">Orientation: landscape </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=BubbleWoodsTeaser.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="18" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="18" data-name="Bubble Woods" data-ori="0"
                                            data-blocked="1" data-unlock="10" data-reward="-2" data-times="30"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Bubble Woods</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=ZooBoomTeaser.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="19" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="19" data-name="ZooBoom" data-ori="0"
                                            data-blocked="1" data-unlock="0" data-reward="0" data-times="0"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>ZooBoom</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=FuzziesTeaser.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="20" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="20" data-name="Fuzzies" data-ori="0"
                                            data-blocked="1" data-unlock="0" data-reward="0" data-times="0"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Fuzzies</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=OnetConnect.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="22" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="22" data-name="Onet Connect" data-ori="0"
                                            data-blocked="1" data-unlock="0" data-reward="0" data-times="0"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Onet Connect</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=OmNomRunTeaser.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="23" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="23" data-name="Om Nom Run" data-ori="0"
                                            data-blocked="1" data-unlock="0" data-reward="0" data-times="0"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Om Nom Run</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=DiamondRush.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="24" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="24" data-name="Diamond Rush" data-ori="0"
                                            data-blocked="1" data-unlock="0" data-reward="0" data-times="0"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Diamond Rush</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=GardenBloomTeaser.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="25" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="25" data-name="Garden Bloom" data-ori="0"
                                            data-blocked="1" data-unlock="0" data-reward="0" data-times="0"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Garden Bloom</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=WordDetectorTeaserB.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="26" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="26" data-name="Word Detector" data-ori="0"
                                            data-blocked="1" data-unlock="0" data-reward="2" data-times="60"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Word Detector</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=MazeTeaser.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="27" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="27" data-name="Maze" data-ori="0"
                                            data-blocked="1" data-unlock="0" data-reward="0" data-times="0"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Maze</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=UncleAhmedTeaser.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="28" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="28" data-name="Uncle Mario" data-ori="0"
                                            data-blocked="1" data-unlock="0" data-reward="0" data-times="0"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Uncle Mario</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="d-block bg-gray-lt">
                                        <img src="api/game/html/image?img=TotemiaCursedMarblesTeaser.jpg"
                                            class="fixed-img-height w-100">
                                    </div>
                                    <div class="btns">
                                        <a href="#" class="btn-close" data-id="29" data-toggle="modal"
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
                                        <a href="#" class="btn-edit" data-id="29" data-name="Cursed Marble" data-ori="0"
                                            data-blocked="1" data-unlock="0" data-reward="-3" data-times="60"
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
                                    <div class="fixed-img-bottom w-100 pl-2 pr-2 d-flex">
                                        <div>
                                            <span>Cursed Marble</span>
                                            <div class="small mb-1">Orientation: portrait </div>
                                        </div>
                                        <img src="/img/noads.png" class="fixed-img-size ml-auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post" action="game/html/del" class="modal modal-blur fade"
                    id="cat-del" tabindex="-1" role="dialog" aria-hidden="true">
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
                <form method="post" action="game/html/edit" enctype="multipart/form-data"
                    class="modal modal-blur fade" id="cat-edit" tabindex="-1" role="dialog" aria-hidden="true">
                    <input type="hidden" name="_token" value="Ds7YuCkggn7pp1UwNo19wmhaXrtnLruHu33tzMWZ"> <input
                        type="hidden" name="id" id="edit-id">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Game Name:</label>
                                    <input type="text" class="form-control" name="name" id="edit-name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Game URL:</label>
                                    <input type="text" class="form-control" value="You cannot change this" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Game banner:</label>
                                    <div class="form-file">
                                        <input type="file" name="game_image" class="form-file-input img-input"
                                            id="imagefile">
                                        <label class="form-file-label" for="customFile">
                                            <span class="form-file-text img-choose">Choose image...</span>
                                            <span class="form-file-button">Browse</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label class="form-label">Orientation:</label>
                                        <select name="orientation" class="form-select" id="edit-orientation">
                                            <option value="0">Portrait</option>
                                            <option value="1">Landscape</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label class="form-label">.</label>
                                        <label class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" name="is_blocked"
                                                id="edit-block">
                                            <span class="form-check-label">Block hosts</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deduct amount to unlock this game:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="deduct_amount" id="edit-deduct">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                </div>
                                <div class="border border-secondary rounded p-3">
                                    <select name="reward_type" class="form-select mb-2" id="edit-type">
                                        <option value="1" class="text-red">-- No reward or deduction --</option>
                                        <option value="2" class="text-green">Reward the user</option>
                                        <option value="3" class="text-red">Deduct from user balance</option>
                                    </select>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">by</span>
                                        <input type="text" class="form-control" name="reward_amount" id="edit-reward">
                                        <span class="input-group-text">coins</span>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">for playing</span>
                                        <input type="text" class="form-control" name="reward_time" id="edit-time">
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