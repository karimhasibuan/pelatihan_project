<?php
session_start();
ob_start();

include '../config/db.php';

if (empty($_SESSION['username']) or empty($_SESSION['password'])) {
    echo "Anda harus login terlebih dahulu!";
    echo "<a href='../login.php'>Login</a>";
} else {
    define('INDEX', true);
    $query = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN users ON users.id_user=pegawai.id_user JOIN jabatan ON jabatan.id_jabatan=pegawai.id_jabatan WHERE id_pegawai='$_GET[id]'");
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
            <input type="hidden" name="id_pegawai" value="<?= $data['id_pegawai'] ?>">
            <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
            <h1>Edit Data Pegawai</h1>
            <a href="index.php">Kembali</a>

            <div>
                <label for="">Username</label>
                <input type="text" name="username" id="username" value="<?= $data['username']; ?>" placeholder="Masukkan username yang baru" required>
            </div>

            <div>
                <label for="">Password</label>
                <input type="text" name="password" id="password" placeholder="Masukkan password baru">
            </div>

            <div>
                <label for="">Nama Pegawai</label>
                <input type="text" name="nama_pegawai" id="nama_pegawai" value="<?= $data['nama_pegawai'] ?>" placeholder="Masukkan nama pegawai" required>
            </div>

            <div>
                <label for="">No HP</label>
                <input type="text" name="nohp_pegawai" id="nohp_pegawai" value="<?= $data['no_hp']; ?>" placeholder="Masukkan No HP pegawai" required>
            </div>

            <div>
                <label for="">Jabatan</label>
                <select name="id_jabatan" id="id_jabatan">
                    <option value="<?= $data['id_jabatan'] ?>" selected hidden><?= $data['nama_jabatan']; ?></option>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM jabatan");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <option value="<?= $data['id_jabatan']; ?>"><?= $data['nama_jabatan']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <input type="submit" name="submit" value="SUBMIT">
        </form>
    </body>

    </html>

<?php
}

if (isset($_POST['submit'])) {
    $id_pegawai = $_POST['id_pegawai'];
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama_pegawai = $_POST['nama_pegawai'];
    $id_jabatan = $_POST['id_jabatan'];
    $nohp_pegawai = $_POST['nohp_pegawai'];
    $role = 'pegawai';


    if ($password == "") {
        $result = mysqli_query($koneksi, "UPDATE users SET username='$username', role='$role' WHERE id_user='$id_user'");
        if ($result) {
            $query2 = mysqli_query($koneksi, "SELECT MAX(id_user) AS max_id FROM users");
            $row = mysqli_fetch_assoc($query2);
            $id_user = $row['max_id'];

            $query_pegawai = mysqli_query($koneksi, "UPDATE pegawai SET id_user='$id_user', nama_pegawai='$nama_pegawai', id_jabatan='$id_jabatan', no_hp='$nohp_pegawai' WHERE id_pegawai='$id_pegawai'");

            if ($query_pegawai) {
                echo "Data berhasil disimpan";
                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
            } else {
                echo "Data gagal disimpan <br>";
                echo mysqli_error($koneksi);
            }
        } else {
            echo "Data gagal disimpan <br>";
            echo mysqli_error($koneksi);
        }
    } else {
        $result = mysqli_query($koneksi, "UPDATE users SET username='$username', password='$password', role='$role' WHERE id_user='$id_user'");
        if ($result) {
            $query2 = mysqli_query($koneksi, "SELECT MAX(id_user) AS max_id FROM users");
            $row = mysqli_fetch_assoc($query2);
            $id_user = $row['max_id'];

            $query_pegawai = mysqli_query($koneksi, "UPDATE pegawai SET id_user='$id_user', nama_pegawai='$nama_pegawai', id_jabatan='$id_jabatan', no_hp='$nohp_pegawai' WHERE id_pegawai='$id_pegawai'");

            if ($query_pegawai) {
                echo "Data berhasil disimpan";
                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
            } else {
                echo "Data gagal disimpan <br>";
                echo mysqli_error($koneksi);
            }
        } else {
            echo "Data gagal disimpan <br>";
            echo mysqli_error($koneksi);
        }
    }
}

?>