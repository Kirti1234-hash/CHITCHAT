<?php
session_start();

// If already logged in, redirect to chat
if (isset($_SESSION['username'])) {
    header("Location: chat.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username'])) {
    $_SESSION['username'] = htmlspecialchars($_POST['username']);
    header("Location: chat.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Group Chat - Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #e5ddd5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px;
            border: none;
            background-color: #075e54;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #064e45;
        }
    </style>
</head>
<body>
    <h2>Join the Group Chat</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required />
        <button type="submit">Join Chat</button>
    </form>
</body>
</html>
