<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Welcome to E-Report Website</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="complaint.php">Kirim Pengaduan</a></li>
            <li><a href="my_report.php">My Report</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

        <!-- Hero Section -->
    <div class="hero">
        <h1>Selamat datang, <?= $_SESSION['username']; ?>!</h1>
        <p>Silakan kirim pengaduanmu di "Kirim Pengaduan" untuk membantu kami memberikan solusi terbaik.</p>
    </div>

</body>
</html>
