<?php
require 'proses/init.php';
$daftarMenu = query("SELECT * FROM menu");

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $daftarMenu = cari($keyword);
}

if (!isset($_SESSION['is_login'])) {
    header("Location: pesan.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Css 4 -->
    <link rel="stylesheet" href="vendor/bootstrap4/css/bootstrap.min.css">
    <!-- My Style -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Beranda - Restomenu</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">Restomenu</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navCollapse" aria-controls="navCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navCollapse">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link btn btn-my-color btn-sm text-white mr-2" href="pesan.php">Pesan</a>
                    <a href="proses/logout_proses.php" class="nav-item nav-link btn btn-danger btn-sm text-white">Log out</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container main">
        <div class="row mt-4">
            <div class="col">
                <!-- Link tambah data menu -->
                <a href="tambah.php" class="btn btn-my-color">Tambah Data Manu</a>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col">
                <h1>Daftar Menu</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari menu.." autofocus autocomplete="off" name="keyword">
                        <div class="input-group-append">
                            <button class="btn btn-my-color" type="submit" name="cari">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table <?= empty($daftarMenu) ? '' : 'table-hover'; ?>">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarMenu)) : ?>
                            <tr>
                                <td colspan="6">
                                    <p class="text-danger text-center p-4">Menu tidak ada</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php $no = 1;
                        foreach ($daftarMenu as $m) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $m['nama']; ?></td>
                                <td><?= $m['kategori']; ?></td>
                                <td><?= 'Rp.' . number_format($m['harga'], 2, '.', ','); ?></td>
                                <td><img src="assets/image/<?= $m['gambar']; ?>" class="img-thumbnail image-kecil" id="gambar" data-toggle="modal" data-target="#imageModal"></td>
                                <td>
                                    <a href="ubah.php?id=<?= $m['id']; ?>" class="badge badge-my-color badge-sm">Ubah</a>
                                    <a href="proses/hapus_proses.php?id=<?= $m['id']; ?>" class="badge badge-danger btn-sm" onclick="return confirm('Apakah kamu yakin ?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <img src="" id="imageModal-image" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="navbar navbar-inverse navbar-fixed-bottom bg-light mt-4 p-4">
        <div class="container">
            <div class="row">
                <div class="col mx-auto text-center pl-2">
                    <p>&copy; Copyright 2020, dibuat oleh <a href="">Muhammad Pauzi</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Jquery -->
    <script src="vendor/Jquery/jquery-3.5.0.min.js"></script>
    <!-- Bootstrap Js 4 -->
    <script src="vendor/bootstrap4/js/bootstrap.min.js"></script>
    <!-- My Script -->
    <script src="assets/js/script.js"></script>
</body>

</html>