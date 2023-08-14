<?php
session_start();
ob_start();

include '../config/db.php';

if (empty($_SESSION['username']) or empty($_SESSION['password'])) {
    echo "Anda harus login terlebih dahulu!";
    echo "<meta http-equiv='refresh' content='0;url:../login.php'>";
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
        <a href="../logout.php">Logout</a>
    </body>

    </html>

<?php
}
?>