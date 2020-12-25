<?php
require 'init.php';

// Cek jika adalah yang masuk melalui url
if (!isset($_POST['tambah'])) {
    header("Location: ../index.php");
    exit;
}

if (tambah($_POST) > 0) {
    tampilAlert("Data berhasil ditambahkan");
} else {
    tampilAlert("Data gagal ditambahkan");
}
