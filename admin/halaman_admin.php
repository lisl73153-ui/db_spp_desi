<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPP ONLINE</title>
    
    <!-- Perbaikan panggilan CSS + penambahan versi (?v=2) agar browser langsung update -->
    <link rel="stylesheet" type="text/css" href="../src/style.css?v=2">
</head>
<body>
    <?php
        session_start();
        if($_SESSION['level']==""){
            header("location:index.php?pesan=gagal");
        }
    ?>

    <header>
        <h1 class="judul">PEMBAYARAN SPP ONLINE SMK NEGERI 3 BANJARBARU</h1>
    </header>

    <div class="wrap">
        <nav class="menu">
            <?php include "menu.php"; ?>
        </nav>

        <aside class="sidebar">
            <div class="widget">
                <h2>Selamat Datang, <?php echo $_SESSION['username']; ?></h2>
                <p>Selamat datang di aplikasi pembayaran SPP SMK NEGERI 3 BANJARBARU</p>
            </div>
        </aside>

        <div class="blog">
            <div class="conteudo">
                <?php include "buka_file.php"; ?>
            </div>
        </div>
    </div>
</body>
</html>