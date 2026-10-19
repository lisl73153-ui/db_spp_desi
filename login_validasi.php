<?php
session_start();
include 'src/koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' AND password='$password'") 
        or die(mysqli_error($koneksi));
$cek = mysqli_num_rows($login);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Login</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body>

<?php
if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    if ($data['level'] == "admin") {
        $_SESSION['username']   = $username;
        $_SESSION['level']      = "admin";
        $_SESSION['id_petugas'] = $data['id_petugas'];
        
        echo "<script>
            Swal.fire({
                title: 'Berhasil Login!',
                text: 'Selamat datang kembali, Admin!',
                icon: 'success',
                confirmButtonColor: '#3b82f6',
                confirmButtonText: 'Lanjutkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'admin/halaman_admin.php';
                }
            });
        </script>";

    } else if ($data['level'] == "petugas") {
        $_SESSION['username']   = $username;
        $_SESSION['level']      = "petugas";
        $_SESSION['id_petugas'] = $data['id_petugas'];
        
        echo "<script>
            Swal.fire({
                title: 'Berhasil Login!',
                text: 'Selamat datang kembali, Petugas!',
                icon: 'success',
                confirmButtonColor: '#3b82f6',
                confirmButtonText: 'Lanjutkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'admin/halaman_admin.php';
                }
            });
        </script>";

    } else {
        header("location:index.php?pesan=gagal");
    }
} else {
    header("location:index.php?pesan=gagal");
}
?>

</body>
</html>