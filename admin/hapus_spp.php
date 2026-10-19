<?php
include_once "../src/koneksi.php";

if (isset($_GET['id_spp'])) {
    $id_spp = $_GET['id_spp'];

    $stmt = mysqli_prepare($koneksi, "DELETE FROM spp WHERE id_spp = ?");
    mysqli_stmt_bind_param($stmt, "s", $id_spp); 

    if (mysqli_stmt_execute($stmt)) {
       
        echo "<script>
                alert('Data SPP berhasil dihapus!');
                window.location.href = '?open=data_spp';
              </script>";
        exit();
    } else {
       
        echo "<script>
                alert('Gagal menghapus data! Kemungkinan data SPP ini sedang digunakan di tabel lain.');
                window.location.href = '?open=data_spp';
              </script>";
        exit();
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "<script>
            alert('Data yang ingin dihapus tidak ditemukan!');
            window.location.href = '?open=data_spp';
          </script>";
    exit();
}
?>