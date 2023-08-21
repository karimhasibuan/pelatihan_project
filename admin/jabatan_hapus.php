<?php
session_start();
ob_start();

include '../config/db.php';

if (empty($_SESSION['username']) or empty($_SESSION['password'])) {
    echo "Anda harus login terlebih dahulu!";
    echo "<a href='../login.php'>Login</a>";
} else {
    define('INDEX', true);

    $query = mysqli_query($koneksi, "DELETE FROM jabatan WHERE id_jabatan='$_GET[id]'");

    if ($query) {
        echo "Data berhasil dihapus";
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    } else {
        echo "Data gagal disimpan";
        echo mysqli_error($koneksi);
    }
}
