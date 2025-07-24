<!-- header url start -->
<?php include('header_top.php');?>
<?php include('header_bottom.php');?>

<style>
    .check-icon {
        display: none;
        color: green;
        margin-left: 50%;
        font-weight: bold;
    }

    .device-check-wrapper {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 5px;
    }
</style>
<!-- header url end -->

<?php
// Set default empty values
$title = '';
$category = '';
$point_status = '';
$aid = '';
$type = '';
$points = '';
$cap = '';
$cap_reset = '';
$description = '';
$preview_link = '';
$tracking_link = '';
$flow = '';
$quick_desc = '';
$android_version = '';
$ios_version = '';
$win_version = '';
$geo_selected = [];
$stateid = [];
$state_disable = 1; // Default Include
$device = [];
$icon_url = '';
$image = '';
$msg = '';
$color_class = '';

// Check if editing
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM offers WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res); // Missing before
        $category = $row['category'];
        $point_status = $row['point_status'];
        $aid = $row['aid'];
        $title = $row['name'];
        $type = $row['type'];
        $points = $row['points'];
        $cap = $row['cap'];
        $cap_reset = $row['cap_reset'];
        $description = $row['description'];
        $preview_link = $row['preview_link'];
        $tracking_link = $row['tracking_link'];
        $flow = $row['flow'];
        $quick_desc = $row['quick_desc'];
        $android_version = $row['android_version'];
        $ios_version = $row['ios_version'];
        $win_version = $row['win_version'];
        $state_disable = $row['state_disable'];
        $icon_url = $row['icon_url'];
        $geo_selected = explode(',', $row['geo']);
        $device = explode(',', $row['os']);
        $stateid = explode(',', $row['stateid']);
    } else {
        header('Location: custom.php');
        die();
    }
}

