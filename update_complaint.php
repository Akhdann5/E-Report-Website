<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $complaint_id = $_GET['id'];
    $sql = "SELECT * FROM complaints WHERE id = '$complaint_id' AND user_id = ".$_SESSION['user_id'];
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "Pengaduan tidak ditemukan!";
        exit();
    }

    $complaint = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $message = $_POST['message'];
    $status = $_POST['status'];

    $sql = "UPDATE complaints SET email = '$email', message = '$message', status = '$status' WHERE id = '$complaint_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Pengaduan berhasil diperbarui!";
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
    <title>Edit Pengaduan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Edit Pengaduan</h1>
    <form method="POST">
        Email: <input type="email" name="email" value="<?= $complaint['email'] ?>" required><br>
        Message: <textarea name="message" required><?= $complaint['message'] ?></textarea><br>
        Status:
        <select name="status">
            <option value="pending" <?= $complaint['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="in progress" <?= $complaint['status'] == 'in progress' ? 'selected' : '' ?>>In Progress</option>
            <option value="resolved" <?= $complaint['status'] == 'resolved' ? 'selected' : '' ?>>Resolved</option>
        </select><br>
        <button type="submit">Update Complaint</button>
    </form>

    <p>Kembali ke <a href="index.php"> Halaman Utama</a></p>
</body>
</html>
