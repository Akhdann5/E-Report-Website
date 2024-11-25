<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'admin') {
    echo "Access denied.";
    exit();
}

$sql = "SELECT * FROM complaints";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Menyertakan CSS -->
</head>
<body>
    <h1>Panel Admin Pengaduan Masyarakat</h1>

    <table>
        <tr>
            <th>Email</th>
            <th>Message</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['email'] ?></td>
                <td><?= $row['message'] ?></td>
                <td>
                    <form method="POST" action="update_status.php">
                        <input type="hidden" name="complaint_id" value="<?= $row['id'] ?>">
                        <select name="status">
                            <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="in progress" <?= $row['status'] == 'in progress' ? 'selected' : '' ?>>In Progress</option>
                            <option value="resolved" <?= $row['status'] == 'resolved' ? 'selected' : '' ?>>Resolved</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
