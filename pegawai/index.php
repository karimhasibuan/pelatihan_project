<?php
session_start();
ob_start();

include '../config/db.php';

if (empty($_SESSION['username']) or empty($_SESSION['password'])) {
    echo "Anda harus login terlebih dahulu!";
    echo "<a href='../login.php'>Login</a>";
} else {
    define('INDEX', true);
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Pegawai</title>
    </head>

    <body>
        <?php
        $id_user = $_SESSION['id_user'];
        $query = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_user='$id_user'");
        $data = mysqli_fetch_array($query);
        ?>
        <h1>Halo, <?= $data['nama_pegawai']; ?></h1>
        <p>Username anda adalah <?= $_SESSION['username']; ?></p>
        <a href="../logout.php">Logout</a>
    </body>

    </html>

<?php
}
?>