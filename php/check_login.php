<?php
session_start();
include "handler.php";

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mencari pengguna
$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($mydb, $query);

if (mysqli_num_rows($result) > 0) {
    header("Location: ../admin.php?pesan=loginberhasil"); // Redirect ke halaman dashboard
} else {
    header("Location: ../daftar_pegawai.php?pesan=loginerror"); // Redirect ke halaman login dengan pesan error
}

mysqli_close($mydb);
