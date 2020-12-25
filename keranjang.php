<?php
require 'proses/init.php';
$total = 0;
$kembali = 0;


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach ($_SESSION['pesan_cart'] as $cart => $values) {
        if ($values['item_id'] == $id) {
            unset($_SESSION['pesan_cart'][$cart]);
        }
    }
}


// Inti cart
if (isset($_POST['pesan'])) {
    header("Location: pesan.php");
    if (isset($_SESSION['pesan_cart'])) {
        $item_pesan_id = array_column($_SESSION['pesan_cart'], "item_id");
        if (!in_array($_POST['id'], $item_pesan_id)) {
            $count = count($_SESSION['pesan_cart']);
            $item_pesan = ['item_id' => $_POST['id']];
            $_SESSION['pesan_cart'][$count] = $item_pesan;
        } else {
            tampilAlert("Menu tersebut sudah ada di keranjang", 'pesan.php');
        }
    } else {
        $item_pesan = ['item_id' => $_POST['id']];
        $_SESSION['pesan_cart'][0] = $item_pesan;
    }
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

    <title>Keranjang - Restomenu</title>
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
                    <a class="nav-item nav-link btn btn-my-color btn-sm text-white mr-2" href="pesan.php">Pesan</a>
                    <a href="login.php" class="nav-item nav-link btn btn-my-color btn-sm text-white">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container main">
        <div class="row mt-3">
            <div class="col">
                <h1>Keranjang</h1>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <?php
                // Query id
                if (!empty($_SESSION['pesan_cart'])) {
                    unset($_SESSION['id']);

                    // Ambil atau pindahkan id dari session pesan_cart ke session id
                    foreach ($_SESSION['pesan_cart'] as $keys => $values) {
                        $_SESSION['id'][] = $values['item_id'];
                    }
                    $carts = [];
                    // Lalu query id tersebut
                    foreach ($_SESSION['id'] as $id) {
                        $carts[] = query("SELECT * FROM menu WHERE id=$id");
                    }
                }
                ?>
                <?php
                // Menghapus seluruh cart
                if (isset($_POST['reset'])) {
                    unset($_SESSION['pesan_cart']);
                    unset($_SESSION['id']);
                }
                ?>
                <form action="" method="post">
                    <button type="submit" name="reset" class="btn btn-danger">Reset</button>
                </form>

            </div>
        </div>
        <div class="row mt-2 pb-4">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Lalu tampilkan data dari query yang diatas -->
                        <?php $no = 1; ?>
                        <?php if (isset($_SESSION['pesan_cart']) && isset($carts)) : ?>
                            <?php foreach ($carts as $cart) : ?>
                                <?php $total += $cart[0]['harga']; ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $cart[0]['nama']; ?></td>
                                    <td><?= $cart[0]['kategori']; ?></td>
                                    <td><?= 'Rp.' . number_format($cart[0]['harga'], 2, '.', ','); ?></td>
                                    <td>
                                        <a href="?id=<?= $cart[0]['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 border py-4">
                <ul class="list-group">
                    <li class="list-group-item rounded">Total: <span class="float-right">Rp. <?= number_format($total, 2, '.', '.'); ?></span></li>
                    <li class="list-group-item d-flex align-items-center justify-content-between mt-2 border-top rounded">Bayar:
                        <form action="" method="post">
                            <div class="input-group ml-2">
                                <input type="number" class="form-control" name="bayar" autocomplete="off" autofocus>
                                <div class="input-group-append">
                                    <button class="btn btn-my-color" type="submit" name="refreshKembali">&rightarrow;</button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <?php
                    if (isset($_POST['refreshKembali'])) {
                        $bayar = $_POST['bayar'];
                        $kembali = $bayar - $total;
                    }
                    ?>
                    <li class="list-group-item mt-2 border-top rounded">Kembalian: <span class="float-right">Rp. <?= $kembali; ?></span></li>
                    <button class="btn btn-my-color mt-2">Bayar / Pesan</button>
                </ul>
            </div>
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