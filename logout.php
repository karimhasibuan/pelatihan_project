<?php
session_start();
session_destroy();

echo 'Anda berhasil logout!';
echo "<meta http-equiv='refresh' content='2;url=login.php'>";
