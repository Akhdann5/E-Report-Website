<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data pengaduan pengguna
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM complaints WHERE user_id = '$user_id'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Report</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus pengaduan ini?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
</head>
<body>
    <h1>My Report</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="complaint.php">Kirim Pengaduan</a></li>
            <li><a href="my_report.php">My Report</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>Pengaduan Anda:</h2>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Pesan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['message']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td>
                            <!-- Form untuk hapus -->
                            <form id="delete-form-<?= $row['id'] ?>" method="POST" class="delete-form" style="display: inline;">
                                <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                <a href="javascript:void(0);" onclick="confirmDelete(<?= $row['id'] ?>)">Delete</a>
                            </form>

                            <!-- Tombol edit -->
                            <a href="update_complaint.php?id=<?= $row['id'] ?>">Edit</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Tidak ada pengaduan yang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Handle penghapusan pengaduan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $sql = "DELETE FROM complaints WHERE id = '$delete_id' AND user_id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pengaduan berhasil dihapus!'); window.location.href = 'my_report.php';</script>";
    } else {
        echo "<script>alert('Error: Pengaduan gagal dihapus.');</script>";
    }
}
?>
