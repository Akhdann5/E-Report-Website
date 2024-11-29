<?php
$host = 'localhost';
$user = 'root';  // Sesuaikan dengan username MySQL
$password = '';  // Sesuaikan dengan password MySQL
$dbname = 'pengaduan_masyarakat';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
