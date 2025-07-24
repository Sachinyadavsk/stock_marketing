<?php require('connection.php');?>
<?php
// Database connection

// Get POST data
$title = isset($_POST['title']) ? $_POST['title'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';

if (!empty($title) && !empty($description) && !empty($url)) {
    $stmt = $con->prepare("INSERT INTO notifications (title, description, action_url, created_on) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $title, $description, $url);

    if ($stmt->execute()) {
        echo "Notification saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


