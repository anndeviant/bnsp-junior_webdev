<?php
require "php/handler.php";

$id = $_GET['id'];
$pegawai = query("SELECT * FROM m_pegawai WHERE id_pegawai = $id")[0];

if (!$pegawai) {
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Data Pegawai</h2>
        <form action="php/check_editdata.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $pegawai['id_pegawai']; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pegawai</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $pegawai['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $pegawai['jabatan']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo $pegawai['alamat']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" id="no_telp" name="no_telp" value="<?php echo $pegawai['no_telp']; ?>" required>
            </div>
            <div class="mb-3 row">
                <div class="col-md-3">
                    <!-- Foto di sebelah kiri -->
                    <img src="assets/foto_pegawai/<?php echo $pegawai['photo']; ?>" alt="Current Photo" class="img-thumbnail" style="max-width: 200px;">
                </div>
                <div class="col-md-7">
                    <!-- Form input di sebelah kanan -->
                    <label for="photo" class="form-label">Ganti Foto Pegawai</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-4">
                <button type="submit" class="btn btn-primary">Update Pegawai</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>