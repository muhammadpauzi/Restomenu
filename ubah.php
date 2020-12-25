<?php
require 'proses/init.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['is_login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$menu = query("SELECT * FROM menu WHERE id=$id")[0];
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

    <title>Ubah - Restomenu</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">Restomenu</a>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-6">
                <div class=" card bg-light mb-3">
                    <div class="card-header">Form Ubah Data Menu</div>
                    <div class="card-body">
                        <form action="proses/ubah_proses.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $menu['id']; ?>">
                            <input type="hidden" name="gambarHidden" value="<?= $menu['gambar']; ?>">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $menu['nama']; ?>">
                                <!-- <small class="form-text text-danger">We'll never share your email with anyone else.</small> -->
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $menu['harga']; ?>">
                                <!-- <small class="form-text text-danger">We'll never share your email with anyone else.</small> -->
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="custom-select" id="kategori" name="kategori">
                                    <?php $kategori = query("SELECT kategori FROM kategori");
                                    foreach ($kategori as $k) : ?>
                                        <option value="<?= $k['kategori']; ?>" <?= $menu['kategori'] == $k['kategori'] ? 'selected' : ''; ?>><?= $k['kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                    <label class="custom-file-label" for="gambar"><?= $menu['gambar']; ?></label>
                                </div>
                                <!-- <small class="form-text text-danger">We'll never share your email with anyone else.</small> -->
                            </div>
                            <a href="index.php" class="btn btn-my-color">Kembali</a>
                            <button type="submit" name="ubah" class="btn btn-my-color float-right">Ubah Data Menu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery -->
    <script src="vendor/Jquery/jquery-3.5.0.min.js"></script>
    <!-- Bootstrap Js 4 -->
    <script src="vendor/bootstrap4/js/bootstrap.min.js"></script>
    <!-- My Script -->
    <script src="assets/js/script.js"></script>
</body>

</html>