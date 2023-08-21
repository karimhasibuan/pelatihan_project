<?php
session_start();
ob_start();

include '../config/db.php';

if (empty($_SESSION['username']) or empty($_SESSION['password'])) {
    echo "Anda harus login terlebih dahulu!";
    echo "<a href='../login.php'>Login</a>";
} else {
    define('INDEX', true);
    $query = mysqli_query($koneksi, "SELECT * FROM jabatan WHERE id_jabatan='$_GET[id]'");
    $data = mysqli_fetch_array($query);
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
            <h1>Edit Data Jabatan</h1>
            <a href="index.php">Kembali</a>

            <div>
                <input type="hidden" name="id_jabatan" value="<?= $data['id_jabatan'] ?>">
                <label for="">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" value="<?= $data['nama_jabatan'] ?>" placeholder="Masukkan nama jabatan yang baru" required>
                <input type="submit" name="submit" value="SUBMIT">
            </div>
        </form>
    </body>

    </html>

<?php
}

if (isset($_POST['submit'])) {
    $id_jabatan = $_POST['id_jabatan'];
    $jabatan = $_POST['jabatan'];
    $result = mysqli_query($koneksi, "UPDATE jabatan SET nama_jabatan='$jabatan' WHERE id_jabatan='$id_jabatan'");

    if ($result) {
        echo "Data berhasil disimpan";
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    } else {
        echo "Data gagal disimpan <br>";
        echo mysqli_error($koneksi);
    }
}
?>