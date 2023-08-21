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
        <title>Document</title>
    </head>

    <body>
        <form action="" method="post">
            <h1>Tambah Data Jabatan</h1>
            <a href="index.php">Kembali</a>

            <div>
                <label for="">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" placeholder="Masukkan nama jabatan yang baru" required>
                <input type="submit" name="submit" value="SUBMIT">
            </div>
        </form>
    </body>

    </html>

<?php
}

if (isset($_POST['submit'])) {
    $jabatan = $_POST['jabatan'];
    $result = mysqli_query($koneksi, "INSERT INTO jabatan(nama_jabatan) VALUES('$jabatan')");

    if ($result) {
        echo "Data berhasil disimpan";
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    } else {
        echo "Data gagal disimpan <br>";
        echo mysqli_error($koneksi);
    }
}
?>