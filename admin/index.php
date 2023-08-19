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
        <title>Halaman Admin</title>
    </head>

    <body>
        <h1>Halo, <?= $_SESSION['username']; ?></h1>
        <div>
            <h2>DATA PEGAWAI</h2>
            <table border="1">
                <thead>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    <th>No HP</th>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT users.username, pegawai.nama_pegawai, jabatan.nama_jabatan, pegawai.no_hp FROM pegawai JOIN jabatan ON pegawai.id_jabatan=jabatan.id_jabatan JOIN users ON users.id_user=pegawai.id_user;");
                    $no = 0;
                    while ($data = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $data['username']; ?></td>
                            <td><?= $data['nama_pegawai']; ?></td>
                            <td><?= $data['nama_jabatan']; ?></td>
                            <td><?= $data['no_hp']; ?></td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div>
            <h2>DATA JABATAN</h2>
            <a href="#">Tambah Jabatan</a>
            <table border="1">
                <thead>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Kelola</th>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM jabatan");
                    $no = 0;
                    while ($data = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $data['nama_jabatan']; ?></td>
                            <td><a href="#">Edit</a> | <a href="#">Hapus</a></td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="../logout.php">Logout</a>
    </body>

    </html>

<?php
}
?>