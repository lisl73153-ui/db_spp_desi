<?php
include_once "../src/koneksi.php";

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
    $id_kelas            = $_POST['id_kelas'];
    $nama_kelas          = $_POST['nama_kelas'];
    $kompetensi_keahlian = $_POST['kompetensi_keahlian'];

    // Validasi Form Inputs
    $pesanError = array();
    if (trim($id_kelas) == "") {
        $pesanError[] = "Data <b>ID Kelas</b> tidak boleh kosong!";
    }
    if (trim($nama_kelas) == "") {
        $pesanError[] = "Data <b>Nama Kelas</b> tidak boleh kosong!";
    }
    if (trim($kompetensi_keahlian) == "") {
        $pesanError[] = "Data <b>Kompetensi Keahlian</b> tidak boleh kosong!";
    }

    // Menampilkan Pesan Error dari Form
    if (count($pesanError) >= 1) {
        $noPesan = 0;
        foreach ($pesanError as $indeks => $pesan_tampil) {
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "<br>";
    }
    else {
        // Skrip Simpan data ke Database (Tabel Kelas)
        $sql = mysqli_query($koneksi, "INSERT INTO kelas (id_kelas, nama_kelas, kompetensi_keahlian) 
                VALUES ('$id_kelas', '$nama_kelas', '$kompetensi_keahlian')");
        
        if($sql){
            echo "<center><b><font color='green' size='4'><p>Data Berhasil disimpan</p></font></b></center><br>
                  <meta http-equiv='refresh' content='2; url=?open=data_kelas'>";
            exit;
        }
        else {
            // Menampilkan error database jika query gagal
            echo "<center><b><font color='red' size='4'><p>Data Gagal Disimpan! Error: " . mysqli_error($koneksi) . "</p></font></b></center>";
        }
    }
}
?>

<!-- Action diarahkan ke ?open=tambah_kelas agar script pengolah di atas tetap diproses -->
<form action="?open=tambah_kelas" method="post">
    <table cellspacing="1" cellpadding="3">
        <tr>
            <td bgcolor="#CCCCCC" colspan="3"><strong>TAMBAH DATA KELAS</strong></td>
        </tr>
        <tr>
            <td>ID KELAS</td>
            <td>:</td>
            <td><input name="id_kelas" type="text" size="20" maxlength="20" /></td>
        </tr>
        <tr>
            <td>NAMA KELAS</td>
            <td>:</td>
            <td><input name="nama_kelas" type="text" size="30" maxlength="30" /></td>
        </tr>
        <tr>
            <td>KOMPETENSI KEAHLIAN</td>
            <td>:</td>
            <td><input name="kompetensi_keahlian" type="text" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="btnSimpan" type="submit" value="Simpan" /></td>
        </tr>
    </table>
</form>