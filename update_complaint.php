<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah ada data untuk di-update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complaint_id'])) {
    $complaint_id = $_POST['complaint_id'];
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE complaints SET message = '$message' WHERE id = '$complaint_id' AND user_id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke index.php setelah berhasil update
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data pengaduan berdasarkan ID
if (isset($_GET['id'])) {
    $complaint_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM complaints WHERE id = '$complaint_id' AND user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $complaint = $result->fetch_assoc();
    } else {
        echo "Pengaduan tidak ditemukan.";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pengaduan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Update Pengaduan</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="complaint.php">Kirim Pengaduan</a></li>
            <li><a href="my_report.php">My Report</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <form method="POST">
        <input type="hidden" name="complaint_id" value="<?= $complaint['id'] ?>">
        <label for="message">Pesan:</label><br>
        <textarea name="message" id="message" rows="5" required><?= $complaint['message'] ?></textarea><br>
        <button type="submit">Update Pengaduan</button>
    </form>
</body>
</html>
