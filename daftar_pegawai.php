<?php
require "php/handler.php";

if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
    // Only perform search if a non-empty keyword is provided
    $result = pencarianPegawai($_POST['keyword']);
} else {
    // If no search is performed, get all pegawai
    $result = query("SELECT * FROM `m_pegawai`;");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="icon/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/style/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="daftar_pegawai.php">Daftar Pegawai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal Login -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="php/check_login.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="daftar_pegawai.php" type="submit" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Detail pegawai akan dimuat di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h2 class="text-center my-4">DAFTAR PEGAWAI</h2>
        </div>

        <div class="row my-3">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan Keyword!" aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Search!</button>
                </div>
            </form>
        </div>

        <div class="row mb-5">
            <?php if (empty($result)): ?>
                <p class="text-center">No results found.</p>
            <?php else: ?>
                <?php foreach ($result as $i):
                    $desc2 = substr($i['alamat'], 0, 50);
                ?>
                    <div class="col-md-4 justify-content-center d-flex mt-2">
                        <div class="card" style="width: 16rem;">
                            <img src="assets/foto_pegawai/<?= $i['photo'] ?>" class="card-img-top" alt="Gambar <?= $i['photo'] ?>" height="256px">
                            <div class="card-body">
                                <h5 class="card-title"><?= $i['nama'] ?></h5>
                                <p class="card-text"><?= $desc2; ?> </p>
                                <p class=""><?= $i['jabatan'] ?></p>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" data-id="<?= $i['id_pegawai'] ?>" data-bs-toggle="modal" data-bs-target="#detailModal">Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailModal = document.getElementById('detailModal');
            const modalBody = document.getElementById('modalBody');

            detailModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');

                // Fetch details
                fetch('php/check_detail.php?id=' + id)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            modalBody.innerHTML = '<p class="text-center">Detail tidak ditemukan.</p>';
                        } else {
                            modalBody.innerHTML = `
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="assets/foto_pegawai/${data.photo}" class="img-fluid" alt="Gambar ${data.nama}">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>Nama: ${data.nama}</h5>
                                        <p>Jabatan: ${data.jabatan}</p>
                                        <p>Alamat: ${data.alamat}</p>
                                        <p>No. Telepon: ${data.no_telp}</p>
                                    </div>
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        modalBody.innerHTML = '<p class="text-center">Terjadi kesalahan saat memuat detail.</p>';
                    });
            });
        });
    </script>
</body>

</html>