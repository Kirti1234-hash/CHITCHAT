<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['username'])) {
    echo "User not logged in.";
    exit();
}

$myName = $_SESSION['username'];

// Mark all messages from others as read
mysqli_query($link, "UPDATE messages SET status = 'read' WHERE sender != '$myName' AND status != 'read'");

// Fetch messages including status
$sql = "SELECT sender, message, time, status FROM messages ORDER BY time ASC";
$result = mysqli_query($link, $sql);

if (!$result) {
    echo "Error in SQL query: " . mysqli_error($link);
    exit();
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $isMine = ($row['sender'] == $myName);
        $messageClass = $isMine ? 'user' : 'other';

        echo "<div class='message $messageClass'>";
        echo "<span class='sender'>" . substr($row['sender'], 0, 1) . "</span>";
        echo "<span class='message-text'>" . htmlspecialchars($row['message']) . "</span>";

        // Show time and (if sent by current user) the tick status
        echo "<span class='time'>" . date("h:i A", strtotime($row['time']));
        
        if ($isMine) {
            if ($row['status'] == 'sent') {
                echo " ✓";
            } elseif ($row['status'] == 'delivered') {
                echo " ✓✓";
            } elseif ($row['status'] == 'read') {
                echo " <span style='color: blue;'>✓✓</span>";
            }
        }

        echo "</span>"; // Close time
        echo "</div>";
    }
} else {
    echo "<div>No messages yet.</div>";
}
?>
