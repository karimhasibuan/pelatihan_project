<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_pegawai';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    echo 'Koneksi gagal terhubung. Pesan error: ' . mysqli_connect_errno();
}
