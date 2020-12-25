<?php
require 'init.php';

if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'];

if (hapus($id) > 0) {
    tampilAlert("Data berhasil dihapus");
} else {
    tampilAlert("Data gagal dihapus");
}
