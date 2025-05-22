<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->

<?php 
if (isset($_GET['id']) && $_GET['id'] != '') {
    
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM lang WHERE language_code='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $language_name  = $row['language_name'];
        $language_code  = $row['language_code'];
        $lang_file  = $row['lang_file'];
    } else {
        header('location:lang.php');
        die();
    }
}
?>

<body class="antialiased">
    <div class="page">
        <!-- header menu start -->
        <?php include('header.php');?>
        <!-- header menu start -->
        <!-- layout start -->
        <div class="content">
            <div class="container-xl">
                <div class="row">
                    <form class="card" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="en" />
                        <div class="card-header mb-2">
                            <span class="card-title"><span class="font-weight-normal">Edit language ></span>English</span>
                        </div>
                        <div class="card-body row">
                            <div class="mb-3 col-md-5 col-sm-12">
                                <label class="form-label">Language name:</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $language_name ;?>">
                            </div>
                            <div class="mb-3 col-md-3 col-sm-12">
                                <label class="form-label">Language code:</label>
                                <input type="text" class="form-control" name="code" value="<?php echo $language_code ;?>">
                            </div>
                            <div class="mb-3 col-md-4 col-sm-12">
                                <label class="form-label">Country flag:</label>
                                <div class="form-file">
                                    <input type="file" name="image" class="form-file-input modal-img-input" id="customFile">
                                    <label class="form-file-label" for="customFile">
                                        <span class="form-file-text modal-img-choose">Choose an image...</span>
                                        <span class="form-file-button">Browse</span>
                                    </label>
                                </div>
                            </div>
                            <div class="hr-text my-4 text-primary">Language strings</div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">app_name</span>
                                    <input type="text" class="form-control" name="v[]" value="Mintly">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">open</span>
                                    <input type="text" class="form-control" name="v[]" value="Open">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">close</span>
                                    <input type="text" class="form-control" name="v[]" value="Close">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">three_dash</span>
                                    <input type="text" class="form-control" name="v[]" value="---">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">quiz_cat</span>
                                    <input type="text" class="form-control" name="v[]" value="Quiz Categories">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">tos_link_1</span>
                                    <input type="text" class="form-control" name="v[]" value="By using Mintly app, you are agree to our">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">tos_link_2</span>
                                    <input type="text" class="form-control" name="v[]" value="Terms of Service">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">activity_reward</span>
                                    <input type="text" class="form-control" name="v[]" value="Activity reward">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">no_message</span>
                                    <input type="text" class="form-control" name="v[]" value="No message to show.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">games_1</span>
                                    <input type="text" class="form-control" name="v[]" bvalue="Play for ranking and highest reward">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">games_2</span>
                                    <input type="text" class="form-control" name="v[]" value="Play for reward only">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">games_3</span>
                                    <input type="text" class="form-control" name="v[]" value="More play, better reward">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">open_url_with</span>
                                    <input type="text" class="form-control" name="v[]" value="Open URL with:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">webview_name</span>
                                    <input type="text" class="form-control" name="v[]" value="Internal Browser">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">class_not_found</span>
                                    <input type="text" class="form-control" name="v[]" value="Class not found!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ad_not_available</span>
                                    <input type="text" class="form-control" name="v[]" value="Ad not available">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">yt_player_not_ready</span>
                                    <input type="text" class="form-control" name="v[]" value="Please wait till it finishes loading.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">yt_playing_wait</span>
                                    <input type="text" class="form-control" name="v[]" value="Please wait until current video is ended.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">premium_offers</span>
                                    <input type="text" class="form-control" name="v[]" value="Premium offers">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">question</span>
                                    <input type="text" class="form-control" name="v[]" value="Question">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">want_continue</span>
                                    <input type="text" class="form-control" name="v[]" value="Do you want to continue?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">quiz_yes</span>
                                    <input type="text" class="form-control" name="v[]" value="Yes, deduct the amount">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">quiz_no</span>
                                    <input type="text" class="form-control" name="v[]" value="No, leave me out">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">exceed_daily_limit</span>
                                    <input type="text" class="form-control" name="v[]" value="Daily limit exceeded!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">per_set</span>
                                    <input type="text" class="form-control" name="v[]" value="Per set:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">round_cost</span>
                                    <input type="text" class="form-control" name="v[]" value="Round cost:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">today_left</span>
                                    <input type="text" class="form-control" name="v[]" value="Today left:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">free_play</span>
                                    <input type="text" class="form-control" name="v[]" value="Play for free!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_category_selected</span>
                                    <input type="text" class="form-control" name="v[]"
                                        value="Invalid category selected!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">use_grace</span>
                                    <input type="text" class="form-control" name="v[]" value="Use Grace">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">new_round</span>
                                    <input type="text" class="form-control" name="v[]" value="New Round">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">fifty_fifty</span>
                                    <input type="text" class="form-control" name="v[]" value="50/50">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">skip</span>
                                    <input type="text" class="form-control" name="v[]" value="Skip">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">correct</span>
                                    <input type="text" class="form-control" name="v[]" value="Correct">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">well_done</span>
                                    <input type="text" class="form-control" name="v[]" value="Well done!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">quiz_correct_popup</span>
                                    <input type="text" class="form-control" name="v[]" value="The answer was correct. You have increased your score. Keep trying to rank up…">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">next_question</span>
                                    <input type="text" class="form-control" name="v[]" value="Next question">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">no_grace</span>
                                    <input type="text" class="form-control" name="v[]" value="No grace!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">no_grace_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="Your grace is empty! Want to purchase a new round for">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">purchase_round</span>
                                    <input type="text" class="form-control" name="v[]" value="Purchase round">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">not_in_question</span>
                                    <input type="text" class="form-control" name="v[]" value="You are not in a question.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">quit</span>
                                    <input type="text" class="form-control" name="v[]" value="Quit">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">your_current_score</span>
                                    <input type="text" class="form-control" name="v[]" value="Your current score:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">rank_prefix</span>
                                    <input type="text" class="form-control" name="v[]" value="You are in position">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">rank_suffix</span>
                                    <input type="text" class="form-control" name="v[]" value="in current leaderboard ranking.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">scratch_cards</span>
                                    <input type="text" class="form-control" name="v[]" value="Scratch Cards">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">word_guessing</span>
                                    <input type="text" class="form-control" name="v[]" value="Word Guessing">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">not_in_game</span>
                                    <input type="text" class="form-control" name="v[]" value="You are not in a game!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">wrong_gw</span>
                                    <input type="text" class="form-control" name="v[]" value="Wrong! retry chance deducted.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">hint_no_chance</span>
                                    <input type="text" class="form-control" name="v[]" value="You do not have any hint chance. Consider purchasing hint chances or try again tomorrow!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">score</span>
                                    <input type="text" class="form-control" name="v[]" value="Score">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">spend</span>
                                    <input type="text" class="form-control" name="v[]" value="Spend">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">to_solve_it</span>
                                    <input type="text" class="form-control" name="v[]" value="to solve it">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">gw_hints</span>
                                    <input type="text" class="form-control" name="v[]" value="Avl Hints">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">gw_retry</span>
                                    <input type="text" class="form-control" name="v[]" value="Avl Retry">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">yes</span>
                                    <input type="text" class="form-control" name="v[]" value="Yes">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">timeup</span>
                                    <input type="text" class="form-control" name="v[]" value="Time up!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">timeup_desc</span>
                                    <input type="text" class="form-control" name="v[]"
                                        value="Time is up, you failed to solve this puzzle within given time. Want to try another puzzle?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">back</span>
                                    <input type="text" class="form-control" name="v[]" value="Back">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">imagepuzzle</span>
                                    <input type="text" class="form-control" name="v[]" value="Image Puzzle">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ip_finished</span>
                                    <input type="text" class="form-control" name="v[]" value="Click here when you solve this">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ip_not_solved</span>
                                    <input type="text" class="form-control" name="v[]" value="Yet to solve this puzzle. Keep trying…">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">try_another_round</span>
                                    <input type="text" class="form-control" name="v[]" value="Try another round">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ip_cat</span>
                                    <input type="text" class="form-control" name="v[]" value="Image Puzzle Categories">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ip_score</span>
                                    <input type="text" class="form-control" name="v[]" value="Your current score:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ip_next</span>
                                    <input type="text" class="form-control" name="v[]" value="Next Puzzle">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ip_congrats</span>
                                    <input type="text" class="form-control" name="v[]" value="You successfully solved this image puzzle. You increased your ranking score. Keep trying to rank up…">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">are_you_sure</span>
                                    <input type="text" class="form-control" name="v[]" value="Are you sure?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">close_diag_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="You did not finish this yet. If you quit now still the fee will be deducted from your balance.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">close_diag_desc2</span>
                                    <input type="text" class="form-control" name="v[]" value="Do you want to opt out from this game? You may not be able to resume the game later as a result you should start from begin.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">close_diag_desc_v</span>
                                    <input type="text" class="form-control" name="v[]" value="Video is still playing. If you quit now you will not get rewarded. Do you still want to quit?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">jpz</span>
                                    <input type="text" class="form-control" name="v[]" value="Jigsaw Puzzle">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">jpz_cat</span>
                                    <input type="text" class="form-control" name="v[]" value="Jigsaw Puzzle Categories">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">jpz_btn_pre</span>
                                    <input type="text" class="form-control" name="v[]" value="Help to set a piece for">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">try_another_round_for</span>
                                    <input type="text" class="form-control" name="v[]" value="Try another round for">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">low_bal_title</span>
                                    <input type="text" class="form-control" name="v[]" value="Not enough">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">low_bal_desc_prefix</span>
                                    <input type="text" class="form-control" name="v[]" value="You are running out of">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">low_bal_desc_suffix</span>
                                    <input type="text" class="form-control" name="v[]" value="Want to complete some tasks to get">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">earn</span>
                                    <input type="text" class="form-control" name="v[]" value="Earn">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">exit_window</span>
                                    <input type="text" class="form-control" name="v[]" value="Exit the process">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">retry</span>
                                    <input type="text" class="form-control" name="v[]" value="Retry">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">connection_error</span>
                                    <input type="text" class="form-control" name="v[]" value="Connection error!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">connection_error_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="Could not connect to the server. Click on retry button to try again.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">unsupported_device_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="We do not support this device. For more information please contact us.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">user_banned</span>
                                    <input type="text" class="form-control" name="v[]" value="User banned!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enroll_now</span>
                                    <input type="text" class="form-control" name="v[]" value="Enroll Now">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enrolled</span>
                                    <input type="text" class="form-control" name="v[]" value="Enrolled">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enrolled_already</span>
                                    <input type="text" class="form-control" name="v[]" value="Already enrolled! Nothing deducted from your balance.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enroll_fee</span>
                                    <input type="text" class="form-control" name="v[]" value="Enrolment fee:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">total_prize</span>
                                    <input type="text" class="form-control" name="v[]" value="Total prizes:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">lets_start</span>
                                    <input type="text" class="form-control" name="v[]" value="Let&#039;s start">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">wait_for_time_to_finish</span>
                                    <input type="text" class="form-control" name="v[]" value="You chose an option. Now wait for until remaining duration.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">game_tour_info</span>
                                    <input type="text" class="form-control" name="v[]" value="If you do not answer within the given time then time will be deducted from your next question.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">got_it</span>
                                    <input type="text" class="form-control" name="v[]" value="Got it">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">result_pub_on</span>
                                    <input type="text" class="form-control" name="v[]" value="Result will be published on:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">result_published</span>
                                    <input type="text" class="form-control" name="v[]" value="Result has been announced!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">click_check</span>
                                    <input type="text" class="form-control" name="v[]" value="Click here to check">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">tour_result</span>
                                    <input type="text" class="form-control" name="v[]" value="Tournament Result">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">game_tour_quit_desc</span>
                                    <input type="text" class="form-control" name="v[]"
                                        value="Your answer will remain answered if you leave now. Do you want to quit?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">name</span>
                                    <input type="text" class="form-control" name="v[]" value="Name">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">marks</span>
                                    <input type="text" class="form-control" name="v[]" value="Marks">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reward</span>
                                    <input type="text" class="form-control" name="v[]" value="Reward">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">login</span>
                                    <input type="text" class="form-control" name="v[]" value="Login">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">register</span>
                                    <input type="text" class="form-control" name="v[]" value="Register">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">forget_password_ask</span>
                                    <input type="text" class="form-control" name="v[]" value="Forget Password?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">retrieve_password</span>
                                    <input type="text" class="form-control" name="v[]" value="Retrieve Password">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">account_login</span>
                                    <input type="text" class="form-control" name="v[]" value="Account Log in">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">retrieve</span>
                                    <input type="text" class="form-control" name="v[]" value="Retrieve">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">email_address</span>
                                    <input type="text" class="form-control" name="v[]" value="Email address">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reg_name</span>
                                    <input type="text" class="form-control" name="v[]" value="Your name">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reg_email</span>
                                    <input type="text" class="form-control" name="v[]" value="Email address">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reg_pass</span>
                                    <input type="text" class="form-control" name="v[]" value="Password">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reg_pass_confirm</span>
                                    <input type="text" class="form-control" name="v[]" value="Password again">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reg_ref_code</span>
                                    <input type="text" class="form-control" name="v[]" value="Referral code (if any)">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">pass_not_match</span>
                                    <input type="text" class="form-control" name="v[]" value="Password did not match!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_ref_code</span>
                                    <input type="text" class="form-control" name="v[]" value="Invalid referral code!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">winner</span>
                                    <input type="text" class="form-control" name="v[]" value="Winner">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">you_pos_prefix</span>
                                    <input type="text" class="form-control" name="v[]" value="You are in position of">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">you_pos_suffix</span>
                                    <input type="text" class="form-control" name="v[]" value="by current ranking.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">no_more_rank</span>
                                    <input type="text" class="form-control" name="v[]" value="No more additional ranks.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">login_error</span>
                                    <input type="text" class="form-control" name="v[]" value="Login error:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">leaderboard</span>
                                    <input type="text" class="form-control" name="v[]" value="Leaderboard">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">earn_coins</span>
                                    <input type="text" class="form-control" name="v[]" value="Earn Coins">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">gift_items</span>
                                    <input type="text" class="form-control" name="v[]" value="Gift Items">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">support</span>
                                    <input type="text" class="form-control" name="v[]" value="Support">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">close_app</span>
                                    <input type="text" class="form-control" name="v[]" value="Close the app">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">profile</span>
                                    <input type="text" class="form-control" name="v[]" value="Profile">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">leaderboard_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="This leaderboard system is based on previous day&#039;s activities. This is not Tournament ranking.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">list_is_empty</span>
                                    <input type="text" class="form-control" name="v[]" value="List is empty.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">offers</span>
                                    <input type="text" class="form-control" name="v[]" value="Offers">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">gift_select_type</span>
                                    <input type="text" class="form-control" name="v[]" value="Select your gift item type:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">gift_select_amount</span>
                                    <input type="text" class="form-control" name="v[]" value="Select the correct amount from below:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">request_this_item</span>
                                    <input type="text" class="form-control" name="v[]" value="Redeem">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">write_here</span>
                                    <input type="text" class="form-control" name="v[]" value="Write here…">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">insufficient_balance</span>
                                    <input type="text" class="form-control" name="v[]" value="Insufficient balance!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">your_country</span>
                                    <input type="text" class="form-control" name="v[]" value="Your country:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">profile_data</span>
                                    <input type="text" class="form-control" name="v[]" value="Profile data">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invitation_code</span>
                                    <input type="text" class="form-control" name="v[]" value="Invitation code">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enter_invitation_code</span>
                                    <input type="text" class="form-control" name="v[]" value="Enter invitation code">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">submit</span>
                                    <input type="text" class="form-control" name="v[]" value="Submit">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">update</span>
                                    <input type="text" class="form-control" name="v[]" value="Update">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">change_avatar</span>
                                    <input type="text" class="form-control" name="v[]" value="Change Avatar">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enter_avatar_url</span>
                                    <input type="text" class="form-control" name="v[]" value="Enter your avatar url:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">change_name</span>
                                    <input type="text" class="form-control" name="v[]" value="Change Name">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enter_name</span>
                                    <input type="text" class="form-control" name="v[]" value="Enter your name">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ref_code_copied</span>
                                    <input type="text" class="form-control" name="v[]" value="Referral code copied to clipboard">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ref_link_copied</span>
                                    <input type="text" class="form-control" name="v[]" value="Referral link copied to clipboard">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">receive_push_message</span>
                                    <input type="text" class="form-control" name="v[]" value="Receive push message">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">personalized_message</span>
                                    <input type="text" class="form-control" name="v[]" value="Personalized message">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">global_notification</span>
                                    <input type="text" class="form-control" name="v[]" value="Global notification">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">notifications</span>
                                    <input type="text" class="form-control" name="v[]" value="Notifications">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">caching</span>
                                    <input type="text" class="form-control" name="v[]" value="Caching">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">clear_session_cache</span>
                                    <input type="text" class="form-control" name="v[]" value="Clear session cache">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">clear_login_data</span>
                                    <input type="text" class="form-control" name="v[]" value="Clear login data">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">app_ver</span>
                                    <input type="text" class="form-control" name="v[]" value="App version">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">session_cleared</span>
                                    <input type="text" class="form-control" name="v[]" value="Session cache cleared.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">msg_short</span>
                                    <input type="text" class="form-control" name="v[]" value="Message is too short.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">hello</span>
                                    <input type="text" class="form-control" name="v[]" value="Hello">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">support_welcome</span>
                                    <input type="text" class="form-control" name="v[]" value="Welcome to the support service. You can write us by using this chat box. One of our support agents will reach you shortly.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">api_offerwalls</span>
                                    <input type="text" class="form-control" name="v[]" value="API Offerwalls">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">sdk_offerwalls</span>
                                    <input type="text" class="form-control" name="v[]" value="SDK Offerwalls">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">video_offers</span>
                                    <input type="text" class="form-control" name="v[]" value="Video Offers">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">faq</span>
                                    <input type="text" class="form-control" name="v[]" value="F.A.Q.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">outdated_version</span>
                                    <input type="text" class="form-control" name="v[]" value="Outdated Version">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">outdated_version_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="You can download latest version of this app from Google PlayStore.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">go_to_ps</span>
                                    <input type="text" class="form-control" name="v[]" value="Go to PlayStore">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">continu</span>
                                    <input type="text" class="form-control" name="v[]" value="Continue">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">try_tomorrow</span>
                                    <input type="text" class="form-control" name="v[]" value="Daily playing limit exceeded. Try again tomorrow.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">you_won</span>
                                    <input type="text" class="form-control" name="v[]" value="You won">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">available_chances</span>
                                    <input type="text" class="form-control" name="v[]" value="Available chances:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">no_more_chance</span>
                                    <input type="text" class="form-control" name="v[]" value="No more chance left for today. Try again tomorrow.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">please_wait</span>
                                    <input type="text" class="form-control" name="v[]" value="Please wait…">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">game_list</span>
                                    <input type="text" class="form-control" name="v[]" value="Game List">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">faqs</span>
                                    <input type="text" class="form-control" name="v[]" value="Frequently Asked Questions">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">search_hint</span>
                                    <input type="text" class="form-control" name="v[]" value="Search in FAQ…">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invite</span>
                                    <input type="text" class="form-control" name="v[]" value="Invite">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">referral_system</span>
                                    <input type="text" class="form-control" name="v[]" value="Referral System">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ref_link_not_ready</span>
                                    <input type="text" class="form-control" name="v[]" value="Referral link is not ready yet!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">web_offerwall</span>
                                    <input type="text" class="form-control" name="v[]" value="Web Offerwall">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">accept</span>
                                    <input type="text" class="form-control" name="v[]" value="I accept">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reject</span>
                                    <input type="text" class="form-control" name="v[]" value="Reject">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_email</span>
                                    <input type="text" class="form-control" name="v[]" value="Invalid email address!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enter_pass</span>
                                    <input type="text" class="form-control" name="v[]" value="Enter a password!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">pass_min</span>
                                    <input type="text" class="form-control" name="v[]" value="Password must be at least 8 characters!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">pass_max</span>
                                    <input type="text" class="form-control" name="v[]" value="&quot;Password cannot be greater than 20 characters!&quot;">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">login_with_email</span>
                                    <input type="text" class="form-control" name="v[]" value="Login with email">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">register_account</span>
                                    <input type="text" class="form-control" name="v[]" value="Register an account">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">verify_your_number</span>
                                    <input type="text" class="form-control" name="v[]" value="Verify your number">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">verify_phone_number_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="Please enter your country and your phone number">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">send_code</span>
                                    <input type="text" class="form-control" name="v[]" value="Send verification code">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">search</span>
                                    <input type="text" class="form-control" name="v[]" value="Search…">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">verification_code</span>
                                    <input type="text" class="form-control" name="v[]" value="Verification code">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">verification_code_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="Please enter the code sent to">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">verify_code</span>
                                    <input type="text" class="form-control" name="v[]" value="Verify the code">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_verif_code</span>
                                    <input type="text" class="form-control" name="v[]" value="You entered an invalid verification code!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">logout</span>
                                    <input type="text" class="form-control" name="v[]" value="Log out">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">redeem_history</span>
                                    <input type="text" class="form-control" name="v[]" value="Redeem History">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">empty_history</span>
                                    <input type="text" class="form-control" name="v[]" value="Nothing to show! History is empty.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">history_redeem_info</span>
                                    <input type="text" class="form-control" name="v[]" value="If there is any rejection of your redeem request please click on that item to know the reason.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ref_history</span>
                                    <input type="text" class="form-control" name="v[]" value="Referral History">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">double_back</span>
                                    <input type="text" class="form-control" name="v[]" value="Press again to exit the app">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ref_n_earn</span>
                                    <input type="text" class="form-control" name="v[]" value="Refer your friends and Earn">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ref_desc_1</span>
                                    <input type="text" class="form-control" name="v[]" value="Your friend gets">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ref_desc_2</span>
                                    <input type="text" class="form-control" name="v[]" value="on sign up and you get">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ref_desc_3</span>
                                    <input type="text" class="form-control" name="v[]" value="every time.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">your_ref_code</span>
                                    <input type="text" class="form-control" name="v[]" value="Your referral code">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">copy</span>
                                    <input type="text" class="form-control" name="v[]" value="Copy">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">code</span>
                                    <input type="text" class="form-control" name="v[]" value="Code">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">or</span>
                                    <input type="text" class="form-control" name="v[]" value="or">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">share_ref_via</span>
                                    <input type="text" class="form-control" name="v[]" value="Share your Referral Link via">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">telegram</span>
                                    <input type="text" class="form-control" name="v[]" value="Telegram">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">facebook</span>
                                    <input type="text" class="form-control" name="v[]" value="Facebook">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">whatsapp</span>
                                    <input type="text" class="form-control" name="v[]" value="Whatsapp">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">status</span>
                                    <input type="text" class="form-control" name="v[]" value="Status:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">select_country</span>
                                    <input type="text" class="form-control" name="v[]" value="Select Country">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">lotto</span>
                                    <input type="text" class="form-control" name="v[]" value="Lotto">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">previous_winner</span>
                                    <input type="text" class="form-control" name="v[]" value="Previous winner:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">next_draw</span>
                                    <input type="text" class="form-control" name="v[]" value="Next draw:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">your_selected_numbers</span>
                                    <input type="text" class="form-control" name="v[]" value="Your selected numbers:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reset</span>
                                    <input type="text" class="form-control" name="v[]" value="Reset">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">cost</span>
                                    <input type="text" class="form-control" name="v[]" value="Cost:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">history</span>
                                    <input type="text" class="form-control" name="v[]" value="History">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">confirm</span>
                                    <input type="text" class="form-control" name="v[]" value="Confirm">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">no_chances</span>
                                    <input type="text" class="form-control" name="v[]"
                                        value="No more chance left for today, wait until the server reset.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">lotto_enter_all</span>
                                    <input type="text" class="form-control" name="v[]"
                                        value="Enter a complete 5 sets of numbers then click confirm button">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">lotto_added</span>
                                    <input type="text" class="form-control" name="v[]"
                                        value="Lotto set added to the system for next draw. Come back tomorrow to check your luck.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">videos</span>
                                    <input type="text" class="form-control" name="v[]" value="Videos">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">yt_avl_vid</span>
                                    <input type="text" class="form-control" name="v[]" value="Available videos to play:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">scratch_n_win</span>
                                    <input type="text" class="form-control" name="v[]" value="Scratch &amp; Win">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_coordination</span>
                                    <input type="text" class="form-control" name="v[]" value="Invalid image coordination data!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">keep_scratching</span>
                                    <input type="text" class="form-control" name="v[]" value="Keep scratching…">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">scratcher_popup_text</span>
                                    <input type="text" class="form-control" name="v[]" value="Do you want to scratch this card?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">later</span>
                                    <input type="text" class="form-control" name="v[]" value="Later">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">free</span>
                                    <input type="text" class="form-control" name="v[]" value="Free">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">scratcher_exit_toast</span>
                                    <input type="text" class="form-control" name="v[]" value="You need to finish scratching this card">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">check_card</span>
                                    <input type="text" class="form-control" name="v[]" value="Check Card">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">dont_show_again</span>
                                    <input type="text" class="form-control" name="v[]" value="Don&#039;t show again">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">your_balance</span>
                                    <input type="text" class="form-control" name="v[]" value="Your balance:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">gift_ex_text</span>
                                    <input type="text" class="form-control" name="v[]" value="Exchange your balance with gift items">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">purchase_card</span>
                                    <input type="text" class="form-control" name="v[]" value="Purchase this card">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">starts_in</span>
                                    <input type="text" class="form-control" name="v[]" value="Starts in">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">on_live</span>
                                    <input type="text" class="form-control" name="v[]" value="On Live…">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">scratcher_diag_ask</span>
                                    <input type="text" class="form-control" name="v[]" value="How many cards do you want to purchase?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">quiz_game</span>
                                    <input type="text" class="form-control" name="v[]" value="Quiz Game">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">slot_game</span>
                                    <input type="text" class="form-control" name="v[]" value="Slot Game">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">spin_wheel</span>
                                    <input type="text" class="form-control" name="v[]" value="Spin Wheel">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">load_more</span>
                                    <input type="text" class="form-control" name="v[]" value="Load more">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">load_more_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="We have more exciting games for you. Do you to load them in a new window?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">layer_type</span>
                                    <input type="text" class="form-control" name="v[]" value="Layer Type">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">software</span>
                                    <input type="text" class="form-control" name="v[]" value="Software">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">hardware</span>
                                    <input type="text" class="form-control" name="v[]" value="Hardware">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">in_app_vid</span>
                                    <input type="text" class="form-control" name="v[]" value="In-app videos">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">watch_earn</span>
                                    <input type="text" class="form-control" name="v[]" value="Watch &amp; Earn">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">earn_from</span>
                                    <input type="text" class="form-control" name="v[]" value="Earn from">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">offerwalls</span>
                                    <input type="text" class="form-control" name="v[]" value="Offerwalls">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">balance</span>
                                    <input type="text" class="form-control" name="v[]" value="Balance">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">checking</span>
                                    <input type="text" class="form-control" name="v[]" value="Checking…">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invited_by</span>
                                    <input type="text" class="form-control" name="v[]" value="You are invited by:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invited_name</span>
                                    <input type="text" class="form-control" name="v[]" value="Invited user name">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_image</span>
                                    <input type="text" class="form-control" name="v[]" value="This is an invalid image file!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">select_language</span>
                                    <input type="text" class="form-control" name="v[]" value="Select your language">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">sett</span>
                                    <input type="text" class="form-control" name="v[]" value="Settings">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">cancl</span>
                                    <input type="text" class="form-control" name="v[]" value="Cancel">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">chat_room</span>
                                    <input type="text" class="form-control" name="v[]" value="Chat Room">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">warning</span>
                                    <input type="text" class="form-control" name="v[]" value="Warning">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enter_new_pass</span>
                                    <input type="text" class="form-control" name="v[]" value="New password">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enter_new_pass_confirm</span>
                                    <input type="text" class="form-control" name="v[]" value="Confirm new password">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">enter_current_pass</span>
                                    <input type="text" class="form-control" name="v[]" value="Enter current password">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">change</span>
                                    <input type="text" class="form-control" name="v[]" value="Change">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reply</span>
                                    <input type="text" class="form-control" name="v[]" value="Reply">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">block</span>
                                    <input type="text" class="form-control" name="v[]" value="Block">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">unblock</span>
                                    <input type="text" class="form-control" name="v[]" value="Unblock">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">report</span>
                                    <input type="text" class="form-control" name="v[]" value="Report">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">blocked_user_msg</span>
                                    <input type="text" class="form-control" name="v[]" value="This message cannot be shown.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">user_reported</span>
                                    <input type="text" class="form-control" name="v[]" value="Reported successfully! You may consider blocking this user if necessary.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">delete_acc</span>
                                    <input type="text" class="form-control" name="v[]" value="Delete Account">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">delete_acc_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="Do you want to delete your account? This action cannot undone. All the data will be permanently deleted.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ppv</span>
                                    <input type="text" class="form-control" name="v[]" value="Pay Per View">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ppv_warn</span>
                                    <input type="text" class="form-control" name="v[]"
                                        value="Do not share any of your sensitive data if you do not trust these websites.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">external_browser</span>
                                    <input type="text" class="form-control" name="v[]" value="Open in external browser?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">permission_required</span>
                                    <input type="text" class="form-control" name="v[]" value="Permission required!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">permission_notif_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="You will need to allow notification in your device to receive important reminders from us. Do you want to allow such permission?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">allow</span>
                                    <input type="text" class="form-control" name="v[]" value="Allow">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">nop</span>
                                    <input type="text" class="form-control" name="v[]" value="No">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">task_for_you</span>
                                    <input type="text" class="form-control" name="v[]" value="Tasks for you">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">task_details</span>
                                    <input type="text" class="form-control" name="v[]" value="Task details">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">submit_proof</span>
                                    <input type="text" class="form-control" name="v[]" value="Submit proof">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">start_task</span>
                                    <input type="text" class="form-control" name="v[]" value="Start the task">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">message</span>
                                    <input type="text" class="form-control" name="v[]" value="Message:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">screenshot</span>
                                    <input type="text" class="form-control" name="v[]" value="Attach screenshot:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">browse</span>
                                    <input type="text" class="form-control" name="v[]" value="Browse">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">unsupported_content</span>
                                    <input type="text" class="form-control" name="v[]" value="Unsupported content attached!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">proof_time</span>
                                    <input type="text" class="form-control" name="v[]" value="Proof must be submitted within AZA after you first start the task">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">wait_for_approval</span>
                                    <input type="text" class="form-control" name="v[]" value="You have already submitted proof for this task. Wait for the Staff approval.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">task_contact_support</span>
                                    <input type="text" class="form-control" name="v[]" value="Contact support to report this task">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">attach_scr</span>
                                    <input type="text" class="form-control" name="v[]" value="Attach a screenshot for proof">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">msg_limit</span>
                                    <input type="text" class="form-control" name="v[]" value="Message must be at least 10 characters long and not more than 600 characters">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">file_size_limit</span>
                                    <input type="text" class="form-control" name="v[]" value="File size cannot be larger than one megabyte">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">game_info</span>
                                    <input type="text" class="form-control" name="v[]" value="Game information">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">activation_required</span>
                                    <input type="text" class="form-control" name="v[]" value="Activation\nrequired">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">html_activation_amt</span>
                                    <input type="text" class="form-control" name="v[]" value="AAA will be required to activate this game.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">html_play_deduction</span>
                                    <input type="text" class="form-control" name="v[]" value="It is a time based game. To play this game you will be charged AAA.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">html_play_reward</span>
                                    <input type="text" class="form-control" name="v[]" value="You will be rewarded by AAA to play this game actively.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">game_next</span>
                                    <input type="text" class="form-control" name="v[]" value="Do you want to continue with this game?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">failed</span>
                                    <input type="text" class="form-control" name="v[]" value="failed">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ongoing</span>
                                    <input type="text" class="form-control" name="v[]" value="Ongoing...">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">could_not_connect</span>
                                    <input type="text" class="form-control" name="v[]" value="Could not connect to the server">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">questions</span>
                                    <input type="text" class="form-control" name="v[]" value="questions">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">rounds</span>
                                    <input type="text" class="form-control" name="v[]" value="rounds">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">free_chance</span>
                                    <input type="text" class="form-control" name="v[]" value="Free chance">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">marks_zero</span>
                                    <input type="text" class="form-control" name="v[]" value="Marks: 0">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">slide_to_cancel</span>
                                    <input type="text" class="form-control" name="v[]" value="Slide to cancel it.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ok</span>
                                    <input type="text" class="form-control" name="v[]" value="OK">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">pending</span>
                                    <input type="text" class="form-control" name="v[]" value="pending">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">completed</span>
                                    <input type="text" class="form-control" name="v[]" value="completed">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">rejected</span>
                                    <input type="text" class="form-control" name="v[]" value="rejected">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">first_set_wheel_data</span>
                                    <input type="text" class="form-control" name="v[]" value="First set the wheel data.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">dont_use_vpn</span>
                                    <input type="text" class="form-control" name="v[]" value="Do not use VPN!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_link</span>
                                    <input type="text" class="form-control" name="v[]" value="Invalid link!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_conf_link</span>
                                    <input type="text" class="form-control" name="v[]" value="Invalid confirmation link!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_reset_link</span>
                                    <input type="text" class="form-control" name="v[]" value="Invalid reset link!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">data_parse_err</span>
                                    <input type="text" class="form-control" name="v[]" value="Data parsing error">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">unsupported_device</span>
                                    <input type="text" class="form-control" name="v[]" value="Unsupported device!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">time_parse_err</span>
                                    <input type="text" class="form-control" name="v[]" value="Time parsing error">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">depr_game</span>
                                    <input type="text" class="form-control" name="v[]" value="This game is depreciated. Try other games">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">err_or</span>
                                    <input type="text" class="form-control" name="v[]" value="Error">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">puz_yet_solve</span>
                                    <input type="text" class="form-control" name="v[]" value="Puzzle yet to solve.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">unknown_err</span>
                                    <input type="text" class="form-control" name="v[]" value="Unknown error">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">time_up</span>
                                    <input type="text" class="form-control" name="v[]" value="Times up!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">click_when_solve</span>
                                    <input type="text" class="form-control" name="v[]" value="Click here when you solve this">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ur_curr_score</span>
                                    <input type="text" class="form-control" name="v[]" value="Your current score">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_login_cred</span>
                                    <input type="text" class="form-control" name="v[]" value="Invalid login credentials!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">offer_unavailable</span>
                                    <input type="text" class="form-control" name="v[]" value="This offer is not available">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">no_gp</span>
                                    <input type="text" class="form-control" name="v[]" value="You do not have Google Play installed">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">tos_title</span>
                                    <input type="text" class="form-control" name="v[]" value="Terms and Conditions">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">privacy_title</span>
                                    <input type="text" class="form-control" name="v[]" value="Privacy Policy">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reminder</span>
                                    <input type="text" class="form-control" name="v[]" value="Reminder">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">reminder_desc</span>
                                    <input type="text" class="form-control" name="v[]" value="Mintly collects / syncs / stores user uploaded images to enable the feature, User Avatar and Screenshot Proof for various tasks. User can permanently delete his these data by deleting his account with Mintly. Chat room attachments automatically deletes after a certain period of time or it can also be deleted immediately if the user request for deletion by contacting us. \n\n Are you sure you want to continue?">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">no</span>
                                    <input type="text" class="form-control" name="v[]" value="No">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">yesterday</span>
                                    <input type="text" class="form-control" name="v[]" value="Yestarday">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">today</span>
                                    <input type="text" class="form-control" name="v[]" value="Today">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">nav_home</span>
                                    <input type="text" class="form-control" name="v[]" value="Home">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">nav_offers</span>
                                    <input type="text" class="form-control" name="v[]" value="Offers">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">nav_gifts</span>
                                    <input type="text" class="form-control" name="v[]" value="Gifts">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">nav_invite</span>
                                    <input type="text" class="form-control" name="v[]" value="Invite">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">nav_ranks</span>
                                    <input type="text" class="form-control" name="v[]" value="Ranks">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">nav_profile</span>
                                    <input type="text" class="form-control" name="v[]" value="Profile">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ar_opened</span>
                                    <input type="text" class="form-control" name="v[]" value="Today you opened this vault!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ar_no_open</span>
                                    <input type="text" class="form-control" name="v[]" value="This vault cannot be opened today!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">ar_empty</span>
                                    <input type="text" class="form-control" name="v[]" value="This vault is empty!">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">fill_input</span>
                                    <input type="text" class="form-control" name="v[]" value="Fill the input field.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">invalid_number</span>
                                    <input type="text" class="form-control" name="v[]" value="Enter a valid number.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">gift_request</span>
                                    <input type="text" class="form-control" name="v[]" value="Request added to the queue for approval.">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">gift_locked</span>
                                    <input type="text" class="form-control" name="v[]" value="Unlock in progress">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">gift_unlocked</span>
                                    <input type="text" class="form-control" name="v[]" value="Available to redeem">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">hist_activity</span>
                                    <input type="text" class="form-control" name="v[]" value="Activity History">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">hist_game</span>
                                    <input type="text" class="form-control" name="v[]" value="Game History">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">hist_gift</span>
                                    <input type="text" class="form-control" name="v[]" value="Gift History">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">hist_invite</span>
                                    <input type="text" class="form-control" name="v[]" value="Referral History">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">referrer_since</span>
                                    <input type="text" class="form-control" name="v[]" value="Referrer since:">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text">follow_us</span>
                                    <input type="text" class="form-control" name="v[]" value="Follow us">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="lang_edit" class="btn btn-dark">Update strings</button>
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