<?php

include "handler.php";

if (isset($_GET['id'])) {
    $id_pegawai = $_GET['id'];

    // Query untuk menghapus data pegawai
    $query = "DELETE FROM m_pegawai WHERE id_pegawai = '$id_pegawai'";

    if (mysqli_query($mydb, $query)) {
        header("Location: ../admin.php?pesan=berhasilhapus");
    } else {
        die("Error: " . mysqli_error($mydb));
    }

    mysqli_close($mydb);
} else {
    header("Location: ../admin.php");
}
