<?php
session_start();
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username']) && !empty($_POST['message'])) {
    $username = $_SESSION['username'];
    $message = htmlspecialchars($_POST['message']);
    $time = date("Y-m-d H:i:s");

    $sql = "INSERT INTO messages (sender, message, time, status) VALUES ('$username', '$message', '$time', 'sent')";
    mysqli_query($link, $sql);
}
header("Location: chat.php");
exit;
?>
