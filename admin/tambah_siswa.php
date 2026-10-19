<?php
include_once "../src/koneksi.php";

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
    $nisn     = trim($_POST['nisn']);
    $nis      = trim($_POST['nis']);
    $nama     = trim($_POST['nama']);
    $id_kelas = trim($_POST['id_kelas']);
    $alamat   = trim($_POST['alamat']);
    $no_telp  = trim($_POST['no_telp']);
    $id_spp   = trim($_POST['id_spp']);
    
    // Urutan bulan ajaran SPP dari Juli s/d Juni
    $arraybulan = array("Juli","Agustus","September","Oktober","November","Desember","Januari","Februari","Maret","April","Mei","Juni");

    // Validasi Form Inputs
    $pesanError = array();
    if ($nisn == "") {
        $pesanError[] = "Data <b>NISN</b> tidak boleh kosong !";
    } else {
        // Cek apakah NISN sudah terdaftar di database
        $cekNisn = mysqli_query($koneksi, "SELECT nisn FROM siswa WHERE nisn = '$nisn'");
        if(mysqli_num_rows($cekNisn) > 0){
            $pesanError[] = "Data <b>NISN</b> $nisn sudah terdaftar! Gunakan NISN lain.";
        }
    }

    if ($nis == "")      { $pesanError[] = "Data <b>NIS</b> tidak boleh kosong !"; }
    if ($nama == "")     { $pesanError[] = "Data <b>NAMA</b> tidak boleh kosong !"; }
    if ($id_kelas == "") { $pesanError[] = "Data <b>KELAS</b> tidak boleh kosong !"; }
    if ($alamat == "")   { $pesanError[] = "Data <b>ALAMAT</b> tidak boleh kosong !"; }
    if ($no_telp == "")  { $pesanError[] = "Data <b>NOMOR TELEPON</b> tidak boleh kosong !"; }
    if ($id_spp == "")   { $pesanError[] = "Data <b>NOMINAL / SPP</b> tidak boleh kosong !"; }

    // Menampilkan Pesan Error dari Form jika ada yang kosong/duplikat
    if (count($pesanError) >= 1){
        $noPesan = 0;
        foreach ($pesanError as $indeks => $pesan_tampil) {
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "<br>";
    }
    else {
        // Skrip Simpan data Siswa ke Database
        $query = "INSERT INTO siswa (nisn, nis, nama, id_kelas, alamat, no_telp, id_spp) 
                  VALUES('$nisn', '$nis', '$nama', '$id_kelas', '$alamat', '$no_telp', '$id_spp')";
        
        $sql = mysqli_query($koneksi, $query);

        if($sql){
            // Ambil tahun dari tabel spp berdasarkan id_spp yang dipilih
            $qSpp = mysqli_query($koneksi, "SELECT tahun FROM spp WHERE id_spp='$id_spp'");
            $dSpp = mysqli_fetch_array($qSpp);
            $tahunsekarang = isset($dSpp['tahun']) ? $dSpp['tahun'] : date('Y');

            // Generate tagihan SPP 12 bulan
            for($i = 0; $i < 12; $i++){
                $bulan = $arraybulan[$i];

                // Pergantian tahun ajaran saat masuk bulan Januari (indeks ke-6)
                if ($i == 6){
                    $tahunsekarang++;
                }

                // Insert ke tabel pembayaran dengan status awal BELUM LUNAS
                mysqli_query($koneksi, "INSERT INTO pembayaran (nisn, bulan_dibayar, tahun_dibayar, id_spp, keterangan) 
                                        VALUES ('$nisn', '$bulan', '$tahunsekarang', '$id_spp', 'BELUM LUNAS')");
            }

            echo "<center><b><font color='green' size='4'><p>Data Siswa dan Tagihan SPP Berhasil disimpan!</p></center></b></font></br>
            <meta http-equiv='refresh' content='2; url=?open=data_siswa'>";
            exit;
        }
        else{
            echo "<div style='color:red; background:#ffe6e6; padding:10px; border:1px solid red;'>";
            echo "<b>Data Gagal Disimpan!</b><br>";
            echo "Error MySQL: " . mysqli_error($koneksi);
            echo "</div><br>";
        }
    }
}
?>

<form action="" method="post">
    <table cellspacing="1" cellpadding="3">
        <tr>
            <td colspan="3" bgcolor="#CCCCCC"><strong>TAMBAH DATA SISWA</strong></td>
        </tr>
        <tr>
            <td>NISN</td>
            <td>:</td>
            <td><input name="nisn" type="text" size="10" maxlength="10" required /></td>
        </tr>
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td><input name="nis" type="text" size="20" maxlength="10" required /></td>
        </tr>
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td><input name="nama" type="text" size="50" maxlength="50" required /></td>
        </tr>
        <tr>
            <td>KELAS</td>
            <td>:</td>
            <td>
                <select name="id_kelas" required>
                    <option value=""> . . . . . </option>
                    <?php
                        $tampilkanKelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                        while ($bacaData = mysqli_fetch_array($tampilkanKelas)){
                            echo "<option value='$bacaData[id_kelas]'>$bacaData[nama_kelas] - $bacaData[kompetensi_keahlian]</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><input name="alamat" type="text" size="50" maxlength="50" required /></td>
        </tr>
        <tr>
            <td>No. Telepon</td>
            <td>:</td>
            <td><input name="no_telp" type="text" size="50" maxlength="50" required /></td>
        </tr>
        <tr>
            <td>Nominal</td>
            <td>:</td>
            <td>
                <select name="id_spp" required>
                    <option value=""> . . . . . </option>
                    <?php
                        $tampilkanSPP = mysqli_query($koneksi, "SELECT * FROM spp");
                        while ($bacaData = mysqli_fetch_array($tampilkanSPP)){
                            echo "<option value='$bacaData[id_spp]'>Rp. " . number_format($bacaData['nominal']) . "</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="btnSimpan" type="submit" value="Simpan" /></td>
        </tr>
    </table>
</form>