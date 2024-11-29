<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO complaints (user_id, email, message) VALUES ('$user_id', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman index.php setelah pengaduan berhasil dikirim
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Pengaduan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Kirim Pengaduan</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="complaint.php">Kirim Pengaduan</a></li>
            <li><a href="my_report.php">My Report</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <form method="POST">
        Email: <input type="email" name="email" required><br>
        Pesan: <textarea name="message" required></textarea><br>
        <button type="submit">Kirim Pengaduan</button>
    </form>
</body>
</html>
