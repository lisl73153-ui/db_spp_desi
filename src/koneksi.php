<?php
$koneksi = mysqli_connect("localhost","root","","db_spp_desi");

if (mysqli_connect_errno()){
    echo "Koneksi database gagal : " . mysqli_connect_errno();

}
?>