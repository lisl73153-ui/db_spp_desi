<?php
include_once "../src/koneksi.php";

// Pastikan parameter 'id' (id_pembayaran) ada di URL
if (isset($_GET['id'])) {
    $id_pembayaran = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Ambil tanggal hari ini (YYYY-MM-DD)
    $tgl_bayar = date('Y-m-d');
    
    // Ambil ID petugas yang sedang login (sesuaikan dengan session login di aplikasi kamu, misal $_SESSION['id_petugas'])
    // Jika belum pakai session login, kita set sementara jadi angka 1 atau kosongkan dulu
    $id_petugas = isset($_SESSION['id_petugas']) ? $_SESSION['id_petugas'] : '1'; 

    // Query untuk mengupdate status pembayaran menjadi LUNAS
    $queryUpdate = "UPDATE pembayaran SET 
                    tgl_bayar = '$tgl_bayar', 
                    keterangan = 'LUNAS',
                    id_petugas = '$id_petugas' 
                    WHERE id_pembayaran = '$id_pembayaran'";

    $sql = mysqli_query($koneksi, $queryUpdate);

    if ($sql) {
        // Ambil NISN dari data pembayaran ini untuk dikembalikan ke halaman riwayat siswa
        $qCek = mysqli_query($koneksi, "SELECT nisn FROM pembayaran WHERE id_pembayaran = '$id_pembayaran'");
        $dCek = mysqli_fetch_array($qCek);
        $nisn = $dCek['nisn'] ?? '';

        // Berhasil, arahkan kembali ke halaman pembayaran siswa bersangkutan
        echo "<script>
                alert('Pembayaran SPP Berhasil Dilunasi!');
                window.location.href='halaman_admin.php?open=data_pembayaran&nisn=$nisn';
              </script>";
        exit;
    } else {
        echo "<div style='color:red; padding:10px;'><b>Gagal Melakukan Pembayaran!</b><br>Error: " . mysqli_error($koneksi) . "</div>";
    }
} else {
    echo "<script>window.location.href='halaman_admin.php?open=data_pembayaran';</script>";
}
?>