if (isset($_POST['submit_offer'])) {
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $point_status = mysqli_real_escape_string($con, $_POST['point_status']);
    $aid = mysqli_real_escape_string($con, $_POST['aid']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $quick_desc = mysqli_real_escape_string($con, $_POST['quick_desc']);
    $hot = mysqli_real_escape_string($con, $_POST['hot']);
    $tracking_link = mysqli_real_escape_string($con, $_POST['tracking_link']);
    $preview_link = mysqli_real_escape_string($con, $_POST['preview_link']);
    $devices_json = isset($_POST['device']) ? implode(",", $_POST['device']) : '';
    $geo = isset($_POST['geo']) ? implode(",", $_POST['geo']) : '';
    $flow = mysqli_real_escape_string($con, $_POST['flow']);
    $points = mysqli_real_escape_string($con, $_POST['points']);
    $cap = (int)$_POST['cap'] > 0 ? mysqli_real_escape_string($con, $_POST['cap']) : 99999;
    $cap_reset = $_POST['cap_reset'] !== '' ? mysqli_real_escape_string($con, $_POST['cap_reset']) : '00:00';
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $android_version = $_POST['android_version'] ?? '';
    $ios_version = $_POST['ios_version'] ?? '';
    $win_version = $_POST['win_version'] ?? '';
    $state_disable = isset($_POST['state_disable']) ? (int)$_POST['state_disable'] : 1;
    $states = isset($_POST['stateid']) ? implode(",", $_POST['stateid']) : '';

    date_default_timezone_set("Asia/Calcutta");
    $date_time = date('d/m/Y H:i:s a');

    // Check if offer with same tracking link already exists
    $res = mysqli_query($con, "SELECT * FROM offers WHERE tracking_link='$tracking_link'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $getData = mysqli_fetch_assoc($res);
        if (!isset($_GET['id']) || $id != $getData['id']) {
            $msg = "Offer with this tracking link already exists";
            $color_class = "alert-danger";
        }
    }

    // Handle File Upload
    if (isset($_FILES['icon_url']['name']) && $_FILES['icon_url']['name'] != '') {
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        $file_name = $_FILES['icon_url']['name'];
        $file_tmp = $_FILES['icon_url']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_types)) {
            $new_file_name = time() . '_' . $file_name;
            $file_path = 'images/offers/' . $new_file_name;
            move_uploaded_file($file_tmp, $file_path);
            $image = $new_file_name;
        } else {
            $msg = "Invalid file format. Only JPG, JPEG, PNG, GIF, and SVG are allowed.";
        }
    }

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            // Update logic
            $sql = "UPDATE offers SET 
                category='$category', point_status='$point_status', aid='$aid', name='$name', description='$description', quick_desc='$quick_desc', hot='$hot', tracking_link='$tracking_link',
                preview_link='$preview_link', os='$devices_json', geo='$geo', flow='$flow', points='$points', cap='$cap', cap_reset='$cap_reset',
                timestamp='$date_time', status='0', type='$type', android_version='$android_version', ios_version='$ios_version',
                win_version='$win_version', state_disable='$state_disable', stateid='$states'";
            
            if ($image != '') {
                $sql .= ", icon_url='$image'";
            }
            $sql .= " WHERE id='$id'";
            mysqli_query($con, $sql);
            logActivity($con, $id, $role_type_is, $name, 'Update offers list');
           
             
             // Get current offer_ids
                $result = mysqli_query($con, "SELECT offer_id FROM accepted_ip WHERE id='$aid'");
                $row = mysqli_fetch_assoc($result);
                $currentOffers = $row['offer_id'];
                $offerArray = array_filter(explode(',', $currentOffers));
                if (!in_array($id, $offerArray)) {
                    $offerArray[] = $id;
                    $newOfferIds = implode(',', $offerArray);
                    mysqli_query($con, "UPDATE accepted_ip SET offer_id='$newOfferIds' WHERE id='$aid'");
                }
                
        } else {
            // Insert logic
            mysqli_query($con, "INSERT INTO offers 
            (category, point_status, aid, name, description, quick_desc, hot, tracking_link, preview_link, os, geo, icon_url, flow, points, cap, cap_reset,
             timestamp, status, type, android_version, ios_version, win_version, state_disable, stateid)
            VALUES (
            '$category', '$point_status', '$aid', '$name', '$description', '$quick_desc', '$hot', '$tracking_link', '$preview_link', '$devices_json', '$geo',
            '$image', '$flow', '$points', '$cap', '$cap_reset', '$date_time', '0', '$type', '$android_version', '$ios_version', 
            '$win_version', '$state_disable', '$states')");
            $last_id = mysqli_insert_id($con);
            logActivity($con, $last_id, $role_type_is, $name, 'Add new offer list');
             mysqli_query($con, "UPDATE accepted_ip SET offer_id='$last_id' WHERE id='$aid'");
            header("Location: custom.php");
            die();
        }
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
                         <?php if (!empty($id)) { ?>
                             <div class="card-header">
                                <img src="images/offers/<?php echo $icon_url;?>" class="rounded text-truncate img-thumbnail text-small avatar-md mr-2" alt="<?php echo $title;?>">
                               <?php echo $title;?>
                            </div>
                          <?php }else{ ?>
                          <div class="card-header">Add a Custom Offer</div>
                          <?php } ?>
                          
                    
                        <div class="card-body row">
                            <!-- Alert -->
                            <div class="alert alert-info" role="alert">
                                <span class="font-weight-bold">Allowed macros are:</span> 
                                <span class="text-red"><span class="font-weight-bold">[oid]</span> for Offer ID</span> and 
                                <span class="text-red"><span class="font-weight-bold">[uid]</span> for User ID</span>.
                                <span class="text-red"><span class="font-weight-bold">[clickid]</span> for click id</span>.
                                <span class="text-red"><span class="font-weight-bold">[subid]</span> for Sub ID</span>.<br>
                                <span class="font-weight-bold">Reminder:</span> system automatically adds 
                                <span class="text-red">uid, oid, clickid, subid </span> parameters into the given URL.
                            </div>
                    
                           <!-- Advestise -->
                            <div class="mb-3 col-12 col-lg-4">
                                <label class="form-label">Advertisers Name: <span class="text-danger">*</span></label>
                                <select class="form-select" name="aid" required>
                                    <option disabled <?php if($aid == '') echo 'selected'; ?>>Choose...</option>
                                    <?php 
                                    $cat_res = mysqli_query($con,"SELECT * FROM accepted_ip");
                                    while($list = mysqli_fetch_assoc($cat_res)){ ?>
                                        <option value="<?php echo $list['id']; ?>" <?php if($list['id'] == $aid) echo 'selected'; ?>>
                                            <?php echo $list['company_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        <!-- advertisers -->
                           <div class="mb-3 col-12 col-lg-4">
                                <label class="form-label">Point status: <span class="text-danger">*</span></label>
                                <select class="form-select" name="point_status" required>
                                    <option value="hold" <?= $point_status == 'hold' ? 'selected' : '' ?>>Hold</option>
                                    <option value="proccessing" <?= $point_status == 'proccessing' ? 'selected' : '' ?>>Proccessing</option>
                                </select>
                            </div>
                            
                            <!-- Title -->
                            <div class="mb-3 col-12 col-lg-4">
                                <label class="form-label">Title: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Clash of Clans" value="<?php echo htmlspecialchars($title); ?>">
                            </div>
                    
                            <!-- Category -->
                            <div class="mb-3 col-12 col-lg-4">
                                <label class="form-label">Category: <span class="text-danger">*</span></label>
                                <select class="form-select" name="category" required>
                                    <option disabled <?php if($category == '') echo 'selected'; ?>>Choose...</option>
                                    <?php 
                                    $cat_res = mysqli_query($con,"SELECT * FROM offer_categories");
                                    while($list = mysqli_fetch_assoc($cat_res)){ ?>
                                        <option value="<?php echo $list['category']; ?>" <?php if($list['category'] == $category) echo 'selected'; ?>>
                                            <?php echo $list['category']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                    
                            <!-- Offer Icon -->
                            <div class="mb-3 col-12 col-md-6 col-lg-4">
                                <label class="form-label">Offer Icon: <span class="text-danger">*</span></label>
                                <!--</?php if ($icon_url != '') { ?>-->
                                <!--    <div class="mb-2">-->
                                <!--        <img src="<?php echo $icon_url; ?>" alt="Current Icon" width="80">-->
                                <!--    </div>-->
                                <!--</?php } ?>-->
                                <input type="file" name="icon_url" class="form-control">
                            </div>
                    
                            <!-- Type -->
                            <div class="mb-3 col-12 col-md-6 col-lg-4">
                                <label class="form-label">Type</label>
                                <select class="form-select" name="type" required>
                                    <option disabled <?php if($type == '') echo 'selected'; ?>>Choose...</option>
                                    <?php 
                                    $type_res = mysqli_query($con,"SELECT * FROM offer_types");
                                    while($list = mysqli_fetch_assoc($type_res)){ ?>
                                        <option value="<?php echo $list['type']; ?>" <?php if($list['type'] == $type) echo 'selected'; ?>>
                                            <?php echo $list['type']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                    
                            <!-- Points -->
                            <div class="mb-3 col-12 col-md-6 col-lg-4">
                                <label class="form-label">Rewarding Coins: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="points" placeholder="100" value="<?php echo htmlspecialchars($points); ?>">
                            </div>
                    
                            <!-- Daily Cap -->
                            <div class="mb-3 col-12 col-md-6 col-lg-4">
                                <label class="form-label">Daily Cap: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="cap" placeholder="Daily Cap" value="<?php echo htmlspecialchars($cap); ?>">
                            </div>
                    
                            <!-- Cap Reset -->
                            <div class="mb-3 col-12 col-md-6 col-lg-4">
                                <label class="form-label">Cap Reset Timing: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="cap_reset" placeholder="Cap Reset Timing" value="<?php echo htmlspecialchars($cap_reset); ?>">
                            </div>
                    
                            <!-- Description -->
                            <div class="mb-3 col-12 col-md-6 col-lg-12">
                                <label class="form-label">Description: <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" rows="4" placeholder="Description" required><?php echo htmlspecialchars($description); ?></textarea>
                            </div>
                    
                            <!-- Preview Link -->
                            <div class="mb-3 col-12 col-md-6 col-lg-6">
                                <label class="form-label">Preview Link: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="preview_link" placeholder="Preview Link" value="<?php echo htmlspecialchars($preview_link); ?>">
                            </div>
                    
                            <!-- Tracking Link -->
                            <div class="mb-3 col-12 col-md-6 col-lg-6">
                                <label class="form-label">Tracking Link: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="tracking_link" placeholder="https://domain.tld/some/offer/id" value="<?php echo htmlspecialchars($tracking_link); ?>">
                            </div>
                    
                            <!-- Devices, Geos, States, Flow, Notes -->
                               <!-- Devices Section -->
                                <div class="mb-3 col-12 col-md-6 col-lg-4">
                                    <label class="form-label">Device: <span class="text-danger">*</span></label>
                                
                                    <div class="device-check-wrapper">
                                        <input type="checkbox" id="allCheck" <?= count($device) === 3 ? 'checked' : '' ?>>
                                        <label for="allCheck">All Check</label>
                                    </div>
                                
                                    <?php
                                    $devices = ['Android', 'IOS', 'Windows'];
                                    foreach ($devices as $d):
                                        $checked = in_array($d, $device) ? 'checked' : '';
                                        $display = in_array($d, $device) ? 'display:inline;' : 'display:none;';
                                    ?>
                                    <div class="device-check-wrapper">
                                        <input type="checkbox" class="device-check" name="device[]" value="<?= $d ?>" id="<?= strtolower($d) ?>Check" <?= $checked ?>>
                                        <label for="<?= strtolower($d) ?>Check"><?= $d === 'Windows' ? 'Desktop' : $d ?></label>
                                        <span class="check-icon" id="icon-<?= $d ?>" style="<?= $display ?>">✔</span>
                                    </div>
                                    <?php endforeach; ?>
                                
                                <?php 
                                $android_versions = [];
                                $ios_versions = [];
                                $windows_versions = [];
                                
                                $query = "SELECT version, type FROM device_version ORDER BY version ASC";
                                $result = mysqli_query($con, $query);
                                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    switch (strtolower($row['type'])) {
                                        case 'android':
                                            $android_versions[] = $row['version'];
                                            break;
                                        case 'ios':
                                            $ios_versions[] = $row['version'];
                                            break;
                                        case 'desktop':
                                            $windows_versions[] = $row['version'];
                                            break;
                                    }
                                }
                                ?>
                                    <!-- Device Version Selectors -->
                                    <!-- Android Dropdown -->
                                    <div id="AndroidDiv" style="<?= in_array('Android', $device) ? 'display:block;' : 'display:none;' ?>" class="device-div">
                                        <label for="android_version">Android Version</label>
                                        <select class="form-select" name="android_version">
                                            <option disabled <?= $android_version == '' ? 'selected' : '' ?>>Choose...</option>
                                            <?php foreach ($android_versions as $version): ?>
                                                <option value="<?= $version ?>" <?= $android_version == $version ? 'selected' : '' ?>><?= $version ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <!-- iOS Dropdown -->
                                    <div id="IOSDiv" style="<?= in_array('IOS', $device) ? 'display:block;' : 'display:none;' ?>" class="device-div">
                                        <label for="ios_version">iOS Version</label>
                                        <select class="form-select" name="ios_version">
                                            <option disabled <?= $ios_version == '' ? 'selected' : '' ?>>Choose...</option>
                                            <?php foreach ($ios_versions as $version): ?>
                                                <option value="<?= $version ?>" <?= $ios_version == $version ? 'selected' : '' ?>><?= $version ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <!-- Windows Dropdown -->
                                    <div id="WindowsDiv" style="<?= in_array('Windows', $device) ? 'display:block;' : 'display:none;' ?>" class="device-div">
                                        <label for="win_version">Windows Version</label>
                                        <select class="form-select" name="win_version">
                                            <option disabled <?= $win_version == '' ? 'selected' : '' ?>>Choose...</option>
                                            <?php foreach ($windows_versions as $version): ?>
                                                <option value="<?= $version ?>" <?= $win_version == $version ? 'selected' : '' ?>><?= $version ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                </div>
                                
                                <!-- Geo Section -->
                                <div class="mb-3 col-12 col-md-6 col-lg-4">
                                    <label class="form-label">Geo: <span class="text-danger">*</span></label>
                                <?php 
                                   $in_clause = "'" . implode("','", $geo_selected) . "'";
                                    $query = "SELECT name FROM countries WHERE sortname IN ($in_clause)";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if(!empty($row)){
                                             ?>
                                        <span style="background-color: green;color: white;padding: 3px;font-weight: 500;"><?php echo $row['name'] . ",";?></span>
                                         <?php
                                        }
                                    }
                                ?>
                                    <div>
                                        <label>
                                            <input type="checkbox" id="selectAllGeo" <?= count($geo_selected) === $total_country_count ? 'checked' : '' ?>>
                                            <strong>Select All</strong>
                                        </label>
                                    </div>
                                
                                    <div id="geoCheckboxes" style="height: 138px;overflow-y: auto;border: 1px solid #ddd;">
                                        <?php 
                                        $cat_res = mysqli_query($con, "SELECT * FROM countries");
                                        while($list = mysqli_fetch_assoc($cat_res)):
                                            $isChecked = in_array($list['sortname'], $geo_selected) ? 'checked' : '';
                                            $iconStyle = in_array($list['sortname'], $geo_selected) ? 'inline' : 'none';
                                        ?>
                                        
                                        <div class="geo-option" data-id="<?= $list['id']; ?>">
                                            <label>
                                                <input type="checkbox" name="geo[]" value="<?= $list['sortname']; ?>" class="geo-checkbox" <?= $isChecked ?>>
                                                <?= $list['name']; ?>
                                                <span class="check-icon" style="display: <?= $iconStyle ?>; color: green; margin-left: 8px;">✔️</span>
                                            </label>
                                        </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                                
                                <!-- States Section -->
                                <div class="mb-3 col-12 col-md-6 col-lg-4" id="state-container">
                                    
                                    <label class="form-label">States:</label>
                                    <?php 
                                       $in_clause_state = "'" . implode("','", $stateid) . "'";
                                        $query = "SELECT name FROM state WHERE id IN ($in_clause_state)";
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if(!empty($row)){
                                                 ?>
                                            <span style="background-color: green;color: white;padding: 3px;font-weight: 500;"><?php echo $row['name'] . ",";?></span>
                                             <?php
                                            }
                                        }
                                    ?>
                                    <br>
                                    <div style="height: 138px;overflow-y: auto;border: 1px solid #ddd;">
                                        <div id="state-checkbox-container">
                                            <!-- Populated dynamically via JS -->
                                        </div>
                                    </div>
                                
                                    <!-- Hidden field to pass selected states to JS -->
                                    <input type="hidden" id="selected-stateids" value="<?= implode(',', $stateid) ?>">
                                
                                    <div class="row mt-4">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="mb-3">
                                                <div class="form-selectgroup">
                                                    <label class="form-selectgroup-item text-no-wrap">
                                                        <input type="radio" name="state_disable" value="1" class="form-selectgroup-input" <?= $state_disable == '1' ? 'checked' : '' ?>>
                                                        <span class="form-selectgroup-label">Enable</span>
                                                    </label>
                                                    <label class="form-selectgroup-item">
                                                        <input type="radio" name="state_disable" value="0" class="form-selectgroup-input" <?= $state_disable == '0' ? 'checked' : '' ?>>
                                                        <span class="form-selectgroup-label">Disable</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           
                           
                            
                            
                            <div class="mb-3 col-12 col-md-6 col-lg-6">
                                <label class="form-label">Flow: <span class="text-danger">*</span></label>
                                <textarea  class="form-control" name="flow" id="validationCustom" rows="4" placeholder="Flow" required> <?php echo htmlspecialchars($flow); ?></textarea>
                            </div>
                            <div class="mb-3 col-12 col-md-6 col-lg-6">
                                <label class="form-label">Note: <span class="text-danger">*</span></label>
                                <textarea  class="form-control" name="quick_desc" id="validationCustom" rows="4" placeholder="Quick Description" required> <?php echo htmlspecialchars($quick_desc); ?></textarea>
                            </div>
                            
                            
                    
                            <div class="d-flex flex-row mt-4">
                                <button type="submit" name="submit_offer" class="btn btn-primary"><?php echo $offer_id > 0 ? 'Update Offer' : 'Create Offer'; ?></button>
                                <a href="offers_list.php" class="btn btn-white ml-4">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
                <!-- JavaScript Logic -->
                 <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const selectAll = document.getElementById('selectAllGeo');
                        const checkboxes = document.querySelectorAll('.geo-checkbox');
                        const stateDropdown = document.getElementById('state-dropdown');
                    
                        // Function to load states
                        function loadStates() {
                                const selectedCountries = [...checkboxes]
                                    .filter(cb => cb.checked)
                                    .map(cb => cb.closest('.geo-option').getAttribute('data-id'));
                                
                                // Clear previous checkboxes
                                const stateCheckboxContainer = document.getElementById('state-checkbox-container');
                                stateCheckboxContainer.innerHTML = '';
                                
                                if (selectedCountries.length === 0) {
                                    stateCheckboxContainer.innerHTML = '<p>Please select a country first.</p>';
                                    return;
                                }
                                
                                fetch('get_states.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: new URLSearchParams({ country_ids: selectedCountries })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.length === 0) {
                                        stateCheckboxContainer.innerHTML = '<p>No states found for the selected countries.</p>';
                                        return;
                                    }
                                
                                    // Add "Select All" checkbox at the top
                                    const selectAllCheckbox = document.createElement('input');
                                    selectAllCheckbox.type = 'checkbox';
                                    selectAllCheckbox.id = 'select-all-states';
                                    selectAllCheckbox.addEventListener('change', handleSelectAllStates);
                                    
                                    const selectAllLabel = document.createElement('label');
                                    selectAllLabel.setAttribute('for', 'select-all-states');
                                    selectAllLabel.innerText = 'Select All States';
                                
                                    const selectAllDiv = document.createElement('div');
                                    selectAllDiv.classList.add('state-checkbox');
                                    selectAllDiv.appendChild(selectAllCheckbox);
                                    selectAllDiv.appendChild(selectAllLabel);
                                
                                    stateCheckboxContainer.appendChild(selectAllDiv);
                                
                                    // Add individual state checkboxes
                                    const selectedStates = document.getElementById('selected-stateids').value.split(',');

                                    data.forEach(state => {
                                        const checkbox = document.createElement('input');
                                        checkbox.type = 'checkbox';
                                        checkbox.value = state.id;
                                        checkbox.id = `state-${state.id}`;
                                        checkbox.name = 'stateid[]';
                                        checkbox.checked = selectedStates.includes(state.id.toString());
                                        checkbox.addEventListener('change', handleCheckboxChange);
                                    
                                        const label = document.createElement('label');
                                        label.setAttribute('for', `state-${state.id}`);
                                        label.innerText = state.name;
                                    
                                        const div = document.createElement('div');
                                        div.classList.add('state-checkbox');
                                        if (checkbox.checked) {
                                            div.style.backgroundColor = 'lightgreen';
                                            div.style.borderColor = 'green';
                                        }
                                        div.appendChild(checkbox);
                                        div.appendChild(label);
                                    
                                        stateCheckboxContainer.appendChild(div);
                                    });

                                })
                                .catch(err => console.error('Error loading states:', err));
                            }
                            
                            // Function to handle "Select All States" checkbox behavior
                            function handleSelectAllStates(event) {
                                const selectAllChecked = event.target.checked;
                                const stateCheckboxes = document.querySelectorAll('#state-checkbox-container input[type="checkbox"]');
                                
                                stateCheckboxes.forEach(checkbox => {
                                    checkbox.checked = selectAllChecked;
                                    updateCheckboxStyle(checkbox); // Update style when "Select All" is used
                                });
                            }
                            
                            // Function to handle individual checkbox change
                            function handleCheckboxChange(event) {
                                const checkbox = event.target;
                                updateCheckboxStyle(checkbox);
                            }
                            
                            // Function to update checkbox style when checked
                            function updateCheckboxStyle(checkbox) {
                                const div = checkbox.closest('.state-checkbox');
                                
                                if (checkbox.checked) {
                                    div.style.backgroundColor = 'lightgreen'; // Change background to green
                                    div.style.borderColor = 'green'; // Optional: add border color to show checked state
                                } else {
                                    div.style.backgroundColor = ''; // Reset background color when unchecked
                                    div.style.borderColor = ''; // Reset border color when unchecked
                                }
                            }


                    
                        // Checkbox change logic with state loading
                        checkboxes.forEach(box => {
                            box.addEventListener('change', function () {
                                const icon = this.closest('label').querySelector('.check-icon');
                                icon.style.display = this.checked ? 'inline' : 'none';
                    
                                const allChecked = [...checkboxes].every(cb => cb.checked);
                                selectAll.checked = allChecked;
                    
                                loadStates(); // Load states on change
                            });
                        });
                    
                        // Select All logic
                        selectAll.addEventListener('change', function () {
                            checkboxes.forEach(cb => {
                                cb.checked = this.checked;
                                const icon = cb.closest('label').querySelector('.check-icon');
                                icon.style.display = this.checked ? 'inline' : 'none';
                            });
                    
                            loadStates(); // Load states when selecting all
                        });
                    });
              </script>

                <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const allCheck = document.getElementById('allCheck');
                            const deviceChecks = document.querySelectorAll('.device-check');
                        
                            const deviceDivs = {
                                Android: document.getElementById('AndroidDiv'),
                                IOS: document.getElementById('IOSDiv'),
                                Windows: document.getElementById('WindowsDiv')
                            };
                        
                            const iconMap = {
                                Android: document.getElementById('icon-Android'),
                                IOS: document.getElementById('icon-IOS'),
                                Windows: document.getElementById('icon-Windows')
                            };
                        
                            function updateDisplay() {
                                deviceChecks.forEach(checkbox => {
                                    const val = checkbox.value;
                                    const div = deviceDivs[val];
                                    const icon = iconMap[val];
                        
                                    if (checkbox.checked) {
                                        div.style.display = 'block';
                                        icon.style.display = 'inline';
                                    } else {
                                        div.style.display = 'none';
                                        icon.style.display = 'none';
                                    }
                                });
                            }
                        
                            allCheck.addEventListener('change', function () {
                                const isChecked = allCheck.checked;
                                deviceChecks.forEach(cb => cb.checked = isChecked);
                                updateDisplay();
                            });
                        
                            deviceChecks.forEach(checkbox => {
                                checkbox.addEventListener('change', function () {
                                    updateDisplay();
                        
                                    // Sync "All Check"
                                    if (!checkbox.checked) {
                                        allCheck.checked = false;
                                    } else {
                                        const allChecked = Array.from(deviceChecks).every(cb => cb.checked);
                                        allCheck.checked = allChecked;
                                    }
                                });
                            });
                        });
                    </script>
            <!-- footer Start -->
            <?php include('footer.php');?>
            <!-- footer end -->
        </div>
    </div>
    <!-- footer url start -->
    <?php include('footer_url.php');?>
    <!-- footer url end -->