<?php
require 'handler.php'; // Pastikan path ini sesuai dengan struktur proyek Anda

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan detail pegawai berdasarkan ID
    $sql = "SELECT * FROM `m_pegawai` WHERE `id_pegawai` = ?";
    $stmt = $mydb->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pegawai = $result->fetch_assoc();

    // Output data dalam format JSON
    echo json_encode($pegawai);
} else {
    echo json_encode(['error' => 'ID tidak ditemukan']);
}
