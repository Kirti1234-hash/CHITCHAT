<?php
session_start();
$typing = $_POST['typing'];
$myName = $_SESSION['username'];
file_put_contents("typing_status.txt", $typing ? $myName : '');
?>
