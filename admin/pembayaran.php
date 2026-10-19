<?php
include_once "../src/koneksi.php";

$nisn = isset($_GET['nisn']) ? mysqli_real_escape_string($koneksi, $_GET['nisn']) : '';
?>

<h3>Transaksi Pembayaran SPP</h3>

<form action="" method="get">
    <input type="hidden" name="open" value="data_pembayaran">
    nisn: <input type="text" name="nisn" value="<?= htmlspecialchars($nisn); ?>" required>
    <input type="submit" name="cari" value="Cari Siswa">
</form>

<br>

<?php
if ($nisn != "") {
    // Ambil Data Siswa
    $qSiswa = mysqli_query($koneksi, "SELECT siswa.*, kelas.nama_kelas 
                                      FROM siswa 
                                      LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
                                      WHERE siswa.nisn = '$nisn'");
    $dSiswa = mysqli_fetch_array($qSiswa);

    if ($dSiswa) {
?>
        <h4>Biodata Siswa</h4>
        <table cellpadding="3">
            <tr>
                <td>nisn</td>
                <td>:</td>
                <td><?= $dSiswa['nisn']; ?></td>
            </tr>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td><?= $dSiswa['nama']; ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><?= isset($dSiswa['nama_kelas']) ? $dSiswa['nama_kelas'] : '-'; ?></td>
            </tr>
        </table>

        <h4>Tagihan SPP Siswa</h4>
        <table border="1" cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
            <tr bgcolor="#f2f2f2">
                <th>No</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>No. Bayar</th>
                <th>Tgl. Bayar</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Bayar</th>
            </tr>
            <?php
            // Ambil Tagihan SPP Siswa berdasarkan id_pembayaran
            $qBayar = mysqli_query($koneksi, "SELECT pembayaran.*, spp.nominal 
                                              FROM pembayaran 
                                              LEFT JOIN spp ON pembayaran.id_spp = spp.id_spp 
                                              WHERE pembayaran.nisn = '$nisn' 
                                              ORDER BY pembayaran.id_pembayaran ASC");
            $no = 1;
            while ($row = mysqli_fetch_array($qBayar)) {
                $id_pembayaran = $row['id_pembayaran'] ?? '-';
                $bulan_dibayar = $row['bulan_dibayar'] ?? '-';
                $tahun_dibayar = $row['tahun_dibayar'] ?? '-';
                $tgl_bayar     = !empty($row['tgl_bayar']) ? $row['tgl_bayar'] : '0000-00-00';
                $jumlah        = isset($row['nominal']) ? $row['nominal'] : ($row['jumlah_bayar'] ?? 0);
                
                // Cek Keterangan
                $ket = isset($row['keterangan']) ? trim($row['keterangan']) : '';
                if ($ket == "" || $ket == "0") {
                    $keterangan = "BELUM LUNAS";
                } else {
                    $keterangan = $ket;
                }
            ?>
                <tr>
                    <td align="center"><?= $no++; ?></td>
                    <td><?= $bulan_dibayar; ?></td>
                    <td align="center"><?= $tahun_dibayar; ?></td>
                    <td align="center"><?= $id_pembayaran; ?></td>
                    <td align="center"><?= $tgl_bayar; ?></td>
                    <td align="right"><?= number_format($jumlah); ?></td>
                    <td align="center">
                        <b style="color: <?= ($keterangan == 'LUNAS') ? 'green' : 'red'; ?>;">
                            <?= $keterangan; ?>
                        </b>
                    </td>
                    <td align="center">
                        <?php if ($keterangan != 'LUNAS') { ?>
                            <a href="?open=proses_bayar&id=<?= $id_pembayaran; ?>">Bayar</a>
                        <?php } else { echo "-"; } ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
<?php
    } else {
        echo "<b style='color:red;'>Data Siswa dengan NISN '$nisn' tidak ditemukan!</b>";
    }
}
?>