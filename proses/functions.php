<?php
function getConn()
{
    return mysqli_connect("localhost", 'root', '', 'db_restomenu');
}


function query($query)
{
    $conn = getConn();
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    // Siapkan koneksi
    $conn = getConn();

    // Ambil data dari $_POST yang dikirim
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);
    $kategori = htmlspecialchars($data['kategori']);
    $gambar = uploadGambar();

    if (!$gambar) {
        return false;
    }

    // Cek input apakah kosong
    if (empty($nama) or empty($harga) or empty($kategori)) {
        tampilAlert("Input tidak boleh kosong!", '../tambah.php');
        return false;
    }

    // Cek apakah input harga angka?
    if (!is_numeric($harga)) {
        tampilAlert("Input harga harus angka!", '../tambah.php');
        return false;
    }

    // Query
    mysqli_query($conn, "INSERT INTO menu VALUES(NULL,'$nama','$kategori',$harga,'$gambar')");

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    $conn = getConn();

    mysqli_query($conn, "DELETE FROM menu WHERE id=$id");

    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    $conn = getConn();

    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);
    $kategori = htmlspecialchars($data['kategori']);
    $gambarLama = htmlspecialchars($data['gambarHidden']);

    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadGambar();
    }

    // Cek input apakah kosong
    if (empty($nama) or empty($harga) or empty($kategori)) {
        tampilAlert("Input tidak boleh kosong!", "../ubah.php?id=$id");
        return false;
    }

    // Cek apakah input harga angka?
    if (!is_numeric($harga)) {
        tampilAlert("Input harga harus angka!", "../ubah.php?id=$id");
        return false;
    }

    mysqli_query($conn, "UPDATE menu SET nama='$nama', kategori='$kategori', harga=$harga, gambar='$gambar' WHERE id=$id");

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    return query("SELECT * FROM menu WHERE
    nama LIKE '%$keyword%' or
    kategori LIKE '%$keyword%' or
    harga LIKE '%$keyword%'");
}

function tampilAlert($pesan, $halaman = '../index.php')
{
    echo "<script>
        alert('$pesan');
        document.location.href = '$halaman';
    </script>";
}


function uploadGambar()
{
    // Sampai sini upload gambar
    $namaGambar = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $sizeGambar = $_FILES['gambar']['size'];
    $eksGambar = explode('.', $namaGambar);
    $eksGambar = strtolower(end($eksGambar));
    $error = $_FILES['gambar']['error'];

    $eksValid = ['jpg', 'jpeg', 'png'];

    // Cek apakah ada files / gambar yang di upload
    if ($error == 4) {
        tampilAlert("Janga lupa upload gambar", '../tambah.php');
        return false;
    }
    // Cek extensi gambar
    if (!in_array($eksGambar, $eksValid)) {
        tampilAlert("Yang anda upload bukan gambar", '../tambah.php');
        return false;
    }
    // Cek ukuran gambar
    if ($sizeGambar > 1000000) {
        tampilAlert("Ukuran gambar harus dibawah 1000kb");
        return false;
    }
    $namaGambar = date("ddmmyyyy") . uniqid() . '.' . $eksGambar;
    move_uploaded_file($tmpName, '../assets/image/' . $namaGambar);
    return $namaGambar;
}
