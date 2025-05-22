<?php
// get_states.php
require('confige.php');
require('functions.inc.php');

if (isset($_POST['country_ids'])) {
    $countryIds = $_POST['country_ids'];
    
    // Handle both array and comma-separated string formats
    if (!is_array($countryIds)) {
        $countryIds = explode(',', $countryIds);
    }

    $ids = array_map('intval', $countryIds);
    $idList = implode(',', $ids);

    $sql = "SELECT id, name FROM state WHERE country_id IN ($idList)";
    $result = mysqli_query($con, $sql);

    $states = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $states[] = $row;
        }
    }

    echo json_encode($states);
}

?>
