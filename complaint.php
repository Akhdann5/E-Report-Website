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
        echo "Pengaduan berhasil dikirim!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <form method="POST">
        Email: <input type="email" name="email" required><br>
        Message: <textarea name="message" required></textarea><br>
        <button type="submit">Submit Complaint</button>
    </form>

    <p>Kembali ke <a href="index.php"> Halaman Utama</a></p>
</body>
</html>
