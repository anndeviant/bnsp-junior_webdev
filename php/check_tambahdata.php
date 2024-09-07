<?php
session_start();
require "handler.php";

$nama = $_POST["nama"];
$jabatan = $_POST["jabatan"];
$alamat = $_POST["alamat"];
$no_telp = $_POST["no_telp"];
$foto = $_FILES["photo"]["name"];
$tmp_foto = $_FILES["photo"]["tmp_name"];

// Lokasi penyimpanan foto
$uploadDir = "../assets/foto_pegawai/";
$uploadFile = $uploadDir . basename($foto);

// Pindahkan file ke folder uploads
if (move_uploaded_file($tmp_foto, $uploadFile)) {
    // Query untuk menambahkan data pegawai
    $query = "INSERT INTO m_pegawai (nama, jabatan, alamat, no_telp, photo) 
              VALUES ('$nama', '$jabatan', '$alamat', '$no_telp', '$foto')";

    // Eksekusi query
    if (mysqli_query($mydb, $query)) {
        header("Location: ../admin.php?pesan=berhasiltambah");
    } else {
        die("Error: " . mysqli_error($mydb));
    }
} else {
    echo "Error: Gagal mengupload foto.";
}
