<?php
$link = mysqli_connect("localhost", "root", "", "chat_app");

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
