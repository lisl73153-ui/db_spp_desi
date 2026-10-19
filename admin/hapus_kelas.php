<?php
include_once "../src/koneksi.php";

// Cek apakah parameter id_kelas ada di URL
if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];

    // Hapus data dari tabel kelas berdasarkan id_kelas
    $sql = mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas = '$id_kelas'");
    
    if($sql){
        echo "<center><b><font color='red' size='4'><p>Data Kelas Berhasil dihapus</p></font></b></center><br>
              <meta http-equiv='refresh' content='2; url=?open=data_kelas'>";
    } else {
        echo "<center><b><font color='red' size='4'><p>Gagal menghapus data! Error: " . mysqli_error($koneksi) . "</p></font></b></center>
              <meta http-equiv='refresh' content='2; url=?open=data_kelas'>";
    }
}
else {
    echo "<center><b>Data yang dihapus tidak ada!</b></center>";
    echo "<meta http-equiv='refresh' content='2; url=?open=data_kelas'>";
}
?>