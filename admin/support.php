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

.chat-container {
    padding: 10px;
    max-width: 800px;
    margin: auto;
}
.chat-message {
    display: flex;
    margin: 10px 0;
}
.chat-left {
    justify-content: flex-start;
}
.chat-right {
    justify-content: flex-end;
}
.chat-bubble-user {
    background-color: #cce5ff;
    color: #000;
    padding: 10px 15px;
    border-radius: 10px;
    max-width: 60%;
    box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
}
.chat-bubble-admin {
     background-color: #d4edda;
    color: #000;
    padding: 10px 15px;
    border-radius: 10px;
    max-width: 60%;
    box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
    text-align: right;
}
button {
    padding: 5px 10px;
    font-size: 14px;
    cursor: pointer;
}

.unread-badge {
    background-color: red;
    color: white;
    padding: 2px 8px;
    font-size: 12px;
    border-radius: 12px;
    margin-left: 5px;
}

.reply-box {
    margin-top: 15px;
}
.reply-box textarea {
    width: 100%;
    height: 60px;
    padding: 8px;
}
.reply-box button {
    margin-top: 5px;
    padding: 6px 12px;
}
</style>

<?php
if (isset($_POST['send'])) {
    $replyid = $_POST['replyid'];
    $message = $_POST['message'];
     $insert_query = "INSERT INTO messages (user_id, message, sender_type) VALUES ('$replyid', '$message', 'admin')";
    mysqli_query($con, $insert_query);
    echo "<script>alert('Access updated successfully'); window.location='https://reapbucks.com/admin/support.php';</script>";
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
        <span class="h4 nav-link active font-weight-bold">All User Notification Message</span>
    </div>
  <?php
$querya = "SELECT * FROM users";
$cat_resa = mysqli_query($con, $querya);

while ($lista = mysqli_fetch_assoc($cat_resa)) {
    $user_id = $lista['id'];

    // Count unread messages from user
    $unread_query = "SELECT COUNT(*) AS unread_count FROM messages WHERE user_id = '$user_id' AND sender_type = 'user' AND is_read = 0";
    $unread_result = mysqli_query($con, $unread_query);
    $unread_data = mysqli_fetch_assoc($unread_result);
    $unread_count = $unread_data['unread_count'];

    // Get all messages
    $messages_query = "SELECT * FROM messages WHERE user_id = '$user_id' ORDER BY created_at ASC";
    $messages_result = mysqli_query($con, $messages_query);
?>
 <?php if ($unread_count > 0){ ?>
  <button class="accordion" onclick="handleAccordionClick(<?php echo $user_id; ?>, <?php echo $unread_count; ?>)">
 <?php }else{ ?>
 <button class="accordion">
   <?php } ?>

        (<?php echo htmlspecialchars($lista['name']); ?>) 
        <?php if ($unread_count > 0): ?>
            <span class="unread-badge" id="badge-<?php echo $user_id; ?>"><?php echo $unread_count; ?> unread</span>
        <?php endif; ?>
    </button>
    <div class="panel" id="panel-<?php echo $user_id; ?>">
        <div class="chat-container">
            <?php if (mysqli_num_rows($messages_result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($messages_result)): ?>
                    <?php
                        $is_user = $row['sender_type'] === 'user';
                        $align_class = $is_user ? 'chat-left' : 'chat-right';
                        $bg_class = $is_user ? 'chat-bubble-user' : 'chat-bubble-admin';
                    ?>
                    <div class="chat-message <?php echo $align_class; ?>">
                        <div class="<?php echo $bg_class; ?>">
                            <h4><?php echo nl2br(htmlspecialchars($row['title'])); ?></h4>
                            <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                            <small><?php echo $row['created_at']; ?></small>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No active messages for this user.</p>
            <?php endif; ?>
        </div>

        <!-- ✅ Message input and send button -->
        <div class="reply-box">
            <form method="post">
            <input type="hidden" name="replyid" value="<?php echo $user_id; ?>">
            <textarea name="message" placeholder="Type your message..."></textarea>
            <button type="send" name="send" class="btn btn-success" style="float: right;">Send</button>
            </form>
        </div>
    </div>
<?php } ?>




<script>
function handleAccordionClick(userId, unreadCount) {
    // const panel = document.getElementById("panel-" + userId);
    // panel.style.display = (panel.style.display === "block") ? "none" : "block";

    if (unreadCount > 0) {
        alert("Read all messages from user ID: " + userId);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "mark_read.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("user_id=" + userId);

        // Remove unread badge visually
        const badge = document.getElementById("badge-" + userId);
        if (badge) {
            badge.remove();
        }
    }
}

</script>


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