<?php
require "php/handler.php";

// Fetch data from the database
$result = query("SELECT * FROM `m_pegawai`;");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">HOME</a>
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
                        <a class="nav-link" href="admin.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    // Notifikasi setelah berhasil tambah data
    if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasiltambah') {
        echo "
    <script>
        window.onload = function() {
            alert('Data pegawai berhasil ditambahkan!');
        }
    </script>
    ";
    }

    // Notifikasi setelah berhasil edit data
    if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasiledit') {
        echo "
    <script>
        window.onload = function() {
            alert('Data pegawai berhasil diedit!');
        }
    </script>
    ";
    }

    if (isset($_GET['pesan']) && $_GET['pesan'] == 'loginberhasil') {
        echo "
    <script>
        window.onload = function() {
            alert('Login Berhasil, Selamat Datang Admin!');
        }
    </script>
    ";
    }

    if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasilhapus') {
        echo "
    <script>
        window.onload = function() {
            alert('Data Berhasil Dihapus!');
        }
    </script>
    ";
    }
    ?>


    <div class="container">
        <h2 class="text-center my-3">DAFTAR PEGAWAI</h2>

        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="tambah_data.php" class="btn btn-primary my-3">Tambah Data</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Alamat</th>
                            <th>Telefon</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($result as $row):
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td style="width: 20%;">
                                    <img src="assets/foto_pegawai/<?= $row['photo']; ?>" alt="Foto Pegawai" style="width: 100%;">
                                </td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['jabatan']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                                <td><?= $row['no_telp']; ?></td>
                                <td>
                                    <a href="edit_data.php?id=<?= $row['id_pegawai']; ?>" class="btn btn-warning">EDIT</a>
                                </td>
                                <td>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $row['id_pegawai']; ?>">DELETE</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this employee?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        let deleteId;
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            deleteId = button.getAttribute('data-id');
        });

        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (deleteId) {
                window.location.href = `php/check_hapusdata.php?id=${deleteId}`;
            }
        });
    </script>

</body>

</html>