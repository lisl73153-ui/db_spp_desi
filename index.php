<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login - SPP ONLINE</title>
    <!-- Font Poppins untuk tampilan modern -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            padding: 15px;
            overflow-x: hidden;
        }

        /* Judul dibuat lebih dekat ke card */
        .title {
            color: #1e3a8a;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 15px;
            letter-spacing: 3px;
            text-shadow: 0 4px 15px rgba(30, 58, 138, 0.15);
            animation: fadeInDown 0.8s ease-out;
        }

        /* Kotak Login Ringkas (Proporsional & Tidak Memanjang) */
        fieldset {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            /* Padding atas-bawah dikurangi agar kotak tidak memanjang */
            padding: 20px 30px 25px 30px; 
            box-shadow: 0 15px 35px rgba(30, 58, 138, 0.12),
                        0 1px 3px rgba(0, 0, 0, 0.05);
            margin: 0 auto;
            backdrop-filter: blur(10px);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s ease;
            animation: fadeInUp 0.8s ease-out;
        }

        fieldset:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.18);
        }

        legend {
            margin: 0 auto;
            float: none;
        }

        /* Logo Sapi dibuat proporsional */
        legend img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #ffffff;
            box-shadow: 0 6px 16px rgba(30, 58, 138, 0.15);
            animation: float 3s ease-in-out infinite;
        }

        /* Jarak judul LOGIN dirapatkan */
        .login-title {
            text-align: center;
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin: 8px 0 15px 0;
            letter-spacing: 1px;
        }

        .alert {
            background-color: #fef2f2;
            color: #ef4444;
            padding: 10px;
            border-radius: 10px;
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 12px;
            border: 1px solid #fecaca;
            animation: shake 0.4s ease-in-out;
        }

        /* Jarak antar elemen form dirapatkan */
        .form-group {
            margin-bottom: 12px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            height: 44px; /* Tinggi input disesuaikan agar pas */
            padding: 0 18px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            background-color: #f8fafc;
            font-size: 0.9rem;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #3b82f6;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            transform: scale(1.01);
        }

        #submit {
            width: 100%;
            height: 44px;
            color: white;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 5px;
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        #submit:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.4);
        }

        #submit:active {
            transform: translateY(1px);
        }

        .link-container {
            text-align: center;
            margin-top: 14px;
        }

        .link-container a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .link-container a:hover {
            color: #2563eb;
        }

        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-4px); }
            40%, 80% { transform: translateX(4px); }
        }
    </style>
</head>
<body>

    <h1 class="title"><b>SPP</b> ONLINE</h1>

    <form action="login_validasi.php" method="post">           
        <fieldset>
            <?php
            if(isset($_GET['pesan'])){
                if($_GET['pesan']=="gagal"){
                    echo "<div class='alert'>Username dan Password tidak sesuai!</div>";
                }
            }
            ?>

            <legend align="center">
                <img src="src/sapi kiyut.jpg" alt="Logo Sapi">
            </legend>

            <div class="login-title">LOGIN</div>

            <div class="form-group">
                <input name="username" type="text" placeholder="Username" autocomplete="off" required>
            </div>

            <div class="form-group">
                <input name="password" type="password" placeholder="Password" required>
            </div>

            <input name="login" type="submit" value="LOGIN" id="submit">

            <div class="link-container">
                <a href="bayar.php">CEK PEMBAYARAN</a>
            </div>
        </fieldset>
    </form>

</body>
</html>