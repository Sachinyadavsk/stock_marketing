<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>
<!-- header url end -->
<style>
.accordion {
  color: #444;
  cursor: pointer;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {

}

.panel {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
</style>

<?php
if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $module_ids = $_POST['module_id'];

    foreach ($module_ids as $module_id) {
        $view = isset($_POST['view_access'][$module_id]) ? 1 : 0;
        $insert = isset($_POST['insert_access'][$module_id]) ? 1 : 0;
        $delete = isset($_POST['delete_access'][$module_id]) ? 1 : 0;
        $edit = isset($_POST['edit_access'][$module_id]) ? 1 : 0;

        $check_query = "SELECT * FROM access_control WHERE user_id = '$user_id' AND module_id = '$module_id'";
        $check_res = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_res) > 0) {
            $update_query = "UPDATE access_control SET 
                can_view = '$view', 
                can_insert = '$insert', 
                can_delete = '$delete', 
                can_edit = '$edit' 
                WHERE user_id = '$user_id' AND module_id = '$module_id'";
            mysqli_query($con, $update_query);
        } else {
            $insert_query = "INSERT INTO access_control (user_id, module_id, can_view, can_insert, can_delete, can_edit)
                VALUES ('$user_id', '$module_id', '$view', '$insert', '$delete', '$edit')";
            mysqli_query($con, $insert_query);
        }
    }
    echo "<script>alert('Access updated successfully'); window.location='https://reapbucks.com/admin/module-setting/';</script>";
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
              <div class="card">
    <div class="card-header pt-2 pb-0">
        <span class="h4 nav-link active font-weight-bold">All Menu & Button Setting</span>
    </div>
    <?php
    $querya = "SELECT * FROM admin WHERE role='admin'";
    $cat_resa = mysqli_query($con, $querya);
    while ($lista = mysqli_fetch_assoc($cat_resa)) {
        $user_id = $lista['id'];

        // Get current access values for the user
        $access_map = [];
        $access_query = "SELECT * FROM access_control WHERE user_id = '$user_id'";
        $access_result = mysqli_query($con, $access_query);
        $i=1;
        while ($row = mysqli_fetch_assoc($access_result)) {
            $access_map[$row['module_id']] = $row;
        }
    ?>
    <button class="accordion"><span class="text text-blue">Access</span>&nbsp; (<?php echo $lista['name']; ?>)</button>
    <div class="panel">
        <form class="p-0" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="card-body row mt-2 pb-1">
                <?php
                $query = "SELECT * FROM access_module ORDER BY id DESC";
                $cat_res = mysqli_query($con, $query);
                while ($list = mysqli_fetch_assoc($cat_res)) {
                    $module_id = $list['id'];
                    $access = isset($access_map[$module_id]) ? $access_map[$module_id] : ['can_view'=>0, 'can_insert'=>0, 'can_delete'=>0, 'can_edit'=>0];
                ?>
                <input type="hidden" name="module_id[]" value="<?php echo $module_id; ?>">

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card bg-gray-lt" style="background: #354052 !important;">
                        <div class="card-header py-2">
                            <h3 class="card-title text-white text-truncate">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path>
                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path>
                                    <line x1="16" y1="5" x2="19" y2="8"></line>
                                </svg><?php echo ucwords(str_replace('_', ' ', $list['module_name'])); ?></h3>
                        </div>
                    </div>
                </div>

                <?php foreach (["view", "insert", "delete", "edit"] as $type): ?>
                <div class="col-lg-2 col-md-2 col-12">
                    <div class="card bg-gray-lt">
                        <div class="card-header py-2">
                            <h3 class="card-title text-dark text-truncate"><?php echo ucfirst($type); ?></h3>
                            <div class="card-actions">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                           name="<?php echo $type; ?>_access[<?php echo $module_id; ?>]" value="1"
                                           <?php echo ($access['can_' . $type]) ? 'checked' : ''; ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php } ?>
            </div>
            <div class="d-flex flex-row-reverse mt-4">
                <input type="submit" name="submit" class="btn btn-primary" value="Save Access" />
                <a href="https://reapbucks.com/admin/module-setting/" class="btn btn-white mr-4">Cancel</a>
            </div>
            <br>
        </form>
    </div>
    <?php } ?>

    <script>
    var acc = document.getElementsByClassName("accordion");
    for (var i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            panel.style.maxHeight = panel.style.maxHeight ? null : panel.scrollHeight + "px";
        });
    }

    // Open the first accordion by default
    if (acc.length > 0) {
        acc[0].classList.add("active");
        var panel = acc[0].nextElementSibling;
        panel.style.maxHeight = panel.scrollHeight + "px";
    }
</script>

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