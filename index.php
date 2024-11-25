<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM complaints WHERE user_id = ".$_SESSION['user_id'];
$result = $conn->query($sql);
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
    <h1>Selamat datang, <?= $_SESSION['username']; ?>!</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="complaint.php">Kirim Pengaduan</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>Pengaduan Anda:</h2>
    <table>
        <tr>
            <th>Email</th>
            <th>Message</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['email'] ?></td>
                <td><?= $row['message'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="update_complaint.php?id=<?= $row['id'] ?>">Edit</a>
                    <a href="delete_complaint.php?id=<?= $row['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
