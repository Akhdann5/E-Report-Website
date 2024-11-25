<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $complaint_id = $_GET['id'];
    $sql = "DELETE FROM complaints WHERE id = '$complaint_id' AND user_id = ".$_SESSION['user_id'];

    if ($conn->query($sql) === TRUE) {
        echo "Pengaduan berhasil dihapus!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<p>Kembali ke <a href="index.php"> Halaman Utama</a></p>