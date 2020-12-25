<?php
require 'init.php';

if (!isset($_POST['login'])) {
    header("Location: ../login.php");
    exit;
}


$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    tampilAlert("Input tidak boleh kosong", '../login.php');
}

$query = mysqli_query(getConn(), "SELECT * FROM user WHERE username='$username' AND password='$password'");
if (mysqli_num_rows($query) > 0) {
    $_SESSION['is_login'] = TRUE;
    tampilAlert("Login berhasil");
} else {
    tampilAlert("Username atau password salah", '../login.php');
}
