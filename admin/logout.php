<?php
// 1. Jalankan session
session_start();

// 2. Hapus semua data variabel session
session_unset();

// 3. Hancurkan session
session_destroy();

// 4. Lempar (redirect) pengguna kembali ke halaman login
header("Location: ../index.php"); 
exit();
?>