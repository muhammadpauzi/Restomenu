<?php
require 'proses/init.php';
$daftarMenu = query("SELECT * FROM menu");

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $daftarMenu = cari($keyword);
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

    <title>Pesan - Restomenu</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="pesan.php">Restomenu</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navCollapse" aria-controls="navCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="keranjang.php" class="nav-item nav-link btn btn-my-color btn-sm text-white mr-2">Keranjang</a>
                    <a href="login.php" class="nav-item nav-link btn btn-my-color btn-sm text-white">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container main">
        <div class="row mt-3">
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
            <?php if (empty($daftarMenu)) : ?>
                <div class="col text-center text-danger pt-4">
                    <p>Menu tidak ditemukan</p>
                </div>
            <?php endif; ?>
            <?php foreach ($daftarMenu as $m) : ?>
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <img src="assets/image/<?= $m['gambar']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $m['nama']; ?></h5>
                            <p class="card-text"><?= 'Rp.' . number_format($m['harga'], 2, '.', ','); ?></p>
                            <form action="keranjang.php" method="post">
                                <button type="submit" name="pesan" class="btn btn-my-color">Pesan</button>
                                <input type="hidden" name="id" value="<?= $m['id']; ?>">
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="bg-light mt-4 p-4">
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