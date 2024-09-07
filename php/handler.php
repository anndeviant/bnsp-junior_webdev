<?php

$server = "localhost";
$username = "root";
$password = "";
$namadb = "data_pegawai";

$mydb = new mysqli($server, $username, $password, $namadb);

if ($mydb->connect_error) {
    die("Koneksi gagal: " . $mydb->connect_error);
}


function query($sql)
{
    global $mydb;  // Use the correct global variable

    $result = mysqli_query($mydb, $sql);

    $data = [];

    while ($x = mysqli_fetch_array($result)) {
        $data[] = $x;
    }

    return $data;
}

function pencarianPegawai($keyword)
{
    global $mydb;

    $keyword = mysqli_real_escape_string($mydb, $keyword);

    $sql = "SELECT * FROM `m_pegawai`
            WHERE 
                nama LIKE '%$keyword%' OR
                jabatan LIKE '%$keyword%' OR
                alamat LIKE '%$keyword%' OR
                no_telp LIKE '%$keyword%';";

    $result = mysqli_query($mydb, $sql);

    $data = [];

    while ($x = mysqli_fetch_array($result)) {
        $data[] = $x;
    }

    return $data;
}
