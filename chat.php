<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHIT CHAT</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>CHIT CHAT</h2>

    <div id="chathist" class="chat-box"></div>

    <form method="POST" action="sendMessage.php">
        <input type="text" name="message" placeholder="Type your message" required />
        <button type="submit">Send</button>
    </form>

    <script src="chat.js"></script>
</body>
</html>
