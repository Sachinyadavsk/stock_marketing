<?php
require('confige.php');
require('functions.inc.php');

$sql = "SELECT * FROM chats WHERE is_staff = '" . $_SESSION['ADMIN_ID'] . "' ORDER BY updated_at ASC";
$result = $con->query($sql);


$data = [];
while ($row = $result->fetch_assoc()) {
    $message = $row['message'];
    // $url = str_replace("/api/", "/", $message);
    // $ext = pathinfo($url, PATHINFO_EXTENSION);

    // if (str_starts_with($message, "https://")) {
    //     if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
    //         $message = '<img src="' . $url . '" width="200px">';
    //     } elseif (in_array($ext, ['mp3', 'mp4'])) {
    //         $message = '<audio controls><source src="' . $url . '">' . $url . '</audio>';
    //     }
    // }

    $data[] = [
        'id' => $row['id'],
        'userid' => $row['userid'],
        'name' => $row['name'],
        'message' => $message,
        'updated_at' => $row['updated_at'],
        'is_staff' => $row['is_staff']
    ];
}

// print_r($data);
echo json_encode(['msgs' => $data]);
?>
