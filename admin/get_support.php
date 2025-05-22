<?php
require('confige.php');
require('functions.inc.php');
$user_id = intval($_POST['user_id']);

// Mark user messages as read
$con->query("UPDATE messages SET is_read = 1 WHERE sender_id = '$user_id' AND receiver_id = 0");

// Fetch all messages for chat
$sql = "SELECT * FROM messages 
        WHERE (sender_id = '$user_id' AND receiver_id = 0)
           OR (sender_id = 0 AND receiver_id = '$user_id')
        ORDER BY created_at ASC";

$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
    $align = $row['sender_type'] == 'admin' ? 'text-right text-white bg-dark' : 'text-left bg-light';
    echo "<div class='p-2 m-2 rounded $align'>{$row['message']}</div>";
}
?>