<?php
require 'init.php';

// Cek jika adalah yang masuk melalui url
if (!isset($_POST['ubah'])) {
    header("Location: ../index.php");
    exit;
}

if (ubah($_POST) > 0) {
    tampilAlert("Data berhasil diubah");
} else {
    tampilAlert("Data gagal diubah");
}
