<?php
include 'config/db.php';

session_start();


$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'AND password='$password'");

$data = mysqli_fetch_array($query);
$countData = mysqli_num_rows($query);

if ($countData > 0) {
    $_SESSION['username'] = $data['username'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['role'] = $data['role'];
    if ($_SESSION['role'] == 'admin') {
        header('Location: admin/index.php');
    } else if ($_SESSION['role'] == 'pegawai') {
        header('Location: pegawai/index.php');
    }
} else {
    echo 'Login Gagal';
}
