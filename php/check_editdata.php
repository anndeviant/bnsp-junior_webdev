<?php
include "handler.php";

$id_pegawai = $_GET["id"];
$nama = $_POST["nama"];
$jabatan = $_POST["jabatan"];
$alamat = $_POST["alamat"];
$no_telp = $_POST["no_telp"];
$foto = $_FILES["photo"]["name"];
$tmp_foto = $_FILES["photo"]["tmp_name"];

// Cek apakah ada file foto yang diunggah
if (!empty($foto)) {
    // Pindahkan file ke folder uploads
    move_uploaded_file($tmp_foto, "../assets/foto_pegawai/" . $foto);

    // Query update dengan foto baru
    $querySet = "UPDATE m_pegawai 
                 SET nama = '$nama', jabatan = '$jabatan', alamat = '$alamat', no_telp = '$no_telp', photo = '$foto' 
                 WHERE id_pegawai = '$id_pegawai'";
} else {
    // Query update tanpa mengubah foto
    $querySet = "UPDATE m_pegawai 
                 SET nama = '$nama', jabatan = '$jabatan', alamat = '$alamat', no_telp = '$no_telp' 
                 WHERE id_pegawai = '$id_pegawai'";
}

$result = mysqli_query($mydb, $querySet);

if ($result) {
    header("Location: ../admin.php?pesan=berhasiledit");
} else {
    die("Error: " . mysqli_error($mydb));
}
